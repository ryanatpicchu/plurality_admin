	<!--begin::Modal header-->
	<div class="modal-header">
		<h3 class="modal-title">{{__('ad-management.edit-adslot')}} - {{$adslot->relatedRegion[0]->name}}</h3>
		<!--begin::Close-->
		<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
			<i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
		</div>
		<!--end::Close-->
	</div>
	<!--end::Modal header-->
	<!--begin::Modal body-->
	<form id="update_adslot_form" class="form" method="POST" action="{{ route('ad-management.update-adslot')}}" >
		<input name="update_id" value="{{$adslot->id}}" style="display: none;">
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
						<textarea type="text" class="form-control" name="spec">{{$adslot->spec}}</textarea>
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
								<option value="{{$key}}" @if($adslot->repetitions == $key) selected @endif>{{$repetition}}</option>
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
								<option value="{{$key}}" @if($adslot->display_repetitions == $key) selected @endif >{{$repetition}}</option>
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
								<option value="{{$pricing_method}}" @if($adslot->pricing_method == $pricing_method) selected @endif >{{__('ad-management.'.$pricing_method)}}</option>
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
							<input type="text" class="form-control form-control-sm" name="days" value="{{$adslot->days}}" />
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
							<input type="text" class="form-control  form-control-sm" name="impressions" value="{{$adslot->impressions}}" />
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
								<option value="{{$type}}" @if($adslot->display_type == $type) selected @endif>{{__('general.adslot-display-types_'.$type)}}</option>
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
								<option value="{{$type}}" @if($adslot->profit_share_type == $type) selected @endif>{{__('general.profit-share-types_'.$type)}}</option>
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
								<option value="{{$type}}" @if($adslot->sale_status == $type) selected @endif>{{__('general.sale-status_'.$type)}}</option>
								@endforeach
							</select>
							<!--end::Select-->
						</div>
						<!--end::Input group-->
					</div>
				</div>
				<!--end::Row-->
				<div class="row">
					<div class="col-2">
						<!--begin::Input group-->
						<div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="required fs-6 form-label mt-3">
								<span >{{__('ad-management.forsale-start-date')}}</span>
							</label>
							<!--end::Label-->
							<input type="text" class="form-control form-control-sm adslot-date" name="start_date" value="{{$adslot->start_date}}" />
							<div class="fv-plugins-message-container">
								<div data-field="start_date" data-validator="notEmpty" class="fv-help-block errors start_date_error"></div>
							</div>
						</div>
						<!--end::Input group-->
					</div>
					<div class="col-2">
						<!--begin::Input group-->
						<div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="required fs-6 form-label mt-3">
								<span >{{__('ad-management.forsale-end-date')}}</span>
							</label>
							<!--end::Label-->
							<input type="text" class="form-control form-control-sm adslot-date" name="end_date" value="{{$adslot->end_date}}" />
							<div class="fv-plugins-message-container">
								<div data-field="end_date" data-validator="notEmpty" class="fv-help-block errors end_date_error"></div>
							</div>
						</div>
						<!--end::Input group-->
					</div>
					<div class="col-2">
						<!--begin::Input group-->
						<div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="required fs-6 form-label mt-3">
								<span >{{__('ad-management.list-price')}}</span>

							</label>
							<!--end::Label-->
							<input type="text" class="form-control  form-control-sm" name="list_price" value="{{$adslot->list_price}}" />
							<div class="fv-plugins-message-container">
								<div data-field="list_price" data-validator="notEmpty" class="fv-help-block errors list_price_error"></div>
							</div>
						</div>
						<!--end::Input group-->
					</div>
				</div>
				<!--end::Row-->
				<div id="related_package_adslot_groups_section">
					@if(!empty($related_adslot_groups['package']))
					<!--begin::Row-->
					@php
					$related_package_count = 0;
					@endphp

					@foreach($related_adslot_groups['package']['related_adslot_groups'] as $key=>$related_adslot_group)
						@if($related_package_count == 0)
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
										<option value="{{$key}}">{{$related_adslot_group}}</option>
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
													<option value="{{$related_type}}" @if($related_type == $related_adslot_groups['package']['related_type']) selected @endif>
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
						@else
							<div class="row">
								<div class="col-8">
									<!--begin::Input group-->
									<div class="fv-row mb-7">
										<!--begin::Select-->
										<select 
										name="related_package_adslot_group[]" 
										class="form-select form-select-sm related_package_adslot_groups" 
										data-control="select2" 
										data-allow-clear="true"
										>
										<option value="{{$key}}">{{$related_adslot_group}}</option>
										</select>
										<!--end::Select-->
									</div>
									<!--end::Input group-->
								</div>
							</div>
						@endif
						
						@php
						$related_package_count++;
						@endphp
					@endforeach
					<!--end::Row-->
					@else
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
					@endif
				
				</div>
				<div id="related_giveaway_adslot_groups_section">
					@if(!empty($related_adslot_groups['giveaway']))
					<!--begin::Row-->
					@php
					$related_giveaway_count = 0;
					@endphp

					@foreach($related_adslot_groups['giveaway']['related_adslot_groups'] as $key=>$related_adslot_group)
						@if($related_giveaway_count == 0)
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
										<option value="{{$key}}">{{$related_adslot_group}}</option>
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
													<option value="{{$related_type}}" @if($related_type == $related_adslot_groups['giveaway']['related_type']) selected @endif>
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
						@else
							<div class="row">
								<div class="col-8">
									<!--begin::Input group-->
									<div class="fv-row mb-7">
										<!--begin::Select-->
										<select 
										name="related_giveaway_adslot_group[]" 
										class="form-select form-select-sm related_giveaway_adslot_groups" 
										data-control="select2" 
										data-allow-clear="true"
										>
										<option value="{{$key}}">{{$related_adslot_group}}</option>
										</select>
										<!--end::Select-->
									</div>
									<!--end::Input group-->
								</div>
							</div>
						@endif
						
						@php
						$related_giveaway_count++;
						@endphp
					@endforeach
					<!--end::Row-->
					@else
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
					@endif
				
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
								<option value="{{$preview_image->id}}" @if($adslot->preview_image_id == $preview_image->id) selected @endif>{{$preview_image->name}}</option>
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
						<textarea name="note" type="text" class="form-control" >{{$adslot->note}}</textarea>
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
		<button type="submit" id="update_adslot_submit_button" class="btn btn-light-warning">
			@include('partials.general._button-indicator', ['label' => __('ad-management.confirm')])
			<!--end::Button-->
		</button>
	</div>
	</form>
	<!--end::Modal footer-->
