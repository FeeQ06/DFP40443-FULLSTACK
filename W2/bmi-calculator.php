<html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMI CALCULATOR</title>
</head>

<body>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label>Height (cm)</label>
    <input name="height" type="number">
    <label>Weight (kg)</label>
    <input name="weight" type="number">
    <input type="submit" value="Calculate">
    
</body>
</form>   
</html>