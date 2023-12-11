	<!--begin::Modal header-->
	<div class="modal-header">
		<h3 class="modal-title">{{__('ad-schedule.delete-adslots')}}</h3>
		<!--begin::Close-->
		<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
			<i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
		</div>
		<!--end::Close-->
	</div>
	<!--end::Modal header-->
	<!--begin::Modal body-->
	<form id="confirm_delete_agent_adslot" class="form" method="POST" action="{{route('ad-schedule.delete-agent-adslot')}}" >
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />
	<div class="modal-body pt-0">
		<div class="card">
			<div class="card-header border-0">
		        <h3 class="card-title text-danger">{{__('ad-schedule.are-you-sure-to-delete-adslots')}}</h3>
		    </div>
			<div class="card-body pt-0">
				<div class="table-responsive">
					<table class="table table-rounded table-striped border gy-7 gs-7">
						<thead>
							<tr class="fw-bold fs-6 text-gray-800">
								<th>#</th>
								<th>{{__('ad-schedule.adslot')}}</th>
								<th>{{__('ad-schedule.adslot-start-date')}}</th>
								<th>{{__('ad-schedule.adslot-end-date')}}</th>
							</tr>
						</thead>
						<tbody>
							@php
								$index_count = 1;
							@endphp
							@foreach($selected_adslot as $adslot_key=>$adslot)
								@foreach($adslot['info'] as $info_key=>$adslot)
								
								<tr>
									<td>{{$index_count}}</td>
									@php
									
									$index_count++;
									@endphp

									<td>
										<div class="flex">
											<div>
												<span class="me-5">{{$adslot['channel']}}</span>
												<span class="me-5">{{$adslot['region']}}</span>
											</div>
											<div>
												<span class="me-5">{{$adslot['ad']}}</span>
											</div>
										</div>
									</td>
									<td>
										<div class="flex">
											@foreach($adslot['dateRanges'] as $key=>$dates)
												<div>{{ $dates[array_key_first($dates)] }}</div>	
											@endforeach
										</div>
									</td>
									<td>
										<div class="flex">
											@foreach($adslot['dateRanges'] as $key=>$dates)
												<div>{{ $dates[array_key_last($dates)] }}</div>	
											@endforeach
										</div>
									</td>
								</tr>
								@endforeach
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!--end::Modal body-->
	<!--begin::Modal footer-->
	<div class="modal-footer flex-center">
		<button type="reset" id="" class="btn btn-light me-3" data-bs-dismiss="modal">
			{{__('ad-schedule.cancel')}}
		</button>
		<!--begin::Button-->
		<button type="button" id="delete_agent_adslot_submit_button" class="btn btn-danger">
			{{__('ad-schedule.confirm')}}
		</button>
		<!--end::Button-->
		
	</div>
	</form>
		<!--end::Modal footer-->
