<?php

/**
 * Class registration
 * handles the user registration
 */
class Product
{
    /**
     * @var object $db_connection The database connection
     */
    private $db_connection = null;
    /**
     * @var array $errors Collection of error messages
     */
    public $errors = array();
    /**
     * @var array $messages Collection of success / neutral messages
     */
    public $messages = array();

    
    public function __construct()
    {
        if (isset($_POST["add_product"])) {
            $this->addProduct();
        }

        else if (isset($_POST["update_product"])) {
            $this->updateProduct();
        }

        else if (isset($_POST["delete_product"])) {
            $this->deleteProduct();
        }
    }

    
    private function addProduct()
    {

        if (empty($_POST['product_name'])) 
        {
            $this->errors[] = "Empty product name, Cannot be empty";
        }
        elseif (empty($_POST['product_category'])) 
        {
            $this->errors[] = "Empty product category, Cannot be empty";
        }
        elseif (empty($_POST['product_price']) || empty($_POST['product_currency_code_id']) || empty($_POST['product_qty']) || empty($_POST['product_description'])) 
        {
            $this->errors[] = "All fields must be filled";
        }
        
        elseif (
            !empty($_POST['product_name'])
            && !empty($_POST['product_category']) 
            && !empty($_POST['product_price']) 
            && !empty($_POST['product_currency_code_id']) 
            && !empty($_POST['product_qty']) 
            && !empty($_POST['product_description']) 
        ) 
        {
            // create a database connection
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            // change character set to utf8 and check it
            if (!$this->db_connection->set_charset("utf8")) {
                $this->errors[] = $this->db_connection->error;
            }

            // if no connection errors (= working database connection)
            if (!$this->db_connection->connect_errno) 
            {

                // escaping, additionally removing everything that could be (html/javascript-) code
                
                $product_name               = $this->db_connection->real_escape_string(strip_tags($_POST['product_name'], ENT_QUOTES));
                $product_category           = $this->db_connection->real_escape_string(strip_tags($_POST['product_category'], ENT_QUOTES));
                $product_price              = $this->db_connection->real_escape_string(strip_tags($_POST['product_price'], ENT_QUOTES));
                $product_currency_code_id   = $this->db_connection->real_escape_string(strip_tags($_POST['product_currency_code_id'], ENT_QUOTES));
                $product_qty                = $this->db_connection->real_escape_string(strip_tags($_POST['product_qty'], ENT_QUOTES));
                $product_description        = $this->db_connection->real_escape_string(strip_tags($_POST['product_description'], ENT_QUOTES));
                
                

                // check if category already exists
                $sql = "SELECT * FROM products WHERE product_name = '" . $product_name . "' AND product_category = '".$product_category."'  ;";
                $query_check_user_name = $this->db_connection->query($sql);

                if ($query_check_user_name->num_rows == 1) 
                {
                    $this->errors[] = "Sorry, this product already exists.";
                } 
                else 
                {
                    //upload main image file
                    $target_dir = "uploads/products/";
                    $target_file = $target_dir .rand().basename($_FILES["product_image"]["name"]);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                    // Check if image file is a actual image or fake image
                    
                    if(empty($_FILES["product_image"]["tmp_name"]))
                    {
                        $uploadOk = 1;
                        $target_file = "uploads/products/noimage.png";
                    }
                    else
                    {
                        $check = getimagesize($_FILES["product_image"]["tmp_name"]);
                        if($check !== false) 
                        {
                            //echo "File is an image - " . $check["mime"] . ".";
                            $uploadOk = 1;
                        } 
                        else 
                        {
                            $this->errors[] = "Only images are allowed.";
                            $uploadOk = 0;
                        }

                        
                        // Check if file already exists
                        if (file_exists($target_file)) 
                        {
                            $this->errors[] = "Sorry, file already exists.";
                            $uploadOk = 0;
                        }

                        // Check file size
                        if ($_FILES["product_image"]["size"] > 5000000) {
                            $this->errors[] = "Sorry, your file is too large.";
                            $uploadOk = 0;
                        }

                        // Allow certain file formats
                        if($imageFileType != "jpg" && $imageFileType != "JPG" 
                        && $imageFileType != "PNG" && $imageFileType != "png" 
                        && $imageFileType != "jpeg" && $imageFileType != "JPEG" 
                        && $imageFileType != "gif" && $imageFileType != "GIF" 
                        ) 
                        {
                            $this->errors[] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                            $uploadOk = 0;
                        }

                        // Check if $uploadOk is set to 0 by an error
                        if ($uploadOk == 0) {
                            $this->errors[] = "Sorry, your file was not uploaded.";
                        // if everything is ok, try to upload file
                        } else {
                        if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
                            //echo "The file ". htmlspecialchars( basename( $_FILES["product_image"]["name"])). " has been uploaded.";
                        } else {
                            $this->errors[] = "Sorry, there was an error uploading your file.";
                        }
                        }


                    }

                    // write new user's data into database
                    $sql = "INSERT INTO products (product_name, product_description, product_price, product_currency_code_id, product_image, product_category, product_qty)
                     VALUES('" . $product_name . "', '" . $product_description . "', '" . $product_price . "', '" . $product_currency_code_id . "', '" . $target_file . "', '" . $product_category . "', '" . $product_qty . "');";
                    $query_new_user_insert = $this->db_connection->query($sql);

                    // if user has been added successfully
                    if ($query_new_user_insert) {
                        $this->messages[] = "Product added successfully.";
                    } else {
                        $this->errors[] = "Something went wrong, couldn't add product.";
                    }
                }
            } 
            else 
            {
                $this->errors[] = "Sorry, no database connection.";
            }
        }
        else
        {
            $this->errors[] = "A validation error occurred.";
        }
    }


    


    private function updateProduct()
    {
        if(!is_numeric($_GET['product']))
        {
            $this->errors[] = "Cant find product";
        }

        else if (empty($_POST['product_name'])) 
        {
            $this->errors[] = "Empty product name, Cannot be empty";
        }
        else if (empty($_POST['product_category'])) 
        {
            $this->errors[] = "Empty product category, Cannot be empty";
        }
        elseif (empty($_POST['product_price']) || empty($_POST['product_currency_code_id']) || empty($_POST['product_qty']) || empty($_POST['product_description'])) 
        {
            $this->errors[] = "All fields must be filled";
        }
        
        elseif (
            is_numeric($_GET['product']) 
            && !empty($_POST['product_name'])
            && !empty($_POST['product_category']) 
            && !empty($_POST['product_price']) 
            && !empty($_POST['product_currency_code_id']) 
            && !empty($_POST['product_qty']) 
            && !empty($_POST['product_description']) 
        ) 
        {
            // create a database connection
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            // change character set to utf8 and check it
            if (!$this->db_connection->set_charset("utf8")) {
                $this->errors[] = $this->db_connection->error;
            }

            // if no connection errors (= working database connection)
            if (!$this->db_connection->connect_errno) 
            {

                // escaping, additionally removing everything that could be (html/javascript-) code
                $product_id                 = $_GET['product'];
                $product_name               = $this->db_connection->real_escape_string(strip_tags($_POST['product_name'], ENT_QUOTES));
                $product_category           = $this->db_connection->real_escape_string(strip_tags($_POST['product_category'], ENT_QUOTES));
                $product_price              = $this->db_connection->real_escape_string(strip_tags($_POST['product_price'], ENT_QUOTES));
                $product_currency_code_id   = $this->db_connection->real_escape_string(strip_tags($_POST['product_currency_code_id'], ENT_QUOTES));
                $product_qty                = $this->db_connection->real_escape_string(strip_tags($_POST['product_qty'], ENT_QUOTES));
                $product_description        = $this->db_connection->real_escape_string(strip_tags($_POST['product_description'], ENT_QUOTES));
                
                

                // check if category already exists
                $sql = "SELECT * FROM products WHERE product_name = '" . $product_name . "' AND product_category = '".$product_category."'  AND product_id != $product_id;";
                $query_check_user_name = $this->db_connection->query($sql);

                if ($query_check_user_name->num_rows == 1) 
                {
                    $this->errors[] = "Sorry, this product already exists.";
                } 
                else 
                {
                    //upload main image file
                    $target_dir = "uploads/products/";
                    $target_file = $target_dir .rand().basename($_FILES["product_image"]["name"]);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                    // Check if image file is a actual image or fake image
                    
                    if(empty($_FILES["product_image"]["tmp_name"]))
                    {
                        $noimage = 1;
                        $uploadOk = 1;
                        $target_file = "";
                    }
                    else
                    {
                        $noimage = 0;
                        $check = getimagesize($_FILES["product_image"]["tmp_name"]);
                        if($check !== false) 
                        {
                            //echo "File is an image - " . $check["mime"] . ".";
                            $uploadOk = 1;
                        } 
                        else 
                        {
                            $this->errors[] = "Only images are allowed.";
                            $uploadOk = 0;
                        }

                        
                        // Check if file already exists
                        if (file_exists($target_file)) 
                        {
                            $this->errors[] = "Sorry, file already exists.";
                            $uploadOk = 0;
                        }

                        // Check file size
                        if ($_FILES["product_image"]["size"] > 5000000) {
                            $this->errors[] = "Sorry, your file is too large.";
                            $uploadOk = 0;
                        }

                        // Allow certain file formats
                        if($imageFileType != "jpg" && $imageFileType != "JPG" 
                        && $imageFileType != "PNG" && $imageFileType != "png" 
                        && $imageFileType != "jpeg" && $imageFileType != "JPEG" 
                        && $imageFileType != "gif" && $imageFileType != "GIF" 
                        ) 
                        {
                            $this->errors[] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                            $uploadOk = 0;
                        }

                        // Check if $uploadOk is set to 0 by an error
                        if ($uploadOk == 0) {
                            $this->errors[] = "Sorry, your file was not uploaded.";
                        // if everything is ok, try to upload file
                        } else {
                        if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
                            //echo "The file ". htmlspecialchars( basename( $_FILES["product_image"]["name"])). " has been uploaded.";
                        } else {
                            $this->errors[] = "Sorry, there was an error uploading your file.";
                        }
                        }


                    }

                    // write new user's data into database
                    if($noimage == 1)
                    {
                        $sql = "UPDATE products SET product_name = '" . $product_name . "', product_description = '" . $product_description . "',  
                        product_price = '" . $product_price . "', product_currency_code_id = '" . $product_currency_code_id . "',  
                        product_category = '" . $product_category . "', product_qty = '" . $product_qty . "' WHERE product_id = $product_id;";
                       
                    }
                    else
                    {
                        $sql = "UPDATE products SET product_name = '" . $product_name . "', product_description = '" . $product_description . "',  
                        product_price = '" . $product_price . "', product_currency_code_id = '" . $product_currency_code_id . "',  
                        product_category = '" . $product_category . "', product_qty = '" . $product_qty . "', product_image = '" . $target_file . "'  WHERE product_id = $product_id;";
                       
                    }
                    
                    $query_new_user_insert = $this->db_connection->query($sql);

                    // if user has been added successfully
                    if ($query_new_user_insert) {
                        $this->messages[] = "Product added successfully.";
                    } else {
                        $this->errors[] = "Something went wrong, couldn't add product.";
                    }
                }
            } 
            else 
            {
                $this->errors[] = "Sorry, no database connection.";
            }
        }
        else
        {
            $this->errors[] = "A validation error occurred.";
        }
    }








    /**
    * handles user delete process. checks all error possibilities
    * and deletes user in the database if everything is fine
    */
    private function deleteProduct()
    {
       
        
        if(!is_numeric($_GET['product']))
        {
            $this->errors[] = "Cant find product";
        }
        
        elseif (is_numeric($_GET['product']) ) 
        {
            // create a database connection
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            // change character set to utf8 and check it
            if (!$this->db_connection->set_charset("utf8")) {
                $this->errors[] = $this->db_connection->error;
            }

            // if no connection errors (= working database connection)
            if (!$this->db_connection->connect_errno) {

                // escaping, additionally removing everything that could be (html/javascript-) code
                $product_id     = $_GET['product'];
                
               
                // write new user's data into database
                $sql = "UPDATE products SET product_active = 0 WHERE product_id = $product_id;";
                $query_new_user_insert = $this->db_connection->query($sql);

                // if user has been added successfully
                if ($query_new_user_insert) {
                    //$this->messages[] = "Product deleted successfully.";
                    header("Location: index.php?page=product_list");
                } else {
                    $this->errors[] = "Something went wrong, couldn't delete product.";
                }
            
            } else {
                $this->errors[] = "Sorry, no database connection.";
            }
        } else {
            $this->errors[] = "A validation error occurred.";
        }

    }










}




  