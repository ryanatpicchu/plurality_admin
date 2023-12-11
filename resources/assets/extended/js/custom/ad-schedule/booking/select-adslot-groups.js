"use strict";

// Class definition
var SelectAdSlotGroups = function () {


    var modelContent,selectAdSlotGroupsForm,selectAdSlotGroupsModal;

    selectAdSlotGroupsForm = $('#select_adslot_groups_form');
    selectAdSlotGroupsModal = $('#modal_select_adslot_groups');
    modelContent = $('#modal_select_adslot_groups div.modal-content');

    // Public functions
    return {
        // Initialization
        init: function () {

            $('#select_adslot_groups_button').on('click',function(t){

                t.preventDefault();

                // Simulate ajax request
                axios.post(selectAdSlotGroupsForm.attr('action'), new FormData(selectAdSlotGroupsForm[0]),
                    {params:{
                        channel_id: $("#available_channels").val()
                    }}
                )
                .then(function(response) {
                    modelContent.html(response.data.modelContent);
                    DisplayBadgeCounts($("#available_channels").val());
                    SelectChannelGroup.init();
                    Actions.init();
                })
                .catch(function(error) {
                    console.log(error);
                    window.location.reload();

                })
                .then(function() {

                });

            })

            $('#available_channels').on('change',function(t){

                t.preventDefault();
                ShowAdslotGroupCounts();
            })

            $('#search_adslot').on('click',async function(t){
                t.preventDefault();

                let selectedAdslotGroupCounts = await AdslotCountsInChannel($("#available_channels").val());

                if(selectedAdslotGroupCounts > 0){
                    GanttGenerator.init();
                }
                else{
                    Swal.fire({
                        text: "請至少選擇一個版位",
                        icon: "warning",
                        buttonsStyling: false,
                        confirmButtonText: "Ok",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    }).then(function(result) {
                        selectAdSlotGroupsModal.modal("hide");
                    });
                }

            })
            
            ShowAdslotGroupCounts();
        }
    };
}();

var ShowAdslotGroupCounts = async function () {
    let selectedAdslotGroupCounts = await AdslotCountsInChannel($("#available_channels").val());

    if(selectedAdslotGroupCounts > 0){
        $('#select_adslot_groups_button .badge').html(selectedAdslotGroupCounts);
        $('#select_adslot_groups_button .badge').show();
    }
    else{
        $('#select_adslot_groups_button .badge').hide();   
        $('#confirm_adslot_groups_button').hide();
    }
    
};

var Actions = function () {

    // Public functions
    return {
        // Initialization
        init: function () {
            $('#confirm_select_adslot_groups').on('click',async function(t){
                ShowAdslotGroupCounts();
                $('#modal_select_adslot_groups').modal('hide');
            });

        }
    };
}();

var SelectChannelGroup = function () {

    
    // Public functions
    return {
        // Initialization
        init: function () {
            $('.available-regions').on('click',function(t){
                
                // Simulate ajax request
                axios.post('/ad-schedule/get-channel-groups-by-channel-and-region',
                    {
                        channel_id: $(this).attr('channel_id'),
                        region_id: $(this).attr('region_id'),
                        display_type: 'modal'
                    }
                )
                .then(function(response) {
                    $('#channel_groups_list_group').html(response.data);
                    $('#adslot_groups_list_group').html("");
                    CheckAdslotGroups.init();
                    DisplayBadgeCounts($(this).attr('channel_id'));
                })
                .catch(function(error) {
                    console.log(error);
                    

                })
                .then(function() {

                });
            });
        }
    };
}();

var CheckAdslotGroups = function () {

    // Public functions
    return {
        // Initialization
        init: function () {
            $('.available-channel-groups').on('click',function(t){
                
                // Simulate ajax request
                axios.post('/ad-schedule/get-adslot-groups-by-channel-group',
                    {
                        channel_id: $(this).attr('channel_id'),
                        region_id: $(this).attr('region_id'),
                        channel_group_id: $(this).attr('channel_group_id')
                    }
                )
                .then(function(response) {
                    $('#adslot_groups_list_group').html(response.data);
                    Adslot.init();
                })
                .catch(function(error) {
                    console.log(error);
                    

                })
                .then(function() {

                });
            });
        }
    };
}();

var Adslot = function(){
    // Public functions
    return {
        // Initialization
        init: async function () {

            let tempStorageObj = await localStorage.getItem('adslotCart');
            let adslotCart = JSON.parse(tempStorageObj);
            if(adslotCart != null){
                $('.available-adslot-groups').each(function(){
                    if(adslotCart[$(this).attr('channel_id')] != undefined && adslotCart[$(this).attr('channel_id')][$(this).attr('region_id')] != undefined && adslotCart[$(this).attr('channel_id')][$(this).attr('region_id')][$(this).attr('channel_group_id')] != undefined){
                        if(adslotCart[$(this).attr('channel_id')][$(this).attr('region_id')][$(this).attr('channel_group_id')].indexOf($(this).attr('adslot_group_id')) == -1){
                            $(this).prop( "checked", false );
                        }
                        else{
                            $(this).prop( "checked", true );   
                        }
                    }
                    
                });
            }
            

            $('.available-adslot-groups').on('change',function(){
                // console.log($(this).is(':checked'));
                if($(this).is(':checked')){
                    AddToCart(this);
                }
                else{
                    RemoveFromCart(this);
                }
            });
        }
    };
}();

