"use strict";

// Class definition
var AddAgentAdslot = function () {

    var modelContent,addAdSlotForm,addAdSlotModal;

    addAdSlotModal = $('#modal_add_agent_adslot');
    modelContent = $('#modal_add_agent_adslot div.modal-content');

    // Public functions
    return {
        // Initialization
        init: function () {
            $('.add_agent_adslot').on('click',function(t){
                
                t.preventDefault();

                // display loading bar, before request
                const myInterceptor = axios.interceptors.request.use(function (config) {

                    modelContent.html('<div class="modal-body"><div class="progress"><div class="progress-bar progress-bar-success progress-bar-striped active progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%; height: 40px"></div></div></div>');

                    return config;
                }, function (error) {
                    return Promise.reject(error);
                });

                // Simulate ajax request
                axios.post('/ad-schedule/add-agent-adslot')
                .then(function(response) {
                    $('#agent_add_adslot_button').before(response.data.html);
                    $('.form-select').select2({minimumResultsForSearch: Infinity});
                    DatePicker.init();
                    DeleteAgentAdSlots.init();
                    SalesUnitSalePrice.init();
                    AgentSubtotalSalePrice.init();
                    AgentChangeSelect.init();
                    CalculateTotalPrice.go();
                    addAdSlotModal.modal('hide');
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
    AddAgentAdslot.init();
});
