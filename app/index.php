<?php
/**
 * @author Jose Luis Gomez Cecena
 * @link https://github.com/joseluisgomezcecena/
 * @license None
 */

require_once("settings/settings.php");
require_once("classes/Login.php");
require_once("settings/db.php");



$login = new Login();


//login data 
if(isset($_SESSION['user_name'])){
    $user_name = $_SESSION['user_name'];
}



if ($login->isUserLoggedIn() == true) 
{
    include("views/logged_in.php");
} 
else 
{
    include("views/not_logged_in.php");
}

