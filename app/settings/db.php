<?php
define("DB_HOST", "localhost");
define("DB_NAME", "e_store");
define("DB_USER", "root");
define("DB_PASS", "");
/*
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
set_exception_handler(function($e) 
{
  error_log($e->getMessage());
  exit('Error connecting to database');
});
*/
$connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$connection->set_charset("utf8");


//require_once("functions/users/users.php");