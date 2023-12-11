"use strict";

// Class definition
var StopSaleAdslot = function () {


    var modelContent,stopSaleAdslotForm,stopSaleAdslotModal;

    stopSaleAdslotForm = $('#stop_sale_adslot_form');
    stopSaleAdslotModal = $('#modal_stop_sale_adslot');
    modelContent = $('#modal_stop_sale_adslot div.modal-content');

    // Public functions
    return {
        // Initialization
        init: function () {
            $('#adslot_group_detail_list_table tbody').on('click','.stop_sale_adslot',function(t){
                t.preventDefault();

                // Simulate ajax request
                axios.post(stopSaleAdslotForm.attr('action'), new FormData(stopSaleAdslotForm[0]),
                    {params:{
                        adslot_id: $(this).attr('record_id')
                    }}
                )
                .then(function(response) {
                    modelContent.html(response.data.modelContent);
                    ChangeAdslotStatus.init('modal_stop_sale_adslot');
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
