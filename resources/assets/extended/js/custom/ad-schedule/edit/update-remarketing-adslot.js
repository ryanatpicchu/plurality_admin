"use strict";

// Class definition
var UpdateRemarketingAdslot = function () {


    // Public functions
    return {
        // Initialization
        go: function (combination_key, row) {
            let channel_id = $('#'+combination_key+'_'+row+'_remarketing_channel').val();
            let region_id = $('#'+combination_key+'_'+row+'_remarketing_region').val();
            let ad_id = $('#'+combination_key+'_'+row+'_remarketing_ad').val();
            let start_date = $('#'+combination_key+'_'+row+'_remarketing_start_date').val();
            let end_date = $('#'+combination_key+'_'+row+'_remarketing_end_date').val();
            let subtotal_sale_price = $('#'+combination_key+'_'+row+'_remarketing_subtotal_sale_price').val();

            $.ajax({
                type: "GET",
                dataType:"json",
                url: '/ad-schedule/update-remarketing-adslot?combination_key='+combination_key+'&row='+row+'&channel_id='+channel_id+'&region_id='+region_id+'&ad_id='+ad_id+'&start_date='+start_date+'&end_date='+end_date+'&subtotal_sale_price='+subtotal_sale_price,
                success: function (response) {
                    $('#remarketing').html(response.html);
                    $('.form-select').select2({minimumResultsForSearch: Infinity});
                    DatePicker.init();
                    DeleteRemarketingAdSlots.init();
                    SalesUnitSalePrice.init();
                    RemarketingSubtotalSalePrice.init();
                    AddRemarketingAdslot.init();
                    RemarketingChangeSelect.init();
                    CalculateTotalPrice.go();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    
                }
            });
            //1_1_1_subtotal_sale_price
        }
    };
}();


// On document ready
KTUtil.onDOMContentLoaded(function () {
});
