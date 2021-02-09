<div class=top>
    <img class="logo" src="image/logo.png">
    <?php require_once "config.php" ?>
    <?php
    $uname = $_GET['username'];
    $sql = "SELECT first_name from admin WHERE id = '$uname'";
    $qresult = mysqli_query($link,$sql);
    $displayname = mysqli_fetch_array($qresult);
  ?>
  <b>Hello,<?php echo $displayname['first_name']?></b>
    
    <a href="logout.php" class="logout-button"><img src="./image/logout.png"></a>

</div>
