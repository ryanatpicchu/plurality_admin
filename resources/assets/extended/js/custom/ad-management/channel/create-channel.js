"use strict";

// Class definition
var CreateChannel = function () {


    var modelContent,createChannelForm,createChannelModal;

    createChannelForm = $('#create_channel_form');
    createChannelModal = $('#modal_create_channel');
    modelContent = $('#modal_create_channel div.modal-content');

    // Public functions
    return {
        // Initialization
        init: function () {
            $('#create_channel_button').on('click',function(t){
                // Prevent button default action
                t.preventDefault();

                // Simulate ajax request
                axios.post(createChannelForm.attr('action'), new FormData(createChannelForm[0]))
                .then(function(response) {
                    modelContent.html(response.data.modelContent);
                    StoreChannel.init();

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


var StoreChannel = function () {
    var form,storeChannelModal;
    
    storeChannelModal = $('#modal_create_channel');

    return {
        init: function () {
            $('#store_channel_submit_button').on('click', function(t) {
                // Prevent button default action
                t.preventDefault();

                // Disable button to avoid multiple click
                $(this).prop('disabled',true);
                $(this).find('.indicator-label').hide();
                $(this).find('.indicator-progress').show();

                // Simulate ajax request
                axios.post($('#store_channel_form').attr('action'), new FormData($('#store_channel_form')[0]))
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
                            $("#channel_list_table").DataTable().ajax.reload();
                            storeChannelModal.modal('hide');
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
                    $('#store_channel_submit_button').find('.indicator-label').show();
                    $('#store_channel_submit_button').find('.indicator-progress').hide();
                    $('#store_channel_submit_button').prop('disabled',false);
                });
            });
        }
    };
    

    
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    CreateChannel.init();
});
