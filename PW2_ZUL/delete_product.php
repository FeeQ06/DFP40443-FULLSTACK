<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "DELETE FROM products WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: view_products.php");
        exit;
    } else {
        echo "Error deleting product: " . mysqli_error($conn);
    }
} else {
    echo "No product ID provided.";
}
?>