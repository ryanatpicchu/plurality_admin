"use strict";

// Class definition
var CreateChannelGroup = function () {


    var modelContent,createChannelGroupForm,createChannelGroupModal;

    createChannelGroupForm = $('#create_channel_group_form');
    createChannelGroupModal = $('#modal_create_group_channel');
    modelContent = $('#modal_create_channel_group div.modal-content');

    // Public functions
    return {
        // Initialization
        init: function () {
            $('#create_channel_group_button').on('click',function(t){
                t.preventDefault();

                // Simulate ajax request
                axios.post(createChannelGroupForm.attr('action'), new FormData(createChannelGroupForm[0]),
                    {params:{
                        designate_channel: $('#filtered_channel').val()
                    }}
                )
                .then(function(response) {
                    modelContent.html(response.data.modelContent);
                    StoreChannelGroup.init();

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

var StoreChannelGroup = function () {
    var form,storeChannelGroupModal;
    
    storeChannelGroupModal = $('#modal_create_channel_group');

    return {
        init: function () {
            $('#store_channel_group_submit_button').on('click', function(t) {
                // Prevent button default action
                t.preventDefault();

                // Disable button to avoid multiple click
                $(this).prop('disabled',true);
                $(this).find('.indicator-label').hide();
                $(this).find('.indicator-progress').show();

                // Simulate ajax request
                axios.post($('#store_channel_group_form').attr('action'), new FormData($('#store_channel_group_form')[0]))
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
                            storeChannelGroupModal.modal('hide');
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
                    $('#store_channel_group_submit_button').find('.indicator-label').show();
                    $('#store_channel_group_submit_button').find('.indicator-progress').hide();
                    $('#store_channel_group_submit_button').prop('disabled',false);
                });
            });
        }
    };
    

    
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    CreateChannelGroup.init();
});
