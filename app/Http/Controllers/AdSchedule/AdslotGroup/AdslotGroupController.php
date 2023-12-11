<?php

namespace App\Http\Controllers\AdSchedule\AdslotGroup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contracts\ChannelContract;
use App\Contracts\ChannelGroupContract;
use App\Contracts\RegionContract;
use App\Contracts\AdslotGroupContract;
use App\Contracts\InsertionContract;
use Illuminate\Support\Facades\Session;

class AdslotGroupController extends Controller
{
    protected $channelRepository;
    protected $adslotGroupRepository;
    protected $channelGroupRepository;
    protected $regionRepository;
    protected $insertionRepository;

    public function __construct(ChannelContract $channelRepository, AdslotGroupContract $adslotGroupRepository, ChannelGroupContract $channelGroupRepository, RegionContract $regionRepository, InsertionContract $insertionRepository)
    {
        $this->channelRepository = $channelRepository;
        $this->adslotGroupRepository = $adslotGroupRepository;
        $this->channelGroupRepository = $channelGroupRepository;
        $this->regionRepository = $regionRepository;
        $this->insertionRepository = $insertionRepository;
    }

    public function list(Request $request)
    {
        $request_channel_id = $request->channel_id;
        $channel = $this->channelRepository->findChannelById($request_channel_id);
        $available_regions = $channel->relatedRegion;
        $return = array();
        $return['modelContent'] = view('partials.modals.ad-schedule._adslot-group-list',
            [
                'request_channel_id'=>$request_channel_id,
                'available_regions'=>$available_regions
            ]
        )->render();

        return json_encode($return);
    }

    public function dateForm(Request $request){
        
        // echo "<pre>";print_r($request->all());echo "</pre>";exit;
        $region = $this->regionRepository->findRegionById($request->region_id);
        $adslot_group = $this->adslotGroupRepository->findAdslotGroupById($request->adslot_group_id);

        if(strtotime($request->start_date) > strtotime($request->end_date)){
            $start_date = $request->end_date;
            $end_date = $request->start_date;
        }
        else{
            $start_date = $request->start_date;
            $end_date = $request->end_date;   
        }

        $datediff = strtotime($end_date)- strtotime($start_date);
        $days = round($datediff / (60 * 60 * 24))+1;

        $return = array();
        $return['modelContent'] = view('partials.modals.ad-schedule._adslot-group-date-form',
            [
            'region'=>$region,
            'channel_group'=>$adslot_group->channelGroup,
            'adslot_group'=>$adslot_group,
            'start_date'=>$start_date,
            'end_date'=>$end_date,
            'days'=>$days,
            'region_id'=>$request->region_id,
            'channel_group_id'=>$request->channel_group_id,
            'adslot_group_id'=>$adslot_group->id,
            'row'=>$request->row
            ])->render();

        return json_encode($return);
    }

    public function modifyAdslotDateRange(Request $request){
        // echo "<pre>";print_r($request->all());echo "</pre>";exit;

        $request->validate([
            'start_date'    => 'required|date',
            'end_date'      => 'required|date|after:start_date',
        ]);

        $datediff = strtotime($request->end_date) - strtotime($request->start_date);

        $days = round($datediff / (60 * 60 * 24))+1;

        $return = array();

        $return['element_id'] = $request->element_id;
        $return['new_grid_column'] = strval($request->start_index).'/'.strval($request->start_index+$days);
        $return['end_date'] = $request->end_date;

        return json_encode($return);
    }

    public function confirmAdslotDateRange(Request $request){
        // echo "<pre>";print_r($request->all());echo "</pre>";exit;

        
        $datediff = strtotime($request->end_date) - strtotime($request->start_date);
        $days = round($datediff / (60 * 60 * 24))+1;

        $return = array();
        $all_dates = array();

        for($d=0;$d<$days;$d++){
            $temp = '';
            $temp = date('Y-m-d',strtotime($request->start_date." + ".$d." days"));
            $all_dates[] = $temp;
        }

        $return['region_id'] = $request->region_id;
        $return['channel_group_id'] = $request->channel_group_id;
        $return['adslot_group_id'] = $request->adslot_group_id;
        $return['row'] = $request->row;
        $return['all_dates'] = $all_dates;

        return json_encode($return);
    }

    public function confirmAdSlotGroupsForm(Request $request){
        
        Session::forget('tempSelectedAdslotGroups');

        $selected_adslot_groups = json_decode($request->selected_adslot_groups,true);

        $confirm_adslot_groups = array();

        /**
         * group all the cell by postions first
         * adslot_group_cells 的key 是adslot group row
         * */

        $adslot_group_cells = array();
        foreach($selected_adslot_groups as $key=>$selected_adslot_group){
            $temp = array();
            
            $adslot_group_row = '';

            $adslot_group_row .= $selected_adslot_group['region_id'].'_'.
            $selected_adslot_group['channel_group_id'].'_'.
            $selected_adslot_group['adslot_group_id'].'_'.
            $selected_adslot_group['row'];

            if(isset($adslot_group_cells[$adslot_group_row])){
                $temp = array();
                $temp['date'] = $selected_adslot_group['date'];
                $adslot_group_cells[$adslot_group_row][$selected_adslot_group['date']] = $temp;
            }
            else{
                $adslot_group_cells[$adslot_group_row] = array();

                $temp = array();
                $temp['date'] = $selected_adslot_group['date'];
                $adslot_group_cells[$adslot_group_row][$selected_adslot_group['date']] = $temp;
            }

        }
        
        $return = array();
        $check_result = $this->checkAdslotGroupCells($adslot_group_cells);

        // echo "<pre>";print_r($adslot_group_cells);echo "</pre>";exit;

        if($check_result !== true){
            //發生錯誤
            $return['status'] = false;
            $return['message'] = __('ad-schedule.adslot-group-spec-error');
            $return['error_row'] = $check_result;
        
        }
        else{
            /**
             * 所選版位符合規格
             * */
            $confirm_adslot_groups = array();

            foreach($adslot_group_cells as $adslot_group_row_key=>$cells){
                $exploded = explode("_", $adslot_group_row_key);
                $region_id = $exploded[0];
                $channel_group_id = $exploded[1];
                $adslot_group_id = $exploded[2];
                
                $adslot_group = $this->adslotGroupRepository->findAdslotGroupById($adslot_group_id);
                $region = $this->regionRepository->findRegionById($region_id);

                $temp = array();
                $temp['channelId'] = $adslot_group->channelGroup->channel->id;
                $temp['channel'] = $adslot_group->channelGroup->channel->name;

                $temp['regionId'] = $region->id;
                $temp['region'] = $region->name;

                $temp['channelGroupId'] = $adslot_group->channelGroup->id;
                $temp['channelGroup'] = $adslot_group->channelGroup->name;

                $temp['adslotGroupId'] = $adslot_group->id;
                $temp['adslotGroup'] = $adslot_group->name;
                $temp['days'] = 0;
                

                $temp['list_price'] = isset($adslot_group->availableAdslotByRegion($region->id)->list_price)?$adslot_group->availableAdslotByRegion($region->id)->list_price:0;
                $temp['discount_percentage'] = 0;
                $temp['note'] = isset($adslot_group->availableAdslotByRegion($region->id)->note)?$adslot_group->availableAdslotByRegion($region->id)->note:'';
                $temp['dateRanges'] = array();
                

                //每個購買單位的最少限制
                if(isset($adslot_group->availableAdslotByRegion($region->id)->days)){
                    $adslot_days_limitation = $adslot_group->availableAdslotByRegion($region->id)->days;
                }
                else{
                    $adslot_days_limitation = 1;
                }

                $temp_dates = array();

                if($adslot_group->channelGroup->channel->name == '591'){
                    foreach($cells as $date_key=>$date){

                        $temp_dates[] = $date_key;

                        if(count($temp_dates) == $adslot_days_limitation){
                            $temp['dateRanges'][] = $temp_dates;
                            $temp['days'] += count($temp_dates);
                            $temp_dates = array();
                        }
                    }    
                }
                else{
                    $temp_accumulate = array();
                    foreach($cells as $date_key=>$date){
                        $temp_accumulate[] = $date_key;
                    }

                    $temp['dateRanges'][] = $temp_accumulate;
                    $temp['days'] += count($cells);
                }

                $combination = $region_id.'_'.$channel_group_id.'_'.$adslot_group_id;
                if(isset($confirm_adslot_groups[$combination])){
                    foreach($temp['dateRanges'] as $dates_key=>$dates){
                        if($adslot_group->channelGroup->channel->name == '591'){
                            $confirm_adslot_groups[$combination]['info']['dateRanges'][] = $dates;    
                            $confirm_adslot_groups[$combination]['info']['days'] += count($dates);
                        }
                        else{
                            $array_last_key = array_key_last($confirm_adslot_groups[$combination]['info']['dateRanges']);
                            $confirm_adslot_groups[$combination]['info']['dateRanges'][$array_last_key] = array_merge($confirm_adslot_groups[$combination]['info']['dateRanges'][$array_last_key], $dates);
                            $confirm_adslot_groups[$combination]['info']['days'] += count($dates);
                        }
                        
                    }  
                }
                else{
                    $confirm_adslot_groups[$combination] = array();
                    $confirm_adslot_groups[$combination]['info'] = $temp;
                }
            }            

            /**
             * 需再針對【非591 站台】的版位，調整走期分配的方式
             * 例：
             * */
            
            foreach($confirm_adslot_groups as $key=>$adslot_group_info){
                /**
                 * 排序日期
                 * */
                foreach($adslot_group_info['info']['dateRanges'] as $dateRanges_key=>$chunk_dates){
                    sort($adslot_group_info['info']['dateRanges'][$dateRanges_key]);
                }

                if($adslot_group_info['info']['channel'] != '591'){
                    $adslot_group = $this->adslotGroupRepository->findAdslotGroupById($adslot_group_info['info']['adslotGroupId']);

                    //每個版位的規定販賣單位，例如：7天為一個單位
                    if(isset($adslot_group->availableAdslotByRegion($adslot_group_info['info']['regionId'])->days)){
                        $adslot_days_limitation = $adslot_group->availableAdslotByRegion($adslot_group_info['info']['regionId'])->days;
                    }
                    else{
                        $adslot_days_limitation = 1;
                    }

                    $confirm_adslot_groups[$key]['info']['dateRanges'] = array_chunk($adslot_group_info['info']['dateRanges'][0], $adslot_days_limitation);
                }
            }


            Session::put('tempSelectedAdslotGroups', $confirm_adslot_groups);

            $return['modelContent'] = view('partials.modals.ad-schedule._confirm-adslot-groups-form',['adslot_groups'=>$confirm_adslot_groups])->render();

        }

        return json_encode($return);
       
        
    }

