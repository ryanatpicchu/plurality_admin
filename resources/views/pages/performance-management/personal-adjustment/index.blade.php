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
                        <div class="col-2">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 form-label mt-3">
                                    <span >{{__('performance-management.departments')}}</span>
                                </label>
                                <!--end::Label-->
                                
                                <!--begin::Select-->
                                <select 
                                id="filtered_department"
                                name="filtered_department"
                                class=" form-select form-select-sm" data-control="select2" data-hide-search="true">
                                <option value="1">直客業務部</option>
                                </select>
                                <!--end::Select-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <div class="col-4">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 form-label mt-3">
                                    <span >{{__('performance-management.teams')}}</span>
                                </label>
                                <!--end::Label-->
                                <div class="row">
                                    <div id="" class="col-6" >
                                        <!--begin::Select-->
                                        <select 
                                        id="filtered_department"
                                        name="filtered_department"
                                        class=" form-select form-select-sm" data-control="select2" data-hide-search="true">
                                        <option value="1">房產課-北區A組</option>
                                        </select>
                                        <!--end::Select-->
                                    </div>
                                    <div class="col-4 d-flex justify-content-start">
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
                    <div class="d-flex flex-column flex-row-fluid">
                        <div class="card mb-2">
                            
                            <!--begin::Body-->
                            <div class="card-body py-3 pe-0 ps-0">
                            <!--begin::Table-->
                                <table 
                                id="personal-adjustment-1"
                                class="table table-rounded table-bordered text-center">
                                    <thead>
                                        <tr class="fw-bold fs-6">
                                            <td class="bg-secondary" >{{__('performance-management.sales-name')}}</td>
                                            @for($i=1; $i<=12; $i++)
                                                <td class="bg-secondary">{{$i.__('performance-management.month')}}</td>
                                            @endfor
                                            <td class="bg-secondary" >{{__('performance-management.subtotal')}}</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <tr class="align-middle">
                                            <td class="fw-bold fs-6 bg-secondary" rowspan="3">
                                                Ryan Hu
                                            </td>
                                            @for($i=1;$i<=12;$i++)
                                                <td class="fw-bold fs-6 ">
                                                    <input class="form-control form-control-sm" value="111,111,111"/>
                                                </td>
                                            @endfor
                                            <td class="fw-bold fs-6 bg-secondary" rowspan="3">
                                                999,999,999
                                            </td>
                                        </tr>
                                        <tr class="align-middle">
                                            @for($i=1;$i<=4;$i++)
                                                <td class="fw-bold fs-6 " colspan="3">
                                                    333,333,333
                                                </td>
                                            @endfor
                                        </tr>
                                        <tr class="align-middle">
                                            @for($i=1;$i<=2;$i++)
                                                <td class="fw-bold fs-6 " colspan="6">
                                                    666,666,666
                                                </td>
                                            @endfor
                                            
                                        </tr>

                                        <tr class="align-middle">
                                            <td class="fw-bold fs-6 bg-secondary" rowspan="3">
                                                Matt Lee
                                            </td>
                                            @for($i=1;$i<=12;$i++)
                                                <td class="fw-bold fs-6 ">
                                                    <input class="form-control form-control-sm" value="888,888"/>
                                                </td>
                                            @endfor
                                            <td class="fw-bold fs-6 bg-secondary" rowspan="3">
                                                10,666,656
                                            </td>
                                        </tr>
                                        <tr class="align-middle">
                                            @for($i=1;$i<=4;$i++)
                                                <td class="fw-bold fs-6 " colspan="3">
                                                    2,666,664
                                                </td>
                                            @endfor
                                        </tr>
                                        <tr class="align-middle">
                                            @for($i=1;$i<=2;$i++)
                                                <td class="fw-bold fs-6 " colspan="6">
                                                    5,333,328
                                                </td>
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




</x-base-layout>
