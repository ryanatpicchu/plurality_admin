@if(isset($insertions['R']) && !is_null($insertions['R']))
    @foreach($insertions['R'] as $remarketing_combination_key=>$remarketing_ad_info)
        @foreach($remarketing_ad_info['info'] as $remarketing_ads_key=>$remarketing_ad)
        <div 
        class="card adslot-groups-table"
        combination_key="{{$remarketing_combination_key}}"
        row="{{$remarketing_ads_key}}"
        >
        <!--begin::Header-->
        <div class="card-header pt-5 pe-0 ps-0">
            <h3 class="card-title align-items-start flex-column"></h3>
                <div class="card-toolbar">
                    <a 
                    insertion_type="R"
                    combination_key="{{$remarketing_combination_key}}"
                    row="{{$remarketing_ads_key}}"
                    href="javascript:;" 
                    id="" class="sales_unit_sale_price_button btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#modal_sales_unit_sale_price" ingroup-key="">
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
                                            id="{{$remarketing_combination_key}}_{{$remarketing_ads_key}}_remarketing_channel"
                                            class="form-select form-select-sm remarketing-channels" data-control="select2" data-hide-search="true">
                                                @foreach($all_remarketing_channels as $key=>$channel)
                                                    <option value="{{$channel->id}}" @if($channel->id == $remarketing_ad['channelId']) selected @endif>{{$channel->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @php
                                        $selected_channel = '';

                                        foreach($all_remarketing_channels as $key=>$channel){
                                            if($channel->id == $remarketing_ad['channelId']){
                                                $selected_channel = $channel;
                                            }
                                        }

                                        @endphp
                                        <div class="col-4">
                                            <select 
                                            id="{{$remarketing_combination_key}}_{{$remarketing_ads_key}}_remarketing_region"
                                            class="form-select form-select-sm remarketing-regions" data-control="select2" data-hide-search="true">
                                                @foreach($selected_channel->relatedRegion as $key=>$region)
                                                    <option value="{{$region->id}}" @if($region->id == $remarketing_ad['regionId']) selected @endif>{{$region->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col">
                                            <select 
                                            id="{{$remarketing_combination_key}}_{{$remarketing_ads_key}}_remarketing_ad"
                                            class="form-select form-select-sm remarketing-ads"data-control="select2"  data-hide-search="true">
                                                @foreach($selected_channel->relatedPerformanceAd as $key=>$ad)
                                                    <option value="{{$ad->id}}" @if($ad->id == $remarketing_ad['adId']) selected @endif>{{$ad->name}}({{$ad->sales_unit}})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <input 
                                    id="{{$remarketing_combination_key}}_{{$remarketing_ads_key}}_remarketing_start_date"
                                    type="text" class="adslot-date form-control form-control-sm remarketing-start-date" name="remarketing_start_date" value="{{$remarketing_ad['dateRanges'][0][array_key_first($remarketing_ad['dateRanges'][0])]}}">
                                </td>
                                <td>
                                    <input 
                                    id="{{$remarketing_combination_key}}_{{$remarketing_ads_key}}_remarketing_end_date"
                                    type="text" class="adslot-date form-control form-control-sm remarketing-end-date" name="remarketing_end_date" value="{{$remarketing_ad['dateRanges'][0][array_key_last($remarketing_ad['dateRanges'][0])]}}">
                                </td>
                                <td>
                                    <span 
                                    id="{{$remarketing_combination_key}}_{{$remarketing_ads_key}}_remarketing_days"
                                    class="text-dark fw-bold fs-6">
                                        @if(isset($remarketing_ad['days']))
                                        {{$remarketing_ad['days']}}
                                        
                                        @endif
                                    </span>
                                </td>
                                <td>
                                    <span class="text-dark fw-bold fs-6">0</span>
                                </td>
                                <td>
                                    <span 
                                    id="{{$remarketing_combination_key}}_{{$remarketing_ads_key}}_remarketing_sale_price"
                                    class="text-dark fw-bold fs-6">
                                        @if(isset($remarketing_ad['subtotal_sale_price']))
                                        {{$remarketing_ad['subtotal_sale_price']}}
                                        @else
                                        0
                                        @endif
                                    </span>
                                </td>
                                <td>
                                    <span 
                                    id="{{$remarketing_combination_key}}_{{$remarketing_ads_key}}_remarketing_list_price"
                                    class="text-dark fw-bold fs-6">{{$remarketing_ad['list_price']}}</span>
                                </td>
                                <td class="text-end">
                                    <a href="javascript:;" 
                                    combination_key="{{$remarketing_combination_key}}"
                                    row="{{$remarketing_ads_key}}"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#modal_delete_remarketing_adslot"
                                    class="delete_remarketing_adslot btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
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
                            id="{{$remarketing_combination_key}}_{{$remarketing_ads_key}}_remarketing_promise_quantity"
                            class="text-gray-800 fw-bolder fs-5 me-5">
                                @php
                                    if(isset($remarketing_ad['subtotal_sale_price'])){
                                        echo floor($remarketing_ad['subtotal_sale_price']/$remarketing_ad['list_price']);
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
                                combination_key="{{$remarketing_combination_key}}"
                                row="{{$remarketing_ads_key}}"
                                id="{{$remarketing_combination_key}}_{{$remarketing_ads_key}}_remarketing_subtotal_sale_price" type="text" class="form-control form-control-solid form-control-sm remarketing_subtotal_sale_price" 
                                value="{{ isset($remarketing_ad['subtotal_sale_price'])?$remarketing_ad['subtotal_sale_price']:'' }}">
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
<div class="card" id="remarketing_add_adslot_button">
    <div class="d-flex flex-row">
            <div class="d-flex justify-content-start" style="margin-left:0;">
                <button data-bs-toggle="modal" data-bs-target="#modal_add_remarketing_adslot" type="button" class="btn btn-sm btn-secondary me-5 add_remarketing_adslot" >
            {{__('ad-schedule.new-adslot')}}</button>
            </div>
    </div>
</div>