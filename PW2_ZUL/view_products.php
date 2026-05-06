<?php
require_once "includes/header.php";
?>

<?php
include 'db.php';

$sql = "SELECT id, product_name, price, image_path FROM products";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</head>
<body>

<div class="container mt-3">
<div class="card shadow">
    <div class="rounded-3 overflow-hidden border-0">
    <div class="card-header bg-secondary">
    <h2 class="text-center text-white">Product List</h2>
</div>

<div class="card-body">
    <table class="table table-striped table-dark table-hover table-rounded">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price (RM) </th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                        <td>RM <?php echo htmlspecialchars($row['price']);?></td>
                        <td>
                            <?php if (!empty($row['image_path'])): ?>
                                <?php
                                $imagePath = trim($row['image_path']);
                                if (!preg_match('#^(https?://|/|uploads/)#i', $imagePath)) {
                                    $imagePath = 'uploads/' . ltrim($imagePath, '/');
                                }
                                $imageSrc = htmlspecialchars($imagePath, ENT_QUOTES, 'UTF-8');
                                ?>
                                <img src="<?php echo $imageSrc; ?>" alt="Product Image" style="width: 80px; height: auto;">
                            <?php else: ?>
                                <span class="text-muted">No image</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="edit_product.php?id=<?php echo urlencode($row['id']); ?>">Edit</a>
                            <a class="btn btn-danger btn-sm" href="delete_product.php?id=<?php echo urlencode($row['id']); ?>" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">No products found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
            </div>
            </div>
            </div>
            </div>

</body>
</html>