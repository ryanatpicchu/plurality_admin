<x-base-layout>

    <!--begin::Modal Container-->
    {{ theme()->getView('partials/modals/ad-management/_view-adslot-detail-container') }}
    <!--end::Modal Container-->
    <div class="d-flex flex-column flex-row-fluid">
        <div class="card card-flush mb-2">
            <div class="card-body">
                <div class="d-flex flex-column flex-row-fluid">
                    <!--begin::Row-->
                    <div class="row">
                        <div class="col-1">
                            <!--begin::Input group-->
                            <div class="fv-row">
                                <!--begin::Select-->
                                <select id="filtered_channel" class="form-select form-select-sm"data-control="select2" data-hide-search="true">
                                    <option value="-1">All</option>
                                </select>
                                <!--end::Select-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <div class="col-2">
                            <!--begin::Input group-->
                            <div class="fv-row">
                                <!--begin::Select-->
                                <select id="filtered_channel" class="form-select form-select-sm"data-control="select2" data-hide-search="true">
                                    <option value="-1">All</option>
                                </select>
                                <!--end::Select-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        
                        <div class="col-9">
                            <!--begin::Input group-->
                            <div class="fv-row">
                                <div class="row">
                                    
                                    <div class="col-2 d-flex justify-content-start">
                                        <button 
                                        id="filter_button"
                                        class="btn btn-sm btn-warning me-5"
                                        >
                                        {{__('general.submit-filter')}}
                                        </button>
                                    </div>
                                    <div class="col-2 d-flex align-items-center">
                                        <div class="form-check mb-0">
                                            <input class="form-check-input" type="checkbox" value="" id="" />
                                            <label class="form-check-label" for="">
                                                {{__('performance-management.compare-same-month-last-year')}}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-2 d-flex align-items-center">
                                        <div class="form-check mb-0">
                                            <input class="form-check-input" type="checkbox" value="" id="" />
                                            <label class="form-check-label" for="">
                                                {{__('performance-management.compare-last-month')}}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-2 d-flex align-items-center">
                                        <div class="form-check mb-0">
                                            <input class="form-check-input" type="checkbox" value="" id="" />
                                            <label class="form-check-label" for="">
                                                {{__('performance-management.compare-same-quarter-last-year')}}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-2 d-flex align-items-center">
                                        <div class="form-check mb-0">
                                            <input class="form-check-input" type="checkbox" value="" id="" />
                                            <label class="form-check-label" for="">
                                                {{__('performance-management.compare-last-quarter')}}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-2 d-flex align-items-center">
                                        <div class="form-check mb-0">
                                            <input class="form-check-input" type="checkbox" value="" id="" />
                                            <label class="form-check-label" for="">
                                                {{__('performance-management.compare-last-year')}}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Input group-->
                        </div>
                    </div>
                    <!--end::Row-->
                </div>
            </div>
        </div>
        <div class="card mb-2">
            <!--begin::Header-->
            <div class="card-header px-5">
                <h3 class="card-title align-items-start flex-column">
                    {{__('performance-management.signed-performance-summary')}}
                </h3>
                <div class="card-toolbar">
                    <a href="javascript:;" class="btn btn-sm btn-secondary copy-table" table="signed-performance-summary">
                        {{__('performance-management.copy-table')}}</a>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body py-3 pe-0 ps-0">
            <!--begin::Table-->
                <div class="py-5 px-5">
                    <table 
                    id="signed-performance-summary"
                    class="table table-rounded table-bordered text-center">
                        <thead>
                            <tr class="fw-bold fs-6">
                                <td class="bg-secondary">&nbsp;</td>
                                @for($i=1; $i<=12; $i++)
                                    <td class="bg-secondary">{{$i.__('performance-management.month')}}</td>
                                @endfor
                                <td class="bg-secondary">{{__('performance-management.year-summary')}}</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.target-monthly')}}</td>
                                @for($i=1; $i<=12; $i++)
                                    <td>111,111</td>
                                @endfor
                                <td class="fw-bold fs-6 bg-secondary">888,888</td>
                            </tr>
                            <tr>
                                <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.revenue-monthly')}}</td>
                                @for($i=1; $i<=12; $i++)
                                    <td>111,111</td>
                                @endfor
                                <td class="fw-bold fs-6 bg-secondary">888,888</td>
                            </tr>
                            <tr>
                                <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.achievement-rate-monthly')}}</td>
                                @for($i=1; $i<=12; $i++)
                                    <td>111,111</td>
                                @endfor
                                <td class="fw-bold fs-6 bg-secondary">888,888</td>
                            </tr>
                            <tr>
                                <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.target-quarterly')}}</td>
                                @for($i=1; $i<=4; $i++)
                                    <td colspan="3">111,111</td>
                                @endfor
                                <td class="fw-bold fs-6 bg-secondary">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.revenue-quarterly')}}</td>
                                @for($i=1; $i<=4; $i++)
                                    <td colspan="3">111,111</td>
                                @endfor
                                <td class="fw-bold fs-6 bg-secondary">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.achievement-rate-quarterly')}}</td>
                                @for($i=1; $i<=4; $i++)
                                    <td colspan="3">111,111</td>
                                @endfor
                                <td class="fw-bold fs-6 bg-secondary">&nbsp;</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <!--end::Table-->        
            </div>
            <!--begin::Body-->
        </div>
        <div class="card mb-2">
            <!--begin::Header-->
            <div class="card-header px-5">
                <h3 class="card-title align-items-start flex-column">
                    {{__('performance-management.signed-performance-cost-summary')}}
                </h3>
                <div class="card-toolbar">
                    <a href="/ad-management/adslot-group-list" class="btn btn-sm btn-secondary">
                        {{__('performance-management.copy-table')}}</a>
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
        <div class="card card-flush mb-2">
            <div class="card-body">
                <div class="d-flex flex-column flex-row-fluid">
                    <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6">
                        @php
                            $ad_types = config('global.general.ad_types');
                        @endphp
                        
                        @foreach($ad_types as $key=>$type)
                            <li class="nav-item">
                                <a class="nav-link text-active-primary @if($key=='D') active @endif" data-bs-toggle="tab" href="#{{$type}}">
                                    {{__('general.'.$type)}}
                                </a>
                            </li>
                        @endforeach
                        
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="on-site" role="tabpanel">
                            <div class="d-flex flex-column flex-row-fluid">
                                <div class="card mb-2">
                                    <!--begin::Header-->
                                    <div class="card-header px-5">
                                        <h3 class="card-title align-items-start flex-column">
                                            {{__('performance-management.signed-performance-summary-by-channel')}}
                                        </h3>
                                        <div class="card-toolbar">
                                            <a href="/ad-management/adslot-group-list" class="btn btn-sm btn-secondary">
                                                {{__('performance-management.copy-table')}}</a>
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
                                <div class="card mb-2">
                                    <!--begin::Header-->
                                    <div class="card-header px-5">
                                        <h3 class="card-title align-items-start flex-column">
                                            {{__('performance-management.potential-performance-summary-by-channel')}}
                                        </h3>
                                        <div class="card-toolbar">
                                            <a href="/ad-management/adslot-group-list" class="btn btn-sm btn-secondary">
                                                {{__('performance-management.copy-table')}}</a>
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
                                <div class="card mb-2">
                                    <!--begin::Header-->
                                    <div class="card-header px-5">
                                        <h3 class="card-title align-items-start flex-column">
                                            {{__('performance-management.about-to-sign-performance-summary-by-channel')}}
                                        </h3>
                                        <div class="card-toolbar">
                                            <a href="/ad-management/adslot-group-list" class="btn btn-sm btn-secondary">
                                                {{__('performance-management.copy-table')}}</a>
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
                    </div>
                </div>
            </div>
        </div>
    </div>




</x-base-layout>