    private function checkAdslotGroupCells($adslot_group_cells){
        
        $all_cells_count_non_591 = array();
        $all_dates_non_591 = array();
        foreach($adslot_group_cells as $adslot_group_row=>$cells){
            uksort($cells, [$this, 'compare_date_keys']);
            
            $temp = explode('_', $adslot_group_row);
            $region_id = $temp[0];
            $channel_group_id = $temp[1];
            $adslot_group_id = $temp[2];
            $row = $temp[3];
            
            $adslot_group = $this->adslotGroupRepository->findAdslotGroupById($adslot_group_id);

            //每個版位的規定販賣單位，例如：7天為一個單位
            if(isset($adslot_group->availableAdslotByRegion($region_id)->days)){
                $adslot_days_limitation = $adslot_group->availableAdslotByRegion($region_id)->days;
            }
            else{
                $adslot_days_limitation = 1;
            }

            /**
             * 【591】站台的版位選取規則有別於其它站台
             * 所選日期必須是要在同一個輪替(row) 裡
             * 不能跨輪替
             * */
            if($adslot_group->channelGroup->channel->name == '591'){
                //計算cells count 是否等於 adslot_days_limitation 的倍數
                $mod = count($cells)%$adslot_days_limitation;
                if( $mod != 0  ){
                    //發生錯誤
                    return $adslot_group_row;
                }
            }
            else{
                /**
                 * 【非】591站台的選取版位單元，全部加總後再一起判斷
                 * */
                if(isset($all_cells_count_non_591[$region_id.'_'.$channel_group_id.'_'.$adslot_group_id])){
                    $all_cells_count_non_591[$region_id.'_'.$channel_group_id.'_'.$adslot_group_id] += count($cells);
                }
                else{
                    $all_cells_count_non_591[$region_id.'_'.$channel_group_id.'_'.$adslot_group_id] = count($cells);    
                }

                foreach($cells as $cell_key=>$cell_date){
                    if(isset($all_dates_non_591[$region_id.'_'.$channel_group_id.'_'.$adslot_group_id])){
                        $all_dates_non_591[$region_id.'_'.$channel_group_id.'_'.$adslot_group_id][] = $cell_date['date'];
                    }
                    else{
                        $all_dates_non_591[$region_id.'_'.$channel_group_id.'_'.$adslot_group_id] = array();
                        $all_dates_non_591[$region_id.'_'.$channel_group_id.'_'.$adslot_group_id][] = $cell_date['date'];
                    }
                    
                }
                
            }
        }

        /**
         * 其它站台的cell counts 數量，【加起來】要符合規定的販賣單位
         * */
        foreach($all_cells_count_non_591 as $combination_key => $total_cell_counts){
            $temp = explode('_', $combination_key);
            $region_id = $temp[0];
            $adslot_group_id = $temp[2];
            $adslot_group = $this->adslotGroupRepository->findAdslotGroupById($adslot_group_id);

            //每個版位的規定販賣單位，例如：7天為一個單位
            if(isset($adslot_group->availableAdslotByRegion($region_id)->days)){
                $adslot_days_limitation = $adslot_group->availableAdslotByRegion($region_id)->days;
            }
            else{
                $adslot_days_limitation = 1;
            }

            $mod = $total_cell_counts%$adslot_days_limitation;
            if( $mod != 0  ){
                //發生錯誤
                return $combination_key;
            }
        }

        /**
         * 其它站台的adslot group 日期，符合規定販賣單位且需是連續的日期
         * */
        foreach($all_dates_non_591 as $combination_key=>$dates){
            sort($dates);
            $temp = explode('_', $combination_key);
            $region_id = $temp[0];
            $adslot_group_id = $temp[2];
            $adslot_group = $this->adslotGroupRepository->findAdslotGroupById($adslot_group_id);

            //每個版位的規定販賣單位，例如：7天為一個單位
            if(isset($adslot_group->availableAdslotByRegion($region_id)->days)){
                $adslot_days_limitation = $adslot_group->availableAdslotByRegion($region_id)->days;
            }
            else{
                $adslot_days_limitation = 1;
            }
            
            $temp_chunk = array_chunk($dates, $adslot_days_limitation);

            // echo "<pre>";print_r($temp_chunk);echo "</pre>";
            foreach($temp_chunk as $chunk_key=>$chunk_dates){
                $first_date = $chunk_dates[array_key_first($chunk_dates)];
                $last_date = $chunk_dates[array_key_last($chunk_dates)];

                
                if($last_date != date('Y-m-d', strtotime($first_date." + ".($adslot_days_limitation-1)." days"))){
                    // echo $chunk_key."\r\n";
                    // echo $first_date."\r\n";
                    // echo $last_date."\r\n";
                    // echo date('Y-m-d', strtotime($first_date." + ".($adslot_days_limitation-1)." days"));exit;
                    //發生錯誤
                    return $combination_key;
                }
            }
        }
        

        return true;
        
    }

    public function compare_date_keys($date1, $date2) {
        return strtotime($date1) - strtotime($date2);
    }

    public function compare_first_date_in_date_ranges($date1, $date2) {
        return strtotime($date1[0]) - strtotime($date2[0]);
    }

    public function goEditInsertion(){
        $selected_adslot_groups = Session::get('tempSelectedAdslotGroups');

        // echo "<pre>before : ";print_r($selected_adslot_groups);echo "</pre>";
        // echo "<pre>";print_r(Session::get('insertions'));echo "</pre>";

        $insertions = Session::get('insertions');

        //D type: 站內廣告
        //M type: 數字廣告
        foreach($selected_adslot_groups as $key=>$selected_adslot_group){

            if($selected_adslot_group['info']['channel'] == '數字廣告'){
                //如果選擇的版位已經存在了，則判斷是否有相同的日期區間
                if(isset($insertions['M'][$key])){
                    foreach($insertions['M'][$key]['info']['dateRanges'] as $date_key=>$dates){

                        $search_result = array_search($dates, $selected_adslot_group['info']['dateRanges']);

                        foreach($selected_adslot_group['info']['dateRanges'] as $adslot_group_key => $selected_date_ranges){
                            /**
                             * 有相同區間則移出
                             * */
                            if($dates == $selected_date_ranges){
                                unset($selected_adslot_groups[$key]['info']['dateRanges'][$search_result]);
                            }
                        }
                    }
                }
            }
            else{
                //如果選擇的版位已經存在了，則判斷是否有相同的日期區間
                if(isset($insertions['D'][$key])){
                    foreach($insertions['D'][$key]['info']['dateRanges'] as $date_key=>$dates){

                        $search_result = array_search($dates, $selected_adslot_group['info']['dateRanges']);

                        foreach($selected_adslot_group['info']['dateRanges'] as $adslot_group_key => $selected_date_ranges){
                            /**
                             * 有相同區間則移出
                             * */
                            if($dates == $selected_date_ranges){
                                unset($selected_adslot_groups[$key]['info']['dateRanges'][$search_result]);
                            }
                        }
                    }
                }    
            }
            
        }

        
        //D type: 站內廣告
        //M type: 數字廣告

        foreach($selected_adslot_groups as $key=>$selected_adslot_group){
            if($selected_adslot_group['info']['channel'] == '數字廣告'){
                //如果選擇的版位已經存在了，則合併
                if(isset($insertions['M'][$key])){
                    $insertions['M'][$key]['info']['dateRanges'] = array_merge($insertions['M'][$key]['info']['dateRanges'], $selected_adslot_groups[$key]['info']['dateRanges']);
                }
                else{
                    //如果選擇的版位尚未存在，則直接放入
                    $insertions['M'][$key] = array();
                    $insertions['M'][$key] = $selected_adslot_groups[$key];
                }
            }
            else{
                //如果選擇的版位已經存在了，則合併
                if(isset($insertions['D'][$key])){
                    $insertions['D'][$key]['info']['dateRanges'] = array_merge($insertions['D'][$key]['info']['dateRanges'], $selected_adslot_groups[$key]['info']['dateRanges']);
                }
                else{
                    //如果選擇的版位尚未存在，則直接放入
                    $insertions['D'][$key] = array();
                    $insertions['D'][$key] = $selected_adslot_groups[$key];
                }
            }
        }


        /**
         * 排序dateRanges 裡的日期
         * 
         * */
        foreach($insertions as $insertion_type => $adslot_groups){
            foreach($adslot_groups as $combination_key=>$adslot_group){
                if(isset($insertions[$insertion_type][$combination_key]['info']['dateRanges'])){
                    usort($insertions[$insertion_type][$combination_key]['info']['dateRanges'], [$this, 'compare_first_date_in_date_ranges']);
                }
                else{
                    foreach($insertions[$insertion_type][$combination_key]['info'] as $info_key=>$info){
                        usort($insertions[$insertion_type][$combination_key]['info'][$info_key]['dateRanges'], [$this, 'compare_first_date_in_date_ranges']);
                    }
                }
                
            }

        }

        // echo "<pre>";print_r($insertions);echo "</pre>";exit;

        Session::put('insertions', $insertions);



        return redirect()->route('ad-schedule.edit');
    }

