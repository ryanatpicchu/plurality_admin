<?php

namespace App\Http\Controllers\AdSchedule\Edit;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Contracts\InsertionContract;
use App\Contracts\PerformanceAdContract;
use App\Contracts\ChannelContract;
use App\Contracts\RegionContract;

class EditController extends Controller
{
    protected $insertionRepository;
    protected $performanceAdRepository;
    protected $channelRepository;
    protected $regionRepository;

    public function __construct(InsertionContract $insertionRepository, PerformanceAdContract $performanceAdRepository, ChannelContract $channelRepository, RegionContract $regionRepository)
    {
        $this->insertionRepository = $insertionRepository;
        $this->performanceAdRepository = $performanceAdRepository;
        $this->channelRepository = $channelRepository;
        $this->regionRepository = $regionRepository;
    }

    
    public function index(Request $request)
    {
        $specific_insertion = '';
        $ingroup_adslot_groups = array();
        $non_ingroup_adslot_groups = array();
        $total_ingroup_adslot_groups = array();
        /**
         * 有抓到insertion_id 的，表示已有資料儲存在DB 裡，正在進行編輯的流程
         * */
        if(isset($request->insertion_id)){
            $specific_insertion = $this->insertionRepository->findInsertionById($request->insertion_id);
            $insertions = array();
            $insertions['D'] = array();
            $insertions['M'] = array();
            $insertions['R'] = array();
            $insertions['A'] = array();
            $non_digitm_channel_name = array('591','8591','8891','100');
            $digitm_channel_name = array('數字廣告');
            
            // echo "<pre>";print_r($specific_insertion->details);echo "</pre>";exit;
            foreach($specific_insertion->details as $key=>$insertion_detail){
                /**
                 * D : channel 為"非數字廣告" 且有adslot_group_id
                 * M : channel 為"數字廣告" 且有adslot_group_id
                 * 
                 * R : channel 為"非數字廣告" 且有ad_id
                 * A : channel 為"數字廣告" 且有ad_id
                 * */

                if(in_array($insertion_detail->channel->name, $non_digitm_channel_name) && !is_null($insertion_detail->adslot_group_id)){
                    if(isset($insertions['D'][$insertion_detail['combination_key']])){
                        /**
                         * 表示此版位有多段日期
                         * */
                        $insertions['D'][$insertion_detail['combination_key']]['info']['dateRanges'][] = json_decode($insertion_detail->dateRanges->date_ranges, true); 
                    }
                    else{
                        $temp = array();
                        $temp['info'] = array();
                        $temp['info']['channelId'] = $insertion_detail->channel_id;
                        $temp['info']['channel'] = $insertion_detail->channel->name;

                        $temp['info']['regionId'] = $insertion_detail->region_id;
                        $temp['info']['region'] = $insertion_detail->region->name;

                        $temp['info']['channelGroupId'] = $insertion_detail->channel_group_id;
                        $temp['info']['channelGroup'] = $insertion_detail->channelGroup->name;

                        $temp['info']['adslotGroupId'] = $insertion_detail->adslot_group_id;
                        $temp['info']['adslotGroup'] = $insertion_detail->adslotGroup->name;

                        $temp['info']['days'] = $insertion_detail->days;
                        $temp['info']['list_price'] = $insertion_detail->total_list_price;
                        $temp['info']['discount_percentage'] = $insertion_detail->discount_percentage;
                        $temp['info']['note'] = $insertion_detail->note;
                        $temp['info']['dateRanges'][] = json_decode($insertion_detail->dateRanges->date_ranges, true);    

                        $insertions['D'][$insertion_detail['combination_key']] = $temp;
                    }
                }
                elseif(in_array($insertion_detail->channel->name, $digitm_channel_name) && !is_null($insertion_detail->adslot_group_id)){
                    if(isset($insertions['M'][$insertion_detail['combination_key']])){
                        /**
                         * 表示此版位有多段日期
                         * */
                        $insertions['M'][$insertion_detail['combination_key']]['info']['dateRanges'][] = json_decode($insertion_detail->dateRanges->date_ranges, true); 
                    }
                    else{
                        $temp = array();
                        $temp['info'] = array();
                        $temp['info']['channelId'] = $insertion_detail->channel_id;
                        $temp['info']['channel'] = $insertion_detail->channel->name;

                        $temp['info']['regionId'] = $insertion_detail->region_id;
                        $temp['info']['region'] = $insertion_detail->region->name;

                        $temp['info']['channelGroupId'] = $insertion_detail->channel_group_id;
                        $temp['info']['channelGroup'] = $insertion_detail->channelGroup->name;

                        $temp['info']['adslotGroupId'] = $insertion_detail->adslot_group_id;
                        $temp['info']['adslotGroup'] = $insertion_detail->adslotGroup->name;

                        $temp['info']['days'] = $insertion_detail->days;
                        $temp['info']['list_price'] = $insertion_detail->total_list_price;
                        $temp['info']['discount_percentage'] = $insertion_detail->discount_percentage;
                        $temp['info']['note'] = $insertion_detail->note;
                        $temp['info']['dateRanges'][] = json_decode($insertion_detail->dateRanges->date_ranges, true);    

                        $insertions['M'][$insertion_detail['combination_key']] = $temp;
                    }
                }
                elseif(in_array($insertion_detail->channel->name, $non_digitm_channel_name) && !is_null($insertion_detail->ad_id)){
                    if(isset($insertions['R'][$insertion_detail['combination_key']])){
                        $temp = array();
                        $temp['channelId'] = $insertion_detail->channel_id;
                        $temp['channel'] = $insertion_detail->channel->name;

                        $temp['regionId'] = $insertion_detail->region_id;
                        $temp['region'] = $insertion_detail->region->name;

                        $temp['adId'] = $insertion_detail->ad_id;
                        $specific_ad = $this->performanceAdRepository->findPerformanceAdById($insertion_detail->ad_id);
                        $temp['ad'] = $specific_ad->name;
                        $temp['list_price'] = $specific_ad->list_price;

                        $temp['days'] = $insertion_detail->days;
                        
                        $temp['sales_unit'] = $insertion_detail->sales_unit;
                        $temp['dateRanges'][] = json_decode($insertion_detail->dateRanges->date_ranges, true);    
                        $temp['subtotal_sale_price'] = $insertion_detail->total_sale_price;

                        $insertions['R'][$insertion_detail['combination_key']]['info'][] = $temp;
                    }
                    else{
                        
                        $temp = array();
                        $temp['channelId'] = $insertion_detail->channel_id;
                        $temp['channel'] = $insertion_detail->channel->name;

                        $temp['regionId'] = $insertion_detail->region_id;
                        $temp['region'] = $insertion_detail->region->name;

                        $temp['adId'] = $insertion_detail->ad_id;
                        $specific_ad = $this->performanceAdRepository->findPerformanceAdById($insertion_detail->ad_id);
                        $temp['ad'] = $specific_ad->name;
                        $temp['list_price'] = $specific_ad->list_price;

                        $temp['days'] = $insertion_detail->days;
                        
                        $temp['sales_unit'] = $insertion_detail->sales_unit;
                        $temp['dateRanges'][] = json_decode($insertion_detail->dateRanges->date_ranges, true);    
                        $temp['subtotal_sale_price'] = $insertion_detail->total_sale_price;

                        $insertions['R'][$insertion_detail['combination_key']] = array();
                        $insertions['R'][$insertion_detail['combination_key']]['info'] = array();
                        $insertions['R'][$insertion_detail['combination_key']]['info'][] = $temp;
                    }
                }
                elseif(in_array($insertion_detail->channel->name, $digitm_channel_name) && !is_null($insertion_detail->ad_id)){
                    if(isset($insertions['A'][$insertion_detail['combination_key']])){
                        $temp = array();
                        $temp['channelId'] = $insertion_detail->channel_id;
                        $temp['channel'] = $insertion_detail->channel->name;

                        $temp['regionId'] = $insertion_detail->region_id;
                        $temp['region'] = $insertion_detail->region->name;

                        $temp['adId'] = $insertion_detail->ad_id;
                        $specific_ad = $this->performanceAdRepository->findPerformanceAdById($insertion_detail->ad_id);
                        $temp['ad'] = $specific_ad->name;
                        $temp['list_price'] = $specific_ad->list_price;

                        $temp['days'] = $insertion_detail->days;
                        
                        $temp['sales_unit'] = $insertion_detail->sales_unit;
                        $temp['dateRanges'][] = json_decode($insertion_detail->dateRanges->date_ranges, true);    
                        $temp['subtotal_sale_price'] = $insertion_detail->total_sale_price;

                        $insertions['A'][$insertion_detail['combination_key']]['info'][] = $temp;
                    }
                    else{
                        
                        $temp = array();
                        $temp['channelId'] = $insertion_detail->channel_id;
                        $temp['channel'] = $insertion_detail->channel->name;

                        $temp['regionId'] = $insertion_detail->region_id;
                        $temp['region'] = $insertion_detail->region->name;

                        $temp['adId'] = $insertion_detail->ad_id;
                        $specific_ad = $this->performanceAdRepository->findPerformanceAdById($insertion_detail->ad_id);
                        $temp['ad'] = $specific_ad->name;
                        $temp['list_price'] = $specific_ad->list_price;

                        $temp['days'] = $insertion_detail->days;
                        
                        $temp['sales_unit'] = $insertion_detail->sales_unit;
                        $temp['dateRanges'][] = json_decode($insertion_detail->dateRanges->date_ranges, true);    
                        $temp['subtotal_sale_price'] = $insertion_detail->total_sale_price;

                        $insertions['A'][$insertion_detail['combination_key']] = array();
                        $insertions['A'][$insertion_detail['combination_key']]['info'] = array();
                        $insertions['A'][$insertion_detail['combination_key']]['info'][] = $temp;
                    }
                }
                
            }

            if(isset($insertions['D'])){
                foreach($insertions['D'] as $combination_key=>$adslot_group){
                    $non_ingroup_adslot_groups['D'][$combination_key] = $insertions['D'][$combination_key];
                }
            }
            
            if(isset($insertions['M'])){
                foreach($insertions['M'] as $combination_key=>$adslot_group){
                    $non_ingroup_adslot_groups['M'][$combination_key] = $insertions['M'][$combination_key];
                }
            }

            Session::put('insertions', $insertions);
            
            // echo "<pre>";print_r($non_ingroup_adslot_groups);echo "</pre>";exit;
        }
        else{
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


            if(!is_null($insertions)){
                foreach($insertions as $adslot_type=>$adslot_groups){

                    foreach($adslot_groups as $combination_key=>$adslot_group){

                        if(!isset($ingroup_adslot_groups[$adslot_type][$combination_key])){
                            if(isset($insertions[$adslot_type]) && !is_null($insertions[$adslot_type])){
                                $non_ingroup_adslot_groups[$adslot_type][$combination_key] = $insertions[$adslot_type][$combination_key];    
                            }
                        }

                    }

                }
            }
            
            
            
        }
        
        // echo "<pre>";print_r($insertions);echo "</pre>";exit;
        // echo "<pre>total:";print_r($total_ingroup_adslot_groups);echo "</pre>";
        // echo "<pre>in:";print_r($ingroup_adslot_groups);echo "</pre>";
        // echo "<pre>non:";print_r($non_ingroup_adslot_groups);echo "</pre>";exit;
        
        $all_remarketing_channels = $this->channelRepository->getAllExcludeSpecifics(1,array('數字廣告'));
        $all_agent_channels = $this->channelRepository->getAllExcludeSpecifics(1,array('591','8891','8591','100'));

        // $related_regions = $all_channels[0]->relatedRegion;

        // $all_remarketing_ads = $this->performanceAdRepository->getAll($all_channels[0]->id);


        return view('pages.ad-schedule.edit.index',[
            'insertions'=>$insertions, 
            'specific_insertion'=>$specific_insertion,
            'total_ingroup_adslot_groups'=>$total_ingroup_adslot_groups,
            'ingroup'=>$ingroup_adslot_groups,
            'non_ingroup'=>$non_ingroup_adslot_groups,
            'all_remarketing_channels'=>$all_remarketing_channels,
            'all_agent_channels'=>$all_agent_channels,
        ]);
    }

