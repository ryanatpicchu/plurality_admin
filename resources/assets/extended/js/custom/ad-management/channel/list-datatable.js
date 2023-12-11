"use strict";

var ChannelList = function() {
    var table = $("#channel_list_table");
    var ajaxUrl = '/ad-management/channel-list-table';
    var ajaxUrlGetTableHeader = '/ad-management/channel-list-table-header';
    
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
                "order": [[ 0, "asc" ]],
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

        EditChannel.init();

    };

    return {
        init: function() {
            _getTableHeader();
        }
    }
}();


jQuery(document).ready(function() {
    
    ChannelList.init();
});