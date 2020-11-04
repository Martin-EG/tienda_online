$(document).ready(function() {


    $('#app_inventory').DataTable({
        'scrollX': true,
        //'bSort': false,
        //'scrollCollapse': true,

        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': {
            'url': 'functions/inventory/view_inventory.php'
        },
        'columns': [
            { data: 'product_id' },
            { data: 'product_name' },
            { data: 'product_category' },
            { data: 'product_qty' },
            { data: 'product_image' },
            { data: 'product_actions' },
        ]
    });
});

