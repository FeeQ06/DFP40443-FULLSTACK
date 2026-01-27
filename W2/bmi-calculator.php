<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMI Calculator</title>
</head>
<body>
    <h2>BMI CALCULATOR</h2>
    
</html>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label>Height (cm): </label>
    <input name="heightVal" type="number" required>

    <label>Weight (kg): </label>
    <input name="weightVal" type="number" required>

    <input type="submit" value="Calculate">
</form>   


<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
$height = $_POST['heightVal'];
$weight = $_POST['weightVal'];

$bmi = $weight/(($height/100) * ($height/100));
$bmi = round($bmi, 1);

$category = "";

if ($bmi < 18.5){
    $category="Underweight";
}
elseif ($bmi >= 18.5 && $bmi <= 24.9){
    $category="Normal Weight";
}
elseif ($bmi >= 25 && $bmi <= 29.9){
    $category="Overweight";
}
else{
    $category="Obese";
}

echo "<h3>Results: </h3>";
echo "Your BMI: $bmi<br>";
echo "Category: $category";

}
?>

</body>
</html>