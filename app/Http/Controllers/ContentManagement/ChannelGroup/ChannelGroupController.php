<?php

namespace App\Http\Controllers\AdManagement\ChannelGroup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Validation\ValidationException;
use App\Contracts\ChannelContract;
use App\Contracts\ChannelGroupContract;
use App\Contracts\RegionContract;
use Illuminate\Support\Facades\Auth;


class ChannelGroupController extends Controller
{
    protected $channelRepository;
    protected $channelGroupRepository;
    protected $regionRepository;

    public function __construct(ChannelContract $channelRepository, ChannelGroupContract $channelGroupRepository, RegionContract $regionRepository)
    {
        $this->channelRepository = $channelRepository;
        $this->channelGroupRepository = $channelGroupRepository;
        $this->regionRepository = $regionRepository;
    }
    
    public function list()
    {
        $channels = $this->channelRepository->getAll(true);
        return view('pages.ad-management.channel-group.list',['channels'=>$channels]);
    }

    public function regionList()
    {
        return view('pages.ad-management.channel-group.region-list');
    }

    public function channelGroupListTableHeader(){
        $header = config('global.table.headers.channel_group_list');    

        $return = array();
        $return['headers'] = view('partials.tables.ad-management._channel-group-list-table-headers',['header'=>$header])->render();
        $return['columns'] = array();

        // echo "<pre>";print_r($return['headers']);echo "</pre>";exit;

        foreach($header as $key=>$val){
            $return['columns'][] = array('data'=>$val);
        }

        
        return json_encode($return);
    }

