<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
<h3>RPI Alumni Login/SignUp Page</h3>
<?php include 'includes/header.php' ?>

<hr>
<label>Email</label>
<input type="email" name="email" id="email" required>
<br>
<label>Password</label>
<input type="password" name="password" id="password">
<br>
<br>
<input type="submit" value="Log In">

<?php include 'includes/footer.php' ?>
</form>
