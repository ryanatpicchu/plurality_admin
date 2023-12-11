"use strict";

// Class definition
var EditAdslotGroup = function () {


    var modelContent,editAdslotGroupForm,editAdslotGroupModal;

    editAdslotGroupForm = $('#edit_adslot_group_form');
    editAdslotGroupModal = $('#modal_edit_adslot_group');
    modelContent = $('#modal_edit_adslot_group div.modal-content');

    // Public functions
    return {
        // Initialization
        init: function () {

            $('#adslot_group_list_table tbody').on('click','.edit_adslot_group',function(t){
                t.preventDefault();

                // Simulate ajax request
                axios.post(editAdslotGroupForm.attr('action'), 
                    new FormData(editAdslotGroupForm[0]),
                    {params:{
                        adslot_group_id: $(this).attr('record_id'),
                        designate_channel: $(this).attr('channel_id'),
                        designate_channel_group: $(this).attr('channel_group_id'),
                    }} )
                .then(function(response) {
                    modelContent.html(response.data.modelContent);
                    UpdateAdslotGroup.init();
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

var UpdateAdslotGroup = function () {
    var form,updateAdslotGroupModal;
    
    updateAdslotGroupModal = $('#modal_edit_adslot_group');

    return {
        init: function () {
            $('#update_adslot_group_submit_button').on('click', function(t) {
                // Prevent button default action
                t.preventDefault();

                // Disable button to avoid multiple click
                $(this).prop('disabled',true);
                $(this).find('.indicator-label').hide();
                $(this).find('.indicator-progress').show();

                // Simulate ajax request
                axios.post($('#update_adslot_group_form').attr('action'), new FormData($('#update_adslot_group_form')[0]))
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
                            $("#adslot_group_list_table").DataTable().ajax.reload();
                            updateAdslotGroupModal.modal('hide');
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
                    $('#update_adslot_group_submit_button').find('.indicator-label').show();
                    $('#update_adslot_group_submit_button').find('.indicator-progress').hide();
                    $('#update_adslot_group_submit_button').prop('disabled',false);
                });
            });
        }
    };
    

    
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    // Editadslot.init();
});
