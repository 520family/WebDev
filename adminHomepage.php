<?php
require_once "config.php";
// Initialize the session
session_start();
$_SESSION['test']='test';
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: adminlogin.php");
    exit;
}

//$concerts = "SELECT id, name, type, date, start_time, end_time FROM concert WHERE admin_id = $_GET('id')";
    $id = $_GET["username"];
    $concerts = "SELECT id, name, type, date, start_time, end_time FROM concert WHERE admin_id = '$id'";

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="./cssfile/headerstyle.css">
    <link rel="stylesheet" href="./cssfile/styleAdmin.css">
    <a href="logout.php" class="logout-button">Logout</a>
</head>
<body>
    <?php include "adminHeader.html" ?>
    <?php include "adminNavigation.php" ?>
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
                                $conid = $row['id'];
                                echo "<tr>";    
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['name'] . "</td>";
                                echo "<td>" . $row['type'] . "</td>";
                                echo "<td>" . $row['date'] . "</td>";
                                echo "<td>" . $row['start_time'] . "</td>";
                                echo "<td>" . $row['end_time'] . "</td>";
                                echo "<td class='funcbtn'><a href='editConcert.php?username=".$id."&concert_id=".$row['id']."'><button><img src ='image/edit.png'></button></a></td>";
                                echo "<td class='funcbtn'><a href='deleteConcert.php?username=".$id."&concert_id=".$row['id']."'><button><img src ='image/bin.png'></button></a></td>";
                                echo "</form>";
                                echo "<tr>";
                            }
                        }
                    }
            ?>
        </table> 
        <!-- JY changed -->
        <a href="addNewConcert.php?username=<?php echo $id; ?>" button id="button" >Add new concert</a>
    </div>
</body>
</html>