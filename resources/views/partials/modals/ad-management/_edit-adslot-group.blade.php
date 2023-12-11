	<!--begin::Modal header-->
	<div class="modal-header">
		<h3 class="modal-title">{{__('ad-management.edit-adslot-group')}}</h3>
		<!--begin::Close-->
		<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
			<i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
		</div>
		<!--end::Close-->
	</div>
	<!--end::Modal header-->
	<!--begin::Modal body-->
	<form id="update_adslot_group_form" class="form" method="POST" action="{{ route('ad-management.update-adslot-group')}}" >
		<input name="update_id" value="{{$update_id}}" style="display: none;">
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
							<select name="channel_id" class="form-select form-select-sm" data-control="select2"  data-hide-search="true" disabled>
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
								<span >{{__('ad-management.channel-groups')}}</span>
							</label>
							<!--end::Label-->
							<!--begin::Select-->
							<select name="channel_group_id" class="form-select form-select-sm" data-control="select2"  data-hide-search="true" disabled>
								@foreach($channel_groups as $key=>$channel_group)
									<option value="{{$channel_group->id}}" @if($channel_group->id == $designate_channel_group) selected @endif>{{$channel_group->name}}</option>
								@endforeach
							</select>
							<!--end::Select-->
						</div>
						<!--end::Input group-->
					</div>
				</div>
				<!--end::Row-->
				<div class="row">
					<div class="col-8">
						<!--begin::Input group-->
						<div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="fs-6 form-label mt-3 required">
								<span >{{__('ad-management.adslot-group-name')}}</span>
							</label>
							<!--end::Label-->
							<input type="text" class="form-control form-control-sm" name="name" value="{{$record->name}}" >
							<div class="fv-plugins-message-container">
								<div data-field="name" data-validator="notEmpty" class="fv-help-block errors name_error"></div>
							</div>
						</div>
						<!--end::Input group-->
					</div>
					<div class="col-4">
						<!--begin::Input group-->
						<div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="fs-6 form-label mt-3">
								<span >{{__('ad-management.encode')}}</span>
							</label>
							<!--end::Label-->
							<input type="text" class="form-control form-control-sm" name="code" value="{{$record->code}}" >
							<div class="fv-plugins-message-container">
								<div data-field="code" data-validator="notEmpty" class="fv-help-block errors code_error"></div>
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
		<button type="submit" id="update_adslot_group_submit_button" class="btn btn-light-warning">
			@include('partials.general._button-indicator', ['label' => __('ad-management.confirm')])
			<!--end::Button-->
		</button>
	</div>
	</form>
	<!--end::Modal footer-->