    public function salesUnitSalePriceForm(Request $request){
        Session::forget('adslot_to_adjust_sales_unit_sale_price');
        $insertions = Session::get('insertions');

        // echo "<pre>";print_r($insertions);echo "</pre>";exit;
        // echo "<pre>";print_r($request->all());echo "</pre>";exit;

        $requested_adslot = json_decode($request->selected_adslot,true);

        $selected_adslot = array();

        foreach($insertions['R'] as $combination_key=>$ads){
            foreach($ads['info'] as $key=>$ad){
                if($combination_key == $request->combination_key){
                    if($key == $request->row){
                        $selected_adslot[$combination_key]['info'][$key] = $ads['info'][$request->row];
                    }
                }
            }
        }
        
        

        // echo "<pre>";print_r($insertions);echo "</pre>";
        // echo "<pre>";print_r($selected_adslot);echo "</pre>";exit;

        Session::put('adslot_to_adjust_sales_unit_sale_price', $selected_adslot);
        
        $return = array();
        $return['modelContent'] = view('partials.modals.ad-schedule._sales-unit-sale-price-form',
            [
                'selected_adslot'=>$selected_adslot,
                'subtotal_sale_price'=>$request->subtotal_sale_price,
                'row'=>$request->row,
                'combination_key'=>$request->combination_key,
            ]
        )->render();

        return json_encode($return);
    }

    public function agentSalesUnitSalePriceForm(Request $request){
        Session::forget('adslot_to_adjust_sales_unit_sale_price');
        $insertions = Session::get('insertions');

        // echo "<pre>";print_r($insertions);echo "</pre>";exit;
        // echo "<pre>";print_r($request->all());echo "</pre>";exit;

        $requested_adslot = json_decode($request->selected_adslot,true);

        $selected_adslot = array();

        foreach($insertions['A'] as $combination_key=>$ads){
            foreach($ads['info'] as $key=>$ad){
                if($combination_key == $request->combination_key){
                    if($key == $request->row){
                        $selected_adslot[$combination_key]['info'][$key] = $ads['info'][$request->row];
                    }
                }
            }
        }
        
        

        // echo "<pre>";print_r($insertions);echo "</pre>";
        // echo "<pre>";print_r($selected_adslot);echo "</pre>";exit;

        Session::put('adslot_to_adjust_sales_unit_sale_price', $selected_adslot);
        
        $return = array();
        $return['modelContent'] = view('partials.modals.ad-schedule._agent-sales-unit-sale-price-form',
            [
                'selected_adslot'=>$selected_adslot,
                'subtotal_sale_price'=>$request->subtotal_sale_price,
                'row'=>$request->row,
                'combination_key'=>$request->combination_key,
            ]
        )->render();

        return json_encode($return);
    }

    public function setSalesUnitSalePrice(Request $request){


        $insertions = Session::get('insertions');
        $adslot = Session::get('adslot_to_adjust_sales_unit_sale_price');

        // echo "<pre>";print_r($request->all());echo "</pre>";
        // echo "<pre>";print_r($insertions);echo "</pre>";
        // echo "<pre>";print_r($adslot);echo "</pre>";
        foreach($insertions['R'] as $combination_key=>$ads){
            foreach($ads['info'] as $key=>$ad){
                if(isset($adslot[$combination_key]['info'][$key])){
                    $insertions['R'][$combination_key]['info'][$key]['list_price'] = $request->sales_unit_list_price;
                    $insertions['R'][$combination_key]['info'][$key]['subtotal_sale_price'] = $request->subtotal_sale_price;
                }
            }
        }
        

        Session::put('insertions', $insertions);

        $all_remarketing_channels = $this->channelRepository->getAllExcludeSpecifics(1,array('數字廣告'));

        $return = array();
        $return['msg'] = __('ad-schedule.set-success');
        $return['html'] = view('partials.ad-schedule.edit._tab-content-remarketing',[
            'insertions'=>$insertions, 
            'all_remarketing_channels'=>$all_remarketing_channels
        ])->render();


        

        return json_encode($return);
    }

    public function setAgentSalesUnitSalePrice(Request $request){


        $insertions = Session::get('insertions');
        $adslot = Session::get('adslot_to_adjust_sales_unit_sale_price');

        // echo "<pre>";print_r($request->all());echo "</pre>";
        // echo "<pre>";print_r($insertions);echo "</pre>";
        // echo "<pre>";print_r($adslot);echo "</pre>";
        foreach($insertions['A'] as $combination_key=>$ads){
            foreach($ads['info'] as $key=>$ad){
                if(isset($adslot[$combination_key]['info'][$key])){
                    $insertions['A'][$combination_key]['info'][$key]['list_price'] = $request->sales_unit_list_price;
                    $insertions['A'][$combination_key]['info'][$key]['subtotal_sale_price'] = $request->subtotal_sale_price;
                }
            }
        }
        

        Session::put('insertions', $insertions);

        $all_agent_channels = $this->channelRepository->getAllExcludeSpecifics(1,array('591','8891','8591','100'));

        $return = array();
        $return['msg'] = __('ad-schedule.set-success');
        $return['html'] = view('partials.ad-schedule.edit._tab-content-agent',[
            'insertions'=>$insertions, 
            'all_agent_channels'=>$all_agent_channels
        ])->render();


        

        return json_encode($return);
    }

    public function subtotalSalePriceForm(Request $request){
        Session::forget('adslot_groups_to_adjust_discount');
        $insertions = Session::get('insertions');

        // echo "<pre>";print_r($insertions);echo "</pre>";exit;

        $requested_adslot_groups = json_decode($request->selected_adslot_groups,true);

        $selected_adslot_groups = array();

        foreach($insertions as $insertion_type=>$insertion_group){
            foreach($insertion_group as $key=>$adslot_group){
                if(in_array($key, $requested_adslot_groups)){
                    $selected_adslot_groups[$key] = $adslot_group;
                }
            }
        }
        
        

        // echo "<pre>";print_r($insertions);echo "</pre>";
        // echo "<pre>";print_r($selected_adslot_groups);echo "</pre>";exit;

        Session::put('adslot_groups_to_adjust_discount', $selected_adslot_groups);
        
        $return = array();
        $return['modelContent'] = view('partials.modals.ad-schedule._subtotal-sale-price-form',['selected_adslot_groups'=>$selected_adslot_groups])->render();

        return json_encode($return);
    }

    public function subtotalDigitmSalePriceForm(Request $request){
        Session::forget('adslot_groups_to_adjust_discount');
        $insertions = Session::get('insertions');

        // echo "<pre>";print_r($insertions);echo "</pre>";exit;

        $requested_adslot_groups = json_decode($request->selected_adslot_groups,true);

        $selected_adslot_groups = array();

        foreach($insertions as $insertion_type=>$insertion_group){
            foreach($insertion_group as $key=>$adslot_group){
                if(in_array($key, $requested_adslot_groups)){
                    $selected_adslot_groups[$key] = $adslot_group;
                }
            }
        }
        
        

        // echo "<pre>";print_r($insertions);echo "</pre>";
        // echo "<pre>";print_r($selected_adslot_groups);echo "</pre>";exit;

        Session::put('adslot_groups_to_adjust_discount', $selected_adslot_groups);
        
        $return = array();
        $return['modelContent'] = view('partials.modals.ad-schedule._subtotal-digitm-sale-price-form',['selected_adslot_groups'=>$selected_adslot_groups])->render();

        return json_encode($return);
    }

    public function lockSalePriceForm(Request $request){
        Session::forget('adslot_groups_to_lock_sale_price');
        $insertions = Session::get('insertions');

        $requested_adslot_groups = json_decode($request->selected_adslot_groups,true);

        
        $selected_adslot_groups['D'] = array();
        $selected_adslot_groups['M'] = array();

        //D type: 站內廣告
        if(isset($insertions['D'])){
            foreach($insertions['D'] as $key=>$adslot_group){
                if(in_array($key, $requested_adslot_groups)){
                    $selected_adslot_groups['D'][$key] = $adslot_group;
                }
            }
        }
        

        //M type: 數字廣告
        if(isset($insertions['M'])){
            foreach($insertions['M'] as $key=>$adslot_group){
                if(in_array($key, $requested_adslot_groups)){
                    $selected_adslot_groups['M'][$key] = $adslot_group;
                }
            }
        }
        

        // echo "<pre>";print_r($insertions);echo "</pre>";
        // echo "<pre>";print_r($selected_adslot_groups);echo "</pre>";exit;

        Session::put('adslot_groups_to_lock_sale_price', $selected_adslot_groups);
        
        $return = array();
        $return['modelContent'] = view('partials.modals.ad-schedule._lock-sale-price-form',['selected_adslot_groups'=>$selected_adslot_groups])->render();

        return json_encode($return);
    }

