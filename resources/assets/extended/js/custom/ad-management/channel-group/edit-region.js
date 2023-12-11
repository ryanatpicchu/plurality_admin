"use strict";

// Class definition
var EditRegion = function () {


    var modelContent,editRegionForm,editRegionModal;

    editRegionForm = $('#edit_channel_group_region_form');
    editRegionModal = $('#modal_channel_group_region_channel');
    modelContent = $('#modal_edit_channel_group_region div.modal-content');

    // Public functions
    return {
        // Initialization
        init: function () {
            $('#edit_channel_group_region_button').on('click',function(t){

                t.preventDefault();

               // Simulate ajax request
                axios.post(editRegionForm.attr('action'), new FormData(editRegionForm[0]))
                .then(function(response) {
                    modelContent.html(response.data.modelContent);
                    UpdateRegion.init();
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

var UpdateRegion = function () {
    var form,updateRegionModal;
    
    updateRegionModal = $('#modal_edit_channel_group_region');

    return {
        init: function () {
            $('#update_channel_group_region_submit_button').on('click', function(t) {
                // Prevent button default action
                t.preventDefault();

                // Disable button to avoid multiple click
                $(this).prop('disabled',true);
                $(this).find('.indicator-label').hide();
                $(this).find('.indicator-progress').show();

                // Simulate ajax request
                axios.post($('#update_channel_group_region_form').attr('action'), new FormData($('#update_channel_group_region_form')[0]))
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
                            $("#channel_group_region_list_table").DataTable().ajax.reload();
                            updateRegionModal.modal('hide');
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
                    $('#update_channel_group_region_submit_button').find('.indicator-label').show();
                    $('#update_channel_group_region_submit_button').find('.indicator-progress').hide();
                    $('#update_channel_group_region_submit_button').prop('disabled',false);
                });
            });
        }
    };
    

    
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    EditRegion.init();
});
