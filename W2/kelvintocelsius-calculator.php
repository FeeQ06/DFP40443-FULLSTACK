<!DOCTYPE html>
<html>

<head>
    <title>KELVIN TO CELCIUS CALCULATOR</title>
</head>

<body>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label>Kelvin</label>
    <input name="kelVal" type="number">
    <input type="submit" value="Calculate">
    
</form>   
</body>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
$kelvin = $_POST['kelVal'];

$celcius = $kelvin - 273.15;
}
?>

<?php
echo $celcius;
?>

</html>