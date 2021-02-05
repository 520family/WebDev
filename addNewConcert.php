<?php
// Initialize the session
session_start();
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
$id = $_GET["username"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="headerstyle.css">
    <link rel="stylesheet" href="styleAddNewConcert.css">
</head>
<body>
    <?php include "adminHeader.html" ?>
    <?php include "adminNavigation.php" ?>
    <div class="heading">
        <h3>Add New Concert</h3>
    </div>
    <div class="mainbox">
        <form action="addConcert.php?username=<?php echo $_GET['username']; ?>" method="POST" enctype="multipart/form-data">
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
            <h4>Poster</h4>
            <?php
                echo 'Select image to upload:';
                echo '<input type="file" name="fileToUpload" id="fileToUpload">';
            ?>
            <input type="submit" id="submit" name="submit" value="Add">
        </form>
    </div>
</body>
</html>