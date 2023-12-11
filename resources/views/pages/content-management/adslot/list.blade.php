<x-base-layout>

    <!--begin::Modal Container-->
    {{ theme()->getView('partials/modals/ad-management/_view-adslot-detail-container') }}
    {{ theme()->getView('partials/modals/ad-management/_edit-performance-ad-container') }}
    {{ theme()->getView('partials/modals/ad-management/_create-performance-ad-container') }}
    <!--end::Modal Container-->
    <div class="d-flex flex-column flex-row-fluid">
        <div class="card card-flush mb-2">
            <div class="card-body">
                <div class="d-flex flex-column flex-row-fluid">
                    <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6">
                        @php
                            $adslot_types = config('global.general.adslot_types');
                        @endphp
                        
                        @foreach($adslot_types as $key=>$type)
                            <li class="nav-item">
                                <a class="nav-link text-active-primary @if($key==0) active @endif" data-bs-toggle="tab" href="#{{$type}}">
                                    {{__('general.'.$type)}}
                                </a>
                                
                            </li>
                        @endforeach
                        
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="general" role="tabpanel">
                            <div class="d-flex flex-column flex-row-fluid">
                                <!--begin::Row-->
                                <div class="row">
                                    <div class="col-2">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="fs-6 form-label mt-3">
                                                <span >{{__('ad-management.channels')}}</span>

                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Select-->
                                            <select id="filtered_channel" class="form-select form-select-sm"data-control="select2" data-hide-search="true">
                                                <option value="-1">All</option>
                                                @foreach($channels as $key=>$channel)
                                                    <option value="{{$channel->id}}">{{$channel->name}}</option>
                                                @endforeach
                                            </select>
                                            <!--end::Select-->
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <div class="col-2">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="fs-6 form-label mt-3">
                                                <span >{{__('ad-management.regions')}}</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Select-->
                                            <select id="filtered_region" class="form-select form-select-sm"data-control="select2" data-hide-search="true">
                                                <option value="-1">All</option>
                                            </select>
                                            <!--end::Select-->
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <div class="col-3">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="fs-6 form-label mt-3">
                                                <span >{{__('ad-management.channel-groups')}}</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Select-->
                                            <select id="filtered_channel_group" class="form-select form-select-sm"data-control="select2"  data-hide-search="true">
                                                <option value="-1">All</option>
                                            </select>
                                            <!--end::Select-->
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <div class="col-5">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="fs-6 form-label mt-3">&nbsp;</label>
                                            <!--end::Label-->
                                            <div class="row">
                                                <div class="col-4 d-flex align-items-center">
                                                    <div class="form-check mb-0">
                                                        <input class="form-check-input" type="checkbox" value="" id="filtered_sale_status" />
                                                        <label class="form-check-label" for="filtered_sale_status">
                                                            {{__('ad-management.display-for-sale')}}
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-5 d-flex justify-content-start">
                                                    <button 
                                                    id="filter_button"
                                                    class="btn btn-sm btn-warning me-5"
                                                    >
                                                    {{__('general.submit-filter')}}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                </div>
                                <!--end::Row-->
                                <div class="card">
                                    <!--begin::Header-->
                                    <div class="card-header pt-5 pe-0 ps-0">
                                        <h3 class="card-title align-items-start flex-column"></h3>
                                            <div class="card-toolbar">
                                                <a href="{{route('ad-management.adslot-group-list')}}" class="btn btn-sm btn-secondary me-5">
                                                    {{__('ad-management.create-adslot')}}</a>
                                            </div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body py-3 pe-0 ps-0">
                                    <!--begin::Table-->
                                        <table class="table table-head-custom table-checkable table-striped" id="adslot_general_list_table"></table>
                                    <!--end::Table-->        
                                    </div>
                                    <!--begin::Body-->
                                    
                                </div>
                                
                            </div>
                        </div>
                        <div class="tab-pane fade" id="non-general" role="tabpanel">
                                <div class="d-flex flex-column flex-row-fluid">
                                <!--begin::Row-->
                                <div class="row">
                                    <div class="col-2">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="fs-6 form-label mt-3">
                                                <span >{{__('ad-management.channels')}}</span>

                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Select-->
                                            <select id="filtered_channel_special" class="form-select form-select-sm"data-control="select2" data-hide-search="true">
                                                <option value="-1">All</option>
                                                @foreach($channels as $key=>$channel)
                                                    <option value="{{$channel->id}}">{{$channel->name}}</option>
                                                @endforeach
                                            </select>
                                            <!--end::Select-->
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <div class="col-2">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="fs-6 form-label mt-3">
                                                <span >{{__('ad-management.regions')}}</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Select-->
                                            <select id="filtered_region_special" class="form-select form-select-sm"data-control="select2" data-hide-search="true">
                                                <option value="-1">All</option>
                                            </select>
                                            <!--end::Select-->
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <div class="col-3">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="fs-6 form-label mt-3">
                                                <span >{{__('ad-management.channel-groups')}}</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Select-->
                                            <select id="filtered_channel_group_special" class="form-select form-select-sm"data-control="select2"  data-hide-search="true">
                                                <option value="-1">All</option>
                                            </select>
                                            <!--end::Select-->
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <div class="col-5">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="fs-6 form-label mt-3">&nbsp;</label>
                                            <!--end::Label-->
                                            <div class="row">
                                                <div class="col-4 d-flex align-items-center">
                                                    <div class="form-check mb-0">
                                                        <input class="form-check-input" type="checkbox" value="" id="filtered_sale_status_special" />
                                                        <label class="form-check-label" for="filtered_sale_status">
                                                            {{__('ad-management.display-for-sale')}}
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-5 d-flex justify-content-start">
                                                    <button 
                                                    id="filter_button_special"
                                                    class="btn btn-sm btn-warning me-5"
                                                    >
                                                    {{__('general.submit-filter')}}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                </div>
                                <!--end::Row-->
                                <div class="card">
                                    <!--begin::Header-->
                                    <div class="card-header pt-5 pe-0 ps-0">
                                        <h3 class="card-title align-items-start flex-column"></h3>
                                            <div class="card-toolbar">
                                                <a href="{{route('ad-management.adslot-group-list')}}" class="btn btn-sm btn-secondary me-5">
                                                    {{__('ad-management.create-adslot')}}</a>
                                            </div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body py-3 pe-0 ps-0">
                                    <!--begin::Table-->
                                        <table class="table table-head-custom table-checkable  table-striped" id="adslot_special_list_table"></table>
                                    <!--end::Table-->        
                                    </div>
                                    <!--begin::Body-->
                                    
                                </div>
                                
                            </div>
                        </div>
                        <div class="tab-pane fade" id="performance" role="tabpanel">
                                <div class="d-flex flex-column flex-row-fluid">
                                <!--begin::Row-->
                                <div class="row">
                                    <div class="col-2">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="fs-6 form-label mt-3">
                                                <span >{{__('ad-management.channels')}}</span>

                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Select-->
                                            <select id="filtered_channel_performance" class="form-select form-select-sm"data-control="select2"  data-hide-search="true">
                                                <option value="-1">All</option>
                                                @foreach($channels as $key=>$channel)
                                                    <option value="{{$channel->id}}">{{$channel->name}}</option>
                                                @endforeach
                                            </select>
                                            <!--end::Select-->
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <div class="col-5">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="fs-6 form-label mt-3">&nbsp;</label>
                                            <!--end::Label-->
                                            <div class="row">
                                                <div class="col-4 d-flex align-items-center">
                                                    <div class="form-check mb-0">
                                                        <input class="form-check-input" type="checkbox" value="" id="filtered_sale_status_performance" />
                                                        <label class="form-check-label" for="filtered_sale_status_performance">
                                                            {{__('ad-management.display-for-sale')}}
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-5 d-flex justify-content-start">
                                                    <button 
                                                    id="filter_button_performance"
                                                    class="btn btn-sm btn-warning me-5"
                                                    >
                                                    {{__('general.submit-filter')}}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                </div>
                                <!--end::Row-->
                                <div class="card">
                                    <!--begin::Header-->
                                    <div class="card-header pt-5 pe-0 ps-0">
                                        <h3 class="card-title align-items-start flex-column"></h3>
                                            <div class="card-toolbar">
                                                <a href="javascript:;" id="create_performance_ad_button" class="btn btn-sm btn-secondary me-5" data-bs-toggle="modal" data-bs-target="#modal_create_performance_ad">
                                                    {{__('ad-management.create-performance-ad')}}</a>
                                            </div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body py-3 pe-0 ps-0">
                                    <!--begin::Table-->
                                        <table class="table table-head-custom table-checkable table-striped" id="performance_ad_list_table"></table>
                                    <!--end::Table-->        
                                    </div>
                                    <!--begin::Body-->
                                    
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>




</x-base-layout>
