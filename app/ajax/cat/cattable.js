$(document).ready(function() {


    $('#cat').DataTable({
        'scrollX': true,
        //'bSort': false,
        //'scrollCollapse': true,

        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': {
            'url': 'functions/cat/view_cat.php'
        },
        'columns': [
            { data: 'cat_id' },
            { data: 'cat_name' },
            { data: 'cat_actions' },
        ]
    });
});

