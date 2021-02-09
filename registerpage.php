
<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$user_id = $password = "";
$userid_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["userid"]))){
        $userid_err = "Please enter a user id.";
    } else{
        // Prepare a select statement
        $sql = "SELECT user_id FROM user WHERE user_id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_userid);
            
            // Set parameters
            $param_userid = trim($_POST["userid"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $userid_err = "This user id is already taken.";
                } else{
                    $user_id = trim($_POST["userid"]);
                }
            } else{
               $err_msg = "Oops! Something went wrong. Please try again later.";
               echo "<script type='text/javascript'>alert('$err_msg');";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Check input errors before inserting in database
    if(empty($userid_err) && empty($password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO user (user_id, password, first_name, Last_name, address, phone_num) VALUES (?,?,?,?,?,?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssss", $param_username, $param_password,$fname,$lname,$address,$phone);
            
            // Set parameters
            $param_username = $user_id;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $fname = $_POST["firstname"];
            $lname = $_POST["lastname"];
            $address = $_POST["address"];
            $phone = $_POST["phone"];
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                $message = "Register Successfully";
                echo "<script type='text/javascript'>alert('$message');";
                echo 'window.location= "loginpage.php"</script>';
            } else{
                $err_msg = "Oops! Something went wrong. Please try again later.";
                echo "<script type='text/javascript'>alert('$err_msg');";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="./cssfile/autstyle.css">
    <link rel="stylesheet" type="text/css" href="./cssfile/footerstyle.css">

</head>

<body>
    <header>
        <img class="logo" src="image/logo.png">
    </header>
    <section class="cover">

    </section>
    <?php include 'footer.html'; ?>
    <div class="login_form">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($userid_err)) ? 'has-error' : ''; ?>">
                <input class="input1" type="text" name="userid" placeholder="Username" maxlength="11">
                <span class="help-block"><?php echo $userid_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <input class="input1" type="password" name="password" placeholder="Password" maxlength="11">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div>
              <input class="input1" type="text" name="firstname" placeholder="First Name" maxlength="18">
            </div>
            <div>
              <input class="input1" type="text" name="lastname" placeholder="Last Name" maxlength="18">
            </div>
            <div>
              <input class="input1" type="text" name="address" placeholder="Address" maxlength="80">
            </div>
            <div>
              <input class="input1" type="number" name="phone" placeholder="Phone Number" maxlength="11">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Register">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="loginpage.php">Login here</a>.</p>
        </form>
    </div>


</body>

</html>
