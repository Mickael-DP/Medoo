<?php

include_once ("file:///C:/laragon/www/Medoo/Medoo.php");

use Medoo\Medoo;

//Initialisation

$database = new Medoo([
    'database_type' => 'mysql',
    'database_name' => 'niv2 /exo1',
    'server' => 'localhost',
    'username' => 'root',
    'password' => ''
]);

?>