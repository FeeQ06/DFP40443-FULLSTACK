<?php
require_once 'config/app_config.php';

$error='';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    if(isset($users[$username]) &&$users[$username] === $password){
    //sekiranya nilai benar
    header('Location: quiz.php');
    } else {
    //sekiranya nilai tidak benar
    $error="Invalid Username or Password";
    }
}

$pageTitle = 'Login';
require_once 'include/header.php'

return[
    'site_name' => 'PHP Knowledge Quiz',
    'name' => 'Awang',
    'version' => '1.0.0'
]
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Practical Work 1</title>
    </head>

    <div class="container mt-5">
    <header>
        <h2><strong>PHP Knowledge Questions<strong></h2>
    </header>


    <body>
        <div class="container">
        <form action="page1.php" method="POST">
            <p>Answer ALL questions.</p>
            <br>
                
                <label for="username">Enter Name: </label>
                <input type="text" name="username" id="name">
                <input type="submit" value="Start Quiz">
        </form>
    </div>