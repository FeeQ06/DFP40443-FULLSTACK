<?php
// logout.php - Session Termination & Restart Functionality
require_once 'config/app_config.php';

// Destroy session completely
session_unset();
session_destroy();

// If restart, go back to login; otherwise also go to login
if (isset($_GET['restart'])) {
    header('Location: login.php');
} else {
    header('Location: login.php');
}
exit;
?>
