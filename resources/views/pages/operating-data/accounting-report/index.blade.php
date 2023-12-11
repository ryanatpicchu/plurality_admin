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
                            $accounting_report_types = config('global.general.accounting_report_types');
                        @endphp
                        
                        @foreach($accounting_report_types as $key=>$type)
                            <li class="nav-item">
                                <a class="nav-link text-active-primary @if($key==0) active @endif" data-bs-toggle="tab" href="#{{$type}}">
                                    {{__('operating-data.'.$type)}}
                                </a>
                            </li>
                        @endforeach
                        
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="summary" role="tabpanel">
                            <div class="d-flex flex-column flex-row-fluid">
                                <div class="row">
                                    <div class="col-12">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="fs-6 form-label mt-3">
                                                <span >{{__('operating-data.ads_in_modifing')}}</span>
                                            </label>
                                            <!--end::Label-->
                                            <textarea type="text" class="form-control">D-100-202104-003*  璞沃空間  2023/12/1~2023/12/8  (覆核申請中 2023/3/10 上午 09:56:03)
                                            </textarea>
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-1">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="fs-6 form-label mt-3">
                                                <span >{{__('operating-data.filtered_year')}}</span>
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
                                <div class="card mb-2">
                                    <!--begin::Header-->
                                    <div class="card-header px-0">
                                        <h3 class="card-title align-items-start flex-column">
                                            銷售總表（折扣賣斷）
                                        </h3>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body py-3 pe-0 ps-0">
                                    <!--begin::Table-->
                                        <table 
                                        id="summary"
                                        class="table table-rounded table-bordered text-center">
                                            <thead>
                                                <tr class="fw-bold fs-6">
                                                    <td class="bg-secondary">&nbsp;</td>
                                                    @for($i=1; $i<=12; $i++)
                                                        <td class="bg-secondary">{{$i.__('performance-management.month')}}</td>
                                                    @endfor
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('operating-data.total-list-price')}}</td>
                                                    @for($i=1; $i<=12; $i++)
                                                        <td>1,000,000</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('operating-data.discount')}}</td>
                                                    @for($i=1; $i<=12; $i++)
                                                        <td>90%</td>
                                                    @endfor
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold fs-6 bg-secondary">{{__('operating-data.total-sale-price')}}</td>
                                                    @for($i=1; $i<=12; $i++)
                                                        <td>900,000</td>
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
                                            各站台總銷金額表（折扣賣斷）
                                        </h3>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body py-3 pe-0 ps-0">
                                    <!--begin::Table-->
                                        <table 
                                        id="summary"
                                        class="table table-rounded table-bordered text-center">
                                            <thead>
                                                <tr class="fw-bold fs-6">
                                                    <td class="bg-secondary">&nbsp;</td>
                                                    @for($i=1; $i<=12; $i++)
                                                        <td class="bg-secondary">{{$i.__('performance-management.month')}}</td>
                                                    @endfor
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($available_channels as $key=>$channel)
                                                <tr>
                                                    <td class="fw-bold fs-6 bg-secondary">{{ $channel->name }}</td>
                                                    @for($i=1; $i<=12; $i++)
                                                        <td>1,000,000</td>
                                                    @endfor
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
                        <div class="tab-pane fade show" id="details" role="tabpanel">
                            <div class="d-flex flex-column flex-row-fluid">
                                <div class="row">
                                    <div class="col-1">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="fs-6 form-label mt-3">
                                                <span >{{__('operating-data.channels')}}</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Select-->
                                            <select 
                                            id=""
                                            name=""
                                            class="form-select form-select-sm"data-control="select2" data-hide-search="true">
                                            @foreach($available_channels as $key=>$channel)
                                                <option value="{{$channel->id}}">{{$channel->name}}</option>
                                            @endforeach
                                                
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
                                                <span >{{__('operating-data.insertion-daterange')}}</span>
                                            </label>
                                            <!--end::Label-->
                                            <div id="insertion_date_range_picker" style="background: #fff; cursor: pointer; padding: 4px 10px; border: 1px solid #ccc; width: 100%; border-radius: 0.425rem; font-weight:500; font-size:1.275rem;">
                                                <i class="fa fa-calendar-days"></i>&nbsp;
                                                <span style="color:#5E6278;"></span> <i class="fa fa-caret-down"></i>
                                            </div>
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <div class="col-3">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="fs-6 form-label mt-3">
                                                <span >{{__('operating-data.publish-daterange')}}</span>
                                            </label>
                                            <!--end::Label-->
                                            <div id="publish_date_range_picker" style="background: #fff; cursor: pointer; padding: 4px 10px; border: 1px solid #ccc; width: 100%; border-radius: 0.425rem;font-weight:500; font-size:1.275rem;">
                                                <i class="fa fa-calendar-days"></i>&nbsp;
                                                <span style="color:#5E6278;"></span> <i class="fa fa-caret-down"></i>
                                            </div>
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <!--begin::Col-->
                                    <div class="col-5">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="fs-6 form-label mt-3">
                                                &nbsp;
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
                                    <!--end::Col-->
                                    
                                </div>
                                <div class="card mb-2">
                                    
                                    <!--begin::Body-->
                                    <div class="card-body py-3 pe-0 ps-0">
                                    <!--begin::Table-->
                                        <table 
                                        id="accounting-report-details"
                                        class="table table-head-custom table-checkable dataTable no-footer nowrap">
                                            <thead>
                                                <tr>
                                                    <th>訂單日期</th>
                                                    <th>委刊單編號</th>
                                                    <th>客戶名稱（產品名稱）</th>
                                                    <th>站台</th>
                                                    <th>所在地</th>
                                                    <th>頻道</th>
                                                    <th>廣告版位</th>
                                                    <th>業務</th>
                                                    <th>開始日</th>
                                                    <th>結束日</th>
                                                    <th>定價</th>
                                                    <th>折扣</th>
                                                    <th>總金額</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>2023-02-01</td>
                                                    <td>D-100-20230201-001</td>
                                                    <td>名緯（泓瑞恆昕）</td>
                                                    <td>591</td>
                                                    <td>台北市-信義區</td>
                                                    <td>原生廣告</td>
                                                    <td>行動裝置彈窗廣告</td>
                                                    <td>Ryan Hu</td>
                                                    <td>2023-02-06</td>
                                                    <td>2023-02-12</td>
                                                    <td>118,500</td>
                                                    <td>80%</td>
                                                    <td>118,500</td>
                                                </tr>
                                                <tr>
                                                    <td>2023-02-01</td>
                                                    <td>M-591-202303-129</td>
                                                    <td>麗海廣告（京東VILLA）</td>
                                                    <td>591</td>
                                                    <td>台北市-信義區</td>
                                                    <td>原生廣告</td>
                                                    <td>行動裝置彈窗廣告</td>
                                                    <td>Ryan Hu</td>
                                                    <td>2023-02-06</td>
                                                    <td>2023-02-12</td>
                                                    <td>118,500</td>
                                                    <td>80%</td>
                                                    <td>118,500</td>
                                                </tr>
                                                <tr>
                                                    <td>2023-02-01</td>
                                                    <td>R-591-202303-129</td>
                                                    <td>名緯廣告（大宅豐鼎）</td>
                                                    <td>591</td>
                                                    <td>台北市-信義區</td>
                                                    <td>原生廣告</td>
                                                    <td>行動裝置彈窗廣告</td>
                                                    <td>Ryan Hu</td>
                                                    <td>2023-02-06</td>
                                                    <td>2023-02-12</td>
                                                    <td>118,500</td>
                                                    <td>80%</td>
                                                    <td>118,500</td>
                                                </tr>
                                                <tr>
                                                    <td>2023-02-01</td>
                                                    <td>D-591-202303-071(A)</td>
                                                    <td>新智力廣告(和境建設善捷段案)(特)</td>
                                                    <td>591</td>
                                                    <td>台北市-信義區</td>
                                                    <td>原生廣告</td>
                                                    <td>行動裝置彈窗廣告</td>
                                                    <td>Ryan Hu</td>
                                                    <td>2023-02-06</td>
                                                    <td>2023-02-12</td>
                                                    <td>118,500</td>
                                                    <td>80%</td>
                                                    <td>118,500</td>
                                                </tr>
                                                <tr>
                                                    <td>2023-02-01</td>
                                                    <td>D-591-202303-129</td>
                                                    <td>喬商(寶台建設青埔二期)</td>
                                                    <td>591</td>
                                                    <td>台北市-信義區</td>
                                                    <td>原生廣告</td>
                                                    <td>行動裝置彈窗廣告</td>
                                                    <td>Ryan Hu</td>
                                                    <td>2023-02-06</td>
                                                    <td>2023-02-12</td>
                                                    <td>118,500</td>
                                                    <td>80%</td>
                                                    <td>118,500</td>
                                                </tr>
                                                <tr>
                                                    <td>2023-02-01</td>
                                                    <td>D-591-202303-126*</td>
                                                    <td>喬商(港灣1號院)(特)</td>
                                                    <td>591</td>
                                                    <td>台北市-信義區</td>
                                                    <td>原生廣告</td>
                                                    <td>行動裝置彈窗廣告</td>
                                                    <td>Ryan Hu</td>
                                                    <td>2023-02-06</td>
                                                    <td>2023-02-12</td>
                                                    <td>118,500</td>
                                                    <td>80%</td>
                                                    <td>118,500</td>
                                                </tr>
                                                
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
