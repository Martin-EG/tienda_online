<?php


function editUser()
{
 
    global $connection;

    $user_errors = array();
    $user_messages = array();

    if(isset($_POST['edit_user']))
    {
        $query = mysqli_query($connection, "INSERT INTO user_permissions (perm_name)VALUES('ok')");
        array_push($user_messages, "Works");
        
        foreach ($user_messages as $message) {
            echo $message;
        }

        return true;
        
    }
    
}
