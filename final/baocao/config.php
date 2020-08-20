<?php

/* Database credentials. Assuming you are running MySQL

server with default setting (user 'root' with no password) */

define('DB_SERVER', 'sql303.unaux.com');

define('DB_USERNAME', 'unaux_24697656');

define('DB_PASSWORD', 'tunganh2003');

define('DB_NAME', 'unaux_24697656_doantruong');

 

/* Attempt to connect to MySQL database */

$link =  mysqli_connect("localhost","root" ,"","members"); // will connect.
 
 

// Check connection

if($link === false){

    die("ERROR: Could not connect. " . mysqli_connect_error());

}

?>