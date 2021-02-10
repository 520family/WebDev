<?php 

    require_once "config.php";
    session_start();
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: adminlogin.php");
    exit;
}

    $id = $_GET['username'];
    if(isset($_POST['submit'])){
        $name =$_POST['name'];
        $type =$_POST['type'];
        $details =$_POST['details'];
        $date =$_POST['date'];
        $startTime =$_POST['startTime'];
        $endTime =$_POST['endTime'];
        $adminID  = $id; //hard code
        $target_dir = "image/";
        $target_file = $target_dir.uniqid().basename($_FILES['fileToUpload']['name']);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $checktime = "SELECT * from concert WHERE DATE(date) = '$date'";
        $result = mysqli_query($link,$checktime);
        while($row = mysqli_fetch_assoc($result)){        
            if($row["name"] != $name){
                if($startTime>=$row["start_time"] &&$startTime <=$row["end_time"]){
                        header("Location: addNewConcert.php?username=$id&submit=start_time_clash");
                        exit();
                } elseif($endTime<=$row["end_time"]&& $endTime>=$row["start_time"]  ){
                    header("Location: addNewConcert.php?username=$id&submit=end_time_clash");
                    exit();
                }
            } else {
                header("Location: addNewConcert.php?username=$id&submit=concert_name_clash");
                exit();
            }
        }

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

        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

            if ($uploadOk == 0) {
                header("Location: addNewConcert.php?username=$id&submit=file_upload_error");
                exit();
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
                mysqli_stmt_bind_param($stmt, "sssssss", $name, $type, $date, $startTime, $endTime, $adminID, $target_file);
                mysqli_stmt_execute($stmt);
            }    
            header("Location: addNewConcert.php?username=$id&submit=success");
            exit();
    }
    else{
        header("Location: addNewConcert.php");
        exit();
    }
    mysqli_close($link);
?>
