"use strict";

// Class definition
var ModifyAdslotStartDate = function () {


    var modelContent,modifyAdslotStartDateForm,modifyAdslotStartDateModal;

    modifyAdslotStartDateForm = $('#modify_adslot_start_date_form');
    modifyAdslotStartDateModal = $('#modal_modify_adslot_start_date');
    modelContent = $('#modal_modify_adslot_start_date div.modal-content');

    // Public functions
    return {
        // Initialization
        init: function () {

            $('#modify_adslot_start_date_button').on('click',function(t){
                t.preventDefault();

                var selectedAdslots = new Array();
                $('#adslot_group_detail_list_table input.adslot_checkbox:checked').each(function() {
                    selectedAdslots.push($(this).attr('update_id'));
                });

                if(selectedAdslots.length == 0){
                    Swal.fire({
                        text: '請至少選擇一列',
                        icon: "warning",
                        buttonsStyling: false,
                        confirmButtonText: "Ok",
                        customClass: {
                            confirmButton: "btn btn-warning"
                        }
                    }).then(function(result) {
                        modifyAdslotStartDateModal.modal('hide');
                    });
                }
                else{

                    // Simulate ajax request
                    axios.post(modifyAdslotStartDateForm.attr('action'), new FormData(modifyAdslotStartDateForm[0]),
                        {params:{
                            checked_adslots: JSON.stringify(selectedAdslots)
                        }}
                    )
                    .then(function(response) {
                        modelContent.html(response.data.modelContent);
                        DatePicker.init();
                        UpdateAdslotStartDate.init();
                    })
                    .catch(function(error) {
                        console.log(error);
                        window.location.reload();

                    })
                    .then(function() {

                    });
                }
            })
        }
    };
}();

var UpdateAdslotStartDate = function () {
    var form,updateAdslotModal;
    
    updateAdslotModal = $('#modal_modify_adslot_start_date');

    return {
        init: function () {
            $('#update_adslot_start_date_submit_button').on('click', function(t) {
                // Prevent button default action
                t.preventDefault();

                $('.adslot-date').data('daterangepicker').hide();

                // Disable button to avoid multiple click
                $(this).prop('disabled',true);
                $(this).find('.indicator-label').hide();
                $(this).find('.indicator-progress').show();

                // Simulate ajax request
                axios.post($('#update_adslot_start_date_form').attr('action'), new FormData($('#update_adslot_start_date_form')[0]))
                .then(function(response) {

                    // Show message popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                    Swal.fire({
                        text: response.data.message,
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    }).then(function(result) {
                        if (result.isConfirmed) {
                            $("#adslot_group_detail_list_table").DataTable().ajax.reload();
                            $('.adslot-date').data('daterangepicker').hide();
                            updateAdslotModal.modal('hide');
                        }
                    });
                })
                .catch(function(error) {
                    console.log(error.response.data.errors);

                    let dataErrors = error.response.data.errors;

                    $('.errors').html('');
                    for (const errorsKey in dataErrors) {
                        $('.'+errorsKey+'_error').html(dataErrors[errorsKey]);
                        $('input[name="'+errorsKey+'"]').addClass('is-invalid');
                    }


                })
                .then(function() {

                    // Hide loading indication
                    $('#update_adslot_start_date_submit_button').find('.indicator-label').show();
                    $('#update_adslot_start_date_submit_button').find('.indicator-progress').hide();
                    $('#update_adslot_start_date_submit_button').prop('disabled',false);
                });
            });
        }
    };
    

    
}();

var ModifyAdslotEndDate = function () {


    var modelContent,modifyAdslotEndDateForm,modifyAdslotEndDateModal;

    modifyAdslotEndDateForm = $('#modify_adslot_end_date_form');
    modifyAdslotEndDateModal = $('#modal_modify_adslot_end_date');
    modelContent = $('#modal_modify_adslot_end_date div.modal-content');

    // Public functions
    return {
        // Initialization
        init: function () {
            $('#modify_adslot_end_date_button').on('click',function(t){
                t.preventDefault();
                var selectedAdslots = new Array();
                $('#adslot_group_detail_list_table input.adslot_checkbox:checked').each(function() {
                    selectedAdslots.push($(this).attr('update_id'));
                });

                if(selectedAdslots.length == 0){
                    Swal.fire({
                        text: '請至少選擇一列',
                        icon: "warning",
                        buttonsStyling: false,
                        confirmButtonText: "Ok",
                        customClass: {
                            confirmButton: "btn btn-warning"
                        }
                    }).then(function(result) {
                        modifyAdslotEndDateModal.modal('hide');
                    });
                }
                else{
                    // Simulate ajax request
                    axios.post(modifyAdslotEndDateForm.attr('action'), new FormData(modifyAdslotEndDateForm[0]),
                        {params:{
                            checked_adslots: JSON.stringify(selectedAdslots)
                        }}
                    )
                    .then(function(response) {
                        modelContent.html(response.data.modelContent);
                        DatePicker.init();
                        UpdateAdslotEndDate.init();

                    })
                    .catch(function(error) {
                        console.log(error);
                        window.location.reload();

                    })
                    .then(function() {

                    });
                }

                

            })
        }
    };
}();

var UpdateAdslotEndDate = function () {
    var form,updateAdslotModal;
    
    updateAdslotModal = $('#modal_modify_adslot_end_date');

    return {
        init: function () {
            $('#update_adslot_end_date_submit_button').on('click', function(t) {
                // Prevent button default action
                t.preventDefault();

                $('.adslot-date').data('daterangepicker').hide();

                // Disable button to avoid multiple click
                $(this).prop('disabled',true);
                $(this).find('.indicator-label').hide();
                $(this).find('.indicator-progress').show();

                // Simulate ajax request
                axios.post($('#update_adslot_end_date_form').attr('action'), new FormData($('#update_adslot_end_date_form')[0]))
                .then(function(response) {
                    
                    // Show message popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                    Swal.fire({
                        text: response.data.message,
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    }).then(function(result) {
                        if (result.isConfirmed) {
                            $("#adslot_group_detail_list_table").DataTable().ajax.reload();
                            $('.adslot-date').data('daterangepicker').hide();
                            updateAdslotModal.modal('hide');
                        }
                    });
                })
                .catch(function(error) {
                    console.log(error.response.data.errors);

                    let dataErrors = error.response.data.errors;

                    $('.errors').html('');
                    for (const errorsKey in dataErrors) {
                        $('.'+errorsKey+'_error').html(dataErrors[errorsKey]);
                        $('input[name="'+errorsKey+'"]').addClass('is-invalid');
                    }


                })
                .then(function() {

                    // Hide loading indication
                    $('#update_adslot_end_date_submit_button').find('.indicator-label').show();
                    $('#update_adslot_end_date_submit_button').find('.indicator-progress').hide();
                    $('#update_adslot_end_date_submit_button').prop('disabled',false);
                });
            });
        }
    };
    

    
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    ModifyAdslotStartDate.init();
    ModifyAdslotEndDate.init();
});
