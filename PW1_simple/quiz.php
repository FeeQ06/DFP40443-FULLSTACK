<?php
require_once 'config/app_config.php';

// Guard: redirect to login if not logged in
if(!isset($_SESSION['username'])){
    header('Location: login.php');
    exit;
}

// Multidimensional array with options and answer
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

if(!isset($_SESSION['soalanSemasa'])){
    $_SESSION['soalanSemasa'] = 0;
    $_SESSION['score'] = 0;
    $_SESSION['mistakes'] = [];
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $userAnswer = htmlspecialchars($_POST['answer']);
    $currentQ = $_SESSION['soalanSemasa'];

    $correctAnswer = $questions[$currentQ]['answer'];

    if($userAnswer === $correctAnswer){
        $_SESSION['score']++;
    } else {
        // Store mistake for review
        $_SESSION['mistakes'][] = [
            'question'       => $questions[$currentQ]['question'],
            'user_answer'    => $userAnswer,
            'correct_answer' => $correctAnswer
        ];
    }

    $_SESSION['soalanSemasa']++;

    if($_SESSION['soalanSemasa'] >= count($questions)){
        header('Location: result.php');
        exit;
    }

    header('Location: quiz.php');
    exit;
}

$currentIndex = $_SESSION['soalanSemasa'];
$currentQuestion = $questions[$currentIndex];

$pageTitle = 'Quiz';
require_once 'includes/header.php';
?>

<div class="container mt-5">
    User: <?php echo htmlspecialchars($_SESSION['username']); ?><br>
    Score: <?php echo $_SESSION['score']; ?><br>
    Question: <?php echo $currentIndex + 1; ?> of <?php echo count($questions); ?>
    <br><br>

    <h5>Question <?php echo $currentIndex + 1; ?>:</h5>
    <p><?php echo htmlspecialchars($currentQuestion['question']); ?></p>

    <form action="quiz.php" method="POST">
        <?php foreach($currentQuestion['options'] as $option): ?>
            <div>
                <input type="radio" name="answer" value="<?php echo htmlspecialchars($option); ?>" required>
                <?php echo htmlspecialchars($option); ?>
            </div>
        <?php endforeach; ?>
        <br>
        <input type="submit" value="Next Question" class="btn btn-primary">
    </form>
</div>

<?php require_once 'includes/footer.php'; ?>
