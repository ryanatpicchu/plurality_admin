<x-base-layout>

    <!--begin::Modal Container-->
    {{ theme()->getView('partials/modals/performance-management/_list-districts-performance-container') }}
    <!--end::Modal Container-->
    <div class="d-flex flex-column flex-row-fluid">
        <div class="card card-flush mb-2">
            <div class="card-header">
                <div class="card-title">
                    <div class="me-6">
                        <select id="available_channels" class="form-select form-select-sm" data-dropdown-css-class="w-100px" data-control="select2" data-hide-search="true">
                            @foreach($available_channels as $key=>$channel)
                                <option value="{{$channel->id}}">{{ $channel->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="me-6">
                        <div id="date_range_picker" style="background: #fff; cursor: pointer; padding: 4px 10px; border: 1px solid #ccc; width: 100%; border-radius: 0.425rem;">
                            <i class="fa fa-calendar-days"></i>&nbsp;
                            <span style="color:#5E6278;"></span> <i class="fa fa-caret-down"></i>
                        </div>
                        <input id="adslot_start_date" name="start_date" style="display:none;" />
                        <input id="adslot_end_date" name="end_date" style="display:none;" />
                    </div>
                    <div class="me-6">
                        <button 
                        class="btn btn-sm btn-warning position-relative me-5">
                            {{__('operating-data.confirm')}}
                        </button>
                    </div>
                </div>
                
            </div>
            <div class="card-body">
                <div class="d-flex flex-column flex-row-fluid">
                   
                    <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6">
                        @php
                            $sales_rate_types = config('global.general.sales_rate_types');
                        @endphp
                        
                        @foreach($sales_rate_types as $key=>$type)
                            <li class="nav-item">
                                <a class="nav-link text-active-primary @if($key==0) active @endif" data-bs-toggle="tab" href="#{{$type}}">
                                    {{__('operating-data.sales-rate-'.$type)}}
                                </a>
                            </li>
                        @endforeach
                        
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="by-regions" role="tabpanel">
                            <div class="d-flex flex-column flex-row-fluid">
                                <div class="card mb-2">
                                    <!--begin::Header-->
                                    <div class="card-header px-0">
                                        <h3 class="card-title align-items-start flex-column">
                                            &nbsp;
                                        </h3>
                                        <div class="card-toolbar">
                                            <a href="javascript:;" class="btn btn-sm btn-secondary copy-table" table="sales-rate-by-regions">
                                                {{__('operating-data.copy-table')}}</a>
                                        </div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body py-3 pe-0 ps-0">
                                        <table 
                                        id="sales-rate-by-regions"
                                        class="table table-head-custom table-rounded table-bordered text-center">
                                        <thead style="display:table;width:100%;table-layout:fixed;">
                                            <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                <th class="text-center bg-secondary text-gray-800">
                                                    {{__('operating-data.regions')}}
                                                </th>
                                                @for($i=1; $i<=12; $i++)
                                                    <th class="text-center bg-secondary text-gray-800">{{$i.__('operating-data.month')}}</th>
                                                @endfor
                                            </tr>
                                        </thead>
                                        <tbody style="display:block;height:300px;overflow:auto;">
                                            @foreach($available_regions as $key=>$region)
                                            <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                <td>591_{{$region->name}}</td>
                                                @for($i=1; $i<=12; $i++)
                                                    <td>1.68%</td>
                                                @endfor
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        </table>
                                    <!--begin::Table-->
                                        <!-- <table 
                                        id="sales-rate-by-regions"
                                        class="table table-head-custom table-rounded table-bordered text-center">
                                            <thead>
                                                <tr>
                                                    <th class="text-center bg-secondary" colspan="2">2023/12/01 - 2023/12/31</th>
                                                </tr>
                                                <tr>
                                                    <th class="text-center">
                                                        {{__('operating-data.regions')}}
                                                    </th>
                                                    <th class="text-center">
                                                        {{__('operating-data.sales-rate')}}
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($available_regions as $key=>$region)
                                                <tr>
                                                    <td>591_{{$region->name}}</td>
                                                    <td>1.68%</td>
                                                </tr>
                                                @endforeach
                                                
                                            </tbody>
                                        </table> -->
                                    <!--end::Table-->        
                                    
                                    </div>
                                    <!--begin::Body-->
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="by-channel-groups" role="tabpanel">
                            <div class="d-flex flex-column flex-row-fluid">
                                <div class="card mb-2">
                                    <!--begin::Header-->
                                    <div class="card-header px-0">
                                        <h3 class="card-title align-items-start flex-column">
                                            &nbsp;
                                        </h3>
                                        <div class="card-toolbar">
                                            <a href="javascript:;" class="btn btn-sm btn-secondary copy-table" table="sales-rate-by-channel-groups">
                                                {{__('operating-data.copy-table')}}</a>
                                        </div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body py-3 pe-0 ps-0">
                                    <!--begin::Table-->
                                        <table 
                                        id="sales-rate-by-channel-groups"
                                        class="table table-head-custom table-rounded table-bordered text-center">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">
                                                        {{__('operating-data.channel-groups')}}
                                                    </th>
                                                    <th class="text-center">
                                                        {{__('operating-data.sales-rate')}}
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($channel_groups as $key=>$channel_group)
                                                <tr>
                                                    <td>591_全台_{{$channel_group->name}}</td>
                                                    <td>1.68%</td>
                                                </tr>
                                                @endforeach
                                                
                                            </tbody>
                                        </table>
                                    <!--end::Table-->        
                                    
                                    </div>
                                    <!--begin::Body-->
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="by-adslot-groups" role="tabpanel">
                            <div class="d-flex flex-column flex-row-fluid">
                                <div class="row">
                                    <div class="col-3 d-flex">
                                        <div class="form-check form-check-custom form-check-solid me-6">
                                            <input class="form-check-input" type="radio" value="1" name="sale_status" checked="checked"/>
                                            <label class="form-check-label" >
                                                {{__('operating-data.for-sale')}}
                                            </label>
                                        </div>
                                        <div class="form-check form-check-custom form-check-solid me-6">
                                            <input class="form-check-input" type="radio" value="0" name="sale_status"/>
                                            <label class="form-check-label" >
                                                {{__('operating-data.stopped-for-sale')}}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                

                                
                                <div class="card mb-2">
                                    <!--begin::Header-->
                                    <div class="card-header px-0">
                                        <h3 class="card-title align-items-start flex-column">
                                            &nbsp;
                                        </h3>
                                        <div class="card-toolbar">
                                            <a href="javascript:;" class="btn btn-sm btn-secondary copy-table" table="sales-rate-by-adslot-groups">
                                                {{__('operating-data.copy-table')}}</a>
                                        </div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body py-3 pe-0 ps-0">
                                    <!--begin::Table-->
                                        <table 
                                        id="sales-rate-by-adslot-groups"
                                        class="table table-head-custom table-rounded table-bordered text-center">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">
                                                        {{__('operating-data.adslot-groups')}}
                                                    </th>
                                                    <th class="text-center">
                                                        {{__('operating-data.sales-rate')}}
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($channel_groups as $key=>$channel_group)
                                                    @foreach($channel_group->adSlotGroups as $key=>$adslot_group)
                                                    <tr>
                                                        <td>591_全台_{{$channel_group->name}}_{{$adslot_group->name}}</td>
                                                        <td>1.68%</td>
                                                    </tr>
                                                    @endforeach
                                                @endforeach
                                                
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
