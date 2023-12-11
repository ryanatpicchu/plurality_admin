"use strict";

// Class definition
var CreatePerformanceAd = function () {


    var modelContent,createPerformanceAdForm,createPerformanceAdModal;

    createPerformanceAdForm = $('#create_performance_ad_form');
    createPerformanceAdModal = $('#modal_create_performance_ad');
    modelContent = $('#modal_create_performance_ad div.modal-content');

    // Public functions
    return {
        // Initialization
        init: function () {
            $('#create_performance_ad_button').on('click',function(t){

                t.preventDefault();

                // Simulate ajax request
                axios.post(createPerformanceAdForm.attr('action'), new FormData(createPerformanceAdForm[0]))
                .then(function(response) {
                    modelContent.html(response.data.modelContent);
                    StorePerformanceAd.init();
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

var StorePerformanceAd = function () {
    var form,storePerformanceAdModal;
    
    storePerformanceAdModal = $('#modal_create_performance_ad');

    return {
        init: function () {
            $('#store_performance_ad_submit_button').on('click', function(t) {
                // Prevent button default action
                t.preventDefault();

                // Disable button to avoid multiple click
                $(this).prop('disabled',true);
                $(this).find('.indicator-label').hide();
                $(this).find('.indicator-progress').show();

                // Simulate ajax request
                axios.post($('#store_performance_ad_form').attr('action'), new FormData($('#store_performance_ad_form')[0]))
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
                            storePerformanceAdModal.modal('hide');
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
                        $('textarea[name="'+errorsKey+'"]').addClass('is-invalid');
                    }


                })
                .then(function() {

                    // Hide loading indication
                    $('#store_performance_ad_submit_button').find('.indicator-label').show();
                    $('#store_performance_ad_submit_button').find('.indicator-progress').hide();
                    $('#store_performance_ad_submit_button').prop('disabled',false);
                });
            });
        }
    };
    
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    CreatePerformanceAd.init();
});
