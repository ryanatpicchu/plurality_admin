	<!--begin::Modal header-->
	<div class="modal-header">
		<h3 class="modal-title">{{__('ad-management.edit-performance-ad')}}</h3>
		<!--begin::Close-->
		<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
			<i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
		</div>
		<!--end::Close-->
	</div>
	<!--end::Modal header-->
	<!--begin::Modal body-->
	<form id="update_performance_ad_form" class="form" method="POST" action="{{ route('ad-management.update-performance-ad')}}" >
		<input name="update_id" value="{{$performance_ad->id}}" style="display: none;">
	<div class="modal-body pt-0">
		<div class="card">
			<div class="card-body">
				<!--begin::Row-->
				<div class="row">
					<div class="col-4">
						<!--begin::Input group-->
						<div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="fs-6 form-label mt-3">
								<span >{{__('ad-management.channels')}}</span>

							</label>
							<!--end::Label-->
							<!--begin::Select-->
							<select name="channel_id" class="form-select form-select-sm"data-control="select2" data-hide-search="true" >
								@foreach($channels as $key=>$channel)
									<option value="{{$channel->id}}" @if($channel->id == $performance_ad->channel_id) selected @endif>{{$channel->name}}</option>
								@endforeach
							</select>
							<!--end::Select-->
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
							<input type="text" class="form-control  form-control-sm adslot-date" name="start_date" value="{{$performance_ad->start_date}}" >
							<div class="fv-plugins-message-container">
								<div data-field="start_date" data-validator="notEmpty" class="fv-help-block errors start_date_error"></div>
							</div>
						</div>
						<!--end::Input group-->
					</div>
					<div class="col-4">
						<!--begin::Input group-->
						<div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="fs-6 form-label mt-3">
								<span >{{__('ad-management.forsale-end-date')}}</span>
							</label>
							<!--end::Label-->
							<input type="text" class="form-control  form-control-sm adslot-date" name="end_date" value="{{$performance_ad->end_date}}" >
							<div class="fv-plugins-message-container">
								<div data-field="end_date" data-validator="notEmpty" class="fv-help-block errors end_date_error"></div>
							</div>
						</div>
						<!--end::Input group-->
					</div>
				</div>
				<!--end::Row-->
				<!--begin::Row-->
				<div class="row">
					<div class="col-12">
						<!--begin::Input group-->
						<div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="required fs-6 form-label mt-3">
								<span >{{__('ad-management.package-name')}}</span>

							</label>
							<!--end::Label-->
							<input type="text" class="form-control  form-control-sm" name="name" value="{{$performance_ad->name}}">
							<div class="fv-plugins-message-container">
								<div data-field="name" data-validator="notEmpty" class="fv-help-block errors name_error"></div>
							</div>
						</div>
						<!--end::Input group-->
					</div>
				</div>
				
				<div class="row">
					<div class="col-3">
						<!--begin::Input group-->
						<div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="fs-6 form-label mt-3">
								<span >{{__('ad-management.pricing-method')}}</span>
							</label>
							<!--end::Label-->
							<!--begin::Select-->
							<select name="sales_unit" class="form-select form-select-sm"data-control="select2"  data-hide-search="true" >
								@foreach(config('global.general.sales_unit_types') as $key=>$sales_unit)
								<option value="{{$sales_unit}}" @if($sales_unit == $performance_ad->sales_unit) selected @endif>{{$sales_unit}}</option>
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
							<label class="required fs-6 form-label mt-3">
								<span >{{__('ad-management.list-price')}}</span>
							</label>
							<!--end::Label-->
							<input type="text" class="form-control  form-control-sm" name="list_price" value="{{$performance_ad->list_price}}" >
							<div class="fv-plugins-message-container">
								<div data-field="list_price" data-validator="notEmpty" class="fv-help-block errors list_price_error"></div>
							</div>
						</div>
						<!--end::Input group-->
					</div>
					<div class="col-3 d-flex align-items-center">
						<!--begin::Input group-->
						<div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="fs-6 form-label mt-3">
								<span>&nbsp;</span>
							</label>
							<!--end::Label-->
							<div class="form-check mb-0">
								<input class="form-check-input" type="checkbox" value="" id="display_list_price" name="display_list_price" @if($performance_ad->display_list_price) checked @endif/>
								<label class="form-check-label" for="display_list_price">
									{{__('ad-management.display-list-price-on-adslot-name')}}
								</label>
							</div>
						</div>
						<!--end::Input group-->
					</div>
					<div class="col-3 d-flex align-items-center">
						<!--begin::Input group-->
						<div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="fs-6 form-label mt-3">
								<span>&nbsp;</span>
							</label>
							<!--end::Label-->
							<div class="form-check mb-0">
								<input class="form-check-input" type="checkbox" value="" id="list_price_not_be_confirmed" name="list_price_not_be_confirmed" @if($performance_ad->list_price_not_be_confirmed) checked @endif/>
								<label class="form-check-label" for="list_price_not_be_confirmed">
									{{__('ad-management.list-price-not-be-confirmed')}}
								</label>
							</div>
						</div>
						<!--end::Input group-->
					</div>
				</div>
				<!--end::Row-->
				<!--end::Row-->
				<div class="row g-5 g-xl-8">
					<div class="col-xl-12">
						<!--begin::Label-->
						<label class="fs-6 form-label mt-3">
							<span>{{__('ad-management.note')}}</span>
						</label>
						<!--end::Label-->
						<textarea type="text" class="form-control" name="note">{{$performance_ad->note}}</textarea>
						<div class="fv-plugins-message-container">
							<div data-field="note" data-validator="notEmpty" class="fv-help-block errors note_error"></div>
						</div>
					</div>
				</div>
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
		<button type="submit" id="update_performance_ad_submit_button" class="btn btn-light-warning">
			@include('partials.general._button-indicator', ['label' => __('ad-management.confirm')])
			<!--end::Button-->
		</button>
	</div>
	</form>
	<!--end::Modal footer-->
