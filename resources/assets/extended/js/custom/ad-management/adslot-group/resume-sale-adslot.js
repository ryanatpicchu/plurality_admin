"use strict";

// Class definition
var ResumeSaleAdslot = function () {


    var modelContent,resumeSaleAdslotForm,resumeSaleAdslotModal;

    resumeSaleAdslotForm = $('#resume_sale_adslot_form');
    resumeSaleAdslotModal = $('#modal_resume_sale_adslot');
    modelContent = $('#modal_resume_sale_adslot div.modal-content');

    // Public functions
    return {
        // Initialization
        init: function () {
            $('#adslot_group_detail_list_table tbody').on('click','.resume_sale_adslot',function(t){
                t.preventDefault();

                // Simulate ajax request
                axios.post(resumeSaleAdslotForm.attr('action'), new FormData(resumeSaleAdslotForm[0]),
                    {params:{
                        adslot_id: $(this).attr('record_id')
                    }}
                )
                .then(function(response) {
                    modelContent.html(response.data.modelContent);
                    ChangeAdslotStatus.init('modal_resume_sale_adslot');
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
