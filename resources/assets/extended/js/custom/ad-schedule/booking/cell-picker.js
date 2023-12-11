"use strict";

// Class definition
var CellPicker = function () {
    var modelContent,setAdSlotDateForm,setAdSlotDateModal,modifyAdSlotDateRange;

    setAdSlotDateForm = $('#set_adslot_date_form');
    setAdSlotDateModal = $('#modal_set_adslot_date');
    modelContent = $('#modal_set_adslot_date div.modal-content');

    // Public functions
    return {
        // Initialization
        init: function () {
            
            $('.selectable_cell').on('click',function(t){
                t.preventDefault();
                // console.log($(this).attr('region_id')+"_"+$(this).attr('channel_group_id')+"_"+$(this).attr('adslot_group_id')+"_"+$(this).attr('row')+"_start_date");
                // console.log($(this).attr('region_id')+"_"+$(this).attr('channel_group_id')+"_"+$(this).attr('adslot_group_id')+"_"+$(this).attr('row')+"_end_date");

                if($(this).hasClass('badge-selected')){
                    //表示點選的cell 是已選的位置
                    //直接unselect
                    $(this).removeClass('badge-selected');

                    if($("#"+$(this).attr('region_id')+"_"+$(this).attr('channel_group_id')+"_"+$(this).attr('adslot_group_id')+"_"+$(this).attr('row')+"_start_date_remove").val() == ''){
                        $("#"+$(this).attr('region_id')+"_"+$(this).attr('channel_group_id')+"_"+$(this).attr('adslot_group_id')+"_"+$(this).attr('row')+"_start_date_remove").val($(this).attr("date"));
                    }
                    else if($("#"+$(this).attr('region_id')+"_"+$(this).attr('channel_group_id')+"_"+$(this).attr('adslot_group_id')+"_"+$(this).attr('row')+"_end_date_remove").val() == ''){
                        $("#"+$(this).attr('region_id')+"_"+$(this).attr('channel_group_id')+"_"+$(this).attr('adslot_group_id')+"_"+$(this).attr('row')+"_end_date_remove").val($(this).attr("date"));
                    }



                    //已選滿2個日期, 代表這2個日期中間的badge-selected 皆需被移除
                    if($("#"+$(this).attr('region_id')+"_"+$(this).attr('channel_group_id')+"_"+$(this).attr('adslot_group_id')+"_"+$(this).attr('row')+"_start_date_remove").val() != '' && $("#"+$(this).attr('region_id')+"_"+$(this).attr('channel_group_id')+"_"+$(this).attr('adslot_group_id')+"_"+$(this).attr('row')+"_end_date_remove").val() != ''){

                        const startDate = new Date($("#"+$(this).attr('region_id')+"_"+$(this).attr('channel_group_id')+"_"+$(this).attr('adslot_group_id')+"_"+$(this).attr('row')+"_start_date_remove").val());
                        const endDate = new Date($("#"+$(this).attr('region_id')+"_"+$(this).attr('channel_group_id')+"_"+$(this).attr('adslot_group_id')+"_"+$(this).attr('row')+"_end_date_remove").val());
                        if (startDate >= endDate) {
                            var untilElement = $("a[region_id='"+$(this).attr('region_id')+"'][channel_group_id='"+$(this).attr('channel_group_id')+"'][adslot_group_id='"+$(this).attr('adslot_group_id')+"'][row='"+$(this).attr('row')+"'][date='"+$("#"+$(this).attr('region_id')+"_"+$(this).attr('channel_group_id')+"_"+$(this).attr('adslot_group_id')+"_"+$(this).attr('row')+"_start_date_remove").val()+"']");
                            $("a[region_id='"+$(this).attr('region_id')+"'][channel_group_id='"+$(this).attr('channel_group_id')+"'][adslot_group_id='"+$(this).attr('adslot_group_id')+"'][row='"+$(this).attr('row')+"'][date='"+$("#"+$(this).attr('region_id')+"_"+$(this).attr('channel_group_id')+"_"+$(this).attr('adslot_group_id')+"_"+$(this).attr('row')+"_end_date_remove").val()+"']")
                            .nextUntil(untilElement).removeClass('badge-selected');
                          
                        } else {
                            var untilElement = $("a[region_id='"+$(this).attr('region_id')+"'][channel_group_id='"+$(this).attr('channel_group_id')+"'][adslot_group_id='"+$(this).attr('adslot_group_id')+"'][row='"+$(this).attr('row')+"'][date='"+$("#"+$(this).attr('region_id')+"_"+$(this).attr('channel_group_id')+"_"+$(this).attr('adslot_group_id')+"_"+$(this).attr('row')+"_end_date_remove").val()+"']");
                            $("a[region_id='"+$(this).attr('region_id')+"'][channel_group_id='"+$(this).attr('channel_group_id')+"'][adslot_group_id='"+$(this).attr('adslot_group_id')+"'][row='"+$(this).attr('row')+"'][date='"+$("#"+$(this).attr('region_id')+"_"+$(this).attr('channel_group_id')+"_"+$(this).attr('adslot_group_id')+"_"+$(this).attr('row')+"_start_date_remove").val()+"']")
                            .nextUntil(untilElement).removeClass('badge-selected');
                        }
                        
                        //暫存日期的input reset to empty 
                        $("#"+$(this).attr('region_id')+"_"+$(this).attr('channel_group_id')+"_"+$(this).attr('adslot_group_id')+"_"+$(this).attr('row')+"_start_date_remove").val('');
                        $("#"+$(this).attr('region_id')+"_"+$(this).attr('channel_group_id')+"_"+$(this).attr('adslot_group_id')+"_"+$(this).attr('row')+"_end_date_remove").val('');
                    }
                }
                else{
                    if($("#"+$(this).attr('region_id')+"_"+$(this).attr('channel_group_id')+"_"+$(this).attr('adslot_group_id')+"_"+$(this).attr('row')+"_start_date").val() == ''){
                        $("#"+$(this).attr('region_id')+"_"+$(this).attr('channel_group_id')+"_"+$(this).attr('adslot_group_id')+"_"+$(this).attr('row')+"_start_date").val($(this).attr("date"));
                    }
                    else if($("#"+$(this).attr('region_id')+"_"+$(this).attr('channel_group_id')+"_"+$(this).attr('adslot_group_id')+"_"+$(this).attr('row')+"_end_date").val() == ''){
                        $("#"+$(this).attr('region_id')+"_"+$(this).attr('channel_group_id')+"_"+$(this).attr('adslot_group_id')+"_"+$(this).attr('row')+"_end_date").val($(this).attr("date"));
                    }

                    //已選好2個日期
                    if($("#"+$(this).attr('region_id')+"_"+$(this).attr('channel_group_id')+"_"+$(this).attr('adslot_group_id')+"_"+$(this).attr('row')+"_start_date").val() != '' && $("#"+$(this).attr('region_id')+"_"+$(this).attr('channel_group_id')+"_"+$(this).attr('adslot_group_id')+"_"+$(this).attr('row')+"_end_date").val() != ''){
                        ConfirmAdSlotDate.init($(this).attr('region_id'), $(this).attr('channel_group_id'), $(this).attr('adslot_group_id'), $("#"+$(this).attr('region_id')+"_"+$(this).attr('channel_group_id')+"_"+$(this).attr('adslot_group_id')+"_"+$(this).attr('row')+"_start_date").val(), $("#"+$(this).attr('region_id')+"_"+$(this).attr('channel_group_id')+"_"+$(this).attr('adslot_group_id')+"_"+$(this).attr('row')+"_end_date").val(), $(this).attr('row'));
                    }

                    if($(this).hasClass('badge-available')){
                        $(this).removeClass('badge-available');
                    }
                    else{
                        $(this).addClass('badge-available');
                    }   
                }
                
            });

        }
    };
}();

