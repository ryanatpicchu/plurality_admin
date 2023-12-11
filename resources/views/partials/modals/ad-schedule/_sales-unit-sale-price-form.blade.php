	<!--begin::Modal header-->
	<div class="modal-header">
		<h3 class="modal-title">{{__('ad-schedule.set-sales-unit-sale-price')}}</h3>
		<!--begin::Close-->
		<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
			<i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
		</div>
		<!--end::Close-->
	</div>
	<!--end::Modal header-->
	<!--begin::Modal body-->
	<form id="confirm_sales_unit_sale_price" class="form" method="POST" action="{{route('ad-schedule.set-sales-unit-sale-price')}}" >
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />
	<input type="hidden" name="combination_key" value="{{ $combination_key }}" />
	<input type="hidden" name="row" value="{{ $row }}" />
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
								<!-- <th class="min-w-75px">{{__('ad-schedule.expect-sale-price')}}</th>
                        		<th class="min-w-75px">{{__('ad-schedule.sales-unit-list-price')}}</th> -->
							</tr>
						</thead>
						<tbody>
							@php
								$index_count = 1;
								$sales_unit_list_price = 0;
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
											<span class="me-5">{{$adslot['ad']}}({{$adslot['sales_unit']}})</span>
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
								<!-- <td>
									<div class="flex">
										{{$subtotal_sale_price}}
									</div>
								</td>
								<td>
									<div class="flex">
										{{$adslot['list_price']}}
									</div>
								</td> -->
								@php
									$sales_unit_list_price = $adslot['list_price'];
								@endphp
							</tr>
								@endforeach
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
			<!--begin::Card footer-->
			<div class="card-footer">
				<div class="d-flex flex-column flex-md-row flex-md-stack justify-content-end">
					<div class="d-flex flex-center">
						<div class="d-flex flex-center">
							<span class="pe-2">
								<span class="fw-bold text-gray-600">{{__('ad-schedule.subtotal-sale-price')}}</span>
							</span>
							<span class="ps-0">
								<input id="dynamic_subtotal_sale_price" type="text" class="form-control form-control-solid form-control-sm" name="subtotal_sale_price" value="{{ $subtotal_sale_price }}" />
							</span>
						</div>
						<div class="d-flex flex-center">
							<span class="pe-2">
								<span class="fw-bold text-gray-600">{{__('ad-schedule.sales-unit-list-price')}}</span>
							</span>
							<span class="ps-0">
								<input id="dynamic_sales_unit_list_price" type="text" class="form-control form-control-solid form-control-sm" name="sales_unit_list_price" value="{{ $sales_unit_list_price }}" />
							</span>
						</div>
						<div>
							<span class="fw-bold text-gray-600 ms-5">{{__('ad-schedule.promise-quantity')}}</span>
							<span id="dynamic_promise_quantity" class="fw-bolder fs-5 me-5 text-danger">
								{{
									floor($subtotal_sale_price/$sales_unit_list_price)
								}}
							</span>   
							<input id="new_promise_quantity" type="text" class="form-control form-control-solid form-control-sm" name="promise_quantity" value="" style="display:none;"/>
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
		<button type="button" id="set_sales_unit_sale_price_submit_button" class="btn btn-light-warning">
			@include('partials.general._button-indicator', ['label' => __('ad-schedule.set-date-range')])
			<!--end::Button-->
		</button>
	</div>
		<!--end::Modal footer-->
	</form>