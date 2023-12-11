"use strict";

// Class definition
var DatePicker = function () {
    
    // Public functions
    return {
        // Initialization
        init: function () {
            $(".adslot-date").daterangepicker( {
                    autoApply: true,
                    singleDatePicker: true,
                    showDropdowns: true,
                    minYear: 2000,
                    maxYear: parseInt(moment().format("YYYY"),12),
                    locale: {
                      format: 'YYYY-MM-DD'
                    }
                }, function(start, end, label) {
                    
                }
            ).on("apply.daterangepicker", function (e, picker) {
                $(picker).focus();
            });

        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    DatePicker.init();
});
