"use strict";

// Class definition
var CreateAdslotGroup = function () {


    var modelContent,createAdslotGroupForm,createAdslotGroupModal;

    createAdslotGroupForm = $('#create_adslot_group_form');
    createAdslotGroupModal = $('#modal_create_adslot_group');
    modelContent = $('#modal_create_adslot_group div.modal-content');

    // Public functions
    return {
        // Initialization
        init: function () {
            $('#create_adslot_group_button').on('click',function(t){
                t.preventDefault();

                
                // Simulate ajax request
                axios.post(createAdslotGroupForm.attr('action'), new FormData(createAdslotGroupForm[0]),
                    {params:{
                        designate_channel: $('#filtered_channel').val(),
                        designate_channel_group: $('#filtered_channel_group').val(),
                    }}
                )
                .then(function(response) {
                    modelContent.html(response.data.modelContent);
                    _initChannelDropdown();
                    StoreAdslotGroup.init();
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

var _initChannelDropdown = function(){

        $('select[name="channel_id"]').on("change", function(){
            $.ajax({
                type: "GET",
                dataType:"html",
                url: '/ad-management/get-channel-groups-by-channel?channel_id='+$(this).val(),
                success: function (data) {
                    $('select[name="channel_group_id"]').html(data);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    
                }
            });
        });

        $('select[name="channel_id"]').trigger('change');

    };

var StoreAdslotGroup = function () {
    var form,storeAdslotGroupModal;
    
    storeAdslotGroupModal = $('#modal_create_adslot_group');

    return {
        init: function () {
            $('#store_adslot_group_submit_button').on('click', function(t) {
                // Prevent button default action
                t.preventDefault();

                // Disable button to avoid multiple click
                $(this).prop('disabled',true);
                $(this).find('.indicator-label').hide();
                $(this).find('.indicator-progress').show();

                // Simulate ajax request
                axios.post($('#store_adslot_group_form').attr('action'), new FormData($('#store_adslot_group_form')[0]))
                .then(function(response) {


                    // Show message popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                    Swal.fire({
                        text: response.data.message,
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    }).then(function(result) {
                        if (result.isConfirmed) {
                            $("#adslot_group_list_table").DataTable().ajax.reload();
                            storeAdslotGroupModal.modal('hide');
                        }
                    });
                })
                .catch(function(error) {
                    console.log(error.response.data.errors);

                    let dataErrors = error.response.data.errors;

                    $('.errors').html('');
                    for (const errorsKey in dataErrors) {
                        $('.'+errorsKey+'_error').html(dataErrors[errorsKey]);
                        $('input[name="'+errorsKey+'"]').addClass('is-invalid');
                    }


                })
                .then(function() {

                    // Hide loading indication
                    $('#store_adslot_group_submit_button').find('.indicator-label').show();
                    $('#store_adslot_group_submit_button').find('.indicator-progress').hide();
                    $('#store_adslot_group_submit_button').prop('disabled',false);
                });
            });
        }
    };
    

    
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    CreateAdslotGroup.init();
});
