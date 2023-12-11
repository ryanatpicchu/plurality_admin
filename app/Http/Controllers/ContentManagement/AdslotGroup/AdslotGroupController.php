<?php

namespace App\Http\Controllers\AdManagement\AdslotGroup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Validation\ValidationException;
use App\Contracts\ChannelContract;
use App\Contracts\ChannelGroupContract;
use App\Contracts\AdslotGroupContract;
use App\Contracts\AdslotContract;
use Illuminate\Support\Facades\Auth;

class AdslotGroupController extends Controller
{
    protected $channelRepository;
    protected $channelGroupRepository;
    protected $adslotGroupRepository;
    protected $adslotRepository;

    public function __construct(ChannelContract $channelRepository, ChannelGroupContract $channelGroupRepository, AdslotGroupContract $adslotGroupRepository, AdslotContract $adslotRepository)
    {
        $this->channelRepository = $channelRepository;
        $this->channelGroupRepository = $channelGroupRepository;
        $this->adslotGroupRepository = $adslotGroupRepository;
        $this->adslotRepository = $adslotRepository;
    }

    public function searchRelatedPackage(Request $request){
        $search_term = $request->term;

        $return = array();
        $return['results'] = array();

        if(!is_null($search_term)){
            $all_terms = $this->adslotGroupRepository->findAdslotGroupByKeyword($search_term);
            foreach($all_terms as $key=>$item){
                $temp = array();
                $temp['id'] = $item->id;
                $temp['text'] = $item->name;
                $return['results'][] = $temp;
            }
        }

        return json_encode($return);
    }

    public function searchRelatedGiveaway(Request $request){
        $search_term = $request->term;

        $return = array();
        $return['results'] = array();

        if(!is_null($search_term)){
            $all_terms = $this->adslotGroupRepository->findAdslotGroupByKeyword($search_term);
            foreach($all_terms as $key=>$item){
                $temp = array();
                $temp['id'] = $item->id;
                $temp['text'] = $item->name;
                $return['results'][] = $temp;
            }
        }

        return json_encode($return);
    }

    public function list()
    {
        $channels = $this->channelRepository->getAll(true);
        return view('pages.ad-management.adslot-group.list',['channels'=>$channels]);
    }

    public function detailList()
    {
        return view('pages.ad-management.adslot-group.detail-list');
    }

    public function adslotGroupListTableHeader(){
        $header = config('global.table.headers.adslot_group_list');    

        $return = array();
        $return['headers'] = view('partials.tables.ad-management._adslot-group-list-table-headers',['header'=>$header])->render();
        $return['columns'] = array();

        // echo "<pre>";print_r($return['headers']);echo "</pre>";exit;

        foreach($header as $key=>$val){
            $return['columns'][] = array('data'=>$val);
        }

        
        return json_encode($return);
    }

