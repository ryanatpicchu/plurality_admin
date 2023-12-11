<x-base-layout>

    <!--begin::Modal Container-->
    {{ theme()->getView('partials/modals/ad-management/_create-adslot-group-container') }}
    {{ theme()->getView('partials/modals/ad-management/_edit-adslot-group-container') }}
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
                                    <span >{{__('ad-management.channels')}}</span>
                                </label>
                                <!--end::Label-->
                                <div class="row">
                                    <div class="col-12">
                                        <select class="form-select form-select-sm"data-control="select2" data-hide-search="true" id="filtered_channel">
                                            <option value="-1">All</option>
                                            @foreach($channels as $key=>$channel)
                                                <option value="{{$channel->id}}">{{$channel->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 form-label mt-3">
                                    <span >{{__('ad-management.channel-groups')}}</span>
                                </label>
                                <!--end::Label-->
                                <div class="row">
                                    <div class="col-8">
                                        <select class="form-select form-select-sm"data-control="select2" data-hide-search="true" id="filtered_channel_group">
                                            <option value="-1">All</option>
                                        </select>
                                    </div>
                                    <div class="col-4 d-flex justify-content-start">
                                        <button 
                                        id="filter_button"
                                        class="btn btn-sm btn-warning me-5"
                                        >
                                        {{__('general.submit-filter')}}
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!--end::Input group-->
                        </div>
                    </div>
                </div>
                <!--end::Row-->
                <div class="card">
                    <!--begin::Header-->
                    <div class="card-header pt-5 pe-0 ps-0">
                        <h3 class="card-title align-items-start flex-column"></h3>
                        <div class="card-toolbar">
                            <a href="javascript:;" id="create_adslot_group_button" class="btn btn-sm btn-secondary me-5" data-bs-toggle="modal" data-bs-target="#modal_create_adslot_group">
                            {{__('ad-management.create-adslot-group')}}</a>
                        </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body py-3 pe-0 ps-0">
                        <!--begin::Table-->
                        <table class="table table-head-custom" id="adslot_group_list_table"></table>
                        <!--end::Table-->        
                    </div>
                    <!--begin::Body-->

                </div>
            </div>
        </div>
    </div>

</div>




</x-base-layout>
