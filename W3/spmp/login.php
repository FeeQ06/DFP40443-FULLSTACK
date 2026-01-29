<?php
session_start();

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $namapengguna = $_POST['user'];
    $katalaluan = $_POST['pass'];

if($namepengguna == "admin" && $katalaluan == "root"){
    $_SESSION['username'] = $namapengguna;
    header("dashboard.php");
    exit();
    } else {
        $error = "Invalid user";
    }
}

?>

<form method="POST">
    Username <input type="text" name="username">
    Password <input type="password" name="password">
    <input type="submit">
</form>
<p><?php echo $error ?></p>
    