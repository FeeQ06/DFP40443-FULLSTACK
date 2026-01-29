<?php
session_start();

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $namapengguna = $_POST['user'];
    $katalaluan = $_POST['pass'];

if($namapengguna == "awang" && $katalaluan == "root"){
    $_SESSION['username'] = $namapengguna;
    $_SESSION['loggedin'] = true;
    header("Location:dashboard.php");
    exit();
    } else {
        $error = "Invalid user";
    }
}

?>

<form method="POST" action="login.php">
    Username <input type="text" name="user">
    Password <input type="password" name="pass">
    <input type="submit" value="login">
</form>