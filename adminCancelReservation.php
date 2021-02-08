<?php
require_once "config.php";
$id = $_GET['username'];
$reservation_id = $_GET['reservation_id']; 

$sql = "SELECT status FROM reservation WHERE id = '$reservation_id'";
if($result = mysqli_query($link, $sql)){
    while($row = mysqli_fetch_array($result)){
        if($row["status"] == 1){
            header("Location: UserReservation.php?username=$id&submit=unsuccessful");
            exit();
        }
    }
}
mysqli_query($link,"DELETE FROM reservation_seat WHERE reservation_id='$reservation_id'");
mysqli_query($link,"DELETE FROM reservation WHERE id='$reservation_id'");
mysqli_close($link);
header("Location: UserReservation.php?username=$id&submit=cancelled");
?> 