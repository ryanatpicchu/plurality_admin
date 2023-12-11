	<!--begin::Modal header-->
	<div class="modal-header">
		<h3 class="modal-title">{{__('ad-management.edit-channel-region')}} : {{$channel->name}}</h3>
		<!--begin::Close-->
		<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
			<i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
		</div>
		<!--end::Close-->
	</div>
	<!--end::Modal header-->
	<!--begin::Modal body-->
	<form id="update_region_form" class="form" method="POST" action="{{ route('ad-management.update-region')}}" >
		<input name="update_id" value="{{$channel->id}}" style="display: none;">
	<div class="modal-body pt-0">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-4 d-flex align-items-center">
						<!--begin::Input group-->
						<div class="fv-row">
							<!--begin::Label-->
							<label class="fs-6 form-label mt-3">
								<span >{{__('ad-management.included-regions')}}</span>
							</label>
							<!--end::Label-->
							<div class="form-check mb-0">
								<input class="form-check-input" type="checkbox" id="region_all" data-kt-check="true" data-kt-check-target=".channel_region" value=""/>
								<label class="form-check-label" for="region_all">
									{{__('ad-management.all-regions')}}
								</label>
							</div>
						</div>
						<!--end::Input group-->
					</div>
				</div>
				<!--end::Row-->
				<div class="separator my-5"></div>

				@php
					$row_count = 0;
				@endphp

				@foreach($regions as $key=>$region)
					@if($row_count == 0)
						<div class="row">
					@endif 
							<div class="col-3 d-flex align-items-center">
								<div class="fv-row mb-7">
									<div class="form-check mb-0">
										<input class="form-check-input channel_region" type="checkbox" name="region[]" value="{{$region->id}}" id="region_{{$region->id}}" @if(in_array($region->id, $related_regions)) checked @endif />
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
	<!--end::Modal body-->
	<!--begin::Modal footer-->
	<div class="modal-footer flex-center">
		
		<button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">
			{{__('ad-management.cancel')}}
		</button>
		<!--end::Button-->
		<!--begin::Button-->
		<button type="button" id="update_region_submit_button" class="btn btn-light-warning">
			@include('partials.general._button-indicator', ['label' => __('ad-management.confirm')])
			<!--end::Button-->
		</button>
	</div>
	<!--end::Modal footer-->
	</form>
