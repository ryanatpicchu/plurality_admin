"use strict";

// Class definition

var ChangeAdslotStatus = function (modal) {
    var form,AdslotModal;
    
    

    return {
        init: function (modal) {
            AdslotModal = $('#'+modal);
            $('#change_adslot_status_submit_button_'+modal).on('click', function(t) {
                // Prevent button default action
                t.preventDefault();

                // Disable button to avoid multiple click
                $(this).prop('disabled',true);
                $(this).find('.indicator-label').hide();
                $(this).find('.indicator-progress').show();

                // Simulate ajax request
                axios.post($('#update_adslot_status_form_'+modal).attr('action'), new FormData($('#update_adslot_status_form_'+modal)[0]))
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
                            AdslotModal.modal('hide');
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
                    $('#change_adslot_status_submit_button_'+modal).find('.indicator-label').show();
                    $('#change_adslot_status_submit_button_'+modal).find('.indicator-progress').hide();
                    $('#change_adslot_status_submit_button_'+modal).prop('disabled',false);
                });
            });
        }
    };
    

    
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    // ChangeAdslotStatus.init();
});
