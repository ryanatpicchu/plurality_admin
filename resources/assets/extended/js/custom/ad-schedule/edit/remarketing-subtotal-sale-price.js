"use strict";

// Class definition
var RemarketingSubtotalSalePrice = function () {


    // Public functions
    return {
        // Initialization
        init: function () {
            $('.remarketing_subtotal_sale_price').on('keyup',function(t){
                t.preventDefault();
                let combination_key = $(this).attr('combination_key');
                let row = $(this).attr('row');
                $('#'+combination_key+'_'+row+'_remarketing_sale_price').html(parseInt($(this).val()));
                let promise_quantity = parseInt($(this).val()) / parseInt($('#'+combination_key+'_'+row+'_remarketing_list_price').html());
                $('#'+combination_key+'_'+row+'_remarketing_promise_quantity').html(Math.floor(promise_quantity));
                
            })
        }
    };
}();


// On document ready
KTUtil.onDOMContentLoaded(function () {
    RemarketingSubtotalSalePrice.init();
});
