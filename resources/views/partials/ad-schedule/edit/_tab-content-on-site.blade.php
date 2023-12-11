@if(isset($total_ingroup_adslot_groups['D']) && !is_null($total_ingroup_adslot_groups['D']))
@foreach($total_ingroup_adslot_groups['D'] as $ingroup_key=>$ingroup_adslot_groups)
@if(!empty($ingroup_adslot_groups))
<div class="card adslot-groups-table">
    <!--begin::Header-->
    <div class="card-header pt-5 pe-0 ps-0">
        <h3 class="card-title align-items-start flex-column"></h3>
            <div class="card-toolbar">
                <a 
                insertion_type="D"
                href="javascript:;" id="" class="subtotal_sale_price_button btn btn-sm btn-secondary me-5" data-bs-toggle="modal" data-bs-target="#modal_subtotal_sale_price" ingroup-key="{{$ingroup_key}}">
                    {{__('ad-schedule.set-subtotal-sale-price')}}</a>
                <a 
                insertion_type="D"
                href="javascript:;" class="delete_adslots_button btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modal_delete_adslots">
                    {{__('ad-schedule.delete')}}</a>
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
                                <th class="w-25px">
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" data-kt-check="true" data-kt-check-target=".D-type-d-check-{{$ingroup_key}}" />
                                    </div>
                                </th>
                                <th class="min-w-20px">#</th>
                                <th class="min-w-400px">{{__('ad-schedule.adslot')}}</th>
                                <th class="min-w-150px">{{__('ad-schedule.adslot-start-date')}}</th>
                                <th class="min-w-150px">{{__('ad-schedule.adslot-end-date')}}</th>
                                <th class="min-w-50px">{{__('ad-schedule.days')}}</th>
                                <th class="min-w-50px">{{__('ad-schedule.quantity')}}</th>
                                <th class="min-w-75px">{{__('ad-schedule.list-price')}}</th>
                                <th class="min-w-75px">{{__('ad-schedule.discount-percentage')}}</th>
                                <th class="min-w-75px">{{__('ad-schedule.sale-price')}}</th>
                                <th class="min-w-75px">{{__('ad-schedule.sale-status')}}</th>
                                <th class="min-w-150px text-end">{{__('ad-schedule.actions')}}</th>
                            </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                            @php
                             $index_count = 1;
                             $subtotal_list_price = 0;
                             $subtotal_sale_price = 0;
                            @endphp
                            @foreach($ingroup_adslot_groups as $key=>$adslot_group)
                            
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input D-type-d-check-{{$ingroup_key}}" type="checkbox" value="{{$adslot_group}}" />
                                    </div>
                                </td>
                                <td>
                                    <span>{{$index_count}}</span>
                                    @php
                                    $index_count++;
                                    @endphp
                                </td>
                                <td>
                                    <div class="flex">
                                        <div>
                                            <span class="me-5">{{ $ingroup['D'][$adslot_group]['info']['channel'] }}</span>
                                            <span class="me-5">{{ $ingroup['D'][$adslot_group]['info']['region'] }}</span>
                                            <span class="me-5">{{ $ingroup['D'][$adslot_group]['info']['channelGroup'] }}</span>
                                        </div>
                                        <div>
                                            <span>{{ $ingroup['D'][$adslot_group]['info']['adslotGroup'] }}</span>
                                        </div>
                                        <div>
                                            <span class="fw-semibold text-danger d-block fs-7">{{ $ingroup['D'][$adslot_group]['info']['note'] }}</span>
                                        </div>
                                    </div>
                                    
                                </td>
                                <td>
                                    <span class="text-dark fw-bold fs-6">
                                    @foreach($ingroup['D'][$adslot_group]['info']['dateRanges'] as $key=>$dates)
                                        <div>{{ $dates[array_key_first($dates)] }}</div>    
                                    @endforeach
                                    </span>
                                </td>
                                <td>
                                    <span class="text-dark fw-bold fs-6">
                                    @foreach($ingroup['D'][$adslot_group]['info']['dateRanges'] as $key=>$dates)
                                        <div>{{ $dates[array_key_last($dates)] }}</div> 
                                    @endforeach
                                    </span>
                                </td>
                                <td>
                                    <span class="text-dark fw-bold fs-6">{{ $ingroup['D'][$adslot_group]['info']['days'] }}</span>
                                </td>
                                <td>
                                    <span class="text-dark fw-bold fs-6">0</span>
                                </td>
                                <td>
                                    @php
                                    $subtotal_list_price += ($ingroup['D'][$adslot_group]['info']['list_price']*count($ingroup['D'][$adslot_group]['info']['dateRanges']));
                                    
                                    @endphp
                                    <span class="text-dark fw-bold fs-6">{{ number_format($ingroup['D'][$adslot_group]['info']['list_price']*count($ingroup['D'][$adslot_group]['info']['dateRanges'])) }}</span>
                                </td>
                                <td>
                                    <span class="text-dark fw-bold fs-6">{{ 
                                    number_format((1-($ingroup['D'][$adslot_group]['info']['discount_percentage']/100))*100 ,2)
                                    }}%</span>
                                </td>
                                <td>
                                    <span class="text-dark fw-bold fs-6">
                                        @php
                                        $sale_price = ($ingroup['D'][$adslot_group]['info']['list_price']*count($ingroup['D'][$adslot_group]['info']['dateRanges']))*(1-($ingroup['D'][$adslot_group]['info']['discount_percentage']/100));

                                        $subtotal_sale_price += $sale_price;

                                        
                                        @endphp
                                    {{ number_format($sale_price,2) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge-light-success">{{__('ad-schedule.available')}}</span>
                                </td>
                                <td class="text-end">
                                    <!-- <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                        <i class="ki-duotone ki-calendar fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </a>
                                    <a href="/ad-schedule/booking" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                        <i class="ki-duotone ki-pencil fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </a> -->
                                    <a combination_key="{{$adslot_group}}" href="javascript:;" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm delete-adslot" data-bs-toggle="modal" data-bs-target="#modal_delete_adslots">
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
                            
                            @endforeach
                            
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
            <div class="d-flex flex-column flex-md-row justify-content-end">
                <!-- <a href="#" class="btn btn-sm btn-secondary me-5" data-bs-toggle="modal" data-bs-target="#kt_modal_invite_friends">
                {{__('ad-schedule.new-adslot')}}</a> -->
                <div class="d-flex justify-content-end">
                    <div>
                        <span class="fw-bold text-gray-600">{{__('ad-schedule.subtotal-list-price')}}</span>
                        <span class="text-gray-800 fw-bolder fs-5 me-5">{{number_format($subtotal_list_price)}}</span>   
                    </div>
                    <div>
                        <span class="fw-bold text-gray-600">{{__('ad-schedule.subtotal-sale-price')}}</span>
                        <span class="text-gray-800 fw-bolder fs-5 me-5">{{number_format($subtotal_sale_price)}}</span>  
                    </div>
                    <div>
                        <span class="fw-bold text-gray-600">
                            <div class="form-check form-check-solid fv-row fv-plugins-icon-container fv-plugins-bootstrap5-row-invalid">
                                <input 
                                insertion_type="D"
                                ingroup-key="{{$ingroup_key}}" data-bs-toggle="modal" data-bs-target="#modal_unlock_sale_price" class="form-check-input lock-sale-price" type="checkbox" value="" id="" checked/>
                                <label class="form-check-label" for="flexCheckDefault">
                                    {{__('ad-schedule.lock-subtotal-sale-price')}}
                                </label>
                            </div>    
                        </span>    
                    </div>
                    
                </div>
            </div>
            <!-- <div class="d-flex justify-content-end mt-9">
                <a href="#" class="btn btn-primary d-flex justify-content-end">Pleace Order</a>
            </div> -->
        </div>
        <!--end::Card footer-->
    </div>
    @endif
    @endforeach
    @endif


    <!--處理沒被分群的版位-->
    @if(isset($non_ingroup['D']) && !is_null($non_ingroup['D']) && !empty($non_ingroup['D']))
    <div class="card adslot-groups-table">
        <!--begin::Header-->
        <div class="card-header pt-5 pe-0 ps-0">
            <h3 class="card-title align-items-start flex-column"></h3>
                <div class="card-toolbar">
                    <a 
                    insertion_type="D"
                    href="javascript:;" id="" class="subtotal_sale_price_button btn btn-sm btn-secondary me-5" data-bs-toggle="modal" data-bs-target="#modal_subtotal_sale_price">
                        {{__('ad-schedule.set-subtotal-sale-price')}}</a>
                    <a 
                    insertion_type="D"
                    href="javascript:;" class="delete_adslots_button btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modal_delete_adslots">
                        {{__('ad-schedule.delete')}}</a>
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
                                    <th class="w-25px">
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" data-kt-check="true" data-kt-check-target=".D-type-d-check" />
                                        </div>
                                    </th>
                                    <th class="min-w-20px">#</th>
                                    <th class="min-w-400px">{{__('ad-schedule.adslot')}}</th>
                                    <th class="min-w-150px">{{__('ad-schedule.adslot-start-date')}}</th>
                                    <th class="min-w-150px">{{__('ad-schedule.adslot-end-date')}}</th>
                                    <th class="min-w-50px">{{__('ad-schedule.days')}}</th>
                                    <th class="min-w-50px">{{__('ad-schedule.quantity')}}</th>
                                    <th class="min-w-75px">{{__('ad-schedule.list-price')}}</th>
                                    <th class="min-w-75px">{{__('ad-schedule.discount-percentage')}}</th>
                                    <th class="min-w-75px">{{__('ad-schedule.sale-price')}}</th>
                                    <th class="min-w-75px">{{__('ad-schedule.sale-status')}}</th>
                                    <th class="min-w-150px text-end">{{__('ad-schedule.actions')}}</th>
                                </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody>
                                @php
                                 $index_count = 1;
                                 $subtotal_list_price = 0;
                                 $subtotal_sale_price = 0;
                                @endphp
                                @foreach($non_ingroup['D'] as $key=>$adslot_group)

                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input D-type-d-check" type="checkbox" value="{{$key}}" />
                                        </div>
                                    </td>
                                    <td>
                                        <span>{{$index_count}}</span>
                                        @php
                                        $index_count++;
                                        @endphp
                                    </td>
                                    <td>
                                        <div class="flex">
                                            <div>
                                                <span class="me-5">{{ $adslot_group['info']['channel'] }}</span>
                                                <span class="me-5">{{ $adslot_group['info']['region'] }}</span>
                                                <span class="me-5">{{ $adslot_group['info']['channelGroup'] }}</span>
                                            </div>
                                            <div>
                                                <span>{{ $adslot_group['info']['adslotGroup'] }}</span>
                                            </div>
                                            <div>
                                                <span class="fw-semibold text-danger d-block fs-7">{{ $adslot_group['info']['note'] }}</span>
                                            </div>
                                        </div>
                                        
                                    </td>
                                    <td>
                                        <span class="text-dark fw-bold fs-6">
                                        @foreach($adslot_group['info']['dateRanges'] as $date_range_key=>$dates)
                                            <div>{{ $dates[array_key_first($dates)] }}</div>    
                                        @endforeach
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-dark fw-bold fs-6">
                                        @foreach($adslot_group['info']['dateRanges'] as $date_range_key=>$dates)
                                            <div>{{ $dates[array_key_last($dates)] }}</div> 
                                        @endforeach
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-dark fw-bold fs-6">{{ $adslot_group['info']['days'] }}</span>
                                    </td>
                                    <td>
                                        <span class="text-dark fw-bold fs-6">0</span>
                                    </td>
                                    <td>
                                        @php
                                        $subtotal_list_price += ($adslot_group['info']['list_price']*count($adslot_group['info']['dateRanges']));
                                        
                                        @endphp
                                        <span class="text-dark fw-bold fs-6">{{ number_format($adslot_group['info']['list_price']*count($adslot_group['info']['dateRanges'])) }}</span>
                                    </td>
                                    <td>
                                        <span class="text-dark fw-bold fs-6">{{ 
                                        number_format((1-($adslot_group['info']['discount_percentage']/100))*100 ,2)
                                        }}%</span>
                                    </td>
                                    <td>
                                        <span class="text-dark fw-bold fs-6">
                                            @php
                                            $sale_price = ($adslot_group['info']['list_price']*count($adslot_group['info']['dateRanges']))*(1-($adslot_group['info']['discount_percentage']/100));

                                            $subtotal_sale_price += $sale_price;

                                            
                                            @endphp
                                        {{ number_format($sale_price,2) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge badge-light-success">{{__('ad-schedule.available')}}</span>
                                    </td>
                                    <td class="text-end">
                                        <!-- <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                            <i class="ki-duotone ki-calendar fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </a>
                                        <a href="/ad-schedule/booking" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                            <i class="ki-duotone ki-pencil fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </a> -->
                                        <a combination_key="{{$key}}" href="javascript:;" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm delete-adslot" data-bs-toggle="modal" data-bs-target="#modal_delete_adslots">
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
                                @endforeach
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
                <div class="d-flex flex-column flex-md-row justify-content-end">
                    <!-- <a href="#" class="btn btn-sm btn-secondary me-5" data-bs-toggle="modal" data-bs-target="#kt_modal_invite_friends">
                    {{__('ad-schedule.new-adslot')}}</a> -->
                    <div class="d-flex justify-content-end">
                        <div>
                            <span class="fw-bold text-gray-600">{{__('ad-schedule.subtotal-list-price')}}</span>
                            <span class="text-gray-800 fw-bolder fs-5 me-5">{{number_format($subtotal_list_price)}}</span>   
                        </div>
                        <div>
                            <span class="fw-bold text-gray-600">{{__('ad-schedule.subtotal-sale-price')}}</span>
                            <span class="text-gray-800 fw-bolder fs-5 me-5">{{number_format($subtotal_sale_price)}}</span>  
                        </div>
                        <div>
                            <span class="fw-bold text-gray-600">
                                <div class="form-check form-check-solid fv-row fv-plugins-icon-container fv-plugins-bootstrap5-row-invalid">
                                    <input 
                                    insertion_type="D"
                                    data-bs-toggle="modal" data-bs-target="#modal_lock_sale_price" class="form-check-input lock-sale-price" type="checkbox" value="" id="" />
                                    <label class="form-check-label" for="flexCheckDefault">
                                        {{__('ad-schedule.lock-subtotal-sale-price')}}
                                    </label>
                                </div>    
                            </span>    
                        </div>
                        
                    </div>
                </div>
                <!-- <div class="d-flex justify-content-end mt-9">
                    <a href="#" class="btn btn-primary d-flex justify-content-end">Pleace Order</a>
                </div> -->
            </div>
            <!--end::Card footer-->
        </div>
    @endif