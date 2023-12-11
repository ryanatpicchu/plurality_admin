"use strict";

// Class definition
var StopSaleChannelGroup = function () {


    var modelContent,stopSaleChannelGroupForm,stopSaleChannelGroupModal;

    stopSaleChannelGroupForm = $('#stop_sale_channel_group_form');
    stopSaleChannelGroupModal = $('#modal_stop_sale_channel_group');
    modelContent = $('#modal_stop_sale_channel_group div.modal-content');

    // Public functions
    return {
        // Initialization
        init: function () {
            $('#channel_group_region_list_table tbody').on('click','.stop_sale_channel_group',function(t){
                t.preventDefault();

                // display loading bar, before request
                axios.interceptors.request.use(function (config) {

                    modelContent.html('<div class="modal-body"><div class="progress"><div class="progress-bar progress-bar-success progress-bar-striped active progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%; height: 40px"></div></div></div>');

                    return config;
                }, function (error) {
                    return Promise.reject(error);
                });

                // Simulate ajax request
                axios.post(stopSaleChannelGroupForm.attr('action'), new FormData(stopSaleChannelGroupForm[0]))
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
    // EditChannel.init();
});
