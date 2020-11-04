$(document).ready(function() {
    $('#example').DataTable({
        'scrollX': true,
        //'bSort': false,
        //'scrollCollapse': true,

        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': {
            'url': 'functions/functions.php?function=view_category'
        },
        'columns': [
            { data: 'category_id' },
            { data: 'category_name' },
            { data: 'category_btn' },
        ]
    });
});






$(document).ready(function() {


    $('#parts').DataTable({
        'scrollX': true,
        //'bSort': false,
        //'scrollCollapse': true,

        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': {
            'url': 'functions/functions.php?function=view_parts'
        },
        'columns': [
            { data: 'part_id' },
            { data: 'part_consumable' },
            { data: 'part_number' },
            { data: 'part_name' },
            { data: 'part_cost' },
            { data: 'part_stock' },
            { data: 'part_available' },
            { data: 'part_min_stock' },
            { data: 'part_max_stock' },
            { data: 'part_reorder_point' },
            { data: 'part_location' },
            { data: 'part_status' },
            { data: 'part_image' },
            { data: 'part_category' },
            { data: 'part_transactions' },
            { data: 'part_btn' },
        ]
    });
});




$(document).ready(function() {

    $('#partsmove').DataTable({
        'scrollX': true,
        //'bSort': false,
        //'scrollCollapse': true,

        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': {
            'url': 'functions/functions.php?function=view_parts_move'
        },
        'columns': [
            { data: 'part_id' },
            { data: 'part_consumable' },
            { data: 'part_number' },
            { data: 'part_name' },
            { data: 'part_cost' },
            { data: 'part_stock' },
            { data: 'part_available' },
            { data: 'part_min_stock' },
            { data: 'part_max_stock' },
            { data: 'part_reorder_point' },
            { data: 'part_location' },
            { data: 'part_status' },
            { data: 'part_image' },
            { data: 'part_category' },
            { data: 'part_btn' },
        ]

    });

});

/************************************************************************************************************* */
/************************************************************************************************************* */
/************************************************************************************************************* */
$(document).ready(function() {

    $('#partsrecommended').DataTable({
        'scrollX': true,
        //'bSort': false,
        //'scrollCollapse': true,

        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': {
            'url': 'functions/functions.php?function=view_parts_recomended'
        },
        'columns': [
            { data: 'part_id' },
            { data: 'part_number' },
            { data: 'part_name' },
            { data: 'part_cost' },
            { data: 'part_available' },
            { data: 'part_location' },
            { data: 'part_status' },
            { data: 'part_image' },
            { data: 'part_category' },
            { data: 'part_btn' },
        ]

    });

});

/************************************************************************************************************* */
/************************************************************************************************************* */
/************************************************************************************************************* */

$(document).ready(function() {
    $('#machine-cat').DataTable({
        'scrollX': true,
        //'bSort': false,
        //'scrollCollapse': true,

        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': {
            'url': 'functions/functions.php?function=view_machine_cat'
        },
        'columns': [
            { data: 'machine_category_id' },
            { data: 'machine_category_name' },
            { data: 'btn' },
        ]
    });
});



$(document).ready(function() {
    $('#suppliers').DataTable({
        'scrollX': true,
        //'bSort': false,
        //'scrollCollapse': true,

        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': {
            'url': 'functions/functions.php?function=view_suppliers'
        },
        'columns': [
            { data: 'supplier_id' },
            { data: 'supplier_name' },
            { data: 'supplier_address' },
            { data: 'supplier_contact' },
            { data: 'supplier_fiscal' },
            { data: 'supplier_date' },
            { data: 'btn' },
        ]
    });
});





$(document).ready(function() {


    $('#machines').DataTable({
        'scrollX': true,
        //'bSort': false,
        //'scrollCollapse': true,

        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': {
            'url': 'functions/functions.php?function=view_machines'
        },
        'columns': [
            { data: 'machine_id' },
            { data: 'machine_category' },
            { data: 'machine_name' },
            { data: 'machine_serial' },
            { data: 'machine_cn' },
            { data: 'machine_supplier' },
            { data: 'machine_image' },
            { data: 'machine_date' },
            { data: 'machine_btn' },
        ]
    });
});