<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
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
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <tr>
                <td>1001</td>
                <td>concert 1</td>
                <td><button id="button1"></button></td>
                <td><button id="button2"></button></td>
            </tr>
            <tr>
                <td>1002</td>
                <td>concert 2</td>
                <td><button id="button3"></button></td>
                <td><button id="button4"></button></td>
            </tr>
            <tr>
                <td>1003</td>
                <td>concert 3</td>
                <td><button id="button5"></button></td>
                <td><button id="button6"></button></td>
            </tr>
            <tr>
                <td>1004</td>
                <td>concert 4</td>
                <td><button id="button7"></button></td>
                <td><button id="button8"></button></td>
            </tr>
        </table> 
        <a href="addNewConcert.php" button id="button" >Add new concert</button>
    </div>
</body>
</html>