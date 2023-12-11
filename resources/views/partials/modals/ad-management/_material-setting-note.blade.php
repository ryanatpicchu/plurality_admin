	<!--begin::Modal header-->
	<div class="modal-header">
		<h3 class="modal-title">{{__('ad-management.setting-status-note')}}</h3>
		<!--begin::Close-->
		<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
			<i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
		</div>
		<!--end::Close-->
	</div>
	<!--end::Modal header-->
	<!--begin::Modal body-->
	<div class="modal-body pt-0">
		<div class="card">
			<div class="card-body">
				<div class="row g-5 g-xl-8">
					<div class="col-xl-12">
						<!--begin::Label-->
						<label class="fs-6 fw-semibold mb-2 text-gray-600">
							<span>{{__('ad-management.note')}}</span>
						</label>
						<!--end::Label-->
						<textarea type="text" class="form-control"></textarea>
					</div>
				</div>
				<div class="row mt-5">
					<div class='col-3'>
						<div class="form-check align-items-center">
							<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
							<label class="form-check-label" for="flexCheckDefault">
								{{__('ad-management.multi-real-estate-property')}}
							</label>
						</div>
					</div>
					<div class='col-3'>
						<div class="form-check align-items-center">
							<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
							<label class="form-check-label" for="flexCheckDefault">
								{{__('ad-management.multi-material')}}
							</label>
						</div>
					</div>
					<div class='col-6 d-flex justify-content-end'>
						<div class="form-check align-items-center">
							<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
							<label class="form-check-label" for="flexCheckDefault">
								{{__('ad-management.all-setted')}}
							</label>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
	<!--end::Modal body-->
	<!--begin::Modal footer-->
	<div class="modal-footer flex-center">
		<!--begin::Button-->
		<button type="reset" id="kt_modal_add_address_cancel" class="btn btn-light me-3" data-bs-dismiss="modal">
			{{__('ad-schedule.cancel')}}
		</button>
		<!--end::Button-->
		<!--begin::Button-->
		<button type="submit" id="kt_modal_add_address_submit" class="btn btn-light-warning">
			@include('partials.general._button-indicator', ['label' => __('ad-schedule.set-date-range')])
			<!--end::Button-->
		</button>
	</div>
	<!--end::Modal footer-->
