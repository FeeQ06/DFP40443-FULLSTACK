<?php
require_once "config/db.php";
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = trim($_POST["product_id"] ?? "");
    $product_name = trim($_POST["product_name"] ?? "");
    $price = trim($_POST["price"] ?? "");
    $image_path = trim($_POST["image_path"] ?? "");
    
    $check_stmt = $conn->prepare("SELECT id FROM products WHERE id = ?");
    $check_stmt->bind_param("s", $id);
    $check_stmt->execute();
    $check_stmt->store_result();
    
    if (!is_dir('product_images/')) {
        mkdir('product_images', 0777, true);
    }

    if ($check_stmt->num_rows > 0) {
        $message = "Error: Product with ID '$id' already exists!";
    } else {

        $stmt = $conn->prepare("INSERT INTO products (id, product_name, price, image_path) VALUES (?, ?, ?, ?)");
        
        if ($stmt) {
            $stmt->bind_param("ssds", $id, $product_name, $price, $image_path);
            
            if ($stmt->execute()) {
                $message = "Product added successfully!";
            } else {
                $message = "Error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $message = "Error: " . $conn->error;
        }
    }
    $check_stmt->close();
}

    $stmt = mysqli_prepare($conn, "INSERT INTO products (id, product_name, price, image_path) VALUES (?, ?, ?, ?)");
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssds", $id, $product_name, $price, $image_path);
        if (mysqli_stmt_execute($stmt)) {
            $message = "Product added successfully!";
        } else {
            $message = "Error: " . mysqli_stmt_error($stmt);
        }
        mysqli_stmt_close($stmt);
    } else {
        $message = "Error: " . mysqli_error($conn);
    }

    $stmt = $conn->prepare("INSERT INTO products (id, product_name, price, image_path) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssds", $id, $product_name, $price, $image_path);

    if ($stmt->execute()) {
        $message = "Product added successfully!";
    } else {
        $message = "Error: " . $stmt->error;
    }
    $stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-kK98o7t22S5e4z9z1p1p1p1p1p1p1p1p1p1p1p1p1p1p1p1p1p1p1p1p1p1p1p1p1p1p1p1p1p1p1p1p1p1p1p1p1p1p1p1p1p1p1p1p1p1p₁" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="view_product.php">
        <img src="https://freevector-images.s3.amazonaws.com/uploads/vector/preview/36682/36682.png" alt="logo" width="34" height="28" class="d-inline-block align-text-top">View Products
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="add_product.php">Add Product</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="edit_product.php">Edit Product</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="delete_product.php">Delete Product</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<?php if ($message) { echo '<div class="container mt-3"><div class="alert alert-info" role="alert">' . htmlspecialchars($message) . '</div></div>'; } ?>
    <div class="container mt-3">
    <div class="card m-4">
            <div class="card-header bg-dark text-white">
            <h2 class="card-title">Add New Product</h2>
            </div>
            <div class="card-body bg-secondary text-white">
                <form method="POST" action="">
                <label for="product_id">Enter Product ID</label>
                <input type="text" name="product_id" id="product_id" class="form-control" required><br>
                <label for="product_name">Enter Product Name</label>    
                <input type="text" name="product_name" id="product_name" class="form-control" required><br>
                <label for="price">Enter Product Price</label>  
                <input type="number" step="10" name="price" id="price" class="form-control" required><br>
                <label for="image_path">Enter Image Path</label>
                <input type="file" class="form-control" id="image_path" name="image_path" 
                       placeholder="images/product.jpg"><br>
                <input type="file" name="image_path" id="image_path" class="form-control" required><br
                <input type="submit" value="Add Product" class="btn btn-primary">
        </form>
        </div>
        </div>
        </div>
    </div>

    
</body>
</html>