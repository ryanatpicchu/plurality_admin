	<!--begin::Modal header-->
	<div class="modal-header">
		<h3 class="modal-title">{{__('ad-schedule.confirm-adslot-groups')}}</h3>
		<!--begin::Close-->
		<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
			<i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
		</div>
		<!--end::Close-->
	</div>
	<!--end::Modal header-->
	<!--begin::Modal body-->
	<form id="go_edit_insertion_form" class="form" method="POST" action="{{route('ad-schedule.go-edit-insertion')}}" >
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />
	<div class="modal-body pt-0">
		<div class="card">
			<div class="card-body">
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
							 $index = 1;
							@endphp
							@foreach($adslot_groups as $key=>$adslot_group)
								<tr>
									<td>{{$index}}</td>
									<td>
										<div class="flex">
											<div>
												<span class="me-5">{{ $adslot_group['info']['channel'] }}</span>
												<span class="me-5">{{ $adslot_group['info']['region'] }}</span>
												<span class="me-5">{{ $adslot_group['info']['channelGroup'] }}</span>
											</div>
											<div>
												<span>{{ $adslot_group['info']['adslotGroup'] }}</span>
											</div>
										</div>
									</td>
									<td>
										<div class="flex">
										@foreach($adslot_group['info']['dateRanges'] as $key=>$dates)
											<div>{{ $dates[array_key_first($dates)] }}</div>	
										@endforeach
										</div>
									</td>
									<td>
										<div class="flex">
										@foreach($adslot_group['info']['dateRanges'] as $key=>$dates)
											<div>{{ $dates[array_key_last($dates)] }}</div>	
										@endforeach
										</div>
									</td>
								</tr>
							@php
							 $index++;
							@endphp
							@endforeach
							<!-- <tr>
								<td>1</td>
								<td>
									<div class="flex">
										<div>
											<span class="me-5">591</span>
											<span class="me-5">台北市</span>
											<span class="me-5">PC_中古屋</span>
										</div>
										<div>
											<span>中古屋列表雙橫幅</span>
										</div>
									</div>
								</td>
								<td>
									<div class="flex">
										<div>2023-02-06</div>	
										<div>2023-02-13</div>	
									</div>
								</td>
								<td>
									<div class="flex">
										<div>2023-02-12</div>	
										<div>2023-02-19</div>	
									</div>
								</td>
							</tr> -->
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!--end::Modal body-->
	<!--begin::Modal footer-->
	<div class="modal-footer flex-center">
		<!--begin::Button-->
		<button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">
			{{__('ad-schedule.cancel')}}
		</button>
		<!--end::Button-->
		<!--begin::Button-->
		<button type="button" class="btn btn-light-warning" id="go_edit_insertion_button">
			@include('partials.general._button-indicator', ['label' => __('ad-schedule.set-date-range')])
			<!--end::Button-->
		</button>
	</div>
		<!--end::Modal footer-->
	</form>