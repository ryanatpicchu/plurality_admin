"use strict";

var SalesRateByRegionsList = function() {
    var table = $("#sales-rate-by-regions");
    

    return {
        init: function() {
            table
            .DataTable({ 
                    searchDelay: 500,
                    processing: true,
                    destroy: true,
                    lengthMenu: [[5, 10, 50, -1], [5, 10, 50, "All"]],
                    pageLength: 50,
                    "order": [[ 0, "asc" ]],
                    buttons: []
            })  
        }
    }
}();


jQuery(document).ready(function() {
    
    SalesRateByRegionsList.init();
});