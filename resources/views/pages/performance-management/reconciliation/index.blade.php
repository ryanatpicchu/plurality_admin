<x-base-layout>

    <!--begin::Modal Container-->
    {{ theme()->getView('partials/modals/performance-management/_list-districts-performance-container') }}
    <!--end::Modal Container-->
    <div class="d-flex flex-column flex-row-fluid">
        <div class="card card-flush mb-2">
            <div class="card-body">
                <div class="d-flex flex-column flex-row-fluid">
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
                                <div class="card mb-20">
                                    <!--begin::Header-->
                                    <div class="card-header px-0">
                                        <h3 class="card-title align-items-start flex-column">
                                            {{__('performance-management.personal-performance-summary-quarterly')}}
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
                                                
                                                <tr class="fw-bold fs-6 bg-secondary align-middle" >
                                                    <td class="fw-bold fs-6" rowspan="2">{{__('performance-management.sales-name')}}</td>
                                                    <td class="fw-bold fs-6" rowspan="2">{{__('performance-management.revenue')}}</td>
                                                    <td class="fw-bold fs-6" colspan="3">{{__('performance-management.on-site')}}</td>
                                                    <td class="fw-bold fs-6" colspan="3">{{__('performance-management.remarketing')}}</td>
                                                    <td class="fw-bold fs-6" colspan="3">{{__('performance-management.digitm')}}</td>
                                                    <td class="fw-bold fs-6" colspan="3">{{__('performance-management.agent')}}</td>
                                                    <td class="fw-bold fs-6" rowspan="2">{{__('performance-management.target-quarterly')}}</td>
                                                    <td class="fw-bold fs-6" rowspan="2">{{__('performance-management.achievement-rate-quarterly')}}</td>
                                                </tr>
                                                <tr class="fw-bold fs-6 bg-secondary align-middle" >
                                                    <td class="fw-bold fs-6" >{{__('performance-management.revenue')}}</td>
                                                    <td class="fw-bold fs-6" >{{__('performance-management.cost')}}</td>
                                                    <td class="fw-bold fs-6" >{{__('performance-management.agency-commission-cost')}}</td>
                                                    <td class="fw-bold fs-6" >{{__('performance-management.revenue')}}</td>
                                                    <td class="fw-bold fs-6" >{{__('performance-management.cost')}}</td>
                                                    <td class="fw-bold fs-6" >{{__('performance-management.agency-commission-cost')}}</td>
                                                    <td class="fw-bold fs-6" >{{__('performance-management.revenue')}}</td>
                                                    <td class="fw-bold fs-6" >{{__('performance-management.cost')}}</td>
                                                    <td class="fw-bold fs-6" >{{__('performance-management.agency-commission-cost')}}</td>
                                                    <td class="fw-bold fs-6" >{{__('performance-management.revenue')}}</td>
                                                    <td class="fw-bold fs-6" >{{__('performance-management.cost')}}</td>
                                                    <td class="fw-bold fs-6" >{{__('performance-management.agency-commission-cost')}}</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="align-middle" style=";">
                                                    <td class="fw-bold fs-6">Ryan Hu</td>
                                                    <td class="fw-bold fs-6">666,666</td>
                                                    <td class="fw-bold fs-6">555,555</td>
                                                    <td class="fw-bold fs-6">111,111</td>
                                                    <td class="fw-bold fs-6">111,111</td>
                                                    <td class="fw-bold fs-6">555,555</td>
                                                    <td class="fw-bold fs-6">111,111</td>
                                                    <td class="fw-bold fs-6">111,111</td>
                                                    <td class="fw-bold fs-6">555,555</td>
                                                    <td class="fw-bold fs-6">111,111</td>
                                                    <td class="fw-bold fs-6">111,111</td>
                                                    <td class="fw-bold fs-6">555,555</td>
                                                    <td class="fw-bold fs-6">111,111</td>
                                                    <td class="fw-bold fs-6">111,111</td>
                                                    <td class="fw-bold fs-6">666,666</td>
                                                    <td class="fw-bold fs-6">100%</td>
                                                </tr>
                                                <tr class="align-middle" style=";">
                                                    <td class="fw-bold fs-6">Matt Lee</td>
                                                    <td class="fw-bold fs-6">666,666</td>
                                                    <td class="fw-bold fs-6">555,555</td>
                                                    <td class="fw-bold fs-6">111,111</td>
                                                    <td class="fw-bold fs-6">111,111</td>
                                                    <td class="fw-bold fs-6">555,555</td>
                                                    <td class="fw-bold fs-6">111,111</td>
                                                    <td class="fw-bold fs-6">111,111</td>
                                                    <td class="fw-bold fs-6">555,555</td>
                                                    <td class="fw-bold fs-6">111,111</td>
                                                    <td class="fw-bold fs-6">111,111</td>
                                                    <td class="fw-bold fs-6">555,555</td>
                                                    <td class="fw-bold fs-6">111,111</td>
                                                    <td class="fw-bold fs-6">111,111</td>
                                                    <td class="fw-bold fs-6">666,666</td>
                                                    <td class="fw-bold fs-6">100%</td>
                                                </tr>
                                                <tr class="align-middle" style=";">
                                                    <td class="fw-bold fs-6">Noah Yeh</td>
                                                    <td class="fw-bold fs-6">666,666</td>
                                                    <td class="fw-bold fs-6">555,555</td>
                                                    <td class="fw-bold fs-6">111,111</td>
                                                    <td class="fw-bold fs-6">111,111</td>
                                                    <td class="fw-bold fs-6">555,555</td>
                                                    <td class="fw-bold fs-6">111,111</td>
                                                    <td class="fw-bold fs-6">111,111</td>
                                                    <td class="fw-bold fs-6">555,555</td>
                                                    <td class="fw-bold fs-6">111,111</td>
                                                    <td class="fw-bold fs-6">111,111</td>
                                                    <td class="fw-bold fs-6">555,555</td>
                                                    <td class="fw-bold fs-6">111,111</td>
                                                    <td class="fw-bold fs-6">111,111</td>
                                                    <td class="fw-bold fs-6">666,666</td>
                                                    <td class="fw-bold fs-6">100%</td>
                                                </tr>
                                                <tr class="align-middle" style=";">
                                                    <td class="fw-bold fs-6">Lily Chen</td>
                                                    <td class="fw-bold fs-6">666,666</td>
                                                    <td class="fw-bold fs-6">555,555</td>
                                                    <td class="fw-bold fs-6">111,111</td>
                                                    <td class="fw-bold fs-6">111,111</td>
                                                    <td class="fw-bold fs-6">555,555</td>
                                                    <td class="fw-bold fs-6">111,111</td>
                                                    <td class="fw-bold fs-6">111,111</td>
                                                    <td class="fw-bold fs-6">555,555</td>
                                                    <td class="fw-bold fs-6">111,111</td>
                                                    <td class="fw-bold fs-6">111,111</td>
                                                    <td class="fw-bold fs-6">555,555</td>
                                                    <td class="fw-bold fs-6">111,111</td>
                                                    <td class="fw-bold fs-6">111,111</td>
                                                    <td class="fw-bold fs-6">666,666</td>
                                                    <td class="fw-bold fs-6">100%</td>
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




</x-base-layout>
