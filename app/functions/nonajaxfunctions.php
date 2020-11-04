<?php

require_once("config/db.php");

function editProfile()
{
    global $connection;

    if(isset($_POST['edit_profile']))
    {
        $us                     = $_SESSION['user_name'];
        $user_email             = mysqli_real_escape_string($connection,$_POST['user_email']);
        $user_area_code         = mysqli_real_escape_string($connection,$_POST['user_area_code']);
        $user_phone             = mysqli_real_escape_string($connection,$_POST['user_phone']);
        $user_first_name        = mysqli_real_escape_string($connection,$_POST['user_first_name']);
        $user_last_name         = mysqli_real_escape_string($connection,$_POST['user_last_name']);
        $user_employee_number   = mysqli_real_escape_string($connection,$_POST['user_employee_number']);


        $stmt = $connection->prepare("UPDATE users SET user_email = ?, user_area_code = ?, user_phone = ?, user_first_name = ?, user_last_name = ?, user_employee_number = ? WHERE user_name = ?");
        $stmt->bind_param("sssssss", $user_email, $user_area_code, $user_phone, $user_first_name, $user_last_name, $user_employee_number, $us);
        $stmt->execute();
        if($stmt->affected_rows === -1)
            echo 'Query error';
        //if($stmt->affected_rows === 0)
            //echo 'No rows updated'; 
        $stmt->close();

        return true;
        //echo "<script>swal('Success','Profile Updated','success')</script>;";

    }
}

function respondCorrective()
{
    global $connection;

    if(isset($_POST['respond_corrective']))
    {
        $id = $_POST['corrective_id'];
        $corrective_a = $_POST['corrective_a'];
        $corrective_atention = date("Y-m-d H:i:s");
        
        $query = "UPDATE corrective SET corrective_status = 1, corrective_atention = '$corrective_atention', 
        corrective_a = '$corrective_a' WHERE corrective_id = $id ";

        $result = mysqli_query($connection, $query);

        if($result)
        {
            echo "<script>swal('Success','This issue is being solved by $corrective_a','success')</script>";
        }
        else
        {
            echo $query;
        }
    }
}


function addPreventive()
{
    global $connection;

    if(isset($_POST['add_preventive']))
    {
        $machine = $_POST['machine'];
        $responsible = $_POST['responsible'];
        $start_date = $_POST['start_date'];
        $recurrence = $_POST['recurrence'];
        $description = $_POST['description'];


        
        $query = "INSERT INTO preventive_tasks (preventive_responsible, preventive_start_date, preventive_recurrence, preventive_machine, preventive_description) 
        VALUES ('$responsible', '$start_date', '$recurrence', '$machine', '$description' )";

        $result = mysqli_query($connection, $query);

        if($result)
        {
            echo "<script>swal('Success','Task Added','success')</script>";

            echo 
            "
            <script>
            (function worker2() {
            $.ajax({
                url: 'index.php', 
                success: function(data) {

                $('#table3').load(location.href+' #table3>*','');

                },
                complete: function() {
                // Siguiente peticion de ajax cuando la actual este terminada
                setTimeout(worker2, 2000);
                
                    }
                });
            })();
            //worker2();
            </script>
            ";
        }
        else
        {
            echo $query;
        }
    }
}






?>