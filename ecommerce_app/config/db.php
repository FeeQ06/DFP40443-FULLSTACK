<?php 

<<<<<<< HEAD
$host = "127.0.0.1:3306";
=======
$host = "127.0.0.1:3307";
>>>>>>> 57a41fadeb8cc6bfcc12c3d0a50a21b37d55009d
$user = "root";
$pass = "";
$dbname = "ecommerce_db";

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn){
    die("Connection failed: " . mysqli_connect_error());
}

?>