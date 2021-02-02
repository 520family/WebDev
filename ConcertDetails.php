<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styleConcert1Recital.css">
</head>
<?php 
    require_once "config.php";
    session_start();
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login.php");
        exit;
    }
    $id = $_GET['username'];
    $concert_id = $_GET["concert_id"];
    $concert = "SELECT  id, image_path FROM concert WHERE id = '$concert_id'";
    if($result = mysqli_query($link, $concert)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){  
                $img_src = $row['image_path'];
            }
        }
    }
    function printSeats(){

      $x = 1;
      for ($i = 0; $i < 10; $i++){
        echo"<tr>"; 
        echo "<td>";
        echo "<section id='seat'>";
        for ($j = 0; $j < 10; $j++){
            echo "<input id='seat-".$x."' class='seat-select' type='checkbox' value='".$x."' name='seat[]' />";
            echo "<label for='seat-".$x."' class='seat'></label>";
            $x++;
        }
        echo "</section>";
        echo "</td>";
        echo "</tr>";
      }
    }

    function outputCartRow($file,$product,$quantity,$price){

        $amount = $quantity * $price;
        echo"<tr>";
        echo "<td><img class='img-thumbnail' src='images/art/tiny/".$file."' alt='...'></td>";
        echo "<td>".$product."</td>";
        echo "<td>".$quantity."</td>";
        echo "<td>$".$price."</td>";
        echo "<td>$".$amount."</td>";
        echo"</tr>";
      }
?>
<body>
    <?php include "userHeader.html" ?>
    <?php include "userNavigation.php" ?>
  
    <div class="title">
        <h3>Concert 1</h3>
    </div>
    <br>
    <div class="a">
        <h4>Seat Arrangement</h4>
        <form id="reservation" method="post" action="test.php">
            <table class="tableseat">
                <?php printSeats(); ?>
            </table>
            <section class="details">
                <?php
                    //echo "<h3>Details</h3>";
                 echo "<img src=".$img_src.">";     
            echo"</section>";
                echo"<article class='calculate'>";
                echo"<input type='submit' id='pay'/> ";
                echo"</article>";
            ?>  
    </div>


</body>
</html>