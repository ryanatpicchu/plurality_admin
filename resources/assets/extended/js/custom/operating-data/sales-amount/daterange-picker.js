"use strict";

// Class definition
var ByRegionsDateRangePicker = function () {
    
    // Public functions
    return {
        // Initialization
        init: function () {
            var start = moment().startOf('year');
            var end = moment().endOf('year');

            function cb(start, end) {
                $('#sales_amount_by_regions_date_range_picker span').html(start.format('YYYY/MM/DD') + ' - ' + end.format('YYYY/MM/DD'));

                // $('#adslot_start_date').val(start.format('YYYY-MM-DD'));
                // $('#adslot_end_date').val(end.format('YYYY-MM-DD'));
            }

            $('#sales_amount_by_regions_date_range_picker').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                   '今年': [moment().startOf('year'), moment().endOf('year')],
                   '去年': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
                }
            }, cb);

            cb(start, end);
        }
    };
}();

var ByChannelGroupsDateRangePicker = function () {
    
    // Public functions
    return {
        // Initialization
        init: function () {
            var start = moment().startOf('year');
            var end = moment().endOf('year');

            function cb(start, end) {
                $('#sales_amount_by_channel_groups_date_range_picker span').html(start.format('YYYY/MM/DD') + ' - ' + end.format('YYYY/MM/DD'));

                // $('#adslot_start_date').val(start.format('YYYY-MM-DD'));
                // $('#adslot_end_date').val(end.format('YYYY-MM-DD'));
            }

            $('#sales_amount_by_channel_groups_date_range_picker').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                   '今年': [moment().startOf('year'), moment().endOf('year')],
                   '去年': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
                }
            }, cb);

            cb(start, end);
        }
    };
}();

var ByAdSlotGroupsDateRangePicker = function () {
    
    // Public functions
    return {
        // Initialization
        init: function () {
            var start = moment().startOf('year');
            var end = moment().endOf('year');

            function cb(start, end) {
                $('#sales_amount_by_adslot_groups_date_range_picker span').html(start.format('YYYY/MM/DD') + ' - ' + end.format('YYYY/MM/DD'));

                // $('#adslot_start_date').val(start.format('YYYY-MM-DD'));
                // $('#adslot_end_date').val(end.format('YYYY-MM-DD'));
            }

            $('#sales_amount_by_adslot_groups_date_range_picker').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                   '今年': [moment().startOf('year'), moment().endOf('year')],
                   '去年': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
                }
            }, cb);

            cb(start, end);
        }
    };
}();

var ByCitiesDateRangePicker = function () {
    
    // Public functions
    return {
        // Initialization
        init: function () {
            var start = moment().startOf('year');
            var end = moment().endOf('year');

            function cb(start, end) {
                $('#sales_amount_by_cities_date_range_picker span').html(start.format('YYYY/MM/DD') + ' - ' + end.format('YYYY/MM/DD'));

                // $('#adslot_start_date').val(start.format('YYYY-MM-DD'));
                // $('#adslot_end_date').val(end.format('YYYY-MM-DD'));
            }

            $('#sales_amount_by_cities_date_range_picker').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                   '今年': [moment().startOf('year'), moment().endOf('year')],
                   '去年': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
                }
            }, cb);

            cb(start, end);
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    ByRegionsDateRangePicker.init();
    ByChannelGroupsDateRangePicker.init();
    ByAdSlotGroupsDateRangePicker.init();
    ByCitiesDateRangePicker.init();
});