    public function updateRemarketingAdslot(Request $request){
        $insertions = Session::get('insertions');

        // echo "<pre>";print_r($insertions);echo "</pre>";
        // echo "<pre>";print_r($request->all());echo "</pre>";exit;

       
        $combination_key = $request->combination_key;
        $row = $request->row;
        $channel_id = $request->channel_id;
        $region_id = $request->region_id;
        $ad_id = $request->ad_id;

        $original_ad = $insertions['R'][$combination_key]['info'][$row];
        
        // echo "<pre>";print_r($original_ad);echo "</pre>";exit;

        /**
         * 如果combination + row 在insertion 裡的資料，與request 資料相符合，則更新
         * 
         * 不符合，則刪除原資料，並reset 原combination 裡的key 排序
         * */

        if($original_ad['channelId'] == $channel_id && $original_ad['regionId'] == $region_id){

            /**
             * 處理ad
             * */
            if($original_ad['adId'] != $ad_id){ //update ad

                $insertions['R'][$combination_key]['info'][$row]['adId'] = $ad_id;

                $ad = $this->performanceAdRepository->findPerformanceAdById($ad_id);
                $insertions['R'][$combination_key]['info'][$row]['ad'] = $ad->name;

                //ad 更改，單位售價也會變更
                $insertions['R'][$combination_key]['info'][$row]['list_price'] = $ad->list_price;
                $insertions['R'][$combination_key]['info'][$row]['sales_unit'] = $ad->sales_unit;
            }

            /**
             * 處理dateRanges
             * */
            $days = floor((strtotime($request->end_date) - strtotime($request->start_date)) / (60 * 60 * 24))+1;

            $insertions['R'][$combination_key]['info'][$row]['days'] = $days;

            $temp = array();
            $temp[] = $request->start_date;
            if($days > 1){
                for($i=1;$i<$days;$i++){
                    $temp[] = date('Y-m-d',strtotime($request->start_date.' +'.$i.' days'));
                }
            }

            $insertions['R'][$combination_key]['info'][$row]['dateRanges'][0] = $temp;
            

            if(is_null($request->subtotal_sale_price)){
                $subtotal_sale_price = 0;
            }
            else{
                $subtotal_sale_price = $request->subtotal_sale_price;
            }
            
            $insertions['R'][$combination_key]['info'][$row]['subtotal_sale_price'] = $subtotal_sale_price;
        }
        else{
            //刪除原資料
            unset($insertions['R'][$combination_key]['info'][$row]);

            /**
             * reset keys
             * */
            $insertions['R'][$combination_key]['info'] = array_values($insertions['R'][$combination_key]['info']);

            //新增資料，依據request datas
            $request_combination_key = $region_id.'_'.$ad_id;

            if(!isset($insertions['R'][$request_combination_key])){
                $insertions['R'][$request_combination_key] = array();
                $insertions['R'][$request_combination_key]['info'] = array();
            }

            $temp = array();

            $channel = $this->channelRepository->findChannelById($channel_id);
            $temp['channelId'] = $channel_id;
            $temp['channel'] = $channel->name;


            $region = $this->regionRepository->findRegionById($region_id);
            $temp['regionId'] = $region_id;
            $temp['region'] = $region->name;

            $performance_ad = $this->performanceAdRepository->findPerformanceAdById($ad_id);
            $temp['adId'] = $ad_id;
            $temp['ad'] = $performance_ad->name;

            $days = floor((strtotime($request->end_date) - strtotime($request->start_date)) / (60 * 60 * 24))+1;

            $temp['days'] = $days;
            $temp['list_price'] = $performance_ad->list_price;
            $temp['sales_unit'] = $performance_ad->sales_unit;

            $temp['dateRanges'] = array();
            
            $date_ranges = array();
            $date_ranges[] = $request->start_date;
            if($days > 1){
                for($i=1;$i<$days;$i++){
                    $date_ranges[] = date('Y-m-d',strtotime($request->start_date.' +'.$i.' days'));
                }
            }

            $temp['dateRanges'][0] = $date_ranges;

            $insertions['R'][$request_combination_key]['info'][] = $temp;
        }

        // echo "<pre>";print_r($insertions);echo "</pre>";exit;
        Session::put('insertions', $insertions);

        $all_remarketing_channels = $this->channelRepository->getAllExcludeSpecifics(1,array('數字廣告'));

        $return = array();
        $return['html'] = view('partials.ad-schedule.edit._tab-content-remarketing',[
            'insertions'=>$insertions, 
            'all_remarketing_channels'=>$all_remarketing_channels
        ])->render();


        return json_encode($return);
    }

