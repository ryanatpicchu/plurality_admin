"use strict";

// Class definition
var GoEditInsertion = function () {
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
            form = $('#go_edit_insertion_form');
            submitButton = $('#go_edit_insertion_button');

            handleForm();
        }
    };
}();

// On document ready
jQuery(document).ready(function() {
    GoEditInsertion.init();
});
