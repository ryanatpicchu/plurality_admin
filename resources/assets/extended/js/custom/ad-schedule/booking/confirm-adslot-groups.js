"use strict";

// Class definition
var ConfirmAdSlotGroups = function () {


    var modelContent,confirmAdSlotGroupsForm,confirmAdSlotGroupsModal;

    confirmAdSlotGroupsForm = $('#confirm_adslot_groups_form');
    confirmAdSlotGroupsModal = $('#modal_confirm_adslot_groups');
    modelContent = $('#modal_confirm_adslot_groups div.modal-content');

    // Public functions
    return {
        // Initialization
        init: function () {
            $('#confirm_adslot_groups_button').on('click',async function(t){

                t.preventDefault();

                // display loading bar, before request
                const myInterceptor = axios.interceptors.request.use(function (config) {

                    modelContent.html('<div class="modal-body"><div class="progress"><div class="progress-bar progress-bar-success progress-bar-striped active progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%; height: 40px"></div></div></div>');

                    return config;
                }, function (error) {
                    return Promise.reject(error);
                });

                //remove error dashed border
                $('li').removeClass('border-dashed-error');
                
                let selected_adslot_groups = [];
                let temp;
                $('a.badge-selected').each(function(){
                    temp = {};
                    temp['region_id'] = $(this).attr('region_id');
                    temp['channel_group_id'] = $(this).attr('channel_group_id');
                    temp['adslot_group_id'] = $(this).attr('adslot_group_id');
                    temp['row'] = $(this).attr('row');
                    temp['date'] = $(this).attr('date');

                    selected_adslot_groups.push(temp);
                });
                
                // Simulate ajax request
                axios.post(confirmAdSlotGroupsForm.attr('action'), 
                    {
                        selected_adslot_groups: JSON.stringify(selected_adslot_groups)
                    }
                )
                .then(function(response) {
                    if(response.data.status == false){
                        
                        
                        $("[class^="+response.data.error_row+"]").addClass('border-dashed-error');
                        Swal.fire({
                            text: response.data.message,
                            icon: "warning",
                            buttonsStyling: false,
                            confirmButtonText: "Ok",
                            customClass: {
                                confirmButton: "btn btn-warning"
                            }
                        }).then(function(result) {
                            if (result.isConfirmed) {

                                confirmAdSlotGroupsModal.modal('hide');
                            }
                        });
                    }
                    else{
                        modelContent.html(response.data.modelContent);    
                        GoEditInsertion.init();
                    }

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
    ConfirmAdSlotGroups.init();
});
