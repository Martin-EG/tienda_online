$(document).ready(function() {


    $('#app_products').DataTable({
        'scrollX': true,
        //'bSort': false,
        //'scrollCollapse': true,

        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': {
            'url': 'functions/products/view_products.php'
        },
        'columns': [
            { data: 'product_id' },
            { data: 'product_name' },
            { data: 'product_category' },
            { data: 'product_description' },
            { data: 'product_price' },
            { data: 'product_currency_code_id' },
            { data: 'product_qty' },
            { data: 'product_image' },
            { data: 'product_actions' },
        ]
    });
});

