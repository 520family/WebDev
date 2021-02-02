<?php
// Initialize the session
session_start();
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
$id = $_GET['username'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styleAddNewConcert.css">
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
    <div class="heading">
        <h3>Add New Concert</h3>
    </div>
    <div class="mainbox">
        <form action="addConcert.php?username=<?php echo $_GET["username"]; ?>" method="POST">
            <h4>Name</h4>
            <?php 
                echo '<input type="text" id="name" name="name">';
            ?>
            <h4>Details</h4>
            <?php 
                echo '<input type="text" id="details" name="details">';
            ?>
            <h4>Date</h4>
            <?php 
                echo '<input type="date" id="date" name="date">';
            ?>
            <div class="row">
                <div class="column">
                    <h4>Start Time</h4>
                </div>
                <div class="column">
                    <h4>End Time</h4>
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <?php 
                        echo '<input type="time" id="startTime" name="startTime">';
                    ?>
                </div>
                <div class="column">
                    <?php 
                        echo '<input type="time" id="endTime" name="endTime">';
                    ?>
                </div>
            </div>
            
            <input type="submit" id="submit" name="submit" value="Add">
        </form>
    </div>
</body>
</html>