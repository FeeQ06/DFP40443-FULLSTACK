<?php
require_once "includes/header.php";
?>

<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM products WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $product = mysqli_fetch_assoc($result);
} elseif (isset($_POST['update'])) {
    $id = intval($_POST['id']);
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];

    if (!empty($_FILES['image']['name'])) {
        $new_filename = time() . '_' . basename($_FILES['image']['name']);
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }
        $destination = $target_dir . $new_filename;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
            $image_path = $destination;
        } else {
            echo "Error uploading image.";
            exit;
        }

        $sql = "UPDATE products SET product_name = ?, price = ?, image_path = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sdsi", $product_name, $price, $image_path, $id);
    } else {
        $sql = "UPDATE products SET product_name = ?, price = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sdi", $product_name, $price, $id);
    }

    if (mysqli_stmt_execute($stmt)) {
        header("Location: view_products.php");
        exit;
    } else {
        echo "Error updating product: " . mysqli_error($conn);
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</head>
<body>
<h2 class="text-center mt-4">Edit Product</h2>

<div class="card container mt-3 bg-dark text-white">
<form class="" method="POST" enctype="multipart/form-data">
    
    <div class ="container mt-4">

    <label>Name:</label>
    <input class="form-control" type="text" name="product_name" value="<?php echo htmlspecialchars($product['product_name']); ?>" required><br><br>

    <label>Price (RM)  :</label>
    <input class="form-control" type="number" name="price" value="<?php echo $product['price']; ?>" step="0.01" required><br><br>

    <label>Current Image:</label><br>
    <?php if (!empty($product['image_path'])): ?>
        <img src="  <?php echo $product['image_path']; ?>" max-width="150" max-height="150"><br><br>
    <?php endif; ?>

    <label>New Image:</label>
    <input type="file" name="image"><br><br>

    <input type="submit" value="Update" name="update" class=" mb-4 btn btn-primary text-white ">
    </div>

</form>
    </div>
</body>
</html>