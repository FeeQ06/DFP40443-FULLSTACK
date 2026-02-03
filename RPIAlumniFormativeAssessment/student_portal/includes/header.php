<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RPI Alumni PMU</title>
</head>
<body>

<style>
    /* Basic reset and container styling */
.navbar ul {
    list-style-type: none; /* Remove default list bullets */
    margin: 0;
    padding: 0;
    background-color: #333; /* Dark background color */
    overflow: hidden; /* Clear floats if using float method */
    display: flex; /* Use Flexbox for horizontal layout */
    justify-content: space-around; /* Distribute items evenly */
}

.navbar li a {
    display: block; /* Make links fill the list item area, making them easier to click */
    color: white; /* White text color */
    text-align: center; /* Center the text */
    padding: 14px 16px; /* Add some padding */
    text-decoration: none; /* Remove default underlines */
}

/* Change the color of links on hover */
.navbar li a:hover:not(.active) {
    background-color: #111;
}

/* Add a color to the active/current link */
.navbar li a.active {
    background-color: #04AA6D;
}

</style>

<div class="container mb-3">
    <div class="center">
    <header>
        <h2>RPI ALUMNI</h2>
    </header>
    <nav class="navbar">
        <ul>
        <li><a href="">EVENTS</a></li>
        <li><a href="">CHAPTERS & GROUPS</a></li>
        <li><a href="">CAREER NETWORKING</a></li>
        <li><a href="">PRODUCTS & BENEFITS</a></li>
        <li><a href="">VOLUNTEER</a></li>
        <li><a href="">REUNION & HOMECOMING</a></li>
        <li><a href="">GIVE</a></li>
        </ul>
    </nav>

</div>
</div>
</body>
</html>