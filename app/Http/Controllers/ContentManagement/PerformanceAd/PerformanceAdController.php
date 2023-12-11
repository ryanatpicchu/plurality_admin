<?php

namespace App\Http\Controllers\AdManagement\PerformanceAd;

use App\Http\Controllers\Controller;
use App\Contracts\ChannelContract;
use App\Contracts\PerformanceAdContract;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;


class PerformanceAdController extends Controller
{

    protected $channelRepository;
    protected $performanceAdRepository;

    public function __construct(ChannelContract $channelRepository, PerformanceAdContract $performanceAdRepository)
    {
        $this->channelRepository = $channelRepository;
        $this->performanceAdRepository = $performanceAdRepository;
    }

    public function createPerformanceAd(Request $request){
        $channels = $this->channelRepository->getAll(true);
        $designate_channel = $request->designate_channel;
        $return = array();
        $return['modelContent'] = view('partials.modals.ad-management._create-performance-ad',
            [
                'channels'=>$channels,
                'designate_channel'=>$designate_channel, 
            ]
        )->render();

        return json_encode($return);
    }

    public function storePerformanceAd(Request $request){
        $channel_id = $request->channel_id;
        $name = $request->name;

        $request->validate([
            'channel_id'  => 'required',
            'start_date'    => 'required|date',
            'end_date'      => 'nullable|date',
            'name'  => ['required',
                'string',
                'max:255',
                Rule::unique('performance_ads')->where(function ($query) use($channel_id,$name) {
                    return $query->where('channel_id', $channel_id)->where('name', $name);
                })
            ],
            'list_price'    => 'required',
        ]);

        $params = array();
        $params['channel_id'] = $request->channel_id;
        $params['name'] = $request->name;
        $params['start_date'] = $request->start_date;
        $params['end_date'] = $request->end_date;
        $params['sales_unit'] = $request->sales_unit;
        $params['list_price'] = $request->list_price;
        $params['note'] = $request->note;

        if($request->has('display_list_price')) {
            $params['display_list_price'] = 1;
        } else {
            $params['display_list_price'] = 0;
        }

        if($request->has('list_price_not_be_confirmed')) {
            $params['list_price_not_be_confirmed'] = 1;
        } else {
            $params['list_price_not_be_confirmed'] = 0;
        }

        $performance_ad = $this->performanceAdRepository->createPerformanceAd($params);

        $return = array();

        if($performance_ad){
            $return['message'] = trans('general.create_success');
        }
        else{
            $return['message'] = trans('general.create_fail');
        }

        return json_encode($return);
    }

    public function editPerformanceAd(Request $request){
        $channels = $this->channelRepository->getAll(true);
        $performance_ad = $this->performanceAdRepository->findPerformanceAdById($request->performance_ad_id);
        $return = array();
        $return['modelContent'] = view('partials.modals.ad-management._edit-performance-ad',['channels'=>$channels, 'performance_ad'=>$performance_ad])->render();

        return json_encode($return);
    }

    public function updatePerformanceAd(Request $request){
        $update_id = $request->update_id;
        $channel_id = $request->channel_id;
        $name = $request->name;
        
        $request->validate([
            'channel_id'  => 'required',
            'start_date'    => 'required|date',
            'end_date'      => 'nullable|date',
            'name'  => ['required',
                'string',
                'max:255',
                Rule::unique('performance_ads')->where(function ($query) use($channel_id,$name) {
                   return $query->where('channel_id', $channel_id)->where('name', $name);
                 })->ignore($update_id)
            ],
            'list_price'    => 'required',
        ]);


        $params = array();
        $params['channel_id'] = $request->channel_id;
        $params['name'] = $request->name;
        $params['start_date'] = $request->start_date;
        $params['end_date'] = $request->end_date;
        $params['sales_unit'] = $request->sales_unit;
        $params['list_price'] = $request->list_price;
        $params['note'] = $request->note;

        if($request->has('display_list_price')) {
            $params['display_list_price'] = 1;
        } else {
            $params['display_list_price'] = 0;
        }

        if($request->has('list_price_not_be_confirmed')) {
            $params['list_price_not_be_confirmed'] = 1;
        } else {
            $params['list_price_not_be_confirmed'] = 0;
        }


        $performance_ad = $this->performanceAdRepository->updatePerformanceAd($update_id, $params);

        $return = array();

        if($performance_ad){
            $return['message'] = trans('general.update_success');
        }
        else{
            $return['message'] = trans('general.update_fail');
        }

        return json_encode($return);
    }


    public function performanceAdListTableHeader(){
        $header = config('global.table.headers.performance_ad_list');    

        $return = array();
        $return['headers'] = view('partials.tables.ad-management._performance-ad-list-table-headers',['header'=>$header])->render();
        $return['columns'] = array();

        // echo "<pre>";print_r($return['headers']);echo "</pre>";exit;

        foreach($header as $key=>$val){
            $return['columns'][] = array('data'=>$val);
        }

        
        return json_encode($return);
    }

    public function performanceAdListTable(Request $request){
        if(!isset($request->sale_status) || $request->sale_status == 'false'){
            $sale_status = null;
        }
        else $sale_status = 1;

        // var_dump($request->channel);

        if(!isset($request->channel) || $request->channel == -1){
            $channel = null;
        }
        else $channel = $request->channel;

        $all_list = $this->performanceAdRepository->getAllPerfomanceAdsByRequests($channel, $sale_status);

        $datatable_head = config('global.table.headers.performance_ad_list');    

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

        $filtered_list = $this->performanceAdRepository->getPerfomanceAdsByRequests($order_by, $order_by_dir, $offset, $limit, $search_value,$channel, $sale_status);


        foreach($filtered_list as $key => $item){
            // echo "<pre>";print_r($datatable_head);echo "</pre>";exit;            
            foreach($datatable_head as $head_key => $head){
                if (view()->exists('partials/tables/ad-management/_performance-ad-list-table-'.$head)) {
                    $return['data'][$key][$head] = view('partials/tables/ad-management/_performance-ad-list-table-'.$head,['data'=>$item[$head],'item_id'=>$item->id,'item'=>$item])->render();
                }
                else{
                    $return['data'][$key][$head] = view('partials/tables/ad-management/_performance-ad-list-table',['data'=>$item[$head], 'key'=>$head])->render();  
                }
                
            }

        }

        // echo "<pre>";print_r($return['data']);echo "</pre>";exit;  

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

}
