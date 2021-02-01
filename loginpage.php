<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="autstyle.css">
<?php 

    /*$mysqli = new mysqli("localhost","my_user","my_password","my_db");
    // Check connection
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
      }*/
?>
</head>

<body>

<?php include 'header.php'; ?>
    <section class="cover">

    </section>
    <div class="form">
        <form action="#" method="post">

            <input class="input1" type="text" name="username" placeholder="Username" required></input>


            <input class="input1" type="Password" name="password" placeholder="Password" required></input>

            <div class="btn_container">


                <button type="button" class="btn">Login</button>


                <button type="button" class="btn">Cancel</button>
                <span class="psw"><a href="#">Forgot password?</a></span>
            </div>
        </form>

    </div>
</body>






</html>