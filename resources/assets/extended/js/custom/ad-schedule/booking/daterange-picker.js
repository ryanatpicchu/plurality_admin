"use strict";

// Class definition
var DateRangePicker = function () {
    
    // Public functions
    return {
        // Initialization
        init: function () {
            var start = moment();
            var end = moment().add(30, 'days');

            function cb(start, end) {
                $('#date_range_picker span').html(start.format('YYYY/MM/DD') + ' - ' + end.format('YYYY/MM/DD'));

                $('#adslot_start_date').val(start.format('YYYY-MM-DD'));
                $('#adslot_end_date').val(end.format('YYYY-MM-DD'));
            }

            $('#date_range_picker').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                   'Today': [moment(), moment()],
                   'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                   'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                   'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                   'This Month': [moment().startOf('month'), moment().endOf('month')],
                   'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, cb);

            cb(start, end);
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    DateRangePicker.init();
});