var ConfirmAdSlotDate = function () {


    var modelContent,setAdSlotDateForm,setAdSlotDateModal,modifyAdSlotDateRange;

    setAdSlotDateForm = $('#set_adslot_date_form');
    setAdSlotDateModal = $('#modal_set_adslot_date');
    modelContent = $('#modal_set_adslot_date div.modal-content');
    

    // Public functions
    return {
        // Initialization
        init: function (region_id, channel_group_id, adslot_group_id, start_date, end_date, row) {
            setAdSlotDateModal.modal('show');
                // display loading bar, before request
            const myInterceptor = axios.interceptors.request.use(function (config) {

                modelContent.html('<div class="modal-body"><div class="progress"><div class="progress-bar progress-bar-success progress-bar-striped active progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%; height: 40px"></div></div></div>');

                return config;
            }, function (error) {
                return Promise.reject(error);
            });

                // Simulate ajax request
            axios.post(setAdSlotDateForm.attr('action'), 
            {
                region_id: region_id,
                channel_group_id: channel_group_id,
                adslot_group_id: adslot_group_id,
                start_date: start_date,
                end_date: end_date,
                row: row
            }
            )
            .then(function(response) {
                // console.log(response);
                modelContent.html(response.data.modelContent);
                SubmitConfirmAdslotDateRange.init();
                DatePicker.init();
                ResetSelectedAdSlotDates(region_id, channel_group_id, adslot_group_id, start_date, end_date, row);

                $('input[name="end_date"]').on('change',function(){

                    var date1 = new Date($('input[name="end_date"]').val());
                    var date2 = new Date($('input[name="start_date"]').val());
                    var milli_secs = date1.getTime() - date2.getTime();
                     
                    // Convert the milli seconds to Days  
                    var days = milli_secs / (1000 * 3600 * 24) + 1;

                    $('#calculated_days').html(days);
                })
                
            })
            .catch(function(error) {
                console.log(error);
                window.location.reload();
            })
            .then(function() {
                axios.interceptors.request.eject(myInterceptor);
            });
        }
    };
}();

