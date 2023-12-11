"use strict";

// Class definition
var GanttGenerator = function () {
    
    var modelContent;

    modelContent = $('#modal_select_adslot_groups div.modal-content');

    // Public functions
    return {
        // Initialization
        init: async function () {

            var modal_element;
            var modal;

            
            // display loading bar, before request
            const myInterceptor = axios.interceptors.request.use(function (config) {
                modelContent.html('<div class="modal-body"><div class="progress"><div class="progress-bar progress-bar-success progress-bar-striped active progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%; height: 40px"></div></div></div>');

                return config;
            }, function (error) {
                return Promise.reject(error);
            });

            let storageObj = await localStorage.getItem('adslotCart');

            // Simulate ajax request
            axios.post('/ad-schedule/generate-gantts',
            {
                adslot_cart: storageObj,
                selected_channel: $('#available_channels').val(),
                start_date: $('#adslot_start_date').val(),
                end_date: $('#adslot_end_date').val()
            }
            )
            .then(function(response) {
                
                $('#adslot_groups_container').html(response.data.html).ready(function () {
                    modal_element = document.querySelector('#modal_select_adslot_groups');
                    modal = bootstrap.Modal.getInstance(modal_element);    
                    modal.toggle();

                    SetAdSlotDate.init();
                    CellPicker.init();
                    SyncScroll.init($(".gantt_info_body"), $(".gantt_content_body"));
                    SyncScroll.init($(".gantt_content_body"), $(".gantt_info_body"));
                    $('#confirm_adslot_groups_button').show();
                });

            })
            .catch(function(error) {
                console.log(error);
            })
            .then(function() {
                axios.interceptors.request.eject(myInterceptor);
                
            });
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
});
