<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "photo.com";

$connection= new mysqli($servername,$username, $password, $database);

//if connection failed, abort
if ($connection->connect_error) {
   die("Connection failed: " . $connection->connect_error);
}
// set the charset encoding (otherwise the characters will get confused)
$connection->set_charset("utf8");


?>