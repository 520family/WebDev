<?php
    include_once 'config.php';
    session_start();
    $id=$_GET['username'];
    $ses_sql=mysqli_query($link,"select user_id from user where user_id='$id'");
    $row=mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
    $loggedin_id=$row['user_id'];
    if(!isset($loggedin_id) || $loggedin_id==NULL) {
        echo "Go back";
        header("Location: loginpage.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styleMyProfile.css">
    <a href="logout.php" class="logout-button">Logout</a>
</head>
<?php
$sql= "select * FROM user where user_id='$loggedin_id'";
$result=mysqli_query($link,$sql);
?>
<?php
while($rows=mysqli_fetch_array($result)){
?>
<body>
    <?php include "userHeader.php" ?>
    <?php include "userNavigation.php" ?>
    <div class="heading">
        <h3>Heading - My Profile</h3>
    </div>
    <div class="mainbox">
        <div class="row">
            <div class="column">
                <h4>first name</h4>
            </div>
            <div class="column">
                <div class="content1">
                <?php echo $rows['first_name']; ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="column">
                <h4>last name</h4>
            </div>
            <div class="column">
                <div class="content2">
                <?php echo $rows['last_name']; ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="column">
                <h4>address</h4>
            </div>
            <div class="column">
                <div class="content3">
                <?php echo $rows['address']; ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="column">
                <h4>phone number</h4>
            </div>
            <div class="column">
                <div class="content4">
                <?php echo $rows['phone_num']; ?>
                </div>
            </div>
        </div>
        <?php 
        // close while loop 
        }
        ?>
    </div>
</body>
</html>