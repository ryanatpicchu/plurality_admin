<?php

namespace App\Http\Controllers\AdManagement\Adslot;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts\ChannelContract;
use App\Contracts\AdslotGroupContract;
use App\Contracts\AdslotContract;
use App\Contracts\RegionContract;
use App\Contracts\PreviewImageContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdslotController extends Controller
{
    protected $channelRepository;
    protected $adslotGroupRepository;
    protected $adslotRepository;
    protected $regionRepository;
    protected $previewImageRepository;

    public function __construct(ChannelContract $channelRepository, AdslotGroupContract $adslotGroupRepository, AdslotContract $adslotRepository, RegionContract $regionRepository, PreviewImageContract $previewImageRepository)
    {
        $this->channelRepository = $channelRepository;
        $this->adslotGroupRepository = $adslotGroupRepository;
        $this->adslotRepository = $adslotRepository;
        $this->regionRepository = $regionRepository;
        $this->previewImageRepository = $previewImageRepository;
    }
    
    public function list()
    {
        $channels = $this->channelRepository->getAll(true);
        return view('pages.ad-management.adslot.list',['channels'=>$channels]);
    }

    public function adslotGeneralListTableHeader(){
        $header = config('global.table.headers.adslot_general_list');    

        $return = array();
        $return['headers'] = view('partials.tables.ad-management._adslot-general-list-table-headers',['header'=>$header])->render();
        $return['columns'] = array();

        // echo "<pre>";print_r($return['headers']);echo "</pre>";exit;

        foreach($header as $key=>$val){
            $return['columns'][] = array('data'=>$val);
        }

        
        return json_encode($return);
    }

    public function adslotGeneralListTable(Request $request){
        if(!isset($request->sale_status) || $request->sale_status == 'false'){
            $sale_status = null;
        }
        else $sale_status = 1;

        // var_dump($request->channel);

        if(!isset($request->channel) || $request->channel == -1){
            $channel = null;
        }
        else $channel = $request->channel;


        if(!isset($request->region) || $request->region == -1){
            $region = null;
        }
        else $region = $request->region;


        if(!isset($request->channel_group) || $request->channel_group == -1){
            $channel_group = null;
        }
        else $channel_group = $request->channel_group;

        $channel_group_type = 'general';
        $all_list = $this->adslotRepository->getAllAdslotsByRequests($channel, $region, $channel_group, $sale_status, $channel_group_type);

        $datatable_head = config('global.table.headers.adslot_general_list');    

        $order_by = $datatable_head[$request->order[0]['column']];
        $order_by_dir = $request->order[0]['dir'];
        $offset = $request->start;

        if($request->length == '-1'){// table length : show all
            $limit = count($all_list);
        }
        else{
            $limit = $request->length;
        }

        $search_value = $request->search['value'];

        $filtered_list = $this->adslotRepository->getAdslotsByRequests($order_by, $order_by_dir, $offset, $limit, $search_value,$channel, $region, $channel_group, $sale_status, $channel_group_type);


        foreach($filtered_list as $key => $item){
            // echo "<pre>";print_r($item);echo "</pre>";exit;            
            foreach($datatable_head as $head_key => $head){
                if (view()->exists('partials/tables/ad-management/_adslot-general-list-table-'.$head)) {
                    $return['data'][$key][$head] = view('partials/tables/ad-management/_adslot-general-list-table-'.$head,['data'=>$item[$head],'item_id'=>$item->id,'item'=>$item])->render();
                }
                else{
                    $return['data'][$key][$head] = view('partials/tables/ad-management/_adslot-general-list-table',['data'=>$item[$head], 'key'=>$head])->render();  
                }
                
            }

        }

        if(isset($request->draw)){
            $return['draw'] = $request->draw;
        }
        else $return['draw'] = 1;

        $return['recordsTotal'] = count($filtered_list);
        if(is_null($search_value)){
            $return['recordsFiltered'] = count($all_list);
        }
        else{
            $return['recordsFiltered'] = count($filtered_list);
        }
        

        return json_encode($return);
    }

    public function adslotSpecialListTableHeader(){
        $header = config('global.table.headers.adslot_special_list');    

        $return = array();
        $return['headers'] = view('partials.tables.ad-management._adslot-special-list-table-headers',['header'=>$header])->render();
        $return['columns'] = array();

        // echo "<pre>";print_r($return['headers']);echo "</pre>";exit;

        foreach($header as $key=>$val){
            $return['columns'][] = array('data'=>$val);
        }

        
        return json_encode($return);
    }

    public function adslotSpecialListTable(Request $request){
        if(!isset($request->sale_status) || $request->sale_status == 'false'){
            $sale_status = null;
        }
        else $sale_status = 1;

        // var_dump($request->channel);

        if(!isset($request->channel) || $request->channel == -1){
            $channel = null;
        }
        else $channel = $request->channel;


        if(!isset($request->region) || $request->region == -1){
            $region = null;
        }
        else $region = $request->region;


        if(!isset($request->channel_group) || $request->channel_group == -1){
            $channel_group = null;
        }
        else $channel_group = $request->channel_group;

        $channel_group_type = 'special';
        $all_list = $this->adslotRepository->getAllAdslotsByRequests($channel, $region, $channel_group, $sale_status, $channel_group_type);

        $datatable_head = config('global.table.headers.adslot_special_list');    

        $order_by = $datatable_head[$request->order[0]['column']];
        $order_by_dir = $request->order[0]['dir'];
        $offset = $request->start;

        if($request->length == '-1'){// table length : show all
            $limit = count($all_list);
        }
        else{
            $limit = $request->length;
        }

        $search_value = $request->search['value'];

        $filtered_list = $this->adslotRepository->getAdslotsByRequests($order_by, $order_by_dir, $offset, $limit, $search_value,$channel, $region, $channel_group, $sale_status, $channel_group_type);


        foreach($filtered_list as $key => $item){
            // echo "<pre>";print_r($item);echo "</pre>";exit;            
            foreach($datatable_head as $head_key => $head){
                if (view()->exists('partials/tables/ad-management/_adslot-special-list-table-'.$head)) {
                    $return['data'][$key][$head] = view('partials/tables/ad-management/_adslot-special-list-table-'.$head,['data'=>$item[$head],'item_id'=>$item->id,'item'=>$item])->render();
                }
                else{
                    $return['data'][$key][$head] = view('partials/tables/ad-management/_adslot-special-list-table',['data'=>$item[$head], 'key'=>$head])->render();  
                }
                
            }

        }

        if(isset($request->draw)){
            $return['draw'] = $request->draw;
        }
        else $return['draw'] = 1;

        $return['recordsTotal'] = count($filtered_list);
        if(is_null($search_value)){
            $return['recordsFiltered'] = count($all_list);
        }
        else{
            $return['recordsFiltered'] = count($filtered_list);
        }
        

        return json_encode($return);
    }

    public function viewAdslotDetail(Request $request){

        $adslot = $this->adslotRepository->findAdslotById($request->adslot_id);
        
        if(!is_null($request->region_id)){
            $region = $this->regionRepository->findRegionById($request->region_id);
        }
        else{
            $region = '';
        }


        // echo $adslot->adslotGroup->channelGroup->name;exit;

        $preview_images = $this->previewImageRepository->getAll();

        $return = array();
        $return['modelContent'] = view('partials.modals.ad-management._view-adslot-detail',['adslot'=>$adslot,'preview_images'=>$preview_images,'region'=>$region])->render();

        return json_encode($return);
    }

    public function createAdslot(Request $request){

        $referrer = $request->header('Referer');
        $url_parts = parse_url($referrer);
        $param_adslot_group_id = explode('=',$url_parts['query']);
        $adslot_group_id = $param_adslot_group_id[1];

        $adslot_group = $this->adslotGroupRepository->findAdslotGroupById($adslot_group_id);

        $available_regions = $adslot_group->channelGroup->relatedRegion;
        $preview_images = $this->previewImageRepository->getAll();

        $temp = Session::get('tempAdslot');

        $return = array();
        $return['modelContent'] = view('partials.modals.ad-management._create-adslot',['adslot_group'=>$adslot_group, 'temp'=>$temp, 'available_regions'=>$available_regions, 'preview_images'=>$preview_images])->render();

        return json_encode($return);
    }

    public function tempStore(Request $request){
        // echo "<pre>";print_r($request->all());echo "</pre>";exit;
        /**
         * 先暫存版位資料
         * 待下一步設定完畢後使用
         * */
        $request->validate([
            'spec'          => 'required',
            'region'      => 'required|min:1',
            'days'          => 'exclude_unless:pricing_method,==,by_days|required',
            'impressions'   => 'exclude_unless:pricing_method,==,by_days|required',
        ]);

        /**
         * 清除session 資料
         * */
        Session::forget('tempAdslot');

        $params = array();
        $params['spec'] = (!is_null($request->spec))?$request->spec:'';
        $params['repetitions'] = $request->repetitions;
        $params['display_repetitions'] = $request->display_repetitions;
        $params['pricing_method'] = $request->pricing_method;
        $params['display_type'] = $request->display_type;
        $params['profit_share_type'] = $request->profit_share_type;
        $params['days'] = $request->days;
        $params['impressions'] = $request->impressions;
        $params['sale_status'] = $request->sale_status;
        $params['preview_image_id'] = $request->preview_image_id;
        $params['note'] = (!is_null($request->note))?$request->note:'';

        $referrer = $request->header('Referer');
        $url_parts = parse_url($referrer);
        $param_adslot_group_id = explode('=',$url_parts['query']);
        $adslot_group_id = $param_adslot_group_id[1];

        $params['adslot_group_id'] = $adslot_group_id;
        $params['regions'] = $request->region;
        /**
         * 需合併販售的版位
         * */
        if(!is_null($request->related_package_adslot_group)){
            $params['related_package_adslot_group'] = $request->related_package_adslot_group;
            $params['related_package_type'] = $request->related_package_type;
        }

        /**
         * 隨之附贈的版位
         * */
        if(!is_null($request->related_giveaway_adslot_group)){
            $params['related_giveaway_adslot_group'] = $request->related_giveaway_adslot_group;
            $params['related_giveaway_type'] = $request->related_giveaway_type;
        }
        
        // $params['created_by'] = Auth::user()->id;

        Session::put('tempAdslot', $params);

        $adslot_group = $this->adslotGroupRepository->findAdslotGroupById($adslot_group_id);

        $available_regions = $adslot_group->channelGroup->relatedRegion;

        $return = array();
        $return['modelContent'] = view('partials.modals.ad-management._create-adslot-region-settings',['available_regions'=>$available_regions,'temp'=>$params])->render();

        return json_encode($return);

    }

    public function store(Request $request){
        $temp = Session::get('tempAdslot');

        $request->validate([
            'list_price.*'    => 'required',
            'start_date.*'    => 'required|date|before:end_date.*',
            'end_date.*'      => 'required|date',
        ]);

        // echo "<pre>";print_r($temp);echo "</pre>";
        // echo "<pre>";print_r($request->all());echo "</pre>";exit;

        foreach($request->region_id as $key=>$region_id){
            $params = array();
            $params['spec'] = (!is_null($temp['spec']))?$temp['spec']:'';
            $params['repetitions'] = $temp['repetitions'];
            $params['display_repetitions'] = $temp['display_repetitions'];
            $params['pricing_method'] = $temp['pricing_method'];
            $params['list_price'] = $request->list_price[$key];
            $params['days'] = (!is_null($temp['days']))?$temp['days']:null;
            $params['impressions'] = (!is_null($temp['impressions']))?$temp['impressions']:null;
            $params['display_type'] = $temp['display_type'];
            $params['profit_share_type'] = $temp['profit_share_type'];
            $params['start_date'] = $request->start_date[$key];
            $params['end_date'] = $request->end_date[$key];
            $params['sale_status'] = $temp['sale_status'];
            $params['preview_image_id'] = $temp['preview_image_id'];
            $params['note'] = (!is_null($temp['note']))?$temp['note']:'';
            $params['adslot_group_id'] = $temp['adslot_group_id'];
            $params['created_by'] = Auth::user()->id;


            $adslot = $this->adslotRepository->createAdslot($params);

            $region_temp = array();
            $region_temp['adslot_id'] = $adslot->id;
            $region_temp['region_id'] = $region_id;

            $adslot_region = $this->regionRepository->updateAdslotRegions($adslot->id, $region_temp);


            /**
             * 記錄相關聯之adslot groups
             * */
            $related_adslot_group = array();

            if(isset($temp['related_package_adslot_group'])){
                $temp_related = array();
                $temp_related['type'] = 'package';
                $temp_related['related_type'] = $temp['related_package_type'];

                $temp_related['region_id'] = $region_id;
                $temp_related['adslot_group_id'] = $params['adslot_group_id'];
                $temp_related['related_adslot_groups'] = json_encode($temp['related_package_adslot_group']);

                $related_adslot_group[] = $temp_related;
            }

            if(isset($temp['related_giveaway_adslot_group'])){
                $temp_related = array();
                $temp_related['type'] = 'giveaway';
                $temp_related['related_type'] = $temp['related_giveaway_type'];

                $temp_related['region_id'] = $region_id;
                $temp_related['adslot_group_id'] = $params['adslot_group_id'];
                $temp_related['related_adslot_groups'] = json_encode($temp['related_giveaway_adslot_group']);

                $related_adslot_group[] = $temp_related;
            }

            if(!empty($related_adslot_group)){
                $this->adslotGroupRepository->updateRelatedAdslotGroups($region_id, $params['adslot_group_id'], $related_adslot_group);
            }
            
        }
        

        $return = array();

        if($adslot){
            /**
             * 清除session 資料
             * */
            Session::forget('tempAdslot');
            $return['message'] = trans('general.create_success');
        }
        else{
            $return['message'] = trans('general.create_fail');
        }

        return json_encode($return);
    }
    
    public function editAdslot(Request $request){

        $adslot = $this->adslotRepository->findAdslotById($request->adslot_id);

        $referrer = $request->header('Referer');
        $url_parts = parse_url($referrer);
        $param_adslot_group_id = explode('=',$url_parts['query']);
        $adslot_group_id = $param_adslot_group_id[1];
        $region_id = $adslot->relatedRegion[0]->id;

        $adslot_group = $this->adslotGroupRepository->findAdslotGroupById($adslot_group_id);

        $related_adslot_groups_raw = $this->adslotGroupRepository->findRelatedAdslotGroups($region_id, $adslot_group_id);

        // echo "<pre>";print_r($related_adslot_groups_raw);echo "</pre>";exit;
        
        $related_adslot_groups = array();

        if($related_adslot_groups_raw->count() > 0){
            // it's not null

            foreach($related_adslot_groups_raw as $key=>$related_adslot_group){
                $temp = array();

                $temp['related_type'] = $related_adslot_group->related_type;
                $temp['related_adslot_groups'] = array();
                $decoded_related_adslot_groups = json_decode($related_adslot_group->related_adslot_groups, true);

                foreach($decoded_related_adslot_groups as $decoded_key => $decoded_related_adslot_group){
                    $adslot_group = $this->adslotGroupRepository->findAdslotGroupById($decoded_related_adslot_group);
                    $temp['related_adslot_groups'][$adslot_group->id] = $adslot_group->name;
                }
                
                $related_adslot_groups[$related_adslot_group->type] = $temp;
            }
        }

        // echo "<pre>";print_r($related_adslot_groups);echo "</pre>";exit;
        

        // $available_regions = $adslot_group->channelGroup->relatedRegion;
        
        $preview_images = $this->previewImageRepository->getAll();

        $return = array();
        $return['modelContent'] = view('partials.modals.ad-management._edit-adslot',['adslot'=>$adslot, 'preview_images'=>$preview_images, 'related_adslot_groups'=>$related_adslot_groups])->render();

        return json_encode($return);
    }

    public function update(Request $request){


        $update_id = $request->update_id;

        $request->validate([
            'spec'          => 'required',
            'list_price'    => 'required',
            'days'          => 'exclude_unless:pricing_method,==,by_days|required',
            'impressions'   => 'exclude_unless:pricing_method,==,by_days|required',
            'start_date'    => 'required|date|before:end_date',
            'end_date'      => 'required|date',
        ]);

        // echo "<pre>";print_r($request->all());echo "</pre>";exit;

        $params = array();
        $params['spec'] = (!is_null($request->spec))?$request->spec:'';
        $params['repetitions'] = $request->repetitions;
        $params['display_repetitions'] = $request->display_repetitions;
        $params['pricing_method'] = $request->pricing_method;
        $params['list_price'] = $request->list_price;
        $params['days'] = (!is_null($request->days))?$request->days:null;
        $params['impressions'] = (!is_null($request->impressions))?$request->impressions:null;
        $params['display_type'] = $request->display_type;
        $params['profit_share_type'] = $request->profit_share_type;
        $params['start_date'] = $request->start_date;
        $params['end_date'] = $request->end_date;
        $params['sale_status'] = $request->sale_status;
        $params['preview_image_id'] = $request->preview_image_id;
        $params['note'] = (!is_null($request->note))?$request->note:'';

        $referrer = $request->header('Referer');
        $url_parts = parse_url($referrer);
        $param_adslot_group_id = explode('=',$url_parts['query']);
        $adslot_group_id = $param_adslot_group_id[1];

        $params['adslot_group_id'] = $adslot_group_id;
        $params['created_by'] = Auth::user()->id;


        $adslot = $this->adslotRepository->updateAdslot($update_id,$params);
        $region_id = $adslot->relatedRegion[0]->id;

        /**
         * 記錄相關聯之adslot groups
         * */
        $related_adslot_group = array();

        if(isset($request['related_package_adslot_group'])){
            $temp_related = array();
            $temp_related['type'] = 'package';
            $temp_related['related_type'] = $request['related_package_type'];
            $temp_related['region_id'] = $region_id;
            $temp_related['adslot_group_id'] = $params['adslot_group_id'];
            $temp_related['related_adslot_groups'] = json_encode($request['related_package_adslot_group']);

            $related_adslot_group[] = $temp_related;
        }

        if(isset($request['related_giveaway_adslot_group'])){
            $temp_related = array();
            $temp_related['type'] = 'giveaway';
            $temp_related['related_type'] = $request['related_giveaway_type'];
            $temp_related['region_id'] = $region_id;
            $temp_related['adslot_group_id'] = $params['adslot_group_id'];
            $temp_related['related_adslot_groups'] = json_encode($request['related_giveaway_adslot_group']);

            $related_adslot_group[] = $temp_related;
        }

        if(!empty($related_adslot_group)){
            $this->adslotGroupRepository->updateRelatedAdslotGroups($region_id, $params['adslot_group_id'], $related_adslot_group);
        }
        
        $return = array();

        if($adslot){
            $return['message'] = trans('general.update_success');
        }
        else{
            $return['message'] = trans('general.update_fail');
        }

        return json_encode($return);
    }

    public function updateAdslotStartDate(Request $request){
        $adslot = $this->adslotRepository->updateStartDate(json_decode($request->checked_adslots), $request->start_date);

        $return = array();

        if($adslot){
            $return['message'] = trans('general.update_success');
        }
        else{
            $return['message'] = trans('general.update_fail');
        }

        return json_encode($return);
    }

    public function updateAdslotEndDate(Request $request){
        $adslot = $this->adslotRepository->updateEndDate(json_decode($request->checked_adslots), $request->end_date);

        $return = array();

        if($adslot){
            $return['message'] = trans('general.update_success');
        }
        else{
            $return['message'] = trans('general.update_fail');
        }

        return json_encode($return);
    }

    public function updateAdslotStatus(Request $request){
        // echo "<pre>";print_r($request->all());echo "</pre>";exit;

        $adslot = $this->adslotRepository->updateAdslot($request->update_id, ['sale_status'=>$request->sale_status]);

        $return = array();

        if($adslot){
            $return['message'] = trans('general.update_success');
        }
        else{
            $return['message'] = trans('general.update_fail');
        }

        return json_encode($return);
    }

}
