<?php
$loggedIn = isset($_SESSION['username']);
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo isset($pageTitle) ? $pageTitle : APP_NAME; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark p-3 mb-4">
        <a class="navbar-brand text-white" href="login.php">Home</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <?php if($loggedIn): ?>
                <a class="nav-link text-white" href="quiz.php">Quiz</a>
                <a class="nav-link text-white" href="logout.php">Logout</a>
            <?php else: ?>
                <a class="nav-link text-white" href="login.php">Login</a>
            <?php endif; ?>
        </div>
    </nav>
</header>
<main>
