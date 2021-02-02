<?php 
    require_once "config.php";
    $id = $_GET['username'];
    if(isset($_POST['submit'])){
        $name =$_POST['name'];
        $details =$_POST['details'];
        $date =$_POST['date'];
        $startTime =$_POST['startTime'];
        $endTime =$_POST['endTime'];
        $adminID  = $id; //hard code
        if(empty($name) || empty($details) || empty($date) || empty($startTime) || empty($endTime)){
            header("Location: addNewConcert.php?submit=empty");
            exit();
        }
        else{
            header("Location: addNewConcert.php?submit=success");
            $sql = "INSERT INTO concert(name, type, date, start_time, end_time, admin_id)VALUES(?, ?, ?, ?, ?, ?);";
            $stmt = mysqli_stmt_init($link);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                echo "SQL error";
            }else{
                mysqli_stmt_bind_param($stmt, "ssssss", $name, $details, $date, $startTime, $endTime, $adminID);
                mysqli_stmt_execute($stmt);
            }    
            header("Location: addNewConcert.php?username=$id&submit=success");
            exit();
        }
    }
    else{
        header("Location: addNewConcert.php");
        exit();
    }
?>
