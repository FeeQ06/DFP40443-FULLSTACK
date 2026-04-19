<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
=======
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
>>>>>>> 57a41fadeb8cc6bfcc12c3d0a50a21b37d55009d
    <title>E-Commerce Shop</title>
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
<<<<<<< HEAD
          <a class="nav-link" href="add_product.php">Add Product</a>
=======
          <a class="nav-link active" aria-current="page" href="add_product.php">Add Product</a>
>>>>>>> 57a41fadeb8cc6bfcc12c3d0a50a21b37d55009d
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

<<<<<<< HEAD
<div class="container mt-3">
    <h1>Product List</h1>
    
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'config/db.php';

            $sql = "SELECT * FROM products";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . ($row["id"] ?? $row["product_id"] ?? 'N/A') . "</td>";
                    echo "<td>" . ($row["product_name"] ?? $row["name"] ?? 'No name') . "</td>";
                    echo "<td>$" . number_format($row["price"] ?? 0, 2) . "</td>";
                    echo "<td>";
                    if (!empty($row["image_path"])) {
                        echo "<img src='" . htmlspecialchars($row["image_path"]) . "' width='80' height='80' alt='Product image' style='border-radius: 5px;' onerror=\"this.onerror=null; this.src='https://via.placeholder.com/80?text=No+Image';\">";
                    } else {
                        echo "No image";
                    }
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4' class='text-center'>No products found.</td></tr>";
            }

            mysqli_close($conn);
            ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
=======
    <div class="container mt-3">
        <h1>Product List</h1>
        
        <ul>
            <?php
            include 'config/db.php';

        $sql = "SELECT * FROM products";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<li>" . $row["name"] . " - $" . $row["price"] . "</li>";
            }
        } else {
            echo "No products found.";
        }

        mysqli_close($conn);
        ?>
    </ul>
    </div>
    
>>>>>>> 57a41fadeb8cc6bfcc12c3d0a50a21b37d55009d
</body>
</html>