    public function updateAgentAdslot(Request $request){
        $insertions = Session::get('insertions');

        // echo "<pre>";print_r($insertions);echo "</pre>";
        // echo "<pre>";print_r($request->all());echo "</pre>";exit;

       
        $combination_key = $request->combination_key;
        $row = $request->row;
        $channel_id = $request->channel_id;
        $region_id = $request->region_id;
        $ad_id = $request->ad_id;

        $original_ad = $insertions['A'][$combination_key]['info'][$row];
        
        // echo "<pre>";print_r($original_ad);echo "</pre>";exit;

        /**
         * 如果combination + row 在insertion 裡的資料，與request 資料相符合，則更新
         * 
         * 不符合，則刪除原資料，並reset 原combination 裡的key 排序
         * */

        if($original_ad['channelId'] == $channel_id && $original_ad['regionId'] == $region_id){

            /**
             * 處理ad
             * */
            if($original_ad['adId'] != $ad_id){ //update ad

                $insertions['A'][$combination_key]['info'][$row]['adId'] = $ad_id;

                $ad = $this->performanceAdRepository->findPerformanceAdById($ad_id);
                $insertions['A'][$combination_key]['info'][$row]['ad'] = $ad->name;

                //ad 更改，單位售價也會變更
                $insertions['A'][$combination_key]['info'][$row]['list_price'] = $ad->list_price;
                $insertions['A'][$combination_key]['info'][$row]['sales_unit'] = $ad->sales_unit;
            }

            /**
             * 處理dateRanges
             * */
            $days = floor((strtotime($request->end_date) - strtotime($request->start_date)) / (60 * 60 * 24))+1;

            $insertions['A'][$combination_key]['info'][$row]['days'] = $days;

            $temp = array();
            $temp[] = $request->start_date;
            if($days > 1){
                for($i=1;$i<$days;$i++){
                    $temp[] = date('Y-m-d',strtotime($request->start_date.' +'.$i.' days'));
                }
            }

            $insertions['A'][$combination_key]['info'][$row]['dateRanges'][0] = $temp;
            

            if(is_null($request->subtotal_sale_price)){
                $subtotal_sale_price = 0;
            }
            else{
                $subtotal_sale_price = $request->subtotal_sale_price;
            }
            
            $insertions['A'][$combination_key]['info'][$row]['subtotal_sale_price'] = $subtotal_sale_price;
        }
        else{
            //刪除原資料
            unset($insertions['A'][$combination_key]['info'][$row]);

            /**
             * reset keys
             * */
            $insertions['A'][$combination_key]['info'] = array_values($insertions['A'][$combination_key]['info']);

            //新增資料，依據request datas
            $request_combination_key = $region_id.'_'.$ad_id;

            if(!isset($insertions['A'][$request_combination_key])){
                $insertions['A'][$request_combination_key] = array();
                $insertions['A'][$request_combination_key]['info'] = array();
            }

            $temp = array();

            $channel = $this->channelRepository->findChannelById($channel_id);
            $temp['channelId'] = $channel_id;
            $temp['channel'] = $channel->name;


            $region = $this->regionRepository->findRegionById($region_id);
            $temp['regionId'] = $region_id;
            $temp['region'] = $region->name;

            $performance_ad = $this->performanceAdRepository->findPerformanceAdById($ad_id);
            $temp['adId'] = $ad_id;
            $temp['ad'] = $performance_ad->name;

            $days = floor((strtotime($request->end_date) - strtotime($request->start_date)) / (60 * 60 * 24))+1;

            $temp['days'] = $days;
            $temp['list_price'] = $performance_ad->list_price;
            $temp['sales_unit'] = $performance_ad->sales_unit;

            $temp['dateRanges'] = array();
            
            $date_ranges = array();
            $date_ranges[] = $request->start_date;
            if($days > 1){
                for($i=1;$i<$days;$i++){
                    $date_ranges[] = date('Y-m-d',strtotime($request->start_date.' +'.$i.' days'));
                }
            }

            $temp['dateRanges'][0] = $date_ranges;

            $insertions['A'][$request_combination_key]['info'][] = $temp;
        }

        // echo "<pre>";print_r($insertions);echo "</pre>";exit;
        Session::put('insertions', $insertions);

        $all_agent_channels = $this->channelRepository->getAllExcludeSpecifics(1,array('591','8891','8591','100'));

        $return = array();
        $return['html'] = view('partials.ad-schedule.edit._tab-content-agent',[
            'insertions'=>$insertions, 
            'all_agent_channels'=>$all_agent_channels
        ])->render();


        return json_encode($return);
    }

