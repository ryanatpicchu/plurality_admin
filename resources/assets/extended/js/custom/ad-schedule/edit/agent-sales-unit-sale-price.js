"use strict";

// Class definition
var AgentSalesUnitSalePrice = function () {


    var modelContent,salesUnitSalePriceForm,salesUnitSalePriceModal;

    salesUnitSalePriceForm = $('#agent_sales_unit_sale_price_form');
    salesUnitSalePriceModal = $('#modal_agent_sales_unit_sale_price');
    modelContent = $('#modal_agent_sales_unit_sale_price div.modal-content');

    // Public functions
    return {
        // Initialization
        init: function () {
            $('.agent_sales_unit_sale_price_button').on('click',function(t){
                t.preventDefault();

                // display loading bar, before request
                const myInterceptor = axios.interceptors.request.use(function (config) {

                    modelContent.html('<div class="modal-body"><div class="progress"><div class="progress-bar progress-bar-success progress-bar-striped active progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%; height: 40px"></div></div></div>');

                    return config;
                }, function (error) {
                    return Promise.reject(error);
                });

                // Simulate ajax request
                let subtotal_sale_price = 0;

                if(Number.isInteger(parseInt($('#'+$(this).attr('combination_key')+'_'+$(this).attr('row')+'_agent_subtotal_sale_price').val()))){
                    subtotal_sale_price = $('#'+$(this).attr('combination_key')+'_'+$(this).attr('row')+'_agent_subtotal_sale_price').val();
                }

                axios.post(salesUnitSalePriceForm.attr('action'), 
                    {
                        combination_key: $(this).attr('combination_key'),
                        row: $(this).attr('row'),
                        subtotal_sale_price: subtotal_sale_price,
                    }
                )
                .then(function(response) {
                    modelContent.html(response.data.modelContent);
                    CalAgentPromiseQuantity();
                    SubmitConfirmSalesUnitSalePrice.init();
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

var SubmitConfirmSalesUnitSalePrice = function (){
    var modelContent,setSalesUnitSalePriceModal;

    setSalesUnitSalePriceModal = $('#modal_agent_sales_unit_sale_price');
    modelContent = $('#modal_agent_sales_unit_sale_price div.modal-content');
    // Public functions
    return {
        // Initialization
        init: function () {

            $('#set_agent_sales_unit_sale_price_submit_button').on('click',function(t){
                t.preventDefault();
                // Disable button to avoid multiple click
                $(this).prop('disabled',true);
                $(this).find('.indicator-label').hide();
                $(this).find('.indicator-progress').show();



                // Simulate ajax request
                axios.post($('#confirm_agent_sales_unit_sale_price').attr('action'), new FormData($('#confirm_agent_sales_unit_sale_price')[0]))
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

                        $('#agent').html(response.data.html);
                        $('.form-select').select2({minimumResultsForSearch: Infinity});
                        DatePicker.init();
                        DeleteAgentAdSlots.init();
                        AgentSalesUnitSalePrice.init();
                        AgentSubtotalSalePrice.init();
                        AddAgentAdslot.init();
                        CalculateTotalPrice.go();
                        setSalesUnitSalePriceModal.modal('hide');

                        // 讓tab button回到第一個分頁
                        $('a.nav-link').removeClass('active');
                        $('a[href="#agent"]')[0].click();

                    });

                    
                })
                .catch(function(error) {
                    console.log(error);

                })
                .then(function() {

                    // Hide loading indication
                    $('#set_agent_sales_unit_sale_price_submit_button').find('.indicator-label').show();
                    $('#set_agent_sales_unit_sale_price_submit_button').find('.indicator-progress').hide();
                    $('#set_agent_sales_unit_sale_price_submit_button').prop('disabled',false);
                });

            });
        }
    }

        
}();

var CalAgentPromiseQuantity = function(){

    $('#dynamic_agent_subtotal_sale_price').on('keyup',function(){
        let dynamic_promise_quantity = 0;
        dynamic_promise_quantity = ($('#dynamic_agent_subtotal_sale_price').val() / $('#dynamic_agent_sales_unit_list_price').val());
        $('#dynamic_agent_promise_quantity').html(Math.floor(dynamic_promise_quantity));
        $('#new_agent_promise_quantity').val(Math.floor(dynamic_promise_quantity));
    });

    $('#dynamic_agent_sales_unit_list_price').on('keyup',function(){
        let dynamic_promise_quantity = 0;
        dynamic_promise_quantity = ($('#dynamic_agent_subtotal_sale_price').val() / $('#dynamic_agent_sales_unit_list_price').val());
        $('#dynamic_agent_promise_quantity').html(Math.floor(dynamic_promise_quantity));
        $('#new_agent_promise_quantity').val(Math.floor(dynamic_promise_quantity));
    });
}

// On document ready
KTUtil.onDOMContentLoaded(function () {
    AgentSalesUnitSalePrice.init();
});