    public function lockDigitmSalePriceForm(Request $request){
        Session::forget('adslot_groups_to_lock_sale_price');
        $insertions = Session::get('insertions');

        $requested_adslot_groups = json_decode($request->selected_adslot_groups,true);

        
        $selected_adslot_groups['D'] = array();
        $selected_adslot_groups['M'] = array();

        //D type: 站內廣告
        if(isset($insertions['D'])){
            foreach($insertions['D'] as $key=>$adslot_group){
                if(in_array($key, $requested_adslot_groups)){
                    $selected_adslot_groups['D'][$key] = $adslot_group;
                }
            }
        }
        

        //M type: 數字廣告
        if(isset($insertions['M'])){
            foreach($insertions['M'] as $key=>$adslot_group){
                if(in_array($key, $requested_adslot_groups)){
                    $selected_adslot_groups['M'][$key] = $adslot_group;
                }
            }
        }
        

        // echo "<pre>";print_r($insertions);echo "</pre>";
        // echo "<pre>";print_r($selected_adslot_groups);echo "</pre>";exit;

        Session::put('adslot_groups_to_lock_sale_price', $selected_adslot_groups);
        
        $return = array();
        $return['modelContent'] = view('partials.modals.ad-schedule._lock-digitm-sale-price-form',['selected_adslot_groups'=>$selected_adslot_groups])->render();

        return json_encode($return);
    }

    public function unlockSalePriceForm(Request $request){
        Session::forget('adslot_groups_to_unlock_sale_price');
        $insertions = Session::get('insertions');

        $requested_adslot_groups = json_decode($request->selected_adslot_groups,true);

        $selected_adslot_groups = array();
        foreach($insertions['D'] as $key=>$adslot_group){
            if(in_array($key, $requested_adslot_groups)){
                $selected_adslot_groups[$key] = $adslot_group;
            }
        }

        // echo "<pre>";print_r($insertions);echo "</pre>";
        // echo "<pre>";print_r($selected_adslot_groups);echo "</pre>";exit;

        Session::put('adslot_groups_to_unlock_sale_price', $selected_adslot_groups);
        
        $return = array();
        $return['modelContent'] = view('partials.modals.ad-schedule._unlock-sale-price-form',['selected_adslot_groups'=>$selected_adslot_groups])->render();

        return json_encode($return);
    }

    public function unlockDigitmSalePriceForm(Request $request){
        Session::forget('adslot_groups_to_unlock_sale_price');
        $insertions = Session::get('insertions');

        $requested_adslot_groups = json_decode($request->selected_adslot_groups,true);

        $selected_adslot_groups = array();
        foreach($insertions['M'] as $key=>$adslot_group){
            if(in_array($key, $requested_adslot_groups)){
                $selected_adslot_groups[$key] = $adslot_group;
            }
        }

        // echo "<pre>";print_r($insertions);echo "</pre>";
        // echo "<pre>";print_r($selected_adslot_groups);echo "</pre>";exit;

        Session::put('adslot_groups_to_unlock_sale_price', $selected_adslot_groups);
        
        $return = array();
        $return['modelContent'] = view('partials.modals.ad-schedule._unlock-digitm-sale-price-form',['selected_adslot_groups'=>$selected_adslot_groups])->render();

        return json_encode($return);
    }

    public function adjustDiscountPercentage(Request $request){
        $non_performance_adslot_type = array(
            'D','M'
        );

        $new_discount_percentage = $request->discount_percentage;

        $insertions = Session::get('insertions');
        $adslot_groups = Session::get('adslot_groups_to_adjust_discount');

        foreach($insertions as $insertion_type=>$insertion_group){
            foreach($insertion_group as $key=>$adslot_group){
                if(isset($adslot_groups[$key])){
                    $insertions[$insertion_type][$key]['info']['discount_percentage'] = $new_discount_percentage;
                }
            }
        }
        

        Session::put('insertions', $insertions);

        // echo "<pre>";print_r($insertions);echo "</pre>";exit;

        $ingroup_adslot_groups = array();
        $non_ingroup_adslot_groups = array();

        $insertions = Session::get('insertions');
        // echo "<pre>";print_r($insertions);echo "</pre>";exit;
        /**
         * 判斷版位是否依【鎖定售價】被分群：
         * */
        //目前已分群的版位
        $total_ingroup_adslot_groups = Session::get('total_adslot_groups_to_lock_sale_price');
        
        /**
         * 將已分群，未分群的adslot groups 作分類
         * */
        
        if(!is_null($total_ingroup_adslot_groups)){

            foreach($total_ingroup_adslot_groups as $adslot_type=>$adslot_groups){
                //只有非"成效型" 的版位需要處理
                if(in_array($adslot_type, $non_performance_adslot_type)){
                    foreach($adslot_groups as $key=>$adslot_group){
                        foreach($adslot_group as $adslot_group_key=>$combination_key){
                            if(isset($insertions[$adslot_type][$combination_key])){

                                if(!isset($ingroup_adslot_groups[$adslot_type])){
                                    $ingroup_adslot_groups[$adslot_type] = array();
                                }

                                $ingroup_adslot_groups[$adslot_type][$combination_key] = $insertions[$adslot_type][$combination_key];
                            }
                            else{
                                unset($total_ingroup_adslot_groups[$adslot_type][$key][$adslot_group_key]);
                            }
                        }
                    }
                }
            }

        }


        
        foreach($insertions as $adslot_type=>$adslot_groups){
            //只有非"成效型" 的版位需要處理
            if(in_array($adslot_type, $non_performance_adslot_type)){
                foreach($adslot_groups as $combination_key=>$adslot_group){

                    if(!isset($ingroup_adslot_groups[$adslot_type][$combination_key])){
                        if(isset($insertions[$adslot_type]) && !is_null($insertions[$adslot_type])){
                            $non_ingroup_adslot_groups[$adslot_type][$combination_key] = $insertions[$adslot_type][$combination_key];    
                        }
                    }

                }
            }
        }


        $return = array();
        $return['msg'] = __('ad-schedule.set_new_discount_percentage_success');
        $return['html'] = view('partials.ad-schedule.edit._tab-content-on-site',[
            'insertions'=>$insertions, 
            'total_ingroup_adslot_groups'=>$total_ingroup_adslot_groups,
            'ingroup'=>$ingroup_adslot_groups,
            'non_ingroup'=>$non_ingroup_adslot_groups,
        ])->render();


        /**
         * 計算總計區塊
         * */
        $ingroup = $ingroup_adslot_groups;

        $total_subtotal_list_price = 0;
        $total_subtotal_sale_price = 0;

        // echo "<pre>";print_r($ingroup);echo "</pre>";
        // echo "<pre>";print_r($total_ingroup_adslot_groups);echo "</pre>";exit;

        if(!is_null($total_ingroup_adslot_groups)){
            foreach($total_ingroup_adslot_groups as $adslot_type=>$adslot_groups){
                //只有非"成效型" 的版位需要處理
                if(in_array($adslot_type, $non_performance_adslot_type)){
                    foreach($adslot_groups as $ingroup_key=>$ingroup_adslot_groups){
                        foreach($ingroup_adslot_groups as $key=>$adslot_group){
                            $total_subtotal_list_price += ($ingroup[$adslot_type][$adslot_group]['info']['list_price']*count($ingroup[$adslot_type][$adslot_group]['info']['dateRanges']));
                            
                            $sale_price = ($ingroup[$adslot_type][$adslot_group]['info']['list_price']*count($ingroup[$adslot_type][$adslot_group]['info']['dateRanges']))*(1-($ingroup[$adslot_type][$adslot_group]['info']['discount_percentage']/100));

                            $total_subtotal_sale_price += $sale_price;
                        }    
                    }
                }
            }
        }

        

        if(!is_null($non_ingroup_adslot_groups)){
            foreach($non_ingroup_adslot_groups as $adslot_type=>$adslot_groups){
                //只有非"成效型" 的版位需要處理
                if(in_array($adslot_type, $non_performance_adslot_type)){
                    foreach($adslot_groups as $key=>$adslot_group){
                        $total_subtotal_list_price += ($adslot_group['info']['list_price']*count($adslot_group['info']['dateRanges']));
                        
                        $sale_price = ($adslot_group['info']['list_price']*count($adslot_group['info']['dateRanges']))*(1-($adslot_group['info']['discount_percentage']/100));

                        $total_subtotal_sale_price += $sale_price;
                    }
                }  
            }
        }

        $return['total_subtotal_list_price'] = number_format($total_subtotal_list_price);
        $return['total_subtotal_sale_price'] = number_format($total_subtotal_sale_price);
        $return['total_discount_percentage'] = number_format((1-($total_subtotal_list_price-$total_subtotal_sale_price)/$total_subtotal_list_price)*100, 2).'%' ;

        return json_encode($return);
    }

