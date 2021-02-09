<?php
require_once "config.php";
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
    <title>Concert Ticketing System</title>
    <link rel="stylesheet" href="./cssfile/headerstyle.css">
    <link rel="stylesheet" href="./cssfile/style.css">
    <a href="logout.php" class="logout-button"><img src="./image/logout.png"></a>
</head>
<body>
    <?php include "userHeader.php" ?>
    <?php include "userNavigation.php" ?>
    <div class="search images">
    <?php
    $name = $_POST['searching'];
    $query = "SELECT * FROM concert where name like '%$name%' ";
     if($result = mysqli_query($link, $query)){
                        $id = $_GET["username"];
                        if(mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_array($result)){
                                $img_src = $row['image_path'];
                                $concert_id = $row['id'];
                                echo "<a href='ConcertDetails.php?username=".$id."&concert_id=".$concert_id."'><img src=".$img_src."></a>";
                            }
                        }
                    }
    ?>
    </div>
    <?php if($_POST['searching']==""): ?>
<<<<<<< HEAD
        <script>alert('Please enter the Concert ID...')</script>
=======
    <script>alert('Please enter the concert name...')</script>
>>>>>>> ad086384882a6cb56bc8c98f041ae37957aa76e7
    <?php endif; ?>
</body>
</html>
