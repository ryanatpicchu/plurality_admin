<x-base-layout>

    <!--begin::Modal Container-->
    {{ theme()->getView('partials/modals/ad-management/_modify-adslot-start-date-container') }}
    {{ theme()->getView('partials/modals/ad-management/_modify-adslot-end-date-container') }}
    {{ theme()->getView('partials/modals/ad-management/_stop-sale-adslot-container') }}
    {{ theme()->getView('partials/modals/ad-management/_resume-sale-adslot-container') }}
    {{ theme()->getView('partials/modals/ad-management/_create-adslot-container') }}
    {{ theme()->getView('partials/modals/ad-management/_edit-adslot-container') }}
    <!--end::Modal Container-->
    <div class="d-flex flex-column flex-row-fluid">
        <div class="card card-flush mb-2">
            <div class="card-body">
                <div class="d-flex flex-column flex-row-fluid">
                    <!--begin::Row-->
                    <div class="row">
                        <div class="col-3">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 form-label mt-3">
                                    <span >&nbsp;</span>
                                </label>
                                <!--end::Label-->
                                <div class="row">
                                    <div class="col-6 d-flex align-items-center">
                                                    <div class="form-check mb-0">
                                                        <input class="form-check-input" type="checkbox" value="" id="filtered_sale_status">
                                                        <label class="form-check-label" for="filtered_sale_status">
                                                            {{__('ad-management.display-for-sale')}}
                                                        </label>
                                                    </div>
                                                </div>
                                    <div class="col-5 d-flex justify-content-start">
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
                <!--end::Row-->
                <div class="card">
                    <!--begin::Header-->
                    <div class="card-header pt-5 pe-0 ps-0">
                        <h3 class="card-title align-items-start flex-column"></h3>
                        <div class="card-toolbar">
                            <a href="javascript:;" id="modify_adslot_start_date_button" class="btn btn-sm btn-warning me-5" data-bs-toggle="modal" data-bs-target="#modal_modify_adslot_start_date">
                            {{__('ad-management.modify-adslot-start-date')}}</a>
                            <a href="javascript:;" id="modify_adslot_end_date_button" class="btn btn-sm btn-warning me-5" data-bs-toggle="modal" data-bs-target="#modal_modify_adslot_end_date">
                            {{__('ad-management.modify-adslot-end-date')}}</a>
                            <a href="javascript:;" id="create_adslot_button" class="btn btn-sm btn-secondary me-5" data-bs-toggle="modal" data-bs-target="#modal_create_adslot">
                            {{__('ad-management.create-adslot')}}</a>
                        </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body py-3 pe-0 ps-0">
                        <!--begin::Table-->
                        <table class="table table-head-custom table-checkable" id="adslot_group_detail_list_table"></table>
                        <!--end::Table-->        
                    </div>
                    <!--begin::Body-->

                </div>
            </div>
        </div>
    </div>

</div>




</x-base-layout>

