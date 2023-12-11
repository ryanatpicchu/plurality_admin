"use strict";

// Class definition
var DeleteRemarketingAdSlots = function () {


    var modelContent,deleteAdSlotsForm,deleteAdSlotsModal;

    deleteAdSlotsForm = $('#delete_remarketing_adslot_form');
    deleteAdSlotsModal = $('#modal_delete_remarketing_adslot');
    modelContent = $('#modal_delete_remarketing_adslot div.modal-content');

    // Public functions
    return {
        // Initialization
        init: function () {
            $('.delete_remarketing_adslot').on('click',function(t){
                t.preventDefault();

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
                        combination_key: $(this).attr('combination_key'),
                        row: $(this).attr('row'),
                    }
                )
                .then(function(response) {
                    modelContent.html(response.data.modelContent);
                    SubmitConfirmDeleteRemarketingAdslot.init();
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

var SubmitConfirmDeleteRemarketingAdslot = function (){
    var modelContent,deleteAdslotsForm,deleteAdslotsModal;

    deleteAdslotsForm = $('#confirm_delete_remarketing_adslot');
    deleteAdslotsModal = $('#modal_delete_remarketing_adslot');
    modelContent = $('#modal_delete_remarketing_adslot div.modal-content');
    // Public functions
    return {
        // Initialization
        init: function () {

            $('#delete_remarketing_adslot_submit_button').on('click',function(t){
                t.preventDefault();
                // Disable button to avoid multiple click
                $(this).prop('disabled',true);
                $(this).find('.indicator-label').hide();
                $(this).find('.indicator-progress').show();

                deleteAdslotsForm = $('#confirm_delete_remarketing_adslot');

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
                        $('#remarketing').html(response.data.html);
                        $('.form-select').select2({minimumResultsForSearch: Infinity});
                        DatePicker.init();
                        DeleteRemarketingAdSlots.init();
                        SalesUnitSalePrice.init();
                        RemarketingSubtotalSalePrice.init();
                        AddRemarketingAdslot.init();
                        CalculateTotalPrice.go();
                        deleteAdslotsModal.modal('hide');
                        
                        
                        // $('#total_subtotal_list_price').html(response.data.total_subtotal_list_price);
                        // $('#total_subtotal_sale_price').html(response.data.total_subtotal_sale_price);
                        // $('#total_discount_percentage').html(response.data.total_discount_percentage);
                        
                        
                        // SubtotalSalePrice.init();
                        
                        // 讓tab button回到第一個分頁
                        $('a.nav-link').removeClass('active');
                        $('a[href="#remarketing"]')[0].click();
                    });

                    
                })
                .catch(function(error) {
                    console.log(error);

                })
                .then(function() {

                    // Hide loading indication
                    $('#delete_remarketing_adslot_submit_button').find('.indicator-label').show();
                    $('#delete_remarketing_adslot_submit_button').find('.indicator-progress').hide();
                    $('#delete_remarketing_adslot_submit_button').prop('disabled',false);
                });

            });
        }
    }

        
}();


// On document ready
KTUtil.onDOMContentLoaded(function () {
    DeleteRemarketingAdSlots.init();
});
