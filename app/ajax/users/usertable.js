$(document).ready(function() {


    $('#app_users').DataTable({
        'scrollX': true,
        //'bSort': false,
        //'scrollCollapse': true,

        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': {
            'url': 'functions/users/view_users.php'
        },
        'columns': [
            { data: 'user_id' },
            { data: 'user_image' },
            { data: 'user_name' },
            { data: 'user_email' },
            { data: 'user_actions' },
        ]
    });
});

