<?php
require_once "config.php";
$id = $_GET['username'];
$concert_id = $_GET['concert_id']; 

// or assuming your column is indeed an int
// $id = (int)$_GET['id'];

mysqli_query($link,"DELETE FROM concert WHERE id='$concert_id'");
mysqli_close($link);
header("Location: adminHomepage.php?username=$id");
?> 