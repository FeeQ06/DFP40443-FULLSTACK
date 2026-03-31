<?php 

$host = "127.0.0.1:3306";
$user = "root";
$pass = "";
$db   = "mini_project";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
