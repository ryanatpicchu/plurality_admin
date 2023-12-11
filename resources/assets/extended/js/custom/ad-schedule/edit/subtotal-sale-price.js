"use strict";

// Class definition
var SubtotalSalePrice = function () {


    var modelContent,subtotalSalePriceForm,subtotalSalePriceModal;

    subtotalSalePriceForm = $('#subtotal_sale_price_form');
    subtotalSalePriceModal = $('#modal_subtotal_sale_price');
    modelContent = $('#modal_subtotal_sale_price div.modal-content');

    // Public functions
    return {
        // Initialization
        init: function () {
            $('.subtotal_sale_price_button').on('click',function(t){

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
                        $('#modal_subtotal_sale_price').modal("hide");
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
                    axios.post(subtotalSalePriceForm.attr('action'),
                        {
                            selected_adslot_groups: JSON.stringify(selected_adslot_groups)
                        }
                    )
                    .then(function(response) {
                        modelContent.html(response.data.modelContent);
                        CalDynamicDiscountPercentage();
                        SubmitConfirmSubtotalSalePrice.init();
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

var SubmitConfirmSubtotalSalePrice = function (){
    var modelContent,setSubtotalSalePriceForm,setSubtotalSalePriceModal,confirmSubtotalSalePrice;

    setSubtotalSalePriceForm = $('#subtotal_sale_price_form');
    setSubtotalSalePriceModal = $('#modal_subtotal_sale_price');
    modelContent = $('#modal_subtotal_sale_price div.modal-content');
    // Public functions
    return {
        // Initialization
        init: function () {

            $('#adjust_discount_percentage_submit_button').on('click',function(t){
                t.preventDefault();
                // Disable button to avoid multiple click
                $(this).prop('disabled',true);
                $(this).find('.indicator-label').hide();
                $(this).find('.indicator-progress').show();

                confirmSubtotalSalePrice = $('#confirm_subtoal_sale_price');

                // Simulate ajax request
                axios.post(confirmSubtotalSalePrice.attr('action'), new FormData(confirmSubtotalSalePrice[0]))
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

                        $('#on-site').html(response.data.html);
                        $('#total_subtotal_list_price').html(response.data.total_subtotal_list_price);
                        $('#total_subtotal_sale_price').html(response.data.total_subtotal_sale_price);
                        $('#total_discount_percentage').html(response.data.total_discount_percentage);
                        setSubtotalSalePriceModal.modal('hide');
                        SubtotalSalePrice.init();
                        LockSalePrice.init();
                        DeleteAdSlots.init();
                        CalculateTotalPrice.go();

                        // 讓tab button回到第一個分頁
                        $('a.nav-link').removeClass('active');
                        $('a[href="#on-site"]')[0].click();

                    });

                    
                })
                .catch(function(error) {
                    console.log(error);

                    

                })
                .then(function() {

                    // Hide loading indication
                    $('#adjust_discount_percentage_submit_button').find('.indicator-label').show();
                    $('#adjust_discount_percentage_submit_button').find('.indicator-progress').hide();
                    $('#adjust_discount_percentage_submit_button').prop('disabled',false);
                });

            });
        }
    }

        
}();

var CalDynamicDiscountPercentage = function(){

    /**
     * 先計算一次
     * */
    let dynamic_discount_percentage = 0;
    dynamic_discount_percentage = ($('#dynamic_subtotal_list_price').val() - $('#dynamic_subtotal_sale_price').val()) / $('#dynamic_subtotal_list_price').val();
    $('#dynamic_discount_percentage').html(((1-dynamic_discount_percentage)*100).toFixed(2)+'%')
    $('#new_discount_percentage').val(dynamic_discount_percentage * 100);

    $('#dynamic_subtotal_sale_price').on('keyup',function(){
        let dynamic_discount_percentage = 0;
        dynamic_discount_percentage = ($('#dynamic_subtotal_list_price').val() - $(this).val()) / $('#dynamic_subtotal_list_price').val();
        $('#dynamic_discount_percentage').html(((1-dynamic_discount_percentage)*100).toFixed(2)+'%')
        $('#new_discount_percentage').val(dynamic_discount_percentage * 100);
    });
}

// On document ready
KTUtil.onDOMContentLoaded(function () {
    SubtotalSalePrice.init();
});
