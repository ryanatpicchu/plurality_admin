@php
function get_chinese_weekday($datetime)
{
    $weekday  = date('w', strtotime($datetime));
    $weeklist = array('日', '一', '二', '三', '四', '五', '六');
    return $weeklist[$weekday];
}

@endphp
<x-base-layout>

    <!--begin::Modal Container-->
    {{ theme()->getView('partials/modals/ad-schedule/_adslot-group-list-container') }}
    {{ theme()->getView('partials/modals/ad-schedule/_package-list-container') }}
    {{ theme()->getView('partials/modals/ad-schedule/_confirm-adslot-groups-container') }}
    {{ theme()->getView('partials/modals/ad-schedule/_set-adslot-date-container') }}
    <!--end::Modal Container-->
    <div class="d-flex flex-column flex-row-fluid">
        <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6">
            <li class="nav-item">
                <a class="nav-link text-active-primary active" data-bs-toggle="tab" href="#adslot">{{__('ad-schedule.booking-adslot')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-active-primary" href="{{route('ad-schedule.edit')}}#remarketing">{{__('ad-schedule.booking-remarketing-and-agent')}}</a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="adslot" role="tabpanel">
                <div class="card card-flush bg-light shadow-sm">
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
                                <button 
                                id="select_adslot_groups_button" 
                                class="btn btn-sm btn-secondary position-relative me-5"
                                data-bs-toggle="modal" 
                                data-bs-target="#modal_select_adslot_groups"
                                >
                                {{__('general.choose-adslots')}}
                                <span style="display:none;" class="position-absolute top-0 start-100 translate-middle  badge badge-circle badge-danger"></span>
                                </button>
                                <!-- <button 
                                id="select_packages_button" 
                                class="btn btn-sm btn-secondary position-relative me-5"
                                data-bs-toggle="modal" 
                                data-bs-target="#modal_select_packages"
                                >
                                    {{__('general.choose-packages')}}
                                    <span class="position-absolute top-0 start-100 translate-middle  badge badge-circle badge-danger">2</span>
                                </button> -->
                            </div>
                            <div class="me-6">
                                <div id="date_range_picker" style="background: #fff; cursor: pointer; padding: 4px 10px; border: 1px solid #ccc; width: 100%; border-radius: 0.425rem;">
                                    <i class="fa fa-calendar-days"></i>&nbsp;
                                    <span style="color:#5E6278;"></span> <i class="fa fa-caret-down"></i>
                                </div>
                                <input id="adslot_start_date" name="start_date" style="display:none;" />
                                <input id="adslot_end_date" name="end_date" style="display:none;" />
                            </div>
                        </div>
                        <div class="card-toolbar">
                            <div>
                                <button 
                                id="search_adslot" 
                                data-bs-toggle="modal" 
                                data-bs-target="#modal_select_adslot_groups"
                                class="btn btn-sm btn-warning position-relative me-5">
                                    {{__('ad-schedule.search-adslot')}}
                                </button>
                                <button 
                                id="confirm_adslot_groups_button"
                                class="btn btn-sm btn-success position-relative"
                                data-bs-toggle="modal"
                                data-bs-target="#modal_confirm_adslot_groups"
                                style="display:none;" 
                                >
                                    {{__('ad-schedule.confirm-adslots')}}
                                </button>
                            </div>
                        </div>
            </div>
            <div class="card-body">
                <div class="d-flex flex-row-fluid mb-10">
                    <span class="badge badge-square badge-approved me-5">已覆核</span>
                    <span class="badge badge-square badge-onreview me-5 ">覆核申請中/異動審核中</span>
                    <span class="badge badge-square badge-rejected me-5 ">覆核駁回/異動審核駁回</span>
                    <span class="badge badge-square badge-draft border-dashed me-5 ">草稿</span>
                    <span class="badge badge-square badge-standby me-5 ">standby</span>
                    <span class="badge badge-square badge-standby_setted me-5 ">standby已建委刊單 </span>
                    <span class="badge badge-square badge-available me-5 ">可選版位 </span>
                    <span class="badge badge-square badge-selected me-5 ">已選版位 </span>
                </div>
                <div class="d-flex flex-column flex-row-fluid" id="adslot_groups_container" style=""></div>
            </div>
        </div>
            </div>
            <div class="tab-pane fade" id="remarketing_and_agent" role="tabpanel">
                ...
            </div>
        </div>
    </div>




</x-base-layout>
