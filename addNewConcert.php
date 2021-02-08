<?php
// Initialize the session
session_start();
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
$id = $_GET["username"];

if(isset($_GET["submit"])){
    if(strcmp($_GET["submit"], "success") == 0){
        echo "<script>";
        echo "window.alert('Insert Successfully');";
        echo "window.location = './adminHomepage.php?"."username=".$_GET['username']."';";
        echo "</script>";
    }
    else if(strcmp($_GET["submit"], "empty") == 0){
        echo "<script>";
        echo "window.location = './addNewConcert.php?"."username=".$_GET['username']."';";
        echo "window.alert('Please fill in all required fields including poster');";
        echo "</script>";
    }else if(strcmp($_GET["submit"], "start_time_clash") == 0){
        echo "<script>";
        echo "window.alert('Please pick another date or start time, it is clashed with other concert.');";
        echo "window.location = './addNewConcert.php?"."username=".$_GET['username']."';";
        echo "</script>";
    }else if(strcmp($_GET["submit"], "end_time_clash") == 0){
        echo "<script>";
        echo "window.alert('Please pick another date or end time, it is clashed with other concert.');";
        echo "window.location = './addNewConcert.php?"."username=".$_GET['username']."';";
        echo "</script>";
    }else if(strcmp($_GET["submit"], "concert_name_clash") == 0){
        echo "<script>";
        echo "window.alert('Please pick another concert name, it is clashed with other concert.');";
        echo "window.location = './addNewConcert.php?"."username=".$_GET['username']."';";
        echo "</script>";
    }else if(strcmp($_GET["submit"], "file_upload_error") == 0){
        echo "<script>";
        echo "window.alert('Please ensure the file you upload is an image, png/jpg/jpeg/gif type file and less than 5MB.');";
        echo "window.location = './addNewConcert.php?"."username=".$_GET['username']."';";
        echo "</script>";
    } 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="./cssfile/headerstyle.css">
    <link rel="stylesheet" href="./cssfile/styleAddNewConcert.css">
    <a href="logout.php" class="logout-button"><img src="./image/logout.png"></a>
</head>
<body>
    <?php include "adminHeader.html" ?>
    <?php include "adminNavigation.php" ?>
    <div class="heading">
        <h3>Add New Concert</h3>
    </div>
    <div class="mainbox">
        <form action="addConcert.php?username=<?php echo $_GET['username']; ?>" method="POST" enctype="multipart/form-data">
        <div>
                <label>Name</label>
                <input type="text" name="name">
            </div>
            <div>
                <label>Type</label>
                <input type="text" name="type">
            </div>
            <div>
                <label>Details</label>
                <input type="text" name="details">
            </div>
            <div>
                <label>Date</label>
                <input type="date" name="date" >
            </div> 
            <div>
                <label>Start Time</label>
                <input type="time" name="startTime"> 
            </div>
            <div>
                <label>End Time</label>
                <input type="time" name="endTime">
            </div>
            <div>
                <label>Poster</label>
                <label>Select image to upload:</label>
                <input type="file" name="fileToUpload" id="fileToUpload">     
            </div>
            <div>
                <input type="submit" id="submit" name="submit" value="Add">
            </div>
        </form>
    </div>
</body>
</html>