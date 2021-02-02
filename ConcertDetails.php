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
    <div class=top>
        <h2>Concert Ticketing System</h2>
        <div class="row">
            <div class="column">
                <input type="text" placeholder="Search...">
            </div>
            <div class="column">
                <img src="rectangle.png" alt="icon" id="topIconRecital">
            </div>
        </div>
    </div>
    <div class="topnav">
        <ul>
            <li><a href="recital.html" >Recital</a></li>
            <li><a href="threatical.html" >Threatical</a></li>
            <li><a href="classical.html" >Classical</a></li>
        </ul> 
    </div>
  
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