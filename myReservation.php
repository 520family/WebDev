<?php
require_once "config.php";
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: loginpage.php");
    exit;
}
$id = $_GET['username'];
$reservations = "SELECT  id, status, concert_id FROM reservation WHERE user_id = '$id'";

if(isset($_GET["delete"])){
    if(strcmp($_GET["delete"], "success") == 0){
        echo "<script>";
        echo "window.alert('Reservation successfully cancelled');";
        echo "window.location = './myReservation.php?"."username=".$_GET['username']."';";
        echo "</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Concert Ticketing System</title>
    <link rel="stylesheet" href="./cssfile/footerstyle.css">
    <link rel="stylesheet" href="./cssfile/headerstyle.css">
    <link rel="stylesheet" href="./cssfile/UserReservation.css">

</head>
<body>
    <?php include "userHeader.php" ?>
    <?php include "userNavigation.php" ?>
    <div class="heading">
        <h3>List of Concerts</h3>
    </div>
    <div class="mainbox">
        <table>
            <tr>
                <th>ID</th>
                <th>Status</th>
                <th>Concert Name</th>
                <th>Seat Reserved</th>
                <th>Date</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Cancel Reservation</th>
            </tr>
           <?php  
           if($result = mysqli_query($link, $reservations)){
                        $username = $_GET["username"];
                        if(mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_array($result)){
                                echo "<tr>";    
                                echo "<td>" . $row['id'] . "</td>";
                                if($row["status"] == 0){
                                    echo "<td>Ticket pending</td>";
                                }else{
                                    echo "<td>Ticket bought</td>";
                                }

                                $concert_id = $row["concert_id"];
                                $concerts = "SELECT name, date, start_time, end_time FROM concert WHERE id = $concert_id";
                                if($concert_result = mysqli_query($link, $concerts)){
                                    while($concert_row = mysqli_fetch_array($concert_result)){
                                        echo "<td>" . $concert_row['name'] . "</td>";
                                        echo "<td>";
                                        $reservation_id = $row["id"];
                                        $seat_reserved = "SELECT seat_id FROM reservation_seat WHERE reservation_id = '$reservation_id'";
                                        if($seat_result = mysqli_query($link, $seat_reserved)){
                                            $seat_number = mysqli_num_rows($seat_result);
                                            while($seat_row = mysqli_fetch_array($seat_result)){
                                                $seat_id = $seat_row["seat_id"];
                                                if($seat_number > 1){
                                                    echo $seat_id." ,";
                                                }else{
                                                    echo $seat_id;
                                                }
                                                $seat_number--;
                                            }
                                        }
                                        echo "</td>";
                                        echo "<td>" . $concert_row['date'] . "</td>";
                                        echo "<td>" . $concert_row['start_time'] . "</td>";
                                        echo "<td>" . $concert_row['end_time'] . "</td>";
                                    }
                                }
                                echo "<td><a href='cancelReservation.php?username=".$id."&reservation_id=".$row['id']."'><button><img src ='image/cancel.png'></button></a></td>";
                                echo "<tr>";
                            }
                        }
                    }
            ?>
        </table> 
    </div>
    <?php include "footer.html" ?>
</body>
</html>