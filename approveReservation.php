<?php
require_once "config.php";
$id = $_GET['username'];
$reservation_id = $_GET['reservation_id']; 

// or assuming your column is indeed an int
// $id = (int)$_GET['id'];
$sql = "SELECT status FROM reservation WHERE id = $reservation_id";
$qresult = mysqli_query($link,$sql);
$reservation= mysqli_fetch_array($qresult);
if($reservation['status'] == 1){
    header("Location: UserReservation.php?username=$id&submit=alr_approve");
    exit;
}else{
    mysqli_query($link,"UPDATE reservation SET status = 1 WHERE id='$reservation_id'");
    mysqli_close($link);
    header("Location: UserReservation.php?username=$id&submit=approved");
    exit;
}
?> 