<div class="list-group">
	<a href="javascript:;" class="list-group-item list-group-item-action active" aria-current="true">
		{{ $selected_region->name }}
	</a>
	@foreach($channel_groups as $key=>$val)
	<a href="javascript:;" channel_id={{$selected_channel}} region_id={{$selected_region->id}} channel_group_id="{{$val->id}}" class="available-channel-groups list-group-item list-group-item-action d-flex justify-content-between align-items-center">
		{{$val->name}}
		<span class="badge badge-circle badge-danger ms-auto" style="display: none;"></span>
		<i class="bi bi-chevron-double-right"></i>
	</a>
	@endforeach

		<!-- <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
				PC_中古屋<span class="badge badge-circle badge-danger ms-auto">2</span><i class="bi bi-chevron-double-right"></i></a> -->
</div>