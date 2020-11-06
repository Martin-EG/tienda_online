<?php
    include_once "db.php";

    global $connection;

    if(isset($_GET['f']))
    {
        if($_GET['f'] == "searchQty")
        {
            $id = $_GET['i'];
            $query_selector = "SELECT * FROM products WHERE product_id = $id";
            $result_selector = $connection->query($query_selector);
            if($result_selector)
            {
                if($result_selector->num_rows == 1)
                {
                    $row_selector = $result_selector->fetch_assoc();
                    
                    echo json_encode($row_selector);
                }
            }
        }
        else if($_GET['f'] == "searchCategory")
        {
            $id = $_GET['i'];
            $query_selector = "SELECT * FROM products WHERE product_category = $id AND product_active = 1";
            $result_selector = $connection->query($query_selector);
            if($result_selector)
            {
                if($result_selector->num_rows == 1)
                {
                    while($row_selector = $result_selector->fetch_assoc()){
                        echo json_encode($row_selector);
                    }
                }
            }
        }
    }

