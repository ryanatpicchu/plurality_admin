<div class="list-group">
	<a href="javascript:;" class="list-group-item list-group-item-action active" aria-current="true">
		{{ $selected_channel_group->name }}
	</a>
	<ul class="list-group">
		@foreach($adslot_groups as $key=>$val)
		<li class="list-group-item form-check-sm">
			<input channel_id="{{$selected_channel}}" region_id="{{$selected_region}}" channel_group_id="{{$selected_channel_group->id}}" adslot_group_id="{{$val->id}}" class="form-check-input me-1 available-adslot-groups" type="checkbox" value="" >
			{{$val->name}}
		</li>
		@endforeach
	</ul>

		<!-- <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
				PC_中古屋<span class="badge badge-circle badge-danger ms-auto">2</span><i class="bi bi-chevron-double-right"></i></a> -->
</div>
<!-- <div class="list-group">
						  <a href="#" class="list-group-item list-group-item-action active" aria-current="true">PC_中古屋</a>
						  <ul class="list-group">
							  <li class="list-group-item form-check-sm">
							    <input class="form-check-input me-1" type="checkbox" value="" checked>
							    中古屋列表頁雙橫幅
							  </li>
							  <li class="list-group-item">
							    <input class="form-check-input me-1" type="checkbox" value="" >
							    中古屋列表頁右側大看板_A
							  </li>
							  <li class="list-group-item">
							    <input class="form-check-input me-1" type="checkbox" value="" checked>
							    中古屋列表頁右側大看板_B
							  </li>
							  <li class="list-group-item">
							    <input class="form-check-input me-1" type="checkbox" value="" >
							    中古屋列表頁右側大看板_C
							  </li>
							  <li class="list-group-item">
							    <input class="form-check-input me-1" type="checkbox" value="" >
							    中古屋內頁雙橫幅
							  </li>
							</ul>
						</div> -->