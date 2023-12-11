	<!--begin::Modal header-->
	<div class="modal-header">
		<h3 class="modal-title">{{__('ad-management.create-adslot')}} - {{$adslot_group->name}}</h3>
		<!--begin::Close-->
		<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
			<i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
		</div>
		<!--end::Close-->
	</div>
	<!--end::Modal header-->
	<!--begin::Modal body-->
	<form id="temp_store_adslot_form" class="form" method="POST" action="{{ route('ad-management.temp-store-adslot')}}" >
	<div class="modal-body pt-0">
		<div class="card">
			<div class="card-body">
				<!--end::Row-->
				<div class="row g-5 g-xl-8">
					<div class="col-xl-12 mb-7">
						<!--begin::Label-->
						<label class="required fs-6 form-label mt-3">
							<span>{{__('ad-management.material-spec')}}</span>
						</label>
						<!--end::Label-->
						<textarea type="text" class="form-control" name="spec">{{ isset($temp['spec'])?$temp['spec']:'' }}</textarea>
						<div class="fv-plugins-message-container">
							<div data-field="spec" data-validator="notEmpty" class="fv-help-block errors spec_error"></div>
						</div>
					</div>
				</div>
				<!--begin::Row-->
				<!--begin::Row-->
				<div class="row">
					<div class="col-4">
						<!--begin::Input group-->
						<div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="fs-6 form-label mt-3">
								<span >{{__('ad-management.repetitions')}}</span>
							</label>
							<!--end::Label-->
							<!--begin::Select-->
							
							<select name="repetitions" class="form-select form-select-sm"data-control="select2" data-hide-search="true" >
								@foreach(config('global.general.repetitions') as $key=>$repetition)
								<option value="{{$key}}" @if(isset($temp['repetitions']) && $temp['repetitions'] == $key) selected @endif>{{$repetition}}</option>
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
							<label class="fs-6 form-label mt-3">
								<span >{{__('ad-management.display-repetitions')}}</span>
							</label>
							<!--end::Label-->
							<!--begin::Select-->
							<select name="display_repetitions" class="form-select form-select-sm"data-control="select2" data-hide-search="true" >
								@foreach(config('global.general.repetitions') as $key=>$repetition)
								<option value="{{$key}}" @if(isset($temp['display_repetitions']) && $temp['display_repetitions'] == $key) selected @endif>{{$repetition}}</option>
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
							<label class="fs-6 form-label mt-3">
								<span >{{__('ad-management.pricing-method')}}</span>
							</label>
							<!--begin::Select-->
							<select name="pricing_method" id="pricing_method" class="form-select form-select-sm" data-control="select2"  data-hide-search="true" >
								@foreach(config('global.general.pricing_methods') as $key=>$pricing_method)
								<option value="{{$pricing_method}}" @if(isset($temp['pricing_method']) && $temp['pricing_method'] == $pricing_method) selected @endif>{{__('ad-management.'.$pricing_method)}}</option>
								@endforeach
							</select>
							<!--end::Select-->
						</div>
						<!--end::Input group-->
					</div>
				</div>
				<!--end::Row-->
				<!--begin::Row-->
				<div class="row">
					<div class="col-4" id="days_section">
						<!--begin::Input group-->
						<div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="required fs-6 form-label mt-3">
								<span >{{__('ad-management.days')}}</span>

							</label>
							<!--end::Label-->
							<input type="text" class="form-control form-control-sm" name="days" value="{{ isset($temp['days'])?$temp['days']:'' }}" />
							<div class="fv-plugins-message-container">
								<div data-field="days" data-validator="notEmpty" class="fv-help-block errors days_error"></div>
							</div>
						</div>
						<!--end::Input group-->
					</div>
					<div class="col-4" id="impressions_section">
						<!--begin::Input group-->
						<div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="required fs-6 form-label mt-3">
								<span >{{__('ad-management.impressions')}}</span>
								
							</label>
							<!--end::Label-->
							<input type="text" class="form-control  form-control-sm" name="impressions" value="{{ isset($temp['impressions'])?$temp['impressions']:'' }}" />
							<div class="fv-plugins-message-container">
								<div data-field="impressions" data-validator="notEmpty" class="fv-help-block errors impressions_error"></div>
							</div>
						</div>
						<!--end::Input group-->
					</div>
				</div>
				<!--end::Row-->
				<!--begin::Row-->
				<div class="row">
					<div class="col-2">
						<!--begin::Input group-->
						<div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="fs-6 form-label mt-3">
								<span >{{__('ad-management.adslot-display-types')}}</span>
								@php
								$adslot_display_types = config('global.general.adslot_display_types');
								@endphp
							</label>
							<!--end::Label-->
							<!--begin::Select-->
							<select name="display_type" class="form-select form-select-sm"data-control="select2" data-hide-search="true" >
								@foreach($adslot_display_types as $key=>$type)
								<option value="{{$type}}" @if(isset($temp['display_type']) && $temp['display_type'] == $type) selected @endif >{{__('general.adslot-display-types_'.$type)}}</option>
								@endforeach
							</select>
							<!--end::Select-->
						</div>
						<!--end::Input group-->
					</div>
					<div class="col-2">
						<!--begin::Input group-->
						<div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="fs-6 form-label mt-3">
								<span >{{__('ad-management.profit-share-types')}}</span>
								@php
								$profit_share_types = config('global.general.profit_share_types');
								@endphp
							</label>
							<!--end::Label-->
							<!--begin::Select-->
							<select name="profit_share_type" class="form-select form-select-sm"data-control="select2" data-hide-search="true" >
								@foreach($profit_share_types as $key=>$type)
								<option value="{{$type}}" @if(isset($temp['profit_share_type']) && $temp['profit_share_type'] == $type) selected @endif>{{__('general.profit-share-types_'.$type)}}</option>
								@endforeach
							</select>
							<!--end::Select-->
						</div>
						<!--end::Input group-->
					</div>
					<div class="col-2">
						<!--begin::Input group-->
						<div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="fs-6 form-label mt-3">
								<span >{{__('ad-management.sale-status')}}</span>
								@php
								$sale_status = config('global.general.sale_status');
								@endphp
							</label>
							<!--end::Label-->
							<!--begin::Select-->
							<select name="sale_status" class="form-select form-select-sm"data-control="select2"  data-hide-search="true" >
								@foreach($sale_status as $key=>$type)
								<option value="{{$type}}" @if(isset($temp['sale_status']) && $temp['sale_status'] == $type) selected @endif >{{__('general.sale-status_'.$type)}}</option>
								@endforeach
							</select>
							<!--end::Select-->
						</div>
						<!--end::Input group-->
					</div>
				</div>
				<div id="related_package_adslot_groups_section">
				<!--begin::Row-->
				<div class="row">
					<div class="col-8">
						<!--begin::Input group-->
						<div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="fs-6 form-label mt-3">
								<span >{{__('ad-management.required-related-package-adslots')}}</span>

							</label>
							<!--end::Label-->
							<!--begin::Select-->
							<select 
							name="related_package_adslot_group[]" 
							class="form-select form-select-sm related_package_adslot_groups" 
							data-control="select2" 
							data-allow-clear="true"
							>
							</select>
							<!--end::Select-->
						</div>
						<!--end::Input group-->
					</div>
					<div class="col-4">
						<!--begin::Input group-->
						<div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="fs-6 form-label mt-3">
								<span >{{__('ad-management.related-package-types')}}</span>
							</label>
							<!--end::Label-->
							<div class="row">
								<div class="col-8">
									<!--begin::Select-->
									<select 
									name="related_package_type" 
									class="form-select form-select-sm" 
									data-control="select2"  
									data-allow-clear="true"
									>
										@foreach(config('global.general.related-types') as $key=>$related_type)
										<option value="{{$related_type}}">
										{{__('ad-management.related_types_'.$related_type)}}
										</option>
										@endforeach
									</select>
									<!--end::Select-->
								</div>
								<div class="col-4 d-flex justify-content-start">
									<a href="javascript:;" class="btn btn-icon btn-secondary btn-sm me-5" id="add_new_related_package_adslot_group">
										<i class="ki-duotone ki-plus">
											<span class="path1"></span>
											<span class="path2"></span>
											<span class="path3"></span>
										</i>
									</a>
							</div>
						</div>
						</div>
						<!--end::Input group-->
					</div>
				</div>
				<!--end::Row-->
				</div>
				<div id="related_giveaway_adslot_groups_section">
				<!--begin::Row-->
				<div class="row">
					<div class="col-8">
						<!--begin::Input group-->
						<div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="fs-6 form-label mt-3">
								<span >{{__('ad-management.required-related-giveaway-adslots')}}</span>

							</label>
							<!--end::Label-->
							<!--begin::Select-->
							<select 
							name="related_giveaway_adslot_group[]" 
							class="form-select form-select-sm related_giveaway_adslot_groups" 
							data-control="select2" 
							data-allow-clear="true"
							>
							</select>
							<!--end::Select-->
						</div>
						<!--end::Input group-->
					</div>
					<div class="col-4">
						<!--begin::Input group-->
						<div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="fs-6 form-label mt-3">
								<span >{{__('ad-management.related-giveaway-types')}}</span>
							</label>
							<!--end::Label-->
							<div class="row">
								<div class="col-8">
									<!--begin::Select-->
									<select 
									name="related_giveaway_type" 
									class="form-select form-select-sm" 
									data-control="select2"  
									data-allow-clear="true"
									>
										@foreach(config('global.general.related-types') as $key=>$related_type)
										<option value="{{$related_type}}">
										{{__('ad-management.related_types_'.$related_type)}}
										</option>
										@endforeach
									</select>
									<!--end::Select-->
								</div>
								<div class="col-4 d-flex justify-content-start">
									<a href="javascript:;" class="btn btn-icon btn-secondary btn-sm me-5" id="add_new_related_giveaway_adslot_group">
										<i class="ki-duotone ki-plus">
											<span class="path1"></span>
											<span class="path2"></span>
											<span class="path3"></span>
										</i>
									</a>
							</div>
						</div>
						</div>
						<!--end::Input group-->
					</div>
				</div>
				<!--end::Row-->
				</div>
				<!--begin::Row-->
				<div class="row">
					<div class="col-12">
						<!--begin::Input group-->
						<div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="fs-6 form-label mt-3">
								<span >{{__('ad-management.preview-images')}}</span>

							</label>
							<!--end::Label-->
							<!--begin::Select-->
							<select name="preview_image_id" class="form-select form-select-sm"data-control="select2" data-hide-search="true" >
								@foreach($preview_images as $key=>$preview_image)
								<option value="{{$preview_image->id}}" @if(isset($temp['preview_image_id']) && $temp['preview_image_id'] == $preview_image->id) selected @endif >{{$preview_image->name}}</option>
								@endforeach
							</select>
							<!--end::Select-->
						</div>
						<!--end::Input group-->
					</div>
				</div>
				<!--end::Row-->
				<div class="row g-5 g-xl-8">
					<div class="col-xl-12 mb-7">
						<!--begin::Label-->
						<label class="fs-6 form-label mt-3">
							<span>{{__('ad-management.note')}}</span>
						</label>
						<!--end::Label-->
						<textarea name="note" type="text" class="form-control" >{{ isset($temp['note'])?$temp['note']:'' }}</textarea>
					</div>
				</div>
				<div class="row">
					<div class="col-xl-12 mb-7">
						<!--begin::Label-->
						<label class="fs-6 form-label mt-3 required">
							<span>{{__('ad-management.included-regions')}}</span>
						</label>
						<!--end::Label-->
						<div class="fv-plugins-message-container">
							<div data-field="region" data-validator="notEmpty" class="fv-help-block errors region_error"></div>
						</div>
					</div>
				</div>
				
				<div class="row8">
					<div class="row">
						<div class="col-4 d-flex align-items-center">
							<!--begin::Input group-->
							<div class="fv-row">
								<div class="form-check mb-0">
									<input class="form-check-input" type="checkbox" id="region_all" data-kt-check="true" data-kt-check-target=".channel_group_region" value=""/>
									<label class="form-check-label" for="region_all">
										{{__('ad-management.all-regions')}}
									</label>
								</div>
							</div>
							<!--end::Input group-->
						</div>
					</div>
					<div class="separator my-5"></div>
					@php
						$row_count = 0;
					@endphp

					@foreach($available_regions as $key=>$region)
						@if($row_count == 0)
							<div class="row">
						@endif 
								<div class="col-3 d-flex align-items-center">
									<div class="fv-row mb-7">
										<div class="form-check mb-0">
											<input class="form-check-input channel_group_region" type="checkbox" name="region[]" value="{{$region->id}}" id="region_{{$region->id}}" @if(isset($temp['regions']) && in_array($region->id, $temp['regions'])) checked @endif/>
											<label class="form-check-label" for="region_{{$region->id}}">
												{{$region->name}}
											</label>
										</div>
									</div>
								</div>

						@php
							$row_count++;
						@endphp

						@if($row_count == 4)
							</div>
							@php
								$row_count=0;
							@endphp
						@endif 

					@endforeach
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
		<button type="submit" id="temp_store_adslot_submit_button" class="btn btn-light-warning">
			@include('partials.general._button-indicator', ['label' => __('ad-management.next-step')])
			<!--end::Button-->
		</button>
	</div>
</form>
	<!--end::Modal footer-->
