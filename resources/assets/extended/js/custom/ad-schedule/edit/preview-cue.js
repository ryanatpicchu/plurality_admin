"use strict";

// Class definition
var PreviewCue = function () {


    var modelContent,previewCueForm,previewCueModal;

    previewCueForm = $('#cue_preview_form');
    previewCueModal = $('#modal_cue_preview');
    modelContent = $('#modal_cue_preview div.modal-content');

    // Public functions
    return {
        // Initialization
        init: function () {
            
            $('#preview_cue').on('click',function(t){

                t.preventDefault();
                // // display loading bar, before request
                const myInterceptor = axios.interceptors.request.use(function (config) {

                    modelContent.html('<div class="modal-body"><div class="progress"><div class="progress-bar progress-bar-success progress-bar-striped active progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%; height: 40px"></div></div></div>');

                    return config;
                }, function (error) {
                    return Promise.reject(error);
                });
                // Simulate ajax request
                axios.post(previewCueForm.attr('action'))
                .then(function(response) {
                    modelContent.html(response.data.modelContent);
                    
                })
                .catch(function(error) {
                    console.log(error);
                    window.location.reload();

                })
                .then(function() {
                    axios.interceptors.request.eject(myInterceptor);
                });
            })
        }
    };
}();


// On document ready
KTUtil.onDOMContentLoaded(function () {
    PreviewCue.init();
});
