	<!--begin::Modal header-->
	<div class="modal-header">
		<h3 class="modal-title">{{__('ad-schedule.set-subtotal-sale-price')}}</h3>
		<!--begin::Close-->
		<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
			<i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
		</div>
		<!--end::Close-->
	</div>
	<!--end::Modal header-->
	<!--begin::Modal body-->
	<form id="confirm_subtoal_digitm_sale_price" class="form" method="POST" action="{{route('ad-schedule.adjust-digitm-discount-percentage')}}" >
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
								$index_count = 1;
								$subtotal_list_price = 0;
							@endphp
							@foreach($selected_adslot_groups as $adslot_group_key=>$adslot_group)
							<tr>
								<td>{{$index_count}}</td>
								@php
								
								$index_count++;
								$subtotal_list_price += ($adslot_group['info']['list_price']*count($adslot_group['info']['dateRanges']));
								
								@endphp

								<td>
									<div class="flex">
										<div>
											<span class="me-5">{{$adslot_group['info']['channel']}}</span>
											<span class="me-5">{{$adslot_group['info']['region']}}</span>
											<span class="me-5">{{$adslot_group['info']['channelGroup']}}</span>
										</div>
										<div>
											<span>{{$adslot_group['info']['adslotGroup']}}</span>
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
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
			<!--begin::Card footer-->
			<div class="card-footer">
				<div class="d-flex flex-column flex-md-row flex-md-stack justify-content-end">
					<div class="d-flex flex-center">
						<div>
							<span class="fw-bold text-gray-600">{{__('ad-schedule.subtotal-list-price')}}</span>
							<span class="text-gray-800 fw-bolder fs-5 me-5">{{number_format($subtotal_list_price)}}</span>   
						</div>
						<div class="d-flex flex-center">
							<span class="pe-2">
								<span class="fw-bold text-gray-600">{{__('ad-schedule.subtotal-sale-price')}}</span>
								<input id="dynamic_subtotal_digitm_list_price" type="text" class="form-control form-control-solid form-control-sm" name="subtotal_list_price" value="{{ $subtotal_list_price }}" style="display: none;"/>
							</span>
							<span class="ps-0">
								<input id="dynamic_subtotal_digitm_sale_price" type="text" class="form-control form-control-solid form-control-sm" name="subtotal_sale_price" value="{{ $subtotal_list_price }}" />
							</span>
						</div>
						<div>
							<span class="fw-bold text-gray-600 ms-5">{{__('ad-schedule.total-discount-percentage')}}</span>
							<span id="dynamic_digitm_discount_percentage" class="fw-bolder fs-5 me-5 text-danger">0%</span>   
							<input id="new_digitm_discount_percentage" type="text" class="form-control form-control-solid form-control-sm" name="discount_percentage" value="" style="display:none;"/>
						</div>
					</div>
				</div>
                                        <!-- <div class="d-flex justify-content-end mt-9">
                                            <a href="#" class="btn btn-primary d-flex justify-content-end">Pleace Order</a>
                                        </div> -->
                                    </div>
                                    <!--end::Card footer-->
		</div>
	</div>
	<!--end::Modal body-->
	<!--begin::Modal footer-->
	<div class="modal-footer flex-center">
		<!--begin::Button-->
		<button type="reset" id="kt_modal_add_address_cancel" class="btn btn-light me-3" data-bs-dismiss="modal">
			{{__('ad-schedule.cancel')}}
		</button>
		<!--end::Button-->
		<!--begin::Button-->
		<button type="button" id="adjust_digitm_discount_percentage_submit_button" class="btn btn-light-warning">
			@include('partials.general._button-indicator', ['label' => __('ad-schedule.set-date-range')])
			<!--end::Button-->
		</button>
	</div>
		<!--end::Modal footer-->
	</form>