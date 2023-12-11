<?php

namespace App\Http\Controllers\AdSchedule\Edit;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\Insertion;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Validation\ValidationException;
use App\Contracts\InsertionContract;
use DateTime;
use DateInterval;
use DatePeriod;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CueExport;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;



class InsertionController extends Controller
{
    protected $insertionRepository;

    public function __construct(InsertionContract $insertionRepository)
    {
        $this->insertionRepository = $insertionRepository;
    }

    public function exportCue() 
    {
        /**
         * 生成資料
         * */

        $adslot_colors = array(
            'FF00A5E3',
            'FF8DD7BF',
            'FFFF96C5',
            'FFFF5768',
            'FFFFD872',
            'FFF2D4CC',
            'FF00CDAC',
            'FF6C88C4',
            'FF64864A',
            'FFAFDDD5',
            'FFC6B598',
            'FFE9E7AD',
            'FF7ABAA1',
            'FFCFEAE4',
        );

        $year_month_colors = array(
            'FFABDEE6',
            'FFCBAACB',
            'FFFFFFB5',
            'FFFFCCB6',
            'FFC6DBDA',
            'FFFEE1E8',
            'FFFED7C3',
            'FFF6EAC2',
            'FFD4F0F0',
            'FF8FCACA',
            'FFCCE2CB',
            'FFFFDBCC',
            'FFECEAE4',
            'FFA2E1DB',
            'FF6C88C4',
            'FF64864A',
            'FFAFDDD5',
            'FFC6B598',
            'FFE9E7AD',
            'FF7ABAA1',
            'FFCFEAE4',
        );

        $insertions = Session::get('insertions');
        // echo "<pre>";print_r($insertions);echo "</pre>";exit;

        /**
         * 判斷月份區間
         * 需先重新go through 一次data ranges
         * */
        $all_dates = array();
        $all_month_records = array();
        $occupied_all_month_records = array();
        $adslot_colors_mapping = array();
        foreach($insertions as $insertion_type => $insertion){
            foreach($insertion as $combination_key=>$adslot){
                
                //如果$adslot['info'][0] 存在，則代表這個adslot 是成效型
                if(!isset($adslot['info'][0])){//只需看非成效型的日期
                    foreach($adslot['info']['dateRanges'] as $date_range_key=>$dates){
                        foreach($dates as $date_key=>$date){
                            $all_dates[] = $date;
                        }
                    }
                }

            }
        }

        /**
         * 列出所有不重覆的日期
         * */
        sort($all_dates);
        $all_dates = array_unique($all_dates);

        $start_date = $all_dates[array_key_first($all_dates)];
        $end_date = $all_dates[array_key_last($all_dates)];


        /**
         * 列出所有不重覆的月份
         * */
        $start    = (new DateTime($start_date))->modify('first day of this month');
        $end      = (new DateTime($end_date))->modify('first day of next month');
        $interval = DateInterval::createFromDateString('1 month');
        $period   = new DatePeriod($start, $interval, $end);

        foreach ($period as $dt) {
            $all_month_records[$dt->format("Y-m")] = array();
            $occupied_all_month_records[$dt->format("Y-m")] = array();
        }

        
        /**
         * 將版位按
         * 1）月份分類
         * 2）按row 擺放（需先檢查此row、此日期區間是否全空下來）
         * */
        foreach($insertions as $insertion_type => $insertion){
            foreach($insertion as $combination_key=>$adslot){
                

                //如果$adslot['info'][0] 存在，則代表這個adslot 是成效型
                if(!isset($adslot['info'][0])){//排期表，只排"非成效型"
                    foreach($adslot['info']['dateRanges'] as $date_range_key=>$dates){
                        /**
                         * 如果日期區間是跨月份的，則先分好月份，再來檢查
                         * */
                        if($this->checkIfCrossMonths($dates)){//有跨月份
                            
                            $splited_dates = $this->splitDatesByMonth($dates);

                            foreach($splited_dates as $splited_dates_key=>$splited_date){
                                //用區間的第一天去判斷是哪一個月份
                                $specific_month = date('Y-m',strtotime($splited_date[0]));
                                $found = false;
                                $exception = false;
                                if(empty($occupied_all_month_records[$specific_month])){
                                    $occupied_all_month_records[$specific_month][0] = array();
                                }

                                foreach($occupied_all_month_records[$specific_month] as $row=>$row_data){

                                    if(empty($occupied_all_month_records[$specific_month][$row])){//代表此row 都還可以用
                                        //開始擺放日期
                                        $occupied_all_month_records[$specific_month][$row] = array();

                                        foreach($splited_date as $date_key=>$date){
                                            $occupied_all_month_records[$specific_month][$row][$date] = true;
                                        }

                                        $temp = array();
                                        $temp['name'] = $adslot['info']['region'].'_'.$adslot['info']['adslotGroup'];

                                        if(!isset($adslot_colors_mapping[$temp['name']])){
                                            $adslot_colors_mapping[$temp['name']] = $adslot_colors[array_rand($adslot_colors)];
                                        }
                                        
                                        $temp['dates'] = $splited_date;
                                        $all_month_records[$specific_month][$row][] = $temp;
                                        $exception = true;
                                    }
                                    else{
                                        //要確保段整日期皆可擺放在此row，如果沒有，則往下一個row
                                        if(!$found){

                                            foreach($splited_date as $date_key=>$date){
                                                
                                                if(isset($occupied_all_month_records[$specific_month][$row][$date])){//此日期在此row 已不可使用
                                                    break;
                                                }

                                                if($date_key == (count($splited_date)-1)){//表示整段區間在此row 可使用

                                                    $found = true;        
                                                }
                                            }
                                        }
                                    }

                                    if($found){
                                        break;
                                    }
                                }

                                if($found){

                                    //開始擺放日期
                                    foreach($splited_date as $date_key=>$date){
                                        $occupied_all_month_records[$specific_month][$row][$date] = true;
                                    }

                                    $temp = array();
                                    $temp['name'] = $adslot['info']['region'].'_'.$adslot['info']['adslotGroup'];

                                    if(!isset($adslot_colors_mapping[$temp['name']])){
                                        $adslot_colors_mapping[$temp['name']] = $adslot_colors[array_rand($adslot_colors)];
                                    }

                                    $temp['dates'] = $splited_date;
                                    $all_month_records[$specific_month][$row][] = $temp;
                                }
                                else{
                                    if(!$exception){
                                        if(!isset($occupied_all_month_records[$specific_month][$row+1])){
                                            $occupied_all_month_records[$specific_month][$row+1] = array();
                                            //開始擺放日期
                                            foreach($splited_date as $date_key=>$date){
                                                $occupied_all_month_records[$specific_month][$row+1][$date] = true;
                                            }

                                            $temp = array();
                                            $temp['name'] = $adslot['info']['region'].'_'.$adslot['info']['adslotGroup'];
                                            if(!isset($adslot_colors_mapping[$temp['name']])){
                                                $adslot_colors_mapping[$temp['name']] = $adslot_colors[array_rand($adslot_colors)];
                                            }
                                            $temp['dates'] = $splited_date;
                                            $all_month_records[$specific_month][$row+1][] = $temp;
                                        }
                                    }
                                }
                            }
                        }
                        else{//沒有跨月份
                            //用區間的第一天去判斷是哪一個月份
                            $specific_month = date('Y-m',strtotime($dates[0]));
                            $found = false;
                            $exception = false;
                            if(empty($occupied_all_month_records[$specific_month])){
                                $occupied_all_month_records[$specific_month][0] = array();
                            }
                            foreach($occupied_all_month_records[$specific_month] as $row=>$row_data){
                                if(empty($occupied_all_month_records[$specific_month][$row])){//代表此row 都還可以用
                                    //開始擺放日期
                                    $occupied_all_month_records[$specific_month][$row] = array();

                                    foreach($dates as $date_key=>$date){
                                        $occupied_all_month_records[$specific_month][$row][$date] = true;
                                    }

                                    $temp = array();
                                    $temp['name'] = $adslot['info']['region'].'_'.$adslot['info']['adslotGroup'];
                                    if(!isset($adslot_colors_mapping[$temp['name']])){
                                        $adslot_colors_mapping[$temp['name']] = $adslot_colors[array_rand($adslot_colors)];
                                    }
                                    $temp['dates'] = $dates;
                                    $all_month_records[$specific_month][$row][] = $temp;
                                    $exception = true;
                                }
                                else{
                                    //要確保段整日期皆可擺放在此row，如果沒有，則往下一個row
                                    if(!$found){
                                        foreach($dates as $date_key=>$date){
                                            if(isset($occupied_all_month_records[$specific_month][$row][$date])){//此日期在此row 已不可使用
                                                break;
                                            }

                                            if($date_key == (count($dates)-1)){//表示整段區間在此row 可使用
                                                $found = true;        
                                            }
                                        }
                                    }
                                }

                                if($found){
                                    break;
                                }
                            }

                            if($found){
                                //開始擺放日期
                                foreach($dates as $date_key=>$date){
                                    $occupied_all_month_records[$specific_month][$row][$date] = true;
                                }

                                $temp = array();
                                $temp['name'] = $adslot['info']['region'].'_'.$adslot['info']['adslotGroup'];
                                if(!isset($adslot_colors_mapping[$temp['name']])){
                                    $adslot_colors_mapping[$temp['name']] = $adslot_colors[array_rand($adslot_colors)];
                                }
                                $temp['dates'] = $dates;
                                $all_month_records[$specific_month][$row][] = $temp;
                            }
                            else{
                                if(!$exception){
                                    if(!isset($occupied_all_month_records[$specific_month][$row+1])){
                                        $occupied_all_month_records[$specific_month][$row+1] = array();
                                        //開始擺放日期
                                        foreach($dates as $date_key=>$date){
                                            $occupied_all_month_records[$specific_month][$row+1][$date] = true;
                                        }

                                        $temp = array();
                                        $temp['name'] = $adslot['info']['region'].'_'.$adslot['info']['adslotGroup'];
                                        if(!isset($adslot_colors_mapping[$temp['name']])){
                                            $adslot_colors_mapping[$temp['name']] = $adslot_colors[array_rand($adslot_colors)];
                                        }
                                        $temp['dates'] = $dates;
                                        $all_month_records[$specific_month][$row+1][] = $temp;
                                    }
                                }
                            }
                        }
                        
                    }
                }

            }
        }
        
        

        /**
         * 排序row 裡的版位，日期較早的排在前
         * */
        foreach($all_month_records as $year_month=>$rows){
            foreach($rows as $rows_key=>$row){
                    usort($all_month_records[$year_month][$rows_key], [$this, 'compare_date_keys']);
            }
        }

        // echo "<pre>";print_r($all_month_records);echo "</pre>";exit;
        // echo "<pre>";print_r($adslot_colors_mapping);echo "</pre>";exit;

        // $styleArray = [
            // 'font' => [
        //         'bold' => true,
        //     ],
        //     'alignment' => [
        //         'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
        //     ],
        //     'borders' => [
        //         'top' => [
        //             'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        //         ],
        //     ],
        //     'fill' => [
        //         'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
        //         'rotation' => 90,
        //         'startColor' => [
        //             'argb' => 'FFA0A0A0',
        //         ],
        //         'endColor' => [
        //             'argb' => 'FFFFFFFF',
        //         ],
        //     ],
        // ];

        /**
         * 定義cell styles
         * */

        $dateStyles = [
            'font' => [
                'size' => 6,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ];

        $adslotStyles = [
            'font' => [
                'size' => 10,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ];

        /**
         * 從第3行開始寫資料，第1, 2 行放title
         * */
        $start_row_index = 3;

        /**
         * 從第3列開始寫資料，第1, 2 列放月份
         * */
        $start_column_index = 3;        

        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();

        /**
         * 設定
         * */
        $activeWorksheet->getColumnDimension('A')->setWidth(3);
        $activeWorksheet->getColumnDimension('B')->setWidth(3);

        foreach($all_month_records as $year_month=>$rows){

            /**
             * 產生year-month
            //  * */
            $activeWorksheet->setCellValue( 'A'.$start_row_index, $year_month )->getStyle('A'.$start_row_index)->applyFromArray($dateStyles);

            /**
             * 產生weekday
             * */
            for($i=0; $i< date('t',strtotime($year_month)) ; $i++){
                
                $weekday = $this->get_chinese_weekday(date('Y-m-d',strtotime($year_month.'-01'." +".$i."days")));
                $activeWorksheet->setCellValue($this->num_to_letters($start_column_index+$i).($start_row_index), $weekday )->getStyle($this->num_to_letters($start_column_index+$i).($start_row_index))->applyFromArray($dateStyles);
                /**
                 * 設定column width
                 * */
                $activeWorksheet->getColumnDimension($this->num_to_letters($start_column_index+$i))->setWidth(5);
            }
            $start_row_index++;

            /**
             * 產生日期
             * */
            for($i=1; $i<= date('t',strtotime($year_month)) ; $i++){
                
                $date = date('m/d',strtotime($year_month.'-'.$i));
                $activeWorksheet->setCellValue($this->num_to_letters($start_column_index+($i-1)).($start_row_index), $date )->getStyle($this->num_to_letters($start_column_index+($i-1)).($start_row_index))->applyFromArray($dateStyles);
            }
            $start_row_index++;

            /**
             * merge year month
             * */
            $activeWorksheet->mergeCells('A'.(3*count($rows)).':B'.($start_row_index+(count($rows)-1)), Worksheet::MERGE_CELL_CONTENT_MERGE);
            $activeWorksheet->getStyle('A'.(3*count($rows)).':B'.($start_row_index+(count($rows)-1)))->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB( $year_month_colors[array_rand($year_month_colors)] );


            /**
             * 產生內容
             * */

            foreach($rows as $rows_key=>$row){
                foreach($row as $row_key=>$adslot){
                    $cell_start_date = $adslot['dates'][array_key_first($adslot['dates'])];
                    $cell_end_date = $adslot['dates'][array_key_last($adslot['dates'])];

                    $cell_start_column = $start_column_index+( date('j',strtotime($cell_start_date)) )-1;
                    $cell_end_column = $start_column_index+( date('j',strtotime($cell_end_date)) )-1;


                    $activeWorksheet->setCellValue($this->num_to_letters($cell_start_column).($start_row_index), $adslot['name'] )->getStyle($this->num_to_letters($cell_start_column).($start_row_index))->applyFromArray($adslotStyles);
                    
                    $activeWorksheet->mergeCells($this->num_to_letters($cell_start_column).($start_row_index).':'.$this->num_to_letters($cell_end_column).($start_row_index), Worksheet::MERGE_CELL_CONTENT_MERGE);
                    
                    $activeWorksheet->getStyle( $this->num_to_letters($cell_start_column).($start_row_index) )->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB( $adslot_colors_mapping[$adslot['name']] );

                    $activeWorksheet->getRowDimension($start_row_index)->setRowHeight(25);
                }
                $start_row_index++;
            }

            

            
        }
                 

        // exit;
        // $activeWorksheet->setCellValue('A1', date('Y年m月',strtotime('2023-10')))->getStyle('A1')->getAlignment()->setHorizontal('center')->setVertical('center');
        // $activeWorksheet->mergeCells('A1:B3', Worksheet::MERGE_CELL_CONTENT_MERGE);
        // $activeWorksheet->getStyle('A1:B3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF0000');
        
        

        // $spreadsheet->getActiveSheet()->getStyle('A1')->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);
        // $spreadsheet->getActiveSheet()->getStyle('A3')->applyFromArray($styleArray);

        $writer = new Xlsx($spreadsheet);
        $writer->save($path = storage_path('排期表.xlsx'));

        return response()->download($path)->deleteFileAfterSend();
    }

    public function cuePreviewForm(){
        $insertions = Session::get('insertions');
        // echo "<pre>";print_r($insertions);echo "</pre>";exit;

        /**
         * 判斷月份區間
         * 需先重新go through 一次data ranges
         * */
        $all_dates = array();
        $all_month_records = array();
        $occupied_all_month_records = array();
        foreach($insertions as $insertion_type => $insertion){
            foreach($insertion as $combination_key=>$adslot){
                
                //如果$adslot['info'][0] 存在，則代表這個adslot 是成效型
                if(!isset($adslot['info'][0])){//只需看非成效型的日期
                    foreach($adslot['info']['dateRanges'] as $date_range_key=>$dates){
                        foreach($dates as $date_key=>$date){
                            $all_dates[] = $date;
                        }
                    }
                }

            }
        }

        /**
         * 列出所有不重覆的日期
         * */
        sort($all_dates);
        $all_dates = array_unique($all_dates);

        $start_date = $all_dates[array_key_first($all_dates)];
        $end_date = $all_dates[array_key_last($all_dates)];


        /**
         * 列出所有不重覆的月份
         * */
        $start    = (new DateTime($start_date))->modify('first day of this month');
        $end      = (new DateTime($end_date))->modify('first day of next month');
        $interval = DateInterval::createFromDateString('1 month');
        $period   = new DatePeriod($start, $interval, $end);

        foreach ($period as $dt) {
            $all_month_records[$dt->format("Y-m")] = array();
            $occupied_all_month_records[$dt->format("Y-m")] = array();
        }

        
        /**
         * 將版位按
         * 1）月份分類
         * 2）按row 擺放（需先檢查此row、此日期區間是否全空下來）
         * */
        foreach($insertions as $insertion_type => $insertion){
            foreach($insertion as $combination_key=>$adslot){
                

                //如果$adslot['info'][0] 存在，則代表這個adslot 是成效型
                if(!isset($adslot['info'][0])){//排期表，只排"非成效型"
                    foreach($adslot['info']['dateRanges'] as $date_range_key=>$dates){
                        /**
                         * 如果日期區間是跨月份的，則先分好月份，再來檢查
                         * */
                        if($this->checkIfCrossMonths($dates)){//有跨月份
                            
                            $splited_dates = $this->splitDatesByMonth($dates);

                            foreach($splited_dates as $splited_dates_key=>$splited_date){
                                //用區間的第一天去判斷是哪一個月份
                                $specific_month = date('Y-m',strtotime($splited_date[0]));
                                $found = false;
                                $exception = false;
                                if(empty($occupied_all_month_records[$specific_month])){
                                    $occupied_all_month_records[$specific_month][0] = array();
                                }

                                foreach($occupied_all_month_records[$specific_month] as $row=>$row_data){

                                    if(empty($occupied_all_month_records[$specific_month][$row])){//代表此row 都還可以用
                                        //開始擺放日期
                                        $occupied_all_month_records[$specific_month][$row] = array();

                                        foreach($splited_date as $date_key=>$date){
                                            $occupied_all_month_records[$specific_month][$row][$date] = true;
                                        }

                                        $temp = array();
                                        $temp['name'] = $adslot['info']['region'].'_'.$adslot['info']['adslotGroup'];
                                        $temp['dates'] = $splited_date;
                                        $all_month_records[$specific_month][$row][] = $temp;
                                        $exception = true;
                                    }
                                    else{
                                        //要確保段整日期皆可擺放在此row，如果沒有，則往下一個row
                                        if(!$found){

                                            foreach($splited_date as $date_key=>$date){
                                                
                                                if(isset($occupied_all_month_records[$specific_month][$row][$date])){//此日期在此row 已不可使用
                                                    break;
                                                }

                                                if($date_key == (count($splited_date)-1)){//表示整段區間在此row 可使用

                                                    $found = true;        
                                                }
                                            }
                                        }
                                    }

                                    if($found){
                                        break;
                                    }
                                }

                                if($found){

                                    //開始擺放日期
                                    foreach($splited_date as $date_key=>$date){
                                        $occupied_all_month_records[$specific_month][$row][$date] = true;
                                    }

                                    $temp = array();
                                    $temp['name'] = $adslot['info']['region'].'_'.$adslot['info']['adslotGroup'];
                                    $temp['dates'] = $splited_date;
                                    $all_month_records[$specific_month][$row][] = $temp;
                                }
                                else{
                                    if(!$exception){
                                        if(!isset($occupied_all_month_records[$specific_month][$row+1])){
                                            $occupied_all_month_records[$specific_month][$row+1] = array();
                                            //開始擺放日期
                                            foreach($splited_date as $date_key=>$date){
                                                $occupied_all_month_records[$specific_month][$row+1][$date] = true;
                                            }

                                            $temp = array();
                                            $temp['name'] = $adslot['info']['region'].'_'.$adslot['info']['adslotGroup'];
                                            $temp['dates'] = $splited_date;
                                            $all_month_records[$specific_month][$row+1][] = $temp;
                                        }
                                    }
                                }
                            }
                        }
                        else{//沒有跨月份
                            //用區間的第一天去判斷是哪一個月份
                            $specific_month = date('Y-m',strtotime($dates[0]));
                            $found = false;
                            $exception = false;
                            if(empty($occupied_all_month_records[$specific_month])){
                                $occupied_all_month_records[$specific_month][0] = array();
                            }
                            foreach($occupied_all_month_records[$specific_month] as $row=>$row_data){
                                if(empty($occupied_all_month_records[$specific_month][$row])){//代表此row 都還可以用
                                    //開始擺放日期
                                    $occupied_all_month_records[$specific_month][$row] = array();

                                    foreach($dates as $date_key=>$date){
                                        $occupied_all_month_records[$specific_month][$row][$date] = true;
                                    }

                                    $temp = array();
                                    $temp['name'] = $adslot['info']['region'].'_'.$adslot['info']['adslotGroup'];
                                    $temp['dates'] = $dates;
                                    $all_month_records[$specific_month][$row][] = $temp;
                                    $exception = true;
                                }
                                else{
                                    //要確保段整日期皆可擺放在此row，如果沒有，則往下一個row
                                    if(!$found){
                                        foreach($dates as $date_key=>$date){
                                            if(isset($occupied_all_month_records[$specific_month][$row][$date])){//此日期在此row 已不可使用
                                                break;
                                            }

                                            if($date_key == (count($dates)-1)){//表示整段區間在此row 可使用
                                                $found = true;        
                                            }
                                        }
                                    }
                                }

                                if($found){
                                    break;
                                }
                            }

                            if($found){
                                //開始擺放日期
                                foreach($dates as $date_key=>$date){
                                    $occupied_all_month_records[$specific_month][$row][$date] = true;
                                }

                                $temp = array();
                                $temp['name'] = $adslot['info']['region'].'_'.$adslot['info']['adslotGroup'];
                                $temp['dates'] = $dates;
                                $all_month_records[$specific_month][$row][] = $temp;
                            }
                            else{
                                if(!$exception){
                                    if(!isset($occupied_all_month_records[$specific_month][$row+1])){
                                        $occupied_all_month_records[$specific_month][$row+1] = array();
                                        //開始擺放日期
                                        foreach($dates as $date_key=>$date){
                                            $occupied_all_month_records[$specific_month][$row+1][$date] = true;
                                        }

                                        $temp = array();
                                        $temp['name'] = $adslot['info']['region'].'_'.$adslot['info']['adslotGroup'];
                                        $temp['dates'] = $dates;
                                        $all_month_records[$specific_month][$row+1][] = $temp;
                                    }
                                }
                            }
                        }
                        
                    }
                }

            }
        }
        
        // echo "<pre>";print_r($insertions);echo "</pre>";exit;
        // echo "<pre>";print_r($occupied_all_month_records);echo "</pre>";
        // echo "<pre>";print_r($all_month_records);echo "</pre>";exit;

        /**
         * 排序row 裡的版位，日期較早的排在前
         * */
        foreach($all_month_records as $year_month=>$rows){
            foreach($rows as $rows_key=>$row){
                    usort($all_month_records[$year_month][$rows_key], [$this, 'compare_date_keys']);
            }
        }
        
        $return = array();
        $return['modelContent'] = view('partials.modals.ad-schedule._cue-preview-form',['all_month_records'=>$all_month_records])->render();

        return json_encode($return);
    }

    public function compare_date_keys($date1, $date2) {
        // echo "<pre>";print_r($date1);echo "</pre>";exit;
        return strtotime($date1['dates'][0]) - strtotime($date2['dates'][0]);
    }

    private function splitDatesByMonth($all_dates){
        $by_month = array();

        foreach($all_dates as $key=>$date){
            $month = date('Y-m',strtotime($date));
            if(isset($by_month[$month])){
                $by_month[$month][] = $date;
            }
            else{
                $by_month[$month] = array();
                $by_month[$month][] = $date;   
            }
        }

        return $by_month;
    }

    private function checkIfCrossMonths($all_dates){
        $start_date = $all_dates[array_key_first($all_dates)];
        $end_date = $all_dates[array_key_last($all_dates)];


        /**
         * 列出所有不重覆的月份
         * */
        $start    = (new DateTime($start_date))->modify('first day of this month');
        $end      = (new DateTime($end_date))->modify('first day of next month');
        $interval = DateInterval::createFromDateString('1 month');
        $period   = new DatePeriod($start, $interval, $end);

        $count = array();
        foreach ($period as $dt) {
            $count[$dt->format("Y-m")] = array();
        }

        if(count($count) > 1){
            //跨月份的版位
            return true;
        }

        //非跨月份的版位
        return false;
    }

    public function deleteInsertionForm(Request $request){

        $insertion = $this->insertionRepository->findInsertionById($request->insertion_id);

        // echo $insertion->id;exit;
        
        $return = array();
        $return['modelContent'] = view('partials.modals.ad-schedule._delete-insertion-form',['insertion'=>$insertion])->render();

        return json_encode($return);
    }

    public function deleteInsertion(Request $request){
        // echo "<pre>";print_r($request->all());echo "</pre>";exit;
        $this->insertionRepository->deleteInsertion($request->insertion_id);

        $return = array();
        $return['message'] = __('ad-schedule.delete-success');

        return json_encode($return);

    }

    public function storeToTemp(Request $request)
    {
        // echo "<pre>";print_r($request->all());echo "</pre>";exit;

        /**
         * 轉暫存時：
         * 1）產品名稱為必填
         * 
         * 2）客戶產業如果是房產類時，所在地才會是必填
         * */
        $rules = [
            'customer_industry'      =>  'required|max:255',
            'city'      =>  'required_if:customer_industry, ==, 1|max:255',
            'district'      =>  'required_if:customer_industry, ==, 1|max:255',
            'product_name'      =>  'required|max:255',
        ];

        $validation = Validator::make(
            $request->all(),$rules
        );

        if ($validation->fails()) {
            $fieldsWithErrorMessagesArray = $validation->messages()->get('*');

            $error_messages = array();

            foreach($fieldsWithErrorMessagesArray as $name=>$msg){
                $error_messages[$name]=$msg[0];
            }

            throw ValidationException::withMessages($error_messages);
        }

        $insertions = Session::get('insertions');

        /**
         * 如果有insertion_id, 則為update
         * */

        $referrer = $request->header('Referer');
        $url_parts = parse_url($referrer);
        if(isset($url_parts['query'])){
            $url_params = explode('=',$url_parts['query']);
            $insertion_id = $url_params[1];
        }
        else{
            $insertion_id = null;   
        }
        
        // echo "<pre>";print_r($insertions);echo "</pre>";exit;
        
        if(!is_null($insertion_id)){
            $insertion = $this->insertionRepository->updateInsertionById($insertion_id, $request->all(), $insertions);
        }
        else{
            $insertion = $this->insertionRepository->saveToTemp($request->all(), $insertions);    
        }

        if ($insertion) {
            return redirect()->route('ad-schedule.edit',['insertion_id'=>$insertion])->with('save_insertion_message', 'store_to_temp_success');
        }
        else{

            // /** Activity Log START **/
            // activity()->causedBy(Auth::user())->withProperty('action','user.create_product')->log(trans('activity_log.user_create_product_success'));
            // /** Activity Log END **/

            return redirect()->route('ad-schedule.edit')->with('save_insertion_message', 'store_to_temp_failed');
        }
        
    }

    public function turnToStandby(Request $request)
    {
        $referrer = $request->header('Referer');
        $url_parts = parse_url($referrer);
        if(isset($url_parts['query'])){
            $url_params = explode('=',$url_parts['query']);
            $insertion_id = $url_params[1];
        }
        else{
            $insertion_id = null;   
        }
        

        /**
         * 轉standby 時：
         * 1）客戶名稱為必填
         * 2）客戶產業為必填
         * 3）所在地必填
         * 4）產品名稱為必填
         * 5）細項名稱為必填
         * */

        $rules = [
            'customer_name'      =>  'required|max:255',
            'customer_industry'      =>  'required|max:255',
            'city'      =>  'required|max:255',
            'district'      =>  'required_|max:255',
            'product_name'      =>  'required|max:255',
            'product_detail_name'      =>  'max:255',
        ];

        $validation = Validator::make(
            $request->all(),$rules
        );

        if ($validation->fails()) {
            $fieldsWithErrorMessagesArray = $validation->messages()->get('*');

            $error_messages = array();

            foreach($fieldsWithErrorMessagesArray as $name=>$msg){
                $error_messages[$name]=$msg[0];
            }

            throw ValidationException::withMessages($error_messages);
        }

        $insertions = Session::get('insertions');

        /**
         * 先暫存，再轉為standby
         * */
        /**
         * 可能之狀況
         * 1）暫存=>轉Standby(如果有insertion_id,表示已有暫存, 則為update)
         * 或
         * 2）直接轉Standby
         * */
        if(!is_null($insertion_id)){
            $insertion = $this->insertionRepository->updateInsertionById($insertion_id, $request->all(), $insertions);
        }
        else{
            $insertion = $this->insertionRepository->saveToTemp($request->all(), $insertions);    
        }

        /**
         * 將已暫存的insertion 轉為standby
         * */
        $insertion = $this->insertionRepository->turnToStandby($insertion->id);
        
        if ($insertion) {
            $insertion = $this->insertionRepository->findInsertionById($insertion->id);
            return redirect()->route('ad-schedule.list')->with('save_insertion_message', 'turn_to_standby_success');
        }
        else{

            // /** Activity Log START **/
            // activity()->causedBy(Auth::user())->withProperty('action','user.create_product')->log(trans('activity_log.user_create_product_success'));
            // /** Activity Log END **/

            return redirect()->route('ad-schedule.list')->with('save_insertion_message', 'turn_to_standby_failed');
        }
        
    }

    public function turnToStandbyWithInsertion(Request $request)
    {
        $referrer = $request->header('Referer');
        $url_parts = parse_url($referrer);
        if(isset($url_parts['query'])){
            $url_params = explode('=',$url_parts['query']);
            $insertion_id = $url_params[1];
        }
        else{
            $insertion_id = null;   
        }
        

        /**
         * 轉standby 時：
         * 1）客戶名稱為必填
         * 2）客戶產業為必填
         * 3）所在地必填
         * 4）產品名稱為必填
         * 5）細項名稱為必填
         * */

        $rules = [
            'customer_name'      =>  'required|max:255',
            'customer_industry'      =>  'required|max:255',
            'city'      =>  'required|max:255',
            'district'      =>  'required_|max:255',
            'product_name'      =>  'required|max:255',
            'product_detail_name'      =>  'max:255',
        ];

        $validation = Validator::make(
            $request->all(),$rules
        );

        if ($validation->fails()) {
            $fieldsWithErrorMessagesArray = $validation->messages()->get('*');

            $error_messages = array();

            foreach($fieldsWithErrorMessagesArray as $name=>$msg){
                $error_messages[$name]=$msg[0];
            }

            throw ValidationException::withMessages($error_messages);
        }

        $insertions = Session::get('insertions');

        /**
         * 先暫存，再轉為standby
         * */
        /**
         * 可能之狀況
         * 1）暫存=>轉委刊單(如果有insertion_id,表示已有暫存, 則為update)
         * 或
         * 2）直接轉委刊單
         * */

        // echo "<pre>";print_r($request->all());echo "</pre>";exit;
        if(!is_null($insertion_id)){
            $insertion = $this->insertionRepository->updateInsertionById($insertion_id, $request->all(), $insertions);
        }
        else{
            $insertion = $this->insertionRepository->saveToTemp($request->all(), $insertions);    
        }

        /**
         * 將已暫存的insertion 轉為standby
         * */
        $insertion = $this->insertionRepository->turnToStandbyWithInsertion($insertion->id);
        
        if ($insertion) {
            $insertion = $this->insertionRepository->findInsertionById($insertion->id);
            return redirect()->route('ad-management.insertion-list')->with('save_insertion_message', 'turn_to_standby_with_insertion_success');
        }
        else{

            // /** Activity Log START **/
            // activity()->causedBy(Auth::user())->withProperty('action','user.create_product')->log(trans('activity_log.user_create_product_success'));
            // /** Activity Log END **/
            return redirect()->route('ad-management.insertion-list')->with('save_insertion_message', 'turn_to_standby_with_insertion_failed');

        }
        
    }

    public function num_to_letters( $num , $uppercase = true):string {
        $letters = '';
        while ($num > 0) {
            $code = ($num % 26 == 0) ? 26 : $num % 26;
            $letters .= chr($code + 64);
            $num = ($num - $code) / 26;
        }
        return ($uppercase) ? strtoupper(strrev($letters)) : strrev($letters);
    }

    public function get_chinese_weekday($datetime)
    {
        $weekday  = date('w', strtotime($datetime));
        $weeklist = array('日', '一', '二', '三', '四', '五', '六');
        return $weeklist[$weekday];
    }
}
