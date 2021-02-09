<?php
require_once "config.php";
$id = $_GET['username'];
$reservation_id = $_GET['reservation_id']; 

// or assuming your column is indeed an int
// $id = (int)$_GET['id'];
mysqli_query($link,"DELETE FROM reservation_seat WHERE reservation_id='$reservation_id'");
mysqli_query($link,"DELETE FROM reservation WHERE id='$reservation_id'");
mysqli_close($link);
header("Location: myReservation.php?username=$id&delete=success");
?> 