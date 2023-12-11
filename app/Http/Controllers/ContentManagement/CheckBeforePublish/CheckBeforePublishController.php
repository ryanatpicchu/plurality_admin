<?php

namespace App\Http\Controllers\AdManagement\CheckBeforePublish;

use App\Http\Controllers\Controller;

class CheckBeforePublishController extends Controller
{
    
    public function setting()
    {
        return view('pages.ad-management.check-before-publish.setting');
    }

    public function checkBeforePublishWaitingListTableHeader()
    {
        $header = config('global.table.headers.check_before_publish_waiting_list');    

        $return = array();
        $return['headers'] = view('partials.tables.ad-management._check-before-publish-waiting-list-table-headers',['header'=>$header])->render();
        $return['columns'] = array();

        // echo "<pre>";print_r($return['headers']);echo "</pre>";exit;

        foreach($header as $key=>$val){
            $return['columns'][] = array('data'=>$val);
        }

        
        return json_encode($return);
    }

    public function checkBeforePublishWaitingListTable()
    {
        $all_check_before_publish_waiting_list = array(
            array(
                'checkbox'=>'',
                'ad_type'=>'站內廣告',
                'customer_name'=>'名緯',
                'product_name'=>'泓瑞恆昕',
                'adslot' => '100_不分區_特開_★社群推廣',
                'material_spec' => '100*250',
                'start_date'=>'2023-02-06',
                'end_date'=>'2023-02-12',
                'numbers_of_insertions'=>'D-591-20230602-001',
                'sales'=>'曾家羚',
                'confirm_status'=>''
            ),
            array(
                'checkbox'=>'',
                'ad_type'=>'站內廣告',
                'customer_name'=>'名緯',
                'product_name'=>'泓瑞恆昕',
                'adslot' => '100_不分區_特開_★社群推廣',
                'material_spec' => '100*250',
                'start_date'=>'2023-02-06',
                'end_date'=>'2023-02-12',
                'numbers_of_insertions'=>'D-591-20230602-001',
                'sales'=>'曾家羚',
                'confirm_status'=>''
            ),
            array(
                'checkbox'=>'',
                'ad_type'=>'站內廣告',
                'customer_name'=>'名緯',
                'product_name'=>'泓瑞恆昕',
                'adslot' => '100_不分區_特開_★社群推廣',
                'material_spec' => '100*250',
                'start_date'=>'2023-02-06',
                'end_date'=>'2023-02-12',
                'numbers_of_insertions'=>'D-591-20230602-001',
                'sales'=>'曾家羚',
                'confirm_status'=>''
            ),
            array(
                'checkbox'=>'',
                'ad_type'=>'站內廣告',
                'customer_name'=>'名緯',
                'product_name'=>'泓瑞恆昕',
                'adslot' => '100_不分區_特開_★社群推廣',
                'material_spec' => '100*250',
                'start_date'=>'2023-02-06',
                'end_date'=>'2023-02-12',
                'numbers_of_insertions'=>'D-591-20230602-001',
                'sales'=>'曾家羚',
                'confirm_status'=>''
            ),
            array(
                'checkbox'=>'',
                'ad_type'=>'站內廣告',
                'customer_name'=>'名緯',
                'product_name'=>'泓瑞恆昕',
                'adslot' => '100_不分區_特開_★社群推廣',
                'material_spec' => '100*250',
                'start_date'=>'2023-02-06',
                'end_date'=>'2023-02-12',
                'numbers_of_insertions'=>'D-591-20230602-001',
                'sales'=>'曾家羚',
                'confirm_status'=>''
            ),
            array(
                'checkbox'=>'',
                'ad_type'=>'站內廣告',
                'customer_name'=>'名緯',
                'product_name'=>'泓瑞恆昕',
                'adslot' => '100_不分區_特開_★社群推廣',
                'material_spec' => '100*250',
                'start_date'=>'2023-02-06',
                'end_date'=>'2023-02-12',
                'numbers_of_insertions'=>'D-591-20230602-001',
                'sales'=>'曾家羚',
                'confirm_status'=>''
            ),

            
            
        );

        $datatable_head = config('global.table.headers.check_before_publish_waiting_list');    

        foreach($all_check_before_publish_waiting_list as $key => $list_item){
            // echo "<pre>";print_r($datatable_head);echo "</pre>";exit;
            // echo "<pre>";print_r($insertion_list);echo "</pre>";exit;
            foreach($datatable_head as $head_key => $head){

                if (view()->exists('partials/tables/ad-management/_check-before-publish-waiting-list-table-'.$head)) {
                    $return['data'][$key][$head] = view('partials/tables/ad-management/_check-before-publish-waiting-list-table-'.$head,['data'=>$list_item[$head]])->render();
                }
                else{
                    $return['data'][$key][$head] = view('partials/tables/ad-management/_check-before-publish-waiting-list-table',['data'=>$list_item[$head]])->render();
                }
            }

        }

        if(isset($request->draw)){
            $return['draw'] = $request->draw;
        }
        else $return['draw'] = 1;

        $return['recordsTotal'] = count($all_check_before_publish_waiting_list);
        $return['recordsFiltered'] = count($all_check_before_publish_waiting_list);

        return json_encode($return);

    }

    public function materialSettingNote(){
        $return = array();
        $return['modelContent'] = view('partials.modals.ad-management._material-setting-note')->render();

        return json_encode($return);
    }

}
