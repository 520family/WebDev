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
        $target_dir = "image/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        echo "File is not an image.";
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
        if(empty($name) || empty($details) || empty($date) || empty($startTime) || empty($endTime)){
            header("Location: addNewConcert.php?submit=empty");
            exit();
        }
        else{
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
              // if everything is ok, try to upload file
              } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                  echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
                } else {
                  echo "Sorry, there was an error uploading your file.";
                }
              }
            $sql = "INSERT INTO concert(name, type, date, start_time, end_time, admin_id, image_path)VALUES(?, ?, ?, ?, ?, ?, ?);";
            $stmt = mysqli_stmt_init($link);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                echo "SQL error";
                exit();
            }else{
                mysqli_stmt_bind_param($stmt, "ssssss", $name, $details, $date, $startTime, $endTime, $adminID, $target_file);
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
