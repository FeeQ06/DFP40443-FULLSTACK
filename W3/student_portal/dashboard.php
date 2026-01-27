<?php
require 'includes/functions.php';
include 'includes/header.php'; 

if (isset($_POST['user']) && isset($_POST['pass'])){

$user = $_POST['user'];
$pass = $_POST['pass'];

if(isValidUser($user, $pass)){
    echo "<h1>Welcome to Your Dashboard!</h1>";
} else {
    echo "Wrong User Password";
}
} else {
    echo "<h2>Please Login First.</h2>";
}

?>
<h2><Portal>Welcome to The Student Portal</Portal></h2>

<?php include 'includes/footer.php' ?>