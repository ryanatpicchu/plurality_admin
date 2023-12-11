	<!--begin::Modal header-->
	<div class="modal-header">
		<h3 class="modal-title">{{__('ad-management.stop-sale-adslot')}}</h3>
		<!--begin::Close-->
		<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
			<i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
		</div>
		<!--end::Close-->
	</div>
	<!--end::Modal header-->
	<!--begin::Modal body-->
	<form id="update_adslot_status_form_modal_stop_sale_adslot" class="form" method="POST" action="{{ route('ad-management.update-adslot-status')}}" >
		<input name="update_id" value="{{$adslot->id}}" style="display: none;">
		<input name="sale_status" value="0" style="display: none;">
	<div class="modal-body pt-0">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-12 d-flex justify-content-center">
						<!--begin::Input group-->
						<div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="fs-6 form-label mt-3">
								<span >{{__('ad-management.are-you-sure-to-stop-sale')}}</span>
							</label>
							<!--end::Label-->
							<h3>{{$adslot->adslotGroup->channelGroup->channel->name}} - {{$adslot->adslotGroup->channelGroup->name}} - {{$adslot->adslotGroup->name;}}</h3>
							<div class="fs-6 text-gray-700 pe-7">
								 {!! nl2br($adslot->spec); !!}
							</div>
						</div>
						<!--end::Input group-->
					</div>
				</div>
				<!--end::Row-->
			</div>
		</div>
	</div>
	<!--end::Modal body-->
	<!--begin::Modal footer-->
	<div class="modal-footer flex-center">
		
		<button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">
			{{__('ad-management.cancel')}}
		</button>
		<!--end::Button-->
		<!--begin::Button-->
		<button type="button" id="change_adslot_status_submit_button_modal_stop_sale_adslot" class="btn btn-light-warning">
			@include('partials.general._button-indicator', ['label' => __('ad-management.confirm')])
			<!--end::Button-->
		</button>
		
	</div>
	<!--end::Modal footer-->
	</form>
