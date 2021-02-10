<?php
    include_once 'config.php';
    session_start();
    $id=$_GET['username'];
    $ses_sql=mysqli_query($link,"select user_id from user where user_id='$id'");
    $row=mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
    $loggedin_id=$row['user_id'];
    if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        header("location: loginpage.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./cssfile/headerstyle.css">
    <link rel="stylesheet" href="./cssfile/footerstyle.css">
    <link rel="stylesheet" href="./cssfile/styleMyProfile.css">
    
</head>
<?php
$sql= "select * FROM user where user_id='$loggedin_id'";
$result=mysqli_query($link,$sql);
$rows=mysqli_fetch_array($result)
?>
<body>
    <?php include "userHeader.php" ?>
    <?php include "userNavigation.php" ?>
    <div class="heading">
        <h3 class="myprofileheading">My Profile</h3>
    </div>
    <div class="mainbox">
        <table>
            <tr>
                <td>First Name</td>
                <td class="content"><?php echo $rows['first_name']; ?></td>
            </tr>
            <tr>
                <td>Last Name</td>
                <td class="content"><?php echo $rows['last_name']; ?></td>
            </tr>
            <tr>
                <td>Address</td>
                <td class="content"><?php echo $rows['address']; ?></td>
            </tr>
            <tr>
                <td>Phone Number</td>
                <td class="content"><?php echo $rows['phone_num']; ?></td>
            </tr>
        </table>
    </div>
    <?php include "footer.html"?>
</body>
</html>