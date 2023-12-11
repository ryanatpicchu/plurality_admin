"use strict";

var SalesRateByChannelGroupsList = function() {
    var table = $("#sales-rate-by-channel-groups");
    

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
                    buttons: [],
                    "columns": [
                        { "width": "50%" },
                        { "width": "50%" },
                    ]
            })  
        }
    }
}();


jQuery(document).ready(function() {
    
    SalesRateByChannelGroupsList.init();
});