<?php
require_once 'config/app_config.php';
require_once 'includes/header.php';

// Guard: redirect to login if not logged in
if(!isset($_SESSION['username'])){
    header('Location: login.php');
    exit;
}

$username = htmlspecialchars($_SESSION['username']);
$score    = $_SESSION['score'];
$mistakes = $_SESSION['mistakes'];
?>

<div class="container mt-5">
    <div class="alert alert-dark"><strong>Quiz Complete!</strong></div>

    <p>Student: <?php echo $username; ?></p>
    <p>Final Score: <?php echo $score; ?></p>

    <?php if(!empty($mistakes)): ?>
        <h5>Review Incorrect Answers:</h5>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Question</th>
                    <th>Your Answer</th>
                    <th>Correct Answer</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($mistakes as $mistake): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($mistake['question']); ?></td>
                        <td><?php echo htmlspecialchars($mistake['user_answer']); ?></td>
                        <td><?php echo htmlspecialchars($mistake['correct_answer']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <a href="logout.php" class="btn btn-warning">Restart Quiz</a>
</div>

<?php require_once 'includes/footer.php'; ?>
