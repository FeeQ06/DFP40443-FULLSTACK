<?php
// login.php
session_start();
require_once 'config/config.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    if (empty($username) || empty($password)) {
        echo "<script>alert('Please fill in both Username and Password before logging in.');</script>";
    } else {
        // Prepared statement - secure against SQL injection
        $stmt = $conn->prepare("SELECT id, username, password, role FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id']   = $user['id'];
            $_SESSION['username']  = $user['username'];
            $_SESSION['role']      = $user['role'];
            session_regenerate_id(true);
            header("Location: dashboard.php");
            exit;
        } else {
            $error = 'Invalid username or password.';
        }
    }
}

// Redirect if already logged in
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <title>Login Page</title>
</head>
<body>


<?php if ($error): ?>
<div class="alert alert-danger d-flex align-items-center gap-2">
<i class="bi bi-exclamation-triangle-fill"></i> <?= htmlspecialchars($error) ?>
</div>
<?php endif; ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-5">
                    <div class="card-body">
                        <h2 class="card-title mb-4">PMU Student Management System</h2>     
                           
    <form action="dashboard.php" method="POST">
        <h5>Login / SignUp Page</h5>
        <br>
        <label for="username">Username</label>
        <input type="text" name="username">
        <br><br>

        <label for="username">Password</label>
        <input type="password" name="password">
        <br><br>

        <input type="submit" value="Login" class="btn btn-primary btn-rounded">
        <input type="clear" value="Reset" class="btn btn-secondary btn-rounded">

    </form>
                    </div>
                </div>
            </div>
        </div>
    
</body>
</html>