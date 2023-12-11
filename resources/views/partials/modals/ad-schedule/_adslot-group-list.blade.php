	<!--begin::Modal header-->
	<div class="modal-header">
		<h3 class="modal-title">{{__('ad-schedule.select-adslots')}}</h3>
		<!--begin::Close-->
		<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
			<i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
		</div>
		<!--end::Close-->
	</div>
	<!--end::Modal header-->
	<!--begin::Modal body-->
	<div class="modal-body">
		<div class="row g-5 g-xl-8">
			<div class="col-xl-4">
				<div class="card card-dashed">
                    <div class="card-header border-0 pt-0">
                        <div class="card-title">{{__('ad-schedule.region')}}</div>	
                    </div>	
                    <div class="card-body pt-0 card-scroll h-400px">
                    	<div class="list-group">
                    		@foreach($available_regions as $key=>$region)
	                    		<a 
	                    		channel_id="{{$request_channel_id}}"
	                    		region_id="{{$region->id}}"
	                    		
	                    		href="javascript:;" 
	                    		class="available-regions list-group-item list-group-item-action d-flex justify-content-between align-items-center ">
	                    			{{ $region->name }}
	                    			<span class="badge badge-circle badge-danger ms-auto" style="display: none;"></span>
	                    			<i class="bi bi-chevron-double-right"></i>
	                    		</a>
                    		@endforeach
                    		
                    		<!-- <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center ">
								    台北市
								    <span class="badge badge-circle badge-danger ms-auto">2</span>
								    <i class="bi bi-chevron-double-right"></i>
								  </a>
                    		@foreach(config('global.regions.regions') as $region )
                    			<a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center ">
								    {{$region}}
								    <span class="badge badge-circle badge-danger ms-auto">14</span>
								    <i class="bi bi-chevron-double-right"></i>
								  </a>
                    		@endforeach -->
						</div>
                    </div>
                </div>	
			</div>
			<div class="col-xl-4">
				<div class="card card-dashed">
                    <div class="card-header border-0 pt-0">
                        <div class="card-title">{{__('ad-schedule.channel')}}</div>	
                    </div>	
                    <div id="channel_groups_list_group" class="card-body pt-0 card-scroll h-400px"></div>
                </div>	
			</div>
			<div class="col-xl-4">
				<div class="card card-dashed">
                    <div class="card-header border-0 pt-0">
                        <div class="card-title">{{__('ad-schedule.adslot')}}</div>	
                    </div>	
                    <div id="adslot_groups_list_group" class="card-body pt-0 card-scroll h-400px"></div>
                </div>	
			</div>
		</div>
	</div>
	<!--end::Modal body-->
	<!--begin::Modal footer-->
	<div class="modal-footer flex-center">
		<!--begin::Button-->
		<button type="reset" id="cancel_select_adslot_groups" class="btn btn-light me-3" data-bs-dismiss="modal">
			{{__('ad-schedule.cancel')}}
		</button>
		<!--end::Button-->
		<!--begin::Button-->
		<button type="submit" id="confirm_select_adslot_groups" class="btn btn-light-warning">
			@include('partials.general._button-indicator', ['label' => __('ad-schedule.confirm')])
			<!--end::Button-->
		</button>
	</div>
	<!--end::Modal footer-->
