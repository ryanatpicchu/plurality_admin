"use strict";

var ChannelGroupList = function() {
    var table = $("#channel_group_list_table");
    var ajaxUrl = '/ad-management/channel-group-list-table';
    var ajaxUrlGetTableHeader = '/ad-management/channel-group-list-table-header';
    
    var _getTableHeader = function(){
        $.ajax({
            type: "GET",
            dataType:"json",
            url: ajaxUrlGetTableHeader,
            success: function (data) {
                table.html(data.headers);
                _initTableContent(data.columns, $('#filtered_channel').val());
            },
            error: function (xhr, ajaxOptions, thrownError) {
                
            }
        });
    };

    var _initTableContent = function(columns, channelId){
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
                "order": [[ 0, "asc" ]],
                ajax: {
                    url: ajaxUrl+'?channel_id='+channelId,
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

        EditChannelGroup.init();

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
    
    ChannelGroupList.init();
});