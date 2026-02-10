<?php
require_once 'config/app_config.php';
require_once 'includes/header.php';

echo "<h2 style='text-align: center;'>Your Score: " . $_SESSION['score'] . "</h2>";

require_once 'includes/footer.php';
?>