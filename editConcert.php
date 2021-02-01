<?php
    require_once "config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styleAddNewConcert.css">
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
        <h3>Add New Concert</h3>
    </div>
    <div class="mainbox">
        <form action="">
            <h4>Name</h4>
            <input type="text" id="name">
            <h4>Details</h4>
            <input type="text" id="details">
            <h4>Date</h4>
            <input type="date" id="date">
            <div class="row">
                <div class="column">
                    <h4>Start Time</h4>
                </div>
                <div class="column">
                    <h4>End Time</h4>
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <input type="time" id="startTime">
                </div>
                <div class="column">
                    <input type="time" id="endTime">
                </div>
            </div>
            <input type="submit" id="submit" value="Add">
        </form>
        
    </div>
</body>
</html>