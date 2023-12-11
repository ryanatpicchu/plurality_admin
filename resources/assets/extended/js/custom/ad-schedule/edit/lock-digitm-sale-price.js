"use strict";

// Class definition
var LockDigitmSalePrice = function () {


    var modelContent,lockSalePriceForm,lockSalePriceModal,unlockSalePriceForm,unlockSalePriceModal,unlockModelContent;

    lockSalePriceForm = $('#lock_digitm_sale_price_form');
    lockSalePriceModal = $('#modal_lock_digitm_sale_price');
    modelContent = $('#modal_lock_digitm_sale_price div.modal-content');

    unlockSalePriceForm = $('#unlock_digitm_sale_price_form');
    unlockSalePriceModal = $('#modal_unlock_digitm_sale_price');
    unlockModelContent = $('#modal_unlock_digitm_sale_price div.modal-content');

    // Public functions
    return {
        // Initialization
        init: function () {
            $('.lock-digitm-sale-price').on('change',function(t){

                const ingroup_key = $(this).attr('ingroup-key');

                let selected_adslot_groups = [];
                if (typeof ingroup_key !== 'undefined' && ingroup_key !== false) {
                    $('input.'+$(this).attr('insertion_type')+'-type-d-check-'+ingroup_key).each(function(){
                        selected_adslot_groups.push($(this).val());
                    });
                } 
                else{
                    $('input.'+$(this).attr('insertion_type')+'-type-d-check:checked').each(function(){
                        selected_adslot_groups.push($(this).val());
                    });
                }

                // console.log(selected_adslot_groups);

                if( $(this).is(':checked') ){
                    //售價鎖定功能打勾，進行鎖定售價之確認
                    if(selected_adslot_groups.length <= 0){

                        $(this).prop('checked', false);

                        Swal.fire({
                            text: "請至少選擇一個版位",
                            icon: "warning",
                            buttonsStyling: false,
                            confirmButtonText: "Ok",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        }).then(function(result) {

                            $('#modal_lock_digitm_sale_price').modal("hide");
                        });
                    }
                    else{
                        // display loading bar, before request
                        const myInterceptor = axios.interceptors.request.use(function (config) {

                            modelContent.html('<div class="modal-body"><div class="progress"><div class="progress-bar progress-bar-success progress-bar-striped active progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%; height: 40px"></div></div></div>');

                            return config;
                        }, function (error) {
                            return Promise.reject(error);
                        });
                        // Simulate ajax request
                        axios.post(lockSalePriceForm.attr('action'),
                            {
                                selected_adslot_groups: JSON.stringify(selected_adslot_groups)
                            }
                        )
                        .then(function(response) {
                            modelContent.html(response.data.modelContent);
                            SubmitLockDigitmSalePrice.init();
                        })
                        .catch(function(error) {
                            console.log(error);
                            window.location.reload();

                        })
                        .then(function() {
                            axios.interceptors.request.eject(myInterceptor);
                        });
                    }
                }
                else{
                    //售價鎖定解除
                    // display loading bar, before request
                        const myInterceptor = axios.interceptors.request.use(function (config) {

                            unlockModelContent.html('<div class="modal-body"><div class="progress"><div class="progress-bar progress-bar-success progress-bar-striped active progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%; height: 40px"></div></div></div>');

                            return config;
                        }, function (error) {
                            return Promise.reject(error);
                        });
                        // Simulate ajax request
                        axios.post(unlockSalePriceForm.attr('action'),
                            {
                                selected_adslot_groups: JSON.stringify(selected_adslot_groups)
                            }
                        )
                        .then(function(response) {
                            unlockModelContent.html(response.data.modelContent);
                            SubmitUnlockDigitmSalePrice.init();
                        })
                        .catch(function(error) {
                            console.log(error);
                            window.location.reload();

                        })
                        .then(function() {
                            axios.interceptors.request.eject(myInterceptor);
                        });
                }
                
            })
        }
    };
}();

var SubmitLockDigitmSalePrice = function () {
    // Elements
    var form;
    var submitButton;

    // Handle form
    var handleForm = function (e) {
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        

        // Handle form submit
        submitButton.on('click', function (e) {
            // Prevent button default action
            e.preventDefault();

            form.attr('action', '/ad-schedule/group-lock-digitm-sale-price');

            // Show loading indication
            submitButton.attr('data-kt-indicator', 'on');


            // Disable button to avoid multiple click
            submitButton.prop('disabled',true);

            form.submit();
        });
    }

    // Public functions
    return {
        // Initialization
        init: function () {
            form = $('#group_lock_digitm_sale_price_form');
            submitButton = $('#group_lock_digitm_sale_price_submit_button');

            handleForm();
        }
    };
}();

var SubmitUnlockDigitmSalePrice = function () {
    // Elements
    var unlockForm;
    var unlockSubmitButton;

    // Handle form
    var handleForm = function (e) {
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        

        // Handle form submit
        unlockSubmitButton.on('click', function (e) {
            // Prevent button default action
            e.preventDefault();

            unlockForm.attr('action', '/ad-schedule/group-unlock-digitm-sale-price');

            // Show loading indication
            unlockSubmitButton.attr('data-kt-indicator', 'on');


            // Disable button to avoid multiple click
            unlockSubmitButton.prop('disabled',true);

            unlockForm.submit();
        });
    }

    // Public functions
    return {
        // Initialization
        init: function () {

            unlockForm = $('#group_unlock_digitm_sale_price_form');
            unlockSubmitButton = $('#group_unlock_digitm_sale_price_submit_button');

            handleForm();
        }
    };
}();


// On document ready
KTUtil.onDOMContentLoaded(function () {
    LockDigitmSalePrice.init();
});
