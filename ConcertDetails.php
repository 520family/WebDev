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
    $concert = "SELECT  id, image_path, details, date , start_time, end_time FROM concert WHERE id = '$concert_id'";
    if($result = mysqli_query($link, $concert)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){  
                $img_src = $row['image_path'];
                $details = $row['details'];
                $date = $row['date'];
                $start_time = $row['start_time'];
                $end_time = $row['end_time'];
            }
        }
    }

    $x = 1;
    $seat = array(
        array("A-1", "A-2", "A-3", "A-4", "A-5", "A-6", "A-7", "A-8", "A-9", "A-10"),
        array("", "", "", "", "", "", "", "", "", ""),
        array("", "", "", "", "", "", "", "", "", ""),
        array("", "", "", "", "", "", "", "", "", ""),
        array("", "", "", "", "", "", "", "", "", ""),
        array("", "", "", "", "", "", "", "", "", ""),
        array("", "", "", "", "", "", "", "", "", ""),
        array("", "", "", "", "", "", "", "", "", ""),
        array("", "", "", "", "", "", "", "", "", ""),
        array("", "", "", "", "", "", "", "", "", ""),
    );

    $occupy = array(
        array(false, false, false, false, false, false, false, false, false, false),
        array(false, false, false, false, false, false, false, false, false, false),
        array(false, false, false, false, false, false, false, false, false, false),
        array(false, false, false, false, false, false, false, false, false, false),
        array(false, false, false, false, false, false, false, false, false, false),
        array(false, false, false, false, false, false, false, false, false, false),
        array(false, false, false, false, false, false, false, false, false, false),
        array(false, false, false, false, false, false, false, false, false, false),
        array(false, false, false, false, false, false, false, false, false, false),
        array(false, false, false, false, false, false, false, false, false, false),
    );

    function printSeats($concert_id, $seats_row, $reservations, $link){

     /*   for ($i = 0; $i < 10; $i++){
            echo"<tr>"; 
            echo "<td>";
            echo "<section id='seat'>";
            for ($j = 0; $j < 10; $j++){
                if($reservations_result = mysqli_query($link, $reservations)){
                    while($reservations_row = mysqli_fetch_array($reservations_result)){
                        if($reservations_row["concert_id"] = $concert_id && strcmp($reservations_row["seat_id"], $seat[$i][$j]) == 0)
                            $occupy[$i][$j] = true;
                    }
                }
                echo "<input id='seat-".$x."' class='seat-select' type='checkbox' name='selected_seat' value='".$seat[$i][$j]."'";
                if($occupy[$i][$j]){
                    echo " checked disabled='disabled'";
                }
                echo "/>";
                echo "<label for='seat-".$x."' class='seat'></label>";
                $x++;
            }
            echo "</section>";
            echo "</td>";
            echo "</tr>";
        }
        //echo "<input type='submit' value='Update' id='submit'>";
        echo "</form>";*/
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
    <?php include "userHeader.php" ?>
    <?php include "userNavigation.php" ?>
  
    <div class="title">
        <h3>Concert 1</h3>
    </div>
    <br>
    <div class="a">
        <h4>Seat Arrangement</h4>
        <form id="reservation" method="post" >
            <table class="tableseat">
                <?php
                    $seats = "SELECT * from seat";
                    $reservations = "SELECT reservation.concert_id, reservation_seat.seat_id from reservation INNER JOIN reservation_seat ON reservation.id = reservation_seat.reservation_id";
                        if($seats_result = mysqli_query($link, $seats)){
                            $seats_row = mysqli_fetch_array($seats_result);
                            echo "<form action='update.php' method='post'>"; 
                            for ($i = 0; $i < 10; $i++){
                                echo"<tr>"; 
                                echo "<td>";
                                echo "<section id='seat'>";
                                for ($j = 0; $j < 10; $j++){
                                    if($reservations_result = mysqli_query($link, $reservations)){
                                        while($reservations_row = mysqli_fetch_array($reservations_result)){
                                            if($reservations_row["concert_id"] = $concert_id && strcmp($reservations_row["seat_id"], $seat[$i][$j]) == 0)
                                                $occupy[$i][$j] = true;
                                        }
                                    }
                                    echo "<input id='seat-".$x."' class='seat-select' type='checkbox' name='selected_seat' value='".$seat[$i][$j]."'";
                                    if($occupy[$i][$j]){
                                        echo " checked disabled='disabled'";
                                    }
                                    echo "/>";
                                    echo "<label for='seat-".$x."' class='seat'></label>";
                                    $x++;
                                }
                                echo "</section>";
                                echo "</td>";
                                echo "</tr>";
                            }
                            echo "<input type='submit' value='Update' id='submit'>";
                            echo "</form>";
                        }
                ?>  
            </table>
            <section class="details">
                <?php
                    //echo "<h3>Details</h3>";
                 echo "<img src=".$img_src.">"; 
                 echo "<h4>Details: </h4>";    
                 echo "<p>".$details."</p>";
                 echo "<h4>Date: </h4>";    
                 echo "<p>".$date."</p>";
                 echo "<h4>Time </h4>";    
                 echo "<p>".$start_time." - ".$end_time."</p>";
                echo"</section>";
                echo"<article class='calculate'>";
                echo "<h4>Details: </h4>";    
                echo "<p>".$details."</p>";
                echo"<input type='submit' id='pay'/> ";
                echo"</article>";
                echo "<form action='update.php' method='post'>"; 
                echo "<input type='submit' value='Update' id='submit'>";
                echo "</form>";
            ?>  
    </div>


</body>
</html>