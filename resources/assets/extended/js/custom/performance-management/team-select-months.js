"use strict";

// Class definition
var SelectMonths = function () {
    
    // Public functions
    return {
        // Initialization
        init: function () {
            
            /**
             * 初始化，全選/取消全選
             * */
            const addSelectAll = matches => {
                
                if($('select[name="filtered_months"]') .find(':selected').length == 12){
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
                $('select[name="filtered_months"]') .val(event.params.data.matchIds);
                $('select[name="filtered_months"]') .trigger('change');
                }
                else if (event.params.data.id === 'unSelectAll') {
                $('select[name="filtered_months"]') .val(null);
                $('select[name="filtered_months"]') .trigger('change');
                };

                $('select[name="filtered_months"]') .select2('close');
            };

            $('select[name="filtered_months"]') .select2({
                multiple: true,
                sorter: addSelectAll,
            });

            $('select[name="filtered_months"]') .on('select2:select', handleSelection);


            /**
             * 預設全選所有月份
             * */
            $('select[name="filtered_months"]') .val(['1','2','3','4','5','6','7','8','9','10','11','12']);
            $('select[name="filtered_months"]') .trigger('change');

        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    SelectMonths.init();
});
