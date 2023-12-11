@if(isset($insertions['A']) && !is_null($insertions['A']))
    @foreach($insertions['A'] as $agent_combination_key=>$agent_ad_info)
        @foreach($agent_ad_info['info'] as $agent_ads_key=>$agent_ad)
        <div 
        class="card adslot-groups-table"
        combination_key="{{$agent_combination_key}}"
        row="{{$agent_ads_key}}"
        >
        <!--begin::Header-->
        <div class="card-header pt-5 pe-0 ps-0">
            <h3 class="card-title align-items-start flex-column"></h3>
                <div class="card-toolbar">
                    <a 
                    insertion_type="A"
                    combination_key="{{$agent_combination_key}}"
                    row="{{$agent_ads_key}}"
                    href="javascript:;" 
                    id="" class="agent_sales_unit_sale_price_button btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#modal_agent_sales_unit_sale_price" ingroup-key="">
                        {{__('ad-schedule.set-sales-unit-sale-price')}}</a>
                </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body py-3 pe-0 ps-0">
                <!--begin::Table container-->
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                        <!--begin::Table head-->
                        <thead>
                            <tr class="fw-bold text-muted">
                                <th class="min-w-400px">{{__('ad-schedule.adslot')}}</th>
                                <th class="min-w-150px">{{__('ad-schedule.adslot-start-date')}}</th>
                                <th class="min-w-150px">{{__('ad-schedule.adslot-end-date')}}</th>
                                <th class="min-w-50px">{{__('ad-schedule.days')}}</th>
                                <th class="min-w-50px">{{__('ad-schedule.quantity')}}</th>
                                <th class="min-w-75px">{{__('ad-schedule.expect-sale-price')}}</th>
                                <th class="min-w-75px">{{__('ad-schedule.sales-unit-list-price')}}</th>
                                <th class="min-w-150px text-end">{{__('ad-schedule.actions')}}</th>
                            </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                            <tr>
                                <td>
                                    <div class="row">
                                        <div class="col-3">
                                            <select 
                                            id="{{$agent_combination_key}}_{{$agent_ads_key}}_agent_channel"
                                            class="form-select form-select-sm agent-channels" data-control="select2" data-hide-search="true">
                                                @foreach($all_agent_channels as $key=>$channel)
                                                    <option value="{{$channel->id}}" @if($channel->id == $agent_ad['channelId']) selected @endif>{{$channel->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @php
                                        $selected_channel = '';

                                        foreach($all_agent_channels as $key=>$channel){
                                            if($channel->id == $agent_ad['channelId']){
                                                $selected_channel = $channel;
                                            }
                                        }

                                        @endphp
                                        <div class="col-4">
                                            <select 
                                            id="{{$agent_combination_key}}_{{$agent_ads_key}}_agent_region"
                                            class="form-select form-select-sm agent-regions" data-control="select2" data-hide-search="true">
                                                @foreach($selected_channel->relatedRegion as $key=>$region)
                                                    <option value="{{$region->id}}" @if($region->id == $agent_ad['regionId']) selected @endif>{{$region->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col">
                                            <select 
                                            id="{{$agent_combination_key}}_{{$agent_ads_key}}_agent_ad"
                                            class="form-select form-select-sm agent-ads"data-control="select2"  data-hide-search="true">
                                                @foreach($selected_channel->relatedPerformanceAd as $key=>$ad)
                                                    <option value="{{$ad->id}}" @if($ad->id == $agent_ad['adId']) selected @endif>{{$ad->name}}({{$ad->sales_unit}})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <input 
                                    id="{{$agent_combination_key}}_{{$agent_ads_key}}_agent_start_date"
                                    type="text" class="adslot-date form-control form-control-sm agent-start-date" name="agent_start_date" value="{{$agent_ad['dateRanges'][0][array_key_first($agent_ad['dateRanges'][0])]}}">
                                </td>
                                <td>
                                    <input 
                                    id="{{$agent_combination_key}}_{{$agent_ads_key}}_agent_end_date"
                                    type="text" class="adslot-date form-control form-control-sm agent-end-date" name="agent_end_date" value="{{$agent_ad['dateRanges'][0][array_key_last($agent_ad['dateRanges'][0])]}}">
                                </td>
                                <td>
                                    <span 
                                    id="{{$agent_combination_key}}_{{$agent_ads_key}}_agent_days"
                                    class="text-dark fw-bold fs-6">
                                        @if(isset($agent_ad['days']))
                                        {{$agent_ad['days']}}
                                        
                                        @endif
                                    </span>
                                </td>
                                <td>
                                    <span class="text-dark fw-bold fs-6">0</span>
                                </td>
                                <td>
                                    <span 
                                    id="{{$agent_combination_key}}_{{$agent_ads_key}}_agent_sale_price"
                                    class="text-dark fw-bold fs-6">
                                        @if(isset($agent_ad['subtotal_sale_price']))
                                        {{$agent_ad['subtotal_sale_price']}}
                                        @else
                                        0
                                        @endif
                                    </span>
                                </td>
                                <td>
                                    <span 
                                    id="{{$agent_combination_key}}_{{$agent_ads_key}}_agent_list_price"
                                    class="text-dark fw-bold fs-6">{{$agent_ad['list_price']}}</span>
                                </td>
                                <td class="text-end">
                                    <a href="javascript:;" 
                                    combination_key="{{$agent_combination_key}}"
                                    row="{{$agent_ads_key}}"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#modal_delete_agent_adslot"
                                    class="delete_agent_adslot btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                                        <i class="ki-duotone ki-trash fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                            <span class="path5"></span>
                                        </i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Table container-->
            </div>
            <!--begin::Body-->
            <!--begin::Card footer-->
            <div class="card-footer  pe-0 ps-0">
                <div class="d-flex flex-row">
                    <div class="d-flex justify-content-end" style="margin-left:auto;">
                        <div class="d-flex flex-center">
                            <span class="fw-bold text-gray-600 me-1">{{__('ad-schedule.promise-quantity')}}</span>
                            <span 
                            id="{{$agent_combination_key}}_{{$agent_ads_key}}_agent_promise_quantity"
                            class="text-gray-800 fw-bolder fs-5 me-5">
                                @php
                                    if(isset($agent_ad['subtotal_sale_price'])){
                                        echo floor($agent_ad['subtotal_sale_price']/$agent_ad['list_price']);
                                    }
                                    else{
                                        echo '0';
                                    }

                                @endphp
                               
                            </span>   
                        </div>
                        <div class="d-flex flex-center">
                            <span class="pe-2">
                                <span class="fw-bold text-gray-600">{{__('ad-schedule.subtotal-sale-price')}}</span>
                            </span>
                            <span class="ps-0">
                                <input 
                                combination_key="{{$agent_combination_key}}"
                                row="{{$agent_ads_key}}"
                                id="{{$agent_combination_key}}_{{$agent_ads_key}}_agent_subtotal_sale_price" type="text" class="form-control form-control-solid form-control-sm agent_subtotal_sale_price" 
                                value="{{ isset($agent_ad['subtotal_sale_price'])?$agent_ad['subtotal_sale_price']:'' }}">
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Card footer-->
        </div>
        @endforeach
    @endforeach
@endif
<div class="card" id="agent_add_adslot_button">
    <div class="d-flex flex-row">
            <div class="d-flex justify-content-start" style="margin-left:0;">
                <button data-bs-toggle="modal" data-bs-target="#modal_add_agent_adslot" type="button" class="btn btn-sm btn-secondary me-5 add_agent_adslot" >
            {{__('ad-schedule.new-adslot')}}</button>
            </div>
    </div>
</div>