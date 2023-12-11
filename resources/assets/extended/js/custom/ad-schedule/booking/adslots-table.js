"use strict";

// Class definition
var AdslotsTable = function () {

    // Public functions
    return {
        // Initialization
        init: function () {
            $('#adslots_table').bootstrapTable({
              stickyHeader: true,
              stickyHeaderOffsetY: 90,
              fixedColumns: true,
              fixedNumber: 1,
              columns: [{
                field: 'id',
                title: 'Item ID'
            }, {
                field: 'name',
                title: 'Item Name'
            }, {
                field: 'price',
                title: 'Item Price'
            }, {
                field: 'test1',
                title: 'Item Price'
            }, {
                field: 'test2',
                title: 'Item Price'
            }, {
                field: 'test3',
                title: 'Item Price'
            }, {
                field: 'test4',
                title: 'Item Price'
            }, {
                field: 'test5',
                title: 'Item Price'
            }, {
                field: 'test6',
                title: 'Item Price'
            }, {
                field: 'test7',
                title: 'Item Price'
            }],
              data: [{
                id: 1,
                name: 'Item 1',
                price: '$1',
                test1: 'test1',
                test2: 'test2',
                test3: 'test3',
                test4: 'test4',
                test5: 'test5',
                test6: 'test6',
                test7: 'test7',
            }, {
                id: 2,
                name: 'Item 1',
                price: '$1',
                test1: 'test1',
                test2: 'test2',
                test3: 'test3',
                test4: 'test4',
                test5: 'test5',
                test6: 'test6',
                test7: 'test7',
            },
            {
                id: 3,
                name: 'Item 1',
                price: '$1',
                test1: 'test1',
                test2: 'test2',
                test3: 'test3',
                test4: 'test4',
                test5: 'test5',
                test6: 'test6',
                test7: 'test7',
            },
            {
                id: 4,
                name: 'Item 1',
                price: '$1',
                test1: 'test1',
                test2: 'test2',
                test3: 'test3',
                test4: 'test4',
                test5: 'test5',
                test6: 'test6',
                test7: 'test7',
            },
            {
                id: 5,
                name: 'Item 1',
                price: '$1',
                test1: 'test1',
                test2: 'test2',
                test3: 'test3',
                test4: 'test4',
                test5: 'test5',
                test6: 'test6',
                test7: 'test7',
            },
            {
                id: 6,
                name: 'Item 1',
                price: '$1',
                test1: 'test1',
                test2: 'test2',
                test3: 'test3',
                test4: 'test4',
                test5: 'test5',
                test6: 'test6',
                test7: 'test7',
            },
            {
                id: 7,
                name: 'Item 1',
                price: '$1',
                test1: 'test1',
                test2: 'test2',
                test3: 'test3',
                test4: 'test4',
                test5: 'test5',
                test6: 'test6',
                test7: 'test7',
            },
            {
                id: 8,
                name: 'Item 1',
                price: '$1',
                test1: 'test1',
                test2: 'test2',
                test3: 'test3',
                test4: 'test4',
                test5: 'test5',
                test6: 'test6',
                test7: 'test7',
            },
            {
                id: 9,
                name: 'Item 1',
                price: '$1',
                test1: 'test1',
                test2: 'test2',
                test3: 'test3',
                test4: 'test4',
                test5: 'test5',
                test6: 'test6',
                test7: 'test7',
            },
            {
                id: 10,
                name: 'Item 1',
                price: '$1',
                test1: 'test1',
                test2: 'test2',
                test3: 'test3',
                test4: 'test4',
                test5: 'test5',
                test6: 'test6',
                test7: 'test7',
            },
            {
                id: 1,
                name: 'Item 1',
                price: '$1',
                test1: 'test1',
                test2: 'test2',
                test3: 'test3',
                test4: 'test4',
                test5: 'test5',
                test6: 'test6',
                test7: 'test7',
            }, {
                id: 2,
                name: 'Item 1',
                price: '$1',
                test1: 'test1',
                test2: 'test2',
                test3: 'test3',
                test4: 'test4',
                test5: 'test5',
                test6: 'test6',
                test7: 'test7',
            },
            {
                id: 3,
                name: 'Item 1',
                price: '$1',
                test1: 'test1',
                test2: 'test2',
                test3: 'test3',
                test4: 'test4',
                test5: 'test5',
                test6: 'test6',
                test7: 'test7',
            },
            {
                id: 4,
                name: 'Item 1',
                price: '$1',
                test1: 'test1',
                test2: 'test2',
                test3: 'test3',
                test4: 'test4',
                test5: 'test5',
                test6: 'test6',
                test7: 'test7',
            },
            {
                id: 5,
                name: 'Item 1',
                price: '$1',
                test1: 'test1',
                test2: 'test2',
                test3: 'test3',
                test4: 'test4',
                test5: 'test5',
                test6: 'test6',
                test7: 'test7',
            },
            {
                id: 6,
                name: 'Item 1',
                price: '$1',
                test1: 'test1',
                test2: 'test2',
                test3: 'test3',
                test4: 'test4',
                test5: 'test5',
                test6: 'test6',
                test7: 'test7',
            },
            {
                id: 7,
                name: 'Item 1',
                price: '$1',
                test1: 'test1',
                test2: 'test2',
                test3: 'test3',
                test4: 'test4',
                test5: 'test5',
                test6: 'test6',
                test7: 'test7',
            },
            {
                id: 8,
                name: 'Item 1',
                price: '$1',
                test1: 'test1',
                test2: 'test2',
                test3: 'test3',
                test4: 'test4',
                test5: 'test5',
                test6: 'test6',
                test7: 'test7',
            },
            {
                id: 9,
                name: 'Item 1',
                price: '$1',
                test1: 'test1',
                test2: 'test2',
                test3: 'test3',
                test4: 'test4',
                test5: 'test5',
                test6: 'test6',
                test7: 'test7',
            },
            {
                id: 10,
                name: 'Item 1',
                price: '$1',
                test1: 'test1',
                test2: 'test2',
                test3: 'test3',
                test4: 'test4',
                test5: 'test5',
                test6: 'test6',
                test7: 'test7',
            }]
          })
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    AdslotsTable.init();
});
