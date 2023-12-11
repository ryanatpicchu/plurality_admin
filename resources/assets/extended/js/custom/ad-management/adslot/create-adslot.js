"use strict";

// Class definition
var CreateAdslot = function () {


    var modelContent,createAdslotForm,createAdslotModal;

    createAdslotForm = $('#create_adslot_form');
    createAdslotModal = $('#modal_create_adslot');
    modelContent = $('#modal_create_adslot div.modal-content');

    // Public functions
    return {
        // Initialization
        init: function () {
            $('#create_adslot_button').on('click',function(t){
                t.preventDefault();

                // Simulate ajax request
                axios.post(createAdslotForm.attr('action'), new FormData(createAdslotForm[0]))
                .then(function(response) {
                    modelContent.html(response.data.modelContent);
                    TempStoreAdslot.init();
                    // StoreAdslot.init();
                    // DatePicker.init();
                    PricingMethod.init();
                    RelatedPackageAdslot.init();
                    RelatedGiveawayAdslot.init();
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

var TempStoreAdslot = function () {
    var form,storeAdslotModal,modelContent;
    
    storeAdslotModal = $('#modal_create_adslot');
    modelContent = $('#modal_create_adslot div.modal-content');

    return {
        init: function () {
            $('#temp_store_adslot_submit_button').on('click', function(t) {
                // Prevent button default action
                t.preventDefault();

                // Disable button to avoid multiple click
                $(this).prop('disabled',true);
                $(this).find('.indicator-label').hide();
                $(this).find('.indicator-progress').show();

                // Simulate ajax request
                axios.post($('#temp_store_adslot_form').attr('action'), new FormData($('#temp_store_adslot_form')[0]))
                .then(function(response) {
                    modelContent.html(response.data.modelContent);
                    StoreAdslot.init();
                    DatePicker.init();
                })
                .catch(function(error) {
                    console.log(error);

                    let dataErrors = error.response.data.errors;

                    $('.errors').html('');
                    $(".is-invalid").removeClass("is-invalid");
                    for (const errorsKey in dataErrors) {
                        $('.'+errorsKey+'_error').html(dataErrors[errorsKey]);
                        $('input[name="'+errorsKey+'"]').addClass('is-invalid');
                        $('textarea[name="'+errorsKey+'"]').addClass('is-invalid');
                    }


                })
                .then(function() {

                    // Hide loading indication
                    $('#temp_store_adslot_submit_button').find('.indicator-label').show();
                    $('#temp_store_adslot_submit_button').find('.indicator-progress').hide();
                    $('#temp_store_adslot_submit_button').prop('disabled',false);
                });
            });
        }
    };
    
}();

var StoreAdslot = function () {
    var form,storeAdslotModal,createAdslotForm,modelContent;
    
    createAdslotForm = $('#create_adslot_form');
    storeAdslotModal = $('#modal_create_adslot');
    modelContent = $('#modal_create_adslot div.modal-content');

    return {
        init: function () {
            $('#store_adslot_submit_button').on('click', function(t) {
                // Prevent button default action
                t.preventDefault();

                // Disable button to avoid multiple click
                $(this).prop('disabled',true);
                $(this).find('.indicator-label').hide();
                $(this).find('.indicator-progress').show();

                // Simulate ajax request
                axios.post($('#store_adslot_form').attr('action'), new FormData($('#store_adslot_form')[0]))
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
                            storeAdslotModal.modal('hide');
                        }
                    });
                })
                .catch(function(error) {
                    

                    let dataErrors = error.response.data.errors;
                    // console.log(dataErrors);

                    $('.errors').html('');
                    $(".is-invalid").removeClass("is-invalid");
                    for (const errorsKey in dataErrors) {
                        // console.log('#'+errorsKey+'_error');
                        // console.log(dataErrors[errorsKey]);
                        $('input[id="'+errorsKey+'"]').addClass('is-invalid');
                        $('div[id="'+errorsKey+'_error"]').html(dataErrors[errorsKey]);
                    }


                })
                .then(function() {

                    // Hide loading indication
                    $('#store_adslot_submit_button').find('.indicator-label').show();
                    $('#store_adslot_submit_button').find('.indicator-progress').hide();
                    $('#store_adslot_submit_button').prop('disabled',false);
                });
            });

            $('#go_back_button').on('click', function(t) {
                // Prevent button default action
                t.preventDefault();

                // Disable button to avoid multiple click
                $(this).prop('disabled',true);
                $(this).find('.indicator-label').hide();
                $(this).find('.indicator-progress').show();

                // Simulate ajax request
                axios.post(createAdslotForm.attr('action'), new FormData(createAdslotForm[0]))
                .then(function(response) {
                    modelContent.html(response.data.modelContent);
                    TempStoreAdslot.init();
                    DatePicker.init();
                    PricingMethod.init();
                })
                .catch(function(error) {
                    console.log(error);
                    window.location.reload();

                })
                .then(function() {

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
    CreateAdslot.init();
});
