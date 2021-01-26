<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styleConcert1Recital.css">


</head>
<?php 

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
                <h3>Details</h3>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                <h3>Details</h3>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                <h3>Details</h3>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                <h3>Details</h3>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                <h3>Details</h3>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                <h3>Details</h3>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                <h3>Details</h3>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                <h3>Details</h3>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>               
            </section>   
            <article class="calculate">
                <h3>Price</h3>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p> 
                <h3>Quantity</h3>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>        
                <input type="submit" id="pay"/> 
            </article>   
    </div>


</body>
</html>