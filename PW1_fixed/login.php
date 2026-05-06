<?php
// login.php - Entry point and Login & Initialization
require_once 'config/app_config.php';

// If already logged in, go to quiz
if (isset($_SESSION['username'])) {
    header('Location: quiz.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars(trim($_POST['username']));
    $password = htmlspecialchars(trim($_POST['password']));

    if (isset($users[$username]) && $users[$username] === $password) {
        // Initialize session variables
        $_SESSION['username']     = $username;
        $_SESSION['score']        = 0;
        $_SESSION['soalanSemasa'] = 0;
        $_SESSION['mistakes']     = []; // track wrong answers

        header('Location: quiz.php');
        exit;
    } else {
        $error = 'Invalid username or password. Please try again.';
    }
}

$pageTitle = 'Login';
require_once 'includes/header.php';
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card quiz-card p-4">
                <h2 class="text-center mb-1"><?php echo APP_NAME; ?></h2>
                <p class="text-center text-muted mb-4">Answer ALL questions.</p>

                <?php if ($error): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>

                <form method="POST" action="login.php">
                    <div class="mb-3">
                        <label for="username" class="form-label fw-semibold">Username</label>
                        <input type="text" class="form-control" id="username" name="username"
                               placeholder="Enter your username" required
                               value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                               placeholder="Enter your password" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">Start Quiz</button>
                    </div>
                </form>

                <div class="mt-3 p-2 bg-light rounded small text-muted">
                    <strong>Demo credentials:</strong><br>
                    Username: <code>student1</code> &nbsp; Password: <code>pass123</code>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
