<?php 
function isValidUser($user, $pass){
    $admin_user = "awang@gmail.com";
    $admin_pass = "awang12345";

    return($user===$admin_user && $pass===$admin_pass);
}
?>