var SubmitConfirmAdslotDateRange = function (){
    var modelContent,setAdSlotDateForm,setAdSlotDateModal,confirmAdSlotDateRange;

    setAdSlotDateForm = $('#set_adslot_date_form');
    setAdSlotDateModal = $('#modal_set_adslot_date');
    modelContent = $('#modal_set_adslot_date div.modal-content');
    // Public functions
    return {
        // Initialization
        init: function () {

            $('#confirm_adslot_date_range_submit_button').on('click',function(t){
                t.preventDefault();
                // Disable button to avoid multiple click
                $(this).prop('disabled',true);
                $(this).find('.indicator-label').hide();
                $(this).find('.indicator-progress').show();

                confirmAdSlotDateRange = $('#confirm_adslot_date_range');

                // Simulate ajax request
                axios.post(confirmAdSlotDateRange.attr('action'), new FormData(confirmAdSlotDateRange[0]))
                .then(function(response) {
                    // console.log(response);
                    let data = response.data;
                    var all_dates = data.all_dates;

                    // console.log(data.region_id);
                    // console.log(all_dates);

                    Object.keys(all_dates).forEach(function(date){
                        $('a[region_id="'+data.region_id+'"][channel_group_id="'+data.channel_group_id+'"][adslot_group_id="'+data.adslot_group_id+'"][date="'+all_dates[date]+'"][row="'+data.row+'"]').addClass('badge-selected');
                    });

                    // $("#"+response.data.element_id).css("grid-column",response.data.new_grid_column);
                    // $("#"+response.data.element_id).attr("end_date",response.data.end_date);
                    setAdSlotDateModal.modal('hide');
                })
                .catch(function(error) {
                    console.log(error);

                    

                })
                .then(function() {

                    // Hide loading indication
                    $('#confirm_adslot_date_range_submit_button').find('.indicator-label').show();
                    $('#confirm_adslot_date_range_submit_button').find('.indicator-progress').hide();
                    $('#confirm_adslot_date_range_submit_button').prop('disabled',false);
                });

            });
        }
    }

        
}();

var ResetSelectedAdSlotDates = function (region_id, channel_group_id, adslot_group_id, start_date, end_date, row) {
    
    $('a[region_id="'+region_id+'"][channel_group_id="'+channel_group_id+'"][adslot_group_id="'+adslot_group_id+'"][date="'+start_date+'"][row="'+row+'"]').removeClass('badge-available');
    $('a[region_id="'+region_id+'"][channel_group_id="'+channel_group_id+'"][adslot_group_id="'+adslot_group_id+'"][date="'+end_date+'"][row="'+row+'"]').removeClass('badge-available');
    //清除暫選的日期，供下一個動作使用
    $("#"+region_id+"_"+channel_group_id+"_"+adslot_group_id+"_"+row+"_start_date").val("");
    $("#"+region_id+"_"+channel_group_id+"_"+adslot_group_id+"_"+row+"_end_date").val("");

    
};

// On document ready
KTUtil.onDOMContentLoaded(function () {
});
