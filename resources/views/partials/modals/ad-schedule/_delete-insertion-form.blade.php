	<!--begin::Modal header-->
	<div class="modal-header">
		<h3 class="modal-title">{{__('ad-schedule.delete-insertion')}}</h3>
		<!--begin::Close-->
		<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
			<i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
		</div>
		<!--end::Close-->
	</div>
	<!--end::Modal header-->
	<!--begin::Modal body-->
	<form id="delete_insertion_form" class="form" method="POST" action="{{ route('ad-schedule.delete-insertion')}}" >
		<input name="insertion_id" value="{{$insertion->id}}" style="display: none;">
	<div class="modal-body pt-0">
		<div class="card">
			<div class="card-header border-0">
		        <h3 class="card-title text-danger">{{__('ad-schedule.are-you-sure-to-delete-insertion')}}</h3>
		    </div>
			<div class="card-body pt-0">
				<div class="table-responsive">
					<table class="table table-rounded table-striped border gy-7 gs-7">
						<thead>
							<tr class="fw-bold fs-6 text-gray-800">
								<th>{{__('ad-schedule.customer-name')}}</th>
								<th>{{__('ad-schedule.product-name')}}</th>
								<th>{{__('ad-schedule.insertion-start-date')}}</th>
								<th>{{__('ad-schedule.insertion-end-date')}}</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<div class="flex">
										{{$insertion->customer_name}}
									</div>
								</td>
								<td>
									<div class="flex">
										{{$insertion->product_name}}
									</div>
								</td>
								<td>
									<div class="flex">
										{{$insertion->start_date}}
									</div>
								</td>
								<td>
									<div class="flex">
										{{$insertion->end_date}}
									</div>
								</td>
							</tr>
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!--end::Modal body-->
	<!--begin::Modal footer-->
	<div class="modal-footer flex-center">
		
		<button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">
			{{__('ad-schedule.cancel')}}
		</button>
		<!--end::Button-->
		<!--begin::Button-->
		<button type="submit" id="delete_insertion_submit_button" class="btn btn-danger">
			@include('partials.general._button-indicator', ['label' => __('ad-schedule.confirm-delete')])
			<!--end::Button-->
		</button>
		
	</div>
	</form>
		<!--end::Modal footer-->
