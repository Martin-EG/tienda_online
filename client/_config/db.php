<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "e_store";

    $connection = mysqli_connect($servername, $username, $password, $database);

    if(!$connection){
        die("Connection failed: ". mysqli_connect_error());
    }

    include_once "functions.php";
    