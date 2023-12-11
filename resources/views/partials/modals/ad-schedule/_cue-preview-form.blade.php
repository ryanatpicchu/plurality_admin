@php
function get_chinese_weekday($datetime)
{
    $weekday  = date('w', strtotime($datetime));
    $weeklist = array('日', '一', '二', '三', '四', '五', '六');
    return $weeklist[$weekday];
}

$repetitions = config('global.general.repetitions');
@endphp
	<!--begin::Modal header-->
	<div class="modal-header">
		<h3 class="modal-title">{{__('ad-schedule.cue-preview')}}</h3>
		<!--begin::Close-->
		<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
			<i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
		</div>
		<!--end::Close-->
	</div>
	<!--end::Modal header-->
	<!--begin::Modal body-->
	<form id="" class="form" method="POST" action="" >
		<input type="hidden" name="_token" value="{{ csrf_token() }}" />
		<div class="modal-body pt-0">
			<div class="card">
				<div class="card-body">
					@foreach($all_month_records as $year_month=>$rows)
					<div class="adslots_gantt_container">
		                <div class="preview_gantt_left_column">
                    		<div class="preview_gantt_info_body">
                                <div class="preview_gantt_info_row" style="height:{{ count($rows)*40+80 }}px;">
                                    <span>
                                        {{ date('Y年m月', strtotime($year_month)) }}
                                    </span>
                                </div>
                            </div>
                            <div class="preview_gantt_info_lines" >
                                <span></span>
                            </div>
                        </div>
                        <div class="preview_gantt_right_content">
                            <div class="preview_gantt_content_header" style="grid-template-columns: repeat({{date('t',strtotime($year_month))}}, 50px);">

                                
                                <div class="weekdays" style="grid-column: 1/{{ date('t',strtotime($year_month))+1 }};grid-template-columns: repeat({{date('t',strtotime($year_month))}}, 50px);">
                                    @for($i=0; $i< date('t',strtotime($year_month)) ; $i++)
                                    <span>
                                        @php
                                        echo get_chinese_weekday(date('Y-m-d',strtotime($year_month.'-01'." +".$i."days")));
                                        @endphp
                                    </span>
                                    @endfor
                                </div>
                                <div class="days_of_month" style="grid-column: 1/{{ date('t',strtotime($year_month))+1 }};grid-template-columns: repeat({{date('t',strtotime($year_month))}}, 50px);">

                                    @for($i=1; $i<=date('t',strtotime($year_month)); $i++)
                                    <span>
                                        @php
                                        echo date('m/d',strtotime($year_month.'-'.$i));
                                        @endphp
                                    </span>
                                    @endfor

                                </div>
                            </div>
                            <div class="preview_gantt_content_body" style="width:fit-content;">
                            	@foreach($rows as $row_key=>$row)
                                <ul class="adslot_row" 
                                style="
                                grid-template-columns: repeat({{ date('t',strtotime($year_month)) }}, 50px);
                                grid-template-rows:  repeat(1, 40px);
                                height:40px;
                                "
                                >
                                    @foreach($row as $ad_key=>$ad)
                                	<li 
                                    style="
                                        grid-column: {{ date('j',strtotime($ad['dates'][array_key_first($ad['dates'])]))  }}/{{ date('j',strtotime($ad['dates'][array_key_last($ad['dates'])]))+1 }};
                                        "
                                        class="badge-standby" 
                                        id=""
                                        
                                        >
                                        {{$ad['name']}}
                                    </li>
                                    @endforeach

                                </ul>
                                @endforeach
                                
                                <div class="preview_gantt_content_lines" style="grid-template-columns: repeat({{ date('t',strtotime($year_month)) }}, 50px);">
	                                @for($i=1; $i<= date('t',strtotime($year_month)); $i++)
	                                <span>
	                                </span>
	                                @endfor
	                            </div>
	                           
                            	 <div class="preview_gantt_content_horizontal_lines" style="grid-template-rows: repeat({{count($rows)}}, 40px);">
	                                @for($i=1; $i<= count($rows) ; $i++)
	                                <div>
	                                </div>
	                                @endfor
	                            </div>

	                        </div>
	                    </div>
		            </div>
		            @endforeach
				</div>
				<!--begin::Card footer-->
				<div class="card-footer"></div>
				<!--end::Card footer-->
			</div>
		</div>
		<!--end::Modal body-->
		<!--begin::Modal footer-->
		<div class="modal-footer flex-center">
			
			<button type="button" id="download_cue" class="btn btn-light-warning" onclick="location.href='{{route('ad-schedule.export-cue')}}'">
				@include('partials.general._button-indicator', ['label' => __('ad-schedule.cue')])
				<i class="las la-download fs-4"></i>
			</button>
		</div>
		<!--end::Modal footer-->
	</form>