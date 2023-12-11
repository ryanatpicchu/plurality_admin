"use strict";

// Class definition
var SyncScroll = function () {
    var ignoreScrollEvents = false
    // Public functions
    return {
        // Initialization
        init: function (element1, element2) {
            element1.scroll(function (e) {
              var ignore = ignoreScrollEvents
              ignoreScrollEvents = false
              if (ignore) return

              ignoreScrollEvents = true
              element2.scrollTop(element1.scrollTop())
            })

        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    
});
