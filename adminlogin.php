<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link rel="stylesheet" type="text/css" href="./cssfile/autstyle.css">
    <link rel="stylesheet" type="text/css" href="./cssfile/footerstyle.css">
<?php 
    require_once "config.php";

    session_start();
 
    // Check if the user is already logged in, if yes then redirect him to welcome page
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        header("location: adminHomepage.php");
        exit;
    }
     
    // Include config file
     
    // Define variables and initialize with empty values
    $username = $password = "";
    $username_err = $password_err = "";
     
    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
     
        // Check if username is empty
        if(empty(trim($_POST["username"]))){
            $username_err = "Please enter your username.";
        } else{
            $username = trim($_POST["username"]);
        }
        
        // Check if password is empty
        if(empty(trim($_POST["password"]))){
            $password_err = "Please enter your password.";
        } else{
            $password = trim($_POST["password"]);
        }
        
        // Validate credentials
        if(empty($username_err) && empty($password_err)){
            // Prepare a select statement
            $sql = "SELECT id, password FROM admin WHERE id = ?";
            
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_username);
                
                // Set parameters
                $param_username = $username;
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Store result
                    mysqli_stmt_store_result($stmt);
                    
                    // Check if username exists, if yes then verify password
                    if(mysqli_stmt_num_rows($stmt) == 1){                    
                        // Bind result variables
                        mysqli_stmt_bind_result($stmt, $id, $hashed_password);
                        if(mysqli_stmt_fetch($stmt)){
                            if(strcmp($password, $hashed_password) == 0){
                                // Password is correct, so start a new session
                                session_start();
                                
                                // Store data in session variables
                                $_SESSION["loggedin"] = true;
                                $_SESSION["username"] = $id;   
                                $_GET["username"] = $id;                        
                                //?id=.$_SESSION['username']."
                                // Redirect user to welcome page
                                header("location: adminHomepage.php?username=$id");
                            } else{
                                // Display an error message if password is not valid
                                $password_err = "The password you entered was not valid.";
                            }
                        }
                    } else{
                        // Display an error message if username doesn't exist
                        $username_err = "No account found with that username.";
                    }
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
    
                // Close statement
                mysqli_stmt_close($stmt);
            }
        }
        
        // Close connection
        mysqli_close($link);
    }
?>
</head>

<body>
    <header>
    <img class="logo" src="image/logo.png">

    </header>
    <section class="cover">

    </section>
    <?php include "footer.html"?>

    <div class="login_form">
        <h2 class="header">Admin Login Page</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <input class="input1" type="text" name="username" placeholder="Username" required></input>
                <span class="help-block"><?php echo $username_err; ?></span>

                <input class="input1" type="Password" name="password" placeholder="Password" required></input>
                <span class="help-block"><?php echo $password_err; ?></span>

            <div class="btn_container">
                <input type="submit" class="btn btn-primary" value="Login">
                <input type="button" class="btn btn-primary"  onclick="location.href='loginpage.php'" value ="Back"></input>
            </div>
        </form>

    </div>
</body>






</html>
