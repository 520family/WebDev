<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./cssfile/headerstyle.css">
    <link rel="stylesheet" href="./cssfile/concertDetails.css">
</head>
<?php 
    require_once "config.php";
    session_start();
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: loginpage.php");
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

    if(isset($_GET["success"]) && $_GET["success"]!=0){
        echo "<script>";
        echo "window.alert('Reservation is successful!');";
        echo "</script>";
        $_SESSION["is_updated"] = false;
        $_SESSION["selected_seats"] = null;
        $_SESSION["price"] = null;

    }

    if(isset($_GET["update"])){
        if(strcmp($_GET["update"], "success") == 0){
            echo "<script>";
            echo "window.alert('Selected seat successfully updated');";
            echo "window.reload()";
            echo "</script>";
        }else if(strcmp($_GET["update"], "failed") == 0){
            echo "<script>";
            echo "window.alert('Please select at least a seat to update');";
            echo "</script>";
        }
    }

    function printSeats($concert_id, $seats_row, $reservations, $link, $id, $selected_seats){
        $x = 1;
        $seat = array();
        for($row = 0; $row < 10;$row++){
            $alphabet = chr(65 + $row);
            for($column = 0; $column < 10; $column++){
                $num = $column + 1;
                $seat[$row][$column] = "$alphabet-$num";
            }
        }

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
        echo "<form action='updateConcert.php?username=".$id."&concert_id=".$concert_id."' method='post' id='reservation'>"; 
        echo"<tr>"; 
        for ($col = 0; $col <= 10; $col++){
            echo "<td>";
            echo "$col";
            echo "</td>";
        }
        echo "</tr>";
        for ($i = 0; $i < 10; $i++){
            echo"<tr>"; 
            echo "<td>";
            $row = 65 + $i;
            echo chr($row);
            echo "</td>";
            
            for ($j = 0; $j < 10; $j++){
                if($reservations_result = mysqli_query($link, $reservations)){
                    while($reservations_row = mysqli_fetch_array($reservations_result)){
                        if($reservations_row["concert_id"] == $concert_id && strcmp($reservations_row["seat_id"], $seat[$i][$j]) == 0)
                            $occupy[$i][$j] = true;
                    }
                }
                echo "<td>";
                echo "<input id='seat-".$x."' type='checkbox' name='selected_seat[]' value='".$seat[$i][$j]."'";
                if($occupy[$i][$j]){
                    echo " class='seat-occupy' checked disabled='disabled'";
                }else if(!is_null($selected_seats)){
                    $selected = false;
                    foreach($selected_seats as $selected_seat){
                        if(strcmp($selected_seat, $seat[$i][$j]) == 0){
                            echo " class='seat-select' checked";
                            $selected = true;
                            break;
                        }
                    }
                    if(!$selected){
                        echo " class='seat-select'";
                    }
                }else{
                    echo " class='seat-select'";
                }
                echo "/>";
                echo "<label for='seat-".$x."' class='seat'></label>";
                $x++;
            echo "</td>";
        }
            
            echo "</tr>";
        }
        echo "<tr>";
        echo "<td colspan='4'></td>";
        echo "<td class='submitbtn' colspan='3'>";
        echo "<input type='submit' value='Update' id='submit'>";
        echo "</td>";
        echo "<td colspan='4'></td>";
        echo "</tr>";
        echo "</form>";
    }
?>
<body>
    <?php include "userHeader.php" ?>
    <?php include "userNavigation.php" ?>
    <div class="container">
            <script type="text/javascript">
                if (typeof has_seat == "undefined"){
                    var has_seat = false; 
                    has_seat = false;                 
                }
            function validateReserve() {
                    if(!has_seat){
                       alert("Please select a seat before you reserve");
                       return false;
                    }
            }
            </script> 
            <table class="tableseat">
                <tr><th colspan='11'>Seat Arrangement</th></tr>
                <tr><td colspan='11'><div id="stage">STAGE</div></tr>
                <?php
                    $seats = "SELECT * from seat";
                    $reservations = "SELECT reservation.concert_id, reservation_seat.seat_id from reservation INNER JOIN reservation_seat ON reservation.id = reservation_seat.reservation_id";
                        if($seats_result = mysqli_query($link, $seats)){
                            $seats_row = mysqli_fetch_array($seats_result);
                            if(!isset($_SESSION["seats"])){
                                printSeats($concert_id, $seats_row, $reservations, $link, $id, null); 
                            }else{
                                $selected_seats = $_SESSION["seats"];
                                printSeats($concert_id, $seats_row, $reservations, $link, $id, $selected_seats);    
                            }       
                        }
                ?>  
            </table>
            <section class="details">
                <?php
                 if(!isset($_SESSION["is_updated"])){
                    $_SESSION["is_updated"] = false; 
                    $_SESSION["total_price"] = 0; 
                    $_SESSION["has_seat"] = false;
                }

                 echo "<img src=".$img_src.">"; 
                 echo "<h4>Details: </h4>";    
                 echo "<p>".$details."</p>";
                 echo "<h4>Date: ".$date. "</h4>";    
                 echo "<h4>Time:  ".$start_time." - ".$end_time. "</h4>";    
                ?>
            </section>
                <?php
                echo"<section class='calculate details'>";
                echo "<h4>Seat selected: </h4>";
                echo "<div id='mainbox'>";
                echo "<table>";
                    echo  "<tr>";
                            echo "<th>Selected Seat</th>";
                            echo "<th>Price</th>";
                    echo  "</tr>";
                if($_SESSION["is_updated"] && !is_null($_SESSION["seats"])){
                    $selected_seats = $_SESSION["seats"];
                    $seat_price = $_SESSION["price"];
                    $total_price = $_SESSION["total_price"];   
                        foreach(array_combine($selected_seats, $seat_price) as $seat => $price){
                            echo "<tr>";
                            echo "<td>" . $seat . "</td>";
                            echo "<td>RM". $price . "</td>";
                            echo "<tr>";
                        }
                        echo "<tr><td colspan='2'>Total price RM: $total_price </td></tr>";
                   $_SESSION["selected_seats"] = $selected_seats;
                   $_SESSION["total_price"] = $total_price;
                   echo "<script>
                        has_seat = true;
                        console.log(has_seat);
                   </script>";
                }else{
                    echo "<tr>";
                    $selected_seat_error = "None of the seat is selected yet";
                    echo "<td>". $selected_seat_error. "</td>";
                    $price_error = "RM0";
                    echo "<td>". $price_error ."</td>";
                    echo "<tr>";
                }
                echo "</table>";
                echo "</div>";
                echo "<a href='reserveSeat.php?username=".$id."&concert_id=".$concert_id."'><button onclick='validateReserve()'>Reserve</button></a></td>"; 
                echo "</form>";
                echo"</section>";
            ?> 
    </div>


</body>
</html>