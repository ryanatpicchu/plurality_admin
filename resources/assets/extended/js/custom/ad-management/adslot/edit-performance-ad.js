"use strict";

// Class definition
var EditPerformanceAd = function () {


    var modelContent,editPerformanceAdForm,editPerformanceAdModal;

    editPerformanceAdForm = $('#edit_performance_ad_form');
    editPerformanceAdModal = $('#modal_edit_performance_ad');
    modelContent = $('#modal_edit_performance_ad div.modal-content');

    // Public functions
    return {
        // Initialization
        init: function () {
            $('#performance_ad_list_table tbody').on('click','.edit_performance_ad',function(t){

                t.preventDefault();

                // Simulate ajax request
                axios.post(editPerformanceAdForm.attr('action'), new FormData(editPerformanceAdForm[0]),
                    {params:{
                        performance_ad_id: $(this).attr('record_id'),
                    }} 
                )
                .then(function(response) {
                    modelContent.html(response.data.modelContent);
                    UpdatePerformanceAd.init();
                    DatePicker.init();
                })
                .catch(function(error) {
                    console.log(error);
                    window.location.reload();

                })
                .then(function() {

                });

            })
        }
    };
}();

var UpdatePerformanceAd = function () {
    var form,updatePerformanceAdModal;
    
    updatePerformanceAdModal = $('#modal_edit_performance_ad');

    return {
        init: function () {
            $('#update_performance_ad_submit_button').on('click', function(t) {
                // Prevent button default action
                t.preventDefault();

                // Disable button to avoid multiple click
                $(this).prop('disabled',true);
                $(this).find('.indicator-label').hide();
                $(this).find('.indicator-progress').show();

                // Simulate ajax request
                axios.post($('#update_performance_ad_form').attr('action'), new FormData($('#update_performance_ad_form')[0]))
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
                            $("#performance_ad_list_table").DataTable().ajax.reload();
                            updatePerformanceAdModal.modal('hide');
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
                    $('#update_performance_ad_submit_button').find('.indicator-label').show();
                    $('#update_performance_ad_submit_button').find('.indicator-progress').hide();
                    $('#update_performance_ad_submit_button').prop('disabled',false);
                });
            });
        }
    };
    

    
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    // ShowMeterialSettingNote.init();
});

// Webpack support
if (typeof module !== 'undefined' && typeof module.exports !== 'undefined') {
    // console.log('module export initialing...');
    // module.exports = ShowMeterialSettingNote;
}
