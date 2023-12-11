"use strict";

// Class definition
var AgentChangeSelect = function () {


    // Public functions
    return {
        // Initialization
        init: function () {
            $('.agent-channels').on('change',function(t){

                let parent_container = $(this).closest('.adslot-groups-table');
                let channel_id = $(this).val();
                $.ajax({
                    type: "GET",
                    dataType:"html",
                    url: '/ad-management/get-regions-by-channel?channel_id='+channel_id,
                    success: function (data) {
                        parent_container.find('.agent-regions').html(data);
                        $('.form-select').select2({minimumResultsForSearch: Infinity});
                        _getPerformanceAds(parent_container, channel_id,parent_container.attr('combination_key'), parent_container.attr('row'));
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        
                    }
                });

            })

            $('.agent-regions').on('change',function(t){

                let parent_container = $(this).closest('.adslot-groups-table');
                
                UpdateAgentAdslot.go(parent_container.attr('combination_key'), parent_container.attr('row'));

            })

            $('.agent-ads').on('change',function(t){

                let parent_container = $(this).closest('.adslot-groups-table');
                
                UpdateAgentAdslot.go(parent_container.attr('combination_key'), parent_container.attr('row'));

            })

            $('.agent-start-date, .agent-end-date, .agent_subtotal_sale_price').on('change',function(t){

                let parent_container = $(this).closest('.adslot-groups-table');
                
                UpdateAgentAdslot.go(parent_container.attr('combination_key'), parent_container.attr('row'));

            })

        }
    };
}();

var _getPerformanceAds = function(parent_container,channel_id,combinatino_key,row){
    $.ajax({
        type: "GET",
        dataType:"html",
        url: '/ad-management/get-performance-ads-by-channel?channel_id='+channel_id,
        success: function (data) {
            parent_container.find('.agent-ads').html(data);
            $('.form-select').select2({minimumResultsForSearch: Infinity});

            UpdateAgentAdslot.go(combinatino_key, row)
        },
        error: function (xhr, ajaxOptions, thrownError) {
            
        }
    });
    

};


// On document ready
KTUtil.onDOMContentLoaded(function () {
    AgentChangeSelect.init();
});
