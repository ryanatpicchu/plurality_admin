"use strict";

// Class definition
var ShowMeterialSettingNote = function () {


    var modelContent,materialSettingNoteForm,materialSettingNoteModal;

    materialSettingNoteForm = $('#material_setting_note_form');
    materialSettingNoteModal = $('#modal_material_setting_note');
    modelContent = $('#modal_material_setting_note div.modal-content');

    // Public functions
    return {
        // Initialization
        init: function () {
            $('#material_setting_unfinished_list_table tbody').on('click','.material_setting_note_button',function(t){

                t.preventDefault();

                // display loading bar, before request
                axios.interceptors.request.use(function (config) {

                    modelContent.html('<div class="modal-body"><div class="progress"><div class="progress-bar progress-bar-success progress-bar-striped active progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%; height: 40px"></div></div></div>');

                    return config;
                }, function (error) {
                    return Promise.reject(error);
                });

                // Simulate ajax request
                axios.post(materialSettingNoteForm.attr('action'), new FormData(materialSettingNoteForm[0]))
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
    // ShowMeterialSettingNote.init();
});

// Webpack support
if (typeof module !== 'undefined' && typeof module.exports !== 'undefined') {
    // console.log('module export initialing...');
    // module.exports = ShowMeterialSettingNote;
}
