<?php
require_once "config/db.php";
$message = "";
$messageType = "";
$product_to_delete = null;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["confirm_delete"])) {
    $id = $_POST["id"];
    
    $sql = "DELETE FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        $message = "Product deleted successfully!";
        $messageType = "success";
        $product_to_delete = null; 
    } else {
        $message = "Error: " . $stmt->error;
        $messageType = "danger";
    }
    $stmt->close();
}

if (isset($_GET['id']) && !empty($_GET['id']) && !isset($_POST['confirm_delete'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product_to_delete = $result->fetch_assoc();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <title>Delete Product</title>
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
          <a class="nav-link" href="edit_product.php">Edit Product</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="delete_product.php">Delete Product</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-4">
    <h1 class="mb-4">Delete Product</h1>
    
    <?php if ($message): ?>
        <div class="alert alert-<?php echo $messageType; ?> alert-dismissible fade show" role="alert">
            <?php echo $message; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    
    <!-- Search form to find product -->
    <?php if (!$product_to_delete && !isset($_POST['confirm_delete'])): ?>
    <div class="card mb-4">
        <div class="card-header bg-danger text-white">
            <h5 class="mb-0">Find Product to Delete</h5>
        </div>
        <div class="card-body bg-dark text-white">
            <form method="GET" action="">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="id" class="form-label">Enter Product ID</label>
                        <input type="number" class="form-control" id="id" name="id" required placeholder="e.g., 1">
                    </div>
                    <div class="col-md-6 d-flex align-items-end">
                        <button type="submit" class="btn btn-danger">Search Product</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- Confirmation form -->
    <?php if ($product_to_delete): ?>
    <div class="card border-danger">
        <div class="card-header bg-danger text-white">
            <h5 class="mb-0">⚠️ Confirm Deletion</h5>
        </div>
        <div class="card-body">
            <div class="alert alert-warning">
                <strong>Warning!</strong> Are you sure you want to delete this product? This action cannot be undone.
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 150px;">Product ID:</th>
                            <td><?php echo $product_to_delete['id']; ?></td>
                        </tr>
                        <tr>
                            <th>Product Name:</th>
                            <td><strong><?php echo htmlspecialchars($product_to_delete['product_name']); ?></strong></td>
                        </tr>
                        <tr>
                            <th>Price:</th>
                            <td>$<?php echo number_format($product_to_delete['price'], 2); ?></td>
                        </tr>
                        <?php if (!empty($product_to_delete['description'])): ?>
                        <tr>
                            <th>Description:</th>
                            <td><?php echo htmlspecialchars(substr($product_to_delete['description'], 0, 100)); ?></td>
                        </tr>
                        <?php endif; ?>
                        <tr>
                            <th>Image:</th>
                            <td>
                                <?php if (!empty($product_to_delete['image_path'])): ?>
                                    <img src="<?php echo htmlspecialchars($product_to_delete['image_path']); ?>" 
                                         alt="Product image" 
                                         style="max-width: 100px; max-height: 100px;"
                                         onerror="this.onerror=null; this.src='https://via.placeholder.com/100?text=No+Image';">
                                <?php else: ?>
                                    No image
                                <?php endif; ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <form method="POST" action="" onsubmit="return confirm('Are you absolutely sure you want to delete this product? This action cannot be undone!');">
                <input type="hidden" name="id" value="<?php echo $product_to_delete['id']; ?>">
                
                <div class="d-flex gap-2">
                    <button type="submit" name="confirm_delete" class="btn btn-danger">Yes, Delete Product</button>
                    <a href="delete_product.php" class="btn btn-secondary">Cancel</a>
                    <a href="view_product.php" class="btn btn-info">View All Products</a>
                </div>
            </form>
        </div>
    </div>
    <?php elseif (isset($_GET['id']) && !$product_to_delete && !isset($_POST['confirm_delete'])): ?>
    <div class="alert alert-warning">
        <strong>Warning!</strong> No product found with ID: <?php echo htmlspecialchars($_GET['id']); ?>
        <br><br>
        <a href="delete_product.php" class="btn btn-primary btn-sm">Try Again</a>
    </div>
    <?php endif; ?>
    
    <!-- Quick product list -->
    <div class="card mt-4">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">Product Reference List</h5>
        </div>
        <div class="card-body" style="max-height: 300px; overflow-y: auto;">
            <table class="table table-sm table-striped">
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
                            echo "<td><a href='delete_product.php?id=" . $row['id'] . "' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure you want to delete " . htmlspecialchars($row['product_name']) . "?\")'>Delete</a></td>";
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