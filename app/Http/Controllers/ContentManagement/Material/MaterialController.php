<?php

namespace App\Http\Controllers\AdManagement\Material;

use App\Http\Controllers\Controller;

class MaterialController extends Controller
{
    
    public function setting()
    {
        return view('pages.ad-management.material.setting');
    }

    public function materialSettingUnfinishedListTableHeader()
    {
        $header = config('global.table.headers.material_setting_unfinished_list');    

        $return = array();
        $return['headers'] = view('partials.tables.ad-management._material-setting-unfinished-list-table-headers',['header'=>$header])->render();
        $return['columns'] = array();

        // echo "<pre>";print_r($return['headers']);echo "</pre>";exit;

        foreach($header as $key=>$val){
            $return['columns'][] = array('data'=>$val);
        }

        
        return json_encode($return);
    }

    public function materialSettingUnfinishedListTable()
    {
        $all_material_setting_unfinished_list = array(
            array(
                'count_down_days'=>'1天',
                'ad_type'=>'站內廣告',
                'customer_name'=>'名緯',
                'product_name'=>'泓瑞恆昕',
                'adslot' => '100_不分區_特開_★社群推廣',
                'material_spec' => '100*250',
                'start_date'=>'2023-02-06',
                'end_date'=>'2023-02-12',
                'numbers_of_insertions'=>'D-591-20230602-001',
                'sales'=>'曾家羚',
                'submit_status'=>'',
                'setting_status'=>''
            ),
            array(
                'count_down_days'=>'1天',
                'ad_type'=>'站內廣告',
                'customer_name'=>'名緯',
                'product_name'=>'泓瑞恆昕',
                'adslot' => '100_不分區_特開_★社群推廣',
                'material_spec' => '100*250',
                'start_date'=>'2023-02-06',
                'end_date'=>'2023-02-12',
                'numbers_of_insertions'=>'D-591-20230602-001',
                'sales'=>'曾家羚',
                'submit_status'=>'',
                'setting_status'=>''
            ),
            array(
                'count_down_days'=>'1天',
                'ad_type'=>'站內廣告',
                'customer_name'=>'名緯',
                'product_name'=>'泓瑞恆昕',
                'adslot' => '100_不分區_特開_★社群推廣',
                'material_spec' => '100*250',
                'start_date'=>'2023-02-06',
                'end_date'=>'2023-02-12',
                'numbers_of_insertions'=>'D-591-20230602-001',
                'sales'=>'曾家羚',
                'submit_status'=>'',
                'setting_status'=>''
            ),
            array(
                'count_down_days'=>'1天',
                'ad_type'=>'站內廣告',
                'customer_name'=>'名緯',
                'product_name'=>'泓瑞恆昕',
                'adslot' => '100_不分區_特開_★社群推廣',
                'material_spec' => '100*250',
                'start_date'=>'2023-02-06',
                'end_date'=>'2023-02-12',
                'numbers_of_insertions'=>'D-591-20230602-001',
                'sales'=>'曾家羚',
                'submit_status'=>'',
                'setting_status'=>''
            ),
            array(
                'count_down_days'=>'1天',
                'ad_type'=>'站內廣告',
                'customer_name'=>'名緯',
                'product_name'=>'泓瑞恆昕',
                'adslot' => '100_不分區_特開_★社群推廣',
                'material_spec' => '100*250',
                'start_date'=>'2023-02-06',
                'end_date'=>'2023-02-12',
                'numbers_of_insertions'=>'D-591-20230602-001',
                'sales'=>'曾家羚',
                'submit_status'=>'',
                'setting_status'=>''
            ),
            array(
                'count_down_days'=>'1天',
                'ad_type'=>'站內廣告',
                'customer_name'=>'名緯',
                'product_name'=>'泓瑞恆昕',
                'adslot' => '100_不分區_特開_★社群推廣',
                'material_spec' => '100*250',
                'start_date'=>'2023-02-06',
                'end_date'=>'2023-02-12',
                'numbers_of_insertions'=>'D-591-20230602-001',
                'sales'=>'曾家羚',
                'submit_status'=>'',
                'setting_status'=>''
            ),
            
        );

        $datatable_head = config('global.table.headers.material_setting_unfinished_list');    

        foreach($all_material_setting_unfinished_list as $key => $insertion_list){
            // echo "<pre>";print_r($datatable_head);echo "</pre>";exit;
            // echo "<pre>";print_r($insertion_list);echo "</pre>";exit;
            foreach($datatable_head as $head_key => $head){

                if($head == 'actions'){
                    $return['data'][$key][$head] = view('partials/tables/ad-management/_material-setting-unfinished-list-table-status'.$head,['insertion_list'=>$insertion_list[$head],'row_id'=>$key])->render();
                }
                else{

                    if (view()->exists('partials/tables/ad-management/_material-setting-unfinished-list-table-'.$head)) {
                        $return['data'][$key][$head] = view('partials/tables/ad-management/_material-setting-unfinished-list-table-'.$head,['data'=>$insertion_list[$head]])->render();
                    }
                    else{
                        $return['data'][$key][$head] = view('partials/tables/ad-management/_material-setting-unfinished-list-table',['data'=>$insertion_list[$head]])->render();
                    }
                    
                }
            }

        }

        if(isset($request->draw)){
            $return['draw'] = $request->draw;
        }
        else $return['draw'] = 1;

        $return['recordsTotal'] = count($all_material_setting_unfinished_list);
        $return['recordsFiltered'] = count($all_material_setting_unfinished_list);

        return json_encode($return);

    }

    public function materialSettingNote(){
        $return = array();
        $return['modelContent'] = view('partials.modals.ad-management._material-setting-note')->render();

        return json_encode($return);
    }

}
