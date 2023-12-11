"use strict";

// Class definition
var SetAdSlotDate = function () {


    var modelContent,setAdSlotDateForm,setAdSlotDateModal,modifyAdSlotDateRange;

    setAdSlotDateForm = $('#set_adslot_date_form');
    setAdSlotDateModal = $('#modal_set_adslot_date');
    modelContent = $('#modal_set_adslot_date div.modal-content');
    

    // Public functions
    return {
        // Initialization
        init: function () {
            $('.set_adslot_date').on('click',function(t){
                
                t.preventDefault();


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
                    region_id: $(this).attr('region_id'),
                    adslot_group_id: $(this).attr('adslot_group_id'),
                    start_index: $(this).attr('start_index'),
                    start_date: $(this).attr('start_date'),
                    end_date: $(this).attr('end_date'),
                    element_id : $(this).attr('id')
                }
                )
                .then(function(response) {
                    modelContent.html(response.data.modelContent);
                    DatePicker.init();
                    ModifyAdslotDateRange.init();

                })
                .catch(function(error) {
                    console.log(error);
                    window.location.reload();

                })
                .then(function() {
                    axios.interceptors.request.eject(myInterceptor);
                });

            })
        }
    };
}();

var ModifyAdslotDateRange = function (){
    var modelContent,setAdSlotDateForm,setAdSlotDateModal,modifyAdSlotDateRange;

    setAdSlotDateForm = $('#set_adslot_date_form');
    setAdSlotDateModal = $('#modal_set_adslot_date');
    modelContent = $('#modal_set_adslot_date div.modal-content');
    // Public functions
    return {
        // Initialization
        init: function () {

            $('#modify_adslot_date_range_submit_button').on('click',function(t){
                t.preventDefault();
                // Disable button to avoid multiple click
                $(this).prop('disabled',true);
                $(this).find('.indicator-label').hide();
                $(this).find('.indicator-progress').show();

                

                modifyAdSlotDateRange = $('#modify_adslot_date_range');

                // Simulate ajax request
                axios.post(modifyAdSlotDateRange.attr('action'), new FormData(modifyAdSlotDateRange[0]))
                .then(function(response) {
                    $("#"+response.data.element_id).css("grid-column",response.data.new_grid_column);
                    $("#"+response.data.element_id).attr("end_date",response.data.end_date);
                    setAdSlotDateModal.modal('hide');
                })
                .catch(function(error) {
                    console.log(error);

                    let dataErrors = error.response.data.errors;

                    $('.errors').html('');
                    $(".is-invalid").removeClass("is-invalid");
                    for (const errorsKey in dataErrors) {
                        $('.'+errorsKey+'_error').html(dataErrors[errorsKey]);
                        $('input[name="'+errorsKey+'"]').addClass('is-invalid');
                    }


                })
                .then(function() {

                    // Hide loading indication
                    $('#modify_adslot_date_range_submit_button').find('.indicator-label').show();
                    $('#modify_adslot_date_range_submit_button').find('.indicator-progress').hide();
                    $('#modify_adslot_date_range_submit_button').prop('disabled',false);
                });

            });
        }
    }

        
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    // SetAdSlotDate.init();
});
