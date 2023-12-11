<x-base-layout>
    @if (session('save_insertion_message') === 'turn_to_standby_success')
    <script>alert('{{ trans('ad-schedule.turn_to_standby_success') }}')</script>
    @elseif (session('save_insertion_message') === 'turn_to_standby_failed')
    <script>alert('{{ trans('ad-schedule.turn_to_standby_failed') }}')</script>
    @endif
    
    <!--begin::Modal Container-->
    {{ theme()->getView('partials/modals/ad-schedule/_subtotal-sale-price-container') }}
    {{ theme()->getView('partials/modals/ad-schedule/_delete-adslots-container') }}
    {{ theme()->getView('partials/modals/ad-schedule/_delete-insertion-container') }}
    <!--end::Modal Container-->
    <div class="d-flex flex-column flex-row-fluid">
        <div class="card card-flush mb-2">
            <div class="card-body">
                <div class="d-flex flex-column flex-row-fluid">
                    <!--begin::Row-->
                    <div class="row">
                        <!--begin::Col-->
                        <div class="col-6">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 form-label mt-3">
                                    <span >{{__('general.filter-sales')}}</span>
                                </label>
                                <!--end::Label-->
                                <div class="row">
                                    <div class="col-6">
                                        <select class="form-select form-select-sm form-select-solid" data-control="select2" data-close-on-select="false" data-placeholder="{{__('general.please-choose')}}" data-allow-clear="true" multiple="multiple">
                                            <option></option>
                                            <option value="1">Ryan Hu</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <button 
                                        class="btn btn-sm btn-warning me-5"
                                        >
                                        {{__('general.submit-filter')}}
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Col-->
                        
                    </div>
                    <!--end::Row-->
                    
                    <div class="row">
                        <!--begin::Table-->
                
                        <table class="table table-head-custom align-middle" id="ad_list_table"></table>
                        <!--end::Table-->
                        
                    </div>
                </div>
            </div>
        </div>
    </div>




</x-base-layout>
