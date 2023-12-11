"use strict";

// Class definition
var RelatedPackageAdslot = function () {

    // Public functions
    return {
        // Initialization
        init: function () {

            $('#add_new_related_package_adslot_group').on('click', function(t){
                t.preventDefault();
                $('#related_package_adslot_groups_section').append('<div class="row"><div class="col-8"><div class="fv-row mb-7"><select name="related_package_adslot_group[]" class="form-select form-select-sm related_package_adslot_groups" data-control="select2" data-allow-clear="true"></select></div></div></div>');
                RelatedPackageAdslotGroupsDropdown.init();
            });

            RelatedPackageAdslotGroupsDropdown.init();
        }
    };
}();

var RelatedPackageAdslotGroupsDropdown = function () {

    // Public functions
    return {
        // Initialization
        init: function () {
            $('.related_package_adslot_groups').select2({
                dropdownParent: $('#related_package_adslot_groups_section'),
                placeholder: "-",
                ajax: {
                    url: '/ad-management/adslot-group/search-related-package',
                    dataType: 'json'
                    // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
                  }
            });
        }
    };
}();

var RelatedGiveawayAdslot = function () {

    // Public functions
    return {
        // Initialization
        init: function () {

            $('#add_new_related_giveaway_adslot_group').on('click', function(t){
                t.preventDefault();
                $('#related_giveaway_adslot_groups_section').append('<div class="row"><div class="col-8"><div class="fv-row mb-7"><select name="related_giveaway_adslot_group[]" class="form-select form-select-sm related_giveaway_adslot_groups" data-control="select2" data-allow-clear="true"></select></div></div></div>');
                RelatedGiveawayAdslotGroupsDropdown.init();
            });

            RelatedGiveawayAdslotGroupsDropdown.init();
        }
    };
}();

var RelatedGiveawayAdslotGroupsDropdown = function () {

    // Public functions
    return {
        // Initialization
        init: function () {
            $('.related_giveaway_adslot_groups').select2({
                dropdownParent: $('#related_giveaway_adslot_groups_section'),
                placeholder: "-",
                ajax: {
                    url: '/ad-management/adslot-group/search-related-giveaway',
                    dataType: 'json'
                    // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
                  }
            });
        }
    };
}();



