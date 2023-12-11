"use strict";

// Class definition
var SelectMonths = function () {
    
    // Public functions
    return {
        // Initialization
        init: function (tab_id) {
            
            /**
             * 初始化，全選/取消全選
             * */
            const addSelectAll = matches => {
                
                if($('select[name="'+tab_id+'-filtered_months"]') .find(':selected').length == 12){
                    return [
                        {id: 'unSelectAll', text: '取消全選', matchIds: matches.map(match => match.id)},
                        ...matches
                    ];
                }
                else{
                    return [
                        {id: 'selectAll', text: '全選', matchIds: matches.map(match => match.id)},
                        ...matches
                    ];
                }
                
              };

            const handleSelection = event => {
                if (event.params.data.id === 'selectAll') {
                $('select[name="'+tab_id+'-filtered_months"]') .val(event.params.data.matchIds);
                $('select[name="'+tab_id+'-filtered_months"]') .trigger('change');
                }
                else if (event.params.data.id === 'unSelectAll') {
                $('select[name="'+tab_id+'-filtered_months"]') .val(null);
                $('select[name="'+tab_id+'-filtered_months"]') .trigger('change');
                };

                $('select[name="'+tab_id+'-filtered_months"]') .select2('close');
            };

            $('select[name="'+tab_id+'-filtered_months"]') .select2({
                multiple: true,
                sorter: addSelectAll,
            });

            $('select[name="'+tab_id+'-filtered_months"]') .on('select2:select', handleSelection);


            /**
             * 預設全選所有月份
             * */
            $('select[name="'+tab_id+'-filtered_months"]') .val(['1','2','3','4','5','6','7','8','9','10','11','12']);
            $('select[name="'+tab_id+'-filtered_months"]') .trigger('change');

        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    SelectMonths.init('personal-summary');
    SelectMonths.init('target-revenue-comparison');
    SelectMonths.init('actual-revenue-comparison');
    SelectMonths.init('combinations');
});
