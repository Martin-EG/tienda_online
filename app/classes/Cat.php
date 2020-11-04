<?php

/**
 * Class registration
 * handles the user registration
 */
class Cat
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
        if (isset($_POST["add_cat"])) {
            $this->addCat();
        }

        else if (isset($_POST["update_cat"])) {
            $this->updateCat();
        }

        else if (isset($_POST["delete_cat"])) {
            $this->deleteCat();
        }
    }

    
    private function addCat()
    {

        if (empty($_POST['cat_name'])) 
        {
            $this->errors[] = "Empty category name, Cannot be empty";
        }
        
        elseif (!empty($_POST['cat_name'])) 
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
                $cat_name               = $this->db_connection->real_escape_string(strip_tags($_POST['cat_name'], ENT_QUOTES));
                


                // check if category already exists
                $sql = "SELECT * FROM categories WHERE cat_name = '" . $cat_name . "' ;";
                $query_check_user_name = $this->db_connection->query($sql);

                if ($query_check_user_name->num_rows == 1) {
                    $this->errors[] = "Sorry, that category already exists.";
                } else {
                    // write new user's data into database
                    $sql = "INSERT INTO categories (cat_name) VALUES('" . $cat_name . "');";
                    $query_new_user_insert = $this->db_connection->query($sql);

                    // if user has been added successfully
                    if ($query_new_user_insert) {
                        $this->messages[] = "Category added successfully.";
                    } else {
                        $this->errors[] = "Something went wrong, couldn't add category.";
                    }
                }
            } else {
                $this->errors[] = "Sorry, no database connection.";
            }
        } else {
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




  