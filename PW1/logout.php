<?php
// logout.php - Destroys session and redirects to login
require_once 'config/app_config.php';

session_unset();
session_destroy();

header('Location: login.php');
exit;
?>
