	<!--begin::Modal header-->
	<div class="modal-header">
		<h3 class="modal-title">{{__('ad-management.view-adslot')}}</h3>
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
				<!--begin::Row-->
				<div class="row">
					<div class="col-4">
						<!--begin::Input group-->
						<div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="fs-6 form-label mt-3">
								<span >{{__('ad-management.channel')}}</span>
							</label>
							<!--end::Label-->
							<input type="text" class="form-control form-control-sm" name="" value="{{$adslot->adslotGroup->channelGroup->channel->name}}" disabled />
						</div>
						<!--end::Input group-->
					</div>
					<div class="col-4">
						<!--begin::Input group-->
						<div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="fs-6 form-label mt-3">
								<span >{{__('ad-management.region')}}</span>
							</label>
							<!--end::Label-->
							@if($region!='')
							<input type="text" class="form-control form-control-sm" name="" value="{{ $region->name }}" disabled />
							@else
							<input type="text" class="form-control form-control-sm" name="" value="" disabled />
							@endif
							
						</div>
						<!--end::Input group-->
					</div>
					<div class="col-4">
						<!--begin::Input group-->
						<div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="fs-6 form-label mt-3">
								<span >{{__('ad-management.channel-group')}}</span>
							</label>
							<input type="text" class="form-control form-control-sm" name="" value="{{$adslot->adslotGroup->channelGroup->name}}" disabled />
						</div>
						<!--end::Input group-->
					</div>
				</div>
				<!--end::Row-->
				<!--end::Row-->
				<div class="row g-5 g-xl-8">
					<div class="col-xl-12 mb-7">
						<!--begin::Label-->
						<label class=" fs-6 form-label mt-3">
							<span>{{__('ad-management.adslot-group-name')}}</span>
						</label>
						<!--end::Label-->
						<input type="text" class="form-control form-control-sm" name="" value="{{$adslot->adslotGroup->name}}" disabled />
					</div>
				</div>
				<!--begin::Row-->
				<!--end::Row-->
				<div class="row g-5 g-xl-8">
					<div class="col-xl-12 mb-7">
						<!--begin::Label-->
						<label class=" fs-6 form-label mt-3">
							<span>{{__('ad-management.material-spec')}}</span>
						</label>
						<!--end::Label-->
						<textarea type="text" class="form-control" name="" disabled>{{$adslot->spec}}</textarea>
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
							<select name="repetitions" class="form-select form-select-sm" data-control="select2" data-hide-search="true" disabled>
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
							<select name="display_repetitions" class="form-select form-select-sm"data-control="select2" data-hide-search="true" disabled>
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
							<select name="pricing_method" id="pricing_method" class="form-select form-select-sm" data-control="select2"  data-hide-search="true" disabled>
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
							<label class=" fs-6 form-label mt-3">
								<span >{{__('ad-management.days')}}</span>

							</label>
							<!--end::Label-->
							<input type="text" class="form-control form-control-sm" name="" value="{{$adslot->days}}" disabled />
						</div>
						<!--end::Input group-->
					</div>
					<div class="col-4">
						<!--begin::Input group-->
						<div class="fv-row mb-7">
							<!--begin::Label-->
							<label class=" fs-6 form-label mt-3">
								<span >{{__('ad-management.list-price')}}</span>

							</label>
							<!--end::Label-->
							<input type="text" class="form-control  form-control-sm" name="" value="{{$adslot->list_price}}" disabled/>
							
						</div>
						<!--end::Input group-->
					</div>
					<div class="col-4" id="impressions_section">
						<!--begin::Input group-->
						<div class="fv-row mb-7">
							<!--begin::Label-->
							<label class=" fs-6 form-label mt-3">
								<span >{{__('ad-management.impressions')}}</span>
								
							</label>
							<!--end::Label-->
							<input type="text" class="form-control  form-control-sm" name="" value="{{$adslot->impressions}}" disabled/>
							
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
							<select name="display_type" class="form-select form-select-sm"data-control="select2" data-hide-search="true" disabled>
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
							<select name="profit_share_type" class="form-select form-select-sm"data-control="select2" data-hide-search="true" disabled>
								@foreach($profit_share_types as $key=>$type)
								<option value="{{$type}}" @if($adslot->profit_share_type == $type) selected @endif>{{__('general.profit-share-types_'.$type)}}</option>
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
							<label class=" fs-6 form-label mt-3">
								<span >{{__('ad-management.forsale-start-date')}}</span>
							</label>
							<!--end::Label-->
							<input type="text" class="form-control form-control-sm adslot-date" name="" value="{{$adslot->start_date}}" disabled/>
							
						</div>
						<!--end::Input group-->
					</div>
					<div class="col-2">
						<!--begin::Input group-->
						<div class="fv-row mb-7">
							<!--begin::Label-->
							<label class=" fs-6 form-label mt-3">
								<span >{{__('ad-management.forsale-end-date')}}</span>
							</label>
							<!--end::Label-->
							<input type="text" class="form-control form-control-sm adslot-date" name="" value="{{$adslot->end_date}}" disabled/>
							
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
							<select name="sale_status" class="form-select form-select-sm"data-control="select2"  data-hide-search="true" disabled>
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
							<select name="preview_image_id" class="form-select form-select-sm"data-control="select2" data-hide-search="true" disabled>
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
						<textarea name="" type="text" class="form-control" disabled>{{$adslot->note}}</textarea>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--end::Modal body-->
	<!--begin::Modal footer-->
	<div class="modal-footer flex-center">
		<button type="button" id="" class="btn btn-light-warning" onclick="location.href='/ad-management/adslot-group-detail-list?adslot_group_id={{$adslot->adslot_group_id}}'">
			@include('partials.general._button-indicator', ['label' => __('ad-management.edit')])
			<!--end::Button-->
		</button>
	</div>
	<!--end::Modal footer-->