    public function channelGroupListTable(Request $request){
        // echo "<pre>";print_r($request->all());echo "</pre>";exit;

        if($request->channel_id == -1){
            $channel_id = null;
        }
        else{
            $channel_id = $request->channel_id;
        }


        $all_list = $this->channelGroupRepository->getAll(null, $channel_id);

        $datatable_head = config('global.table.headers.channel_group_list');    

        $table_name = $this->channelGroupRepository->getTableName();

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

        $filtered_list = $this->channelGroupRepository->getByRequests($order_by, $order_by_dir, $offset, $limit, $search_value, $channel_id);

        // echo count($filtered_list);exit;

        foreach($filtered_list as $key => $item){
            // echo "<pre>";print_r($item);echo "</pre>";
            foreach($datatable_head as $head_key => $head){
                // echo "<pre>";print_r($head);echo "</pre>";exit;
                if (view()->exists('partials/tables/ad-management/_channel-group-list-table-'.$head)) {
                    $return['data'][$key][$head] = view('partials/tables/ad-management/_channel-group-list-table-'.$head,['data'=>$item[$head],'item_id'=>$item->id,'channel_id'=>$item->channel_id])->render();
                }
                else{
                    $return['data'][$key][$head] = view('partials/tables/ad-management/_channel-group-list-table',['data'=>$item[$head], 'key'=>$head])->render();  
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

    public function channelGroupRegionListTableHeader(){
        $header = config('global.table.headers.channel_group_region_list');    

        $return = array();
        $return['headers'] = view('partials.tables.ad-management._channel-group-region-list-table-headers',['header'=>$header])->render();
        $return['columns'] = array();

        // echo "<pre>";print_r($return['headers']);echo "</pre>";exit;

        foreach($header as $key=>$val){
            $return['columns'][] = array('data'=>$val);
        }

        
        return json_encode($return);
    }

    public function channelGroupRegionListTable(Request $request){
        $referrer = $request->header('Referer');
        $url_parts = parse_url($referrer);
        $params = explode('&',$url_parts['query']);

        $params_channel_id = explode('=',$params[0]);
        $params_channel_group_id = explode('=',$params[1]);

        $channel_id = $params_channel_id[1];
        $channel_group_id = $params_channel_group_id[1];

        $channel_group = $this->channelGroupRepository->findChannelGroupById($channel_group_id);

        $all_list = $channel_group->relatedRegion;

        $datatable_head = config('global.table.headers.channel_group_region_list');    

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

        $filtered_list = $this->channelGroupRepository->getChannelGroupRegionsByRequests($order_by, $order_by_dir, $offset, $limit, $search_value, $channel_group_id);


        foreach($filtered_list as $key => $item){
            
            foreach($datatable_head as $head_key => $head){
                if (view()->exists('partials/tables/ad-management/_channel-group-region-list-table-'.$head)) {
                    $return['data'][$key][$head] = view('partials/tables/ad-management/_channel-group-region-list-table-'.$head,['data'=>$item[$head],'item_id'=>$item->id])->render();
                }
                else{
                    $return['data'][$key][$head] = view('partials/tables/ad-management/_channel-group-region-list-table',['data'=>$item[$head], 'key'=>$head])->render();  
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

    public function createChannelGroup(Request $request){

        $channels = $this->channelRepository->getAll(true);
        $designate_channel = $request->designate_channel;
        

        $return = array();
        $return['modelContent'] = view('partials.modals.ad-management._create-channel-group',
            ['channels'=>$channels, 'designate_channel'=>$designate_channel]
        )->render();

        return json_encode($return);
    }

    public function store(Request $request){

        $request->validate([
            'name'  => 'required|string|max:255|unique:channel_groups',
            'channel_id'  => 'required',
            'type'  => 'required|string',
        ]);

        $params = array();

        $params['name'] = $request->name;
        $params['channel_id'] = $request->channel_id;
        $params['type'] = $request->type;
        $params['created_by'] = Auth::user()->id;

        if($request->has('not_display_in_menu')) {
            $params['display_in_menu'] = 0;
        } else {
            $params['display_in_menu'] = 1;
        }

        $channel_group = $this->channelGroupRepository->createChannelGroup($params);
        
        $return = array();

        if($channel_group){
            $return['message'] = trans('general.create_success');
        }
        else{
            $return['message'] = trans('general.create_fail');
        }

        return json_encode($return);
    }

    public function editChannelGroup(Request $request){
        $record = $this->channelGroupRepository->findChannelGroupById($request->channel_group_id);
        $channels = $this->channelRepository->getAll(true);
        $designate_channel = $request->designate_channel;

        $return = array();
        $return['modelContent'] = view('partials.modals.ad-management._edit-channel-group',
            ['update_id'=>$request->channel_group_id, 'record'=>$record, 'channels'=>$channels, 'designate_channel'=>$designate_channel])->render();

        return json_encode($return);
    }

    public function update(Request $request){

        // echo "<pre>";print_r($request->all());echo "</pre>";exit;

        $request->validate([
            'name'  => 'required|string|max:255|unique:channel_groups,name,'.$request->update_id,
            'type'  => 'required|string',
        ]);

        $update_id = $request->update_id;

        $params = array();

        $params['name'] = $request->name;
        $params['type'] = $request->type;

        if($request->has('not_display_in_menu')) {
            $params['display_in_menu'] = 0;
        } else {
            $params['display_in_menu'] = 1;
        }
        
        
        
        $channel_group = $this->channelGroupRepository->updateChannelGroup($update_id, $params);
        
        $return = array();

        if($channel_group){
            $return['message'] = trans('general.update_success');
        }
        else{
            $return['message'] = trans('general.update_fail');
        }

        return json_encode($return);
    }

    public function editRegion(Request $request){

        $referrer = $request->header('Referer');
        $url_parts = parse_url($referrer);
        $params = explode('&',$url_parts['query']);

        $params_channel_id = explode('=',$params[0]);
        $params_channel_group_id = explode('=',$params[1]);

        $channel_id = $params_channel_id[1];
        $channel_group_id = $params_channel_group_id[1];

        $channel_group = $this->channelGroupRepository->findChannelGroupById($channel_group_id);
        $channel = $this->channelRepository->findChannelById($channel_id);

        // echo count($channel->relatedRegion);exit;

        $channel_regions = $channel->relatedRegion;
        $related_regions = array();

        foreach($channel_group->relatedRegion as $key=>$region){
            $related_regions[] = $region->id;
        }
        
        // echo "<pre>";print_r($related_regions);echo "</pre>";exit;
        
        $return = array();
        $return['modelContent'] = view('partials.modals.ad-management._edit-channel-group-region',['channel'=>$channel,'channel_group'=>$channel_group, 'regions'=>$channel_regions, 'related_regions'=>$related_regions])->render();

        return json_encode($return);
    }

    public function updateRegion(Request $request){

        $update_id = $request->update_id;

        $params = array();

        if(!is_null($request->region)){
            foreach($request->region as $key=>$region_id){
                $temp = array();
                $temp['channel_group_id'] = $update_id;
                $temp['region_id'] = $region_id;
                $params[] = $temp;
            }
        }
        
        $channel_group_region = $this->regionRepository->updateChannelGroupRegions($update_id, $params);
        
        $return = array();

        if($channel_group_region){
            $return['message'] = trans('general.update_success');
        }
        else{
            $return['message'] = trans('general.update_fail');
        }

        return json_encode($return);
    }

    public function stopSaleChannelGroup(){
        $return = array();
        $return['modelContent'] = view('partials.modals.ad-management._stop-sale-channel-group')->render();

        return json_encode($return);

    }

    /**
     * ajaxs
     * */

    public function getChannelGroupsByChannel(Request $request){
        $channel_id = $request->channel_id;

        if($channel_id == -1){
            $channel_id=null;
        }

        $channel_groups = $this->channelGroupRepository->getAll(null, $channel_id);

        return view('partials.general._dropdown',['channel_groups'=>$channel_groups])->render();
    }

    public function getChannelGroupsByChannelAndRegion(Request $request){
        $channel_id = $request->channel_id;

        if($channel_id == -1){
            $channel_id=null;
        }

        $region_id = $request->region_id;

        if($region_id == -1){
            $region_id=null;
        }

        // echo "<pre>";print_r($request->all());echo "</pre>";exit;

        $channel_groups = $this->channelGroupRepository->getAllByChannelAndRegion(null, $channel_id, $region_id);
        $selected_region = $this->regionRepository->findRegionById($region_id);

        if(isset($request->display_type) && $request->display_type=='modal'){

            return view('partials.modals.ad-schedule._channel-groups-list-group',['channel_groups'=>$channel_groups, 'selected_region'=>$selected_region, 'selected_channel'=>$channel_id])->render();    
        }
        else{
            return view('partials.general._dropdown',['channel_groups'=>$channel_groups])->render();    
        }
        
    }

}