    public function addRemarketingAdslot(Request $request){
        // echo "<pre>";print_r($request->all());echo "</pre>";exit;
        

        /**
         * 取得所有站台ID，除了"數字廣告"站台
         * 
         * 因為"數字廣告"站台的成效型廣告，被歸類於"廣告代操"，非"再行銷"
         * */

        $all_channels = $this->channelRepository->getAllExcludeSpecifics(1,array('數字廣告'));
        
        $related_regions = $all_channels[0]->relatedRegion;

        $all_remarketing_ads = $this->performanceAdRepository->getAll($all_channels[0]->id);

        $insertions = Session::get('insertions');
        
        // echo "<pre>1";print_r($insertions);echo "</pre>";

        $default_combination_key = $related_regions[0]->id.'_'.$all_remarketing_ads[0]->id;
        $default_date_ranges = array();
        //current date
        $default_date_ranges[0] = date('Y-m-d');

        if(!isset($insertions['R'])){
            $insertions['R'] = array();
        }

        if(isset($insertions['R'][$default_combination_key])){
            $temp = array();

            $temp['channelId'] = $all_channels[0]->id;
            $temp['channel'] = $all_channels[0]->name;

            $temp['regionId'] = $related_regions[0]->id;
            $temp['region'] = $related_regions[0]->name;

            $temp['adId'] = $all_remarketing_ads[0]->id;
            $temp['ad'] = $all_remarketing_ads[0]->name;

            $temp['days'] = 1;
            $temp['list_price'] = $all_remarketing_ads[0]->list_price;
            $temp['sale_price'] = $all_remarketing_ads[0]->list_price;
            $temp['sales_unit'] = $all_remarketing_ads[0]->sales_unit;

            $temp['dateRanges'] = array();
            $temp['dateRanges'][] = $default_date_ranges;
            $insertions['R'][$default_combination_key]['info'][] = $temp;

        }
        else{
            $insertions['R'][$default_combination_key] = array();
            $insertions['R'][$default_combination_key]['info'] = array();

            $temp = array();

            $temp['channelId'] = $all_channels[0]->id;
            $temp['channel'] = $all_channels[0]->name;

            $temp['regionId'] = $related_regions[0]->id;
            $temp['region'] = $related_regions[0]->name;

            $temp['adId'] = $all_remarketing_ads[0]->id;
            $temp['ad'] = $all_remarketing_ads[0]->name;

            $temp['days'] = 1;
            $temp['list_price'] = $all_remarketing_ads[0]->list_price;
            $temp['sale_price'] = $all_remarketing_ads[0]->list_price;
            $temp['sales_unit'] = $all_remarketing_ads[0]->sales_unit;

            $temp['dateRanges'] = array();
            $temp['dateRanges'][] = $default_date_ranges;

            $insertions['R'][$default_combination_key]['info'][] = $temp;
        }

        // echo "<pre>2";print_r($insertions);echo "</pre>";
        
        Session::put('insertions', $insertions); 

        // $insertions = Session::get('insertions');

        // echo "<pre>3";print_r($insertions);echo "</pre>";exit;
        

        $rows_count = 0;

        foreach($insertions['R'] as $combination_key=>$ads){
            $rows_count+= count($ads['info']);
        }


        $return = array();

        $return['html'] = view('partials.tables.ad-schedule._new-remarketing-adslot',
            [
                'rows'=>($rows_count-1),
                'remarketing_combination_key'=>$default_combination_key,
                'all_channels'=>$all_channels,
                'related_regions'=>$related_regions,
                'all_remarketing_ads'=>$all_remarketing_ads,
                'start_date'=>date('Y-m-d'),
                'end_date'=>date('Y-m-d'),
                'list_price'=>$all_remarketing_ads[0]->list_price,
                'sale_price'=>$all_remarketing_ads[0]->sale_price,
            ]
        )->render();

        return json_encode($return);
    }

