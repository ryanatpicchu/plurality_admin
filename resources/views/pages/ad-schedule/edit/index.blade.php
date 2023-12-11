<x-base-layout>

    @if (session('save_insertion_message') === 'store_to_temp_success')
    <script>alert('{{ trans('ad-schedule.store_to_temp_success') }}')</script>
    @elseif (session('save_insertion_message') === 'store_to_temp_failed')
    <script>alert('{{ trans('ad-schedule.store_to_temp_failed') }}')</script>
    @endif


    <!--begin::Modal Container-->
    {{ theme()->getView('partials/modals/ad-schedule/_subtotal-sale-price-container') }}
    {{ theme()->getView('partials/modals/ad-schedule/_subtotal-digitm-sale-price-container') }}
    {{ theme()->getView('partials/modals/ad-schedule/_remarketing-sales-unit-sale-price-container') }}
    {{ theme()->getView('partials/modals/ad-schedule/_agent-sales-unit-sale-price-container') }}
    {{ theme()->getView('partials/modals/ad-schedule/_lock-sale-price-container') }}
    {{ theme()->getView('partials/modals/ad-schedule/_lock-digitm-sale-price-container') }}
    {{ theme()->getView('partials/modals/ad-schedule/_unlock-sale-price-container') }}
    {{ theme()->getView('partials/modals/ad-schedule/_unlock-digitm-sale-price-container') }}
    {{ theme()->getView('partials/modals/ad-schedule/_delete-adslots-container') }}
    {{ theme()->getView('partials/modals/ad-schedule/_delete-digitm-adslots-container') }}
    {{ theme()->getView('partials/modals/ad-schedule/_delete-remarketing-adslot-container') }}
    {{ theme()->getView('partials/modals/ad-schedule/_delete-agent-adslot-container') }}
    {{ theme()->getView('partials/modals/ad-schedule/_store-insertion-container') }}
    {{ theme()->getView('partials/modals/ad-schedule/_add-remarketing-adslot-container') }}
    {{ theme()->getView('partials/modals/ad-schedule/_add-agent-adslot-container') }}
    {{ theme()->getView('partials/modals/ad-schedule/_cue-preview-container') }}
    <!--end::Modal Container-->
    <div class="d-flex flex-column flex-row-fluid">
        <form id="store_insertion_form" class="form" method="POST"  >
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <div class="card card-flush mb-2">
            <div class="card-body">
                <div class="d-flex flex-column flex-row-fluid">
                    <!--begin::Row-->
                    <div class="row">
                        <!--begin::Col-->
                        <div class="col-6">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 form-label mt-3">
                                    <span >{{__('ad-schedule.customer-name')}}</span>
                                </label>
                                <!--end::Label-->
                                <div class="row">
                                    <div class="col-9">
                                        <input id="customer_name" type="text" class="form-control form-control-sm @error('customer_name') is-invalid @enderror" name="customer_name" value="{{ old('customer_name',(!empty($specific_insertion)?$specific_insertion->customer_name:'')) }}" />
                                        <div class="fv-plugins-message-container">
                                            <div id="customer_name_error" data-field="customer_name" data-validator="notEmpty" class="fv-help-block @error('customer_name') errors @enderror">{{ $errors->first('customer_name') }}</div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <button type="button" onclick="var temp = document.getElementById('customer_name');temp.value='測試用客戶名稱';return;"
                                        class="btn btn-sm btn-secondary me-5"
                                        >
                                        {{__('ad-schedule.customer-list')}}
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Col-->
                        
                        <!--begin::Col-->
                        <div class="col-3">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 form-label mt-3 required">
                                    <span >{{__('ad-schedule.customer-industry')}}</span>
                                </label>
                                <!--end::Label-->
                                <!--begin::Select-->
                                <select class="form-select form-select-sm @error('customer_industry') is-invalid @enderror" data-control="select2" data-placeholder="{{__('general.please-choose')}}" data-hide-search="true" name="customer_industry">
                                    <option></option>
                                    <option value="1" @if(old('customer_industry',(!empty($specific_insertion)?$specific_insertion->customer_industry:'')) == 1) selected @endif>房產類</option>
                                    <option value="2" @if(old('customer_industry',(!empty($specific_insertion)?$specific_insertion->customer_industry:'')) == 2) selected @endif>其他類</option>
                                </select>
                                <!--end::Select-->
                                <div class="fv-plugins-message-container">
                                    <div id="customer_industry_error" data-field="customer_industry" data-validator="notEmpty" class="fv-help-block @error('customer_industry') errors @enderror">{{ $errors->first('customer_industry') }}</div>
                                </div>
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-3">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 form-label mt-3">
                                    <span >{{__('ad-schedule.customer-location')}}</span>
                                </label>
                                <!--end::Label-->
                                <div class="row">
                                    <div class="col">
                                        <!--begin::Select-->
                                        <select name="city" class="form-select form-select-sm @error('city') is-invalid @enderror"data-control="select2" data-placeholder="{{__('general.please-choose')}}" data-hide-search="true" name="city">>
                                            <option></option>
                                            <option value="台北市" @if(old('city',(!empty($specific_insertion)?$specific_insertion->city:'')) == '台北市') selected @endif>台北市</option>
                                            <option value="新北市" @if(old('city',(!empty($specific_insertion)?$specific_insertion->city:'')) == '新北市') selected @endif>新北市</option>
                                        </select>
                                        <!--end::Select-->
                                        <div class="fv-plugins-message-container">
                                            <div id="city_error" data-field="city" data-validator="notEmpty" class="fv-help-block @error('city') errors @enderror">{{ $errors->first('city') }}</div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <!--begin::Select-->
                                        <select name="district" class="form-select form-select-sm @error('district') is-invalid @enderror"data-control="select2" data-placeholder="{{__('general.please-choose')}}" data-hide-search="true" name="district">
                                            <option></option>
                                            <option value="大安區" @if(old('district',(!empty($specific_insertion)?$specific_insertion->district:'')) == '大安區') selected @endif>大安區</option>
                                            <option value="中正區" @if(old('district',(!empty($specific_insertion)?$specific_insertion->district:'')) == '中正區') selected @endif>中正區</option>
                                        </select>
                                        <!--end::Select-->
                                        <div class="fv-plugins-message-container">
                                            <div id="district_error" data-field="district" data-validator="notEmpty" class="fv-help-block @error('district') errors @enderror">{{ $errors->first('district') }}</div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                    <!--begin::Row-->
                    <div class="row">
                        <!--begin::Col-->
                        <div class="col-3">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 form-label mt-3">
                                    <span >{{__('ad-schedule.product-id')}}</span>
                                </label>
                                <!--end::Label-->
                                <div class="row">
                                    <div class="col-7">
                                        <input type="text" class="form-control form-control-sm" name="product_id" value="{{old('product_id',(!empty($specific_insertion)?$specific_insertion->product_id:''))}}" />
                                    </div>
                                    <div class="col-5">
                                        <button 
                                        type="button"
                                        id="lookup_product"
                                        class="btn btn-sm btn-secondary me-5"
                                        onclick="var temp = document.getElementById('product_name');temp.value='測試用產品';return;"
                                        >
                                        {{__('ad-schedule.lookup-product')}}
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-3">
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 form-label mt-3 required">
                                    <span >{{__('ad-schedule.product-name')}}</span>
                                </label>
                                <!--end::Label-->
                                <div class="row">
                                    <div class="col">
                                        <input id="product_name" type="text" class="form-control form-control-sm @error('product_name') is-invalid @enderror" name="product_name" value="{{old('product_name',(!empty($specific_insertion)?$specific_insertion->product_name:''))}}" />
                                        <div class="fv-plugins-message-container">
                                            <div id="product_name_error" data-field="product_name" data-validator="notEmpty" class="fv-help-block @error('product_name') errors @enderror">{{ $errors->first('product_name') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-3">
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 form-label mt-3">
                                    <span >{{__('ad-schedule.product-detail-name')}}</span>
                                </label>
                                <!--end::Label-->
                                <div class="row">
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm @error('product_detail_name') is-invalid @enderror" name="product_detail_name" value="{{old('product_detail_name',(!empty($specific_insertion)?$specific_insertion->product_detail_name:''))}}" />
                                        <div class="fv-plugins-message-container">
                                            <div id="product_detail_name_error" data-field="product_detail_name" data-validator="notEmpty" class="fv-help-block @error('product_detail_name') errors @enderror">{{ $errors->first('product_detail_name') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-3">
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 form-label mt-3">
                                    <span >{{__('ad-schedule.note')}}</span>
                                </label>
                                <!--end::Label-->
                                <div class="row">
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm" name="note" value="{{old('note',(!empty($specific_insertion)?$specific_insertion->note:''))}}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Col-->
                        
                    </div>
                    <!--end::Row-->
                    <div class="separator border-secondary my-10"></div>
                    <div class="d-flex flex-row-fluid ms-auto">
                        <a href="/ad-schedule/booking"><button type="button" class="btn btn-sm btn-secondary me-5" >{{__('ad-schedule.add-adslot')}}</button></a>
                        <button id="preview_cue" type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#modal_cue_preview">{{__('ad-schedule.preview')}}</button>
                    </div>
                    <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6">
                        @php
                            $ad_types = config('global.general.ad_types');
                        @endphp
                        
                        @foreach($ad_types as $key=>$ad_type)
                            <li class="nav-item">
                                <a class="nav-link text-active-primary @if($key=='D') active @endif" data-bs-toggle="tab" href="#{{$ad_type}}">
                                    {{__('general.'.$ad_type)}}
                                    @if(isset($insertions[$key]) && count($insertions[$key])>0)
                                        @if($key=='R')
                                            @php
                                            $count_insertion_remarketing_infos = 0;
                                            @endphp
                                            
                                            @foreach($insertions[$key] as $insertion_remarketing_combination_key => $insertion_remarketing_infos)
                                                @php
                                                    $count_insertion_remarketing_infos += count($insertion_remarketing_infos['info']);
                                                @endphp
                                            @endforeach
                                            @if($count_insertion_remarketing_infos > 0)
                                            <span class="ms-1 badge badge-circle badge-danger">{{ $count_insertion_remarketing_infos }}</span>
                                            @endif
                                        @elseif($key=='A')
                                            @php
                                            $count_insertion_agent_infos = 0;
                                            @endphp
                                            
                                            @foreach($insertions[$key] as $insertion_agent_combination_key => $insertion_agent_infos)
                                                @php
                                                    $count_insertion_agent_infos += count($insertion_agent_infos['info']);
                                                @endphp
                                            @endforeach
                                            @if($count_insertion_agent_infos > 0)
                                            <span class="ms-1 badge badge-circle badge-danger">{{ $count_insertion_agent_infos }}</span>
                                            @endif
                                        @else
                                            <span class="ms-1 badge badge-circle badge-danger">{{count($insertions[$key])}}</span>
                                        @endif
                                    
                                    @endif
                                </a>
                                
                            </li>
                        @endforeach
                        
                    </ul>
                    <div class="tab-content">
                        @php
                        $total_subtotal_list_price = 0;
                        $total_subtotal_sale_price = 0;
                        @endphp

                        <!--站內廣告分頁-->
                        <div class="tab-pane fade show active" id="on-site" role="tabpanel">
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
                                            href="javascript:;" class="delete_adslots_button btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modal_delete_adslots" ingroup-key="{{$ingroup_key}}" >
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

                                                                $total_subtotal_list_price += ($ingroup['D'][$adslot_group]['info']['list_price']*count($ingroup['D'][$adslot_group]['info']['dateRanges']));
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

                                                                    $total_subtotal_sale_price += $sale_price;
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
                                                                    $total_subtotal_list_price += ($adslot_group['info']['list_price']*count($adslot_group['info']['dateRanges']));
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

                                                                        $total_subtotal_sale_price += $sale_price;
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
                            </div>

                            <!--再行銷分頁-->
                            <div class="tab-pane fade show" id="remarketing" role="tabpanel">
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
                                                    href="javascript:;" id="" class="sales_unit_sale_price_button btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#modal_sales_unit_sale_price" ingroup-key="">
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
                                                                            class="form-select form-select-sm remarketing-channels"
                                                                            data-control="select2" data-hide-search="true">
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
                                                                        {{isset($remarketing_ad['days'])?$remarketing_ad['days']:''}}
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <span class="text-dark fw-bold fs-6">0</span>
                                                                </td>
                                                                <td>
                                                                    <span id="{{$remarketing_combination_key}}_{{$remarketing_ads_key}}_remarketing_sale_price" class="text-dark fw-bold fs-6">
                                                                        {{isset($remarketing_ad['subtotal_sale_price'])?$remarketing_ad['subtotal_sale_price']:''}}
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
                                                                @php
                                                                $total_subtotal_list_price += isset($remarketing_ad['subtotal_sale_price'])?$remarketing_ad['subtotal_sale_price']:0;

                                                                $total_subtotal_sale_price += isset($remarketing_ad['subtotal_sale_price'])?$remarketing_ad['subtotal_sale_price']:0;
                                                                @endphp
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
                            </div>

                            <!--數字廣告分頁-->
                            <div class="tab-pane fade show" id="digitm" role="tabpanel">
                            @if(isset($total_ingroup_adslot_groups['M']) && !is_null($total_ingroup_adslot_groups['M']))
                            @foreach($total_ingroup_adslot_groups['M'] as $ingroup_key=>$ingroup_adslot_groups)
                            @if(!empty($ingroup_adslot_groups))
                            <div class="card adslot-groups-table">
                                <!--begin::Header-->
                                <div class="card-header pt-5 pe-0 ps-0">
                                    <h3 class="card-title align-items-start flex-column"></h3>
                                        <div class="card-toolbar">
                                            <a 
                                            insertion_type="M"
                                            href="javascript:;" id="" class="subtotal_digitm_sale_price_button btn btn-sm btn-secondary me-5" data-bs-toggle="modal" data-bs-target="#modal_subtotal_digitm_sale_price" ingroup-key="{{$ingroup_key}}">
                                                {{__('ad-schedule.set-subtotal-sale-price')}}</a>
                                            <a 
                                            insertion_type="M"
                                            href="javascript:;" class="delete_digitm_adslots_button btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modal_delete_digitm_adslots" ingroup-key="{{$ingroup_key}}" >
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
                                                                    <input class="form-check-input" type="checkbox" value="1" data-kt-check="true" data-kt-check-target=".M-type-d-check-{{$ingroup_key}}" />
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
                                                                    <input class="form-check-input M-type-d-check-{{$ingroup_key}}" type="checkbox" value="{{$adslot_group}}" />
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
                                                                        <span class="me-5">{{ $ingroup['M'][$adslot_group]['info']['channel'] }}</span>
                                                                        <span class="me-5">{{ $ingroup['M'][$adslot_group]['info']['region'] }}</span>
                                                                        <span class="me-5">{{ $ingroup['M'][$adslot_group]['info']['channelGroup'] }}</span>
                                                                    </div>
                                                                    <div>
                                                                        <span>{{ $ingroup['M'][$adslot_group]['info']['adslotGroup'] }}</span>
                                                                    </div>
                                                                    <div>
                                                                        <span class="fw-semibold text-danger d-block fs-7">{{ $ingroup['M'][$adslot_group]['info']['note'] }}</span>
                                                                    </div>
                                                                </div>
                                                                
                                                            </td>
                                                            <td>
                                                                <span class="text-dark fw-bold fs-6">
                                                                @foreach($ingroup['M'][$adslot_group]['info']['dateRanges'] as $key=>$dates)
                                                                    <div>{{ $dates[array_key_first($dates)] }}</div>    
                                                                @endforeach
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <span class="text-dark fw-bold fs-6">
                                                                @foreach($ingroup['M'][$adslot_group]['info']['dateRanges'] as $key=>$dates)
                                                                    <div>{{ $dates[array_key_last($dates)] }}</div> 
                                                                @endforeach
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <span class="text-dark fw-bold fs-6">{{ $ingroup['M'][$adslot_group]['info']['days'] }}</span>
                                                            </td>
                                                            <td>
                                                                <span class="text-dark fw-bold fs-6">0</span>
                                                            </td>
                                                            <td>
                                                                @php
                                                                $subtotal_list_price += ($ingroup['M'][$adslot_group]['info']['list_price']*count($ingroup['M'][$adslot_group]['info']['dateRanges']));
                                                                $total_subtotal_list_price += ($ingroup['M'][$adslot_group]['info']['list_price']*count($ingroup['M'][$adslot_group]['info']['dateRanges']));
                                                                @endphp
                                                                <span class="text-dark fw-bold fs-6">{{ number_format($ingroup['M'][$adslot_group]['info']['list_price']*count($ingroup['M'][$adslot_group]['info']['dateRanges'])) }}</span>
                                                            </td>
                                                            <td>
                                                                <span class="text-dark fw-bold fs-6">{{ 
                                                                number_format((1-($ingroup['M'][$adslot_group]['info']['discount_percentage']/100))*100 ,2)
                                                                }}%</span>
                                                            </td>
                                                            <td>
                                                                <span class="text-dark fw-bold fs-6">
                                                                    @php
                                                                    $sale_price = ($ingroup['M'][$adslot_group]['info']['list_price']*count($ingroup['M'][$adslot_group]['info']['dateRanges']))*(1-($ingroup['M'][$adslot_group]['info']['discount_percentage']/100));

                                                                    $subtotal_sale_price += $sale_price;

                                                                    $total_subtotal_sale_price += $sale_price;
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
                                                                <a combination_key="{{$adslot_group}}" href="javascript:;" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm delete-digitm-adslot" data-bs-toggle="modal" data-bs-target="#modal_delete_digitm_adslots">
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
                                                            insertion_type="M"
                                                            ingroup-key="{{$ingroup_key}}" data-bs-toggle="modal" data-bs-target="#modal_unlock_digitm_sale_price" class="form-check-input lock-digitm-sale-price" type="checkbox" value="" id="" checked/>
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
                                @if(isset($non_ingroup['M']) && !is_null($non_ingroup['M']) && !empty($non_ingroup['M']))
                                <div class="card adslot-groups-table">
                                    <!--begin::Header-->
                                    <div class="card-header pt-5 pe-0 ps-0">
                                        <h3 class="card-title align-items-start flex-column"></h3>
                                            <div class="card-toolbar">
                                                <a 
                                                insertion_type="M"
                                                href="javascript:;" id="" class="subtotal_digitm_sale_price_button btn btn-sm btn-secondary me-5" data-bs-toggle="modal" data-bs-target="#modal_subtotal_digitm_sale_price">
                                                    {{__('ad-schedule.set-subtotal-sale-price')}}</a>
                                                <a 
                                                insertion_type="M"
                                                href="javascript:;" class="delete_digitm_adslots_button btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modal_delete_digitm_adslots">
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
                                                                        <input class="form-check-input" type="checkbox" value="1" data-kt-check="true" data-kt-check-target=".M-type-d-check" />
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
                                                            @foreach($non_ingroup['M'] as $key=>$adslot_group)

                                                            <tr>
                                                                <td>
                                                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                                        <input class="form-check-input M-type-d-check" type="checkbox" value="{{$key}}" />
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
                                                                    $total_subtotal_list_price += ($adslot_group['info']['list_price']*count($adslot_group['info']['dateRanges']));
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

                                                                        $total_subtotal_sale_price += $sale_price;
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
                                                                    <a combination_key="{{$key}}" href="javascript:;" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm delete-digitm-adslot" data-bs-toggle="modal" data-bs-target="#modal_delete_digitm_adslots">
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
                                                                insertion_type="M"
                                                                data-bs-toggle="modal" data-bs-target="#modal_lock_digitm_sale_price" class="form-check-input lock-digitm-sale-price" type="checkbox" value="" id="" />
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
                            </div>
                            <!--廣告代操分頁-->
                            <div class="tab-pane fade show" id="agent" role="tabpanel">
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
                                                    href="javascript:;" id="" class="agent_sales_unit_sale_price_button btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#modal_agent_sales_unit_sale_price" ingroup-key="">
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
                                                                            class="form-select form-select-sm agent-channels"
                                                                            data-control="select2" data-hide-search="true">
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
                                                                        {{isset($agent_ad['days'])?$agent_ad['days']:''}}
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <span class="text-dark fw-bold fs-6">0</span>
                                                                </td>
                                                                <td>
                                                                    <span id="{{$agent_combination_key}}_{{$agent_ads_key}}_agent_sale_price" class="text-dark fw-bold fs-6">
                                                                        {{isset($agent_ad['subtotal_sale_price'])?$agent_ad['subtotal_sale_price']:''}}
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

                                                                @php
                                                                $total_subtotal_list_price += isset($agent_ad['subtotal_sale_price'])?$agent_ad['subtotal_sale_price']:0;

                                                                $total_subtotal_sale_price += isset($agent_ad['subtotal_sale_price'])?$agent_ad['subtotal_sale_price']:0;
                                                                @endphp
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
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <div class="card card-flush mb-2">
            <div class="card-body">
                <div class="d-flex flex-column flex-row-fluid">
                    <!--begin::Row-->
                    <div class="row">
                        <!--begin::Col-->
                        <div class="col-4">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 form-label mt-3">
                                    <span >{{__('ad-schedule.store-by-assistant')}}</span>
                                </label>
                                <!--end::Label-->
                                <div class="row">
                                    <div class="col-3 d-flex align-items-center">
                                        <div class="form-check form-check-custom form-check-solid">
                                            <input name="store_by_assistant" class="form-check-input" type="radio" value="" id="flexRadioChecked" checked="checked" />
                                            <label class="form-check-label" for="flexRadioChecked">
                                                {{__('ad-schedule.no')}}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-3 d-flex align-items-center">
                                        <div class="form-check form-check-custom form-check-solid">
                                            <input name="store_by_assistant" class="form-check-input" type="radio" value="" id="flexRadioNonChecked" />
                                            <label class="form-check-label" for="flexRadioNonChecked">
                                                {{__('ad-schedule.yes')}}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <!--begin::Select-->
                                        <select class="form-select form-select-sm"data-control="select2" data-placeholder="{{__('ad-schedule.please-choose-sales')}}" data-hide-search="true">
                                            <option></option>
                                            <option value="1">Ryan Hu</option>
                                        </select>
                                        <!--end::Select-->
                                    </div>
                                </div>
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-4 ms-auto">
                            <!--begin::Input group-->
                            <div class="d-flex fv-row mb-7">
                                <!--begin::Col-->
                                <div class="col-4">
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="fs-6 form-label mt-3">
                                            <span >{{__('ad-schedule.total-list-price')}}</span>
                                        </label>
                                        <!--end::Label-->
                                        <div id="total_subtotal_list_price">{{ number_format($total_subtotal_list_price) }}</div>
                                    </div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-4">
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="fs-6 form-label mt-3">
                                            <span >{{__('ad-schedule.total-sale-price')}}</span>
                                        </label>
                                        <!--end::Label-->
                                        <div id="total_subtotal_sale_price">{{ number_format($total_subtotal_sale_price) }}</div>
                                    </div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-4">
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="fs-6 form-label mt-3">
                                            <span >{{__('ad-schedule.total-discount-percentage')}}</span>
                                        </label>
                                        <!--end::Label-->

                                        @if($total_subtotal_list_price == 0)
                                            <div id="total_discount_percentage"></div>
                                        @else
                                            <div id="total_discount_percentage">{{ number_format((1-($total_subtotal_list_price-$total_subtotal_sale_price)/$total_subtotal_list_price)*100, 2) }}%</div>
                                        @endif
                                        
                                    </div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                </div>
            </div>
            <!--begin::Card footer-->
            <div class="card-footer d-flex justify-content-center">
                <!--begin::Button-->
                <button type="button" id="store_to_temp" class="btn btn-light me-3" >
                    @include('partials.general._button-indicator', ['label' => __('ad-schedule.store-to-temp')])
                </button>
                <!--end::Button-->
                @if(isset($specific_insertion->status))
                    @if($specific_insertion->status == 'temp')

                    <button type="button" id="turn_to_standby" class="btn badge-standby me-3" >
                        @include('partials.general._button-indicator', ['label' => __('ad-schedule.turn-to-standby')])
                    </button>
                    <button type="button" id="turn_to_standby_with_insertion" class="btn badge-standby_setted">
                        @include('partials.general._button-indicator', ['label' => __('ad-schedule.turn-into-ad-insertion')])
                    </button>

                    @elseif($specific_insertion->status == 'standby')

                    <button type="button" id="turn_to_standby_with_insertion" class="btn badge-standby_setted">
                        @include('partials.general._button-indicator', ['label' => __('ad-schedule.turn-into-ad-insertion')])
                    </button>

                    @elseif($specific_insertion->status == 'standbyWithInsertion')
                    <button type="button" id="turn_to_review" class="btn badge-standby_setted">
                        @include('partials.general._button-indicator', ['label' => __('ad-schedule.turn-into-review')])
                    </button>
                    @endif
                @else
                    <button type="button" id="turn_to_standby" class="btn badge-standby me-3" >
                        @include('partials.general._button-indicator', ['label' => __('ad-schedule.turn-to-standby')])
                    </button>
                    <button type="button" id="turn_to_standby_with_insertion" class="btn badge-standby_setted">
                        @include('partials.general._button-indicator', ['label' => __('ad-schedule.turn-into-ad-insertion')])
                    </button>
                @endif
                
            </div>
            <!--end::Card footer-->
        </div>
        <div class="card card-flush">
            <div class="card-body">
                <div class="d-flex flex-column flex-row-fluid">
                    <!--begin::Row-->
                    <div class="row">
                        <!--begin::Col-->
                        <div class="col-4">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 form-label mt-3">
                                    <span >{{__('ad-schedule.delivery-logs')}}</span>
                                </label>
                                <!--end::Label-->
                                <div class="row">
                                    <div class="col-12">
                                        <textarea class="form-control" aria-label="With textarea"></textarea>
                                    </div>
                                </div>
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                </div>
            </div>
        </div>
        </form>
    </div>
</x-base-layout>
<script>
var hash = window.location.hash;
if(hash != ''){
    $('a[href="'+hash+'"]')[0].click();
}
</script>

