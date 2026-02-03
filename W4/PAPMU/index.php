<?php
$config = include('config/app_config.php');
require_once('includes/alumni_logic.php');

$isLoggedIn=false;
if($_SERVER['REQUEST_METHOD']=='POST'){
    try{
    $user = $_POST['username'];
    $pass = $_POST['password'];

    if($user !== $config['admin_user'] || $pass !== $config['admin_pass']){
        //pengguna x sah

    } $isLoggedIn = true;
    } catch (Exception $e){
        
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $config['site_name']; ?></title>
</head>
<body style="background-color: #a4edff; <?php echo $config['theme_color']; ?>">
    <header>
        <nav>
            <ul style='display:flex;list-style-type: style none;'>
            <?php echo generateMenu($pages); ?>
            </ul>
        </nav>
    </header>
    
    <?php if($isLoggedIn): ?>
    <p>Welcome <?php echo $_POST['username']; ?></p>
    <?php endif; ?>   

<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
<footer>
</footer>
    
</body>
</html>