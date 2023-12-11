<?php

namespace App\Http\Controllers\AdSchedule\List;

use App\Http\Controllers\Controller;
use Session;
use App\Models\Insertion;
use Illuminate\Http\Request;
use App\Contracts\InsertionContract;

class ListController extends Controller
{
    protected $insertionRepository;
    
    public function __construct(InsertionContract $insertionRepository)
    {
        $this->insertionRepository = $insertionRepository;
    }
    
    public function index()
    {
        return view('pages.ad-schedule.list.index');
    }


    public function adListTableHeader()
    {
        $header = config('global.table.headers.ad_list');    

        $return = array();
        $return['headers'] = view('partials.tables.ad-schedule._ad-list-table-headers',['header'=>$header])->render();
        $return['columns'] = array();

        // echo "<pre>";print_r($return['headers']);echo "</pre>";exit;

        foreach($header as $key=>$val){
            $return['columns'][] = array('data'=>$val);
        }

        
        return json_encode($return);
    }

    public function adListTable(Request $request)
    {

        $all_ad_list = $this->insertionRepository->getAll();

        $datatable_head = config('global.table.headers.ad_list');    

        $order_by = $datatable_head[$request->order[0]['column']];

        if($order_by == 'region'){
            $order_by = 'city';
        }

        $order_by_dir = $request->order[0]['dir'];
        $offset = $request->start;

        if($request->length == '-1'){// table length : show all
            $limit = count($all_ad_list);
        }
        else{
            $limit = $request->length;
        }

        $search_value = $request->search['value'];

        $filtered_list = $this->insertionRepository->getByRequests($order_by, $order_by_dir, $offset, $limit, $search_value);  

        foreach($filtered_list as $key => $ad_list){
            // echo "<pre>";print_r($item);echo "</pre>";exit;
            foreach($datatable_head as $head_key => $head){
                if (view()->exists('partials/tables/ad-schedule/_ad-list-table-'.$head)) {
                    $return['data'][$key][$head] = view('partials/tables/ad-schedule/_ad-list-table-'.$head,['data'=>$ad_list[$head],'ad'=>$ad_list])->render();
                }
                else{
                    $return['data'][$key][$head] = view('partials/tables/ad-schedule/_ad-list-table',['data'=>$ad_list[$head]])->render();
                }
                
            }

        }

        if(isset($request->draw)){
            $return['draw'] = $request->draw;
        }
        else $return['draw'] = 1;

        $return['recordsTotal'] = count($filtered_list);

        if(is_null($search_value)){
            $return['recordsFiltered'] = count($all_ad_list);
        }
        else{
            $return['recordsFiltered'] = count($filtered_list);
        }
        

        return json_encode($return);

    }


}
