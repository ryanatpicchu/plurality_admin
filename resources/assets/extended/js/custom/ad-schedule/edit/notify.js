"use strict";



var SaveNotify = function () {

    var _init = function(){
        var isEmpty = function(el){
            return !$.trim(el.html())  
        };
        
        if (!isEmpty($('#notify_title'))) {
                var content = {};

                content.message = '';
                content.title = $('#notify_title').html();

                var notify = $.notify(content, {
                    type: 'success',
                    allow_dismiss: true,
                    placement: {
                        from: 'top',
                        align: 'center'
                    },
                    delay: 1000,
                    z_index: 10000,
                    animate: {
                        enter: 'animate__animated animate__fadeIn',
                        exit: 'animate__animated animate__fadeOut'
                    }
                });

        }
    }


    return {
        // public functions
        init: function() {
            _init();
        }
    };
}();


jQuery(document).ready(function () {
    
    SaveNotify.init();
});