    public function adjustDigitmDiscountPercentage(Request $request){
        $non_performance_adslot_type = array(
            'D','M'
        );

        $new_discount_percentage = $request->discount_percentage;

        $insertions = Session::get('insertions');
        $adslot_groups = Session::get('adslot_groups_to_adjust_discount');

        foreach($insertions as $insertion_type=>$insertion_group){
            foreach($insertion_group as $key=>$adslot_group){
                if(isset($adslot_groups[$key])){
                    $insertions[$insertion_type][$key]['info']['discount_percentage'] = $new_discount_percentage;
                }
            }
        }
        

        Session::put('insertions', $insertions);

        // echo "<pre>";print_r($insertions);echo "</pre>";exit;

        $ingroup_adslot_groups = array();
        $non_ingroup_adslot_groups = array();

        $insertions = Session::get('insertions');
        // echo "<pre>";print_r($insertions);echo "</pre>";exit;
        /**
         * 判斷版位是否依【鎖定售價】被分群：
         * */
        //目前已分群的版位
        $total_ingroup_adslot_groups = Session::get('total_adslot_groups_to_lock_sale_price');
        
        /**
         * 將已分群，未分群的adslot groups 作分類
         * */
        
        if(!is_null($total_ingroup_adslot_groups)){

            foreach($total_ingroup_adslot_groups as $adslot_type=>$adslot_groups){
                //只有非"成效型" 的版位需要處理
                if(in_array($adslot_type, $non_performance_adslot_type)){
                    foreach($adslot_groups as $key=>$adslot_group){
                        foreach($adslot_group as $adslot_group_key=>$combination_key){
                            if(isset($insertions[$adslot_type][$combination_key])){

                                if(!isset($ingroup_adslot_groups[$adslot_type])){
                                    $ingroup_adslot_groups[$adslot_type] = array();
                                }

                                $ingroup_adslot_groups[$adslot_type][$combination_key] = $insertions[$adslot_type][$combination_key];
                            }
                            else{
                                unset($total_ingroup_adslot_groups[$adslot_type][$key][$adslot_group_key]);
                            }
                        }
                    }
                }
            }

        }


        
        foreach($insertions as $adslot_type=>$adslot_groups){
            //只有非"成效型" 的版位需要處理
            if(in_array($adslot_type, $non_performance_adslot_type)){
                foreach($adslot_groups as $combination_key=>$adslot_group){

                    if(!isset($ingroup_adslot_groups[$adslot_type][$combination_key])){
                        if(isset($insertions[$adslot_type]) && !is_null($insertions[$adslot_type])){
                            $non_ingroup_adslot_groups[$adslot_type][$combination_key] = $insertions[$adslot_type][$combination_key];    
                        }
                    }

                }
            }
        }


        $return = array();
        $return['msg'] = __('ad-schedule.set_new_discount_percentage_success');
        $return['html'] = view('partials.ad-schedule.edit._tab-content-digitm',[
            'insertions'=>$insertions, 
            'total_ingroup_adslot_groups'=>$total_ingroup_adslot_groups,
            'ingroup'=>$ingroup_adslot_groups,
            'non_ingroup'=>$non_ingroup_adslot_groups,
        ])->render();


        /**
         * 計算總計區塊
         * */
        $ingroup = $ingroup_adslot_groups;

        $total_subtotal_list_price = 0;
        $total_subtotal_sale_price = 0;

        // echo "<pre>";print_r($ingroup);echo "</pre>";
        // echo "<pre>";print_r($total_ingroup_adslot_groups);echo "</pre>";exit;

        // if(!is_null($total_ingroup_adslot_groups)){
        //     foreach($total_ingroup_adslot_groups as $adslot_type=>$adslot_groups){
        //         //只有非"成效型" 的版位需要處理
        //         if(in_array($adslot_type, $non_performance_adslot_type)){
        //             foreach($adslot_groups as $ingroup_key=>$ingroup_adslot_groups){
        //                 foreach($ingroup_adslot_groups as $key=>$adslot_group){
        //                     $total_subtotal_list_price += ($ingroup[$adslot_type][$adslot_group]['info']['list_price']*count($ingroup[$adslot_type][$adslot_group]['info']['dateRanges']));
                            
        //                     $sale_price = ($ingroup[$adslot_type][$adslot_group]['info']['list_price']*count($ingroup[$adslot_type][$adslot_group]['info']['dateRanges']))*(1-($ingroup[$adslot_type][$adslot_group]['info']['discount_percentage']/100));

        //                     $total_subtotal_sale_price += $sale_price;
        //                 }    
        //             }
        //         }
        //     }
        // }

        

        // if(!is_null($non_ingroup_adslot_groups)){
        //     foreach($non_ingroup_adslot_groups as $adslot_type=>$adslot_groups){
        //         //只有非"成效型" 的版位需要處理
        //         if(in_array($adslot_type, $non_performance_adslot_type)){
        //             foreach($adslot_groups as $key=>$adslot_group){
        //                 $total_subtotal_list_price += ($adslot_group['info']['list_price']*count($adslot_group['info']['dateRanges']));
                        
        //                 $sale_price = ($adslot_group['info']['list_price']*count($adslot_group['info']['dateRanges']))*(1-($adslot_group['info']['discount_percentage']/100));

        //                 $total_subtotal_sale_price += $sale_price;
        //             }
        //         }  
        //     }
        // }

        $return['total_subtotal_list_price'] = 0;
        $return['total_subtotal_sale_price'] = 0;
        $return['total_discount_percentage'] = 0;

        return json_encode($return);
    }

    public function groupLockSalePrice(Request $request){
        //要加入進行分群的版位
        $adslot_groups = Session::get('adslot_groups_to_lock_sale_price');
        // echo "<pre>";print_r($adslot_groups);echo "</pre>";

        //目前已分群的版位
        $total_adslot_groups = Session::get('total_adslot_groups_to_lock_sale_price');

        // echo "<pre>";print_r($total_adslot_groups);echo "</pre>";exit;

        if(is_null($total_adslot_groups)){
            $total_adslot_groups = array();
        }
        

        /**
         * 先確認已分群的版位裡沒有重覆放入的版位
         * 
         * 如果有，則先移除
         * */
        foreach($total_adslot_groups as $total_key=>$total_lock_adslot_group){

            foreach($total_lock_adslot_group as $key=>$combination_key){

                if(isset($adslot_groups[$total_key]) && !empty($adslot_groups[$total_key])){
                    if(isset($adslot_groups[$total_key][$combination_key])){
                        $found_key = array_search($combination_key, $total_adslot_groups[$total_key]);
                        unset($total_adslot_groups[$total_key][$found_key]);
                    }
                }
            }

        }

        

        /**
         * 再開始group
         * */
        $non_group = array();

        foreach($adslot_groups as $adslot_type=>$adslot_groups){
            if(!empty($adslot_groups)){
                foreach($adslot_groups as $combination_key=>$lock_adslot_group){
                    $non_group[] = $combination_key;
                }

                $total_adslot_groups[$adslot_type][] = $non_group;
            }
        }
        
        /**
         * 移除空的array
         * */
        foreach($total_adslot_groups as $key=>$val){
            if(empty($val)){
                unset($total_adslot_groups[$key]);
            }
        }

        // $total_adslot_groups = array_values($total_adslot_groups);
        // echo "<pre>";print_r($total_adslot_groups);echo "</pre>";exit;

        /**
         * total adslot groups to lock sale price
         * 
         * example:
         * */
        /*
        Array
        (
            [D] => Array
                (
                    [0] => Array
                        (
                            [0] => 2_2_4
                            [1] => 3_3_5
                        )

                )

        )
        */
        
        Session::put('total_adslot_groups_to_lock_sale_price', $total_adslot_groups);
        
        return redirect()->route('ad-schedule.edit');
    }

    public function groupLockDigitmSalePrice(Request $request){
        //要加入進行分群的版位
        $adslot_groups = Session::get('adslot_groups_to_lock_sale_price');
        // echo "<pre>";print_r($adslot_groups);echo "</pre>";
        //目前已分群的版位
        $total_adslot_groups = Session::get('total_adslot_groups_to_lock_sale_price');

        // echo "<pre>";print_r($total_adslot_groups);echo "</pre>";exit;

        if(is_null($total_adslot_groups)){
            $total_adslot_groups = array();
        }
        

        /**
         * 先確認已分群的版位裡沒有重覆放入的版位
         * 
         * 如果有，則先移除
         * */
        foreach($total_adslot_groups as $total_key=>$total_lock_adslot_group){

            foreach($total_lock_adslot_group as $key=>$combination_key){

                if(isset($adslot_groups[$total_key]) && !empty($adslot_groups[$total_key])){
                    if(isset($adslot_groups[$total_key][$combination_key])){
                        $found_key = array_search($combination_key, $total_adslot_groups[$total_key]);
                        unset($total_adslot_groups[$total_key][$found_key]);    
                    }
                }
            }

        }

        

        /**
         * 再開始group
         * */
        $non_group = array();

        foreach($adslot_groups as $adslot_type=>$adslot_groups){
            if(!empty($adslot_groups)){
                foreach($adslot_groups as $combination_key=>$lock_adslot_group){
                    $non_group[] = $combination_key;
                }

                $total_adslot_groups[$adslot_type][] = $non_group;
            }
        }
        
        /**
         * 移除空的array
         * */
        foreach($total_adslot_groups as $key=>$val){
            if(empty($val)){
                unset($total_adslot_groups[$key]);
            }
        }

        // $total_adslot_groups = array_values($total_adslot_groups);
        // echo "<pre>";print_r($total_adslot_groups);echo "</pre>";exit;

        /**
         * total adslot groups to lock sale price
         * 
         * example:
         * */
        /*
        Array
        (
            [D] => Array
                (
                    [0] => Array
                        (
                            [0] => 2_2_4
                            [1] => 3_3_5
                        )

                )

        )
        */
        
        Session::put('total_adslot_groups_to_lock_sale_price', $total_adslot_groups);
        
        return redirect()->route('ad-schedule.edit');
    }

