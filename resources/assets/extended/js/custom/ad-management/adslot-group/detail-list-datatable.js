"use strict";

var AdslotGroupDetailList = function() {
    var table = $("#adslot_group_detail_list_table");
    var ajaxUrl = '/ad-management/adslot-group-detail-list-table';
    var ajaxUrlGetTableHeader = '/ad-management/adslot-group-detail-list-table-header';
    
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
        table
        .on('draw.dt', function(e, settings, json) {
            NoteTooltip.init();
        })
        .DataTable({ 
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
                    targets: [0, -1]
                }],
                "order": [[ 1, "asc" ]],
                ajax: {
                    url: ajaxUrl+'?sale_status='+$('#filtered_sale_status').is(":checked"),
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

        StopSaleAdslot.init();
        ResumeSaleAdslot.init();
        EditAdslot.init();
    };

    var _initFilterButton = function(){

        $('#filter_button').on('click', function(t) {
            _getTableHeader();
        });
    };

    return {
        init: function() {
            _getTableHeader();
            _initFilterButton();
        }
    }
}();


jQuery(document).ready(function() {
    
    AdslotGroupDetailList.init();
});