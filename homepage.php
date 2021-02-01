<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Concert Ticketing System</title>
    <link rel="stylesheet" href="style.css">
    <a href="logout.php" class="logout-button">Logout</a>
</head>
<body>
    <div class=top>
        <h2>Concert Ticketing System</h2>
        <div class="row">
            <div class="column">
                <input type="text" placeholder="Search...">
            </div>
            <div class="column">
                <img src="rectangle.png" alt="icon" id="topIcon">
            </div>
        </div>
    </div>
    <div class="topnav">
        <ul>
            <li><a href="concert1Recital.php" >Recital</a></li>
            <li><a href="threatical.html" >Threatical</a></li>
            <li><a href="classical.html" >Classical</a></li>
        </ul> 
    </div>
    <div class="images">
        <a href="#"><img src="image/recital concert.jpg" alt="recital concert"></a>
        <a href="#"><img src="image/theatrical.jpg" alt="threatical concert"></a>
        <a href="#"><img src="image/classical.jpeg" alt="classical concert"></a>
    </div>
    <script src="app.js"></script>
</body>
</html>