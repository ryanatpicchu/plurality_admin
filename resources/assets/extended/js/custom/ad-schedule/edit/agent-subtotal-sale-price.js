"use strict";

// Class definition
var AgentSubtotalSalePrice = function () {


    // Public functions
    return {
        // Initialization
        init: function () {
            $('.agent_subtotal_sale_price').on('keyup',function(t){
                t.preventDefault();
                let combination_key = $(this).attr('combination_key');
                let row = $(this).attr('row');
                $('#'+combination_key+'_'+row+'_agent_sale_price').html(parseInt($(this).val()));
                let promise_quantity = parseInt($(this).val()) / parseInt($('#'+combination_key+'_'+row+'_agent_list_price').html());
                $('#'+combination_key+'_'+row+'_agent_promise_quantity').html(Math.floor(promise_quantity));
                
            })
        }
    };
}();


// On document ready
KTUtil.onDOMContentLoaded(function () {
    AgentSubtotalSalePrice.init();
});
