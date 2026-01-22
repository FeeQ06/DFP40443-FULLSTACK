<!DOCTYPE html>
<html>

<head>
    <title>KELVIN TO CELCIUS CALCULATOR</title>
</head>

<body>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label>Kelvin</label>
    <input name="kelVal" type="number">K
    <input type="submit" value="Calculate">
    
</form>   
</body>

<?php
$result = null;
if($_SERVER["REQUEST_METHOD"] == "POST"){
$kelvin = $_POST['kelVal'];
$result = $kelvin - 273.15;

if($result < 30){
    echo "cold";
    elseif ($result > 30)
        echo "mild";
        else ($result)
        echo "hot";
}
}
?>
<?php
echo $result;
?>

</html>