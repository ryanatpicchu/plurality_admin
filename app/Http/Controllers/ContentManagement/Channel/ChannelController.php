<?php

namespace App\Http\Controllers\AdManagement\Channel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Validation\ValidationException;
use App\Contracts\ChannelContract;
use App\Contracts\RegionContract;
use App\Contracts\PerformanceAdContract;

class ChannelController extends Controller
{
    protected $channelRepository;
    protected $regionRepository;
    protected $performanceAdRepository;

    public function __construct(ChannelContract $channelRepository, RegionContract $regionRepository, PerformanceAdContract $performanceAdRepository)
    {
        $this->channelRepository = $channelRepository;
        $this->regionRepository = $regionRepository;
        $this->performanceAdRepository = $performanceAdRepository;
    }

    public function list()
    {
        return view('pages.ad-management.channel.list');
    }

    public function regionList(Request $request)
    {
        return view('pages.ad-management.channel.region-list');
    }

    public function channelListTableHeader(){
        $header = config('global.table.headers.channel_list');    

        $return = array();
        $return['headers'] = view('partials.tables.ad-management._channel-list-table-headers',['header'=>$header])->render();
        $return['columns'] = array();

        // echo "<pre>";print_r($return['headers']);echo "</pre>";exit;

        foreach($header as $key=>$val){
            $return['columns'][] = array('data'=>$val);
        }

        
        return json_encode($return);
    }

