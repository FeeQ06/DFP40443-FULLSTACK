<?php
require_once "includes/header.php";
?>

<?php
require_once("config/app_config.php");
$sqlPeranan = "SELECT * FROM roles";
$HasilSQLPeranan = mysqli_query($conn, $sqlPeranan);

$mesej="";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $id = $_POST["id"];
    $namapengguna = $_POST["username"];
    $katalaluan = $_POST["password"];
    $email = $_POST["email"];
    $peranan = $_POST["peranan_id"];

    $arahanSQL = mysqli_prepare($conn, "INSERT INTO users (id, username, password, email, role_id) VALUES (?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($arahanSQL, "isssi",$id, $namapengguna, $katalaluan, $email, $peranan);
    if (mysqli_stmt_execute($arahanSQL)) {
        $mesej = "<p style='color:green;'>Data berjaya dimasukkan.</p>";
    } else {
        $mesej = "<p style='color:red;'>Data tidak berjaya dimasukkan.</p>" . mysqli_stmt_error($sqlPeranan);
    }
    $HasilSQLPeranan = mysqli_query($conn, $sqlPeranan);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <title>PMU SPMP</title>
</head>
<body>
    <div class="container mt-3">
    <?php echo $mesej; ?>
    <h2>Enter New User</h2>
    <form method="POST" action="">
        ID: <input type="text" name="id"> <br><br>
        Username <input type="text" name="username"> <br><br>
        Password <input type="password" name="password"> <br><br>
        Email <input type="email" name="email"> <br><br>
        <label for="peranan_id">Select role:</label>
        <select name="peranan_id">
            <option value="">--Choose Your Role--</option>
            <?php while($row = mysqli_fetch_assoc($HasilSQLPeranan)): ?>
                <option value="<?php echo $row['id']; ?>">
                    <?php echo $row['name'];?>
                </option>
            <?php endwhile; ?>
        </select>
        <input type="submit" value="Key-in Data">
    </form>
    </div>



<?php
require_once "includes/footer.php";
?>

</body>
</html>