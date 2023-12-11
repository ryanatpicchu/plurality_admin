"use strict";

// Class definition
var TurnToStandby = function () {
    // Elements
    var form;
    var submitButton;

    // Handle form
    var handleForm = function (e) {
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        

        // Handle form submit
        submitButton.on('click', function (e) {
            // Prevent button default action
            e.preventDefault();

            form.attr('action', '/ad-schedule/turn-to-standby');

            // Show loading indication
            submitButton.attr('data-kt-indicator', 'on');


            // Disable button to avoid multiple click
            submitButton.prop('disabled',true);

            form.submit();
        });
    }

    // Public functions
    return {
        // Initialization
        init: function () {
            form = $('#store_insertion_form');
            submitButton = $('#turn_to_standby');

            handleForm();
        }
    };
}();

// On document ready
jQuery(document).ready(function() {
    TurnToStandby.init();
});
