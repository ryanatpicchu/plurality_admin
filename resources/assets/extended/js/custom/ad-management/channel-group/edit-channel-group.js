"use strict";

// Class definition
var EditChannelGroup = function () {


    var modelContent,editChannelGroupForm,editChannelGroupModal;

    editChannelGroupForm = $('#edit_channel_group_form');
    editChannelGroupModal = $('#modal_edit_channel_group');
    modelContent = $('#modal_edit_channel_group div.modal-content');

    // Public functions
    return {
        // Initialization
        init: function () {

            $('#channel_group_list_table tbody').on('click','.edit_channel_group',function(t){
                t.preventDefault();

                // Simulate ajax request
                axios.post(editChannelGroupForm.attr('action'), 
                    new FormData(editChannelGroupForm[0]),
                    {params:{
                        channel_group_id: $(this).attr('record_id'),
                        designate_channel: $(this).attr('channel_id'),
                    }} )
                .then(function(response) {
                    modelContent.html(response.data.modelContent);
                    UpdateChannelGroup.init();
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

var UpdateChannelGroup = function () {
    var form,updateChannelGroupModal;
    
    updateChannelGroupModal = $('#modal_edit_channel_group');

    return {
        init: function () {
            $('#update_channel_group_submit_button').on('click', function(t) {
                // Prevent button default action
                t.preventDefault();

                // Disable button to avoid multiple click
                $(this).prop('disabled',true);
                $(this).find('.indicator-label').hide();
                $(this).find('.indicator-progress').show();

                // Simulate ajax request
                axios.post($('#update_channel_group_form').attr('action'), new FormData($('#update_channel_group_form')[0]))
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
                            $("#channel_group_list_table").DataTable().ajax.reload();
                            updateChannelGroupModal.modal('hide');
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
                    $('#update_channel_group_submit_button').find('.indicator-label').show();
                    $('#update_channel_group_submit_button').find('.indicator-progress').hide();
                    $('#update_channel_group_submit_button').prop('disabled',false);
                });
            });
        }
    };
    

    
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    // EditChannel.init();
});