    public function addAgentAdslot(Request $request){
        // echo "<pre>";print_r($request->all());echo "</pre>";exit;
        

        /**
         * 取得"數字廣告"站台ID
         * 
         * "數字廣告"站台的成效型廣告，被歸類於"廣告代操"
         * */

        $all_channels = $this->channelRepository->getAllExcludeSpecifics(1,array('591','8891','8591','100'));
        
        $related_regions = $all_channels[0]->relatedRegion;

        $all_agent_ads = $this->performanceAdRepository->getAll($all_channels[0]->id);

        $insertions = Session::get('insertions');
        // echo "<pre>";print_r($insertions);echo "</pre>";

        $default_combination_key = $related_regions[0]->id.'_'.$all_agent_ads[0]->id;
        $default_date_ranges = array();
        //current date
        $default_date_ranges[0] = date('Y-m-d');

        if(!isset($insertions['A'])){
            $insertions['A'] = array();
        }

        if(isset($insertions['A'][$default_combination_key])){
            $temp = array();

            $temp['channelId'] = $all_channels[0]->id;
            $temp['channel'] = $all_channels[0]->name;

            $temp['regionId'] = $related_regions[0]->id;
            $temp['region'] = $related_regions[0]->name;

            $temp['adId'] = $all_agent_ads[0]->id;
            $temp['ad'] = $all_agent_ads[0]->name;

            $temp['days'] = 1;
            $temp['list_price'] = $all_agent_ads[0]->list_price;
            $temp['sales_unit'] = $all_agent_ads[0]->sales_unit;

            $temp['dateRanges'] = array();
            $temp['dateRanges'][] = $default_date_ranges;
            $insertions['A'][$default_combination_key]['info'][] = $temp;

        }
        else{
            $insertions['A'][$default_combination_key] = array();
            $insertions['A'][$default_combination_key]['info'] = array();

            $temp = array();

            $temp['channelId'] = $all_channels[0]->id;
            $temp['channel'] = $all_channels[0]->name;

            $temp['regionId'] = $related_regions[0]->id;
            $temp['region'] = $related_regions[0]->name;

            $temp['adId'] = $all_agent_ads[0]->id;
            $temp['ad'] = $all_agent_ads[0]->name;

            $temp['days'] = 1;
            $temp['list_price'] = $all_agent_ads[0]->list_price;
            $temp['sales_unit'] = $all_agent_ads[0]->sales_unit;

            $temp['dateRanges'] = array();
            $temp['dateRanges'][] = $default_date_ranges;

            $insertions['A'][$default_combination_key]['info'][] = $temp;
        }

        Session::put('insertions', $insertions);

        $rows_count = 0;

        foreach($insertions['A'] as $combination_key=>$ads){
            if($combination_key == $default_combination_key){
                $rows_count+= count($ads['info']);
            }
        }


        $return = array();

        $return['html'] = view('partials.tables.ad-schedule._new-agent-adslot',
            [
                'rows'=>($rows_count-1),
                'agent_combination_key'=>$default_combination_key,
                'all_channels'=>$all_channels,
                'related_regions'=>$related_regions,
                'all_agent_ads'=>$all_agent_ads,
                'start_date'=>date('Y-m-d'),
                'end_date'=>date('Y-m-d'),
                'list_price'=>$all_agent_ads[0]->list_price,
            ]
        )->render();

        return json_encode($return);
    }

