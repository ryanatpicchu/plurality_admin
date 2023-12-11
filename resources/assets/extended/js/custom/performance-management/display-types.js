"use strict";

// Class definition
var DisplayTypes = function () {
    
    // Public functions
    return {
        // Initialization
        init: function () {
            
            $('.display_types').on('change',function(){
                
                

                let tab_id = $(this).closest('.tab-pane').attr('id');
                
                if($(this).val() == 'months'){
                    $('#'+tab_id+'-filtered_'+$(this).val()).show();
                    $('#'+tab_id+'-filtered_quarters').hide();
                    SelectMonths.init($(this).closest('.tab-pane').attr('id'));
                }
                else{
                    $('#'+tab_id+'-filtered_'+$(this).val()).show();
                    $('#'+tab_id+'-filtered_months').hide();
                    SelectQuarters.init($(this).closest('.tab-pane').attr('id'));    
                }
                
                
            })

        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    DisplayTypes.init();
});
