"use strict";

// Class definition
var EditAdslot = function () {


    var modelContent,editAdslotForm,editAdslotModal;

    editAdslotForm = $('#edit_adslot_form');
    editAdslotModal = $('#modal_edit_adslot');
    modelContent = $('#modal_edit_adslot div.modal-content');

    // Public functions
    return {
        // Initialization
        init: function () {
            $('#adslot_group_detail_list_table tbody').on('click','.edit_adslot',function(t){
                t.preventDefault();
                
                // Simulate ajax request
                axios.post(editAdslotForm.attr('action'), new FormData(editAdslotForm[0]),
                    {params:{
                        adslot_id: $(this).attr('record_id'),
                    }} 
                )
                .then(function(response) {
                    modelContent.html(response.data.modelContent);
                    UpdateAdslot.init();
                    // DatePicker.init();
                    PricingMethod.init();
                    RelatedPackageAdslot.init();
                    RelatedGiveawayAdslot.init();
                    $('#pricing_method').trigger('change');
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

var UpdateAdslot = function () {
    var form,updateAdslotModal;
    
    updateAdslotModal = $('#modal_edit_adslot');

    return {
        init: function () {
            $('#update_adslot_submit_button').on('click', function(t) {
                // Prevent button default action
                t.preventDefault();

                // Disable button to avoid multiple click
                $(this).prop('disabled',true);
                $(this).find('.indicator-label').hide();
                $(this).find('.indicator-progress').show();

                // Simulate ajax request
                axios.post($('#update_adslot_form').attr('action'), new FormData($('#update_adslot_form')[0]))
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
                            updateAdslotModal.modal('hide');
                        }
                    });
                })
                .catch(function(error) {
                    // console.log(error.response.data.errors);

                    let dataErrors = error.response.data.errors;

                    $('.errors').html('');
                    for (const errorsKey in dataErrors) {
                        $('.'+errorsKey+'_error').html(dataErrors[errorsKey]);
                        $('input[name="'+errorsKey+'"]').addClass('is-invalid');
                    }


                })
                .then(function() {

                    // Hide loading indication
                    $('#update_adslot_submit_button').find('.indicator-label').show();
                    $('#update_adslot_submit_button').find('.indicator-progress').hide();
                    $('#update_adslot_submit_button').prop('disabled',false);
                });
            });
        }
    };
    

    
}();

var PricingMethod = function(){
    return {
        init: function(){
            $('#pricing_method').on('change',function(t){
                t.preventDefault();
                if($(this).val() == 'by_quantities'){
                    $('input[name="days"]').val('');
                    $('input[name="impressions"]').val('');
                    $('#days_section').hide();
                    $('#impressions_section').hide();
                }
                else{
                    $('#days_section').show();
                    $('#impressions_section').show();   
                }
            });
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
});
