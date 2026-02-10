<?php
// login.php - Entry point for the quiz system
require_once 'config/app_config.php';
$error='';
if($_SERVER['REQUEST_METHOD'] ==='POST'){
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    if(isset($users[$username]) && $users[$username] === $password){
        //sekiranya benar
        $_SESSION['username'] = $username;
        $_SESSION['score'] = 0;
        $_SESSION['soalanSemasa'] = 0;
        
        header('Location: quiz.php');
    } else {
        //sekiranya tidak benar
        $error="Invalid Username or Password";
    }
}


$pageTitle = 'Login';
require_once 'includes/header.php';
?>
    <div class="container mt-5">
    <h1 class="text-center">PHP Knowledge Questions</h1>
    <p>Answer ALL questions.</p>
    <p>Enter your name to begin</p>
        <?php if ($error): ?>
            <?php echo $error ?>
         <?php endif; ?>
    <form method="POST" action="login.php">
        Your Name:

         <input type="text" name="username" required>   
          <input type="password"  name="password" required>       
         <input type="submit" value="Start Quiz">     
        </form>  </div>
<?php require_once 'includes/footer.php'; ?>      