    public function groupUnlockSalePrice(Request $request){
        //要解除分群的版位
        $adslot_groups = Session::get('adslot_groups_to_unlock_sale_price');

        // echo "<pre>";print_r($adslot_groups);echo "</pre>";

        //目前已分群的版位
        $total_adslot_groups = Session::get('total_adslot_groups_to_lock_sale_price');

        // echo "<pre>";print_r($total_adslot_groups);echo "</pre>";
        
        /**
         * 將要進行解除的，與已分群的版位比對後移除
         * */
        // echo "<pre>";print_r($total_adslot_groups);echo "</pre>";

        foreach($total_adslot_groups as $adslot_type=>$adslot_groups_by_type){
            foreach($adslot_groups_by_type as $total_key=>$total_lock_adslot_group){
                foreach($total_lock_adslot_group as $key=>$combination_key){
                    if(isset($adslot_groups[$combination_key])){
                        $found_key = array_search($combination_key, $total_lock_adslot_group);
                        unset($total_adslot_groups[$adslot_type][$total_key][$found_key]);
                    }
                }
            }
        }
        

       
        /**
         * 移除空的array
         * */
        foreach($total_adslot_groups as $adslot_type=>$adslot_groups_by_type){
            foreach($adslot_groups_by_type as $key=>$val){
                if(empty($val)){
                    unset($total_adslot_groups[$adslot_type][$key]);
                }
            }
        }
        

        // echo "<pre>";print_r($total_adslot_groups);echo "</pre>";exit;

        
        Session::put('total_adslot_groups_to_lock_sale_price', $total_adslot_groups);
        // echo "<pre>";print_r($total_adslot_groups);echo "</pre>";exit;

        return redirect()->route('ad-schedule.edit');
    }

    public function groupUnlockDigitmSalePrice(Request $request){
        //要解除分群的版位
        $adslot_groups = Session::get('adslot_groups_to_unlock_sale_price');

        // echo "<pre>";print_r($adslot_groups);echo "</pre>";

        //目前已分群的版位
        $total_adslot_groups = Session::get('total_adslot_groups_to_lock_sale_price');

        // echo "<pre>";print_r($total_adslot_groups);echo "</pre>";
        
        /**
         * 將要進行解除的，與已分群的版位比對後移除
         * */
        // echo "<pre>";print_r($total_adslot_groups);echo "</pre>";

        foreach($total_adslot_groups as $adslot_type=>$adslot_groups_by_type){
            foreach($adslot_groups_by_type as $total_key=>$total_lock_adslot_group){
                foreach($total_lock_adslot_group as $key=>$combination_key){
                    if(isset($adslot_groups[$combination_key])){
                        $found_key = array_search($combination_key, $total_lock_adslot_group);
                        unset($total_adslot_groups[$adslot_type][$total_key][$found_key]);
                    }
                }
            }
        }
        

       
        /**
         * 移除空的array
         * */
        foreach($total_adslot_groups as $adslot_type=>$adslot_groups_by_type){
            foreach($adslot_groups_by_type as $key=>$val){
                if(empty($val)){
                    unset($total_adslot_groups[$adslot_type][$key]);
                }
            }
        }
        

        // echo "<pre>";print_r($total_adslot_groups);echo "</pre>";exit;

        
        Session::put('total_adslot_groups_to_lock_sale_price', $total_adslot_groups);
        // echo "<pre>";print_r($total_adslot_groups);echo "</pre>";exit;

        return redirect()->route('ad-schedule.edit');
    }

    public function deleteAdSlotsForm(Request $request){
        Session::forget('adslot_groups_to_remove');
        $insertions = Session::get('insertions');

        $requested_adslot_groups = json_decode($request->selected_adslot_groups,true);

        $selected_adslot_groups = array();

        foreach($insertions as $insertion_type=>$insertion_group){
            foreach($insertion_group as $key=>$adslot_group){
                if(in_array($key, $requested_adslot_groups)){
                    $selected_adslot_groups[$key] = $adslot_group;
                }
            }
        }

        Session::put('adslot_groups_to_remove', $selected_adslot_groups);

        $return = array();
        $return['modelContent'] = view('partials.modals.ad-schedule._delete-adslots-form',['selected_adslot_groups'=>$selected_adslot_groups])->render();

        return json_encode($return);
    }

    public function deleteDigitmAdSlotsForm(Request $request){
        Session::forget('adslot_groups_to_remove');
        $insertions = Session::get('insertions');

        $requested_adslot_groups = json_decode($request->selected_adslot_groups,true);

        $selected_adslot_groups = array();

        foreach($insertions as $insertion_type=>$insertion_group){
            foreach($insertion_group as $key=>$adslot_group){
                if(in_array($key, $requested_adslot_groups)){
                    $selected_adslot_groups[$key] = $adslot_group;
                }
            }
        }

        Session::put('adslot_groups_to_remove', $selected_adslot_groups);

        $return = array();
        $return['modelContent'] = view('partials.modals.ad-schedule._delete-digitm-adslots-form',['selected_adslot_groups'=>$selected_adslot_groups])->render();

        return json_encode($return);
    }

    public function deleteRemarketingAdSlotForm(Request $request){
        Session::forget('remarketing_adslot_to_remove');
        $insertions = Session::get('insertions');

        // echo "<pre>";print_r($request->all());echo "</pre>";
        // echo "<pre>";print_r($insertions);echo "</pre>";

        $requested_adslot = json_decode($request->selected_adslot,true);

        $selected_adslot = array();

        foreach($insertions['R'] as $combination_key=>$ads){
            foreach($ads['info'] as $key=>$ad){
                if($combination_key == $request->combination_key){
                    if($key == $request->row){
                        $selected_adslot[$combination_key]['info'][$key] = $ads['info'][$request->row];
                    }
                }
            }
        }

        Session::put('remarketing_adslot_to_remove', $selected_adslot);

        // echo "<pre>";print_r($selected_adslot);echo "</pre>";exit;

        $return = array();
        $return['modelContent'] = view('partials.modals.ad-schedule._delete-remarketing-adslot-form',['selected_adslot'=>$selected_adslot])->render();

        return json_encode($return);
    }

    public function deleteAgentAdSlotForm(Request $request){
        Session::forget('agent_adslot_to_remove');
        $insertions = Session::get('insertions');

        // echo "<pre>";print_r($request->all());echo "</pre>";
        // echo "<pre>";print_r($insertions);echo "</pre>";

        $requested_adslot = json_decode($request->selected_adslot,true);

        $selected_adslot = array();

        foreach($insertions['A'] as $combination_key=>$ads){
            foreach($ads['info'] as $key=>$ad){
                if($combination_key == $request->combination_key){
                    if($key == $request->row){
                        $selected_adslot[$combination_key]['info'][$key] = $ads['info'][$request->row];
                    }
                }
            }
        }

        Session::put('agent_adslot_to_remove', $selected_adslot);

        // echo "<pre>";print_r($selected_adslot);echo "</pre>";exit;

        $return = array();
        $return['modelContent'] = view('partials.modals.ad-schedule._delete-agent-adslot-form',['selected_adslot'=>$selected_adslot])->render();

        return json_encode($return);
    }

    public function deleteAdSlots(Request $request){

        $insertions = Session::get('insertions');
        $adslot_groups = Session::get('adslot_groups_to_remove');

        foreach($insertions as $insertion_type=>$insertion_group){
            foreach($insertion_group as $key=>$adslot_group){
                if(isset($adslot_groups[$key])){
                    unset($insertions[$insertion_type][$key]);
                }
            }
        }

        // echo "<pre>";print_r($insertions);echo "</pre>";exit;

        Session::put('insertions', $insertions);

        // echo "<pre>";print_r(Session::get('insertions'));echo "</pre>";

        
        /**
         * 判斷版位是否依【鎖定售價】被分群：
         * */
        //目前已分群的版位
        $total_ingroup_adslot_groups = Session::get('total_adslot_groups_to_lock_sale_price');
        
        $ingroup_adslot_groups = array();
        $non_ingroup_adslot_groups = array();
        
        /**
         * 將已分群，未分群的adslot groups 作分類
         * */
        
        if(!is_null($total_ingroup_adslot_groups)){

            foreach($total_ingroup_adslot_groups as $adslot_type=>$adslot_groups){
                foreach($adslot_groups as $key=>$adslot_group){
                    foreach($adslot_group as $adslot_group_key=>$combination_key){
                        if(isset($insertions[$adslot_type][$combination_key])){

                            if(!isset($ingroup_adslot_groups[$adslot_type])){
                                $ingroup_adslot_groups[$adslot_type] = array();
                            }

                            $ingroup_adslot_groups[$adslot_type][$combination_key] = $insertions[$adslot_type][$combination_key];
                        }
                        else{
                            unset($total_ingroup_adslot_groups[$adslot_type][$key][$adslot_group_key]);
                        }
                    }
                }
            }

        }


        
        foreach($insertions as $adslot_type=>$adslot_groups){

            foreach($adslot_groups as $combination_key=>$adslot_group){

                if(!isset($ingroup_adslot_groups[$adslot_type][$combination_key])){
                    if(isset($insertions[$adslot_type]) && !is_null($insertions[$adslot_type])){
                        $non_ingroup_adslot_groups[$adslot_type][$combination_key] = $insertions[$adslot_type][$combination_key];    
                    }
                }

            }

        }

        // echo "<pre>";print_r($ingroup_adslot_groups);echo "</pre>";
        // echo "<pre>";print_r($non_ingroup_adslot_groups);echo "</pre>";exit;


        $return = array();
        $return['msg'] = __('ad-schedule.delete-success');
        $return['html'] = view('partials.ad-schedule.edit._tab-content-on-site',[
            'insertions'=>$insertions, 
            'total_ingroup_adslot_groups'=>$total_ingroup_adslot_groups,
            'ingroup'=>$ingroup_adslot_groups,
            'non_ingroup'=>$non_ingroup_adslot_groups,
        ])->render();


        /**
         * 計算總計區塊
         * */
        $ingroup = $ingroup_adslot_groups;

        $total_subtotal_list_price = 0;
        $total_subtotal_sale_price = 0;

        // if(!is_null($total_ingroup_adslot_groups)){
        //     foreach($total_ingroup_adslot_groups as $adslot_type=>$adslot_groups){
        //         foreach($adslot_groups as $ingroup_key=>$ingroup_adslot_groups){

        //             foreach($ingroup_adslot_groups as $key=>$adslot_group){
        //                 $total_subtotal_list_price += ($ingroup[$adslot_type][$adslot_group]['info']['list_price']*count($ingroup[$adslot_type][$adslot_group]['info']['dateRanges']));
                        
        //                 $sale_price = ($ingroup[$adslot_type][$adslot_group]['info']['list_price']*count($ingroup[$adslot_type][$adslot_group]['info']['dateRanges']))*(1-($ingroup[$adslot_type][$adslot_group]['info']['discount_percentage']/100));

        //                 $total_subtotal_sale_price += $sale_price;
        //             }    
        //         }
        //     }
            
        // }

        // if(!is_null($non_ingroup_adslot_groups)){
        //     foreach($non_ingroup_adslot_groups as $adslot_type=>$adslot_groups){
        //         foreach($adslot_groups as $key=>$adslot_group){
        //             $total_subtotal_list_price += ($adslot_group['info']['list_price']*count($adslot_group['info']['dateRanges']));
                    
        //             $sale_price = ($adslot_group['info']['list_price']*count($adslot_group['info']['dateRanges']))*(1-($adslot_group['info']['discount_percentage']/100));

        //             $total_subtotal_sale_price += $sale_price;
        //         }   
        //     }
        // }

        // $return['total_subtotal_list_price'] = number_format($total_subtotal_list_price);
        // $return['total_subtotal_sale_price'] = number_format($total_subtotal_sale_price);
        // $return['total_discount_percentage'] = number_format((1-($total_subtotal_list_price-$total_subtotal_sale_price)/$total_subtotal_list_price)*100, 2).'%' ;

        $return['total_subtotal_list_price'] = 0;
        $return['total_subtotal_sale_price'] = 0;
        $return['total_discount_percentage'] = 0;

        return json_encode($return);
    }

