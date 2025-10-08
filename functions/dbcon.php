<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "mbcLibrary-db";

$con = mysqli_connect($host, $user, $password, $database);

if(!$con){
    die("Connection failed: ". mysqli_connect_error());
}
?>