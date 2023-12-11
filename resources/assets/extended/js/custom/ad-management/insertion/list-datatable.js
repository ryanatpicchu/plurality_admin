"use strict";

var InsertionList = function() {
    var table = $("#insertion_list_table");
    var ajaxUrl = '/ad-management/insertion-list-table';
    var ajaxUrlGetTableHeader = '/ad-management/insertion-list-table-header';
    
    var _getTableHeader = function(){
        $.ajax({
            type: "GET",
            dataType:"json",
            url: ajaxUrlGetTableHeader,
            success: function (data) {
                table.html(data.headers);
                _initTableContent(data.columns);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                
            }
        });
    };

    var _initTableContent = function(columns){
        table.DataTable({ 
                "scrollY": 300,
                "scrollX": true,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                destroy: true,
                lengthMenu: [[5, 10, 50, -1], [5, 10, 50, "All"]],
                pageLength: 5,
                columnDefs: [{
                    orderable: !1,
                    targets: [-1]
                }],
                "order": [[ 0, "desc" ]],
                ajax: {
                    url: ajaxUrl,
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataSrc:'data'
                },
                "columns": columns,
                buttons: [
                ],
        })  
    };

    
    return {
        init: function() {
            _getTableHeader();
        }
    }
}();


jQuery(document).ready(function() {
    
    InsertionList.init();
});