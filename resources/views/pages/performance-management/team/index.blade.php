<x-base-layout>

    <!--begin::Modal Container-->
    {{ theme()->getView('partials/modals/performance-management/_list-districts-performance-container') }}
    <!--end::Modal Container-->
    <div class="d-flex flex-column flex-row-fluid">
        <div class="card card-flush mb-2">
            <div class="card-body">
                <div class="d-flex flex-column flex-row-fluid">
                   
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
                                id="filtered_year"
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
                                id="filtered_display_type"
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
                                    <div id="filtered_months" class="col-8" >
                                        <select 
                                        name="filtered_months"
                                        data-placeholder="{{__('general.months')}}"
                                        class="form-select form-select-sm" data-control="select2" data-close-on-select="false" data-allow-clear="true" multiple="multiple">
                                            @for($i=1; $i<=12; $i++)
                                            <option value="{{$i}}">{{$i.__('performance-management.month')}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div id="filtered_quarters" class="col-8" style="display:none;" >
                                        <select 
                                        name="filtered_quarters"
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
                        <div class="col-12">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 form-label mt-3">
                                    <span >{{__('performance-management.teams')}}</span>
                                </label>
                                <!--end::Label-->
                                <div class="row">
                                    <div id="" class="col-8" >
                                        <select 
                                        name="filtered_teams"
                                        data-placeholder="{{__('general.teams')}}"
                                        class="form-select form-select-sm" data-control="select2" data-close-on-select="false" data-allow-clear="true" multiple="multiple">
                                        <option value="1">房產課-北A組</option>
                                        <option value="2">房產課-北B組</option>
                                        <option value="3">房產課-中區組</option>
                                        <option value="4">房產課-南區組</option>
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
                    
                    <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6">
                        @php
                            $report_types = config('global.general.team_report_types');
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
                        <div class="tab-pane fade show active" id="team-summary" role="tabpanel">
                            <div class="d-flex flex-column flex-row-fluid">
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
                                                    <td class="bg-secondary" colspan="2">&nbsp;</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td class="bg-secondary" colspan="3">{{$i.__('performance-management.month')}}</td>
                                                    @endfor
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.product')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.team')}}</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.target-revenue')}}</td>
                                                        <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.actual-revenue')}}</td>
                                                        <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.achievement-rate-monthly')}}</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 ">{{__('performance-management.on-site')}}</td>
                                                    <td class="fw-bold fs-6 ">房產課-北A組</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>111,111</td><td>222,222</td><td>100%</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 bg-secondary" colspan="2">{{__('performance-management.on-site')}}{{__('performance-management.subtotal')}}</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>111,111</td><td>222,222</td><td>100%</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 ">{{__('performance-management.remarketing')}}</td>
                                                    <td class="fw-bold fs-6 ">房產課-北A組</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>111,111</td><td>222,222</td><td>100%</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 bg-secondary" colspan="2">{{__('performance-management.remarketing')}}{{__('performance-management.subtotal')}}</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>111,111</td><td>222,222</td><td>100%</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 ">{{__('performance-management.digitm')}}</td>
                                                    <td class="fw-bold fs-6 ">房產課-北A組</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>111,111</td><td>222,222</td><td>100%</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 bg-secondary" colspan="2">{{__('performance-management.digitm')}}{{__('performance-management.subtotal')}}</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>111,111</td><td>222,222</td><td>100%</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 bg-secondary" colspan="2">{{__('performance-management.subtotal')}}</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>333,333</td><td>666,666</td><td>100%</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 bg-secondary" colspan="2">{{__('performance-management.achievement-rate-monthly-onsite-and-remarketing')}}</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>&nbsp;</td><td>&nbsp;</td><td>100%</td>
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
                                                    <td class="bg-secondary" colspan="2">&nbsp;</td>
                                                    @for($i=4; $i<=6; $i++)
                                                        <td class="bg-secondary" colspan="3">{{$i.__('performance-management.month')}}</td>
                                                    @endfor
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.product')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.team')}}</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.target-revenue')}}</td>
                                                        <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.actual-revenue')}}</td>
                                                        <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.achievement-rate-monthly')}}</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 ">{{__('performance-management.on-site')}}</td>
                                                    <td class="fw-bold fs-6 ">房產課-北A組</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>111,111</td><td>222,222</td><td>100%</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 bg-secondary" colspan="2">{{__('performance-management.on-site')}}{{__('performance-management.subtotal')}}</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>111,111</td><td>222,222</td><td>100%</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 ">{{__('performance-management.remarketing')}}</td>
                                                    <td class="fw-bold fs-6 ">房產課-北A組</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>111,111</td><td>222,222</td><td>100%</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 bg-secondary" colspan="2">{{__('performance-management.remarketing')}}{{__('performance-management.subtotal')}}</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>111,111</td><td>222,222</td><td>100%</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 ">{{__('performance-management.digitm')}}</td>
                                                    <td class="fw-bold fs-6 ">房產課-北A組</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>111,111</td><td>222,222</td><td>100%</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 bg-secondary" colspan="2">{{__('performance-management.digitm')}}{{__('performance-management.subtotal')}}</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>111,111</td><td>222,222</td><td>100%</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 bg-secondary" colspan="2">{{__('performance-management.subtotal')}}</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>333,333</td><td>666,666</td><td>100%</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 bg-secondary" colspan="2">{{__('performance-management.achievement-rate-monthly-onsite-and-remarketing')}}</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>&nbsp;</td><td>&nbsp;</td><td>100%</td>
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
                                            <a href="javascript:;" class="btn btn-sm btn-secondary copy-table" table="summary-3">
                                                {{__('performance-management.copy-table')}}</a>
                                        </div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body py-3 pe-0 ps-0">
                                    <!--begin::Table-->
                                        <table 
                                        id="summary-3"
                                        class="table table-rounded table-bordered text-center">
                                            <thead>
                                                <tr class="fw-bold fs-6">
                                                    <td class="bg-secondary" colspan="2">&nbsp;</td>
                                                    @for($i=7; $i<=9; $i++)
                                                        <td class="bg-secondary" colspan="3">{{$i.__('performance-management.month')}}</td>
                                                    @endfor
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.product')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.team')}}</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.target-revenue')}}</td>
                                                        <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.actual-revenue')}}</td>
                                                        <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.achievement-rate-monthly')}}</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 ">{{__('performance-management.on-site')}}</td>
                                                    <td class="fw-bold fs-6 ">房產課-北A組</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>111,111</td><td>222,222</td><td>100%</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 bg-secondary" colspan="2">{{__('performance-management.on-site')}}{{__('performance-management.subtotal')}}</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>111,111</td><td>222,222</td><td>100%</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 ">{{__('performance-management.remarketing')}}</td>
                                                    <td class="fw-bold fs-6 ">房產課-北A組</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>111,111</td><td>222,222</td><td>100%</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 bg-secondary" colspan="2">{{__('performance-management.remarketing')}}{{__('performance-management.subtotal')}}</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>111,111</td><td>222,222</td><td>100%</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 ">{{__('performance-management.digitm')}}</td>
                                                    <td class="fw-bold fs-6 ">房產課-北A組</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>111,111</td><td>222,222</td><td>100%</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 bg-secondary" colspan="2">{{__('performance-management.digitm')}}{{__('performance-management.subtotal')}}</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>111,111</td><td>222,222</td><td>100%</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 bg-secondary" colspan="2">{{__('performance-management.subtotal')}}</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>333,333</td><td>666,666</td><td>100%</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 bg-secondary" colspan="2">{{__('performance-management.achievement-rate-monthly-onsite-and-remarketing')}}</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>&nbsp;</td><td>&nbsp;</td><td>100%</td>
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
                                            <a href="javascript:;" class="btn btn-sm btn-secondary copy-table" table="summary-4">
                                                {{__('performance-management.copy-table')}}</a>
                                        </div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body py-3 pe-0 ps-0">
                                    <!--begin::Table-->
                                        <table 
                                        id="summary-4"
                                        class="table table-rounded table-bordered text-center">
                                            <thead>
                                                <tr class="fw-bold fs-6">
                                                    <td class="bg-secondary" colspan="2">&nbsp;</td>
                                                    @for($i=10; $i<=12; $i++)
                                                        <td class="bg-secondary" colspan="3">{{$i.__('performance-management.month')}}</td>
                                                    @endfor
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.product')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.team')}}</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.target-revenue')}}</td>
                                                        <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.actual-revenue')}}</td>
                                                        <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.achievement-rate-monthly')}}</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 ">{{__('performance-management.on-site')}}</td>
                                                    <td class="fw-bold fs-6 ">房產課-北A組</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>111,111</td><td>222,222</td><td>100%</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 bg-secondary" colspan="2">{{__('performance-management.on-site')}}{{__('performance-management.subtotal')}}</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>111,111</td><td>222,222</td><td>100%</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 ">{{__('performance-management.remarketing')}}</td>
                                                    <td class="fw-bold fs-6 ">房產課-北A組</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>111,111</td><td>222,222</td><td>100%</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 bg-secondary" colspan="2">{{__('performance-management.remarketing')}}{{__('performance-management.subtotal')}}</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>111,111</td><td>222,222</td><td>100%</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 ">{{__('performance-management.digitm')}}</td>
                                                    <td class="fw-bold fs-6 ">房產課-北A組</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>111,111</td><td>222,222</td><td>100%</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 bg-secondary" colspan="2">{{__('performance-management.digitm')}}{{__('performance-management.subtotal')}}</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>111,111</td><td>222,222</td><td>100%</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 bg-secondary" colspan="2">{{__('performance-management.subtotal')}}</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>333,333</td><td>666,666</td><td>100%</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 bg-secondary" colspan="2">{{__('performance-management.achievement-rate-monthly-onsite-and-remarketing')}}</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>&nbsp;</td><td>&nbsp;</td><td>100%</td>
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
                        <div class="tab-pane fade show" id="team-detail" role="tabpanel">
                            <div class="d-flex flex-column flex-row-fluid">
                                <div class="card mb-2">
                                    <!--begin::Header-->
                                    <div class="card-header px-0">
                                        <h3 class="card-title align-items-start flex-column">
                                            &nbsp;
                                        </h3>
                                        <div class="card-toolbar">
                                            <a href="javascript:;" class="btn btn-sm btn-secondary copy-table" table="detail-1">
                                                {{__('performance-management.copy-table')}}</a>
                                        </div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body py-3 pe-0 ps-0">
                                    <!--begin::Table-->
                                        <table 
                                        id="detail-1"
                                        class="table table-rounded table-bordered text-center">
                                            <thead>
                                                <tr class="fw-bold fs-6">
                                                    <td class="fw-bold fs-6 bg-secondary" colspan="15">Q1</td>
                                                </tr>
                                                <tr class="fw-bold fs-6">
                                                    <td class="fw-bold fs-6 bg-secondary" colspan="2">&nbsp;</td>
                                                    <td class="fw-bold fs-6 bg-secondary" colspan="3">{{__('performance-management.on-site')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary" colspan="3">{{__('performance-management.remarketing')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary" colspan="3">{{__('performance-management.digitm')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary" colspan="4">{{__('performance-management.subtotal')}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 bg-secondary" >{{__('performance-management.team')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary" >{{__('performance-management.sales-name')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.target-revenue')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.actual-revenue')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.achievement-rate-monthly')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.target-revenue')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.actual-revenue')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.achievement-rate-monthly')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.target-revenue')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.actual-revenue')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.achievement-rate-monthly')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.target-revenue')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.actual-revenue')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.achievement-rate-monthly')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.achievement-rate-quarterly-onsite-and-remarketing')}}</td>
                                                </tr>
                                                
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="fw-bold fs-6">房產課-北A組</td>
                                                    <td class="fw-bold fs-6">Ryan Hu</td>
                                                    <td>111,111</td><td>222,222</td><td>100%</td>
                                                    <td>111,111</td><td>222,222</td><td>100%</td>
                                                    <td>111,111</td><td>222,222</td><td>100%</td>
                                                    <td>333,333</td><td>666,666</td><td>100%</td>
                                                    <td>100%</td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6">房產課-北A組</td>
                                                    <td class="fw-bold fs-6">Matt Lee</td>
                                                    <td>111,111</td><td>222,222</td><td>100%</td>
                                                    <td>111,111</td><td>222,222</td><td>100%</td>
                                                    <td>111,111</td><td>222,222</td><td>100%</td>
                                                    <td>333,333</td><td>666,666</td><td>100%</td>
                                                    <td>100%</td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6">房產課-北A組</td>
                                                    <td class="fw-bold fs-6">Lily Chen</td>
                                                    <td>111,111</td><td>222,222</td><td>100%</td>
                                                    <td>111,111</td><td>222,222</td><td>100%</td>
                                                    <td>111,111</td><td>222,222</td><td>100%</td>
                                                    <td>333,333</td><td>666,666</td><td>100%</td>
                                                    <td>100%</td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6">房產課-北A組</td>
                                                    <td class="fw-bold fs-6">Peter Lee</td>
                                                    <td>111,111</td><td>222,222</td><td>100%</td>
                                                    <td>111,111</td><td>222,222</td><td>100%</td>
                                                    <td>111,111</td><td>222,222</td><td>100%</td>
                                                    <td>333,333</td><td>666,666</td><td>100%</td>
                                                    <td>100%</td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6">房產課-北A組</td>
                                                    <td class="fw-bold fs-6">Noah Yeh</td>
                                                    <td>111,111</td><td>222,222</td><td>100%</td>
                                                    <td>111,111</td><td>222,222</td><td>100%</td>
                                                    <td>111,111</td><td>222,222</td><td>100%</td>
                                                    <td>333,333</td><td>666,666</td><td>100%</td>
                                                    <td>100%</td>
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
                                            <a href="javascript:;" class="btn btn-sm btn-secondary copy-table" table="detail-2">
                                                {{__('performance-management.copy-table')}}</a>
                                        </div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body py-3 pe-0 ps-0">
                                    <!--begin::Table-->
                                        <table 
                                        id="detail-2"
                                        class="table table-rounded table-bordered text-center">
                                            <thead>
                                                <tr class="fw-bold fs-6">
                                                    <td class="fw-bold fs-6 bg-secondary" colspan="15">Q2</td>
                                                </tr>
                                                <tr class="fw-bold fs-6">
                                                    <td class="fw-bold fs-6 bg-secondary" colspan="2">&nbsp;</td>
                                                    <td class="fw-bold fs-6 bg-secondary" colspan="3">{{__('performance-management.on-site')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary" colspan="3">{{__('performance-management.remarketing')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary" colspan="3">{{__('performance-management.digitm')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary" colspan="4">{{__('performance-management.subtotal')}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 bg-secondary" >{{__('performance-management.team')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary" >{{__('performance-management.sales-name')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.target-revenue')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.actual-revenue')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.achievement-rate-monthly')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.target-revenue')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.actual-revenue')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.achievement-rate-monthly')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.target-revenue')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.actual-revenue')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.achievement-rate-monthly')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.target-revenue')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.actual-revenue')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.achievement-rate-monthly')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.achievement-rate-quarterly-onsite-and-remarketing')}}</td>
                                                </tr>
                                                
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="fw-bold fs-6">房產課-北A組</td>
                                                    <td class="fw-bold fs-6">Ryan Hu</td>
                                                    <td>111,111</td><td>222,222</td><td>100%</td>
                                                    <td>111,111</td><td>222,222</td><td>100%</td>
                                                    <td>111,111</td><td>222,222</td><td>100%</td>
                                                    <td>333,333</td><td>666,666</td><td>100%</td>
                                                    <td>100%</td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6">房產課-北A組</td>
                                                    <td class="fw-bold fs-6">Matt Lee</td>
                                                    <td>111,111</td><td>222,222</td><td>100%</td>
                                                    <td>111,111</td><td>222,222</td><td>100%</td>
                                                    <td>111,111</td><td>222,222</td><td>100%</td>
                                                    <td>333,333</td><td>666,666</td><td>100%</td>
                                                    <td>100%</td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6">房產課-北A組</td>
                                                    <td class="fw-bold fs-6">Lily Chen</td>
                                                    <td>111,111</td><td>222,222</td><td>100%</td>
                                                    <td>111,111</td><td>222,222</td><td>100%</td>
                                                    <td>111,111</td><td>222,222</td><td>100%</td>
                                                    <td>333,333</td><td>666,666</td><td>100%</td>
                                                    <td>100%</td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6">房產課-北A組</td>
                                                    <td class="fw-bold fs-6">Peter Lee</td>
                                                    <td>111,111</td><td>222,222</td><td>100%</td>
                                                    <td>111,111</td><td>222,222</td><td>100%</td>
                                                    <td>111,111</td><td>222,222</td><td>100%</td>
                                                    <td>333,333</td><td>666,666</td><td>100%</td>
                                                    <td>100%</td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6">房產課-北A組</td>
                                                    <td class="fw-bold fs-6">Noah Yeh</td>
                                                    <td>111,111</td><td>222,222</td><td>100%</td>
                                                    <td>111,111</td><td>222,222</td><td>100%</td>
                                                    <td>111,111</td><td>222,222</td><td>100%</td>
                                                    <td>333,333</td><td>666,666</td><td>100%</td>
                                                    <td>100%</td>
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
                                            <a href="javascript:;" class="btn btn-sm btn-secondary copy-table" table="detail-3">
                                                {{__('performance-management.copy-table')}}</a>
                                        </div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body py-3 pe-0 ps-0">
                                    <!--begin::Table-->
                                        <table 
                                        id="detail-3"
                                        class="table table-rounded table-bordered text-center">
                                            <thead>
                                                <tr class="fw-bold fs-6">
                                                    <td class="fw-bold fs-6 bg-secondary" colspan="15">Q3</td>
                                                </tr>
                                                <tr class="fw-bold fs-6">
                                                    <td class="fw-bold fs-6 bg-secondary" colspan="2">&nbsp;</td>
                                                    <td class="fw-bold fs-6 bg-secondary" colspan="3">{{__('performance-management.on-site')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary" colspan="3">{{__('performance-management.remarketing')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary" colspan="3">{{__('performance-management.digitm')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary" colspan="4">{{__('performance-management.subtotal')}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 bg-secondary" >{{__('performance-management.team')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary" >{{__('performance-management.sales-name')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.target-revenue')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.actual-revenue')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.achievement-rate-monthly')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.target-revenue')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.actual-revenue')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.achievement-rate-monthly')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.target-revenue')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.actual-revenue')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.achievement-rate-monthly')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.target-revenue')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.actual-revenue')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.achievement-rate-monthly')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.achievement-rate-quarterly-onsite-and-remarketing')}}</td>
                                                </tr>
                                                
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="fw-bold fs-6">房產課-北A組</td>
                                                    <td class="fw-bold fs-6">Ryan Hu</td>
                                                    <td>111,111</td><td>222,222</td><td>100%</td>
                                                    <td>111,111</td><td>222,222</td><td>100%</td>
                                                    <td>111,111</td><td>222,222</td><td>100%</td>
                                                    <td>333,333</td><td>666,666</td><td>100%</td>
                                                    <td>100%</td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6">房產課-北A組</td>
                                                    <td class="fw-bold fs-6">Matt Lee</td>
                                                    <td>111,111</td><td>222,222</td><td>100%</td>
                                                    <td>111,111</td><td>222,222</td><td>100%</td>
                                                    <td>111,111</td><td>222,222</td><td>100%</td>
                                                    <td>333,333</td><td>666,666</td><td>100%</td>
                                                    <td>100%</td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6">房產課-北A組</td>
                                                    <td class="fw-bold fs-6">Lily Chen</td>
                                                    <td>111,111</td><td>222,222</td><td>100%</td>
                                                    <td>111,111</td><td>222,222</td><td>100%</td>
                                                    <td>111,111</td><td>222,222</td><td>100%</td>
                                                    <td>333,333</td><td>666,666</td><td>100%</td>
                                                    <td>100%</td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6">房產課-北A組</td>
                                                    <td class="fw-bold fs-6">Peter Lee</td>
                                                    <td>111,111</td><td>222,222</td><td>100%</td>
                                                    <td>111,111</td><td>222,222</td><td>100%</td>
                                                    <td>111,111</td><td>222,222</td><td>100%</td>
                                                    <td>333,333</td><td>666,666</td><td>100%</td>
                                                    <td>100%</td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6">房產課-北A組</td>
                                                    <td class="fw-bold fs-6">Noah Yeh</td>
                                                    <td>111,111</td><td>222,222</td><td>100%</td>
                                                    <td>111,111</td><td>222,222</td><td>100%</td>
                                                    <td>111,111</td><td>222,222</td><td>100%</td>
                                                    <td>333,333</td><td>666,666</td><td>100%</td>
                                                    <td>100%</td>
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
                                            <a href="javascript:;" class="btn btn-sm btn-secondary copy-table" table="detail-4">
                                                {{__('performance-management.copy-table')}}</a>
                                        </div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body py-3 pe-0 ps-0">
                                    <!--begin::Table-->
                                        <table 
                                        id="detail-4"
                                        class="table table-rounded table-bordered text-center">
                                            <thead>
                                                <tr class="fw-bold fs-6">
                                                    <td class="fw-bold fs-6 bg-secondary" colspan="15">Q4</td>
                                                </tr>
                                                <tr class="fw-bold fs-6">
                                                    <td class="fw-bold fs-6 bg-secondary" colspan="2">&nbsp;</td>
                                                    <td class="fw-bold fs-6 bg-secondary" colspan="3">{{__('performance-management.on-site')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary" colspan="3">{{__('performance-management.remarketing')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary" colspan="3">{{__('performance-management.digitm')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary" colspan="4">{{__('performance-management.subtotal')}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 bg-secondary" >{{__('performance-management.team')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary" >{{__('performance-management.sales-name')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.target-revenue')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.actual-revenue')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.achievement-rate-monthly')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.target-revenue')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.actual-revenue')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.achievement-rate-monthly')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.target-revenue')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.actual-revenue')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.achievement-rate-monthly')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.target-revenue')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.actual-revenue')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.achievement-rate-monthly')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.achievement-rate-quarterly-onsite-and-remarketing')}}</td>
                                                </tr>
                                                
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="fw-bold fs-6">房產課-北A組</td>
                                                    <td class="fw-bold fs-6">Ryan Hu</td>
                                                    <td>111,111</td><td>222,222</td><td>100%</td>
                                                    <td>111,111</td><td>222,222</td><td>100%</td>
                                                    <td>111,111</td><td>222,222</td><td>100%</td>
                                                    <td>333,333</td><td>666,666</td><td>100%</td>
                                                    <td>100%</td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6">房產課-北A組</td>
                                                    <td class="fw-bold fs-6">Matt Lee</td>
                                                    <td>111,111</td><td>222,222</td><td>100%</td>
                                                    <td>111,111</td><td>222,222</td><td>100%</td>
                                                    <td>111,111</td><td>222,222</td><td>100%</td>
                                                    <td>333,333</td><td>666,666</td><td>100%</td>
                                                    <td>100%</td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6">房產課-北A組</td>
                                                    <td class="fw-bold fs-6">Lily Chen</td>
                                                    <td>111,111</td><td>222,222</td><td>100%</td>
                                                    <td>111,111</td><td>222,222</td><td>100%</td>
                                                    <td>111,111</td><td>222,222</td><td>100%</td>
                                                    <td>333,333</td><td>666,666</td><td>100%</td>
                                                    <td>100%</td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6">房產課-北A組</td>
                                                    <td class="fw-bold fs-6">Peter Lee</td>
                                                    <td>111,111</td><td>222,222</td><td>100%</td>
                                                    <td>111,111</td><td>222,222</td><td>100%</td>
                                                    <td>111,111</td><td>222,222</td><td>100%</td>
                                                    <td>333,333</td><td>666,666</td><td>100%</td>
                                                    <td>100%</td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6">房產課-北A組</td>
                                                    <td class="fw-bold fs-6">Noah Yeh</td>
                                                    <td>111,111</td><td>222,222</td><td>100%</td>
                                                    <td>111,111</td><td>222,222</td><td>100%</td>
                                                    <td>111,111</td><td>222,222</td><td>100%</td>
                                                    <td>333,333</td><td>666,666</td><td>100%</td>
                                                    <td>100%</td>
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
                                <div class="card mb-2">
                                    <!--begin::Header-->
                                    <div class="card-header px-0">
                                        <h3 class="card-title align-items-start flex-column">
                                            <div class="col-12">
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
                                                    <td class="bg-secondary" colspan="2">&nbsp;</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td class="bg-secondary" colspan="3">{{$i.__('performance-management.month')}}</td>
                                                    @endfor
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="align-middle">
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.product')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.team')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.target-revenue')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">
                                                        {{__('performance-management.same-period-comparison')}}
                                                        <br />
                                                        (2016/1)
                                                    </td>
                                                    <td class="fw-bold fs-6 bg-secondary">
                                                        {{__('performance-management.last-comparison')}}
                                                        <br />
                                                        (2022/12)
                                                    </td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.target-revenue')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">
                                                        {{__('performance-management.same-period-comparison')}}
                                                        <br />
                                                        (2016/2)
                                                    </td>
                                                    <td class="fw-bold fs-6 bg-secondary">
                                                        {{__('performance-management.last-comparison')}}
                                                        <br />
                                                        (2023/1)
                                                    </td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.target-revenue')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">
                                                        {{__('performance-management.same-period-comparison')}}
                                                        <br />
                                                        (2016/3)
                                                    </td>
                                                    <td class="fw-bold fs-6 bg-secondary">
                                                        {{__('performance-management.last-comparison')}}
                                                        <br />
                                                        (2023/2)
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 ">{{__('performance-management.on-site')}}</td>
                                                    <td class="fw-bold fs-6 ">房產課-北A組</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>111,111</td><td>222,222</td><td>333,333</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 bg-secondary" colspan="2">{{__('performance-management.on-site')}}{{__('performance-management.subtotal')}}</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>111,111</td><td>222,222</td><td>333,333</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 ">{{__('performance-management.remarketing')}}</td>
                                                    <td class="fw-bold fs-6 ">房產課-北A組</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>111,111</td><td>222,222</td><td>333,333</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 bg-secondary" colspan="2">{{__('performance-management.remarketing')}}{{__('performance-management.subtotal')}}</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>111,111</td><td>222,222</td><td>333,333</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 ">{{__('performance-management.digitm')}}</td>
                                                    <td class="fw-bold fs-6 ">房產課-北A組</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>111,111</td><td>222,222</td><td>333,333</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 bg-secondary" colspan="2">{{__('performance-management.digitm')}}{{__('performance-management.subtotal')}}</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>111,111</td><td>222,222</td><td>333,333</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 bg-secondary" colspan="2">{{__('performance-management.subtotal')}}</td>
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
                                <div class="card mb-2">
                                    <!--begin::Header-->
                                    <div class="card-header px-0">
                                        <h3 class="card-title align-items-start flex-column">
                                            <div class="col-12">
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
                                                    <td class="bg-secondary" colspan="2">&nbsp;</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td class="bg-secondary" colspan="3">{{$i.__('performance-management.month')}}</td>
                                                    @endfor
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="align-middle">
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.product')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.team')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.actual-revenue')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">
                                                        {{__('performance-management.same-period-comparison')}}
                                                        <br />
                                                        (2016/1)
                                                    </td>
                                                    <td class="fw-bold fs-6 bg-secondary">
                                                        {{__('performance-management.last-comparison')}}
                                                        <br />
                                                        (2022/12)
                                                    </td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.actual-revenue')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">
                                                        {{__('performance-management.same-period-comparison')}}
                                                        <br />
                                                        (2016/2)
                                                    </td>
                                                    <td class="fw-bold fs-6 bg-secondary">
                                                        {{__('performance-management.last-comparison')}}
                                                        <br />
                                                        (2023/1)
                                                    </td>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('performance-management.actual-revenue')}}</td>
                                                    <td class="fw-bold fs-6 bg-secondary">
                                                        {{__('performance-management.same-period-comparison')}}
                                                        <br />
                                                        (2016/3)
                                                    </td>
                                                    <td class="fw-bold fs-6 bg-secondary">
                                                        {{__('performance-management.last-comparison')}}
                                                        <br />
                                                        (2023/2)
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 ">{{__('performance-management.on-site')}}</td>
                                                    <td class="fw-bold fs-6 ">房產課-北A組</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>111,111</td><td>222,222</td><td>333,333</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 bg-secondary" colspan="2">{{__('performance-management.on-site')}}{{__('performance-management.subtotal')}}</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>111,111</td><td>222,222</td><td>333,333</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 ">{{__('performance-management.remarketing')}}</td>
                                                    <td class="fw-bold fs-6 ">房產課-北A組</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>111,111</td><td>222,222</td><td>333,333</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 bg-secondary" colspan="2">{{__('performance-management.remarketing')}}{{__('performance-management.subtotal')}}</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>111,111</td><td>222,222</td><td>333,333</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 ">{{__('performance-management.digitm')}}</td>
                                                    <td class="fw-bold fs-6 ">房產課-北A組</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>111,111</td><td>222,222</td><td>333,333</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 bg-secondary" colspan="2">{{__('performance-management.digitm')}}{{__('performance-management.subtotal')}}</td>
                                                    @for($i=1; $i<=3; $i++)
                                                        <td>111,111</td><td>222,222</td><td>333,333</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 bg-secondary" colspan="2">{{__('performance-management.subtotal')}}</td>
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
                    </div>
                </div>
            </div>
        </div>
        
    </div>




</x-base-layout>
