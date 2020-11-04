<?php

    require_once("../config/db.php");
    session_start();

    if(isset($_GET['function']) )
    {


        if($_GET['function']=="edit_profile")
        {
            function editProfile()
            {
                global $connection;

                $us = $_SESSION['user_name'];
                //$us                     = mysqli_real_escape_string($connection,$_POST['user_name']);
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
                if($stmt->affected_rows === 0)
                    //echo 'No rows updated'; 
                $stmt->close();

                //echo "hiii";

                
            }

            editProfile();
        }




        if($_GET['function']=="add_category")
        {

            function addCategory()
            {
                global $connection;

                $category_name      =   mysqli_real_escape_string($connection, $_POST['category_name']);

                $stmt = $connection->prepare("INSERT INTO spare_category (category_name) VALUES (?)");
                $stmt->bind_param("s", $category_name);
                $stmt->execute();
                if($stmt->affected_rows === -1)
                    echo 'Query error';
                if($stmt->affected_rows === 0)
                    echo 'No rows updated';    
                $stmt->close();
                            
            }
        
            addCategory();     
        }

        if($_GET['function']=="edit_category")
        {
            
            function editCategory()
            {
                global $connection;

                $category_name      =   mysqli_real_escape_string($connection, $_POST['category_name_edit']);
                $category_id        =   mysqli_real_escape_string($connection, $_POST['category_id']);

                $stmt = $connection->prepare("UPDATE spare_category SET category_name = ? WHERE category_id = ?");
                $stmt->bind_param("si", $category_name, $category_id);
                $stmt->execute();
                if($stmt->affected_rows === -1)
                    echo 'Query error';
                if($stmt->affected_rows === 0)
                    echo 'No rows updated'; 
                $stmt->close();
            }

            editCategory();

        }

        if($_GET['function']=="delete_category")
        {
            
            function deleteCategory()
            {
                global $connection;

                $category_id        =   mysqli_real_escape_string($connection, $_POST['category_id_delete']);
                $deactivate         = 0;

                $stmt = $connection->prepare("UPDATE spare_category SET category_active = ? WHERE category_id = ?");
                $stmt->bind_param("ii", $deactivate, $category_id);
                $stmt->execute();
                if($stmt->affected_rows === -1)
                    echo 'Query error';
                if($stmt->affected_rows === 0)
                    echo 'No rows updated'; 
                $stmt->close();
            }

            deleteCategory();

        }

        if($_GET['function']=="view_category")
        {
            
            function viewCategory()
            {
                global $connection;

                ## Read value
                $draw = $_POST['draw'];
                $row = $_POST['start'];
                $rowperpage = $_POST['length']; // Rows display per page
                $columnIndex = $_POST['order'][0]['column']; // Column index
                $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
                $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
                $searchValue = $_POST['search']['value']; // Search value

                ## Search 
                $searchQuery = " ";
                if($searchValue != ''){
                        $searchQuery = " and (category_id like '%".$searchValue."%' or 
                        category_name like '%".$searchValue."%') ";
                }

                ## Total number of records without filtering
                $sel = mysqli_query($connection,"select count(*) as allcount from spare_category WHERE category_active = 1 ORDER BY category_id ASC");
                $records = mysqli_fetch_assoc($sel);
                $totalRecords = $records['allcount'];

                ## Total number of record with filtering
                $sel = mysqli_query($connection,"select count(*) as allcount from spare_category WHERE category_active = 1 ".$searchQuery);
                $records = mysqli_fetch_assoc($sel);
                $totalRecordwithFilter = $records['allcount'];

                ## Fetch records
                $empQuery = "select * from spare_category WHERE category_active =  1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
                $empRecords = mysqli_query($connection, $empQuery);
                $data = array();

                while ($row = mysqli_fetch_assoc($empRecords)) {

                    ##other querys
                    
                    ##other querys

                $data[] = array( 
                    "category_id"=>$row['category_id'],
                    "category_name"=>$row['category_name'],
                    "category_btn"=> "<a class='edit-cat'  data-cat-name='{$row['category_name']}' data-cat-id='{$row['category_id']}' data-toggle='modal' data-target='#exampleModal'><i data-toggle='tooltip' data-placement='left' title='Edit category' style='font-size: 20px; color:#b5b5b5' class='far fa-edit'></i></a>
                    &nbsp;&nbsp;
                    <a class='delete-cat' data-cat-name='{$row['category_name']}' data-cat-id='{$row['category_id']}' data-toggle='modal' data-target='#deleteCatModal'><i data-toggle='tooltip' data-placement='left' title='Delete category' style='font-size: 20px; color:#b5b5b5' class='far fa-trash-alt'></i></a>"
                );
                }

                ## Response
                $response = array(
                "draw" => intval($draw),
                "iTotalRecords" => $totalRecords,
                "iTotalDisplayRecords" => $totalRecordwithFilter,
                "aaData" => $data
                );

                echo json_encode($response);


            }

            viewCategory();

        }




        //PARTS  
        if($_GET['function']=="view_parts")
        {
            
            function viewParts()
            {
                global $connection;

                ## Read value
                $draw = $_POST['draw'];
                $row = $_POST['start'];
                $rowperpage = $_POST['length']; // Rows display per page
                $columnIndex = $_POST['order'][0]['column']; // Column index
                $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
                $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
                $searchValue = $_POST['search']['value']; // Search value

                ## Search 
                $searchQuery = " ";
                if($searchValue != ''){
                        $searchQuery = " and (part_number like '%".$searchValue."%' or 
                        part_name like '%".$searchValue."%') ";
                }

                ## Total number of records without filtering
                $sel = mysqli_query($connection,"select count(*) as allcount from spare_parts WHERE part_active = 1 ORDER BY part_id ASC");
                $records = mysqli_fetch_assoc($sel);
                $totalRecords = $records['allcount'];

                ## Total number of record with filtering
                $sel = mysqli_query($connection,"select count(*) as allcount from spare_parts WHERE part_active = 1 ".$searchQuery);
                $records = mysqli_fetch_assoc($sel);
                $totalRecordwithFilter = $records['allcount'];

                ## Fetch records
                $empQuery = "select * from spare_parts inner join spare_category on spare_parts.part_category = spare_category.category_id WHERE part_active =  1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
                $empRecords = mysqli_query($connection, $empQuery);
                $data = array();

                while ($row = mysqli_fetch_assoc($empRecords)) {

                    ##other querys
                    if($row['part_consumable']== 1)
                        $consumable = "Yes";
                    else
                        $consumable = "No";

                    if($row['part_status']== 0)
                        $status = "Available";
                    else
                        $status = "Reorder";    

                    ##other querys

                    if($row['part_available'] <= $row['part_reorder_point'] )
                    {
                        $reorder   = "{$row['part_reorder_point']} <span class='badge badge-pill badge-danger blink' data-toggle='tooltip' data-placement='top' title='Stock under the reorder point'>!</span>";
                        $available = "{$row['part_available']} <span class='badge badge-pill badge-danger blink' data-toggle='tooltip' data-placement='top' title='Stock under the reorder point'>!</span>";
                    }
                    else
                    {
                        $reorder   = $row['part_reorder_point'];
                        $available = $row['part_available'];
                    }

                $data[] = array( 
                    "part_id"=>$row['part_id'],
                    "part_consumable"=>$consumable,
                    "part_number"=>$row['part_number'],
                    "part_name"=>$row['part_name'],
                    "part_cost"=>$row['part_cost'],
                    "part_stock"=>$row['part_stock'],
                    "part_available"=>$available,
                    "part_min_stock"=>$row['part_min_stock'],
                    "part_max_stock"=>$row['part_max_stock'],
                    "part_reorder_point"=>$row['part_reorder_point'],
                    "part_location"=>$row['part_location'],
                    "part_status"=>$status,
                    "part_image"=>"<a href='#'><img style='width:150px; height: auto;' class='img-thumbnail view-image' data-image='{$row['part_image']}' src='{$row['part_image']}' data-toggle='modal' data-target='#imageModal'></a>",
                    "part_category"=>$row['category_name'],
                    "part_transactions"=> "<a href='#' class='move-part'  data-part_number='{$row['part_number']}' data-part_id='{$row['part_id']}' data-part_consumable='{$row['part_consumable']}' data-part_name='{$row['part_name']}' data-part_stock='{$row['part_stock']}' data-part_available='{$row['part_available']}'  data-part_location='{$row['part_location']}'  data-part_category='{$row['part_category']}' data-part_image='{$row['part_image']}'  data-toggle='modal' data-target='#moveNewPartModal'><i data-toggle='tooltip' data-placement='left' title='Move Part' style='font-size: 20px; color:#b5b5b5' class='far fa-arrow-alt-circle-down'></i></a>
                     &nbsp;&nbsp;
                    <a href='#' class='delete-part' data-part_number='{$row['part_number']}' data-part_name='{$row['part_name']}' data-part_id='{$row['part_id']}' data-toggle='modal' data-target='#deletePartModal'><i data-toggle='tooltip' data-placement='left' title='Delete part' style='font-size: 20px; color:#b5b5b5' class='far fa-eye'></i></a>",
                    "part_btn"=> "<a href='#' class='edit-part' data-part_cost='{$row['part_cost']}' data-part_min_stock='{$row['part_min_stock']}' data-part_max_stock='{$row['part_max_stock']}' data-part_reorder_point='{$row['part_reorder_point']}' data-part_number='{$row['part_number']}' data-part_id='{$row['part_id']}' data-part_consumable='{$row['part_consumable']}' data-part_name='{$row['part_name']}' data-part_stock='{$row['part_stock']}' data-part_location='{$row['part_location']}'  data-part_category='{$row['part_category']}' data-part_image='{$row['part_image']}'  data-toggle='modal' data-target='#editPartModal'><i data-toggle='tooltip' data-placement='left' title='Edit part' style='font-size: 20px; color:#b5b5b5' class='far fa-edit'></i></a>
                     &nbsp;&nbsp;
                    <a href='#' class='delete-part' data-part_min_stock='{$row['part_min_stock']}' data-part_max_stock='{$row['part_max_stock']}' data-part_reorder_part='{$row['part_reorder_point']}' data-part_number='{$row['part_number']}' data-part_name='{$row['part_name']}' data-part_id='{$row['part_id']}' data-toggle='modal' data-target='#deletePartModal'><i data-toggle='tooltip' data-placement='left' title='Delete part' style='font-size: 20px; color:#b5b5b5' class='far fa-trash-alt'></i></a>"
                );
                }

                ## Response
                $response = array(
                "draw" => intval($draw),
                "iTotalRecords" => $totalRecords,
                "iTotalDisplayRecords" => $totalRecordwithFilter,
                "aaData" => $data
                );

                echo json_encode($response);


            }

            viewParts();

        }




        //add parts
        if($_GET['function']=="add_part")
        {

            function addPart()
            {
                global $connection;

                $part_consumable      =   mysqli_real_escape_string($connection, $_POST['part_consumable']);
                $part_number          =   mysqli_real_escape_string($connection, $_POST['part_number']);
                $part_name            =   mysqli_real_escape_string($connection, $_POST['part_name']);
                $part_stock           =   mysqli_real_escape_string($connection, $_POST['part_stock']);
                $part_location        =   mysqli_real_escape_string($connection, $_POST['part_location']);
                $part_category        =   mysqli_real_escape_string($connection, $_POST['part_category']);
                $part_min_stock       =   mysqli_real_escape_string($connection, $_POST['part_minimum_stock']);
                $part_max_stock       =   mysqli_real_escape_string($connection, $_POST['part_maximum_stock']);
                $part_reorder         =   mysqli_real_escape_string($connection, $_POST['part_reorder_point']);
                $part_cost            =   mysqli_real_escape_string($connection, $_POST['part_cost']);
                $part_status = 0;
                $part_active = 1;

                if(empty($_FILES['part_image'] ['name']))
                {
                    $target_file = "uploads/spare_parts/noimage.jpg";
                    $uploadOk = 1;
                }
                else
                {
                    $target_dir = "../uploads/spare_parts/";
                    $target_file = $target_dir .rand(). basename($_FILES["part_image"]["name"]);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                    
                    
                    // Check if file already exists
                    if (file_exists($target_file)) {
                    echo "Sorry, file already exists.";
                    $uploadOk = 0;
                    }

                    // Check file size
                    if ($_FILES["part_image"]["size"] > 5000000) { //5MB
                    echo "Sorry, your file is too large.";
                    $uploadOk = 0;
                    }

                    // Allow certain file formats
                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif" ) {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                    }
                    
                    // Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) 
                    {
                    echo "Sorry, your file was not uploaded.";
                    // if everything is ok, try to upload file
                    } 
                    else
                    {
                        if (move_uploaded_file($_FILES["part_image"]["tmp_name"], $target_file)) 
                        {
                            echo "The file ". basename( $_FILES["part_image"]["name"]). " has been uploaded.";
                            $target_file = substr($target_file, 3);
                        } 
                        else 
                        {
                            echo "Sorry, there was an error uploading your file.";
                        }
                    }
                }


                $stmt = $connection->prepare("INSERT INTO spare_parts (part_consumable, part_number, part_name, 
                part_stock, part_available, part_location, part_status, part_image, part_category, part_active,part_min_stock, part_max_stock, part_reorder_point, part_cost) 
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                $stmt->bind_param("issddsisiidddd", $part_consumable, $part_number, $part_name, $part_stock, $part_stock,
                $part_location, $part_status, $target_file, $part_category, $part_active, $part_min_stock, $part_max_stock, $part_reorder, $part_cost);
                $stmt->execute();
                if($stmt->affected_rows === -1)
                    echo 'Query error';
                if($stmt->affected_rows === 0)
                    echo 'No rows updated';    
                $stmt->close();
                            
            }
        
            addPart();     
        }

        //edit parts
        if($_GET['function']=="edit_part")
        {

            function editPart()
            {
                global $connection;

                $part_id              =   mysqli_real_escape_string($connection, $_POST['part_id_edit']);
                $part_consumable      =   mysqli_real_escape_string($connection, $_POST['part_consumable_edit']);
                $part_number          =   mysqli_real_escape_string($connection, $_POST['part_number_edit']);
                $part_name            =   mysqli_real_escape_string($connection, $_POST['part_name_edit']);
                $part_stock           =   mysqli_real_escape_string($connection, $_POST['part_stock_edit']);
                $part_location        =   mysqli_real_escape_string($connection, $_POST['part_location_edit']);
                $part_category        =   mysqli_real_escape_string($connection, $_POST['part_category_edit']);
                $part_min_stock       =   mysqli_real_escape_string($connection, $_POST['part_minimum_stock_edit']);
                $part_max_stock       =   mysqli_real_escape_string($connection, $_POST['part_maximum_stock_edit']);
                $part_reorder         =   mysqli_real_escape_string($connection, $_POST['part_reorder_point_edit']);
                $part_cost            =   mysqli_real_escape_string($connection, $_POST['part_cost_edit']);
                $part_status = 0;
                $part_active = 1;

                if(empty($_FILES['part_image_edit'] ['name']))
                {
                   
                    $stmt = $connection->prepare("UPDATE spare_parts SET part_consumable = ?, part_number = ?, part_name = ?, 
                    part_stock = ?, part_available = ?, part_location = ?, part_status = ?, part_category = ?, part_active = ?, part_min_stock = ?, part_max_stock = ?, part_reorder_point = ?, part_cost = ? WHERE part_id = ?");
                    $stmt->bind_param("issddsiiiddddi", $part_consumable, $part_number, $part_name, $part_stock, $part_stock,
                    $part_location, $part_status, $part_category, $part_active, $part_min_stock, $part_max_stock, $part_reorder, $part_cost, $part_id);
                    $stmt->execute();
                    if($stmt->affected_rows === -1)
                        echo 'Query error';
                    if($stmt->affected_rows === 0)
                        echo 'No rows updated';    
                    $stmt->close();

                }
                else
                {
                    $target_dir = "../uploads/spare_parts/";
                    $target_file = $target_dir .rand(). basename($_FILES["part_image_edit"]["name"]);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                    
                    
                    // Check if file already exists
                    if (file_exists($target_file)) {
                    echo "Sorry, file already exists.";
                    $uploadOk = 0;
                    }

                    // Check file size
                    if ($_FILES["part_image_edit"]["size"] > 5000000) { //5MB
                    echo "Sorry, your file is too large.";
                    $uploadOk = 0;
                    }

                    // Allow certain file formats
                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif" ) {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                    }
                    
                    // Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) 
                    {
                    echo "Sorry, your file was not uploaded.";
                    // if everything is ok, try to upload file
                    } 
                    else
                    {
                        if (move_uploaded_file($_FILES["part_image_edit"]["tmp_name"], $target_file)) 
                        {
                            echo "The file ". basename( $_FILES["part_image_edit"]["name"]). " has been uploaded.";
                            $target_file = substr($target_file, 3);
                        } 
                        else 
                        {
                            echo "Sorry, there was an error uploading your file.";
                        }
                    }

                    $stmt = $connection->prepare("UPDATE spare_parts SET part_consumable = ?, part_number = ?, part_name = ?, 
                    part_stock = ?, part_available = ?, part_location = ?, part_status = ?, part_category = ?, part_active = ?, part_image = ?, part_min_stock = ?, part_max_stock = ?, part_reorder_point = ?, part_cost = ? WHERE part_id = ?");
                    $stmt->bind_param("issddsiiisddddi", $part_consumable, $part_number, $part_name, $part_stock, $part_stock,
                    $part_location, $part_status, $part_category, $part_active, $target_file, $part_min_stock, $part_max_stock, $part_reorder, $part_cost, $part_id);
                    $stmt->execute();
                    if($stmt->affected_rows === -1)
                        echo 'Query error';
                    if($stmt->affected_rows === 0)
                        echo 'No rows updated';    
                    $stmt->close();

                }
                            
            }
        
            editPart();     
        }

        //delete parts
        if($_GET['function']=="delete_part")
        {

            function deletePart()
            {
                global $connection;

                $part_id              =   mysqli_real_escape_string($connection, $_POST['part_id_delete']);
                $part_active = 0;

                $stmt = $connection->prepare("UPDATE spare_parts SET part_active = ? WHERE part_id = ?");
                $stmt->bind_param("ii", $part_active, $part_id);
                $stmt->execute();
                if($stmt->affected_rows === -1)
                    echo 'Query error';
                if($stmt->affected_rows === 0)
                    echo 'No rows updated';    
                $stmt->close();
            }
        
            deletePart();     
        }

        //TRANSACTIONS
        if($_GET['function']=="view_parts_move")
        {
            
            function viewPartsMove()
            {
                global $connection;

                ## Read value
                $draw = $_POST['draw'];
                $row = $_POST['start'];
                $rowperpage = $_POST['length']; // Rows display per page
                $columnIndex = $_POST['order'][0]['column']; // Column index
                $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
                $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
                $searchValue = $_POST['search']['value']; // Search value

                ## Search 
                $searchQuery = " ";
                if($searchValue != ''){
                        $searchQuery = " and (part_number like '%".$searchValue."%' or 
                        part_name like '%".$searchValue."%') ";
                }

                ## Total number of records without filtering
                $sel = mysqli_query($connection,"select count(*) as allcount from spare_parts WHERE part_active = 1 ORDER BY part_id ASC");
                $records = mysqli_fetch_assoc($sel);
                $totalRecords = $records['allcount'];

                ## Total number of record with filtering
                $sel = mysqli_query($connection,"select count(*) as allcount from spare_parts WHERE part_active = 1 ".$searchQuery);
                $records = mysqli_fetch_assoc($sel);
                $totalRecordwithFilter = $records['allcount'];

                ## Fetch records
                $empQuery = "select * from spare_parts inner join spare_category on spare_parts.part_category = spare_category.category_id WHERE part_active =  1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
                $empRecords = mysqli_query($connection, $empQuery);
                $data = array();

                while ($row = mysqli_fetch_assoc($empRecords)) {

                    ##other querys
                    if($row['part_consumable']== 1)
                        $consumable = "Yes";
                    else
                        $consumable = "No";

                    if($row['part_status']== 0)
                        $status = "Available";
                    else
                        $status = "Reorder";    

                    ##other querys

                    if($row['part_available'] <= $row['part_reorder_point'] )
                    {
                        $reorder   = "{$row['part_reorder_point']} <span class='badge badge-pill badge-danger blink' data-toggle='tooltip' data-placement='top' title='Stock under the reorder point'>!</span>";
                        $available = "{$row['part_available']} <span class='badge badge-pill badge-danger blink' data-toggle='tooltip' data-placement='top' title='Stock under the reorder point'>!</span>";
                    }
                    else
                    {
                        $reorder   = $row['part_reorder_point'];
                        $available = $row['part_available'];
                    }

                $data[] = array( 
                    "part_id"=>$row['part_id'],
                    "part_consumable"=>$consumable,
                    "part_number"=>$row['part_number'],
                    "part_name"=>$row['part_name'],
                    "part_cost"=>$row['part_cost'],
                    "part_stock"=>$row['part_stock'],
                    "part_available"=>$available,
                    "part_min_stock"=>$row['part_min_stock'],
                    "part_max_stock"=>$row['part_max_stock'],
                    "part_reorder_point"=>$row['part_reorder_point'],
                    "part_location"=>$row['part_location'],
                    "part_status"=>$status,
                    "part_image"=>"<img style='width:150px; height: auto;' class='img-thumbnail' src='{$row['part_image']}'>",
                    "part_category"=>$row['category_name'],
                    "part_btn"=> "<a href='#' class='add-part'  data-part_cost='{$row['part_cost']}' data-part_number='{$row['part_number']}' data-part_id='{$row['part_id']}' data-part_consumable='{$row['part_consumable']}' data-part_name='{$row['part_name']}' data-part_stock='{$row['part_stock']}'  data-part_available='{$row['part_available']}'  data-part_location='{$row['part_location']}'  data-part_category='{$row['part_category']}' data-part_image='{$row['part_image']}'><i data-toggle='tooltip' data-placement='left' title='Add To List' style='font-size: 20px; color:#b5b5b5' class='far fa-plus-square'></i></a>"
                );
                }

                ## Response
                $response = array(
                "draw" => intval($draw),
                "iTotalRecords" => $totalRecords,
                "iTotalDisplayRecords" => $totalRecordwithFilter,
                "aaData" => $data
                );

                echo json_encode($response);
            }
            viewPartsMove();
        }



        /****************************************************************************************************************** */
        /****************************************************************************************************************** */
        /****************************************************************************************************************** */
        //Recommended parts
        if($_GET['function'] == "view_parts_recomended")
        {
            
            function viewPartsRecomended()
            {
                global $connection;

                ## Read value
                $draw = $_POST['draw'];
                $row = $_POST['start'];
                $rowperpage = $_POST['length']; // Rows display per page
                $columnIndex = $_POST['order'][0]['column']; // Column index
                $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
                $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
                $searchValue = $_POST['search']['value']; // Search value

                ## Search 
                $searchQuery = " ";
                if($searchValue != ''){
                        $searchQuery = " and (part_number like '%".$searchValue."%' or 
                        part_name like '%".$searchValue."%') ";
                }

                ## Total number of records without filtering
                $sel = mysqli_query($connection,"select count(*) as allcount from spare_parts WHERE part_active = 1 ORDER BY part_id ASC");
                $records = mysqli_fetch_assoc($sel);
                $totalRecords = $records['allcount'];

                ## Total number of record with filtering
                $sel = mysqli_query($connection,"select count(*) as allcount from spare_parts WHERE part_active = 1 ".$searchQuery);
                $records = mysqli_fetch_assoc($sel);
                $totalRecordwithFilter = $records['allcount'];

                ## Fetch records
                $empQuery = "select * from spare_parts inner join spare_category on spare_parts.part_category = spare_category.category_id WHERE part_active =  1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
                $empRecords = mysqli_query($connection, $empQuery);
                $data = array();

                while ($row = mysqli_fetch_assoc($empRecords)) {

                    ##other querys
                    if($row['part_consumable']== 1)
                        $consumable = "Yes";
                    else
                        $consumable = "No";

                    if($row['part_status']== 0)
                        $status = "Available";
                    else
                        $status = "Reorder";    

                    ##other querys

                    if($row['part_available'] <= $row['part_reorder_point'] )
                    {
                        $reorder   = "{$row['part_reorder_point']} <span class='badge badge-pill badge-danger blink' data-toggle='tooltip' data-placement='top' title='Stock under the reorder point'>!</span>";
                        $available = "{$row['part_available']} <span class='badge badge-pill badge-danger blink' data-toggle='tooltip' data-placement='top' title='Stock under the reorder point'>!</span>";
                    }
                    else
                    {
                        $reorder   = $row['part_reorder_point'];
                        $available = $row['part_available'];
                    }

                $data[] = array( 
                    "part_id"=>$row['part_id'],
                    "part_number"=>$row['part_number'],
                    "part_name"=>$row['part_name'],
                    "part_cost"=>$row['part_cost'],
                    "part_available"=>$available,
                    "part_location"=>$row['part_location'],
                    "part_status"=>$status,
                    "part_image"=>"<img style='width:150px; height: auto;' class='img-thumbnail' src='{$row['part_image']}'>",
                    "part_category"=>$row['category_name'],
                    "part_btn"=> "<a href='#' class='add-recommend-part' data-part_number='{$row['part_number']}' data-part_id='{$row['part_id']}' data-part_name='{$row['part_name']}'><i data-toggle='tooltip' data-placement='left' title='Add To List' style='font-size: 20px; color:#b5b5b5' class='far fa-plus-square'></i></a>"
                );
                }

                ## Response
                $response = array(
                "draw" => intval($draw),
                "iTotalRecords" => $totalRecords,
                "iTotalDisplayRecords" => $totalRecordwithFilter,
                "aaData" => $data
                );

                echo json_encode($response);
            }
            viewPartsRecomended();
        }

        if($_GET['function'] == "add_recommended_parts")
        {
            function add_recommended_parts()
            {
                global $connection;

                $cont = mysqli_real_escape_string($connection, $_POST['contador_parts_recommended']);
                for($x = 1; $x <= $cont; $x++)
                {
                    echo $x;
                    if(isset($_POST['item_'.$x]))
                    {

                        $part_id        = mysqli_real_escape_string($connection, $_POST['item_'.$x]);
                        $maintenance_id = 2;

                        echo $query_insert_item = "INSERT INTO maintenance_preventive_parts_recommended(maintenance_id, part_id) VALUES($maintenance_id, $part_id)";
                        $result = mysqli_query($connection, $query_insert_item);
                        if(!$result)
                        {
                            echo $connection->error;
                        }
                    }
                }
            }

            add_recommended_parts();
        }
        
        
        /****************************************************************************************************************** */
        /****************************************************************************************************************** */
        /****************************************************************************************************************** */
        if($_GET['function']=="move_part")
        {

            function movePart()
            {
                global $connection;

                $date = date("Y-m-d H:i:s");
                $contador      =   mysqli_real_escape_string($connection, $_POST['contador']);

                $receipt = "INSERT INTO spare_receipts (receipt_items, receipt_date) 
                VALUES ('$contador', '$date')";
                $run_receipt = mysqli_query($connection, $receipt);
                $receipt_id = mysqli_insert_id($connection);


                $cont = mysqli_real_escape_string($connection, $_POST['contador_parts_recommended']);
                for($x = 1; $x <= $cont; $x++)
                {
                    if(isset($_POST['item_'.$x]))
                    {

                        $part_id        = mysqli_real_escape_string($connection, $_POST['item_'.$x]);
                        $maintenance_id = 2;

                        echo $query_insert_item = "INSERT INTO maintenance_preventive_parts_recommended(maintenance_id, part_id) VALUES($maintenance_id, $part_id)";
                        $result = mysqli_query($connection, $query_insert_item);
                        if(!$result)
                        {
                            echo $connection->error;
                        }
                    }
                }

                for($x = 1; $x <= $contador; $x++)
                {
                    
                    if(isset($_POST['item_'.$x]))
                    {
                        $value = $_POST['i_'.$x];
                        $item_id = $_POST['item_'.$x];
                        
                        $query = "INSERT INTO spare_receipts_items (receipt_item_id, part_id, item_number, item_name, item_qty, receipts_part_date) 
                        VALUES ($receipt_id, '$item_id', '$item_id', '$item_id', '$value', '$date')";
    
                        $run = mysqli_query($connection, $query);
    
                        if($run)
                        {
                            $get_data = "SELECT * FROM spare_parts WHERE part_id = $item_id";
                            $run_data = mysqli_query($connection, $get_data);
                            $data = mysqli_fetch_array($run_data);
    
                            if($data['part_consumable'] == 1)
                            {
                                if($data['part_stock']>= $value)
                                {
                                    $new_stock = $data['part_stock'] - $value;
                                    $update = "UPDATE spare_parts SET part_stock = '$new_stock', part_available = '$new_stock' WHERE part_id = $item_id";
                                    $del_receipt = 0;
    
                                }
                                else
                                {
                                    $update = "DELETE FROM spare_receipts_items WHERE receipt_item_id = $receipt_id";
                                    $del_receipt = 1;
                                    break;
                                    echo "consumable not available";
                                }
                                
                                
                            }  
                            else
                            {
                                if($data['part_available']>= $value)
                                {
                                    $new_stock = $data['part_available'] - $value;
                                    $update = "UPDATE spare_parts SET  part_available = '$new_stock' WHERE part_id = $item_id";
                                    $del_receipt = 0;
                                }
                                else
                                {
                                    $update = "DELETE FROM spare_receipts_items WHERE receipt_item_id = $receipt_id";
                                    $del_receipt = 1;
                                    break;
                                    echo "not consumable not available";                            
                                }
                            }
                                
                            $run_update = mysqli_query($connection, $update);
                            if(!$run_update)
                            {
                                break;
                                echo "update failed";
                            }
    
                            //delete_receipts
                            if($del_receipt == 1)
                            {
                                $delete_receipt = "DELETE FROM spare_receipts WHERE receipt_id = $receipt_id";
                                $run_delete = mysqli_query($connection, $delete_receipt);
                            }
                            
                            
                            
                        }
                        else
                        {
                            break;
                            echo "items failed";
                        }
                    }
                }

                echo "success!";

            }
        
            movePart();     
        }

        if($_GET['function']=="add_machine_category")
        {

            function addMachineCategory()
            {
                global $connection;

                $machine_category_name      =   mysqli_real_escape_string($connection, $_POST['machine_category_name']);
                
                
                $stmt = $connection->prepare("INSERT INTO machines_category (machine_category_name) VALUES (?)");
                $stmt->bind_param("s", $machine_category_name);
                $stmt->execute();
                if($stmt->affected_rows === -1)
                    echo 'Query error';
                if($stmt->affected_rows === 0)
                    echo 'No rows updated';    
                $stmt->close();
                
                /*
                $console =  "INSERT INTO machines_category (machine_category_name) VALUES ('$machine_category_name')";
                echo $js_code =  '<script>console.log(' . json_encode($console, JSON_HEX_TAG) . ');<script>';
                */
            }
        
            addMachineCategory();     
        }

        if($_GET['function']=="view_machine_cat")
        {
            
            function viewMCategory()
            {
                global $connection;

                ## Read value
                $draw = $_POST['draw'];
                $row = $_POST['start'];
                $rowperpage = $_POST['length']; // Rows display per page
                $columnIndex = $_POST['order'][0]['column']; // Column index
                $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
                $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
                $searchValue = $_POST['search']['value']; // Search value

                ## Search 
                $searchQuery = " ";
                if($searchValue != ''){
                        $searchQuery = " and (machine_category_id like '%".$searchValue."%' or 
                        machine_category_name like '%".$searchValue."%') ";
                }

                ## Total number of records without filtering
                $sel = mysqli_query($connection,"select count(*) as allcount from machines_category WHERE machine_category_active = 1 ORDER BY machine_category_id ASC");
                $records = mysqli_fetch_assoc($sel);
                $totalRecords = $records['allcount'];

                ## Total number of record with filtering
                $sel = mysqli_query($connection,"select count(*) as allcount from machines_category WHERE machine_category_active = 1 ".$searchQuery);
                $records = mysqli_fetch_assoc($sel);
                $totalRecordwithFilter = $records['allcount'];

                ## Fetch records
                $empQuery = "select * from machines_category WHERE machine_category_active =  1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
                $empRecords = mysqli_query($connection, $empQuery);
                $data = array();

                while ($row = mysqli_fetch_assoc($empRecords)) {

                    ##other querys
                    
                    ##other querys

                $data[] = array( 
                    "machine_category_id"=>$row['machine_category_id'],
                    "machine_category_name"=>$row['machine_category_name'],
                    "btn"=> "<a class='edit-cat'  data-cat-name='{$row['machine_category_name']}' data-cat-id='{$row['machine_category_id']}' data-toggle='modal' data-target='#exampleModal'><i data-toggle='tooltip' data-placement='left' title='Edit category' style='font-size: 20px; color:#b5b5b5' class='far fa-edit'></i></a>
                    &nbsp;&nbsp;
                    <a class='delete-cat' data-cat-name='{$row['machine_category_name']}' data-cat-id='{$row['machine_category_id']}' data-toggle='modal' data-target='#deleteCatModal'><i data-toggle='tooltip' data-placement='left' title='Delete category' style='font-size: 20px; color:#b5b5b5' class='far fa-trash-alt'></i></a>"
                );
                }

                ## Response
                $response = array(
                "draw" => intval($draw),
                "iTotalRecords" => $totalRecords,
                "iTotalDisplayRecords" => $totalRecordwithFilter,
                "aaData" => $data
                );

                echo json_encode($response);


            }
            viewMCategory();
        }







        if($_GET['function']=="view_suppliers")
        {
            
            function viewSuppliers()
            {
                global $connection;

                ## Read value
                $draw = $_POST['draw'];
                $row = $_POST['start'];
                $rowperpage = $_POST['length']; // Rows display per page
                $columnIndex = $_POST['order'][0]['column']; // Column index
                $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
                $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
                $searchValue = $_POST['search']['value']; // Search value

                ## Search 
                $searchQuery = " ";
                if($searchValue != ''){
                        $searchQuery = " and (supplier_id like '%".$searchValue."%' or 
                        supplier_name like '%".$searchValue."%' or supplier_rs like '%".$searchValue."%') ";
                }

                ## Total number of records without filtering
                $sel = mysqli_query($connection,"select count(*) as allcount from supplier WHERE supplier_active = 1 ORDER BY supplier_id ASC");
                $records = mysqli_fetch_assoc($sel);
                $totalRecords = $records['allcount'];

                ## Total number of record with filtering
                $sel = mysqli_query($connection,"select count(*) as allcount from supplier WHERE supplier_active = 1 ".$searchQuery);
                $records = mysqli_fetch_assoc($sel);
                $totalRecordwithFilter = $records['allcount'];

                ## Fetch records
                $empQuery = "select * from supplier WHERE supplier_active =  1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
                $empRecords = mysqli_query($connection, $empQuery);
                $data = array();

                while ($row = mysqli_fetch_assoc($empRecords)) {

                    ##other querys
                    
                    ##other querys

                $data[] = array( 
                    "supplier_id"=>$row['supplier_id'],
                    "supplier_name"=>$row['supplier_name'],
                    "supplier_address"=>$row['supplier_address'],
                    "supplier_contact"=>$row['supplier_address'],
                    "supplier_fiscal"=>$row['supplier_address'],
                    "supplier_date"=>$row['supplier_address'],
                    "btn"=> "<a class='edit-cat'  data-cat-name='{$row['supplier_name']}' data-cat-id='{$row['supplier_id']}' data-toggle='modal' data-target='#exampleModal'><i data-toggle='tooltip' data-placement='left' title='Edit category' style='font-size: 20px; color:#b5b5b5' class='far fa-edit'></i></a>
                    &nbsp;&nbsp;
                    <a class='delete-cat' data-cat-name='{$row['supplier_name']}' data-cat-id='{$row['supplier_id']}' data-toggle='modal' data-target='#deleteCatModal'><i data-toggle='tooltip' data-placement='left' title='Delete category' style='font-size: 20px; color:#b5b5b5' class='far fa-trash-alt'></i></a>"
                );
                }

                ## Response
                $response = array(
                "draw" => intval($draw),
                "iTotalRecords" => $totalRecords,
                "iTotalDisplayRecords" => $totalRecordwithFilter,
                "aaData" => $data
                );

                echo json_encode($response);


            }
            viewSuppliers();
        }

        if($_GET['function']=="add_supplier")
        {

            function addSupplier()
            {
                global $connection;

                $supplier_name      =   mysqli_real_escape_string($connection, $_POST['supplier_name']);
                $supplier_email     =   mysqli_real_escape_string($connection, $_POST['supplier_email']);
                $supplier_phone     =   mysqli_real_escape_string($connection, $_POST['supplier_phone']);
                $supplier_mobile    =   mysqli_real_escape_string($connection, $_POST['supplier_mobile']);
                $supplier_rfc       =   mysqli_real_escape_string($connection, $_POST['rfc']);
                $supplier_rs        =   mysqli_real_escape_string($connection, $_POST['rs']);
                $supplier_notes     =   mysqli_real_escape_string($connection, $_POST['supplier_notes']);
                $supplier_address   =   mysqli_real_escape_string($connection, $_POST['address']);
                $register_date      =   date("Y-m-d");
                $supplier_active    =   1;

                $stmt = $connection->prepare("INSERT INTO supplier 
                (supplier_name, supplier_email, supplier_phone, supplier_mobile, supplier_rfc, supplier_rs, supplier_notes, supplier_address, supplier_date, supplier_active) 
                VALUES (?,?,?,?,?,?,?,?,?,?)");
                $stmt->bind_param("sssssssssi", $supplier_name, $supplier_email, $supplier_phone, $supplier_mobile, $supplier_rfc, $supplier_rs, $supplier_notes, $supplier_address, $register_date, $supplier_active);
                $stmt->execute();
                if($stmt->affected_rows === -1)
                    echo 'Query error';
                if($stmt->affected_rows === 0)
                    echo 'No rows updated';    
                $stmt->close();
                            
            }
        
            addSupplier();     
        }


        if($_GET['function']=="add_machine")
        {

            function addMachine()
            {
                global $connection;

                $machine_category             =   mysqli_real_escape_string($connection, $_POST['machine_category']);
                $machine_name                 =   mysqli_real_escape_string($connection, $_POST['machine_name']);
                $machine_serial               =   mysqli_real_escape_string($connection, $_POST['machine_serial']);
                $machine_cn                   =   mysqli_real_escape_string($connection, $_POST['machine_cn']);
                $machine_date                 =   mysqli_real_escape_string($connection, $_POST['machine_date']);
                $machine_supplier             =   mysqli_real_escape_string($connection, $_POST['machine_supplier']);
                $machine_active               = 1;

                //image
                if(empty($_FILES['machine_image'] ['name']))
                {
                    $target_file = "uploads/machines/noimage.jpg";
                    $uploadOk = 1;
                }
                else
                {
                    $target_dir = "../uploads/machines/";
                    $target_file = $target_dir .rand(). basename($_FILES["machine_image"]["name"]);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                    
                    
                    // Check if file already exists
                    if (file_exists($target_file)) {
                    echo "Sorry, file already exists.";
                    $uploadOk = 0;
                    }

                    // Check file size
                    if ($_FILES["machine_image"]["size"] > 5000000) { //5MB
                    echo "Sorry, your file is too large.";
                    $uploadOk = 0;
                    }

                    // Allow certain file formats
                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif" ) {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                    }
                    
                    // Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) 
                    {
                    echo "Sorry, your file was not uploaded.";
                    // if everything is ok, try to upload file
                    } 
                    else
                    {
                        if (move_uploaded_file($_FILES["machine_image"]["tmp_name"], $target_file)) 
                        {
                            echo "The file ". basename( $_FILES["machine_image"]["name"]). " has been uploaded.";
                            $target_file = substr($target_file, 3);
                        } 
                        else 
                        {
                            echo "Sorry, there was an error uploading your file.";
                        }
                    }
                }
                //image end


                //document upload start
                if(empty($_FILES['machine_document'] ['name']))
                {
                    $target_file2 = "uploads/machines_documents/noupload.jpg";
                    $uploadOk = 1;
                }
                else
                {
                    $target_dir = "../uploads/machines_documents/";
                    $target_file2 = $target_dir .rand(). basename($_FILES["machine_document"]["name"]);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file2,PATHINFO_EXTENSION));

                    
                    
                    // Check if file already exists
                    if (file_exists($target_file2)) {
                    echo "Sorry, file already exists.";
                    $uploadOk = 0;
                    }

                    // Check file size
                    if ($_FILES["machine_document"]["size"] > 5000000) { //5MB
                    echo "Sorry, your file is too large.";
                    $uploadOk = 0;
                    }

                    // Allow certain file formats
                    if($imageFileType != "pdf" && $imageFileType != "PDF" && $imageFileType != "docx"
                    && $imageFileType != "DOCX" ) {
                    echo "Sorry, only PDF and DOCX files are allowed.";
                    $uploadOk = 0;
                    }
                    
                    // Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) 
                    {
                    echo "Sorry, your file was not uploaded.";
                    // if everything is ok, try to upload file
                    } 
                    else
                    {
                        if (move_uploaded_file($_FILES["machine_document"]["tmp_name"], $target_file2)) 
                        {
                            echo "The file ". basename( $_FILES["machine_document"]["name"]). " has been uploaded.";
                            $target_file2 = substr($target_file2, 3);
                        } 
                        else 
                        {
                            echo "Sorry, there was an error uploading your file.";
                        }
                    }
                }







                //document upload end


                $stmt = $connection->prepare("INSERT INTO machines (machine_category_name, machine_name, machine_supplier, 
                machine_date, machine_serial, machine_cn, machine_image, machine_active, machine_document) 
                VALUES (?,?,?,?,?,?,?,?,?)");
                $stmt->bind_param("isissssis", $machine_category, $machine_name, $machine_supplier, $machine_date, $machine_serial, $machine_cn, $target_file, $machine_active, $target_file2);
                $stmt->execute();
                if($stmt->affected_rows === -1)
                    echo 'Query error';
                if($stmt->affected_rows === 0)
                    echo 'No rows updated';    
                $stmt->close();
                            
            }
        
            addMachine();     
        }


        if($_GET['function']=="view_machines")
        {
            
            function viewSuppliers()
            {
                global $connection;

                ## Read value
                $draw = $_POST['draw'];
                $row = $_POST['start'];
                $rowperpage = $_POST['length']; // Rows display per page
                $columnIndex = $_POST['order'][0]['column']; // Column index
                $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
                $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
                $searchValue = $_POST['search']['value']; // Search value

                ## Search 
                $searchQuery = " ";
                if($searchValue != ''){
                        $searchQuery = " and (machine_id like '%".$searchValue."%' or 
                        machine_name like '%".$searchValue."%' or machine_cn like '%".$searchValue."%') ";
                }

                ## Total number of records without filtering
                $sel = mysqli_query($connection,"select count(*) as allcount from machines WHERE machine_active = 1 ORDER BY machine_id ASC");
                $records = mysqli_fetch_assoc($sel);
                $totalRecords = $records['allcount'];

                ## Total number of record with filtering
                $sel = mysqli_query($connection,"select count(*) as allcount from machines WHERE machine_active = 1 ".$searchQuery);
                $records = mysqli_fetch_assoc($sel);
                $totalRecordwithFilter = $records['allcount'];

                ## Fetch records
                $empQuery = "select * from machines  left join supplier on machines.machine_supplier = supplier.supplier_id WHERE machine_active =  1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
                $empRecords = mysqli_query($connection, $empQuery);
                $data = array();

                while ($row = mysqli_fetch_assoc($empRecords)) {

                    ##other querys
                    
                    ##other querys

                $data[] = array( 
                    "machine_id"=>$row['machine_id'],
                    "machine_category"=>$row['machine_category_name'],
                    "machine_name"=>$row['machine_name'],
                    "machine_serial"=>$row['machine_serial'],
                    "machine_cn"=>$row['machine_cn'],
                    "machine_supplier"=>$row['machine_supplier'],
                    "machine_image"=>"<a href='#'><img src='{$row['machine_image']}'  class='view_image_machine' data-image_machine='{$row['machine_image']}' style='width:150px; height:auto;' data-toggle='modal' data-target='#imageMachineModal'  /></a>",
                    "machine_date"=>$row['machine_date'],
                    "machine_btn"=> "<a class='edit-cat'  data-cat-name='{$row['machine_name']}' data-cat-id='{$row['machine_id']}' data-toggle='modal' data-target='#exampleModal'><i data-toggle='tooltip' data-placement='left' title='Edit category' style='font-size: 20px; color:#b5b5b5' class='far fa-edit'></i></a>
                    &nbsp;&nbsp;
                    <a class='delete-cat' data-cat-name='{$row['machine_name']}' data-cat-id='{$row['machine_id']}' data-toggle='modal' data-target='#deleteCatModal'><i data-toggle='tooltip' data-placement='left' title='Delete category' style='font-size: 20px; color:#b5b5b5' class='far fa-trash-alt'></i></a>"
                );
                }

                ## Response
                $response = array(
                "draw" => intval($draw),
                "iTotalRecords" => $totalRecords,
                "iTotalDisplayRecords" => $totalRecordwithFilter,
                "aaData" => $data
                );

                echo json_encode($response);


            }
            viewSuppliers();
        }




    }//end if isset function













    /*******************************************************NON AJAX FUNCTIONS */

    