    public function deleteDigitmAdSlots(Request $request){

        $insertions = Session::get('insertions');
        $adslot_groups = Session::get('adslot_groups_to_remove');

        foreach($insertions as $insertion_type=>$insertion_group){
            foreach($insertion_group as $key=>$adslot_group){
                if(isset($adslot_groups[$key])){
                    unset($insertions[$insertion_type][$key]);
                }
            }
        }

        // echo "<pre>";print_r($insertions);echo "</pre>";exit;

        Session::put('insertions', $insertions);

        // echo "<pre>";print_r(Session::get('insertions'));echo "</pre>";

        
        /**
         * 判斷版位是否依【鎖定售價】被分群：
         * */
        //目前已分群的版位
        $total_ingroup_adslot_groups = Session::get('total_adslot_groups_to_lock_sale_price');
        
        $ingroup_adslot_groups = array();
        $non_ingroup_adslot_groups = array();
        
        /**
         * 將已分群，未分群的adslot groups 作分類
         * */
        
        if(!is_null($total_ingroup_adslot_groups)){

            foreach($total_ingroup_adslot_groups as $adslot_type=>$adslot_groups){
                foreach($adslot_groups as $key=>$adslot_group){
                    foreach($adslot_group as $adslot_group_key=>$combination_key){
                        if(isset($insertions[$adslot_type][$combination_key])){

                            if(!isset($ingroup_adslot_groups[$adslot_type])){
                                $ingroup_adslot_groups[$adslot_type] = array();
                            }

                            $ingroup_adslot_groups[$adslot_type][$combination_key] = $insertions[$adslot_type][$combination_key];
                        }
                        else{
                            unset($total_ingroup_adslot_groups[$adslot_type][$key][$adslot_group_key]);
                        }
                    }
                }
            }

        }
        
        foreach($insertions as $adslot_type=>$adslot_groups){

            foreach($adslot_groups as $combination_key=>$adslot_group){

                if(!isset($ingroup_adslot_groups[$adslot_type][$combination_key])){
                    if(isset($insertions[$adslot_type]) && !is_null($insertions[$adslot_type])){
                        $non_ingroup_adslot_groups[$adslot_type][$combination_key] = $insertions[$adslot_type][$combination_key];    
                    }
                }

            }

        }

        // echo "<pre>";print_r($ingroup_adslot_groups);echo "</pre>";
        // echo "<pre>";print_r($non_ingroup_adslot_groups);echo "</pre>";exit;


        $return = array();
        $return['msg'] = __('ad-schedule.delete-success');
        $return['html'] = view('partials.ad-schedule.edit._tab-content-digitm',[
            'insertions'=>$insertions, 
            'total_ingroup_adslot_groups'=>$total_ingroup_adslot_groups,
            'ingroup'=>$ingroup_adslot_groups,
            'non_ingroup'=>$non_ingroup_adslot_groups,
        ])->render();


        /**
         * 計算總計區塊
         * */
        $ingroup = $ingroup_adslot_groups;

        $total_subtotal_list_price = 0;
        $total_subtotal_sale_price = 0;

        // if(!is_null($total_ingroup_adslot_groups)){
        //     foreach($total_ingroup_adslot_groups as $adslot_type=>$adslot_groups){
        //         foreach($adslot_groups as $ingroup_key=>$ingroup_adslot_groups){

        //             foreach($ingroup_adslot_groups as $key=>$adslot_group){
        //                 $total_subtotal_list_price += ($ingroup[$adslot_type][$adslot_group]['info']['list_price']*count($ingroup[$adslot_type][$adslot_group]['info']['dateRanges']));
                        
        //                 $sale_price = ($ingroup[$adslot_type][$adslot_group]['info']['list_price']*count($ingroup[$adslot_type][$adslot_group]['info']['dateRanges']))*(1-($ingroup[$adslot_type][$adslot_group]['info']['discount_percentage']/100));

        //                 $total_subtotal_sale_price += $sale_price;
        //             }    
        //         }
        //     }
            
        // }

        // if(!is_null($non_ingroup_adslot_groups)){
        //     foreach($non_ingroup_adslot_groups as $adslot_type=>$adslot_groups){
        //         foreach($adslot_groups as $key=>$adslot_group){
        //             $total_subtotal_list_price += ($adslot_group['info']['list_price']*count($adslot_group['info']['dateRanges']));
                    
        //             $sale_price = ($adslot_group['info']['list_price']*count($adslot_group['info']['dateRanges']))*(1-($adslot_group['info']['discount_percentage']/100));

        //             $total_subtotal_sale_price += $sale_price;
        //         }   
        //     }
        // }

        // $return['total_subtotal_list_price'] = number_format($total_subtotal_list_price);
        // $return['total_subtotal_sale_price'] = number_format($total_subtotal_sale_price);
        // $return['total_discount_percentage'] = number_format((1-($total_subtotal_list_price-$total_subtotal_sale_price)/$total_subtotal_list_price)*100, 2).'%' ;

        $return['total_subtotal_list_price'] = 0;
        $return['total_subtotal_sale_price'] = 0;
        $return['total_discount_percentage'] = 0;

        return json_encode($return);
    }

    public function deleteRemarketingAdSlot(Request $request){

        $insertions = Session::get('insertions');
        $adslot = Session::get('remarketing_adslot_to_remove');

        // echo "<pre>";print_r($insertions);echo "</pre>";
        
        foreach($insertions['R'] as $combination_key=>$ads){
            foreach($ads['info'] as $key=>$ad){
                if(isset($adslot[$combination_key]['info'][$key])){
                    unset($insertions['R'][$combination_key]['info'][$key]);
                }
            }
        }

        /**
         * reset keys
         * */
        $insertions['R'][$combination_key]['info'] = array_values($insertions['R'][$combination_key]['info']);

        Session::put('insertions', $insertions);

        // echo "<pre>";print_r($insertions);echo "</pre>";exit;
        // echo "<pre>";print_r($adslot);echo "</pre>";exit;

        $all_remarketing_channels = $this->channelRepository->getAllExcludeSpecifics(1,array('數字廣告'));

        $return = array();
        $return['msg'] = __('ad-schedule.delete-success');
        $return['html'] = view('partials.ad-schedule.edit._tab-content-remarketing',[
            'insertions'=>$insertions, 
            'all_remarketing_channels'=>$all_remarketing_channels
        ])->render();


        return json_encode($return);
    }

    public function deleteAgentAdSlot(Request $request){

        $insertions = Session::get('insertions');
        $adslot = Session::get('agent_adslot_to_remove');

        // echo "<pre>";print_r($insertions);echo "</pre>";
        
        foreach($insertions['A'] as $combination_key=>$ads){
            foreach($ads['info'] as $key=>$ad){
                if(isset($adslot[$combination_key]['info'][$key])){
                    unset($insertions['A'][$combination_key]['info'][$key]);
                }
            }
        }

        /**
         * reset keys
         * */
        $insertions['A'][$combination_key]['info'] = array_values($insertions['A'][$combination_key]['info']);

        Session::put('insertions', $insertions);

        // echo "<pre>";print_r($insertions);echo "</pre>";exit;
        // echo "<pre>";print_r($adslot);echo "</pre>";exit;

        $all_agent_channels = $this->channelRepository->getAllExcludeSpecifics(1,array('591','8891','8591','100'));

        $return = array();
        $return['msg'] = __('ad-schedule.delete-success');
        $return['html'] = view('partials.ad-schedule.edit._tab-content-agent',[
            'insertions'=>$insertions, 
            'all_agent_channels'=>$all_agent_channels
        ])->render();


        return json_encode($return);
    }

