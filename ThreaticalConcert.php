<?php
require_once "config.php";
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
$id = $_GET['username'];
$threatical_concerts = "SELECT  id, image_path FROM concert WHERE type = 'Threatical'";
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
            <li><a href="myProfile.php?username=<?php echo $id; ?>" >My Profile</a></li>
            <li><a href="myReservation.php?username=<?php echo $id; ?>" >My Reservation</a></li>
            <li><a href="RecitalConcert.php?username=<?php echo $id; ?>" >Recital</a></li>
            <li><a href="ThreaticalConcert.php?username=<?php echo $id;?>">Threatical</a></li>
            <li><a href="ClassicalConcert.php?username=<?php echo $id;?>">Classical</a></li>
        </ul> 
    </div>
    <div class="images">
    <?php if($result = mysqli_query($link, $threatical_concerts)){
                        $id = $_GET['username'];
                        if(mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_array($result)){  
                                $img_src = $row['image_path'];
                                $concert_id = $row['id'];
                                
                                echo "<a href='ConcertDetails.php?username=".$id."'&concert_id=".$concert_id."><img src=".$img_src."></a>";
                            }
                        }
                    }
    ?>
    </div>
    <script src="app.js"></script>
</body>
</html>