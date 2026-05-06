<?php
// quiz.php - Quiz Processing Engine
require_once 'config/app_config.php';

// Guard: must be logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

// Multidimensional array of questions with multiple choice options
$questions = [
    [
        'question' => 'What does PHP stand for?',
        'options'  => ['Private Home Page', 'PHP: Hypertext Preprocessor', 'Personal Hypertext Processor'],
        'answer'   => 'PHP: Hypertext Preprocessor'
    ],
    [
        'question' => 'Which function starts a session?',
        'options'  => ['session_start()', 'begin_session()', 'start_session()'],
        'answer'   => 'session_start()'
    ],
    [
        'question' => 'How do you define a constant?',
        'options'  => ['const()', 'define()', 'var()'],
        'answer'   => 'define()'
    ],
    [
        'question' => 'Which superglobal holds form POST data?',
        'options'  => ['$_GET', '$_REQUEST', '$_POST'],
        'answer'   => '$_POST'
    ],
    [
        'question' => 'What does HTML stand for?',
        'options'  => ['Hypertext Markup Language', 'Hypertext Machine Language', 'High Text Markup Language'],
        'answer'   => 'Hypertext Markup Language'
    ],
];

$totalQuestions = count($questions);

// Initialize session tracking if not set
if (!isset($_SESSION['soalanSemasa'])) {
    $_SESSION['soalanSemasa'] = 0;
    $_SESSION['score']        = 0;
    $_SESSION['mistakes']     = [];
}

// Process submitted answer
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currentQ    = (int) $_SESSION['soalanSemasa'];
    $userAnswer  = isset($_POST['answer']) ? htmlspecialchars($_POST['answer']) : '';
    $correctAns  = $questions[$currentQ]['answer'];

    if ($userAnswer === $correctAns) {
        $_SESSION['score']++;
    } else {
        // Track mistakes: store question text, user answer, correct answer
        $_SESSION['mistakes'][] = [
            'question'      => $questions[$currentQ]['question'],
            'user_answer'   => $userAnswer,
            'correct_answer'=> $correctAns
        ];
    }

    $_SESSION['soalanSemasa']++;

    // Move to result if all questions answered
    if ($_SESSION['soalanSemasa'] >= $totalQuestions) {
        header('Location: result.php');
        exit;
    }

    header('Location: quiz.php');
    exit;
}

$currentIndex    = (int) $_SESSION['soalanSemasa'];
$currentQuestion = $questions[$currentIndex];
$questionNumber  = $currentIndex + 1;

$pageTitle = 'Question ' . $questionNumber;
require_once 'includes/header.php';
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <!-- Progress Bar -->
            <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <span class="text-muted small">Question <?php echo $questionNumber; ?> of <?php echo $totalQuestions; ?></span>
                    <span class="badge bg-success">Score: <?php echo $_SESSION['score']; ?></span>
                </div>
                <div class="progress" style="height: 8px;">
                    <div class="progress-bar bg-primary" style="width: <?php echo ($currentIndex / $totalQuestions) * 100; ?>%"></div>
                </div>
            </div>

            <!-- Question Card -->
            <div class="card quiz-card p-4">
                <h5 class="fw-bold mb-4">
                    <span class="badge bg-dark me-2 question-badge">Q<?php echo $questionNumber; ?></span>
                    <?php echo htmlspecialchars($currentQuestion['question']); ?>
                </h5>

                <form method="POST" action="quiz.php">
                    <?php foreach ($currentQuestion['options'] as $option): ?>
                        <div class="form-check mb-3 border rounded p-3 option-label">
                            <input class="form-check-input" type="radio"
                                   name="answer" id="opt_<?php echo md5($option); ?>"
                                   value="<?php echo htmlspecialchars($option); ?>" required>
                            <label class="form-check-label w-100 option-label"
                                   for="opt_<?php echo md5($option); ?>">
                                <?php echo htmlspecialchars($option); ?>
                            </label>
                        </div>
                    <?php endforeach; ?>

                    <div class="d-grid mt-3">
                        <button type="submit" class="btn btn-primary btn-lg">Next Question &raquo;</button>
                    </div>
                </form>
            </div>

            <!-- User info -->
            <p class="text-center text-muted mt-3 small">
                Logged in as: <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>
            </p>

        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
