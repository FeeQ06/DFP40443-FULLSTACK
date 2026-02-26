<?php

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users JOIN roles ON roles.id = users.role_id WHERE username=?";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $username);
//mysqli_stmt_execute($stmt);
mysqli_stmt_execute($stmt);

mysqli_stmt_bind_result($stmt, $id, $uname, $db_password, $role);
if($password== $db_password){
    header("Location: dashboard.php");
} else {
    header("Location: login.php");
}

?>