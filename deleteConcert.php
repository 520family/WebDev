<?php
require_once "config.php";
$id = $_GET['username'];
$concert_id = $_GET['concert_id']; 

// or assuming your column is indeed an int
// $id = (int)$_GET['id'];

mysqli_query($link,"SELECT id FROM reservation WHERE id='$concert_id'");
$sql = "SELECT id FROM reservation WHERE id='$concert_id'";
$qresult = mysqli_query($link,$sql);
$reservations_id = mysqli_fetch_array($qresult);
foreach($reservations_id as $reservation_id){
    $r_id = $reservation_id['id'];
    mysqli_query($link,"DELETE FROM reservation_seat WHERE reservation_id='$r_id'");
}
mysqli_query($link,"DELETE FROM reservation WHERE concert_id='$concert_id'");
mysqli_query($link,"DELETE FROM concert WHERE id='$concert_id'");
mysqli_close($link);
header("Location: adminHomepage.php?username=$id&submit=delete");
?> 