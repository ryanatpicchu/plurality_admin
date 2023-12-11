<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\Session;
use DateTime;
use DateInterval;
use DatePeriod;

class CueExport implements FromView
{
    public function view(): View
    {
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

        return view('exports.cue', [
            'all_month_records' => $all_month_records
        ]);
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
}
