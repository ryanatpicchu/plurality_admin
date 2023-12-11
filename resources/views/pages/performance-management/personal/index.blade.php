<x-base-layout>

    <!--begin::Modal Container-->
    {{ theme()->getView('partials/modals/performance-management/_list-districts-performance-container') }}
    <!--end::Modal Container-->
    <div class="d-flex flex-column flex-row-fluid">
        <div class="card card-flush mb-2">
            <div class="card-body">
                <div class="d-flex flex-column flex-row-fluid">
                   
                    <!--begin::Row-->
                    <div class="row">
                        <div class="col-2">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 form-label mt-3">
                                    <span >{{__('performance-management.sales')}}</span>
                                </label>
                                <!--end::Label-->
                                <!--begin::Select-->
                                <select 
                                id="filtered_sales"
                                name="filtered_sales"
                                class="form-select form-select-sm" data-control="select2" data-hide-search="false">
                                    <option value="1">Ryan Hu</option>
                                    <option value="2">Lily Chen</option>
                                </select>
                                <!--end::Select-->
                            </div>
                        </div>
                    </div>
                    <!--end::Row-->
                    
                    <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6">
                        @php
                            $report_types = config('global.general.personal_report_types');
                        @endphp
                        
                        @foreach($report_types as $key=>$type)
                            <li class="nav-item">
                                <a class="nav-link text-active-primary @if($key==0) active @endif" data-bs-toggle="tab" href="#{{$type}}">
                                    {{__('performance-management.'.$type)}}
                                </a>
                            </li>
                        @endforeach
                        
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="personal-summary" role="tabpanel">
                            <div class="d-flex flex-column flex-row-fluid">
                                <!--begin::Row-->
                                <div class="row">
                                    <div class="col-1">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="fs-6 form-label mt-3">
                                                <span >{{__('performance-management.filtered_year')}}</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Select-->
                                            <select 
                                            id="personal-summary-filtered_year"
                                            name="filtered_year"
                                            class="form-select form-select-sm"data-control="select2" data-hide-search="true">
                                                <option value="2023">2023</option>
                                            </select>
                                            <!--end::Select-->
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <div class="col-1">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="fs-6 form-label mt-3">
                                                <span >{{__('performance-management.display_types')}}</span>
                                            </label>
                                            <!--end::Label-->
                                            @php
                                                $display_types = config('global.general.report_display_types');
                                            @endphp
                                            
                                            <!--begin::Select-->
                                            <select 
                                            id="personal-summary-filtered_display_type"
                                            name="filtered_display_type"
                                            class="display_types form-select form-select-sm" data-control="select2" data-hide-search="true">
                                            @foreach($display_types as $key=>$type)
                                                <option value="{{$type}}">{{__('performance-management.display_types_'.$type)}}</option>
                                            @endforeach
                                            </select>
                                            <!--end::Select-->
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <!--begin::Col-->
                                    <div class="col-10">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="fs-6 form-label mt-3">
                                                <span >{{__('performance-management.selected')}}</span>
                                            </label>
                                            <!--end::Label-->
                                            <div class="row">
                                                <div id="personal-summary-filtered_months" class="col-8" >
                                                    <select 
                                                    name="personal-summary-filtered_months"
                                                    data-placeholder="{{__('general.months')}}"
                                                    class="form-select form-select-sm" data-control="select2" data-close-on-select="false" data-allow-clear="true" multiple="multiple">
                                                        @for($i=1; $i<=12; $i++)
                                                        <option value="{{$i}}">{{$i.__('performance-management.month')}}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div id="personal-summary-filtered_quarters" class="col-8" style="display:none;" >
                                                    <select 
                                                    name="personal-summary-filtered_quarters"
                                                    data-placeholder="{{__('general.quarters')}}"
                                                    class="form-select form-select-sm" data-control="select2" data-close-on-select="false" data-allow-clear="true" multiple="multiple">
                                                        @for($i=1; $i<=4; $i++)
                                                        <option value="{{$i}}">{{'Q'.$i}}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="col-2 d-flex justify-content-start">
                                                    <button 
                                                    class="btn btn-sm btn-warning me-5"
                                                    >
                                                    {{__('general.search')}}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <!--end::Col-->
                                    
                                </div>
                                <!--end::Row-->
                                <div class="card mb-2">
                                    <!--begin::Header-->
                                    <div class="card-header px-0">
                                        <h3 class="card-title align-items-start flex-column">
                                            &nbsp;
                                        </h3>
                                        <div class="card-toolbar">
                                            <a href="javascript:;" class="btn btn-sm btn-secondary copy-table" table="summary-1">
                                                {{__('performance-management.copy-table')}}</a>
                                        </div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body py-3 pe-0 ps-0">
                                    <!--begin::Table-->
                                        <table 
                                        id="summary-1"
                                        class="table table-rounded table-bordered text-center">
                                            <thead>
                                                <tr class="fw-bold fs-6">
                                                    <td class="bg-secondary">Ryan Hu</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td class="bg-secondary" colspan="3">{{$i.__('performance-management.month')}}</td>
                                                    @endfor
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.product')}}</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.target-revenue')}}</td>
                                                        <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.actual-revenue')}}</td>
                                                        <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.achievement-rate-monthly')}}</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.on-site')}}</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>111,111</td><td>222,222</td><td>333,333</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.remarketing')}}</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>111,111</td><td>222,222</td><td>333,333</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.digitm')}}</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>111,111</td><td>222,222</td><td>333,333</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.subtotal')}}</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>111,111</td><td>222,222</td><td>333,333</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.achievement-rate-monthly-onsite-and-remarketing')}}</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>&nbsp;</td><td>&nbsp;</td><td>888,888</td>
                                                    @endfor
                                                </tr>
                                            </tbody>
                                        </table>
                                    <!--end::Table-->        
                                    
                                    </div>
                                    <!--begin::Body-->
                                </div>
                                <div class="card mb-2">
                                    <!--begin::Header-->
                                    <div class="card-header px-0">
                                        <h3 class="card-title align-items-start flex-column">
                                            &nbsp;
                                        </h3>
                                        <div class="card-toolbar">
                                            <a href="javascript:;" class="btn btn-sm btn-secondary copy-table" table="summary-2">
                                                {{__('performance-management.copy-table')}}</a>
                                        </div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body py-3 pe-0 ps-0">
                                    <!--begin::Table-->
                                        <table 
                                        id="summary-2"
                                        class="table table-rounded table-bordered text-center">
                                            <thead>
                                                <tr class="fw-bold fs-6">
                                                    <td class="bg-secondary">Ryan Hu</td>
                                                    @for($i=4; $i<=6; $i++)
                                                        <td class="bg-secondary" colspan="3">{{$i.__('performance-management.month')}}</td>
                                                    @endfor
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.product')}}</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.target-revenue')}}</td>
                                                        <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.actual-revenue')}}</td>
                                                        <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.achievement-rate-monthly')}}</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.on-site')}}</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>111,111</td><td>222,222</td><td>333,333</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.remarketing')}}</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>111,111</td><td>222,222</td><td>333,333</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.digitm')}}</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>111,111</td><td>222,222</td><td>333,333</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.subtotal')}}</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>111,111</td><td>222,222</td><td>333,333</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.achievement-rate-monthly-onsite-and-remarketing')}}</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>&nbsp;</td><td>&nbsp;</td><td>888,888</td>
                                                    @endfor
                                                </tr>
                                            </tbody>
                                        </table>
                                    <!--end::Table-->        
                                    
                                    </div>
                                    <!--begin::Body-->
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="target-revenue-comparison" role="tabpanel">
                            <div class="d-flex flex-column flex-row-fluid">
                                <!--begin::Row-->
                                <div class="row">
                                    <div class="col-1">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="fs-6 form-label mt-3">
                                                <span >{{__('performance-management.filtered_year')}}</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Select-->
                                            <select 
                                            id="target-revenue-comparison-filtered_year"
                                            name="filtered_year"
                                            class="form-select form-select-sm"data-control="select2" data-hide-search="true">
                                                <option value="2023">2023</option>
                                            </select>
                                            <!--end::Select-->
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <div class="col-1">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="fs-6 form-label mt-3">
                                                <span >{{__('performance-management.display_types')}}</span>
                                            </label>
                                            <!--end::Label-->
                                            @php
                                                $display_types = config('global.general.report_display_types');
                                            @endphp
                                            
                                            <!--begin::Select-->
                                            <select 
                                            id="target-revenue-comparison-filtered_display_type"
                                            name="filtered_display_type"
                                            class="display_types form-select form-select-sm" data-control="select2" data-hide-search="true">
                                            @foreach($display_types as $key=>$type)
                                                <option value="{{$type}}">{{__('performance-management.display_types_'.$type)}}</option>
                                            @endforeach
                                            </select>
                                            <!--end::Select-->
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <!--begin::Col-->
                                    <div class="col-7">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="fs-6 form-label mt-3">
                                                <span >{{__('performance-management.selected')}}</span>
                                            </label>
                                            <!--end::Label-->
                                            <div class="row">
                                                <div id="target-revenue-comparison-filtered_months" class="col-12" >
                                                    <select 
                                                    name="target-revenue-comparison-filtered_months"
                                                    data-placeholder="{{__('general.months')}}"
                                                    class="form-select form-select-sm" data-control="select2" data-close-on-select="false" data-allow-clear="true" multiple="multiple">
                                                        @for($i=1; $i<=12; $i++)
                                                        <option value="{{$i}}">{{$i.__('performance-management.month')}}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div id="target-revenue-comparison-filtered_quarters" class="col-12" style="display:none;" >
                                                    <select 
                                                    name="target-revenue-comparison-filtered_quarters"
                                                    data-placeholder="{{__('general.quarters')}}"
                                                    class="form-select form-select-sm" data-control="select2" data-close-on-select="false" data-allow-clear="true" multiple="multiple">
                                                        @for($i=1; $i<=4; $i++)
                                                        <option value="{{$i}}">{{'Q'.$i}}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <!--end::Col-->
                                    <div class="col-1">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="fs-6 form-label mt-3">
                                                <span >{{__('performance-management.comparied_year')}}</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Select-->
                                            <select 
                                            id="target-revenue-comparison-comparied_year"
                                            name="comparied_year"
                                            class="form-select form-select-sm"data-control="select2" data-hide-search="true">
                                                <option value="2016">2016</option>
                                            </select>
                                            <!--end::Select-->
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <div class="col-1">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="fs-6 form-label mt-3">
                                                <span >&nbsp;</span>
                                            </label>
                                            <!--end::Label-->
                                            <div class="row">
                                                <div class="col-12 d-flex justify-content-start">
                                                    <button 
                                                    class="btn btn-sm btn-warning me-5"
                                                    >
                                                    {{__('general.search')}}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                </div>
                                <!--end::Row-->
                                <div class="card mb-2">
                                    <!--begin::Header-->
                                    <div class="card-header px-0">
                                        <h3 class="card-title align-items-start flex-column">
                                            &nbsp;
                                        </h3>
                                        <div class="card-toolbar">
                                            <a href="javascript:;" class="btn btn-sm btn-secondary copy-table" table="target-revenue-comparison-1">
                                                {{__('performance-management.copy-table')}}</a>
                                        </div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body py-3 pe-0 ps-0">
                                    <!--begin::Table-->
                                        <table 
                                        id="target-revenue-comparison-1"
                                        class="table table-rounded table-bordered text-center">
                                            <thead>
                                                <tr class="fw-bold fs-6">
                                                    <td class="bg-secondary">&nbsp;</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td class="bg-secondary" colspan="3">{{$i.__('performance-management.month')}}</td>
                                                    @endfor
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="align-middle">
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.product')}}</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.target-revenue')}}</td>
                                                        <td class="fw-bold fs-6 bg-secondary">
                                                            {{__('performance-management.same-period-comparison')}}<br />
                                                            (2016/{{ $i }})
                                                    </td>
                                                        <td class="fw-bold fs-6 bg-secondary">
                                                        {{__('performance-management.last-comparison')}}<br />
                                                        (2022/{{ $i }})
                                                    </td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.on-site')}}</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>111,111</td><td>222,222</td><td>333,333</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.remarketing')}}</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>111,111</td><td>222,222</td><td>333,333</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.digitm')}}</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>111,111</td><td>222,222</td><td>333,333</td>
                                                    @endfor
                                                </tr>
                                                <tr class="bg-secondary">
                                                    <td class="fw-bold fs-6">{{__('performance-management.subtotal')}}</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>111,111</td><td>222,222</td><td>333,333</td>
                                                    @endfor
                                                </tr>
                                            </tbody>
                                        </table>
                                    <!--end::Table-->        
                                    
                                    </div>
                                    <!--begin::Body-->
                                </div>
                                
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="actual-revenue-comparison" role="tabpanel">
                            <div class="d-flex flex-column flex-row-fluid">
                                <!--begin::Row-->
                                <div class="row">
                                    <div class="col-1">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="fs-6 form-label mt-3">
                                                <span >{{__('performance-management.filtered_year')}}</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Select-->
                                            <select 
                                            id="actual-revenue-comparison-filtered_year"
                                            name="filtered_year"
                                            class="form-select form-select-sm"data-control="select2" data-hide-search="true">
                                                <option value="2023">2023</option>
                                            </select>
                                            <!--end::Select-->
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <div class="col-1">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="fs-6 form-label mt-3">
                                                <span >{{__('performance-management.display_types')}}</span>
                                            </label>
                                            <!--end::Label-->
                                            @php
                                                $display_types = config('global.general.report_display_types');
                                            @endphp
                                            
                                            <!--begin::Select-->
                                            <select 
                                            id="actual-revenue-comparison-filtered_display_type"
                                            name="filtered_display_type"
                                            class="display_types form-select form-select-sm" data-control="select2" data-hide-search="true">
                                            @foreach($display_types as $key=>$type)
                                                <option value="{{$type}}">{{__('performance-management.display_types_'.$type)}}</option>
                                            @endforeach
                                            </select>
                                            <!--end::Select-->
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <!--begin::Col-->
                                    <div class="col-7">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="fs-6 form-label mt-3">
                                                <span >{{__('performance-management.selected')}}</span>
                                            </label>
                                            <!--end::Label-->
                                            <div class="row">
                                                <div id="actual-revenue-comparison-filtered_months" class="col-12" >
                                                    <select 
                                                    name="actual-revenue-comparison-filtered_months"
                                                    data-placeholder="{{__('general.months')}}"
                                                    class="form-select form-select-sm" data-control="select2" data-close-on-select="false" data-allow-clear="true" multiple="multiple">
                                                        @for($i=1; $i<=12; $i++)
                                                        <option value="{{$i}}">{{$i.__('performance-management.month')}}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div id="actual-revenue-comparison-filtered_quarters" class="col-12" style="display:none;" >
                                                    <select 
                                                    name="actual-revenue-comparison-filtered_quarters"
                                                    data-placeholder="{{__('general.quarters')}}"
                                                    class="form-select form-select-sm" data-control="select2" data-close-on-select="false" data-allow-clear="true" multiple="multiple">
                                                        @for($i=1; $i<=4; $i++)
                                                        <option value="{{$i}}">{{'Q'.$i}}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <!--end::Col-->
                                    <div class="col-1">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="fs-6 form-label mt-3">
                                                <span >{{__('performance-management.comparied_year')}}</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Select-->
                                            <select 
                                            id="actual-revenue-comparison-comparied_year"
                                            name="comparied_year"
                                            class="form-select form-select-sm"data-control="select2" data-hide-search="true">
                                                <option value="2016">2016</option>
                                            </select>
                                            <!--end::Select-->
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <div class="col-1">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="fs-6 form-label mt-3">
                                                <span >&nbsp;</span>
                                            </label>
                                            <!--end::Label-->
                                            <div class="row">
                                                <div class="col-12 d-flex justify-content-start">
                                                    <button 
                                                    class="btn btn-sm btn-warning me-5"
                                                    >
                                                    {{__('general.search')}}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                </div>
                                <!--end::Row-->
                                <div class="card mb-2">
                                    <!--begin::Header-->
                                    <div class="card-header px-0">
                                        <h3 class="card-title align-items-start flex-column">
                                            &nbsp;
                                        </h3>
                                        <div class="card-toolbar">
                                            <a href="javascript:;" class="btn btn-sm btn-secondary copy-table" table="actual-revenue-comparison-1">
                                                {{__('performance-management.copy-table')}}</a>
                                        </div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body py-3 pe-0 ps-0">
                                    <!--begin::Table-->
                                        <table 
                                        id="actual-revenue-comparison-1"
                                        class="table table-rounded table-bordered text-center">
                                            <thead>
                                                <tr class="fw-bold fs-6">
                                                    <td class="bg-secondary">&nbsp;</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td class="bg-secondary" colspan="3">{{$i.__('performance-management.month')}}</td>
                                                    @endfor
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="align-middle">
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.product')}}</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.target-revenue')}}</td>
                                                        <td class="fw-bold fs-6 bg-secondary">
                                                            {{__('performance-management.same-period-comparison')}}<br />
                                                            (2016/{{ $i }})
                                                    </td>
                                                        <td class="fw-bold fs-6 bg-secondary">
                                                        {{__('performance-management.last-comparison')}}<br />
                                                        (2022/{{ $i }})
                                                    </td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.on-site')}}</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>111,111</td><td>222,222</td><td>333,333</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.remarketing')}}</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>111,111</td><td>222,222</td><td>333,333</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.digitm')}}</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>111,111</td><td>222,222</td><td>333,333</td>
                                                    @endfor
                                                </tr>
                                                <tr class="bg-secondary">
                                                    <td class="fw-bold fs-6">{{__('performance-management.subtotal')}}</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>111,111</td><td>222,222</td><td>333,333</td>
                                                    @endfor
                                                </tr>
                                            </tbody>
                                        </table>
                                    <!--end::Table-->        
                                    
                                    </div>
                                    <!--begin::Body-->
                                </div>
                                <div class="card mb-2">
                                    <!--begin::Header-->
                                    <div class="card-header px-0">
                                        <h3 class="card-title align-items-start flex-column">
                                            &nbsp;
                                        </h3>
                                        <div class="card-toolbar">
                                            <a href="javascript:;" class="btn btn-sm btn-secondary copy-table" table="actual-revenue-comparison-2">
                                                {{__('performance-management.copy-table')}}</a>
                                        </div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body py-3 pe-0 ps-0">
                                    <!--begin::Table-->
                                        <table 
                                        id="actual-revenue-comparison-2"
                                        class="table table-rounded table-bordered text-center">
                                            <thead>
                                                <tr class="fw-bold fs-6">
                                                    <td class="bg-secondary">&nbsp;</td>
                                                    @for($i=4; $i<=4; $i++)
                                                        <td class="bg-secondary" colspan="3">{{$i.__('performance-management.month')}}</td>
                                                    @endfor
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="align-middle">
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.product')}}</td>
                                                    @for($i=4; $i<=4; $i++)
                                                        <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.target-revenue')}}</td>
                                                        <td class="fw-bold fs-6 bg-secondary">
                                                            {{__('performance-management.same-period-comparison')}}<br />
                                                            (2016/{{ $i }})
                                                    </td>
                                                        <td class="fw-bold fs-6 bg-secondary">
                                                        {{__('performance-management.last-comparison')}}<br />
                                                        (2022/{{ $i }})
                                                    </td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.on-site')}}</td>
                                                    @for($i=4; $i<=4; $i++)
                                                        <td>111,111</td><td>222,222</td><td>333,333</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.remarketing')}}</td>
                                                    @for($i=4; $i<=4; $i++)
                                                        <td>111,111</td><td>222,222</td><td>333,333</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.digitm')}}</td>
                                                    @for($i=4; $i<=4; $i++)
                                                        <td>111,111</td><td>222,222</td><td>333,333</td>
                                                    @endfor
                                                </tr>
                                                <tr class="bg-secondary">
                                                    <td class="fw-bold fs-6">{{__('performance-management.subtotal')}}</td>
                                                    @for($i=4; $i<=4; $i++)
                                                        <td>111,111</td><td>222,222</td><td>333,333</td>
                                                    @endfor
                                                </tr>
                                            </tbody>
                                        </table>
                                    <!--end::Table-->        
                                    
                                    </div>
                                    <!--begin::Body-->
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="signed-monthly" role="tabpanel">
                            <div class="d-flex flex-column flex-row-fluid">
                                <!--begin::Row-->
                                <div class="row justify-content-end">
                                    <div class="col-1">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <div class="row">
                                                <div class="col-12 d-flex justify-content-end">
                                                    <button 
                                                    class="btn btn-sm btn-warning"
                                                    >
                                                    {{__('general.last_month')}}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <div class="col-1">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            
                                            <!--begin::Select-->
                                            <select 
                                            id="signed-monthly-filtered_year"
                                            name="filtered_year"
                                            class="form-select form-select-sm"data-control="select2" data-hide-search="true">
                                                <option value="2023">2023</option>
                                            </select>
                                            <!--end::Select-->
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <div class="col-1">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            
                                            <!--begin::Select-->
                                            <select 
                                            id="signed-monthly-filtered_month"
                                            name="filtered_month"
                                            class="form-select form-select-sm" data-control="select2" data-hide-search="true">
                                            @for($i=1;$i<=12;$i++)
                                                <option value="{{$i}}">{{$i.__('performance-management.month')}}</option>
                                            @endfor
                                            </select>
                                            <!--end::Select-->
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    
                                    <div class="col-1">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <div class="row">
                                                <div class="col-12 d-flex justify-content-start">
                                                    <button 
                                                    class="btn btn-sm btn-warning"
                                                    >
                                                    {{__('general.next_month')}}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                </div>
                                <!--end::Row-->
                                <div class="card mb-20">
                                    <!--begin::Header-->
                                    <div class="card-header px-0">
                                        <h3 class="card-title align-items-start flex-column">
                                            {{__('performance-management.summary')}}
                                        </h3>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body py-3 pe-0 ps-0">
                                    <!--begin::Table-->
                                        <table 
                                        class="table table-rounded table-bordered text-center">
                                            <thead>
                                                <tr class="fw-bold fs-6 bg-secondary">
                                                    <td>{{__('performance-management.target')}}</td>
                                                    <td>{{__('performance-management.revenue')}}</td>
                                                    <td>{{__('performance-management.cost')}}</td>
                                                    <td>{{__('performance-management.achievement-rate')}}</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="align-middle">
                                                    <td class="fw-bold fs-6">888,888</td>
                                                    <td class="fw-bold fs-6">1888,888</td>
                                                    <td class="fw-bold fs-6">111,111</td>
                                                    <td class="fw-bold fs-6">101%</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    <!--end::Table-->        
                                    
                                    </div>
                                    <!--begin::Body-->
                                </div>
                                <div class="card mb-20">
                                    <!--begin::Header-->
                                    <div class="card-header px-0">
                                        <h3 class="card-title align-items-start flex-column">
                                            {{__('performance-management.on-site')}}
                                        </h3>
                                        <div class="card-toolbar">
                                            <a href="javascript:;" class="btn btn-sm btn-warning me-5" >
                                                {{__('performance-management.save')}}</a>
                                            <a href="javascript:;" class="btn btn-sm btn-secondary copy-table" table="signed-monthly-1">
                                                {{__('performance-management.copy-table')}}</a>
                                        </div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body py-3 pe-0 ps-0">
                                    <!--begin::Table-->
                                        <table 
                                        id="signed-monthly-1"
                                        class="table table-rounded table-bordered text-center">
                                            <thead>
                                                <tr class="fw-bold fs-6 bg-secondary" style="display:table;width:100%;table-layout:fixed;">
                                                    <td colspan="3">{{__('performance-management.subtotal')}}</td>
                                                    <td>123,456</td>
                                                    <td colspan="2">&nbsp;</td>
                                                    <td>0</td>
                                                    <td>666,888</td>
                                                </tr>
                                                <tr class="fw-bold fs-6 bg-secondary" style="display:table;width:100%;table-layout:fixed;">
                                                    <td>{{__('performance-management.customer-name')}}</td>
                                                    <td>{{__('performance-management.property-location')}}</td>
                                                    <td>{{__('performance-management.date-range')}}</td>
                                                    <td>{{__('performance-management.ad-revenue')}}</td>
                                                    <td>{{__('performance-management.ad-discount')}}</td>
                                                    <td>{{__('performance-management.insertion-number')}}</td>
                                                    <td>{{__('performance-management.ad-operation-cost')}}</td>
                                                    <td>{{__('performance-management.agency-commission-cost')}}</td>
                                                </tr>
                                            </thead>
                                            <tbody style="display:block;height:500px;overflow:auto;">
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">80.8%</td>
                                                    <td class="fw-bold fs-6">D-591-20231001-001</td>
                                                    <td class="fw-bold fs-6">
                                                        <input class="form-control form-control-sm" value="0">
                                                    </td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">80.8%</td>
                                                    <td class="fw-bold fs-6">D-591-20231001-001</td>
                                                    <td class="fw-bold fs-6">
                                                        <input class="form-control form-control-sm" value="0">
                                                    </td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">80.8%</td>
                                                    <td class="fw-bold fs-6">D-591-20231001-001</td>
                                                    <td class="fw-bold fs-6">
                                                        <input class="form-control form-control-sm" value="0">
                                                    </td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">80.8%</td>
                                                    <td class="fw-bold fs-6">D-591-20231001-001</td>
                                                    <td class="fw-bold fs-6">
                                                        <input class="form-control form-control-sm" value="0">
                                                    </td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">80.8%</td>
                                                    <td class="fw-bold fs-6">D-591-20231001-001</td>
                                                    <td class="fw-bold fs-6">
                                                        <input class="form-control form-control-sm" value="0">
                                                    </td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">80.8%</td>
                                                    <td class="fw-bold fs-6">D-591-20231001-001</td>
                                                    <td class="fw-bold fs-6">
                                                        <input class="form-control form-control-sm" value="0">
                                                    </td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">80.8%</td>
                                                    <td class="fw-bold fs-6">D-591-20231001-001</td>
                                                    <td class="fw-bold fs-6">
                                                        <input class="form-control form-control-sm" value="0">
                                                    </td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">80.8%</td>
                                                    <td class="fw-bold fs-6">D-591-20231001-001</td>
                                                    <td class="fw-bold fs-6">
                                                        <input class="form-control form-control-sm" value="0">
                                                    </td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    <!--end::Table-->        
                                    
                                    </div>
                                    <!--begin::Body-->
                                </div>
                                <div class="card mb-20">
                                    <!--begin::Header-->
                                    <div class="card-header px-0">
                                        <h3 class="card-title align-items-start flex-column">
                                            {{__('performance-management.remarketing')}}
                                        </h3>
                                        <div class="card-toolbar">
                                            <a href="javascript:;" class="btn btn-sm btn-secondary copy-table" table="signed-monthly-2">
                                                {{__('performance-management.copy-table')}}</a>
                                        </div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body py-3 pe-0 ps-0">
                                    <!--begin::Table-->
                                        <table 
                                        id="signed-monthly-2"
                                        class="table table-rounded table-bordered text-center">
                                            <thead>
                                                <tr class="fw-bold fs-6 bg-secondary" style="display:table;width:100%;table-layout:fixed;">
                                                    <td colspan="3">{{__('performance-management.subtotal')}}</td>
                                                    <td>123,456</td>
                                                    <td colspan="2">&nbsp;</td>
                                                    <td>0</td>
                                                    <td>666,888</td>
                                                </tr>
                                                <tr class="fw-bold fs-6 bg-secondary" style="display:table;width:100%;table-layout:fixed;">
                                                    <td>{{__('performance-management.customer-name')}}</td>
                                                    <td>{{__('performance-management.property-location')}}</td>
                                                    <td>{{__('performance-management.date-range')}}</td>
                                                    <td>{{__('performance-management.ad-revenue')}}</td>
                                                    <td>{{__('performance-management.ad-discount')}}</td>
                                                    <td>{{__('performance-management.insertion-number')}}</td>
                                                    <td>{{__('performance-management.ad-operation-cost')}}</td>
                                                    <td>{{__('performance-management.agency-commission-cost')}}</td>
                                                </tr>
                                            </thead>
                                            <tbody style="display:block;height:500px;overflow:auto;">
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">80.8%</td>
                                                    <td class="fw-bold fs-6">D-591-20231001-001</td>
                                                    <td class="fw-bold fs-6">
                                                        <span class="justify-content-start">123456</span>
                                                        <a href="javascript:;" class="ms-2 align-middle justify-content-end" data-bs-toggle="modal" data-bs-target="#modal_material_setting_note">
                                                            <i class="las la-edit fs-1"></i>
                                                        </a>
                                                    </td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">80.8%</td>
                                                    <td class="fw-bold fs-6">D-591-20231001-001</td>
                                                    <td class="fw-bold fs-6">
                                                        <span class="justify-content-start">0</span>
                                                        <a href="javascript:;" class="ms-2 align-middle justify-content-end" data-bs-toggle="modal" data-bs-target="#modal_material_setting_note">
                                                            <i class="las la-edit fs-1"></i>
                                                        </a>
                                                    </td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">80.8%</td>
                                                    <td class="fw-bold fs-6">D-591-20231001-001</td>
                                                    <td class="fw-bold fs-6">
                                                        <span class="justify-content-start">0</span>
                                                        <a href="javascript:;" class="ms-2 align-middle justify-content-end" data-bs-toggle="modal" data-bs-target="#modal_material_setting_note">
                                                            <i class="las la-edit fs-1"></i>
                                                        </a>
                                                    </td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">80.8%</td>
                                                    <td class="fw-bold fs-6">D-591-20231001-001</td>
                                                    <td class="fw-bold fs-6">
                                                        <span class="justify-content-start">0</span>
                                                        <a href="javascript:;" class="ms-2 align-middle justify-content-end" data-bs-toggle="modal" data-bs-target="#modal_material_setting_note">
                                                            <i class="las la-edit fs-1"></i>
                                                        </a>
                                                    </td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">80.8%</td>
                                                    <td class="fw-bold fs-6">D-591-20231001-001</td>
                                                    <td class="fw-bold fs-6">
                                                        <span class="justify-content-start">0</span>
                                                        <a href="javascript:;" class="ms-2 align-middle justify-content-end" data-bs-toggle="modal" data-bs-target="#modal_material_setting_note">
                                                            <i class="las la-edit fs-1"></i>
                                                        </a>
                                                    </td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">80.8%</td>
                                                    <td class="fw-bold fs-6">D-591-20231001-001</td>
                                                    <td class="fw-bold fs-6">
                                                        <span class="justify-content-start">0</span>
                                                        <a href="javascript:;" class="ms-2 align-middle justify-content-end" data-bs-toggle="modal" data-bs-target="#modal_material_setting_note">
                                                            <i class="las la-edit fs-1"></i>
                                                        </a>
                                                    </td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">80.8%</td>
                                                    <td class="fw-bold fs-6">D-591-20231001-001</td>
                                                    <td class="fw-bold fs-6">
                                                        <span class="justify-content-start">0</span>
                                                        <a href="javascript:;" class="ms-2 align-middle justify-content-end" data-bs-toggle="modal" data-bs-target="#modal_material_setting_note">
                                                            <i class="las la-edit fs-1"></i>
                                                        </a>
                                                    </td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">80.8%</td>
                                                    <td class="fw-bold fs-6">D-591-20231001-001</td>
                                                    <td class="fw-bold fs-6">
                                                        <span class="justify-content-start">0</span>
                                                        <a href="javascript:;" class="ms-2 align-middle justify-content-end" data-bs-toggle="modal" data-bs-target="#modal_material_setting_note">
                                                            <i class="las la-edit fs-1"></i>
                                                        </a>
                                                    </td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    <!--end::Table-->        
                                    
                                    </div>
                                    <!--begin::Body-->
                                </div>
                                <div class="card mb-20">
                                    <!--begin::Header-->
                                    <div class="card-header px-0">
                                        <h3 class="card-title align-items-start flex-column">
                                            {{__('performance-management.digitm')}}
                                        </h3>
                                        <div class="card-toolbar">
                                            <a href="javascript:;" class="btn btn-sm btn-warning me-5" >
                                                {{__('performance-management.save')}}</a>
                                            <a href="javascript:;" class="btn btn-sm btn-secondary copy-table" table="signed-monthly-3">
                                                {{__('performance-management.copy-table')}}</a>
                                        </div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body py-3 pe-0 ps-0">
                                    <!--begin::Table-->
                                        <table 
                                        id="signed-monthly-3"
                                        class="table table-rounded table-bordered text-center">
                                            <thead>
                                                <tr class="fw-bold fs-6 bg-secondary" style="display:table;width:100%;table-layout:fixed;">
                                                    <td colspan="3">{{__('performance-management.subtotal')}}</td>
                                                    <td>123,456</td>
                                                    <td colspan="2">&nbsp;</td>
                                                    <td>0</td>
                                                    <td>666,888</td>
                                                </tr>
                                                <tr class="fw-bold fs-6 bg-secondary" style="display:table;width:100%;table-layout:fixed;">
                                                    <td>{{__('performance-management.customer-name')}}</td>
                                                    <td>{{__('performance-management.property-location')}}</td>
                                                    <td>{{__('performance-management.date-range')}}</td>
                                                    <td>{{__('performance-management.ad-revenue')}}</td>
                                                    <td>{{__('performance-management.ad-discount')}}</td>
                                                    <td>{{__('performance-management.insertion-number')}}</td>
                                                    <td>{{__('performance-management.ad-operation-cost')}}</td>
                                                    <td>{{__('performance-management.agency-commission-cost')}}</td>
                                                </tr>
                                            </thead>
                                            <tbody style="display:block;height:300px;overflow:auto;">
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">80.8%</td>
                                                    <td class="fw-bold fs-6">D-591-20231001-001</td>
                                                    <td class="fw-bold fs-6">
                                                        <input class="form-control form-control-sm" value="0">
                                                    </td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">80.8%</td>
                                                    <td class="fw-bold fs-6">D-591-20231001-001</td>
                                                    <td class="fw-bold fs-6">
                                                        <input class="form-control form-control-sm" value="0">
                                                    </td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">80.8%</td>
                                                    <td class="fw-bold fs-6">D-591-20231001-001</td>
                                                    <td class="fw-bold fs-6">
                                                        <input class="form-control form-control-sm" value="0">
                                                    </td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">80.8%</td>
                                                    <td class="fw-bold fs-6">D-591-20231001-001</td>
                                                    <td class="fw-bold fs-6">
                                                        <input class="form-control form-control-sm" value="0">
                                                    </td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">80.8%</td>
                                                    <td class="fw-bold fs-6">D-591-20231001-001</td>
                                                    <td class="fw-bold fs-6">
                                                        <input class="form-control form-control-sm" value="0">
                                                    </td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">80.8%</td>
                                                    <td class="fw-bold fs-6">D-591-20231001-001</td>
                                                    <td class="fw-bold fs-6">
                                                        <input class="form-control form-control-sm" value="0">
                                                    </td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">80.8%</td>
                                                    <td class="fw-bold fs-6">D-591-20231001-001</td>
                                                    <td class="fw-bold fs-6">
                                                        <input class="form-control form-control-sm" value="0">
                                                    </td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">80.8%</td>
                                                    <td class="fw-bold fs-6">D-591-20231001-001</td>
                                                    <td class="fw-bold fs-6">
                                                        <input class="form-control form-control-sm" value="0">
                                                    </td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    <!--end::Table-->        
                                    
                                    </div>
                                    <!--begin::Body-->
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="signed-quarterly" role="tabpanel">
                            <div class="d-flex flex-column flex-row-fluid">
                                <!--begin::Row-->
                                <div class="row justify-content-end">
                                    <div class="col-1">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <div class="row">
                                                <div class="col-12 d-flex justify-content-end">
                                                    <button 
                                                    class="btn btn-sm btn-warning"
                                                    >
                                                    {{__('general.last_quarter')}}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <div class="col-1">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            
                                            <!--begin::Select-->
                                            <select 
                                            id="signed-quarterly-filtered_year"
                                            name="filtered_year"
                                            class="form-select form-select-sm"data-control="select2" data-hide-search="true">
                                                <option value="2023">2023</option>
                                            </select>
                                            <!--end::Select-->
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <div class="col-1">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            
                                            <!--begin::Select-->
                                            <select 
                                            id="signed-quarterly-filtered_month"
                                            name="filtered_month"
                                            class="form-select form-select-sm" data-control="select2" data-hide-search="true">
                                            @for($i=1;$i<=4;$i++)
                                                <option value="{{$i}}">Q{{$i}}</option>
                                            @endfor
                                            </select>
                                            <!--end::Select-->
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    
                                    <div class="col-1">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <div class="row">
                                                <div class="col-12 d-flex justify-content-start">
                                                    <button 
                                                    class="btn btn-sm btn-warning"
                                                    >
                                                    {{__('general.next_quarter')}}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                </div>
                                <!--end::Row-->
                                <div class="card mb-20">
                                    <!--begin::Header-->
                                    <div class="card-header px-0">
                                        <h3 class="card-title align-items-start flex-column">
                                            {{__('performance-management.summary')}}
                                        </h3>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body py-3 pe-0 ps-0">
                                    <!--begin::Table-->
                                        <table 
                                        class="table table-rounded table-bordered text-center">
                                            <thead>
                                                <tr class="fw-bold fs-6 bg-secondary">
                                                    <td>{{__('performance-management.target')}}</td>
                                                    <td>{{__('performance-management.revenue')}}</td>
                                                    <td>{{__('performance-management.cost')}}</td>
                                                    <td>{{__('performance-management.achievement-rate')}}</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="align-middle">
                                                    <td class="fw-bold fs-6">888,888</td>
                                                    <td class="fw-bold fs-6">1888,888</td>
                                                    <td class="fw-bold fs-6">111,111</td>
                                                    <td class="fw-bold fs-6">101%</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    <!--end::Table-->        
                                    
                                    </div>
                                    <!--begin::Body-->
                                </div>
                                <div class="card mb-20">
                                    <!--begin::Header-->
                                    <div class="card-header px-0">
                                        <h3 class="card-title align-items-start flex-column">
                                            {{__('performance-management.on-site')}}
                                        </h3>
                                        <div class="card-toolbar">
                                            <a href="javascript:;" class="btn btn-sm btn-secondary copy-table" table="signed-quarterly-1">
                                                {{__('performance-management.copy-table')}}</a>
                                        </div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body py-3 pe-0 ps-0">
                                    <!--begin::Table-->
                                        <table 
                                        id="signed-quarterly-1"
                                        class="table table-rounded table-bordered text-center">
                                            <thead>
                                                <tr class="fw-bold fs-6 bg-secondary" style="display:table;width:100%;table-layout:fixed;">
                                                    <td colspan="3">{{__('performance-management.subtotal')}}</td>
                                                    <td>123,456</td>
                                                    <td colspan="2">&nbsp;</td>
                                                    <td>0</td>
                                                    <td>666,888</td>
                                                </tr>
                                                <tr class="fw-bold fs-6 bg-secondary" style="display:table;width:100%;table-layout:fixed;">
                                                    <td>{{__('performance-management.customer-name')}}</td>
                                                    <td>{{__('performance-management.property-location')}}</td>
                                                    <td>{{__('performance-management.date-range')}}</td>
                                                    <td>{{__('performance-management.ad-revenue')}}</td>
                                                    <td>{{__('performance-management.ad-discount')}}</td>
                                                    <td>{{__('performance-management.insertion-number')}}</td>
                                                    <td>{{__('performance-management.ad-operation-cost')}}</td>
                                                    <td>{{__('performance-management.agency-commission-cost')}}</td>
                                                </tr>
                                            </thead>
                                            <tbody style="display:block;height:500px;overflow:auto;">
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">80.8%</td>
                                                    <td class="fw-bold fs-6">D-591-20231001-001</td>
                                                    <td class="fw-bold fs-6">0</td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">80.8%</td>
                                                    <td class="fw-bold fs-6">D-591-20231001-001</td>
                                                    <td class="fw-bold fs-6">0</td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">80.8%</td>
                                                    <td class="fw-bold fs-6">D-591-20231001-001</td>
                                                    <td class="fw-bold fs-6">0</td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">80.8%</td>
                                                    <td class="fw-bold fs-6">D-591-20231001-001</td>
                                                    <td class="fw-bold fs-6">0</td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">80.8%</td>
                                                    <td class="fw-bold fs-6">D-591-20231001-001</td>
                                                    <td class="fw-bold fs-6">0</td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">80.8%</td>
                                                    <td class="fw-bold fs-6">D-591-20231001-001</td>
                                                    <td class="fw-bold fs-6">0</td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">80.8%</td>
                                                    <td class="fw-bold fs-6">D-591-20231001-001</td>
                                                    <td class="fw-bold fs-6">0</td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">80.8%</td>
                                                    <td class="fw-bold fs-6">D-591-20231001-001</td>
                                                    <td class="fw-bold fs-6">0</td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    <!--end::Table-->        
                                    
                                    </div>
                                    <!--begin::Body-->
                                </div>
                                <div class="card mb-20">
                                    <!--begin::Header-->
                                    <div class="card-header px-0">
                                        <h3 class="card-title align-items-start flex-column">
                                            {{__('performance-management.remarketing')}}
                                        </h3>
                                        <div class="card-toolbar">
                                            <a href="javascript:;" class="btn btn-sm btn-secondary copy-table" table="signed-quarterly-2">
                                                {{__('performance-management.copy-table')}}</a>
                                        </div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body py-3 pe-0 ps-0">
                                    <!--begin::Table-->
                                        <table 
                                        id="signed-quarterly-2"
                                        class="table table-rounded table-bordered text-center">
                                            <thead>
                                                <tr class="fw-bold fs-6 bg-secondary" style="display:table;width:100%;table-layout:fixed;">
                                                    <td colspan="3">{{__('performance-management.subtotal')}}</td>
                                                    <td>123,456</td>
                                                    <td colspan="2">&nbsp;</td>
                                                    <td>0</td>
                                                    <td>666,888</td>
                                                </tr>
                                                <tr class="fw-bold fs-6 bg-secondary" style="display:table;width:100%;table-layout:fixed;">
                                                    <td>{{__('performance-management.customer-name')}}</td>
                                                    <td>{{__('performance-management.property-location')}}</td>
                                                    <td>{{__('performance-management.date-range')}}</td>
                                                    <td>{{__('performance-management.ad-revenue')}}</td>
                                                    <td>{{__('performance-management.ad-discount')}}</td>
                                                    <td>{{__('performance-management.insertion-number')}}</td>
                                                    <td>{{__('performance-management.ad-operation-cost')}}</td>
                                                    <td>{{__('performance-management.agency-commission-cost')}}</td>
                                                </tr>
                                            </thead>
                                            <tbody style="display:block;height:500px;overflow:auto;">
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">80.8%</td>
                                                    <td class="fw-bold fs-6">D-591-20231001-001</td>
                                                    <td class="fw-bold fs-6">0</td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">80.8%</td>
                                                    <td class="fw-bold fs-6">D-591-20231001-001</td>
                                                    <td class="fw-bold fs-6">0</td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">80.8%</td>
                                                    <td class="fw-bold fs-6">D-591-20231001-001</td>
                                                    <td class="fw-bold fs-6">0</td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">80.8%</td>
                                                    <td class="fw-bold fs-6">D-591-20231001-001</td>
                                                    <td class="fw-bold fs-6">0</td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">80.8%</td>
                                                    <td class="fw-bold fs-6">D-591-20231001-001</td>
                                                    <td class="fw-bold fs-6">0</td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">80.8%</td>
                                                    <td class="fw-bold fs-6">D-591-20231001-001</td>
                                                    <td class="fw-bold fs-6">0</td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">80.8%</td>
                                                    <td class="fw-bold fs-6">D-591-20231001-001</td>
                                                    <td class="fw-bold fs-6">0</td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">80.8%</td>
                                                    <td class="fw-bold fs-6">D-591-20231001-001</td>
                                                    <td class="fw-bold fs-6">0</td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    <!--end::Table-->        
                                    
                                    </div>
                                    <!--begin::Body-->
                                </div>
                                <div class="card mb-20">
                                    <!--begin::Header-->
                                    <div class="card-header px-0">
                                        <h3 class="card-title align-items-start flex-column">
                                            {{__('performance-management.digitm')}}
                                        </h3>
                                        <div class="card-toolbar">
                                            <a href="javascript:;" class="btn btn-sm btn-secondary copy-table" table="signed-quarterly-3">
                                                {{__('performance-management.copy-table')}}</a>
                                        </div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body py-3 pe-0 ps-0">
                                    <!--begin::Table-->
                                        <table 
                                        id="signed-quarterly-3"
                                        class="table table-rounded table-bordered text-center">
                                            <thead>
                                                <tr class="fw-bold fs-6 bg-secondary" style="display:table;width:100%;table-layout:fixed;">
                                                    <td colspan="3">{{__('performance-management.subtotal')}}</td>
                                                    <td>123,456</td>
                                                    <td colspan="2">&nbsp;</td>
                                                    <td>0</td>
                                                    <td>666,888</td>
                                                </tr>
                                                <tr class="fw-bold fs-6 bg-secondary" style="display:table;width:100%;table-layout:fixed;">
                                                    <td>{{__('performance-management.customer-name')}}</td>
                                                    <td>{{__('performance-management.property-location')}}</td>
                                                    <td>{{__('performance-management.date-range')}}</td>
                                                    <td>{{__('performance-management.ad-revenue')}}</td>
                                                    <td>{{__('performance-management.ad-discount')}}</td>
                                                    <td>{{__('performance-management.insertion-number')}}</td>
                                                    <td>{{__('performance-management.ad-operation-cost')}}</td>
                                                    <td>{{__('performance-management.agency-commission-cost')}}</td>
                                                </tr>
                                            </thead>
                                            <tbody style="display:block;height:300px;overflow:auto;">
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">80.8%</td>
                                                    <td class="fw-bold fs-6">D-591-20231001-001</td>
                                                    <td class="fw-bold fs-6">0</td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">80.8%</td>
                                                    <td class="fw-bold fs-6">D-591-20231001-001</td>
                                                    <td class="fw-bold fs-6">0</td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">80.8%</td>
                                                    <td class="fw-bold fs-6">D-591-20231001-001</td>
                                                    <td class="fw-bold fs-6">0</td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">80.8%</td>
                                                    <td class="fw-bold fs-6">D-591-20231001-001</td>
                                                    <td class="fw-bold fs-6">0</td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">80.8%</td>
                                                    <td class="fw-bold fs-6">D-591-20231001-001</td>
                                                    <td class="fw-bold fs-6">0</td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">80.8%</td>
                                                    <td class="fw-bold fs-6">D-591-20231001-001</td>
                                                    <td class="fw-bold fs-6">0</td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">80.8%</td>
                                                    <td class="fw-bold fs-6">D-591-20231001-001</td>
                                                    <td class="fw-bold fs-6">0</td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">80.8%</td>
                                                    <td class="fw-bold fs-6">D-591-20231001-001</td>
                                                    <td class="fw-bold fs-6">0</td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    <!--end::Table-->        
                                    
                                    </div>
                                    <!--begin::Body-->
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="about-to-sign-monthly" role="tabpanel">
                            <div class="d-flex flex-column flex-row-fluid">
                                <!--begin::Row-->
                                <div class="row justify-content-end">
                                    <div class="col-1">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <div class="row">
                                                <div class="col-12 d-flex justify-content-end">
                                                    <button 
                                                    class="btn btn-sm btn-warning"
                                                    >
                                                    {{__('general.last_month')}}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <div class="col-1">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            
                                            <!--begin::Select-->
                                            <select 
                                            id="signed-quarterly-filtered_year"
                                            name="filtered_year"
                                            class="form-select form-select-sm"data-control="select2" data-hide-search="true">
                                                <option value="2023">2023</option>
                                            </select>
                                            <!--end::Select-->
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <div class="col-1">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            
                                            <!--begin::Select-->
                                            <select 
                                            id="signed-quarterly-filtered_month"
                                            name="filtered_month"
                                            class="form-select form-select-sm" data-control="select2" data-hide-search="true">
                                            @for($i=1;$i<=12;$i++)
                                                <option value="{{$i}}">{{$i.__('performance-management.month')}}</option>
                                            @endfor
                                            </select>
                                            <!--end::Select-->
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    
                                    <div class="col-1">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <div class="row">
                                                <div class="col-12 d-flex justify-content-start">
                                                    <button 
                                                    class="btn btn-sm btn-warning"
                                                    >
                                                    {{__('general.next_month')}}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                </div>
                                <!--end::Row-->
                                
                                <div class="card mb-20">
                                    <!--begin::Header-->
                                    <div class="card-header px-0">
                                        <h3 class="card-title align-items-start flex-column">
                                            {{__('performance-management.on-site')}}
                                        </h3>
                                        <div class="card-toolbar">
                                            <a href="javascript:;" class="btn btn-sm btn-secondary copy-table" table="about-to-sign-monthly-1">
                                                {{__('performance-management.copy-table')}}</a>
                                        </div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body py-3 pe-0 ps-0">
                                    <!--begin::Table-->
                                        <table 
                                        id="about-to-sign-monthly-1"
                                        class="table table-rounded table-bordered text-center">
                                            <thead>
                                                <tr class="fw-bold fs-6 bg-secondary" style="display:table;width:100%;table-layout:fixed;">
                                                    <td colspan="3">{{__('performance-management.subtotal')}}</td>
                                                    <td>123,456</td>
                                                    <td>0</td>
                                                    <td>666,888</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr class="fw-bold fs-6 bg-secondary" style="display:table;width:100%;table-layout:fixed;">
                                                    <td>{{__('performance-management.customer-name')}}</td>
                                                    <td>{{__('performance-management.property-location')}}</td>
                                                    <td>{{__('performance-management.date-range')}}</td>
                                                    <td>{{__('performance-management.ad-revenue')}}</td>
                                                    <td>{{__('performance-management.ad-operation-cost')}}</td>
                                                    <td>{{__('performance-management.agency-commission-cost')}}</td>
                                                    <td>{{__('performance-management.insertion-status')}}</td>
                                                </tr>
                                            </thead>
                                            <tbody style="display:block;height:500px;overflow:auto;">
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">0</td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                    <td class="fw-bold fs-6">
                                                        <a class="badge badge-square badge-standby" href="javascript:;">standby</a>
                                                    </td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">0</td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                    <td class="fw-bold fs-6">
                                                        <a class="badge badge-square badge-onreview" href="javascript:;">異動審核中</a>
                                                    </td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">0</td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                    <td class="fw-bold fs-6">
                                                        <a class="badge badge-square badge-draft border-dashed" href="javascript:;">草稿</a>
                                                    </td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">0</td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                    <td class="fw-bold fs-6">
                                                        <a class="badge badge-square badge-standby" href="javascript:;">standby</a>
                                                    </td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">0</td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                    <td class="fw-bold fs-6">
                                                        <a class="badge badge-square badge-onreview" href="javascript:;">異動審核中</a>
                                                    </td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">0</td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                    <td class="fw-bold fs-6">
                                                        <a class="badge badge-square badge-draft border-dashed" href="javascript:;">草稿</a>
                                                    </td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">0</td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                    <td class="fw-bold fs-6">
                                                        <a class="badge badge-square badge-standby" href="javascript:;">standby</a>
                                                    </td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">0</td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                    <td class="fw-bold fs-6">
                                                        <a class="badge badge-square badge-onreview" href="javascript:;">異動審核中</a>
                                                    </td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">0</td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                    <td class="fw-bold fs-6">
                                                        <a class="badge badge-square badge-draft border-dashed" href="javascript:;">草稿</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    <!--end::Table-->        
                                    
                                    </div>
                                </div>
                                <div class="card mb-20">
                                    <!--begin::Header-->
                                    <div class="card-header px-0">
                                        <h3 class="card-title align-items-start flex-column">
                                            {{__('performance-management.remarketing')}}
                                        </h3>
                                        <div class="card-toolbar">
                                            <a href="javascript:;" class="btn btn-sm btn-secondary copy-table" table="about-to-sign-monthly-2">
                                                {{__('performance-management.copy-table')}}</a>
                                        </div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body py-3 pe-0 ps-0">
                                    <!--begin::Table-->
                                        <table 
                                        id="about-to-sign-monthly-2"
                                        class="table table-rounded table-bordered text-center">
                                            <thead>
                                                <tr class="fw-bold fs-6 bg-secondary" style="display:table;width:100%;table-layout:fixed;">
                                                    <td colspan="3">{{__('performance-management.subtotal')}}</td>
                                                    <td>123,456</td>
                                                    <td>0</td>
                                                    <td>666,888</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr class="fw-bold fs-6 bg-secondary" style="display:table;width:100%;table-layout:fixed;">
                                                    <td>{{__('performance-management.customer-name')}}</td>
                                                    <td>{{__('performance-management.property-location')}}</td>
                                                    <td>{{__('performance-management.date-range')}}</td>
                                                    <td>{{__('performance-management.ad-revenue')}}</td>
                                                    <td>{{__('performance-management.ad-operation-cost')}}</td>
                                                    <td>{{__('performance-management.agency-commission-cost')}}</td>
                                                    <td>{{__('performance-management.insertion-status')}}</td>
                                                </tr>
                                            </thead>
                                            <tbody style="display:block;height:500px;overflow:auto;">
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">0</td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                    <td class="fw-bold fs-6">
                                                        <a class="badge badge-square badge-standby" href="javascript:;">standby</a>
                                                    </td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">0</td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                    <td class="fw-bold fs-6">
                                                        <a class="badge badge-square badge-onreview" href="javascript:;">異動審核中</a>
                                                    </td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">0</td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                    <td class="fw-bold fs-6">
                                                        <a class="badge badge-square badge-draft border-dashed" href="javascript:;">草稿</a>
                                                    </td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">0</td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                    <td class="fw-bold fs-6">
                                                        <a class="badge badge-square badge-standby" href="javascript:;">standby</a>
                                                    </td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">0</td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                    <td class="fw-bold fs-6">
                                                        <a class="badge badge-square badge-onreview" href="javascript:;">異動審核中</a>
                                                    </td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">0</td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                    <td class="fw-bold fs-6">
                                                        <a class="badge badge-square badge-draft border-dashed" href="javascript:;">草稿</a>
                                                    </td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">0</td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                    <td class="fw-bold fs-6">
                                                        <a class="badge badge-square badge-standby" href="javascript:;">standby</a>
                                                    </td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">0</td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                    <td class="fw-bold fs-6">
                                                        <a class="badge badge-square badge-onreview" href="javascript:;">異動審核中</a>
                                                    </td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">0</td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                    <td class="fw-bold fs-6">
                                                        <a class="badge badge-square badge-draft border-dashed" href="javascript:;">草稿</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    <!--end::Table-->        
                                    
                                    </div>
                                </div>
                                <div class="card mb-20">
                                    <!--begin::Header-->
                                    <div class="card-header px-0">
                                        <h3 class="card-title align-items-start flex-column">
                                            {{__('performance-management.digitm')}}
                                        </h3>
                                        <div class="card-toolbar">
                                            <a href="javascript:;" class="btn btn-sm btn-secondary copy-table" table="about-to-sign-monthly-3">
                                                {{__('performance-management.copy-table')}}</a>
                                        </div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body py-3 pe-0 ps-0">
                                    <!--begin::Table-->
                                        <table 
                                        id="about-to-sign-monthly-3"
                                        class="table table-rounded table-bordered text-center">
                                            <thead>
                                                <tr class="fw-bold fs-6 bg-secondary" style="display:table;width:100%;table-layout:fixed;">
                                                    <td colspan="3">{{__('performance-management.subtotal')}}</td>
                                                    <td>123,456</td>
                                                    <td>0</td>
                                                    <td>666,888</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr class="fw-bold fs-6 bg-secondary" style="display:table;width:100%;table-layout:fixed;">
                                                    <td>{{__('performance-management.customer-name')}}</td>
                                                    <td>{{__('performance-management.property-location')}}</td>
                                                    <td>{{__('performance-management.date-range')}}</td>
                                                    <td>{{__('performance-management.ad-revenue')}}</td>
                                                    <td>{{__('performance-management.ad-operation-cost')}}</td>
                                                    <td>{{__('performance-management.agency-commission-cost')}}</td>
                                                    <td>{{__('performance-management.insertion-status')}}</td>
                                                </tr>
                                            </thead>
                                            <tbody style="display:block;height:500px;overflow:auto;">
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">0</td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                    <td class="fw-bold fs-6">
                                                        <a class="badge badge-square badge-standby" href="javascript:;">standby</a>
                                                    </td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">0</td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                    <td class="fw-bold fs-6">
                                                        <a class="badge badge-square badge-onreview" href="javascript:;">異動審核中</a>
                                                    </td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">0</td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                    <td class="fw-bold fs-6">
                                                        <a class="badge badge-square badge-draft border-dashed" href="javascript:;">草稿</a>
                                                    </td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">0</td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                    <td class="fw-bold fs-6">
                                                        <a class="badge badge-square badge-standby" href="javascript:;">standby</a>
                                                    </td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">0</td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                    <td class="fw-bold fs-6">
                                                        <a class="badge badge-square badge-onreview" href="javascript:;">異動審核中</a>
                                                    </td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">0</td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                    <td class="fw-bold fs-6">
                                                        <a class="badge badge-square badge-draft border-dashed" href="javascript:;">草稿</a>
                                                    </td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">0</td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                    <td class="fw-bold fs-6">
                                                        <a class="badge badge-square badge-standby" href="javascript:;">standby</a>
                                                    </td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">0</td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                    <td class="fw-bold fs-6">
                                                        <a class="badge badge-square badge-onreview" href="javascript:;">異動審核中</a>
                                                    </td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">0</td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                    <td class="fw-bold fs-6">
                                                        <a class="badge badge-square badge-draft border-dashed" href="javascript:;">草稿</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    <!--end::Table-->        
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="about-to-sign-quarterly" role="tabpanel">
                            <div class="d-flex flex-column flex-row-fluid">
                                <!--begin::Row-->
                                <div class="row justify-content-end">
                                    <div class="col-1">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <div class="row">
                                                <div class="col-12 d-flex justify-content-end">
                                                    <button 
                                                    class="btn btn-sm btn-warning"
                                                    >
                                                    {{__('general.last_quarter')}}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <div class="col-1">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            
                                            <!--begin::Select-->
                                            <select 
                                            id="signed-quarterly-filtered_year"
                                            name="filtered_year"
                                            class="form-select form-select-sm"data-control="select2" data-hide-search="true">
                                                <option value="2023">2023</option>
                                            </select>
                                            <!--end::Select-->
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <div class="col-1">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            
                                            <!--begin::Select-->
                                            <select 
                                            id="signed-quarterly-filtered_month"
                                            name="filtered_month"
                                            class="form-select form-select-sm" data-control="select2" data-hide-search="true">
                                            @for($i=1;$i<=4;$i++)
                                                <option value="{{$i}}">Q{{$i}}</option>
                                            @endfor
                                            </select>
                                            <!--end::Select-->
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    
                                    <div class="col-1">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <div class="row">
                                                <div class="col-12 d-flex justify-content-start">
                                                    <button 
                                                    class="btn btn-sm btn-warning"
                                                    >
                                                    {{__('general.next_quarter')}}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                </div>
                                <!--end::Row-->
                                
                                <div class="card mb-20">
                                    <!--begin::Header-->
                                    <div class="card-header px-0">
                                        <h3 class="card-title align-items-start flex-column">
                                            {{__('performance-management.on-site')}}
                                        </h3>
                                        <div class="card-toolbar">
                                            <a href="javascript:;" class="btn btn-sm btn-secondary copy-table" table="about-to-sign-quarterly-1">
                                                {{__('performance-management.copy-table')}}</a>
                                        </div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body py-3 pe-0 ps-0">
                                    <!--begin::Table-->
                                        <table 
                                        id="about-to-sign-quarterly-1"
                                        class="table table-rounded table-bordered text-center">
                                            <thead>
                                                <tr class="fw-bold fs-6 bg-secondary" style="display:table;width:100%;table-layout:fixed;">
                                                    <td colspan="3">{{__('performance-management.subtotal')}}</td>
                                                    <td>123,456</td>
                                                    <td>0</td>
                                                    <td>666,888</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr class="fw-bold fs-6 bg-secondary" style="display:table;width:100%;table-layout:fixed;">
                                                    <td>{{__('performance-management.customer-name')}}</td>
                                                    <td>{{__('performance-management.property-location')}}</td>
                                                    <td>{{__('performance-management.date-range')}}</td>
                                                    <td>{{__('performance-management.ad-revenue')}}</td>
                                                    <td>{{__('performance-management.ad-operation-cost')}}</td>
                                                    <td>{{__('performance-management.agency-commission-cost')}}</td>
                                                    <td>{{__('performance-management.insertion-status')}}</td>
                                                </tr>
                                            </thead>
                                            <tbody style="display:block;height:500px;overflow:auto;">
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">0</td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                    <td class="fw-bold fs-6">
                                                        <a class="badge badge-square badge-standby" href="javascript:;">standby</a>
                                                    </td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">0</td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                    <td class="fw-bold fs-6">
                                                        <a class="badge badge-square badge-onreview" href="javascript:;">異動審核中</a>
                                                    </td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">0</td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                    <td class="fw-bold fs-6">
                                                        <a class="badge badge-square badge-draft border-dashed" href="javascript:;">草稿</a>
                                                    </td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">0</td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                    <td class="fw-bold fs-6">
                                                        <a class="badge badge-square badge-standby" href="javascript:;">standby</a>
                                                    </td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">0</td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                    <td class="fw-bold fs-6">
                                                        <a class="badge badge-square badge-onreview" href="javascript:;">異動審核中</a>
                                                    </td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">0</td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                    <td class="fw-bold fs-6">
                                                        <a class="badge badge-square badge-draft border-dashed" href="javascript:;">草稿</a>
                                                    </td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">0</td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                    <td class="fw-bold fs-6">
                                                        <a class="badge badge-square badge-standby" href="javascript:;">standby</a>
                                                    </td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">0</td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                    <td class="fw-bold fs-6">
                                                        <a class="badge badge-square badge-onreview" href="javascript:;">異動審核中</a>
                                                    </td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">名緯廣告</td>
                                                    <td class="fw-bold fs-6">基隆市-中正區</td>
                                                    <td class="fw-bold fs-6">2023/10/01 - 2023/10/11</td>
                                                    <td class="fw-bold fs-6">66,808</td>
                                                    <td class="fw-bold fs-6">0</td>
                                                    <td class="fw-bold fs-6">1,234</td>
                                                    <td class="fw-bold fs-6">
                                                        <a class="badge badge-square badge-draft border-dashed" href="javascript:;">草稿</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    <!--end::Table-->        
                                    
                                    </div>
                                </div>
                                
                                
                            </div>
                        </div>

                        <!--tab content end-->
                        <div class="tab-pane fade show" id="combinations" role="tabpanel">
                            <div class="d-flex flex-column flex-row-fluid">
                                <!--begin::Row-->
                                <div class="row">
                                    <div class="col-1">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="fs-6 form-label mt-3">
                                                <span >{{__('performance-management.filtered_year')}}</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Select-->
                                            <select 
                                            id="combinations-filtered_year"
                                            name="filtered_year"
                                            class="form-select form-select-sm"data-control="select2" data-hide-search="true">
                                                <option value="2023">2023</option>
                                            </select>
                                            <!--end::Select-->
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <div class="col-1">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="fs-6 form-label mt-3">
                                                <span >{{__('performance-management.display_types')}}</span>
                                            </label>
                                            <!--end::Label-->
                                            @php
                                                $display_types = config('global.general.report_display_types');
                                            @endphp
                                            
                                            <!--begin::Select-->
                                            <select 
                                            id="combinations-filtered_display_type"
                                            name="filtered_display_type"
                                            class="display_types form-select form-select-sm" data-control="select2" data-hide-search="true">
                                            @foreach($display_types as $key=>$type)
                                                <option value="{{$type}}">{{__('performance-management.display_types_'.$type)}}</option>
                                            @endforeach
                                            </select>
                                            <!--end::Select-->
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <div class="col-10">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="fs-6 form-label mt-3">
                                                <span >{{__('performance-management.selected')}}</span>
                                            </label>
                                            <!--end::Label-->
                                            <div class="row">
                                                <div id="combinations-filtered_months" class="col-8" >
                                                    <select 
                                                    name="combinations-filtered_months"
                                                    data-placeholder="{{__('general.months')}}"
                                                    class="form-select form-select-sm" data-control="select2" data-close-on-select="false" data-allow-clear="true" multiple="multiple">
                                                        @for($i=1; $i<=12; $i++)
                                                        <option value="{{$i}}">{{$i.__('performance-management.month')}}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div id="combinations-filtered_quarters" class="col-8" style="display:none;" >
                                                    <select 
                                                    name="combinations-filtered_quarters"
                                                    data-placeholder="{{__('general.quarters')}}"
                                                    class="form-select form-select-sm" data-control="select2" data-close-on-select="false" data-allow-clear="true" multiple="multiple">
                                                        @for($i=1; $i<=4; $i++)
                                                        <option value="{{$i}}">{{'Q'.$i}}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    
                                </div>
                                <!--end::Row-->
                                <div class="row">
                                    <div class="col-4">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="fs-6 form-label mt-3">
                                                <span >{{__('performance-management.report_types')}}</span>
                                            </label>
                                            <!--end::Label-->
                                            <div class="row">
                                                <div id="" class="col-12" >
                                                    <select 
                                                    name="combinations-filtered_report_types"
                                                    data-placeholder="{{__('general.types')}}"
                                                    class="form-select form-select-sm" data-control="select2" data-close-on-select="false" data-allow-clear="true" multiple="multiple">
                                                        <option value="all">{{__('performance-management.all-kinds-report')}}</option>
                                                        <option value="on-site">{{__('performance-management.on-site')}}</option>
                                                        <option value="remarketing">{{__('performance-management.remarketing')}}</option>
                                                        <option value="digitm">{{__('performance-management.digitm')}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <div class="col-6">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="fs-6 form-label mt-3">
                                                <span >{{__('performance-management.channels')}}</span>
                                            </label>
                                            <!--end::Label-->
                                            <div class="row">
                                                <div id="" class="col-8" >
                                                    <select 
                                                    name="combinations-filtered_channels"
                                                    data-placeholder="{{__('general.channels')}}"
                                                    class="form-select form-select-sm" data-control="select2" data-close-on-select="false" data-allow-clear="true" multiple="multiple">
                                                    @foreach($available_channels as $key=>$channel)
                                                        <option value="{{$channel->id}}">{{$channel->name}}</option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-2 d-flex justify-content-start">
                                                    <button 
                                                    class="btn btn-sm btn-warning me-5"
                                                    >
                                                    {{__('general.search')}}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                </div>
                                <div class="card mb-20">
                                    <!--begin::Header-->
                                    <div class="card-header px-0">
                                        <h3 class="card-title align-items-start flex-column">
                                            {{__('performance-management.summary')}}
                                        </h3>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body py-3 pe-0 ps-0">
                                    <!--begin::Table-->
                                        <table 
                                        class="table table-rounded table-bordered text-center">
                                            <thead>
                                                <tr class="fw-bold fs-6 bg-secondary">
                                                    <td>{{__('performance-management.customer-types')}}</td>
                                                    <td>{{__('performance-management.total-revenue')}}</td>
                                                    <td>{{__('performance-management.propotion')}}</td>
                                                    <td>{{__('performance-management.signed-customer-counts')}}</td>
                                                    <td>{{__('performance-management.discount')}}</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="align-middle">
                                                    <td class="fw-bold fs-6">直客</td>
                                                    <td class="fw-bold fs-6">1,888,888</td>
                                                    <td class="fw-bold fs-6">55%</td>
                                                    <td class="fw-bold fs-6">101</td>
                                                    <td class="fw-bold fs-6">85%</td>
                                                </tr>
                                                <tr class="align-middle">
                                                    <td class="fw-bold fs-6">代理商</td>
                                                    <td class="fw-bold fs-6">1,888,888</td>
                                                    <td class="fw-bold fs-6">45%</td>
                                                    <td class="fw-bold fs-6">88</td>
                                                    <td class="fw-bold fs-6">90%</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    <!--end::Table-->        
                                    
                                    </div>
                                    <!--begin::Body-->
                                </div>

                                <div class="card mb-20">
                                    <!--begin::Header-->
                                    <div class="card-header px-0">
                                        <h3 class="card-title align-items-start flex-column">
                                            {{__('performance-management.all-kinds-report')}}
                                        </h3>
                                        <div class="card-toolbar">
                                            <a href="javascript:;" class="btn btn-sm btn-secondary copy-table" table="all-kinds-report-1">
                                                {{__('performance-management.copy-table')}}</a>
                                        </div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body py-3 pe-0 ps-0" style="overflow-x:scroll;" >
                                        <div class="d-flex flex-row" id="all-kinds-report-1">
                                            <div class="card me-3" style="min-width: 90%;">
                                                
                                                <div class="card-body py-3 pe-0 ps-0">
                                                    <!--begin::Table-->
                                                    <table 
                                                    
                                                    class="table table-rounded table-bordered text-center">
                                                        <thead>
                                                            <tr class="fw-bold fs-6 bg-secondary" style="display:table;width:100%;table-layout:fixed;">
                                                                <td colspan="9">Q1</td>
                                                            </tr>
                                                            <tr class="fw-bold fs-6 bg-secondary" style="display:table;width:100%;table-layout:fixed;">
                                                                <td>{{__('performance-management.channels')}}</td>
                                                                <td>{{__('performance-management.districts')}}</td>
                                                                <td>{{__('performance-management.revenue')}}</td>
                                                                <td>{{__('performance-management.signed-customer-counts')}}</td>
                                                                <td>{{__('performance-management.signed-insertion-counts')}}</td>
                                                                <td>{{__('performance-management.new-customer-counts')}}</td>
                                                                <td>{{__('performance-management.old-customer-counts')}}</td>
                                                                <td>{{__('performance-management.discount')}}</td>
                                                                <td>{{__('performance-management.customer-price')}}</td>
                                                            </tr>
                                                        </thead>
                                                        <tbody style="display:block;height:300px;overflow:auto;">
                                                            <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                                <td class="fw-bold fs-6">591</td>
                                                                <td class="fw-bold fs-6">基隆市-中正區</td>
                                                                <td class="fw-bold fs-6">111,111,111</td>
                                                                <td class="fw-bold fs-6">8</td>
                                                                <td class="fw-bold fs-6">10</td>
                                                                <td class="fw-bold fs-6">5</td>
                                                                <td class="fw-bold fs-6">3</td>
                                                                <td class="fw-bold fs-6">90%</td>
                                                                <td class="fw-bold fs-6">168,168</td>
                                                            </tr>
                                                            <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                                <td class="fw-bold fs-6">591</td>
                                                                <td class="fw-bold fs-6">基隆市-中正區</td>
                                                                <td class="fw-bold fs-6">111,111,111</td>
                                                                <td class="fw-bold fs-6">8</td>
                                                                <td class="fw-bold fs-6">10</td>
                                                                <td class="fw-bold fs-6">5</td>
                                                                <td class="fw-bold fs-6">3</td>
                                                                <td class="fw-bold fs-6">90%</td>
                                                                <td class="fw-bold fs-6">168,168</td>
                                                            </tr>
                                                            <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                                <td class="fw-bold fs-6">591</td>
                                                                <td class="fw-bold fs-6">基隆市-中正區</td>
                                                                <td class="fw-bold fs-6">111,111,111</td>
                                                                <td class="fw-bold fs-6">8</td>
                                                                <td class="fw-bold fs-6">10</td>
                                                                <td class="fw-bold fs-6">5</td>
                                                                <td class="fw-bold fs-6">3</td>
                                                                <td class="fw-bold fs-6">90%</td>
                                                                <td class="fw-bold fs-6">168,168</td>
                                                            </tr>
                                                            <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                                <td class="fw-bold fs-6">591</td>
                                                                <td class="fw-bold fs-6">基隆市-中正區</td>
                                                                <td class="fw-bold fs-6">111,111,111</td>
                                                                <td class="fw-bold fs-6">8</td>
                                                                <td class="fw-bold fs-6">10</td>
                                                                <td class="fw-bold fs-6">5</td>
                                                                <td class="fw-bold fs-6">3</td>
                                                                <td class="fw-bold fs-6">90%</td>
                                                                <td class="fw-bold fs-6">168,168</td>
                                                            </tr>
                                                            <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                                <td class="fw-bold fs-6">591</td>
                                                                <td class="fw-bold fs-6">基隆市-中正區</td>
                                                                <td class="fw-bold fs-6">111,111,111</td>
                                                                <td class="fw-bold fs-6">8</td>
                                                                <td class="fw-bold fs-6">10</td>
                                                                <td class="fw-bold fs-6">5</td>
                                                                <td class="fw-bold fs-6">3</td>
                                                                <td class="fw-bold fs-6">90%</td>
                                                                <td class="fw-bold fs-6">168,168</td>
                                                            </tr>
                                                            <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                                <td class="fw-bold fs-6">591</td>
                                                                <td class="fw-bold fs-6">基隆市-中正區</td>
                                                                <td class="fw-bold fs-6">111,111,111</td>
                                                                <td class="fw-bold fs-6">8</td>
                                                                <td class="fw-bold fs-6">10</td>
                                                                <td class="fw-bold fs-6">5</td>
                                                                <td class="fw-bold fs-6">3</td>
                                                                <td class="fw-bold fs-6">90%</td>
                                                                <td class="fw-bold fs-6">168,168</td>
                                                            </tr>
                                                            <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                                <td class="fw-bold fs-6">591</td>
                                                                <td class="fw-bold fs-6">基隆市-中正區</td>
                                                                <td class="fw-bold fs-6">111,111,111</td>
                                                                <td class="fw-bold fs-6">8</td>
                                                                <td class="fw-bold fs-6">10</td>
                                                                <td class="fw-bold fs-6">5</td>
                                                                <td class="fw-bold fs-6">3</td>
                                                                <td class="fw-bold fs-6">90%</td>
                                                                <td class="fw-bold fs-6">168,168</td>
                                                            </tr>
                                                            <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                                <td class="fw-bold fs-6">591</td>
                                                                <td class="fw-bold fs-6">基隆市-中正區</td>
                                                                <td class="fw-bold fs-6">111,111,111</td>
                                                                <td class="fw-bold fs-6">8</td>
                                                                <td class="fw-bold fs-6">10</td>
                                                                <td class="fw-bold fs-6">5</td>
                                                                <td class="fw-bold fs-6">3</td>
                                                                <td class="fw-bold fs-6">90%</td>
                                                                <td class="fw-bold fs-6">168,168</td>
                                                            </tr>
                                                            <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                                <td class="fw-bold fs-6">591</td>
                                                                <td class="fw-bold fs-6">基隆市-中正區</td>
                                                                <td class="fw-bold fs-6">111,111,111</td>
                                                                <td class="fw-bold fs-6">8</td>
                                                                <td class="fw-bold fs-6">10</td>
                                                                <td class="fw-bold fs-6">5</td>
                                                                <td class="fw-bold fs-6">3</td>
                                                                <td class="fw-bold fs-6">90%</td>
                                                                <td class="fw-bold fs-6">168,168</td>
                                                            </tr>
                                                        </tbody>
                                                        <tfoot>
                                                            <tr class="fw-bold fs-6 bg-secondary" style="display:table;width:100%;table-layout:fixed;">
                                                                <td colspan="2">{{__('performance-management.subtotal')}}</td>
                                                                <td>888,888</td>
                                                                <td>40</td>
                                                                <td>50</td>
                                                                <td>25</td>
                                                                <td>15</td>
                                                                <td>73%</td>
                                                                <td>888,888</td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                <!--end::Table-->    
                                                </div>
                                            </div>
                                            <div class="card me-3" style="min-width: 90%;">
                                                
                                                <div class="card-body py-3 pe-0 ps-0">
                                                    <!--begin::Table-->
                                                    <table 
                                                    class="table table-rounded table-bordered text-center">
                                                        <thead>
                                                            <tr class="fw-bold fs-6 bg-secondary" style="display:table;width:100%;table-layout:fixed;">
                                                                <td colspan="9">Q2</td>
                                                            </tr>
                                                            <tr class="fw-bold fs-6 bg-secondary" style="display:table;width:100%;table-layout:fixed;">
                                                                <td>{{__('performance-management.channels')}}</td>
                                                                <td>{{__('performance-management.districts')}}</td>
                                                                <td>{{__('performance-management.revenue')}}</td>
                                                                <td>{{__('performance-management.signed-customer-counts')}}</td>
                                                                <td>{{__('performance-management.signed-insertion-counts')}}</td>
                                                                <td>{{__('performance-management.new-customer-counts')}}</td>
                                                                <td>{{__('performance-management.old-customer-counts')}}</td>
                                                                <td>{{__('performance-management.discount')}}</td>
                                                                <td>{{__('performance-management.customer-price')}}</td>
                                                            </tr>
                                                        </thead>
                                                        <tbody style="display:block;height:300px;overflow:auto;">
                                                            <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                                <td class="fw-bold fs-6">591</td>
                                                                <td class="fw-bold fs-6">基隆市-中正區</td>
                                                                <td class="fw-bold fs-6">111,111,111</td>
                                                                <td class="fw-bold fs-6">8</td>
                                                                <td class="fw-bold fs-6">10</td>
                                                                <td class="fw-bold fs-6">5</td>
                                                                <td class="fw-bold fs-6">3</td>
                                                                <td class="fw-bold fs-6">90%</td>
                                                                <td class="fw-bold fs-6">168,168</td>
                                                            </tr>
                                                            <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                                <td class="fw-bold fs-6">591</td>
                                                                <td class="fw-bold fs-6">基隆市-中正區</td>
                                                                <td class="fw-bold fs-6">111,111,111</td>
                                                                <td class="fw-bold fs-6">8</td>
                                                                <td class="fw-bold fs-6">10</td>
                                                                <td class="fw-bold fs-6">5</td>
                                                                <td class="fw-bold fs-6">3</td>
                                                                <td class="fw-bold fs-6">90%</td>
                                                                <td class="fw-bold fs-6">168,168</td>
                                                            </tr>
                                                            <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                                <td class="fw-bold fs-6">591</td>
                                                                <td class="fw-bold fs-6">基隆市-中正區</td>
                                                                <td class="fw-bold fs-6">111,111,111</td>
                                                                <td class="fw-bold fs-6">8</td>
                                                                <td class="fw-bold fs-6">10</td>
                                                                <td class="fw-bold fs-6">5</td>
                                                                <td class="fw-bold fs-6">3</td>
                                                                <td class="fw-bold fs-6">90%</td>
                                                                <td class="fw-bold fs-6">168,168</td>
                                                            </tr>
                                                            <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                                <td class="fw-bold fs-6">591</td>
                                                                <td class="fw-bold fs-6">基隆市-中正區</td>
                                                                <td class="fw-bold fs-6">111,111,111</td>
                                                                <td class="fw-bold fs-6">8</td>
                                                                <td class="fw-bold fs-6">10</td>
                                                                <td class="fw-bold fs-6">5</td>
                                                                <td class="fw-bold fs-6">3</td>
                                                                <td class="fw-bold fs-6">90%</td>
                                                                <td class="fw-bold fs-6">168,168</td>
                                                            </tr>
                                                            <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                                <td class="fw-bold fs-6">591</td>
                                                                <td class="fw-bold fs-6">基隆市-中正區</td>
                                                                <td class="fw-bold fs-6">111,111,111</td>
                                                                <td class="fw-bold fs-6">8</td>
                                                                <td class="fw-bold fs-6">10</td>
                                                                <td class="fw-bold fs-6">5</td>
                                                                <td class="fw-bold fs-6">3</td>
                                                                <td class="fw-bold fs-6">90%</td>
                                                                <td class="fw-bold fs-6">168,168</td>
                                                            </tr>
                                                            <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                                <td class="fw-bold fs-6">591</td>
                                                                <td class="fw-bold fs-6">基隆市-中正區</td>
                                                                <td class="fw-bold fs-6">111,111,111</td>
                                                                <td class="fw-bold fs-6">8</td>
                                                                <td class="fw-bold fs-6">10</td>
                                                                <td class="fw-bold fs-6">5</td>
                                                                <td class="fw-bold fs-6">3</td>
                                                                <td class="fw-bold fs-6">90%</td>
                                                                <td class="fw-bold fs-6">168,168</td>
                                                            </tr>
                                                            <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                                <td class="fw-bold fs-6">591</td>
                                                                <td class="fw-bold fs-6">基隆市-中正區</td>
                                                                <td class="fw-bold fs-6">111,111,111</td>
                                                                <td class="fw-bold fs-6">8</td>
                                                                <td class="fw-bold fs-6">10</td>
                                                                <td class="fw-bold fs-6">5</td>
                                                                <td class="fw-bold fs-6">3</td>
                                                                <td class="fw-bold fs-6">90%</td>
                                                                <td class="fw-bold fs-6">168,168</td>
                                                            </tr>
                                                            <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                                <td class="fw-bold fs-6">591</td>
                                                                <td class="fw-bold fs-6">基隆市-中正區</td>
                                                                <td class="fw-bold fs-6">111,111,111</td>
                                                                <td class="fw-bold fs-6">8</td>
                                                                <td class="fw-bold fs-6">10</td>
                                                                <td class="fw-bold fs-6">5</td>
                                                                <td class="fw-bold fs-6">3</td>
                                                                <td class="fw-bold fs-6">90%</td>
                                                                <td class="fw-bold fs-6">168,168</td>
                                                            </tr>
                                                            <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                                <td class="fw-bold fs-6">591</td>
                                                                <td class="fw-bold fs-6">基隆市-中正區</td>
                                                                <td class="fw-bold fs-6">111,111,111</td>
                                                                <td class="fw-bold fs-6">8</td>
                                                                <td class="fw-bold fs-6">10</td>
                                                                <td class="fw-bold fs-6">5</td>
                                                                <td class="fw-bold fs-6">3</td>
                                                                <td class="fw-bold fs-6">90%</td>
                                                                <td class="fw-bold fs-6">168,168</td>
                                                            </tr>
                                                        </tbody>
                                                        <tfoot>
                                                            <tr class="fw-bold fs-6 bg-secondary" style="display:table;width:100%;table-layout:fixed;">
                                                                <td colspan="2">{{__('performance-management.subtotal')}}</td>
                                                                <td>888,888</td>
                                                                <td>40</td>
                                                                <td>50</td>
                                                                <td>25</td>
                                                                <td>15</td>
                                                                <td>73%</td>
                                                                <td>888,888</td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                <!--end::Table-->    
                                                </div>
                                            </div>
                                            <div class="card me-3" style="min-width: 90%;">
                                                
                                                <div class="card-body py-3 pe-0 ps-0">
                                                    <!--begin::Table-->
                                                    <table 
                                                    class="table table-rounded table-bordered text-center">
                                                        <thead>
                                                            <tr class="fw-bold fs-6 bg-secondary" style="display:table;width:100%;table-layout:fixed;">
                                                                <td colspan="9">Q3</td>
                                                            </tr>
                                                            <tr class="fw-bold fs-6 bg-secondary" style="display:table;width:100%;table-layout:fixed;">
                                                                <td>{{__('performance-management.channels')}}</td>
                                                                <td>{{__('performance-management.districts')}}</td>
                                                                <td>{{__('performance-management.revenue')}}</td>
                                                                <td>{{__('performance-management.signed-customer-counts')}}</td>
                                                                <td>{{__('performance-management.signed-insertion-counts')}}</td>
                                                                <td>{{__('performance-management.new-customer-counts')}}</td>
                                                                <td>{{__('performance-management.old-customer-counts')}}</td>
                                                                <td>{{__('performance-management.discount')}}</td>
                                                                <td>{{__('performance-management.customer-price')}}</td>
                                                            </tr>
                                                        </thead>
                                                        <tbody style="display:block;height:300px;overflow:auto;">
                                                            <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                                <td class="fw-bold fs-6">591</td>
                                                                <td class="fw-bold fs-6">基隆市-中正區</td>
                                                                <td class="fw-bold fs-6">111,111,111</td>
                                                                <td class="fw-bold fs-6">8</td>
                                                                <td class="fw-bold fs-6">10</td>
                                                                <td class="fw-bold fs-6">5</td>
                                                                <td class="fw-bold fs-6">3</td>
                                                                <td class="fw-bold fs-6">90%</td>
                                                                <td class="fw-bold fs-6">168,168</td>
                                                            </tr>
                                                            <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                                <td class="fw-bold fs-6">591</td>
                                                                <td class="fw-bold fs-6">基隆市-中正區</td>
                                                                <td class="fw-bold fs-6">111,111,111</td>
                                                                <td class="fw-bold fs-6">8</td>
                                                                <td class="fw-bold fs-6">10</td>
                                                                <td class="fw-bold fs-6">5</td>
                                                                <td class="fw-bold fs-6">3</td>
                                                                <td class="fw-bold fs-6">90%</td>
                                                                <td class="fw-bold fs-6">168,168</td>
                                                            </tr>
                                                            <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                                <td class="fw-bold fs-6">591</td>
                                                                <td class="fw-bold fs-6">基隆市-中正區</td>
                                                                <td class="fw-bold fs-6">111,111,111</td>
                                                                <td class="fw-bold fs-6">8</td>
                                                                <td class="fw-bold fs-6">10</td>
                                                                <td class="fw-bold fs-6">5</td>
                                                                <td class="fw-bold fs-6">3</td>
                                                                <td class="fw-bold fs-6">90%</td>
                                                                <td class="fw-bold fs-6">168,168</td>
                                                            </tr>
                                                            <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                                <td class="fw-bold fs-6">591</td>
                                                                <td class="fw-bold fs-6">基隆市-中正區</td>
                                                                <td class="fw-bold fs-6">111,111,111</td>
                                                                <td class="fw-bold fs-6">8</td>
                                                                <td class="fw-bold fs-6">10</td>
                                                                <td class="fw-bold fs-6">5</td>
                                                                <td class="fw-bold fs-6">3</td>
                                                                <td class="fw-bold fs-6">90%</td>
                                                                <td class="fw-bold fs-6">168,168</td>
                                                            </tr>
                                                            <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                                <td class="fw-bold fs-6">591</td>
                                                                <td class="fw-bold fs-6">基隆市-中正區</td>
                                                                <td class="fw-bold fs-6">111,111,111</td>
                                                                <td class="fw-bold fs-6">8</td>
                                                                <td class="fw-bold fs-6">10</td>
                                                                <td class="fw-bold fs-6">5</td>
                                                                <td class="fw-bold fs-6">3</td>
                                                                <td class="fw-bold fs-6">90%</td>
                                                                <td class="fw-bold fs-6">168,168</td>
                                                            </tr>
                                                            <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                                <td class="fw-bold fs-6">591</td>
                                                                <td class="fw-bold fs-6">基隆市-中正區</td>
                                                                <td class="fw-bold fs-6">111,111,111</td>
                                                                <td class="fw-bold fs-6">8</td>
                                                                <td class="fw-bold fs-6">10</td>
                                                                <td class="fw-bold fs-6">5</td>
                                                                <td class="fw-bold fs-6">3</td>
                                                                <td class="fw-bold fs-6">90%</td>
                                                                <td class="fw-bold fs-6">168,168</td>
                                                            </tr>
                                                            <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                                <td class="fw-bold fs-6">591</td>
                                                                <td class="fw-bold fs-6">基隆市-中正區</td>
                                                                <td class="fw-bold fs-6">111,111,111</td>
                                                                <td class="fw-bold fs-6">8</td>
                                                                <td class="fw-bold fs-6">10</td>
                                                                <td class="fw-bold fs-6">5</td>
                                                                <td class="fw-bold fs-6">3</td>
                                                                <td class="fw-bold fs-6">90%</td>
                                                                <td class="fw-bold fs-6">168,168</td>
                                                            </tr>
                                                            <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                                <td class="fw-bold fs-6">591</td>
                                                                <td class="fw-bold fs-6">基隆市-中正區</td>
                                                                <td class="fw-bold fs-6">111,111,111</td>
                                                                <td class="fw-bold fs-6">8</td>
                                                                <td class="fw-bold fs-6">10</td>
                                                                <td class="fw-bold fs-6">5</td>
                                                                <td class="fw-bold fs-6">3</td>
                                                                <td class="fw-bold fs-6">90%</td>
                                                                <td class="fw-bold fs-6">168,168</td>
                                                            </tr>
                                                            <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                                <td class="fw-bold fs-6">591</td>
                                                                <td class="fw-bold fs-6">基隆市-中正區</td>
                                                                <td class="fw-bold fs-6">111,111,111</td>
                                                                <td class="fw-bold fs-6">8</td>
                                                                <td class="fw-bold fs-6">10</td>
                                                                <td class="fw-bold fs-6">5</td>
                                                                <td class="fw-bold fs-6">3</td>
                                                                <td class="fw-bold fs-6">90%</td>
                                                                <td class="fw-bold fs-6">168,168</td>
                                                            </tr>
                                                        </tbody>
                                                        <tfoot>
                                                            <tr class="fw-bold fs-6 bg-secondary" style="display:table;width:100%;table-layout:fixed;">
                                                                <td colspan="2">{{__('performance-management.subtotal')}}</td>
                                                                <td>888,888</td>
                                                                <td>40</td>
                                                                <td>50</td>
                                                                <td>25</td>
                                                                <td>15</td>
                                                                <td>73%</td>
                                                                <td>888,888</td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                <!--end::Table-->    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--begin::Body-->
                                </div>

                                <div class="card mb-20">
                                    
                                    <!--begin::Body-->
                                    <div class="card-body py-3 pe-0 ps-0" >
                                        <!--begin::Table-->
                                        <table 
                                        class="table table-rounded table-bordered text-center">
                                            <thead>
                                                <tr class="fw-bold fs-6 bg-secondary" style="display:table;width:100%;table-layout:fixed;">
                                                    
                                                    <td>{{__('performance-management.districts')}}</td>
                                                    <td>{{__('performance-management.revenue')}}</td>
                                                    <td>{{__('performance-management.signed-customer-counts')}}</td>
                                                    <td>{{__('performance-management.signed-insertion-counts')}}</td>
                                                    <td>{{__('performance-management.new-customer-counts')}}</td>
                                                    <td>{{__('performance-management.old-customer-counts')}}</td>
                                                    <td>{{__('performance-management.discount')}}</td>
                                                    <td>{{__('performance-management.customer-price')}}</td>
                                                </tr>
                                            </thead>
                                            <tbody style="display:block;height:300px;overflow:auto;">
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">
                                                        <a 
                                                        href="javascript:;"
                                                        class="city_to_list_districts_performance" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#modal_list_districts_performance"
                                                        >基隆市</a>
                                                    </td>
                                                    <td class="fw-bold fs-6">111,111,111</td>
                                                    <td class="fw-bold fs-6">8</td>
                                                    <td class="fw-bold fs-6">10</td>
                                                    <td class="fw-bold fs-6">5</td>
                                                    <td class="fw-bold fs-6">3</td>
                                                    <td class="fw-bold fs-6">90%</td>
                                                    <td class="fw-bold fs-6">168,168</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">台北市</td>
                                                    <td class="fw-bold fs-6">111,111,111</td>
                                                    <td class="fw-bold fs-6">8</td>
                                                    <td class="fw-bold fs-6">10</td>
                                                    <td class="fw-bold fs-6">5</td>
                                                    <td class="fw-bold fs-6">3</td>
                                                    <td class="fw-bold fs-6">90%</td>
                                                    <td class="fw-bold fs-6">168,168</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">基隆市</td>
                                                    <td class="fw-bold fs-6">111,111,111</td>
                                                    <td class="fw-bold fs-6">8</td>
                                                    <td class="fw-bold fs-6">10</td>
                                                    <td class="fw-bold fs-6">5</td>
                                                    <td class="fw-bold fs-6">3</td>
                                                    <td class="fw-bold fs-6">90%</td>
                                                    <td class="fw-bold fs-6">168,168</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">台北市</td>
                                                    <td class="fw-bold fs-6">111,111,111</td>
                                                    <td class="fw-bold fs-6">8</td>
                                                    <td class="fw-bold fs-6">10</td>
                                                    <td class="fw-bold fs-6">5</td>
                                                    <td class="fw-bold fs-6">3</td>
                                                    <td class="fw-bold fs-6">90%</td>
                                                    <td class="fw-bold fs-6">168,168</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">基隆市</td>
                                                    <td class="fw-bold fs-6">111,111,111</td>
                                                    <td class="fw-bold fs-6">8</td>
                                                    <td class="fw-bold fs-6">10</td>
                                                    <td class="fw-bold fs-6">5</td>
                                                    <td class="fw-bold fs-6">3</td>
                                                    <td class="fw-bold fs-6">90%</td>
                                                    <td class="fw-bold fs-6">168,168</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">台北市</td>
                                                    <td class="fw-bold fs-6">111,111,111</td>
                                                    <td class="fw-bold fs-6">8</td>
                                                    <td class="fw-bold fs-6">10</td>
                                                    <td class="fw-bold fs-6">5</td>
                                                    <td class="fw-bold fs-6">3</td>
                                                    <td class="fw-bold fs-6">90%</td>
                                                    <td class="fw-bold fs-6">168,168</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">基隆市</td>
                                                    <td class="fw-bold fs-6">111,111,111</td>
                                                    <td class="fw-bold fs-6">8</td>
                                                    <td class="fw-bold fs-6">10</td>
                                                    <td class="fw-bold fs-6">5</td>
                                                    <td class="fw-bold fs-6">3</td>
                                                    <td class="fw-bold fs-6">90%</td>
                                                    <td class="fw-bold fs-6">168,168</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">台北市</td>
                                                    <td class="fw-bold fs-6">111,111,111</td>
                                                    <td class="fw-bold fs-6">8</td>
                                                    <td class="fw-bold fs-6">10</td>
                                                    <td class="fw-bold fs-6">5</td>
                                                    <td class="fw-bold fs-6">3</td>
                                                    <td class="fw-bold fs-6">90%</td>
                                                    <td class="fw-bold fs-6">168,168</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">基隆市</td>
                                                    <td class="fw-bold fs-6">111,111,111</td>
                                                    <td class="fw-bold fs-6">8</td>
                                                    <td class="fw-bold fs-6">10</td>
                                                    <td class="fw-bold fs-6">5</td>
                                                    <td class="fw-bold fs-6">3</td>
                                                    <td class="fw-bold fs-6">90%</td>
                                                    <td class="fw-bold fs-6">168,168</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="fw-bold fs-6">台北市</td>
                                                    <td class="fw-bold fs-6">111,111,111</td>
                                                    <td class="fw-bold fs-6">8</td>
                                                    <td class="fw-bold fs-6">10</td>
                                                    <td class="fw-bold fs-6">5</td>
                                                    <td class="fw-bold fs-6">3</td>
                                                    <td class="fw-bold fs-6">90%</td>
                                                    <td class="fw-bold fs-6">168,168</td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr class="fw-bold fs-6 bg-secondary" style="display:table;width:100%;table-layout:fixed;">
                                                    <td>{{__('performance-management.subtotal')}}</td>
                                                    <td>888,888</td>
                                                    <td>40</td>
                                                    <td>50</td>
                                                    <td>25</td>
                                                    <td>15</td>
                                                    <td>73%</td>
                                                    <td>888,888</td>
                                                </tr>
                                            </tfoot>
                                        </table>
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
