<?php

/**
 * Class registration
 * handles the user registration
 */
class Inventory
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
        //session_start();

        if (isset($_POST["purchase_product"])) {
            $this->purchaseProduct();
        }

        else if (isset($_POST["loss_product"])) {
            $this->lossProduct();
        }

        else if (isset($_POST["delete_cat"])) {
            $this->deleteCat();
        }
    }

    
    private function purchaseProduct()
    {
        if(!is_numeric($_GET['product']))
        {
            $this->errors[] = "Cant find product";
        }
        
        else if (empty($_POST['purchase_qty'])) 
        {
            $this->errors[] = "Quantity cannot be empty.";
        }
        
        else if (!empty($_POST['purchase_qty']) && is_numeric($_GET['product'])) 
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
                $user_id        = $_SESSION['user_id'];
                $product_id     = $_GET['product'];
                $purchase_qty   = $this->db_connection->real_escape_string(strip_tags($_POST['purchase_qty'], ENT_QUOTES));
                $purchase_date  = date("Y-m-d H:i:s");
                
            
                // check if category already exists
                $sql = "SELECT * FROM products WHERE product_id = $product_id ;";
                $query_check_product = $this->db_connection->query($sql);

                if ($query_check_product->num_rows == 1) 
                {
                    $result_row = $query_check_product->fetch_object();
                    $product_qty = $result_row->product_qty;

                    if($purchase_qty <= $product_qty)
                    {
                        $new_qty = $product_qty + $purchase_qty;

                        // write new user's data into database
                        $sql = "UPDATE products SET product_qty = '$new_qty' WHERE product_id = $product_id";
                        $query_new_user_insert = $this->db_connection->query($sql);


                        // if user has been added successfully
                        if ($query_new_user_insert) 
                        {
                            //$this->messages[] = "Category added successfully.";
                            // write new user's data into database
                            $sql2 = "INSERT INTO purchases (loss_product_id, loss_qty, loss_user_id, loss_date) 
                            VALUES('" .$product_id. "', '" .$purchase_qty. "', '" .$user_id. "', '" .$purchase_date. "');";
                            $query_new_user_insert2 = $this->db_connection->query($sql2);
                            if ($query_new_user_insert2)
                            {
                                $this->messages[] = "Product purchase registered successfully.";
                            }
                            else
                            {
                                $this->errors[] = "Couldn't register loss.";
                            }
                            
                        } 
                        else
                        {
                            $this->errors[] = "Something went wrong, couldn't register loss.";
                        }
                    }
                    else
                    {
                        $this->errors[] = "There's not enough inventory."; 
                    }
                }
                else
                {
                    $this->errors[] = "Sorry, that product doesn't exist.";
                }
            } 
            else
            {
                $this->errors[] = "Sorry, no database connection.";
            }
        } 
        else
        {
            $this->errors[] = "An unknown error occurred.";
        }
    }





    private function lossProduct()
    {


        if(!is_numeric($_GET['product']))
        {
            $this->errors[] = "Cant find product";
        }
        
        else if (empty($_POST['loss_qty'])) 
        {
            $this->errors[] = "Quantity cannot be empty.";
        }
        
        else if (!empty($_POST['loss_qty']) && is_numeric($_GET['product'])) 
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
                $user_id        = $_SESSION['user_id'];
                $product_id     = $_GET['product'];
                $purchase_qty   = $this->db_connection->real_escape_string(strip_tags($_POST['loss_qty'], ENT_QUOTES));
                $purchase_date  = date("Y-m-d H:i:s");
                $loss_note      = $this->db_connection->real_escape_string(strip_tags($_POST['loss_note'], ENT_QUOTES));
            
                // check if category already exists
                $sql = "SELECT * FROM products WHERE product_id = $product_id ;";
                $query_check_product = $this->db_connection->query($sql);

                if ($query_check_product->num_rows == 1) 
                {
                    $result_row = $query_check_product->fetch_object();
                    $product_qty = $result_row->product_qty;

                    if($purchase_qty <= $product_qty)
                    {
                        $new_qty = $product_qty - $purchase_qty;

                        // write new user's data into database
                        $sql = "UPDATE products SET product_qty = '$new_qty' WHERE product_id = $product_id";
                        $query_new_user_insert = $this->db_connection->query($sql);


                        // if user has been added successfully
                        if ($query_new_user_insert) 
                        {
                            //$this->messages[] = "Category added successfully.";
                            // write new user's data into database
                            $sql2 = "INSERT INTO losses (loss_product_id, loss_qty, loss_user_id, loss_date, loss_note) 
                            VALUES('" .$product_id. "', '" .$purchase_qty. "', '" .$user_id. "', '" .$purchase_date. "', '" .$loss_note. "');";
                            $query_new_user_insert2 = $this->db_connection->query($sql2);
                            if ($query_new_user_insert2)
                            {
                                $this->messages[] = "Product loss registered successfully.";
                            }
                            else
                            {
                                $this->errors[] = "Couldn't register loss.";
                            }
                            
                        } 
                        else
                        {
                            $this->errors[] = "Something went wrong, couldn't register loss.";
                        }
                    }
                    else
                    {
                        $this->errors[] = "There's not enough inventory."; 
                    }
                }
                else
                {
                    $this->errors[] = "Sorry, that product doesn't exist.";
                }
            } 
            else
            {
                $this->errors[] = "Sorry, no database connection.";
            }
        } 
        else
        {
            $this->errors[] = "An unknown error occurred.";
        }
    }

    


    private function updateCat()
    {
       
        if(!is_numeric($_GET['cat']))
        {
            $this->errors[] = "Cant find category";
        }

        else if (empty($_POST['cat_name'])) 
        {
            $this->errors[] = "Empty category name, Cannot be empty";
        }
        
        elseif (!empty($_POST['cat_name']) && is_numeric($_GET['cat']) ) 
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
                $cat_id     = $_GET['cat'];
                $cat_name   = $this->db_connection->real_escape_string(strip_tags($_POST['cat_name'], ENT_QUOTES));
                


                // check if category already exists
                $sql = "SELECT * FROM categories WHERE cat_name = '" . $cat_name . "' AND cat_id != $cat_id ;";
                $query_check_user_name = $this->db_connection->query($sql);

                if ($query_check_user_name->num_rows == 1) {
                    $this->errors[] = "Sorry, that category already exists.";
                } else {
                    // write new user's data into database
                    $sql = "UPDATE categories SET cat_name ='" . $cat_name . "' WHERE cat_id = $cat_id;";
                    $query_new_user_insert = $this->db_connection->query($sql);

                    // if user has been added successfully
                    if ($query_new_user_insert) {
                        $this->messages[] = "Category updated successfully.";
                    } else {
                        $this->errors[] = "Something went wrong, couldn't update category.";
                    }
                }
            } else {
                $this->errors[] = "Sorry, no database connection.";
            }
        } else {
            $this->errors[] = "A validation error occurred.";
        }
    }








    /**
    * handles user delete process. checks all error possibilities
    * and deletes user in the database if everything is fine
    */
    private function deleteCat()
    {
       
        
        if(!is_numeric($_GET['cat']))
        {
            $this->errors[] = "Cant find category";
        }

        else if (empty($_POST['cat_name'])) 
        {
            $this->errors[] = "Empty category name, Cannot be empty";
        }
        
        elseif (!empty($_POST['cat_name']) && is_numeric($_GET['cat']) ) 
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
                $cat_id     = $_GET['cat'];
                $cat_name   = $this->db_connection->real_escape_string(strip_tags($_POST['cat_name'], ENT_QUOTES));
                


                // check if category already exists
                $sql = "SELECT * FROM categories WHERE cat_name = '" . $cat_name . "' AND cat_id != $cat_id ;";
                $query_check_user_name = $this->db_connection->query($sql);

                if ($query_check_user_name->num_rows == 1) {
                    $this->errors[] = "Sorry, that category already exists.";
                } else {
                    // write new user's data into database
                    $sql = "UPDATE categories SET cat_active = 0 WHERE cat_id = $cat_id;";
                    $query_new_user_insert = $this->db_connection->query($sql);

                    // if user has been added successfully
                    if ($query_new_user_insert) {
                        $this->messages[] = "Category updated successfully.";
                    } else {
                        $this->errors[] = "Something went wrong, couldn't update category.";
                    }
                }
            } else {
                $this->errors[] = "Sorry, no database connection.";
            }
        } else {
            $this->errors[] = "A validation error occurred.";
        }

    }










}




  