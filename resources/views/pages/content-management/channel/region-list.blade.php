<x-base-layout>

    <!--begin::Modal Container-->
    {{ theme()->getView('partials/modals/ad-management/_create-region-container') }}
    {{ theme()->getView('partials/modals/ad-management/_edit-region-container') }}
    <!--end::Modal Container-->
    <div class="d-flex flex-column flex-row-fluid">
        <div class="card card-flush mb-2">
            <div class="card-body">
                <div class="d-flex flex-column flex-row-fluid">
                    <div class="card">
                        <!--begin::Header-->
                        <div class="card-header pt-5 pe-0 ps-0">
                            <h3 class="card-title align-items-start flex-column"></h3>
                            <div class="card-toolbar">
                                <a href="javascript:;" id="create_region_button" class="btn btn-sm btn-secondary me-5" data-bs-toggle="modal" data-bs-target="#modal_create_region">
                                {{__('ad-management.create-region')}}</a>
                                <a href="javascript:;" id="edit_region_button" class="btn btn-sm btn-secondary me-5" data-bs-toggle="modal" data-bs-target="#modal_edit_region">
                                {{__('ad-management.edit-region')}}</a>
                            </div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body py-3 pe-0 ps-0">
                            <!--begin::Table-->
                            <table class="table table-head-custom" id="channel_region_list_table"></table>
                            <!--end::Table-->        
                        </div>
                        <!--begin::Body-->

                    </div>
            </div>
        </div>
    </div>

</div>




</x-base-layout>
