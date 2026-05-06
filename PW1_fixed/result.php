<?php
// result.php - Result & Review Module
require_once 'config/app_config.php';

// Guard: must be logged in and quiz must be completed
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$username  = htmlspecialchars($_SESSION['username']);
$score     = isset($_SESSION['score']) ? (int) $_SESSION['score'] : 0;
$mistakes  = isset($_SESSION['mistakes']) ? $_SESSION['mistakes'] : [];

// Total questions (must match quiz.php)
$totalQuestions = 5;

$pageTitle = 'Quiz Result';
require_once 'includes/header.php';
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">

            <!-- Result Card -->
            <div class="card quiz-card p-4 text-center mb-4">
                <div class="alert alert-dark mb-3">
                    <strong>Quiz Complete!</strong>
                </div>
                <h4>Student: <span class="text-primary"><?php echo $username; ?></span></h4>
                <h5 class="mt-2">Final Score:
                    <span class="badge <?php echo ($score >= $totalQuestions / 2) ? 'bg-success' : 'bg-danger'; ?> fs-5">
                        <?php echo $score; ?> / <?php echo $totalQuestions; ?>
                    </span>
                </h5>

                <!-- Score progress bar -->
                <div class="progress mt-3" style="height: 12px;">
                    <div class="progress-bar <?php echo ($score >= $totalQuestions / 2) ? 'bg-success' : 'bg-danger'; ?>"
                         style="width: <?php echo ($score / $totalQuestions) * 100; ?>%"></div>
                </div>
            </div>

            <!-- Mistake Review Table -->
            <?php if (!empty($mistakes)): ?>
                <div class="card quiz-card p-4 mb-4">
                    <h5 class="fw-bold mb-3">Review Incorrect Answers:</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>Question</th>
                                    <th>Your Answer</th>
                                    <th>Correct Answer</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($mistakes as $mistake): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($mistake['question']); ?></td>
                                        <td class="text-danger"><?php echo htmlspecialchars($mistake['user_answer']); ?></td>
                                        <td class="text-success"><?php echo htmlspecialchars($mistake['correct_answer']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php else: ?>
                <div class="alert alert-success text-center">
                    🎉 Perfect score! No mistakes made.
                </div>
            <?php endif; ?>

            <!-- Restart Button - destroys session -->
            <div class="text-center">
                <a href="logout.php?restart=1" class="btn btn-warning btn-lg">Restart Quiz</a>
                <a href="logout.php" class="btn btn-secondary btn-lg ms-2">Logout</a>
            </div>

        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
