<x-base-layout>

    <!--begin::Modal Container-->
    {{ theme()->getView('partials/modals/performance-management/_list-districts-performance-container') }}
    <!--end::Modal Container-->
    <div class="d-flex flex-column flex-row-fluid">
        <div class="card card-flush mb-2">
            
            <div class="card-body">
                <div class="d-flex flex-column flex-row-fluid">
                   
                    <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6">
                        @php
                            $sales_amount_types = config('global.general.sales_amount_types');
                        @endphp
                        
                        @foreach($sales_amount_types as $key=>$type)
                            <li class="nav-item">
                                <a class="nav-link text-active-primary @if($key==0) active @endif" data-bs-toggle="tab" href="#{{$type}}">
                                    {{__('operating-data.sales-amount-'.$type)}}
                                </a>
                            </li>
                        @endforeach
                        
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="by-regions" role="tabpanel">
                            <div class="d-flex flex-column flex-row-fluid">
                                <!--begin::Row-->
                                <div class="row">
                                    <div class="col-1">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <select id="available_channels" class="form-select form-select-sm" data-dropdown-css-class="w-100px" data-control="select2" data-hide-search="true">
                                                @foreach($available_channels as $key=>$channel)
                                                    <option value="{{$channel->id}}">{{ $channel->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <div class="col-3">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <div id="sales_amount_by_regions_date_range_picker" style="background: #fff; cursor: pointer; padding: 4px 10px; border: 1px solid #ccc; width: 100%; border-radius: 0.425rem; font-weight:500; font-size:1.275rem;">
                                                <i class="fa fa-calendar-days"></i>&nbsp;
                                                <span style="color:#5E6278;"></span> <i class="fa fa-caret-down"></i>
                                            </div>
                                            <input id="adslot_start_date" name="start_date" style="display:none;" />
                                            <input id="adslot_end_date" name="end_date" style="display:none;" />
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <div class="col-3">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <button 
                                                class="btn btn-sm btn-warning position-relative me-5">
                                                {{__('operating-data.confirm')}}
                                            </button>
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
                                            <a href="javascript:;" class="btn btn-sm btn-secondary copy-table" table="table-by-regions">
                                                {{__('performance-management.copy-table')}}</a>
                                        </div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body py-3 pe-0 ps-0">
                                        <table 
                                        id="table-by-regions"
                                        class="table table-rounded table-bordered text-center">
                                            <thead>
                                                <tr class="fw-bold fs-6" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="bg-secondary">{{__('operating-data.subtotal')}}</td>
                                                    @for($i=1; $i<=12; $i++)
                                                        <td class="bg-secondary">888,888</td>
                                                    @endfor
                                                    <td class="bg-secondary text-danger">1,888,888</td>
                                                </tr>
                                                <tr class="fw-bold fs-6" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="bg-secondary">{{__('operating-data.regions')}}</td>
                                                    @for($i=1; $i<=12; $i++)
                                                        <td class="bg-secondary">{{$i.__('operating-data.month')}}</td>
                                                    @endfor
                                                    <td class="bg-secondary text-danger">{{__('operating-data.total')}}</td>
                                                </tr>
                                            </thead>
                                            <tbody style="display:block;height:500px;overflow:auto;">
                                                @foreach($available_regions as $key=>$region)
                                                    <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                        <td class="bg-secondary">591_{{$region->name}}</td>
                                                        @for($i=1; $i<=12; $i++)
                                                            <td>666,888</td>
                                                        @endfor
                                                        <td class="text-danger">1,666,888</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    
                                    </div>
                                    <!--begin::Body-->
                                </div>
                            </div>
                        </div>
                        
                        <div class="tab-pane fade show" id="by-channel-groups" role="tabpanel">
                            <div class="d-flex flex-column flex-row-fluid">
                                <!--begin::Row-->
                                <div class="row">
                                    <div class="col-1">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <select id="available_channels" class="form-select form-select-sm" data-dropdown-css-class="w-100px" data-control="select2" data-hide-search="true">
                                                @foreach($available_channels as $key=>$channel)
                                                    <option value="{{$channel->id}}">{{ $channel->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <div class="col-3">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <div id="sales_amount_by_channel_groups_date_range_picker" style="background: #fff; cursor: pointer; padding: 4px 10px; border: 1px solid #ccc; width: 100%; border-radius: 0.425rem; font-weight:500; font-size:1.275rem;">
                                                <i class="fa fa-calendar-days"></i>&nbsp;
                                                <span style="color:#5E6278;"></span> <i class="fa fa-caret-down"></i>
                                            </div>
                                            <input id="adslot_start_date" name="start_date" style="display:none;" />
                                            <input id="adslot_end_date" name="end_date" style="display:none;" />
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <div class="col-3">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <button 
                                                class="btn btn-sm btn-warning position-relative me-5">
                                                {{__('operating-data.confirm')}}
                                            </button>
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
                                            <a href="javascript:;" class="btn btn-sm btn-secondary copy-table" table="table-by-channel-groups">
                                                {{__('performance-management.copy-table')}}</a>
                                        </div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body py-3 pe-0 ps-0">
                                        <table 
                                        id="table-by-channel-groups"
                                        class="table table-rounded table-bordered text-center">
                                            <thead>
                                                <tr class="fw-bold fs-6" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="bg-secondary">{{__('operating-data.subtotal')}}</td>
                                                    @for($i=1; $i<=12; $i++)
                                                        <td class="bg-secondary">888,888</td>
                                                    @endfor
                                                    <td class="bg-secondary text-danger">1,888,888</td>
                                                </tr>
                                                <tr class="fw-bold fs-6" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="bg-secondary">{{__('operating-data.channel-groups')}}</td>
                                                    @for($i=1; $i<=12; $i++)
                                                        <td class="bg-secondary">{{$i.__('operating-data.month')}}</td>
                                                    @endfor
                                                    <td class="bg-secondary text-danger">{{__('operating-data.total')}}</td>
                                                </tr>
                                            </thead>
                                            <tbody style="display:block;height:500px;overflow:auto;">
                                                @foreach($channel_groups as $key=>$channel_group)

                                                    @foreach($channel_group->relatedRegion as $region_key=>$region)
                                                    <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                        <td class="bg-secondary">591_{{$region->name}}_{{$channel_group->name}}</td>
                                                        @for($i=1; $i<=12; $i++)
                                                            <td>666,888</td>
                                                        @endfor
                                                        <td class="text-danger">1,666,888</td>
                                                    </tr>
                                                    @endforeach
                                                    
                                                @endforeach
                                            </tbody>
                                        </table>
                                    
                                    </div>
                                    <!--begin::Body-->
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade show" id="by-adslot-groups" role="tabpanel">
                            <div class="d-flex flex-column flex-row-fluid">
                                <!--begin::Row-->
                                <div class="row">
                                    
                                    <div class="col-1">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <select id="available_channels" class="form-select form-select-sm" data-dropdown-css-class="w-100px" data-control="select2" data-hide-search="true">
                                                @foreach($available_channels as $key=>$channel)
                                                    <option value="{{$channel->id}}">{{ $channel->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <div class="col-3">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <div id="sales_amount_by_adslot_groups_date_range_picker" style="background: #fff; cursor: pointer; padding: 4px 10px; border: 1px solid #ccc; width: 100%; border-radius: 0.425rem; font-weight:500; font-size:1.275rem;">
                                                <i class="fa fa-calendar-days"></i>&nbsp;
                                                <span style="color:#5E6278;"></span> <i class="fa fa-caret-down"></i>
                                            </div>
                                            <input id="adslot_start_date" name="start_date" style="display:none;" />
                                            <input id="adslot_end_date" name="end_date" style="display:none;" />
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <div class="col-3">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <button 
                                                class="btn btn-sm btn-warning position-relative me-5">
                                                {{__('operating-data.confirm')}}
                                            </button>
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                </div>
                                <!--end::Row-->
                                <!--begin::Row-->
                                <div class="row">
                                    <div class="col-1">
                                        <!--begin::Label-->
                                            <label class="fs-6 form-label mt-3">
                                                <span >{{__('operating-data.regions')}}</span>
                                            </label>
                                        <!--end::Label-->
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <select id="" class="form-select form-select-sm" data-dropdown-css-class="w-100px" data-control="select2" data-hide-search="true">
                                                @foreach($available_channels[0]->relatedRegion as $key=>$region)
                                                    <option value="{{$region->id}}">{{ $region->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <div class="col-2">
                                        <!--begin::Label-->
                                            <label class="fs-6 form-label mt-3">
                                                <span >{{__('operating-data.channel-groups')}}</span>
                                            </label>
                                        <!--end::Label-->
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <select id="" class="form-select form-select-sm" data-control="select2" data-hide-search="true">
                                                @foreach($available_channels[0]->channelGroups as $key=>$channel_group)
                                                    <option value="{{$channel_group->id}}">{{ $channel_group->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <div class="col-3">
                                        <!--begin::Label-->
                                            <label class="fs-6 form-label mt-3">
                                                <span >{{__('operating-data.adslot-groups')}}</span>
                                            </label>
                                        <!--end::Label-->
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <select id="" class="form-select form-select-sm" data-control="select2" data-hide-search="true">
                                                @foreach($available_channels[0]->channelGroups[0]->adSlotGroups as $key=>$adslot_group)
                                                    <option value="{{$adslot_group->id}}">{{ $adslot_group->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <!--begin::Col-->
                                    <div class="col-6">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="fs-6 form-label mt-3">
                                                <span >{{__('operating-data.selected-teams')}}</span>
                                            </label>
                                            <!--end::Label-->
                                            <div class="row">
                                                <div id="sales-amount-filtered_teams" class="col-8" >
                                                    <select 
                                                    name="sales-amount-filtered_teams"
                                                    data-placeholder="{{__('operating-data.team')}}"
                                                    class="form-select form-select-sm" data-control="select2" data-close-on-select="false" data-allow-clear="true" multiple="multiple">
                                                        <option value="1" selected>房產課-北A組</option>
                                                        <option value="2" selected>房產課-北B組</option>
                                                        <option value="3" >房產課-中區組</option>
                                                        <option value="4" >房產課-南區組</option>
                                                    </select>
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
                                            全台 - PC租屋 - 租屋列表頁右側A
                                        </h3>
                                        <div class="card-toolbar">
                                            <a href="javascript:;" class="btn btn-sm btn-secondary copy-table" table="table-by-adslot-groups">
                                                {{__('performance-management.copy-table')}}</a>
                                        </div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body py-3 pe-0 ps-0">
                                        <table 
                                        id="table-by-adslot-groups"
                                        class="table table-rounded table-bordered text-center">
                                            <thead style="display:table;width:100%;table-layout:fixed;">
                                                <tr class="fw-bold fs-6 align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="bg-secondary" colspan="2">{{__('operating-data.subtotal')}}</td>
                                                    @for($i=1; $i<=12; $i++)
                                                        <td class="bg-secondary">666,888</td>
                                                    @endfor
                                                    <td class="bg-secondary text-danger">666,888</td>
                                                </tr>
                                                <tr class="fw-bold fs-6 align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="bg-secondary">{{__('operating-data.team')}}</td>
                                                    <td class="bg-secondary">{{__('operating-data.name')}}</td>
                                                    @for($i=1; $i<=12; $i++)
                                                        <td class="bg-secondary">{{$i.__('operating-data.month')}}</td>
                                                    @endfor
                                                    <td class="bg-secondary text-danger">{{__('operating-data.total')}}</td>
                                                </tr>
                                            </thead>
                                            <tbody style="display:block;height:300px;overflow:auto;">
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="bg-secondary">房產課-北A組</td>
                                                    <td class="bg-secondary">Ryan Hu</td>
                                                    @for($i=1; $i<=12; $i++)
                                                        <td>666,888</td>
                                                    @endfor
                                                    <td class="text-danger">1,666,888</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="bg-secondary">房產課-北A組</td>
                                                    <td class="bg-secondary">Matt Lee</td>
                                                    @for($i=1; $i<=12; $i++)
                                                        <td>666,888</td>
                                                    @endfor
                                                    <td class="text-danger">1,666,888</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="bg-secondary">房產課-北A組</td>
                                                    <td class="bg-secondary">Marco Hu</td>
                                                    @for($i=1; $i<=12; $i++)
                                                        <td>666,888</td>
                                                    @endfor
                                                    <td class="text-danger">1,666,888</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="bg-secondary">房產課-北A組</td>
                                                    <td class="bg-secondary">Joe Cheng</td>
                                                    @for($i=1; $i<=12; $i++)
                                                        <td>666,888</td>
                                                    @endfor
                                                    <td class="text-danger">1,666,888</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="bg-secondary">房產課-北B組</td>
                                                    <td class="bg-secondary">Lily Chen</td>
                                                    @for($i=1; $i<=12; $i++)
                                                        <td>666,888</td>
                                                    @endfor
                                                    <td class="text-danger">1,666,888</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="bg-secondary">房產課-北B組</td>
                                                    <td class="bg-secondary">Noah Yeh</td>
                                                    @for($i=1; $i<=12; $i++)
                                                        <td>666,888</td>
                                                    @endfor
                                                    <td class="text-danger">1,666,888</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="bg-secondary">房產課-北B組</td>
                                                    <td class="bg-secondary">Leroy Fan</td>
                                                    @for($i=1; $i<=12; $i++)
                                                        <td>666,888</td>
                                                    @endfor
                                                    <td class="text-danger">1,666,888</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="bg-secondary">房產課-北B組</td>
                                                    <td class="bg-secondary">Kiki Ho</td>
                                                    @for($i=1; $i<=12; $i++)
                                                        <td>666,888</td>
                                                    @endfor
                                                    <td class="text-danger">1,666,888</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    
                                    </div>
                                    <!--begin::Body-->
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade show" id="by-cities" role="tabpanel">
                            <div class="d-flex flex-column flex-row-fluid">
                                <!--begin::Row-->
                                <div class="row">
                                    <div class="col-3">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <div id="sales_amount_by_cities_date_range_picker" style="background: #fff; cursor: pointer; padding: 4px 10px; border: 1px solid #ccc; width: 100%; border-radius: 0.425rem; font-weight:500; font-size:1.275rem;">
                                                <i class="fa fa-calendar-days"></i>&nbsp;
                                                <span style="color:#5E6278;"></span> <i class="fa fa-caret-down"></i>
                                            </div>
                                            <input id="adslot_start_date" name="start_date" style="display:none;" />
                                            <input id="adslot_end_date" name="end_date" style="display:none;" />
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <div class="col-3">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <button 
                                                class="btn btn-sm btn-warning position-relative me-5">
                                                {{__('operating-data.confirm')}}
                                            </button>
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                </div>
                                <!--end::Row-->
                                <!--begin::Row-->
                                <div class="row">
                                    <!--begin::Col-->
                                    <div class="col-4">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="fs-6 form-label mt-3">
                                                <span >{{__('operating-data.selected-channels')}}</span>
                                            </label>
                                            <!--end::Label-->
                                            <div class="row">
                                                <div id="sales-amount-filtered_channels" class="col-12" >

                                                    <select 
                                                    name="sales-amount-filtered_channels"
                                                    data-placeholder="{{__('operating-data.team')}}"
                                                    class="form-select form-select-sm" data-control="select2" data-close-on-select="false" data-allow-clear="true" multiple="multiple">
                                                        @foreach($available_channels as $key=>$channel)
                                                        <option value="{{$channel->id}}" @if($channel->id == 1) selected @endif >{{$channel->name}}</option>
                                                        @endforeach
                                                    </select>
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
                                            <label class="fs-6 form-label mt-3">
                                                <span >{{__('operating-data.selected-ad-types')}}</span>
                                            </label>
                                            <!--end::Label-->
                                            <div class="row">
                                                <div id="sales-amount-filtered_ad_types" class="col-12" >

                                                    <select 
                                                    name="sales-amount-filtered_ad_types"
                                                    data-placeholder="{{__('operating-data.ad-type')}}"
                                                    class="form-select form-select-sm" data-control="select2" data-close-on-select="false" data-allow-clear="true" multiple="multiple">
                                                        <option value="on-site" selected>{{__('operating-data.on-site')}}</option>
                                                        <option value="remarketing" selected>{{__('operating-data.remarketing')}}</option>
                                                        <option value="digitm" selected>{{__('operating-data.digitm')}}</option>
                                                    </select>
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
                                            <a href="javascript:;" class="btn btn-sm btn-secondary copy-table" table="table-by-cities">
                                                {{__('performance-management.copy-table')}}</a>
                                        </div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body py-3 pe-0 ps-0">
                                        <table 
                                        id="table-by-cities"
                                        class="table table-rounded table-bordered text-center">
                                            <thead style="display:table;width:100%;table-layout:fixed;">
                                                <tr class="fw-bold fs-6 align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="bg-secondary">{{__('operating-data.subtotal')}}</td>
                                                    @for($i=1; $i<=12; $i++)
                                                        <td class="bg-secondary">666,888</td>
                                                    @endfor
                                                    <td class="bg-secondary text-danger">666,888</td>
                                                </tr>
                                                <tr class="fw-bold fs-6" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="bg-secondary">{{__('operating-data.cities')}}</td>
                                                    @for($i=1; $i<=12; $i++)
                                                        <td class="bg-secondary">{{$i.__('operating-data.month')}}</td>
                                                    @endfor
                                                    <td class="bg-secondary text-danger">{{__('operating-data.total')}}</td>
                                                </tr>
                                            </thead>
                                            <tbody style="display:block;height:300px;overflow:auto;">
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    
                                                    <td class="bg-secondary">台北市</td>
                                                    @for($i=1; $i<=12; $i++)
                                                        <td>666,888</td>
                                                    @endfor
                                                    <td class="text-danger">1,666,888</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    
                                                    <td class="bg-secondary">基隆市</td>
                                                    @for($i=1; $i<=12; $i++)
                                                        <td>666,888</td>
                                                    @endfor
                                                    <td class="text-danger">1,666,888</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    
                                                    <td class="bg-secondary">新北市</td>
                                                    @for($i=1; $i<=12; $i++)
                                                        <td>666,888</td>
                                                    @endfor
                                                    <td class="text-danger">1,666,888</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    
                                                    <td class="bg-secondary">高雄市</td>
                                                    @for($i=1; $i<=12; $i++)
                                                        <td>666,888</td>
                                                    @endfor
                                                    <td class="text-danger">1,666,888</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    
                                                    <td class="bg-secondary">台南市</td>
                                                    @for($i=1; $i<=12; $i++)
                                                        <td>666,888</td>
                                                    @endfor
                                                    <td class="text-danger">1,666,888</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    
                                                    <td class="bg-secondary">桃園市</td>
                                                    @for($i=1; $i<=12; $i++)
                                                        <td>666,888</td>
                                                    @endfor
                                                    <td class="text-danger">1,666,888</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    
                                                    <td class="bg-secondary">台中市</td>
                                                    @for($i=1; $i<=12; $i++)
                                                        <td>666,888</td>
                                                    @endfor
                                                    <td class="text-danger">1,666,888</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    
                                    </div>
                                    <!--begin::Body-->
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade show" id="by-insertion-counts" role="tabpanel">
                            <div class="d-flex flex-column flex-row-fluid">
                                <!--begin::Row-->
                                <div class="row">
                                    
                                    <div class="col-1">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <select id="available_channels" class="form-select form-select-sm" data-dropdown-css-class="w-100px" data-control="select2" data-hide-search="true">
                                                @foreach($available_channels as $key=>$channel)
                                                    <option value="{{$channel->id}}">{{ $channel->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <div class="col-3">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <div id="sales_amount_by_adslot_groups_date_range_picker" style="background: #fff; cursor: pointer; padding: 4px 10px; border: 1px solid #ccc; width: 100%; border-radius: 0.425rem; font-weight:500; font-size:1.275rem;">
                                                <i class="fa fa-calendar-days"></i>&nbsp;
                                                <span style="color:#5E6278;"></span> <i class="fa fa-caret-down"></i>
                                            </div>
                                            <input id="adslot_start_date" name="start_date" style="display:none;" />
                                            <input id="adslot_end_date" name="end_date" style="display:none;" />
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <div class="col-3">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <button 
                                                class="btn btn-sm btn-warning position-relative me-5">
                                                {{__('operating-data.confirm')}}
                                            </button>
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                </div>
                                <!--end::Row-->
                                <!--begin::Row-->
                                <div class="row">
                                    <div class="col-12">
                                        <!--begin::Label-->
                                            <label class="fs-6 form-label mt-3">
                                                <span >{{__('operating-data.selected-regions')}}</span>
                                            </label>
                                        <!--end::Label-->
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <div id="sales-amount-filtered_regions" class="col-12" >
                                                <select 
                                                name="sales-amount-filtered_regions"
                                                data-placeholder="{{__('operating-data.regions')}}"
                                                class="form-select form-select-sm" data-control="select2" data-close-on-select="false" data-allow-clear="true" multiple="multiple">
                                                    @foreach($available_channels[0]->relatedRegion as $key=>$region)
                                                        <option value="{{$region->id}}" selected>{{ $region->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <div class="col-2">
                                        <!--begin::Label-->
                                            <label class="fs-6 form-label mt-3">
                                                <span >{{__('operating-data.channel-groups')}}</span>
                                            </label>
                                        <!--end::Label-->
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <select id="" class="form-select form-select-sm" data-control="select2" data-hide-search="true">
                                                @foreach($available_channels[0]->channelGroups as $key=>$channel_group)
                                                    <option value="{{$channel_group->id}}">{{ $channel_group->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <div class="col-3">
                                        <!--begin::Label-->
                                            <label class="fs-6 form-label mt-3">
                                                <span >{{__('operating-data.adslot-groups')}}</span>
                                            </label>
                                        <!--end::Label-->
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <select id="" class="form-select form-select-sm" data-control="select2" data-hide-search="true">
                                                @foreach($available_channels[0]->channelGroups[0]->adSlotGroups as $key=>$adslot_group)
                                                    <option value="{{$adslot_group->id}}">{{ $adslot_group->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <div class="col-2">
                                        <!--begin::Label-->
                                            <label class="fs-6 form-label mt-3">
                                                <span >{{__('operating-data.display-types')}}</span>
                                            </label>
                                        <!--end::Label-->
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <select id="insertion_display_type" class="form-select form-select-sm" data-control="select2" data-hide-search="true">
                                                <option value="summary">總計上刊統計表</option>
                                                <option value="monthly">每月上刊分佈表</option>
                                            </select>
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <div class="col-2">
                                        <!--begin::Label-->
                                            <label class="fs-6 form-label mt-3">
                                                <span >{{__('operating-data.column-value-definition')}}</span>
                                            </label>
                                        <!--end::Label-->
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <select class="form-select form-select-sm" data-control="select2" data-hide-search="true">
                                                <option value="by_product">產品上刊數</option>
                                                <option value="by_customer">客戶上刊數</option>
                                            </select>
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                </div>
                                <!--end::Row-->
                                <div class="card mb-2 display-insertion-counts" id="insertion-counts-summary">
                                    <!--begin::Header-->
                                    <div class="card-header px-0">
                                        <h3 class="card-title align-items-start flex-column">
                                            PC租屋 - 租屋列表頁右側A
                                        </h3>
                                        <div class="card-toolbar">
                                            <a href="javascript:;" class="btn btn-sm btn-secondary copy-table" table="table-by-insertion-counts-summary">
                                                {{__('performance-management.copy-table')}}</a>
                                        </div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body py-3 pe-0 ps-0">
                                        <table 
                                        id="table-by-insertion-counts-summary"
                                        class="table table-rounded table-bordered text-center">
                                            <thead style="display:table;width:100%;table-layout:fixed;">
                                                <tr class="fw-bold fs-6" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="bg-secondary">{{__('operating-data.subtotal')}}</td>
                                                    <td class="bg-secondary">888,888</td>
                                                    <td class="bg-secondary">1,888,888</td>
                                                </tr>
                                                <tr class="fw-bold fs-6" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="bg-secondary">{{__('operating-data.regions')}}</td>
                                                    <td class="bg-secondary">產品上刊數</td>
                                                    <td class="bg-secondary">客戶上刊數</td>
                                                </tr>
                                            </thead>
                                            <tbody style="display:block;height:300px;overflow:auto;">
                                                @foreach($available_channels[0]->relatedRegion as $key=>$region)

                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="bg-secondary">{{$region->name}}</td>
                                                    <td>
                                                    @php 
                                                    $temp = rand(5, 10);
                                                    @endphp
                                                    {{$temp;}}
                                                    </td>
                                                    <td>
                                                    @php 
                                                    $temp = rand(15, 55);
                                                    @endphp
                                                    {{$temp;}}
                                                    </td>
                                                </tr>

                                                @endforeach
                                            </tbody>
                                        </table>
                                    
                                    </div>
                                    <!--begin::Body-->
                                </div>
                                <div class="card mb-2 display-insertion-counts" id="insertion-counts-monthly" style="display:none;" >
                                    <!--begin::Header-->
                                    <div class="card-header px-0">
                                        <h3 class="card-title align-items-start flex-column">
                                            PC租屋 - 租屋列表頁右側A
                                        </h3>
                                        <div class="card-toolbar">
                                            <a href="javascript:;" class="btn btn-sm btn-secondary copy-table" table="table-by-insertion-counts-monthly">
                                                {{__('performance-management.copy-table')}}</a>
                                        </div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body py-3 pe-0 ps-0">
                                        <table 
                                        id="table-by-insertion-counts-monthly"
                                        class="table table-rounded table-bordered text-center">
                                            <thead style="display:table;width:100%;table-layout:fixed;">
                                                <tr class="fw-bold fs-6" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="bg-secondary">{{__('operating-data.subtotal')}}</td>
                                                    @for($i=1; $i<=12; $i++)
                                                        <td class="bg-secondary">888,888</td>
                                                    @endfor
                                                    <td class="bg-secondary text-danger">1,888,888</td>
                                                </tr>
                                                <tr class="fw-bold fs-6" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="bg-secondary">{{__('operating-data.regions')}}</td>
                                                    @for($i=1; $i<=12; $i++)
                                                        <td class="bg-secondary">{{$i.__('operating-data.month')}}</td>
                                                    @endfor
                                                    <td class="bg-secondary text-danger">{{__('operating-data.total')}}</td>
                                                </tr>
                                            </thead>
                                            <tbody style="display:block;height:300px;overflow:auto;">
                                                @foreach($available_channels[0]->relatedRegion as $key=>$region)

                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="bg-secondary">{{$region->name}}</td>
                                                    @php
                                                    $total_counts = 0;
                                                    @endphp
                                                    @for($i=1; $i<=12; $i++)
                                                        <td>
                                                        @php 
                                                        $temp = rand(15, 55);
                                                        $total_counts += $temp;
                                                        @endphp
                                                        {{$temp;}}
                                                        </td>
                                                    @endfor
                                                    <td class="text-danger">
                                                        {{$total_counts}}
                                                    </td>
                                                </tr>

                                                @endforeach
                                            </tbody>
                                        </table>
                                    
                                    </div>
                                    <!--begin::Body-->
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="by-performance-ads" role="tabpanel">
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
                                                &nbsp;
                                            </label>
                                            <!--end::Label-->
                                            <div class="row">
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
                                <!--begin::Row-->
                                <div class="row">
                                    <!--begin::Col-->
                                    <div class="col-4">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="fs-6 form-label mt-3">
                                                <span >{{__('operating-data.selected-channels')}}</span>
                                            </label>
                                            <!--end::Label-->
                                            <div class="row">
                                                <div id="sales-amount-filtered_channels" class="col-12" >

                                                    <select 
                                                    name="sales-amount-filtered_channels"
                                                    data-placeholder="{{__('operating-data.team')}}"
                                                    class="form-select form-select-sm" data-control="select2" data-close-on-select="false" data-allow-clear="true" multiple="multiple">
                                                        @foreach($available_channels as $key=>$channel)
                                                        <option value="{{$channel->id}}" @if($channel->id == 1) selected @endif >{{$channel->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <!--end::Col-->
                                    
                                </div>
                                <!--end::Row-->
                                <div class="row">
                                    <!--begin::Col-->
                                    <div class="col-12">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="fs-6 form-label mt-3">
                                                <span >{{__('operating-data.selected-package-names')}}</span>
                                            </label>
                                            <!--end::Label-->
                                            <div class="row">
                                                <div id="sales-amount-filtered_package_names" class="col-12" >

                                                    <select 
                                                    name="sales-amount-filtered_package_names"
                                                    data-placeholder="{{__('operating-data.package-name')}}"
                                                    class="form-select form-select-sm" data-control="select2" data-close-on-select="false" data-allow-clear="true" multiple="multiple">
                                                        <option value="1" selected>入門方案</option>
                                                        <option value="2" selected>進階方案</option>
                                                        <option value="3" selected>YT進階方案</option>
                                                        <option value="4" selected>精準商用方案</option>
                                                        <option value="5" selected>高階方案</option>
                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="row">
                                    <div class="col-2">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="fs-6 form-label mt-3">
                                                <span >{{__('operating-data.search_type')}}</span>
                                            </label>
                                            <!--end::Label-->
                                            
                                            <!--begin::Select-->
                                            <select 
                                            id="personal-summary-filtered_search_type"
                                            name="filtered_search_type"
                                            class="display_types form-select form-select-sm" data-control="select2" data-hide-search="true">
                                            <option value="sales_performance">銷售業績</option>
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
                                                <span >{{__('operating-data.secondary-metrics')}}</span>
                                            </label>
                                            <!--end::Label-->
                                            
                                            <!--begin::Select-->
                                            <select 
                                            id="personal-summary-filtered_search_type"
                                            name="filtered_search_type"
                                            class="display_types form-select form-select-sm" data-control="select2" data-hide-search="true">
                                            <option value="sales_team">業務團隊</option>
                                            <option value="operation_team">操作團隊</option>
                                            </select>
                                            <!--end::Select-->
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                </div>
                                <div class="row">
                                    <!--begin::Col-->
                                    <div class="col-12">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="fs-6 form-label mt-3">
                                                <span >{{__('operating-data.selected-teams')}}</span>
                                            </label>
                                            <!--end::Label-->
                                            <div class="row">
                                                <div id="sales-amount-filtered_teams" class="col-12" >

                                                    <select 
                                                    name="sales-amount-filtered_teams"
                                                    data-placeholder="{{__('operating-data.team')}}"
                                                    class="form-select form-select-sm" data-control="select2" data-close-on-select="false" data-allow-clear="true" multiple="multiple">
                                                        <option value="team-a" selected>團隊A</option>
                                                        <option value="team-b" >團隊B</option>
                                                        <option value="team-c" >團隊C</option>
                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="row">
                                    <!--begin::Col-->
                                    <div class="col-12">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="fs-6 form-label mt-3">
                                                <span >{{__('operating-data.selected-sales')}}</span>
                                            </label>
                                            <!--end::Label-->
                                            <div class="row">
                                                <div id="sales-amount-filtered_sales" class="col-12" >

                                                    <select 
                                                    name="sales-amount-filtered_sales"
                                                    data-placeholder="{{__('operating-data.sales')}}"
                                                    class="form-select form-select-sm" data-control="select2" data-close-on-select="false" data-allow-clear="true" multiple="multiple">
                                                        <option value="1" selected>Ryan Hu</option>
                                                        <option value="2" selected>Matt Lee</option>
                                                        <option value="3" >Noah Yeh</option>
                                                        <option value="4" >Joe Zeng</option>
                                                        <option value="5" >Leroy Fan</option>
                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="card mb-2">
                                    <!--begin::Header-->
                                    <div class="card-header px-0">
                                        <h3 class="card-title align-items-start flex-column">
                                            &nbsp;
                                        </h3>
                                        <div class="card-toolbar">
                                            <a href="javascript:;" class="btn btn-sm btn-secondary copy-table" table="table-by-performance-ads">
                                                {{__('performance-management.copy-table')}}</a>
                                        </div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body py-3 pe-0 ps-0">
                                        <table 
                                        id="table-by-performance-ads"
                                        class="table table-rounded table-bordered text-center">
                                            <thead style="display:table;width:100%;table-layout:fixed;">
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="bg-secondary" colspan="3">{{__('operating-data.total')}}</td>
                                                    @for($i=1; $i<=12; $i++)
                                                        <td class="bg-secondary">666,888</td>
                                                    @endfor
                                                    <td class="bg-secondary text-danger">1,688,888</td>
                                                </tr>
                                                <tr class="fw-bold fs-6" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="bg-secondary">{{__('operating-data.channels')}}</td>
                                                    <td class="bg-secondary">{{__('operating-data.package-name')}}</td>
                                                    <td class="bg-secondary">{{__('operating-data.secondary-metrics')}}</td>
                                                    @for($i=1; $i<=12; $i++)
                                                        <td class="bg-secondary">{{$i.__('operating-data.month')}}</td>
                                                    @endfor
                                                    <td class="bg-secondary text-danger">{{__('operating-data.subtotal')}}</td>
                                                </tr>
                                            </thead>
                                            <tbody style="display:block;height:300px;overflow:auto;">
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="bg-secondary">591</td>
                                                    <td class="bg-secondary">入門方案</td>
                                                    <td class="bg-secondary">團隊A<br />Ryan Hu</td>
                                                    @for($i=1; $i<=12; $i++)
                                                        <td>6,888</td>
                                                    @endfor
                                                    <td class="text-danger">66,888</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="bg-secondary">591</td>
                                                    <td class="bg-secondary">進階方案</td>
                                                    <td class="bg-secondary">團隊A<br />Ryan Hu</td>
                                                    @for($i=1; $i<=12; $i++)
                                                        <td>6,888</td>
                                                    @endfor
                                                    <td class="text-danger">66,888</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="bg-secondary">591</td>
                                                    <td class="bg-secondary">YT進階方案</td>
                                                    <td class="bg-secondary">團隊A<br />Ryan Hu</td>
                                                    @for($i=1; $i<=12; $i++)
                                                        <td>6,888</td>
                                                    @endfor
                                                    <td class="text-danger">66,888</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="bg-secondary">591</td>
                                                    <td class="bg-secondary">精準商用方案</td>
                                                    <td class="bg-secondary">團隊A<br />Ryan Hu</td>
                                                    @for($i=1; $i<=12; $i++)
                                                        <td>6,888</td>
                                                    @endfor
                                                    <td class="text-danger">66,888</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="bg-secondary">591</td>
                                                    <td class="bg-secondary">高階方案</td>
                                                    <td class="bg-secondary">團隊A<br />Ryan Hu</td>
                                                    @for($i=1; $i<=12; $i++)
                                                        <td>6,888</td>
                                                    @endfor
                                                    <td class="text-danger">66,888</td>
                                                </tr>

                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="bg-secondary">591</td>
                                                    <td class="bg-secondary">入門方案</td>
                                                    <td class="bg-secondary">團隊A<br />Matt Lee</td>
                                                    @for($i=1; $i<=12; $i++)
                                                        <td>6,888</td>
                                                    @endfor
                                                    <td class="text-danger">66,888</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="bg-secondary">591</td>
                                                    <td class="bg-secondary">進階方案</td>
                                                    <td class="bg-secondary">團隊A<br />Matt Lee</td>
                                                    @for($i=1; $i<=12; $i++)
                                                        <td>6,888</td>
                                                    @endfor
                                                    <td class="text-danger">66,888</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="bg-secondary">591</td>
                                                    <td class="bg-secondary">YT進階方案</td>
                                                    <td class="bg-secondary">團隊A<br />Matt Lee</td>
                                                    @for($i=1; $i<=12; $i++)
                                                        <td>6,888</td>
                                                    @endfor
                                                    <td class="text-danger">66,888</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="bg-secondary">591</td>
                                                    <td class="bg-secondary">精準商用方案</td>
                                                    <td class="bg-secondary">團隊A<br />Matt Lee</td>
                                                    @for($i=1; $i<=12; $i++)
                                                        <td>6,888</td>
                                                    @endfor
                                                    <td class="text-danger">66,888</td>
                                                </tr>
                                                <tr class="align-middle" style="display:table;width:100%;table-layout:fixed;">
                                                    <td class="bg-secondary">591</td>
                                                    <td class="bg-secondary">高階方案</td>
                                                    <td class="bg-secondary">團隊A<br />Matt Lee</td>
                                                    @for($i=1; $i<=12; $i++)
                                                        <td>6,888</td>
                                                    @endfor
                                                    <td class="text-danger">66,888</td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    
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
