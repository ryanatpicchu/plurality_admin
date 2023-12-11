"use strict";

// Class definition
var NoteTooltip = function () {


    // Public functions
    return {
        // Initialization
        init: function () {
            $('[data-bs-toggle="tooltip"]').tooltip();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
});
