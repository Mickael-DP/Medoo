<?php

include_once ("Medoo.php");

use Medoo\Medoo;

//Initialisation

$database = new Medoo([
    'database_type' => 'mysql',
    'database_name' => 'scraper_email',
    'server' => 'localhost',
    'username' => 'root',
    'password' => ''
]);

?>