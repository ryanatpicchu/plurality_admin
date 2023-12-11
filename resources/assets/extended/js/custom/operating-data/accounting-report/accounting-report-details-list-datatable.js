"use strict";

var AccountingReportDetailsList = function() {
    var table = $("#accounting-report-details");
    

    return {
        init: function() {
            table
            .DataTable({ 
                searchDelay: 500,
                processing: true,
                destroy: true,
                lengthMenu: [[5, 10, 50, -1], [5, 10, 50, "All"]],
                pageLength: 5,
                "order": [[ 0, "asc" ]],
                buttons: []
            })  
        }
    }
}();


jQuery(document).ready(function() {
    
    AccountingReportDetailsList.init();
});