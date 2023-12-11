	<!--begin::Modal header-->
	<div class="modal-header">
		<h3 class="modal-title">{{__('ad-management.create-adslot')}} - {{__('ad-management.region-settings')}}</h3>
		<!--begin::Close-->
		<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
			<i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
		</div>
		<!--end::Close-->
	</div>
	<!--end::Modal header-->
	<!--begin::Modal body-->
	<form id="store_adslot_form" class="form" method="POST" action="{{ route('ad-management.store-adslot')}}" >
	<div class="modal-body pt-0">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-12 align-items-center">
						@php
						$row_count=0;
						@endphp
						@foreach($available_regions as $key=>$region)
							@if(in_array($region->id, $temp['regions']))
									<div class="fv-row">
										<!--begin::Label-->
										<label class="fs-6 form-label mt-3">
											<span >{{ $region->name; }}</span>
											<input name="region_id[]"  value="{{$region->id}}" style="display: none;" />
										</label>
										<!--end::Label-->
										<!--begin::Row-->
										<div class="row">
											<div class="col-4">
												<!--begin::Input group-->
												<div class="fv-row mb-7">
													<!--begin::Label-->
													<label class="required fs-6 form-label mt-3">
														<span >{{__('ad-management.list-price')}}</span>

													</label>
													<!--end::Label-->
													<input id="list_price.{{$row_count}}" type="text" class="form-control  form-control-sm" name="list_price[]" value="" />
													<div class="fv-plugins-message-container">
														<div id="list_price.{{$row_count}}_error" data-field="list_price" data-validator="notEmpty" class="fv-help-block errors list_price_error"></div>
													</div>
												</div>
												<!--end::Input group-->
											</div>
											<div class="col-4">
												<!--begin::Input group-->
												<div class="fv-row mb-7">
													<!--begin::Label-->
													<label class="required fs-6 form-label mt-3">
														<span >{{__('ad-management.forsale-start-date')}}</span>
													</label>
													<!--end::Label-->
													<input id="start_date.{{$row_count}}" type="text" class="form-control form-control-sm adslot-date" name="start_date[]" value="" />
													<div class="fv-plugins-message-container">
														<div id="start_date.{{$row_count}}_error" data-field="start_date" data-validator="notEmpty" class="fv-help-block errors start_date_error"></div>
													</div>
												</div>
												<!--end::Input group-->
											</div>
											<div class="col-4">
												<!--begin::Input group-->
												<div class="fv-row mb-7">
													<!--begin::Label-->
													<label class="required fs-6 form-label mt-3">
														<span >{{__('ad-management.forsale-end-date')}}</span>
													</label>
													<!--end::Label-->
													<input id="end_date.{{$row_count}}" type="text" class="form-control form-control-sm adslot-date" name="end_date[]" value="" />
													<div class="fv-plugins-message-container">
														<div id="end_date.{{$row_count}}_error" data-field="end_date" data-validator="notEmpty" class="fv-help-block errors end_date_error"></div>
													</div>
												</div>
												<!--end::Input group-->
											</div>
										</div>
										<!--end::Row-->
									</div>
								

								@php
								$row_count++;
								@endphp
							@endif
						@endforeach
						
					</div>
				</div>
				<!--end::Row-->
				
			</div>
		</div>
	</div>
	<!--end::Modal body-->
	<!--begin::Modal footer-->
	<div class="modal-footer flex-center">
		<button type="button" id="go_back_button" class="btn btn-light">
			@include('partials.general._button-indicator', ['label' => __('ad-management.go-back')])
			<!--end::Button-->
		</button>
		<!--end::Button-->
		<!--begin::Button-->
		<button type="submit" id="store_adslot_submit_button" class="btn btn-light-warning">
			@include('partials.general._button-indicator', ['label' => __('ad-management.confirm')])
			<!--end::Button-->
		</button>
	</div>
</form>
	<!--end::Modal footer-->
