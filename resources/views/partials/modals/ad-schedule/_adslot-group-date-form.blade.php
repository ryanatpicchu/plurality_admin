	<!--begin::Modal header-->
	<div class="modal-header">
		<h3 class="modal-title">{{__('ad-schedule.confirm-adslot-date-range')}}</h3>
		<!--begin::Close-->
		<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
			<i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
		</div>
		<!--end::Close-->
	</div>
	<!--end::Modal header-->
	<form id="confirm_adslot_date_range" class="form" method="POST" action="{{route('ad-schedule.confirm-adslot-date-range')}}" >
	<!--begin::Modal body-->
	<div class="modal-body pt-0">
		<div class="card">
			<div class="card-header border-0">
				<div class="card-title">
					<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
						<li class="breadcrumb-item">
							{{$region->name}}
						</li>
						<li class="breadcrumb-item">
							<span class="bullet bg-gray-400 w-5px h-2px"></span>
						</li>
						<li class="breadcrumb-item">
							{{$channel_group->name}}
						</li>
						<li class="breadcrumb-item">
							<span class="bullet bg-gray-400 w-5px h-2px"></span>
						</li>
						<li class="breadcrumb-item">
							{{$adslot_group->name}}
						</li>

					</ul>
				</div>
			</div>
			<div class="card-body">
				<div class="row g-5 g-xl-8">
					<div class="col-xl-4">
						<!--begin::Label-->
						<label class="fs-6 fw-semibold mb-2 text-gray-600">
							<span>{{__('ad-schedule.adslot-start-date')}}</span>
						</label>
						<!--end::Label-->
						<!--begin::Input-->
						<input style="display: none;" type="text" class="form-control form-control-sm" name="row" value="{{$row}}" readonly />
						<input style="display: none;" type="text" class="form-control form-control-sm" name="start_date" value="{{$start_date}}" readonly />
						
						<input style="display: none;" type="text" class="form-control form-control-sm" name="region_id" value="{{$region_id}}" readonly />
						<input style="display: none;" type="text" class="form-control form-control-sm" name="channel_group_id" value="{{$channel_group_id}}" readonly />
						<input style="display: none;" type="text" class="form-control form-control-sm" name="adslot_group_id" value="{{$adslot_group_id}}" readonly />
						<div class="text-dark fw-bold fs-6">{{$start_date}}</div>
						<div class="fv-plugins-message-container">
							<div data-field="adslot-start-date" data-validator="notEmpty" class="fv-help-block errors start_date_error"></div>
						</div>
						<!--end::Input-->
					</div>
					<div class="col-xl-4">
						<!--begin::Label-->
						<label class="fs-6 fw-semibold mb-2 text-gray-600">
							<span>{{__('ad-schedule.adslot-end-date')}}</span>
						</label>
						<!--end::Label-->
						<!--begin::Input-->
						<!-- <div class="text-dark fw-bold fs-6">{{$end_date}}</div> -->
						<input style="" type="text" class="adslot-date form-control form-control-sm" name="end_date" value="{{$end_date}}"  />
						<div class="fv-plugins-message-container">
							<div data-field="adslot-end-date" data-validator="notEmpty" class="fv-help-block errors end_date_error"></div>
						</div>
						<!--end::Input-->
					</div>
					<div class="col-xl-4">
						<!--begin::Label-->
						<label class="fs-6 fw-semibold mb-2 text-gray-600">
							<span>{{__('ad-schedule.days')}}</span>
						</label>
						<!--end::Label-->
						
						<div class="text-dark fw-bold fs-6" id="calculated_days">{{$days}}</div>
						<div class="fv-plugins-message-container">
							<div data-field="adslot-start-date" data-validator="notEmpty" class="fv-help-block errors start_date_error"></div>
						</div>
						<!--end::Input-->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--end::Modal body-->
	<!--begin::Modal footer-->
	<div class="modal-footer flex-center">
		<!--begin::Button-->
		<button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">
			{{__('ad-schedule.cancel')}}
		</button>
		<!--end::Button-->
		<!--begin::Button-->
		<button type="button" id="confirm_adslot_date_range_submit_button" class="btn btn-light-warning">
			@include('partials.general._button-indicator', ['label' => __('ad-schedule.set-date-range')])
			<!--end::Button-->
		</button>
	</div>
	<!--end::Modal footer-->
	</form>