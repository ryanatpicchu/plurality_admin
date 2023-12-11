<x-base-layout>

    <!--begin::Modal Container-->
    {{ theme()->getView('partials/modals/ad-management/_material-setting-note-container') }}
    <!--end::Modal Container-->
    <div class="d-flex flex-column flex-row-fluid">
        <div class="card card-flush mb-2">
            <div class="card-body">
                <div class="d-flex flex-column flex-row-fluid">
                    <!--begin::Row-->
                    <div class="row">
                        <!--begin::Col-->
                        <div class="col-12">
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 form-label mt-3">
                                    <span >{{__('ad-management.ads-in-reviewing')}}</span>
                                </label>
                                <!--end::Label-->
                                <textarea class="form-control"></textarea>
                            </div>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                    <!--begin::Row-->
                    <div class="row">
                        <!--begin::Col-->
                        <div class="col-12">
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 form-label mt-3">
                                    <span >{{__('ad-management.material-setting-logs')}}</span>
                                </label>
                                <!--end::Label-->
                                <textarea class="form-control"></textarea>
                            </div>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                    
                    <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6">
                        @php
                            $material_setting_status = config('global.general.material_setting_status');
                        @endphp
                        
                        @foreach($material_setting_status as $key=>$status)
                            <li class="nav-item">
                                <a class="nav-link text-active-primary @if($key==0) active @endif" data-bs-toggle="tab" href="#{{$status}}">
                                    {{__('general.'.$status)}}
                                    @if($key==0)
                                    <span class="ms-1 badge badge-circle badge-danger">2</span>
                                    @endif
                                </a>
                                
                            </li>
                        @endforeach
                        
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="unfinished" role="tabpanel">
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
                                            <select class="form-select form-select-sm"data-control="select2" data-placeholder="{{__('general.please-choose')}}" data-hide-search="true">
                                                <option>All</option>
                                                <option value="1">591</option>
                                                <option value="2">518</option>
                                                <option value="3">8891</option>
                                                <option value="4">8591</option>
                                                <option value="6">100</option>
                                                <option value="7">數字廣告</option>
                                            </select>
                                            <!--end::Select-->
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-2">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="fs-6 form-label mt-3">
                                                <span >{{__('ad-management.ad-types')}}</span>

                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Select-->
                                            <select class="form-select form-select-sm"data-control="select2" data-placeholder="{{__('general.please-choose')}}" data-hide-search="true">
                                                <option>All</option>
                                                <option value="1">站內廣告</option>
                                                <option value="2">再行銷廣告</option>
                                                <option value="3">CPA廣告</option>
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
                                                <span >{{__('ad-management.days')}}</span>

                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Select-->
                                            <select class="form-select form-select-sm"data-control="select2" data-placeholder="{{__('general.please-choose')}}" data-hide-search="true">
                                                <option>All</option>
                                                <option value="1">1-3天</option>
                                                <option value="2">4-7天</option>
                                                <option value="3">8天(含以上)</option>
                                                <option value="4">16天(含以上)</option>
                                                <option value="6">31天(含以上)</option>
                                            </select>
                                            <!--end::Select-->
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <!--begin::Col-->
                                    <div class="col-6">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="fs-6 form-label mt-3">
                                                <span >{{__('general.filter-sales')}}</span>
                                            </label>
                                            <!--end::Label-->
                                            <div class="row">
                                                <div class="col-6">
                                                    <select class="form-select form-select-sm form-select-solid" data-control="select2" data-close-on-select="false" data-placeholder="{{__('general.please-choose')}}" data-allow-clear="true" multiple="multiple">
                                                        <option></option>
                                                        <option value="1">曾家羚</option>
                                                        <option value="2">陳小明</option>
                                                        <option value="3">胡大人</option>
                                                    </select>
                                                </div>
                                                <div class="col-3">
                                                    <button 
                                                    class="btn btn-sm btn-warning me-5"
                                                    >
                                                    {{__('general.submit-filter')}}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <!--end::Col-->
                                    
                                </div>
                                <!--end::Row-->
                                
                                <div class="row">
                                    <!--begin::Table-->
                            
                                    <table class="table table-head-custom" id="material_setting_unfinished_list_table">
                                        
                                    </table>
                                    <!--end::Table-->
                                    
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="done" role="tabpanel">
                                ...
                        </div>
                        <div class="tab-pane fade" id="all" role="tabpanel">
                                ...
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>




</x-base-layout>
