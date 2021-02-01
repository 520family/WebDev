
<?php 
    
require_once 'config.php';

$user_id = $password  = "";
$userid_err = $password_err = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $user_id = user_input($_POST["userid"]);
    $password = user_input($_POST["password"]);
    $lastname = user_input($_POST["lastname"]);
    $firstname = user_input($_POST["firstname"]);
    $address = user_input($_POST["address"]);
    $phone = user_input($_POST["phone"]);

    if(empty($user_id) || empty($password) ||  empty($lastname) ||
    empty($firstname)  ||  empty($address) ||  empty($phone) ){
        echo '<script language="javascript">';
        echo 'alert("Please Fill all field require.")';
        echo '</script>';
    } else {
        $slc = "SELECT * FROM table WHERE user_id='$user_id'";
        $result = mysqli_query($link,$slc);
        //$rowcount=mysqli_num_rows($result);

        if($result){
            echo '<script language="javascript">';
            echo 'alert("User Id taken.")';
            echo '</script>';
        } else {
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO user (user_id, password, first_name, last_name, address, phone_num) 
            VALUES ('$user_id',  '$param_password','$firstname','$lastname', '$address','$phone')";
            if ($link->query($sql) === TRUE) {
                header("location: loginpage.php");
            } else {
                echo "Error: " . $sql . "<br>" . $link->error;
            }
         }
    }
}

function user_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="autstyle.css">

</head>

<body>

<?php include 'header.php'; ?>
    <section class="cover">

    </section>
    <div class="form">
        <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
            <p>Register</p>
            <input class="input1" type="text" name="userid" placeholder="User ID" required></input>
            <input class="input1" type="text" name="firstname" placeholder="First Name" required></input>
            <input class="input1" type="text" name="lastname" placeholder="Last Name" required></input>

            <input class="input1" type="Password" name="password" placeholder="Password" required></input>
           
            <input class="input1" type="text" name="address" placeholder="Address" required></input>
            <input class="input1" type="text" name="phone" placeholder="Phone Number" required></input>
        
            <div class="btn_container">


                <button type="submit" class="btn">Sign up</button>


                <button type="reset" class="btn">Cancel</button>
            </div>
        </form>

    </div>
</body>






</html>