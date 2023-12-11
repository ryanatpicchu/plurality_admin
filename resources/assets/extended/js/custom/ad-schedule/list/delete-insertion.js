"use strict";

// Class definition
var DeleteInsertionConfirm = function () {


    var modelContent,deleteInsertionForm,deleteInsertionModal;

    deleteInsertionForm = $('#delete_insertion_confirm_form');
    deleteInsertionModal = $('#modal_delete_insertion');
    modelContent = $('#modal_delete_insertion div.modal-content');

    // Public functions
    return {
        // Initialization
        init: function () {

            $('#ad_list_table tbody').on('click','.delete_insertion',function(t){
                
                t.preventDefault();

                // display loading bar, before request
                const myInterceptor = axios.interceptors.request.use(function (config) {

                    modelContent.html('<div class="modal-body"><div class="progress"><div class="progress-bar progress-bar-success progress-bar-striped active progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%; height: 40px"></div></div></div>');

                    return config;
                }, function (error) {
                    return Promise.reject(error);
                });

                // Simulate ajax request

                axios.post(deleteInsertionForm.attr('action'), 
                    new FormData(deleteInsertionForm[0]),
                    {params:{
                        insertion_id: $(this).attr('insertion_id')
                    }} )
                .then(function(response) {
                    modelContent.html(response.data.modelContent);
                    DeleteInsertion.init();
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

var DeleteInsertion = function () {
    var form,deleteInsertionModal;
    
    deleteInsertionModal = $('#modal_delete_insertion');

    return {
        init: function () {
            $('#delete_insertion_submit_button').on('click', function(t) {
                // Prevent button default action
                t.preventDefault();

                // Disable button to avoid multiple click
                $(this).prop('disabled',true);
                $(this).find('.indicator-label').hide();
                $(this).find('.indicator-progress').show();

                // Simulate ajax request
                axios.post($('#delete_insertion_form').attr('action'), new FormData($('#delete_insertion_form')[0]))
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
                            $("#ad_list_table").DataTable().ajax.reload(null, false);

                            deleteInsertionModal.modal('hide');
                        }
                    });
                })
                .catch(function(error) {
                    console.log(error.response.data.errors);
                })
                .then(function() {
                });
            });
        }
    };
    

    
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    
});
