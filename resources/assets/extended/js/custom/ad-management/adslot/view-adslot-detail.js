"use strict";

// Class definition
var ViewAdslotDetail = function () {


    var modelContent,viewAdslotDetailForm,viewAdslotDetailModal;

    viewAdslotDetailForm = $('#view_adslot_detail_form');
    viewAdslotDetailModal = $('#modal_view_adslot_detail');
    modelContent = $('#modal_view_adslot_detail div.modal-content');

    // Public functions
    return {
        // Initialization
        init: function () {
            $('#adslot_general_list_table tbody, #adslot_special_list_table tbody').on('click','.view_adslot_detail',function(t){

                t.preventDefault();

               
                // Simulate ajax request
                axios.post(viewAdslotDetailForm.attr('action'), new FormData(viewAdslotDetailForm[0]),
                    {params:{
                        adslot_id: $(this).attr('record_id'),
                        region_id: $(this).attr('region_id'),
                    }} 
                )
                .then(function(response) {
                    modelContent.html(response.data.modelContent);

                })
                .catch(function(error) {
                    console.log(error);
                    window.location.reload();

                })
                .then(function() {

                });

            });
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