    public function channelListTable(Request $request){

        $all_list = $this->channelRepository->getAll();

        $datatable_head = config('global.table.headers.channel_list');    

        $table_name = $this->channelRepository->getTableName();

        $order_by = $table_name.'.'.$datatable_head[$request->order[0]['column']];
        $order_by_dir = $request->order[0]['dir'];
        $offset = $request->start;

        if($request->length == '-1'){// table length : show all
            $limit = count($all_list);
        }
        else{
            $limit = $request->length;
        }

        $search_value = $request->search['value'];

        $filtered_list = $this->channelRepository->getByRequests($order_by, $order_by_dir, $offset, $limit, $search_value);

        foreach($filtered_list as $key => $item){
            // echo "<pre>";print_r($user);echo "</pre>";exit;
            foreach($datatable_head as $head_key => $head){
                if (view()->exists('partials/tables/ad-management/_channel-list-table-'.$head)) {
                    $return['data'][$key][$head] = view('partials/tables/ad-management/_channel-list-table-'.$head,['data'=>$item[$head],'item_id'=>$item->id])->render();
                }
                else{
                    $return['data'][$key][$head] = view('partials/tables/ad-management/_channel-list-table',['data'=>$item[$head], 'key'=>$head])->render();  
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

    public function channelRegionListTableHeader(){
        $header = config('global.table.headers.channel_region_list');    

        $return = array();
        $return['headers'] = view('partials.tables.ad-management._channel-region-list-table-headers',['header'=>$header])->render();
        $return['columns'] = array();

        // echo "<pre>";print_r($return['headers']);echo "</pre>";exit;

        foreach($header as $key=>$val){
            $return['columns'][] = array('data'=>$val);
        }

        
        return json_encode($return);
    }

    public function channelRegionListTable(Request $request){
        $referrer = $request->header('Referer');
        $url_parts = parse_url($referrer);
        $param_channel_id = explode('=',$url_parts['query']);
        $channel_id = $param_channel_id[1];

        $channel = $this->channelRepository->findChannelById($channel_id);

        $all_list = $channel->relatedRegion;

        $datatable_head = config('global.table.headers.channel_region_list');    

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

        $filtered_list = $this->channelRepository->getChannelRegionsByRequests($order_by, $order_by_dir, $offset, $limit, $search_value, $channel_id);

        foreach($filtered_list as $key => $item){
            // echo "<pre>";print_r($user);echo "</pre>";exit;
            foreach($datatable_head as $head_key => $head){
                if (view()->exists('partials/tables/ad-management/_channel-region-list-table-'.$head)) {
                    $return['data'][$key][$head] = view('partials/tables/ad-management/_channel-region-list-table-'.$head,['data'=>$item[$head],'item_id'=>$item->id])->render();
                }
                else{
                    $return['data'][$key][$head] = view('partials/tables/ad-management/_channel-region-list-table',['data'=>$item[$head], 'key'=>$head])->render();  
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

    public function createChannel(){
        $return = array();
        $return['modelContent'] = view('partials.modals.ad-management._create-channel')->render();

        return json_encode($return);
    }

    public function store(Request $request){

        $request->validate([
            'name'  => 'required|string|max:255|unique:channels',
        ]);

        $params = array();

        $params['name'] = $request->name;

        if($request->has('not_display_in_menu')) {
            $params['display_in_menu'] = 0;
        } else {
            $params['display_in_menu'] = 1;
        }
        
        $channel = $this->channelRepository->createChannel($params);
        
        $return = array();

        if($channel){
            $return['message'] = trans('general.create_success');
        }
        else{
            $return['message'] = trans('general.create_fail');
        }

        return json_encode($return);
    }

    public function editChannel(Request $request){
        $record = $this->channelRepository->findChannelById($request->channel_id);
        $return = array();
        $return['modelContent'] = view('partials.modals.ad-management._edit-channel',
            ['update_id'=>$request->channel_id, 'record'=>$record])->render();

        return json_encode($return);
    }

    public function update(Request $request){

        $request->validate([
            'name'  => 'required|string|max:255|unique:channels,name,'.$request->update_id,
        ]);

        $update_id = $request->update_id;

        $params = array();

        $params['name'] = $request->name;

        if($request->has('not_display_in_menu')) {
            $params['display_in_menu'] = 0;
        } else {
            $params['display_in_menu'] = 1;
        }
        
        // echo "<pre>";print_r($params);echo "</pre>";exit;
        
        $channel = $this->channelRepository->updateChannel($update_id, $params);
        
        $return = array();

        if($channel){
            $return['message'] = trans('general.update_success');
        }
        else{
            $return['message'] = trans('general.update_fail');
        }

        return json_encode($return);
    }

    public function createRegion(){
        $return = array();
        $return['modelContent'] = view('partials.modals.ad-management._create-region')->render();

        return json_encode($return);
    }

    public function storeRegion(Request $request){

        $referrer = $request->header('Referer');
        $url_parts = parse_url($referrer);
        
        $param_channel_id = explode('=',$url_parts['query']);
        $channel_id = $param_channel_id[1];


        $request->validate([
            'name'  => 'required|string|max:255|unique:regions',
        ]);

        $params = array();

        $params['name'] = $request->name;

        
        $region = $this->regionRepository->createRegion($params);

        $relate_new_region = $this->regionRepository->relateNewRegion($channel_id, $region->id);
        
        $return = array();

        if($relate_new_region){
            $return['message'] = trans('general.create_success');
        }
        else{
            $return['message'] = trans('general.create_fail');
        }

        return json_encode($return);
    }

    public function editRegion(Request $request){

        $referrer = $request->header('Referer');
        $url_parts = parse_url($referrer);
        
        $param_channel_id = explode('=',$url_parts['query']);

        $channel_id = $param_channel_id[1];

        $channel = $this->channelRepository->findChannelById($channel_id);
        // echo count($channel->relatedRegion);exit;

        $regions = $this->regionRepository->getAll();
        $related_regions = array();

        foreach($channel->relatedRegion as $key=>$region){
            $related_regions[] = $region->id;
        }
        
        // echo "<pre>";print_r($related_regions);echo "</pre>";exit;
        
        $return = array();
        $return['modelContent'] = view('partials.modals.ad-management._edit-region',['channel'=>$channel, 'regions'=>$regions, 'related_regions'=>$related_regions])->render();

        return json_encode($return);
    }

    public function updateRegion(Request $request){

        $update_id = $request->update_id;

        $params = array();

        if(!is_null($request->region)){
            foreach($request->region as $key=>$region_id){
                $temp = array();
                $temp['channel_id'] = $update_id;
                $temp['region_id'] = $region_id;
                $params[] = $temp;
            }
        }
        
        $channel_region = $this->regionRepository->updateRegions($update_id, $params);
        
        $return = array();

        if($channel_region){
            $return['message'] = trans('general.update_success');
        }
        else{
            $channel_region['message'] = trans('general.update_fail');
        }

        return json_encode($return);
    }

    /**
     * ajaxs
     * */

    public function getRegionsByChannel(Request $request){
        $channel_id = $request->channel_id;

        if($channel_id == -1){
            $channel_id=null;
        }
        if(!is_null($channel_id)){
            $channel = $this->channelRepository->findChannelById($channel_id);
            $regions = $channel->relatedRegion;
        }
        else{
            $regions = $this->regionRepository->getAll();
        }
        

        return view('partials.general._dropdown-regions',['regions'=>$regions])->render();
    }

    public function getPerformanceAdsByChannel(Request $request){
        $channel_id = $request->channel_id;

        if($channel_id == -1){
            $channel_id=null;
        }
        if(!is_null($channel_id)){
            $channel = $this->channelRepository->findChannelById($channel_id);
            $performance_ads = $channel->relatedPerformanceAd;
        }
        else{
            $performance_ads = $this->performanceAdRepository->getAll();
        }
        

        return view('partials.general._dropdown-performance-ads',['performance_ads'=>$performance_ads])->render();
    }

}
