<?php
session_start();
include 'db.php';

if(!isset($_SESSION['admin_logged_in'])){
    header("Location: login.php");
    exit();
}

$id=$_GET['id'] ?? null;
$make=$model=$year=$price=$image=$error="";

if($id){
    $stmt=mysqli_prepare($conn, "SELECT * FROM vehicles WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_assoc($result)){
        $make=$row['make'];
        $model=$row['model'];
        $year=$row['year'];
        $price=$row['price'];
        $image=$row['image_path'];
    }
        mysqli_stmt_close($stmt);
}
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $id=$_POST['id'];
    $make=htmlspecialchars(trim($_POST['make']));
    $model=htmlspecialchars(trim($_POST['model']));
    $make=trim($_POST['year']);
    $make=trim($_POST['price']);
    $new_image=$image;

    //file uploading
    if(isset($_FILES['image']) && $_FILES['image']['error']==0){
        if(in_array($ext, ['jpg', 'png', 'jpeg', 'webp'])){
            if(!is_dir('uploads')) mkdir('uploads', 0777, true);
            $new_image="uploads/veh" .time()."ext";
            move_uploaded_file($_FILES['image']['tap_name'], $new_image);

            if($id && file_exists){
                
            }
            
        }
    }
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
    
    <div class="container mt-5 w-50">

    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h4 class="mb-1"><?=$id ? "Edit": "Add"?>Vehicle</h4>
        </div>
        <div class="card-body">
            <?php if ($error) echo "<div class='alert-danger'>$error</div>";?>
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?=htmlspecialchars($id)?>">
                <div class="mb-3">
                    <label for="">Make:</label>
                    <input type="text" name="make" class="form-control" 
                    required value="<?=htmlspecialchars($make)?>"></div>

                <div class="mb-3">
                    <label for="">Model:</label>
                    <input type="text" name="make" class="form-control" 
                    required value="<?=htmlspecialchars($model)?>"></div>

                <div class="mb-3">
                    <label for="">Year:</label>
                    <input type="text" name="make" class="form-control" 
                    required value="<?=htmlspecialchars($year)?>"></div>

                <div class="mb-3">
                    <label for="">Price:</label>
                    <input type="text" name="make" class="form-control" 
                    required value="<?=htmlspecialchars($price)?>"></div>

                    <?php if($image):?><img src = "<?htmmlspecialchars($image)?>" width="120"
                        class="mb-2 d-block rounded-border"><?php endif;?>
                        <div class="mb-4"><label>Vehicle Image</label>
                        <input type="file" name="image" class="form-control" <?=$id ?"": "required"?>></div> 
                        <button type="submit" class="btn btn-primary w-100">Save Vehicle</button>
                        <a href="index.php" class="btn btn-secondary w-100 mt-2">Cancel</a>
                    </form>
        </div>
    </div>
</body>
</html>