"use strict";

// Class definition
var CopyTable = function () {
    
    // Public functions
    return {
        // Initialization
        init: function () {
           $(".copy-table").on('click',function(){
                document.getSelection().removeAllRanges();
                // console.log($(this).attr('table'));

                let urlField = document.getElementById($(this).attr('table'));
                   
                // create a Range object
                var range = document.createRange();  
                // set the Node to select the "range"
                range.selectNode(urlField);
                // add the Range to the set of window selections
                window.getSelection().addRange(range);
                   
                // execute 'copy', can't 'cut' in this case
                document.execCommand('copy');

                document.clear();
           });

        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    CopyTable.init();
});
