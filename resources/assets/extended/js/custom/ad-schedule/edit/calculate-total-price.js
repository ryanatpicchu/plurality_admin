"use strict";

// Class definition
var CalculateTotalPrice = function () {

    // Public functions
    return {
        // Initialization
        go: function () {
            // Simulate ajax request
            axios.post('/ad-schedule/calculate-total-price')
            .then(function(response) {
                
                $('#total_subtotal_list_price').html(response.data.total_subtotal_list_price);
                $('#total_subtotal_sale_price').html(response.data.total_subtotal_sale_price);
                $('#total_discount_percentage').html(response.data.total_discount_percentage);
            })
            .catch(function(error) {
                console.log(error);
                window.location.reload();

            })
            .then(function() {
                // axios.interceptors.request.eject(myInterceptor);
            });
            
        }
    };
}();


// On document ready
KTUtil.onDOMContentLoaded(function () {
    // CalculateTotalPrice.go();
});
