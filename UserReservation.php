<?php
require_once "config.php";
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: adminlogin.php");
    exit;
}

//$concerts = "SELECT id, name, type, date, start_time, end_time FROM concert WHERE admin_id = $_GET('id')";
    $id = $_GET["username"];
    $reservations = "SELECT id, user_id, status, concert_id FROM reservation";

    if(isset($_POST["id"]) && !empty($_POST["id"])){
        $concert_id = $
        // Prepare a delete statement
        $sql = "DELETE FROM concert WHERE id = '$concert_id'";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = trim($_POST["id"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records deleted successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
    }
    
    if(isset($_GET["submit"])){
        if(strcmp($_GET["submit"], "approved") == 0){
            echo "<script>";
            echo "window.alert('The following reservation is approved');";
            echo "window.location = './UserReservation.php?"."username=".$_GET['username']."';";
            echo "</script>";
        }elseif(strcmp($_GET["submit"], "cancelled") == 0){
            echo "<script>";
            echo "window.alert('The following reservation is cancelled');";
            echo "window.location = './UserReservation.php?"."username=".$_GET['username']."';";
            echo "</script>";
        }elseif(strcmp($_GET["submit"], "unsuccessful") == 0){
            echo "<script>";
            echo "window.alert('You cannot cancel a reservation which the customer has bought the ticket!');";
            echo "window.location = './UserReservation.php?"."username=".$_GET['username']."';";
            echo "</script>";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./cssfile/headerstyle.css">
    <link rel="stylesheet" href="./cssfile/styleAdmin.css">
</head>
<body>
    <?php include "adminHeader.php" ?>
    <?php include "adminNavigation.php" ?>
    <div class="heading">
        <h3>User Reservation</h3>
    </div>
    <div class="mainbox">
    <div class="column">
            <form action="admin_process_search.php?username=<?php echo $id; ?>" id="reservation-form2" method="post" onsubmit="myFunction()">
                <div class="field">
                    <input type="text" placeholder="Search the Reservation by ID Here..." id="search222" name="searching2">
                    <button value="search" alt="icon" id="topIcon"><img src ='image/search.png'></button>
                </div>
            </form>
            <div class="clear"></div>
        </div>
        <table>
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Status</th>
                <th>Concert Name</th>
                <th>Seat Reserved</th>
                <th>Date</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Cancel</th>
                <th>Approve</th>
            </tr>
            <?php if($result = mysqli_query($link, $reservations)){
                        $username = $_GET["username"];
                        if(mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_array($result)){
                                echo "<tr>";    
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['user_id'] . "</td>";
                                if($row["status"] == 0){
                                    echo "<td>Ticket pending</td>";
                                }else{
                                    echo "<td>Ticket bought</td>";
                                }

                                $concert_id = $row["concert_id"];
                                $concerts = "SELECT name, date, start_time, end_time FROM concert WHERE id = $concert_id";
                                if($concert_result = mysqli_query($link, $concerts)){
                                    while($concert_row = mysqli_fetch_array($concert_result)){
                                        echo "<td>" . $concert_row['name'] . "</td>";
                                        echo "<td>";
                                        $reservation_id = $row["id"];
                                        $seat_reserved = "SELECT seat_id FROM reservation_seat WHERE reservation_id = '$reservation_id'";
                                        if($seat_result = mysqli_query($link, $seat_reserved)){
                                            $seat_number = mysqli_num_rows($seat_result);
                                            while($seat_row = mysqli_fetch_array($seat_result)){
                                                $seat_id = $seat_row["seat_id"];
                                                if($seat_number > 1){
                                                    echo $seat_id." ,";
                                                }else{
                                                    echo $seat_id;
                                                }
                                                $seat_number--;
                                            }
                                        }
                                        echo "</td>";
                                        echo "<td>" . $concert_row['date'] . "</td>";
                                        echo "<td>" . $concert_row['start_time'] . "</td>";
                                        echo "<td>" . $concert_row['end_time'] . "</td>";
                                    }
                                }
                                echo "<td><a href='adminCancelReservation.php?username=".$id."&reservation_id=".$row['id']."'><button><img src ='image/cancel.png'></button></a></td>";
                                echo "<td><a href='approveReservation.php?username=".$id."&reservation_id=".$row['id']."'><button><img src ='image/approve.png'></button></a></td>";
                                echo "<tr>";
                            }
                        }
                    }
            ?>
        </table>
        <script>
            function myFunction() {
                if ($('#search222').val() == "") {
                    alert("Please enter the Reservation ID..."); //empty searchBar field
                }
            }
        </script>
</body>
</html>