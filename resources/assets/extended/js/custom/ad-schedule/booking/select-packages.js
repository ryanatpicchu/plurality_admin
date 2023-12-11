"use strict";

// Class definition
var SelectPackages = function () {


    var modelContent,selectPackagesForm,selectPackagesModal;

    selectPackagesForm = $('#select_packages_form');
    selectPackagesModal = $('#modal_select_packages');
    modelContent = $('#modal_select_packages div.modal-content');

    // Public functions
    return {
        // Initialization
        init: function () {
            $('#select_packages_button').on('click',function(t){

                t.preventDefault();

                // display loading bar, before request
                axios.interceptors.request.use(function (config) {

                    modelContent.html('<div class="modal-body"><div class="progress"><div class="progress-bar progress-bar-success progress-bar-striped active progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%; height: 40px"></div></div></div>');

                    return config;
                }, function (error) {
                    return Promise.reject(error);
                });

                // Simulate ajax request
                axios.post(selectPackagesForm.attr('action'), new FormData(selectPackagesForm[0]))
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
    SelectPackages.init();
});
