<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "showroom_db";

    $conn = mysqli_connect($host, $username, $password, $dbname);

    //error handling if mysqli cannot connect to database
    if (!$conn){
        die("Connection failed".mysqli_connect_error());
    }
    
    //insert default admin login using password hashing
    $check = mysqli_query($conn, "SELECT * FROM admins WHERE username = 'admin'");
    if(mysqli_num_rows($check)==0){
        $hash = password_hash('admin123', PASSWORD_DEFAULT);
        $stmt = mysqli_prepare($conn, "INSERT INTO admins (username, password) VALUES (?, ?)");
        $admin_user='admin';
        mysqli_stmt_bind_param($stmt, "ss", $admin_user, $hash);
        mysqli_stmt_execute($stmt);
        echo "Database Setup Completed.";
    }

?>