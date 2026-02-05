<!DOCTYPE html>

<html>
    <head>
        <title>Practical Work 1</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    </head>

    <style>
        .rounded-submit {
            border-radius: 8px;
            padding: 5px 15px;
            background-color: #0044ff;
            color: white;
            cursor: pointer;
        }
    </style>

    <div class="container mt-5">
        <div class="center-horizontal">
    <body>
            <div>
                <form action="page2.php" method="POST">
                <h2>Question 1</h2>
                <p>What does PHP stand for?</p>
                
                <input type="radio" name="answer" id="1" value="Private Home Page">
                <label for="1">Private Home Page</label>
                <br>

                <input type="radio" name="answer" id="2" value="PHP: Hypertext Preprocessor">
                <label for="2">PHP: Hypertext Preprocessor</label>
                <br>

                <input type="radio" name="answer" id="3" value="Personal Hypertext Processor">
                <label for="3">Personal Hypertext Processor</label>
                <br>

                <br>
                <input type="submit" class="rounded-submit" value="Next Question">
                </form>
            </div>
    </body>
    
    </div>
    </div>
    
</html>