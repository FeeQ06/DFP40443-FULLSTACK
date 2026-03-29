<?php
require_once("config/app_config.php");
$maklumat = mysqli_query($conn,"SELECT users.id, username as pengguna, email, password, name as peranan FROM spmp.users join roles on users.role_id = roles.id;") or die(mysqli_error($conn));  
$mesej = "";

if ($_SERVER["REQUEST_METHOD"]=="POST"){

    $userid = $_POST["user_id"];

    $stmt = mysqli_prepare($conn, "DELETE FROM users WHERE role_id=?");
    mysqli_stmt_bind_param($stmt, "i", $userid);

    if(mysqli_stmt_execute($stmt)) {
        $mesej = "<p style='color:green'>User deleted successfully.</p>";
    } else {
        $mesej = "<p style='color:red'>Error deleting user</p>";
    }
}
?>

<?php
require_once "includes/header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <?php echo $mesej; ?>
    <div class="container mt-3 text-center">
        <h2 class="mb-3 mt-5">Delete User</h2>
        <table class="table table-dark table-striped table-bordered">
            <tr>
                <th>Id</th>
                <th>Nama Pengguna</th>
                <th>Peranan</th>
                <th>Tindakan</th>
            </tr>
            <?php while ($pengguna = mysqli_fetch_assoc($maklumat)): ?>
            <tr>
                <td><?php echo $pengguna['id'] ?></td>
                <td><?php echo $pengguna['pengguna'] ?></td>
                <td><?php echo $pengguna['peranan'] ?></td>
                <td>
                    <form action="" method="POST">
                        <input type="hidden" name="user_id" value="<?php echo $pengguna['id']; ?>">
                        <input type="submit" value="DELETE" class="btn btn-outline-danger">
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
        </table>
    </div>

    <?php
require_once "includes/footer.php";
?>
</body>
</html>