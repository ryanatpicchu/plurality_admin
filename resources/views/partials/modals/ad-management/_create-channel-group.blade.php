	<!--begin::Modal header-->
	<div class="modal-header">
		<h3 class="modal-title">{{__('ad-management.create-channel-group')}}</h3>
		<!--begin::Close-->
		<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
			<i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
		</div>
		<!--end::Close-->
	</div>
	<!--end::Modal header-->
	<!--begin::Modal body-->
	<form id="store_channel_group_form" class="form" method="POST" action="{{ route('ad-management.store-channel-group')}}" >
	<div class="modal-body pt-0">
		<div class="card">
			<div class="card-body">
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
							<select name="channel_id" class="form-select form-select-sm" data-control="select2"  data-hide-search="true" >
								@foreach($channels as $key=>$channel)
									<option value="{{$channel->id}}" @if($channel->id == $designate_channel) selected @endif>{{$channel->name}}</option>
								@endforeach
							</select>
							<!--end::Select-->
						</div>
						<!--end::Input group-->
					</div>
					<div class="col-6">
						<!--begin::Input group-->
						<div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="fs-6 form-label mt-3">
								<span >{{__('ad-management.channel-group-name')}}</span>
							</label>
							<!--end::Label-->
							<input type="text" class="form-control form-control-sm" name="name" value="" >
							<div class="fv-plugins-message-container">
								<div data-field="name" data-validator="notEmpty" class="fv-help-block errors name_error"></div>
							</div>
						</div>
						<!--end::Input group-->
					</div>
					<div class="col-2 d-flex align-items-center">
						<!--begin::Input group-->
						<div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="fs-6 form-label mt-3">
								<span >{{__('ad-management.channel-group-type')}}</span>
							</label>
							<!--end::Label-->
							<!--begin::Select-->
							<select name="type" class="form-select form-select-sm"data-control="select2" data-hide-search="true" >
								@foreach(config('global.general.channel_group_types') as $key=>$type)
								<option value="{{$type}}">{{__('general.channel-group-types_'.$type)}}</option>
								@endforeach
								
							</select>
							<!--end::Select-->
						</div>
						<!--end::Input group-->
					</div>
				</div>
				<!--end::Row-->
				<div class="row">
					<div class="col-4 d-flex align-items-center">
						<!--begin::Input group-->
						<div class="fv-row mb-7">
							<!--begin::Label-->
							<div class="form-check mb-0">
								<input class="form-check-input" type="checkbox" value="" name="not_display_in_menu" id="not_display_in_menu">
								<label class="form-check-label" for="not_display_in_menu">
									{{__('ad-management.not-display-in-menu')}}
								</label>
							</div>
						</div>
						<!--end::Input group-->
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
		<button type="submit" id="store_channel_group_submit_button" class="btn btn-light-warning">
			@include('partials.general._button-indicator', ['label' => __('ad-management.confirm')])
			<!--end::Button-->
		</button>
	</div>
	</form>
	<!--end::Modal footer-->
