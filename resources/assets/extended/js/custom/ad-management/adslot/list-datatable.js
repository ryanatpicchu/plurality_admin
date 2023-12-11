"use strict";

var AdslotGeneralList = function() {
    var table = $("#adslot_general_list_table");
    var ajaxUrl = '/ad-management/adslot-general-list-table';
    var ajaxUrlGetTableHeader = '/ad-management/adslot-general-list-table-header';
    
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
                "order": [[ 0, "asc" ]],
                ajax: {
                    url: ajaxUrl+'?channel='+$('#filtered_channel').val()+'&region='+$('#filtered_region').val()+'&channel_group='+$('#filtered_channel_group').val()+'&sale_status='+$('#filtered_sale_status').is(":checked"),
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

        ViewAdslotDetail.init();

    };

    var _initFilterButton = function(){

        $('#filter_button').on('click', function(t) {
            _getTableHeader();
        });
    };

     var _initChannelDropdown = function(){
        $('#filtered_region').on("change", function(){
            $.ajax({
                type: "GET",
                dataType:"html",
                url: '/ad-management/get-channel-groups-by-channel-and-region?channel_id='+$('#filtered_channel').val()+'&region_id='+$(this).val(),
                success: function (data) {
                    $('#filtered_channel_group').html('<option value="-1">All</option>'+data);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    
                }
            });
        });

        $('#filtered_channel').on("change", function(){
            $.ajax({
                type: "GET",
                dataType:"html",
                url: '/ad-management/get-regions-by-channel?channel_id='+$(this).val(),
                success: function (data) {
                    $('#filtered_region').html('<option value="-1">All</option>'+data);
                    $('#filtered_region').trigger('change');
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    
                }
            });
        });

        $('#filtered_channel').trigger('change');
    };

    return {
        init: function() {
            _initChannelDropdown();
            _initFilterButton();
            _getTableHeader();
        }
    }
}();

var AdslotSpecialList = function() {
    var table = $("#adslot_special_list_table");
    var ajaxUrl = '/ad-management/adslot-special-list-table';
    var ajaxUrlGetTableHeader = '/ad-management/adslot-special-list-table-header';
    
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
                "order": [[ 0, "asc" ]],
                ajax: {
                    url: ajaxUrl+'?channel='+$('#filtered_channel_special').val()+'&region='+$('#filtered_region_special').val()+'&channel_group='+$('#filtered_channel_group_special').val()+'&sale_status='+$('#filtered_sale_status_special').is(":checked"),
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

        ViewAdslotDetail.init();

    };

    var _initFilterButton = function(){

        $('#filter_button_special').on('click', function(t) {
            _getTableHeader();
        });
    };

     var _initChannelDropdown = function(){
        $('#filtered_region_special').on("change", function(){
            $.ajax({
                type: "GET",
                dataType:"html",
                url: '/ad-management/get-channel-groups-by-channel-and-region?channel_id='+$('#filtered_channel').val()+'&region_id='+$(this).val(),
                success: function (data) {
                    $('#filtered_channel_group_special').html('<option value="-1">All</option>'+data);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    
                }
            });
        });

        $('#filtered_channel_special').on("change", function(){
            $.ajax({
                type: "GET",
                dataType:"html",
                url: '/ad-management/get-regions-by-channel?channel_id='+$(this).val(),
                success: function (data) {
                    $('#filtered_region_special').html('<option value="-1">All</option>'+data);
                    $('#filtered_region_special').trigger('change');
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    
                }
            });
        });

        $('#filtered_channel_special').trigger('change');
    };

    return {
        init: function() {
            _initChannelDropdown();
            _initFilterButton();
            _getTableHeader();
        }
    }
}();

var PerformanceAdList = function() {
    var table = $("#performance_ad_list_table");
    var ajaxUrl = '/ad-management/performance-ad-list-table';
    var ajaxUrlGetTableHeader = '/ad-management/performance-ad-list-table-header';
    
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

    var _initFilterButton = function(){

        $('#filter_button_performance').on('click', function(t) {
            _getTableHeader();
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
                "order": [[ 0, "asc" ]],
                ajax: {
                    url: ajaxUrl+'?channel='+$('#filtered_channel_performance').val()+'&sale_status='+$('#filtered_sale_status_performance').is(":checked"),
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

        EditPerformanceAd.init();
    };

    

    return {
        init: function() {
            _initFilterButton();
            _getTableHeader();
        }
    }
}();


jQuery(document).ready(function() {
    
    AdslotGeneralList.init();
    AdslotSpecialList.init();
    PerformanceAdList.init();
});