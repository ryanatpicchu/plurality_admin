"use strict";

var AdslotGroupList = function() {
    var table = $("#adslot_group_list_table");
    var ajaxUrl = '/ad-management/adslot-group-list-table';
    var ajaxUrlGetTableHeader = '/ad-management/adslot-group-list-table-header';
    
    var _getTableHeader = function(){
        $.ajax({
            type: "GET",
            dataType:"json",
            url: ajaxUrlGetTableHeader,
            success: function (data) {
                table.html(data.headers);
                _initTableContent(data.columns, $('#filtered_channel').val(), $('#filtered_channel_group').val());
            },
            error: function (xhr, ajaxOptions, thrownError) {
                
            }
        });
    };

    var _initTableContent = function(columns, channelId, channelGroupId){
        table.DataTable({ 
                "scrollY": 300,
                "scrollX": true,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                destroy: true,
                lengthMenu: [[5, 10, 50, -1], [5, 10, 50, "All"]],
                pageLength: -1,
                columnDefs: [{
                    orderable: !1,
                    targets: [-1]
                }],
                "order": [[ 0, "asc" ]],
                ajax: {
                    url: ajaxUrl+'?channel_id='+channelId+'&channel_group_id='+channelGroupId,
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

        EditAdslotGroup.init();

    };

    var _initChannelDropdown = function(){

        $('#filtered_channel').on("change", function(){
            $.ajax({
                type: "GET",
                dataType:"html",
                url: '/ad-management/get-channel-groups-by-channel?channel_id='+$(this).val(),
                success: function (data) {
                    $('#filtered_channel_group').html('<option value="-1">All</option>'+data);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    
                }
            });
        });

        $('#filtered_channel').trigger('change');
        
    };

    var _initFilterButton = function(){

        $('#filter_button').on('click', function(t) {
            _getTableHeader();
        });
    };

    return {
        init: function() {
            _initChannelDropdown();
            _initFilterButton();
            _getTableHeader();
        }
    }
}();


jQuery(document).ready(function() {
    
    AdslotGroupList.init();
});