    public function adslotGroupListTable(Request $request){
        if($request->channel_id == -1){
            $channel_id = null;
        }
        else{
            $channel_id = $request->channel_id;
        }

        if($request->channel_group_id == -1){
            $channel_group_id = null;
        }
        else{
            $channel_group_id = $request->channel_group_id;
        }


        $all_list = $this->adslotGroupRepository->getAll($channel_group_id);

        $datatable_head = config('global.table.headers.adslot_group_list');    

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

        $filtered_list = $this->adslotGroupRepository->getByRequests($order_by, $order_by_dir, $offset, $limit, $search_value, $channel_id, $channel_group_id);  

        foreach($filtered_list as $key => $item){
            // echo "<pre>";print_r($item);echo "</pre>";exit;
            foreach($datatable_head as $head_key => $head){
                if (view()->exists('partials/tables/ad-management/_adslot-group-list-table-'.$head)) {
                    $return['data'][$key][$head] = view('partials/tables/ad-management/_adslot-group-list-table-'.$head,['data'=>$item[$head],'item_id'=>$item->id,'channel_id'=>$item->channel_id,'channel_group_id'=>$item->channel_group_id])->render();
                }
                else{
                    $return['data'][$key][$head] = view('partials/tables/ad-management/_adslot-group-list-table',['data'=>$item[$head]])->render();  
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

    public function adslotGroupDetailListTableHeader(){
        $header = config('global.table.headers.adslot_group_detail_list');    

        $return = array();
        $return['headers'] = view('partials.tables.ad-management._adslot-group-detail-list-table-headers',['header'=>$header])->render();
        $return['columns'] = array();

        // echo "<pre>";print_r($return['headers']);echo "</pre>";exit;

        foreach($header as $key=>$val){
            $return['columns'][] = array('data'=>$val);
        }

        
        return json_encode($return);
    }

    public function adslotGroupDetailListTable(Request $request){

        $referrer = $request->header('Referer');
        $url_parts = parse_url($referrer);
        $param_adslot_group_id = explode('=',$url_parts['query']);
        $adslot_group_id = $param_adslot_group_id[1];

        $adslot_group = $this->adslotGroupRepository->findAdslotGroupById($adslot_group_id);

        $all_list = $adslot_group->adslots;


        $datatable_head = config('global.table.headers.adslot_group_detail_list');    

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

        if($request->sale_status == 'false'){
            $sale_status = null;
        }
        else $sale_status = 1;

        $filtered_list = $this->adslotRepository->getAdslotGroupsDetailByRequests($order_by, $order_by_dir, $offset, $limit, $search_value,$sale_status ,$adslot_group_id);


        foreach($filtered_list as $key => $item){
            // echo "<pre>";print_r($item);echo "</pre>";exit;            
            foreach($datatable_head as $head_key => $head){
                if (view()->exists('partials/tables/ad-management/_adslot-group-detail-list-table-'.$head)) {
                    $return['data'][$key][$head] = view('partials/tables/ad-management/_adslot-group-detail-list-table-'.$head,['data'=>$item[$head],'item_id'=>$item->id,'item'=>$item])->render();
                }
                else{
                    $return['data'][$key][$head] = view('partials/tables/ad-management/_adslot-group-detail-list-table',['data'=>$item[$head], 'key'=>$head])->render();  
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

    public function createAdslotGroup(Request $request){

        $channels = $this->channelRepository->getAll(true);
        $channel_groups = $this->channelGroupRepository->getAll(true);
        $designate_channel = $request->designate_channel;
        $designate_channel_group = $request->designate_channel_group;

        $return = array();
        $return['modelContent'] = view('partials.modals.ad-management._create-adslot-group',
        ['channels'=>$channels, 
        'channel_groups'=>$channel_groups,
        'designate_channel'=>$designate_channel, 
        'designate_channel_group'=>$designate_channel_group])->render();

        return json_encode($return);
    }

    public function store(Request $request){
        $request->validate([
            'name'  => 'required|string|max:255|unique:channel_groups',
            'channel_id'  => 'required',
            'channel_group_id'  => 'required',
            'code'  => 'nullable|string',
        ]);

        $params = array();

        $params['name'] = $request->name;
        $params['channel_id'] = $request->channel_id;
        $params['channel_group_id'] = $request->channel_group_id;
        $params['code'] = $request->code;
        $params['created_by'] = Auth::user()->id;

        $adslot_group = $this->adslotGroupRepository->createAdslotGroup($params);

        $return = array();

        if($adslot_group){
            $return['message'] = trans('general.create_success');
        }
        else{
            $return['message'] = trans('general.create_fail');
        }

        return json_encode($return);
    }

    public function editAdslotGroup(Request $request){
        $record = $this->adslotGroupRepository->findAdslotGroupById($request->adslot_group_id);
        $channels = $this->channelRepository->getAll(true);

        $channel_groups = $this->channelGroupRepository->getAll(true, $request->designate_channel);

        $designate_channel = $request->designate_channel;
        $designate_channel_group = $request->designate_channel_group;

        $return = array();
        $return['modelContent'] = view('partials.modals.ad-management._edit-adslot-group',
            ['update_id'=>$request->adslot_group_id, 'record'=>$record, 'channels'=>$channels, 'channel_groups'=>$channel_groups, 'designate_channel'=>$designate_channel, 'designate_channel_group'=>$designate_channel_group])->render();

        return json_encode($return);
    }

    public function update(Request $request){

        $request->validate([
            'name'  => 'required|string|max:255|unique:adslot_groups,name,'.$request->update_id,
            'code'  => 'nullable|string',
        ]);

        $update_id = $request->update_id;

        $params = array();

        $params['name'] = $request->name;
        $params['code'] = $request->code;

       
        
        $adslot_group = $this->adslotGroupRepository->updateAdslotGroup($update_id, $params);
        
        $return = array();

        if($adslot_group){
            $return['message'] = trans('general.update_success');
        }
        else{
            $return['message'] = trans('general.update_fail');
        }

        return json_encode($return);
    }

    public function modifyAdslotStartDate(Request $request){

        $return = array();
        $return['modelContent'] = view('partials.modals.ad-management._modify-adslot-start-date',['checked_adslots'=>$request->checked_adslots])->render();

        return json_encode($return);
    }

    public function modifyAdslotEndDate(Request $request){
        $return = array();
        $return['modelContent'] = view('partials.modals.ad-management._modify-adslot-end-date',['checked_adslots'=>$request->checked_adslots])->render();

        return json_encode($return);
    }

    public function stopSaleAdslot(Request $request){
        $adslot = $this->adslotRepository->findAdslotById($request->adslot_id);

        $return = array();
        $return['modelContent'] = view('partials.modals.ad-management._stop-sale-adslot',['adslot'=>$adslot])->render();

        return json_encode($return);

    }

    public function resumeSaleAdslot(Request $request){
        $adslot = $this->adslotRepository->findAdslotById($request->adslot_id);

        $return = array();
        $return['modelContent'] = view('partials.modals.ad-management._resume-sale-adslot',['adslot'=>$adslot])->render();

        return json_encode($return);

    }

}
