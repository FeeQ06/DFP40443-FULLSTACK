<?php
require_once "config/db.php";
$message = "";
$messageType = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_product"])) {
    $id = $_POST["id"];
    $product_name = $_POST["product_name"];
    $price = $_POST["price"];
    $image_path = $_POST["image_path"];
    $description = $_POST["description"] ?? "";
    
    $sql = "UPDATE products SET product_name=?, price=?, image_path=?, description=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdssi", $product_name, $price, $image_path, $description, $id);
    
    if ($stmt->execute()) {
        $message = "Product updated successfully!";
        $messageType = "success";
    } else {
        $message = "Error: " . $stmt->error;
        $messageType = "danger";
    }
    $stmt->close();
}

$product = null;
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <title>Edit Product</title>
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
          <a class="nav-link" href="add_product.php">Add Product</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="edit_product.php">Edit Product</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="delete_product.php">Delete Product</a>
        </li>
      </ul>
    </div>
  </div>
</nav>  

<div class="container mt-4">
    <h1 class="mb-4">Edit Product</h1>
    
    <?php if ($message): ?>
        <div class="alert alert-<?php echo $messageType; ?> alert-dismissible fade show" role="alert">
            <?php echo $message; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    
    <!-- Search form to find product -->
    <?php if (!$product && !isset($_POST['update_product'])): ?>
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Find Product to Edit</h5>
        </div>
        <div class="card-body bg-dark text-black">
            <form method="GET" action="">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="id" class="form-label text-white">Enter Product ID</label>
                        <input type="number" class="form-control" id="id" name="id" required placeholder="e.g., 1">
                    </div>
                    <div class="col-md-6 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary">Search Product</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- Edit form -->
    <?php if ($product): ?>
    <div class="card">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Edit Product #<?php echo $product['id']; ?></h5>
        </div>
        <div class="card-body bg-secondary text-white">
            <form method="POST" action="">
                <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                
                <div class="mb-3">
                    <label for="product_name" class="form-label">Product Name *</label>
                    <input type="text" class="form-control" id="product_name" name="product_name" 
                           value="<?php echo htmlspecialchars($product['product_name']); ?>" required>
                </div>
                
                <div class="mb-3">
                    <label for="price" class="form-label">Price ($) *</label>
                    <input type="number" step="0.01" class="form-control" id="price" name="price" 
                           value="<?php echo $product['price']; ?>" required>
                </div>
                
                <div class="mb-3">
                    <label for="image_path" class="form-label">Image URL</label>
                    <input type="text" class="form-control" id="image_path" name="image_path" 
                           value="<?php echo htmlspecialchars($product['image_path'] ?? ''); ?>"
                           placeholder="https://example.com/image.jpg">
                    <small class="form-text text-muted">Enter a full URL or relative path to the product image</small>
                </div>
                
                <?php if (!empty($product['image_path'])): ?>
                <div class="mb-3">
                    <label class="form-label">Current Image Preview</label><br>
                    <img src="<?php echo htmlspecialchars($product['image_path']); ?>" 
                         alt="Current product image" 
                         style="max-width: 150px; max-height: 150px; border-radius: 5px;"
                         onerror="this.onerror=null; this.src='https://via.placeholder.com/150?text=Image+Not+Found';">
                </div>
                <?php endif; ?>
                
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="4" 
                              placeholder="Enter product description"><?php echo htmlspecialchars($product['description'] ?? ''); ?></textarea>
                </div>
                
                <div class="d-flex gap-2">
                    <button type="submit" name="update_product" class="btn btn-success">Update Product</button>
                    <a href="view_product.php" class="btn btn-secondary">Cancel</a>
                    <a href="edit_product.php" class="btn btn-info">Edit Another Product</a>
                </div>
            </form>
        </div>
    </div>
    <?php elseif (isset($_GET['id']) && !$product): ?>
    <div class="alert alert-warning">
        <strong>Warning!</strong> No product found with ID: <?php echo htmlspecialchars($_GET['id']); ?>
        <br><br>
        <a href="edit_product.php" class="btn btn-primary btn-sm">Try Again</a>
    </div>
    <?php endif; ?>

    <div class="card mt-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Product Reference List</h5>
        </div>
        <div class="card-body" style="max-height: 300px; overflow-y: auto;">
            <table class="table table-sm table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT id, product_name, price FROM products ORDER BY id";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . htmlspecialchars($row['product_name']) . "</td>";
                            echo "<td>$" . number_format($row['price'], 2) . "</td>";
                            echo "<td><a href='edit_product.php?id=" . $row['id'] . "' class='btn btn-sm btn-primary'>Edit</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4' class='text-center'>No products found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>