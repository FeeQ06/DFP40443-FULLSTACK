<?php 

$host = "127.0.0.1:3306";
$user = "root";
$pass = "";
$dbname = "ecommerce_db";

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn){
    die("Connection failed: " . mysqli_connect_error());
}

?>