var AddToCart = async function(adslot){
    
    let channel_id = $(adslot).attr('channel_id');
    let region_id = $(adslot).attr('region_id');
    let channel_group_id = $(adslot).attr('channel_group_id');
    let adslot_group_id = $(adslot).attr('adslot_group_id');
    let adslotCart;



    // localStorage.removeItem('adslotCart');

    if(localStorage.getItem('adslotCart') !== null){
        let tempStorageObj = await localStorage.getItem('adslotCart');
        adslotCart = JSON.parse(tempStorageObj);
        
    }
    else{
        adslotCart = {};
    }

    if(adslotCart[channel_id] != undefined){
        
        //channel object 存在，繼續檢查地區object
        //localStorage.removeItem('adslotCart');
        if(adslotCart[channel_id][region_id] != undefined){
            if(adslotCart[channel_id][region_id][channel_group_id] != undefined){
                
                if(adslotCart[channel_id][region_id][channel_group_id].indexOf(adslot_group_id) == -1){
                    adslotCart[channel_id][region_id][channel_group_id].push(adslot_group_id);
                }
            }
            else{
                adslotCart[channel_id][region_id][channel_group_id]=[];
                adslotCart[channel_id][region_id][channel_group_id].push(adslot_group_id);
            }
        }
        else{
            adslotCart[channel_id][region_id]={};
            adslotCart[channel_id][region_id][channel_group_id]=[];
            adslotCart[channel_id][region_id][channel_group_id].push(adslot_group_id);
        }
    }
    else{
        //建立channel object
        adslotCart[channel_id]={};
        adslotCart[channel_id][region_id]={};
        adslotCart[channel_id][region_id][channel_group_id]=[];
        adslotCart[channel_id][region_id][channel_group_id].push(adslot_group_id);
        // console.log(JSON.stringify(channelObject));
        
    }

    await localStorage.setItem("adslotCart", JSON.stringify(adslotCart));

    // let temp = await localStorage.getItem('adslotCart');

    // console.log(JSON.parse(temp));

    DisplayBadgeCounts(channel_id);

};

var RemoveFromCart = async function(adslot){
    let channel_id = $(adslot).attr('channel_id');
    let region_id = $(adslot).attr('region_id');
    let channel_group_id = $(adslot).attr('channel_group_id');
    let adslot_group_id = $(adslot).attr('adslot_group_id');
    let adslotCart;

    // localStorage.removeItem('adslotCart');

    if(localStorage.getItem('adslotCart') !== null){
        let tempStorageObj = await localStorage.getItem('adslotCart');
        adslotCart = JSON.parse(tempStorageObj);

        if(adslotCart[channel_id] != undefined){
            if(adslotCart[channel_id][region_id] != undefined){
                if(adslotCart[channel_id][region_id][channel_group_id] != undefined){
                    let indexOfItemToBeRemoved = adslotCart[channel_id][region_id][channel_group_id].indexOf(adslot_group_id);
                    adslotCart[channel_id][region_id][channel_group_id].splice(indexOfItemToBeRemoved,1);   
                    await localStorage.setItem("adslotCart", JSON.stringify(adslotCart));
                }
            }
        }
    }

    DisplayBadgeCounts(channel_id);
};

var DisplayBadgeCounts = async function(channel_id){
    let adslotCart;
    let tempStorageObj = await localStorage.getItem('adslotCart');
    adslotCart = JSON.parse(tempStorageObj);

    // console.log(adslotCart);
    //先算地區的adslot 數量
    $('.available-regions').each(async function(){
        var counts = 0;
        counts = await AdslotCountsInRegion($(this).attr('channel_id'), $(this).attr('region_id'));
        if(counts > 0){
            $(this).find(".badge").html(counts);
            $(this).find(".badge").show();
        }
        else{
            $(this).find(".badge").html('');
            $(this).find(".badge").hide();
        }
        
    });

    //再算頻道的adslot 數量
    $('.available-channel-groups').each(async function(){
        var counts = 0;
        counts = await AdslotCountsInChannelGroup($(this).attr('channel_id'), $(this).attr('region_id'), $(this).attr('channel_group_id'));
        if(counts > 0){
            $(this).find(".badge").html(counts);
            $(this).find(".badge").show();
        }
        else{
            $(this).find(".badge").html('');
            $(this).find(".badge").hide();
        }
        
    });
};

var AdslotCountsInChannel = async function(channel_id){
    let count = 0;
    let tempStorageObj = await localStorage.getItem('adslotCart');
    let adslotCart = JSON.parse(tempStorageObj);

    if(adslotCart != null){
        for(let regionId in adslotCart[channel_id]){

            count += await AdslotCountsInRegion(channel_id, regionId);
        }
    }

    return count;
}

var AdslotCountsInRegion = async function(channel_id, region_id){
    let count = 0;
    let tempStorageObj = await localStorage.getItem('adslotCart');
    let adslotCart = JSON.parse(tempStorageObj);
    if(adslotCart != null){
        if(adslotCart[channel_id] != undefined && adslotCart[channel_id][region_id] != undefined){
            for(let channelGroupId in adslotCart[channel_id][region_id]){
                count += await AdslotCountsInChannelGroup(channel_id, region_id, channelGroupId);
            }
        }
    }
    

    return count;
    
}

var AdslotCountsInChannelGroup = async function(channel_id, region_id, channel_group_id){
    let count = 0;

    let tempStorageObj = await localStorage.getItem('adslotCart');
    let adslotCart = JSON.parse(tempStorageObj);
    if(adslotCart != null){
        if(adslotCart[channel_id] != undefined && adslotCart[channel_id][region_id] != undefined && adslotCart[channel_id][region_id][channel_group_id] != undefined){
            return adslotCart[channel_id][region_id][channel_group_id].length;
        }
    }
    
    
    return 0;
    
}



// On document ready
KTUtil.onDOMContentLoaded(function () {
    SelectAdSlotGroups.init();
});
