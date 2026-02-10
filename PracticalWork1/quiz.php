<?php
require_once 'config/app_config.php';
require_once 'includes/header.php';
if(!isset($_SESSION['username'])){

}
?>
User: <?php echo htmlspecialchars($_SESSION['username']); ?><br>
Score: <?php $_SESSION['score'];?> 

<?php
require_once 'includes/footer.php';
?>