<?php 

require_once "config/app_config.php";

if ($conn){
    echo "Berjaya tersambung ke database";
} else {
    echo "Gagal tersambung ke database";
    echo "<p>Error: ". mysqli_connect_error() . "</p>";
    }

?>