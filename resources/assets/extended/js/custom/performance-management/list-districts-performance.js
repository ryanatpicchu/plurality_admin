"use strict";

// Class definition
var ListDistrictsPerformance = function () {


    var modelContent,listDistrictsPerformanceForm,listDistrictsPerformanceModal;

    listDistrictsPerformanceForm = $('#list_districts_performance_form');
    listDistrictsPerformanceModal = $('#modal_list_districts_performance');
    modelContent = $('#modal_list_districts_performance div.modal-content');

    // Public functions
    return {
        // Initialization
        init: function () {
            $('.city_to_list_districts_performance').on('click',function(t){
                t.preventDefault();

                // Simulate ajax request
                axios.post(listDistrictsPerformanceForm.attr('action'), new FormData(listDistrictsPerformanceForm[0]))
                .then(function(response) {
                    modelContent.html(response.data.modelContent);
                })
                .catch(function(error) {
                    console.log(error);
                    window.location.reload();

                })
                .then(function() {

                });

            })
        }
    };
}();


// On document ready
KTUtil.onDOMContentLoaded(function () {
    ListDistrictsPerformance.init();
});