    public function getAdslotGroupsByChannelGroup(Request $request){

        // echo "<pre>";print_r($request->all());echo "</pre>";exit;

        $channel_group_id = $request->channel_group_id;

        $adslot_groups = $this->adslotGroupRepository->getAllByAdslotRegion($channel_group_id, $request->region_id);
        $selected_channel_group = $this->channelGroupRepository->findChannelGroupById($channel_group_id);

        return view('partials.modals.ad-schedule._adslot-groups-list-group',
            ['adslot_groups'=>$adslot_groups, 
            'selected_channel'=>$request->channel_id,
            'selected_region'=>$request->region_id,
            'selected_channel_group'=>$selected_channel_group,
            ])->render();    
        
    }

    public function generateGantts(Request $request){
        sleep(1);
        $adslot_cart = json_decode($request->adslot_cart, true);
        
        $data_for_entire_range = array();

        //計算日期之間總共有幾個月份
        $ts1 = strtotime($request->start_date);
        $ts2 = strtotime($request->end_date);
        $year1 = date('Y', $ts1);
        $year2 = date('Y', $ts2);
        $month1 = date('m', $ts1);
        $month2 = date('m', $ts2);
        $number_of_months = (($year2 - $year1) * 12) + ($month2 - $month1) + 1;

        $month_data = array();
        
        $all_columns_count = 0;
        $start_index = 1;

        for($i=0;$i<$number_of_months;$i++){
            $temp = array();

            $temp['month_label'] = date("Y/m",strtotime($request->start_date." +".$i." months"));
            $temp['month'] = date("m",strtotime($request->start_date." +".$i." months"));

            
            if($i==0){
                $temp['month_start_day'] = date("j",strtotime($request->start_date." +".$i." months"));
                $temp['days_of_month'] = date('t',strtotime($request->start_date." +".$i." months")) - date('j',strtotime($request->start_date." +".$i." months")) + 1;
            }
            elseif($i == ($number_of_months-1)){
                $temp['month_start_day'] = 1;
                $temp['days_of_month'] = date('j',strtotime($request->end_date));
                
            }
            else{
                $temp['month_start_day'] = 1;
                $temp['days_of_month'] = date('t',strtotime($request->start_date." +".$i." months"));
            }
            

            $temp['start_from_index'] = $start_index;
            $temp['index_to_end'] = $start_index+$temp['days_of_month'];

            $all_columns_count += $temp['days_of_month'];

            $start_index += $temp['days_of_month'];
            $month_data[] = $temp;
        }
        
        //處理regions, 畫出地區tabs

        $gantt_start_date = $month_data[array_key_first($month_data)]['month_label'].'/'.$month_data[array_key_first($month_data)]['month_start_day'];

        $gantt_start_index = $month_data[array_key_first($month_data)]['start_from_index'];

        $gantt_end_date = $month_data[array_key_last($month_data)]['month_label'].'/'.$month_data[array_key_last($month_data)]['days_of_month'];

        $gantt_end_index = $month_data[array_key_last($month_data)]['index_to_end'];

        $regions = array();

        // echo "<pre>";print_r($adslot_cart);echo "</pre>";exit;
        foreach($adslot_cart[$request->selected_channel] as $region_id=>$region_data){
            $region = $this->regionRepository->findRegionById($region_id);

            $temp = array();
            $temp['id'] = $region->id;
            $temp['name'] = $region->name;
            
            $temp['adslots'] = array();
            $data_for_entire_range[$region->id]['all_repetitions_count'] = 0;
            foreach($region_data as $channel_group_id=>$channel_group_data){

                foreach($channel_group_data as $key=>$adslot_group_id){
                    $adslot_group = $this->adslotGroupRepository->findAdslotGroupById($adslot_group_id);

                    if(isset($adslot_group->availableAdslot[0])){
                        $adslot_data = array();
                        $adslot_data['gantt_start_date'] = $gantt_start_date;
                        $adslot_data['gantt_start_index'] = $gantt_start_index;
                        $adslot_data['gantt_end_date'] = $gantt_end_date;
                        $adslot_data['gantt_end_index'] = $gantt_end_index;

                        $adslot_data['channel_group'] = $adslot_group->channelGroup->name;
                        $adslot_data['channel_group_id'] = $adslot_group->channelGroup->id;
                        $adslot_data['adslot_group_id'] = $adslot_group->id;
                        $adslot_data['adslot_group'] = $adslot_group->name;
                        $adslot_data['repetitions'] = $adslot_group->availableAdslot[0]->repetitions;
                        $data_for_entire_range[$region->id]['all_repetitions_count'] += $adslot_data['repetitions'];

                        // $adslot_data['lineups'] = $this->checkAvailabilityBetweenDates($adslot_group, $request->start_date, $request->end_date);

                        /**
                         * 取得此版位的standbys
                         * */
                        $adslot_data['standbys'] = $this->getStandbys($region->id.'_'.$adslot_group->channelGroup->id.'_'.$adslot_group->id, $gantt_start_date);

                        $temp['adslots'][] = $adslot_data;
                    }

                    /**
                     * 用region id 及adslot group id 去檢查是否有related_adslot_groups
                     * */
                    $related_adslot_groups = $this->adslotGroupRepository->findRelatedAdslotGroups($region->id, $adslot_group->id);
                    if($related_adslot_groups->count() > 0){
                        foreach($related_adslot_groups as $related_adslot_group_key=>$related_adslot_group){
                            $json_decoded_data = json_decode($related_adslot_group->related_adslot_groups);
                            foreach($json_decoded_data as $json_key=>$json_data){
                                $adslot_group = $this->adslotGroupRepository->findAdslotGroupById($json_data);

                                if(isset($adslot_group->availableAdslot[0])){
                                    $adslot_data = array();
                                    $adslot_data['gantt_start_date'] = $gantt_start_date;
                                    $adslot_data['gantt_start_index'] = $gantt_start_index;
                                    $adslot_data['gantt_end_date'] = $gantt_end_date;
                                    $adslot_data['gantt_end_index'] = $gantt_end_index;

                                    $adslot_data['channel_group'] = $adslot_group->channelGroup->name;
                                    $adslot_data['channel_group_id'] = $adslot_group->channelGroup->id;
                                    $adslot_data['adslot_group_id'] = $adslot_group->id;
                                    $adslot_data['adslot_group'] = $adslot_group->name;
                                    $adslot_data['repetitions'] = $adslot_group->availableAdslot[0]->repetitions;
                                    $data_for_entire_range[$region->id]['all_repetitions_count'] += ($adslot_data['repetitions']==0 || $adslot_data['repetitions']==-1)?1:$adslot_data['repetitions'];

                                    // $adslot_data['lineups'] = $this->checkAvailabilityBetweenDates($adslot_group, $request->start_date, $request->end_date);

                                    /**
                                     * 取得此版位的standbys
                                     * */
                                    $adslot_data['standbys'] = $this->getStandbys($region->id.'_'.$adslot_group->channelGroup->id.'_'.$adslot_group->id, $gantt_start_date);

                                    $temp['adslots'][] = $adslot_data;
                                }
                            }
                        }
                    }
                }

            }

            //region 裡有選擇版位才產生gantt 
            if(count($temp['adslots']) > 0){
                $regions[] = $temp;
            }
        }
        
        $nav_tabs = view('partials.gantts._nav-tabs',['regions'=>$regions])->render();

        // echo "<pre>";print_r($regions);echo "</pre>";exit;
        // echo "<pre>";print_r($month_data);echo "</pre>";exit;

        $data_for_entire_range['all_columns_count'] = $all_columns_count;
        $data_for_entire_range['start_date'] = $request->start_date;

        $tab_content = view('partials.gantts._tab-content',['regions'=>$regions, 'month_data'=>$month_data, 'data_for_entire_range'=>$data_for_entire_range])->render();

        $return = array();
        $return['html'] = $nav_tabs.$tab_content;

        return json_encode($return);

    }

    private function getStandbys($combination_key, $start_date){
        $standbys = array();

        $insertion_details = $this->insertionRepository->getAllStandbyInsertionDetailsByCombinationKey($combination_key);

        foreach($insertion_details as $key=>$insertion_detail){
            $row = $insertion_detail->at_which_row;

            $date_ranges = json_decode($insertion_detail->dateRanges->date_ranges, true);
            // echo "<pre>";print_r($date_ranges);echo "</pre>";


            $range_start_date = strtotime($start_date);
            $now = strtotime($date_ranges[array_key_first($date_ranges)]);
            $datediff = $now - $range_start_date;

            if(isset($standbys[$row])){
                $temp = array();

                $temp['start_index'] = round($datediff / (60 * 60 * 24))+1;
                $temp['end_index'] = $temp['start_index']+count($date_ranges);
                $temp['date_ranges'] = $date_ranges;   
                $temp['customer_name'] = $insertion_detail->insertion->customer_name;
                $standbys[$row][$temp['start_index']] = $temp; 
            }
            else{
                $standbys[$row] = array();
                $temp = array();
                $temp['start_index'] = round($datediff / (60 * 60 * 24))+1;
                $temp['end_index'] = $temp['start_index']+count($date_ranges);
                $temp['date_ranges'] = $date_ranges;    
                $temp['customer_name'] = $insertion_detail->insertion->customer_name;
                $standbys[$row][$temp['start_index']] = $temp;
            }
        }

        return $standbys;

    }

    /**
     * deprecated
     * */
    private function checkAvailabilityBetweenDates($adslot_group, $start_date, $end_date){

        $availability = array();

        $position = 1;
        $row = array();
        $row['is_standby'] = false;
        $row['position'] = $position;
        $row['start_date'] = $start_date;
        $row['end_date'] = date('Y-m-d',strtotime($start_date." +".($adslot_group->availableAdslot[0]->days - 1)." days"));
        $row['start_index'] = 1;
        $row['days'] = $adslot_group->availableAdslot[0]->days;

        $availability[$position] = $row;

        return $availability;

    }

}
