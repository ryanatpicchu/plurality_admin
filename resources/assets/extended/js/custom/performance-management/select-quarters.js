"use strict";

// Class definition
var SelectQuarters = function () {
    
    // Public functions
    return {
        // Initialization
        init: function (tab_id) {
            
            /**
             * 初始化，全選/取消全選
             * */
            const addSelectAll = matches => {
                if($('select[name="'+tab_id+'-filtered_quarters"]').find(':selected').length == 4){
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
                $('select[name="'+tab_id+'-filtered_quarters"]').val(event.params.data.matchIds);
                $('select[name="'+tab_id+'-filtered_quarters"]').trigger('change');
                }
                else if (event.params.data.id === 'unSelectAll') {
                $('select[name="'+tab_id+'-filtered_quarters"]').val(null);
                $('select[name="'+tab_id+'-filtered_quarters"]').trigger('change');
                };

                $('select[name="'+tab_id+'-filtered_quarters"]').select2('close');
            };

            $('select[name="'+tab_id+'-filtered_quarters"]').select2({
                multiple: true,
                sorter: addSelectAll,
            });

            $('select[name="'+tab_id+'-filtered_quarters"]').on('select2:select', handleSelection);


            /**
             * 預設全選所有月份
             * */
            $('select[name="'+tab_id+'-filtered_quarters"]').val(['1','2','3','4']);
            $('select[name="'+tab_id+'-filtered_quarters"]').trigger('change');

        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
});
