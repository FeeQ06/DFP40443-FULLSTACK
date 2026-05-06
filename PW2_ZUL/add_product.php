<?php
require_once "includes/header.php";
?>

<?php
include 'db.php';

$message = '';
$messageClass = '';

function sanitize ($data){
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = sanitize($_POST['id']);
    $product_name = sanitize($_POST['product_name']);
    $price = sanitize($_POST['price']);

    if($price <=0){
        echo "Price must be a positive number.";
        exit;
    }
    
$image_path='';
if(isset($_FILES['image'])&& $_FILES['image']['error']==0){
    $allowed_types = ['image/jpeg','image/png','image/gif'];
    $max_size = 2 * 1024 *1024; //2mb
    $file_type=$_FILES['image']['type'];
    $file_size=$_FILES['image']['size'];
}

if(!in_array($file_type,$allowed_types)){
    echo "Only JPG,PNG and GIF files are allowed.";
    exit;
}

if($file_size>$max_size){
    echo "File size exceeds the maximum limit of 2MB";
    exit;
}

    $target_dir = "uploads/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $image_path = "";
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        $image_path = $target_file;
    } else {
        echo "Error uploading image.";
        exit;
    }

    if (!isset($conn) || $conn->connect_error) {
        echo "Database connection error.";
        exit;
    }
    
    $stmt = $conn->prepare("INSERT INTO products (id, product_name, price, image_path) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssds", $id, $product_name, $price, $image_path);
    
    if ($stmt->execute()) {
        $message = "Product added successfully!";
        $messageClass = "alert alert-success";
    } else {
        $message = "Error: " . $stmt->error;
        $messageClass = "alert alert-danger";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</head>
<body>
    <h1 class="text-center">Add Product</h1>
    <form action="" method="POST" enctype="multipart/form-data" class=" container card bg-dark text-white p-4" onsubmit="return validateForm()">

        <label for="id">Product ID:</label>
        <input class="form-control" type="text" id="id" name="id" required><br><br>

        <label for="product_name">Product Name:</label>
        <input class="form-control" type="text" id="product_name" name="product_name" required><br><br>

        <label for="price">Price:</label>
        <input class="form-control" type="number" id="price" name="price" step="0.01" required><br><br>

        <label for="image">Image:</label>
        <input type="file" id="image" name="image" accept="image/*" required><br><br>

        <input class="btn btn-secondary" type="submit" value="Add Product">
    </form>

    <?php if (!empty($message)): ?>
        <div class="<?php echo $messageClass; ?> container mt-3" role="alert">
            <?php echo htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>

    <script>
        function validateForm() {
            const id = document.getElementById('id').value.trim();
            const productName = document.getElementById('product_name').value.trim();
            const price = parseFloat(document.getElementById('price').value);
            const imageInput = document.getElementById('image');
            const imageFile = imageInput.files[0];

            if (id === '') {
                alert('Product ID is required.');
                return false;
            }

            if (productName === '') {
                alert('Product Name is required.');
                return false;
            }

            if (isNaN(price) || price <= 0) {
                alert('Price must be a positive number.');
                return false;
            }

            if (!imageFile) {
                alert('Please select an image.');
                return false;
            }

            const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (!allowedTypes.includes(imageFile.type)) {
                alert('Only JPG, PNG, and GIF files are allowed.');
                return false;
            }

            const maxSize = 2 * 1024 * 1024; // 2MB
            if (imageFile.size > maxSize) {
                alert('File size exceeds the maximum limit of 2MB.');
                return false;
            }

            return true;
        }
    </script>

</body>
</html>
