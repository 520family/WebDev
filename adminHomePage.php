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
    $concerts = "SELECT id, name, type, date, start_time, end_time FROM concert WHERE admin_id = '$id'";

    function delete(){
        if(isset($_POST["id"]) && !empty($_POST["id"])){
            // Include config file
            
            // Prepare a delete statement
            $sql = "DELETE FROM employees WHERE id = ?";
            
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
             
            // Close statement
            mysqli_stmt_close($stmt);
            
            // Close connection
            mysqli_close($link);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styleAdmin.css">
    <a href="logout.php" class="logout-button">Logout</a>
</head>
<body>
    <div class=top>
        <h2>Concert Ticketing System</h2>
        <div class="row">
            <div class="column">
                <input type="text" placeholder="Search...">
            </div>
            <div class="column">
                <img src="rectangle.png" alt="icon" id="topIcon">
            </div>
        </div>
    </div>
    <div class="heading">
        <h3>List of Concerts</h3>
    </div>
    <div class="mainbox">
        <table>
            <tr>
                <th>ID</th>
                <th>Concert Name</th>
                <th>Type</th>
                <th>Date</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php if($result = mysqli_query($link, $concerts)){
                        if(mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_array($result)){
                                echo "<tr>";    
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['name'] . "</td>";
                                echo "<td>" . $row['type'] . "</td>";
                                echo "<td>" . $row['date'] . "</td>";
                                echo "<td>" . $row['start_time'] . "</td>";
                                echo "<td>" . $row['end_time'] . "</td>";
                                echo "<td><button id='button1'></button></td>";
                                echo "<td><input type = 'submit' name='delete' value='Delete'><button><img src ='image/bin.png'></button></td>";
                                echo "<tr>";
                            }
                        }
                    }
            ?>
        </table> 
        <a href="addNewConcert.php" button id="button" >Add new concert</button>
    </div>
</body>
</html>