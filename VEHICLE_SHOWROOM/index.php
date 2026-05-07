<?php
include 'db.php';
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$search_query = "";
$sql = "SELECT * FROM vehicles ORDER BY id DESC";

if (isset($_GET['q']) && trim($_GET['q']) !== "") {
    $search_query = trim($_GET['q']);
    $like_param = "%" . $search_query . "%";
    $sql = "SELECT * FROM vehicles WHERE make LIKE ? OR model LIKE ? ORDER BY id DESC";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $like_param, $like_param);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
} else {
    $result = mysqli_query($conn, $sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <title>Vehicle Showroom Inventory</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-dark p-3 mb-4">
        <a class="navbar-brand text-white nav-link" href="login.php">Vehicle Showroom Inventory</a>
        <div class="collapse navbar-collapse">
        <a href="logout.php" class="nav-link text-white text-right ms-auto">Logout</a>
        </div>
    </nav>
    
    <div class="container mt-5">
    <div class="d-flex justify-content-between mb-3">
    <h2>Showroom Inventory</h2>
    <div>
        <a href="form.php" class="btn btn-success m-2">Add Vehicle</a>
        <a href="logout.php" class="btn btn-secondary float-end m-2">Logout</a>
    </div>
    </div>

    <div class="container mt-5">
    <!--Search Function above-->
    <form method="GET" action="index.php" class="mb-4">
    <input type="text" name="q" class="form-control" placeholder="Search by make or model"
            value="<?=htmlspecialchars($search_query)?>">
    <a href="index.php" type="submit" class="btn btn-outline-secondary mt-2">Search</a>
    </form>

    <table class="table shadow table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>Image</th>
                <th>Make</th>
                <th>Model</th>
                <th>Year</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
             <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><img src="<?= htmlspecialchars($row['image_path']) ?>" width="100" class="rounded"></td>
                    <td><?= htmlspecialchars($row['make']) ?></td>
                    <td><?= htmlspecialchars($row['model']) ?></td>
                    <td><?= htmlspecialchars($row['year']) ?></td>
                    <td><?= htmlspecialchars($row['price']) ?></td>
                    <td>
                        <a href="form.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                        <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger"
                           onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="6" class="text-center">No vehicles found</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
    </div>
    </div>

    
</body>
</html>