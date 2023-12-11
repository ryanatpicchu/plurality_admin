"use strict";

// Class definition
var SwitchInsertionDisplayType = function () {
    
    // Public functions
    return {
        // Initialization
        init: function () {
           $("#insertion_display_type").on('change',function(){
                $(".display-insertion-counts").hide();
                $("#insertion-counts-"+$(this).val()).show();
           });

        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    SwitchInsertionDisplayType.init();
});
