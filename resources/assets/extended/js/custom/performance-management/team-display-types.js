"use strict";

// Class definition
var DisplayTypes = function () {
    
    // Public functions
    return {
        // Initialization
        init: function () {
            
            $('.display_types').on('change',function(){
                
                
                
                if($(this).val() == 'months'){
                    $('#filtered_'+$(this).val()).show();
                    $('#filtered_quarters').hide();
                    SelectMonths.init($(this).closest('.tab-pane').attr('id'));
                }
                else{
                    $('#filtered_'+$(this).val()).show();
                    $('#filtered_months').hide();
                    SelectQuarters.init();    
                }
                
                
            })

        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    DisplayTypes.init();
});
