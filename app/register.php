<?php

/**
 * @author Jose Luis Gomez Cecena
 * @link https://github.com/joseluisgomezcecena/
 * @license None
 */


require_once("settings/db.php");
require_once("classes/Registration.php");

$registration = new Registration();

include("views/register.php");