    public function calculateTotalPrice(){
        $insertions = Session::get('insertions');
        // echo "<pre>";print_r($insertions);echo "</pre>";exit;

        $total_subtotal_list_price = 0;
        $total_subtotal_sale_price = 0;

        if(isset($insertions['D'])){
            foreach($insertions['D'] as $combination_key=>$adslot_group){

                $total_subtotal_list_price += ($adslot_group['info']['list_price']*count($adslot_group['info']['dateRanges']));
                $sale_price = ($adslot_group['info']['list_price']*count($adslot_group['info']['dateRanges']))*(1-($adslot_group['info']['discount_percentage']/100));
                $total_subtotal_sale_price += $sale_price;
                
            }
        }
        
        if(isset($insertions['M'])){
            foreach($insertions['M'] as $combination_key=>$adslot_group){
                $total_subtotal_list_price += ($adslot_group['info']['list_price']*count($adslot_group['info']['dateRanges']));
                $sale_price = ($adslot_group['info']['list_price']*count($adslot_group['info']['dateRanges']))*(1-($adslot_group['info']['discount_percentage']/100));
                $total_subtotal_sale_price += $sale_price;
                
            }
        }
        

        if(isset($insertions['A'])){
            foreach($insertions['A'] as $combination_key=>$adslot_group){
                foreach($adslot_group['info'] as $key=>$adslot){
                    $total_subtotal_list_price += isset($adslot['subtotal_sale_price'])?$adslot['subtotal_sale_price']:0;
                    $total_subtotal_sale_price += isset($adslot['subtotal_sale_price'])?$adslot['subtotal_sale_price']:0;
                }
            }    
        }
        
        if(isset($insertions['R'])){
            foreach($insertions['R'] as $combination_key=>$adslot_group){
                foreach($adslot_group['info'] as $key=>$adslot){
                    $total_subtotal_list_price += isset($adslot['subtotal_sale_price'])?$adslot['subtotal_sale_price']:0;
                    $total_subtotal_sale_price += isset($adslot['subtotal_sale_price'])?$adslot['subtotal_sale_price']:0;
                }
            }    
        }
        

        $return = array();
        $return['total_subtotal_list_price'] = number_format($total_subtotal_list_price);
        $return['total_subtotal_sale_price'] = number_format($total_subtotal_sale_price);
        if($total_subtotal_list_price > 0){
            $return['total_discount_percentage'] = number_format((1-($total_subtotal_list_price-$total_subtotal_sale_price)/$total_subtotal_list_price)*100, 2).'%' ;
        }
        else{
            $return['total_discount_percentage'] = 0;
        }
        

        return json_encode($return);
    }
}
