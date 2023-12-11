"use strict";

// Class definition
var EditChannel = function () {


    var modelContent,editChannelForm,editChannelModal;

    editChannelForm = $('#edit_channel_form');
    editChannelModal = $('#modal_edit_channel');
    modelContent = $('#modal_edit_channel div.modal-content');

    // Public functions
    return {
        // Initialization
        init: function () {

            $('#channel_list_table tbody').on('click','.edit_channel',function(t){
                t.preventDefault();
                
                // Simulate ajax request
                axios.post(editChannelForm.attr('action'), 
                    new FormData(editChannelForm[0]),
                    {params:{
                        channel_id: $(this).attr('record_id')
                    }} )
                .then(function(response) {
                    modelContent.html(response.data.modelContent);
                    UpdateChannel.init();
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

var UpdateChannel = function () {
    var form,updateChannelModal;
    
    updateChannelModal = $('#modal_edit_channel');

    return {
        init: function () {
            $('#update_channel_submit_button').on('click', function(t) {
                // Prevent button default action
                t.preventDefault();

                // Disable button to avoid multiple click
                $(this).prop('disabled',true);
                $(this).find('.indicator-label').hide();
                $(this).find('.indicator-progress').show();

                // Simulate ajax request
                axios.post($('#update_channel_form').attr('action'), new FormData($('#update_channel_form')[0]))
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
                            updateChannelModal.modal('hide');
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
                    $('#update_channel_submit_button').find('.indicator-label').show();
                    $('#update_channel_submit_button').find('.indicator-progress').hide();
                    $('#update_channel_submit_button').prop('disabled',false);
                });
            });
        }
    };
    

    
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    // EditChannel.init();
});
