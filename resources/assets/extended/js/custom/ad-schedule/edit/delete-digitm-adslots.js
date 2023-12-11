"use strict";

// Class definition
var DeleteDigitmAdSlots = function () {


    var modelContent,deleteAdSlotsForm,deleteAdSlotsModal;

    deleteAdSlotsForm = $('#delete_digitm_adslots_form');
    deleteAdSlotsModal = $('#modal_delete_digitm_adslots');
    modelContent = $('#modal_delete_digitm_adslots div.modal-content');

    // Public functions
    return {
        // Initialization
        init: function () {
            $('.delete_digitm_adslots_button').on('click',function(t){

                t.preventDefault();

                const ingroup_key = $(this).attr('ingroup-key');

                let selected_adslot_groups = [];
                if (typeof ingroup_key !== 'undefined' && ingroup_key !== false) {
                    $('input.'+$(this).attr('insertion_type')+'-type-d-check-'+ingroup_key+':checked').each(function(){
                        selected_adslot_groups.push($(this).val());
                    });
                } 
                else{
                    $('input.'+$(this).attr('insertion_type')+'-type-d-check:checked').each(function(){
                        selected_adslot_groups.push($(this).val());
                    });
                }

                if(selected_adslot_groups.length <= 0){
                    Swal.fire({
                        text: "請至少選擇一個版位",
                        icon: "warning",
                        buttonsStyling: false,
                        confirmButtonText: "Ok",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    }).then(function(result) {
                        $('#modal_delete_digitm_adslots').modal("hide");
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
                    axios.post(deleteAdSlotsForm.attr('action'), 
                        {
                            selected_adslot_groups: JSON.stringify(selected_adslot_groups)
                        }
                    )
                    .then(function(response) {
                        modelContent.html(response.data.modelContent);
                        SubmitConfirmDeleteDigitmAdslots.init();
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

            $('.delete-digitm-adslot').on('click',function(t){

                t.preventDefault();

                let selected_adslot_groups = [];
                selected_adslot_groups.push($(this).attr('combination_key'));
                
                // display loading bar, before request
                const myInterceptor = axios.interceptors.request.use(function (config) {

                    modelContent.html('<div class="modal-body"><div class="progress"><div class="progress-bar progress-bar-success progress-bar-striped active progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%; height: 40px"></div></div></div>');

                    return config;
                }, function (error) {
                    return Promise.reject(error);
                });

                // Simulate ajax request
                axios.post(deleteAdSlotsForm.attr('action'), 
                    {
                        selected_adslot_groups: JSON.stringify(selected_adslot_groups)
                    }
                )
                .then(function(response) {
                    modelContent.html(response.data.modelContent);
                    SubmitConfirmDeleteDigitmAdslots.init();
                })
                .catch(function(error) {
                    console.log(error);
                    window.location.reload();

                })
                .then(function() {
                    axios.interceptors.request.eject(myInterceptor);
                });

            })
        }
    };
}();

var SubmitConfirmDeleteDigitmAdslots = function (){
    var modelContent,deleteAdslotsForm,deleteAdslotsModal;

    deleteAdslotsForm = $('#confirm_delete_digitm_adslots');
    deleteAdslotsModal = $('#modal_delete_digitm_adslots');
    modelContent = $('#modal_delete_digitm_adslots div.modal-content');
    // Public functions
    return {
        // Initialization
        init: function () {

            $('#delete_digitm_adslots_submit_button').on('click',function(t){
                t.preventDefault();
                // Disable button to avoid multiple click
                $(this).prop('disabled',true);
                $(this).find('.indicator-label').hide();
                $(this).find('.indicator-progress').show();

                deleteAdslotsForm = $('#confirm_delete_digitm_adslots');

                // Simulate ajax request
                axios.post(deleteAdslotsForm.attr('action'), new FormData(deleteAdslotsForm[0]))
                .then(function(response) {
                    // console.log(response);
                    // let data = response.data;
                    Swal.fire({
                        text: response.data.msg,
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    }).then(function(result) {
                        $('#digitm').html(response.data.html);
                        // $('#total_subtotal_list_price').html(response.data.total_subtotal_list_price);
                        // $('#total_subtotal_sale_price').html(response.data.total_subtotal_sale_price);
                        // $('#total_discount_percentage').html(response.data.total_discount_percentage);
                        deleteAdslotsModal.modal('hide');
                        SubtotalSalePrice.init();
                        DeleteDigitmAdSlots.init();
                        CalculateTotalPrice.go();
                        // 讓tab button回到第一個分頁
                        $('a.nav-link').removeClass('active');
                        $('a[href="#digitm"]')[0].click();
                    });

                    
                })
                .catch(function(error) {
                    console.log(error);

                })
                .then(function() {

                    // Hide loading indication
                    $('#delete_digitm_adslots_submit_button').find('.indicator-label').show();
                    $('#delete_digitm_adslots_submit_button').find('.indicator-progress').hide();
                    $('#delete_digitm_adslots_submit_button').prop('disabled',false);
                });

            });
        }
    }

        
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    DeleteDigitmAdSlots.init();
});
