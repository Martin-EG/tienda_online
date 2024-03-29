<?php

/**
 * Class registration
 * handles the user registration
 */
class Users
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

    /**
     * the function "__construct()" automatically starts whenever an object of this class is created,
     * you know, when you do "$registration = new Registration();"
     */
    public function __construct()
    {
        if (isset($_POST["new_user"])) {
            $this->newUser();
        }

        else if (isset($_POST["update_user"])) {
            $this->updateUser();
        }

        else if (isset($_POST["delete_user"])) {
            $this->deleteUser();
        }
    }

    /**
     * handles the entire registration process. checks all error possibilities
     * and creates a new user in the database if everything is fine
     */
    private function newUser()
    {

       
        

        if (empty($_POST['user_name'])) 
        {
            $this->errors[] = "Empty Username";
        }
        elseif (empty($_POST['user_password_new']) || empty($_POST['user_password_repeat'])) 
        {
            $this->errors[] = "Empty Password";
        }
        elseif (empty($_POST['user_first_name']) || empty($_POST['user_last_name']) || empty($_POST['user_employee_number'])) 
        {
            $this->errors[] = "Empty User Information, Name or Employee Number";
        }
        elseif ($_POST['user_password_new'] !== $_POST['user_password_repeat']) 
        {
            $this->errors[] = "Password and password repeat are not the same";
        }
        elseif (strlen($_POST['user_password_new']) < 6) 
        {
            $this->errors[] = "Password has a minimum length of 6 characters";
        }
        elseif (strlen($_POST['user_name']) > 64 || strlen($_POST['user_name']) < 2) 
        {
            $this->errors[] = "Username cannot be shorter than 2 or longer than 64 characters";
        }
        elseif (!preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_name'])) 
        {
            $this->errors[] = "Username does not fit the name scheme: only a-Z and numbers are allowed, 2 to 64 characters";
        }
        elseif (empty($_POST['user_email'])) 
        {
            $this->errors[] = "Email cannot be empty";
        }
        elseif (strlen($_POST['user_email']) > 64) 
        {
            $this->errors[] = "Email cannot be longer than 64 characters";
        }
        elseif (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) 
        {
            $this->errors[] = "Your email address is not in a valid email format";
        }
        elseif (!empty($_POST['user_name'])
            && strlen($_POST['user_name']) <= 64
            && strlen($_POST['user_name']) >= 2
            && preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_name'])
            && !empty($_POST['user_email'])
            && strlen($_POST['user_email']) <= 64
            && filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)
            && !empty($_POST['user_password_new'])
            && !empty($_POST['user_password_repeat'])
            && ($_POST['user_password_new'] === $_POST['user_password_repeat'])) 
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
                $user_name              = $this->db_connection->real_escape_string(strip_tags($_POST['user_name'], ENT_QUOTES));
                $user_email             = $this->db_connection->real_escape_string(strip_tags($_POST['user_email'], ENT_QUOTES));
                $user_first_name        = $this->db_connection->real_escape_string(strip_tags($_POST['user_first_name'], ENT_QUOTES));
                $user_last_name         = $this->db_connection->real_escape_string(strip_tags($_POST['user_last_name'], ENT_QUOTES));
                $user_employee_number   = $this->db_connection->real_escape_string(strip_tags($_POST['user_employee_number'], ENT_QUOTES));
                $user_phone             = $this->db_connection->real_escape_string(strip_tags($_POST['user_phone'], ENT_QUOTES));
                $user_areacode          = $this->db_connection->real_escape_string(strip_tags($_POST['user_areacode'], ENT_QUOTES));
                $user_date              = date("Y-m-d H:i:s");





                $user_password = $_POST['user_password_new'];

                // crypt the user's password with PHP 5.5's password_hash() function, results in a 60 character
                // hash string. the PASSWORD_DEFAULT constant is defined by the PHP 5.5, or if you are using
                // PHP 5.3/5.4, by the password hashing compatibility library
                $user_password_hash = password_hash($user_password, PASSWORD_DEFAULT);



                // check if user or email address already exists
                $sql = "SELECT * FROM users WHERE user_name = '" . $user_name . "' OR user_email = '" . $user_email . "';";
                $query_check_user_name = $this->db_connection->query($sql);

                if ($query_check_user_name->num_rows == 1) {
                    $this->errors[] = "Sorry, that username / email address is already taken.";
                } else {
                    // write new user's data into database
                    $sql = "INSERT INTO users (user_name, user_password_hash, user_email, user_first_name, user_last_name, user_employee_number, 
                    user_phone, user_areacode, user_date)
                            VALUES('" . $user_name . "', '" . $user_password_hash . "', '" . $user_email . "', '" . $user_first_name . "'
                            , '" . $user_last_name . "', '" . $user_employee_number . "', '" . $user_phone . "', '" . $user_areacode . "'
                            , '" . $user_date . "');";
                    $query_new_user_insert = $this->db_connection->query($sql);

                    // if user has been added successfully
                    if ($query_new_user_insert) {
                        $this->messages[] = "Your account has been created successfully. You can now log in.";
                    } else {
                        $this->errors[] = "Sorry, your registration failed. Please go back and try again.";
                    }
                }
            } else {
                $this->errors[] = "Sorry, no database connection.";
            }
        } else {
            $this->errors[] = "An unknown error occurred.";
        }
    }


    /**
    * handles user update process. checks all error possibilities
    * and updates user in the database if everything is fine
    */
    private function updateUser()
    {
       
        if(!is_numeric($_GET['user']))
        {
            $this->errors[] = "Cant find user";
        }

        elseif (empty($_POST['user_name'])) 
        {
            $this->errors[] = "Username cannot be empty";
        }

        elseif (!empty($_POST['user_password_new'])&&($_POST['user_password_new'] !== $_POST['user_password_repeat'] || strlen($_POST['user_password_new']) < 6)) 
        {
            
            $this->errors[] = "Password and password repeat are not the same, or passwor is less than 6 characters";    
        }
        
        elseif (strlen($_POST['user_name']) > 64 || strlen($_POST['user_name']) < 2) 
        {
            $this->errors[] = "Username cannot be shorter than 2 or longer than 64 characters";
        }

        elseif (!preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_name'])) 
        {
            $this->errors[] = "Username does not fit the name scheme: only a-Z and numbers are allowed, 2 to 64 characters";
        }

        elseif (strlen($_POST['user_email']) > 64) 
        {
            $this->errors[] = "Email cannot be longer than 64 characters";
        }

        elseif (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) 
        {
            $this->errors[] = "Your email address is not in a valid email format";
        }

        elseif (!empty($_POST['user_name'])
            && strlen($_POST['user_name']) <= 64
            && strlen($_POST['user_name']) >= 2
            && preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_name'])
            && strlen($_POST['user_email']) <= 64
            && filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)
            &&(is_numeric($_GET['user']))
            //&& !empty($_POST['user_password_new'] &&($_POST['user_password_new'] !== $_POST['user_password_repeat'] || strlen($_POST['user_password_new']) < 6) )
            //&& !empty($_POST['user_password_repeat'])
            && ($_POST['user_password_new'] === $_POST['user_password_repeat'])
            ) 
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
                $user_id                = $_GET['user'];
                $user_name              = $this->db_connection->real_escape_string(strip_tags($_POST['user_name'], ENT_QUOTES));
                $user_email             = $this->db_connection->real_escape_string(strip_tags($_POST['user_email'], ENT_QUOTES));
                $user_first_name        = $this->db_connection->real_escape_string(strip_tags($_POST['user_first_name'], ENT_QUOTES));
                $user_last_name         = $this->db_connection->real_escape_string(strip_tags($_POST['user_last_name'], ENT_QUOTES));
                $user_employee_number   = $this->db_connection->real_escape_string(strip_tags($_POST['user_employee_number'], ENT_QUOTES));
                $user_phone             = $this->db_connection->real_escape_string(strip_tags($_POST['user_phone'], ENT_QUOTES));
                $user_areacode          = $this->db_connection->real_escape_string(strip_tags($_POST['user_areacode'], ENT_QUOTES));
                $user_last_update       = date("Y-m-d H:i:s");
                
                if(isset($_POST['user_locked']))
                {
                    $user_locked            = $_POST['user_locked'];
                    if($user_locked == 'on')
                        $user_locked = 1;
                    else
                        $user_locked = 0;
                }
                else
                {
                    $user_locked = 0;
                }
                
                if(isset($_POST['user_suspend']))
                {
                    $user_suspend           = $_POST['user_suspend'];
                    if($user_suspend == 'on')
                        $user_suspend = 1;
                    else
                        $user_suspend = 0;    
                }
                else
                {
                    $user_suspend = 0;
                }
                

                $user_password = $_POST['user_password_new'];

                // crypt the user's password with PHP 5.5's password_hash() function, results in a 60 character
                // hash string. the PASSWORD_DEFAULT constant is defined by the PHP 5.5, or if you are using
                // PHP 5.3/5.4, by the password hashing compatibility library
                $user_password_hash = password_hash($user_password, PASSWORD_DEFAULT);



                // check if user or email address already exists
                $sql = "SELECT * FROM users WHERE (user_name = '" . $user_name . "' OR user_email = '" . $user_email . "') AND user_id != $user_id;";
                $query_check_user_name = $this->db_connection->query($sql);

                if ($query_check_user_name->num_rows == 1) {
                    $this->errors[] = "Sorry, that username / email address is already taken.";
                } else {

                    // write new user's data into database
                    $sql = "UPDATE users SET user_name = '$user_name', user_email = '$user_email', user_first_name = '$user_first_name', 
                    user_last_name = '$user_last_name', user_employee_number = '$user_employee_number', user_phone = '$user_phone', 
                    user_areacode = '$user_areacode', user_locked = '$user_locked', user_suspend = '$user_suspend',  user_last_update = '$user_last_update' 
                    WHERE user_id = $user_id";
                    $query_new_user_insert = $this->db_connection->query($sql);

                    // if user has been added successfully
                    if ($query_new_user_insert) {
                        $this->messages[] = "User data was updated successfully.";
                    } else {
                        $this->errors[] = "Sorry, data update failed. Please go back and try again.";
                    }
                }
            } else {
                $this->errors[] = "Sorry, no database connection.";
            }
        } else {
            $this->errors[] = "An unknown error occurred.";
        }





    }








    /**
    * handles user delete process. checks all error possibilities
    * and deletes user in the database if everything is fine
    */
    private function deleteUser()
    {
       
        if(!is_numeric($_GET['user']))
        {
            $this->errors[] = "Cant find user";
        }
        else if(is_numeric($_GET['user']))
        {
            // create a database connection
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            // change character set to utf8 and check it
            if (!$this->db_connection->set_charset("utf8")) {
                $this->errors[] = $this->db_connection->error;
            }

            // if no connection errors (= working database connection)
            if (!$this->db_connection->connect_errno) {


                $user_id = $_GET['user'];

                // write new user's data into database
                $sql = "UPDATE users SET user_active = 0 WHERE user_id = $user_id";
                $query_new_user_insert = $this->db_connection->query($sql);

                // if user has been added successfully
                if ($query_new_user_insert) {
                    header("Location: index.php?page=user_list");
                    //$this->messages[] = "User data was updated successfully.";
                } else {
                    $this->errors[] = "Sorry, data update failed. Please go back and try again.";
                }
                
            } else {
                $this->errors[] = "Sorry, no database connection.";
            }
        } else {
            $this->errors[] = "An unknown error occurred.";
        }





    }










}




  