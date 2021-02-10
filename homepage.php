<?php
require_once "config.php";
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: loginpage.php");
    exit;
}else{
    $user_id = $_SESSION["username"];
    header("location: homepage.php?username=$user_id");
    exit;
}
$id = $_GET["username"];
$concerts = "SELECT  id, image_path FROM concert";
?>

<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Concert Ticketing System</title>
    <link rel="stylesheet" href="./cssfile/footerstyle.css">
    <link rel="stylesheet" href="./cssfile/headerstyle.css">
    <link rel="stylesheet" href="./cssfile/style.css">
</head>
<body>
    <?php include "userHeader.php" ?>
    <?php include "userNavigation.php" ?>
    <div class="images">
    <?php
    

    if($result = mysqli_query($link, $concerts)){
                        $username = $_GET["username"];
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
    <?php include "footer.html"?>

</body>
</html>