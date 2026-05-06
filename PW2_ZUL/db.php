<?php 

$host = "localhost";
$user = "root";
$pass = "";
$db = "ecommerce_db_zul";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn){
    die("Gagal disambung, connection failed". mysqli_connect_error());
}

?>      