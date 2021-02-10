<?php
    require_once "config.php";
    $id = $_GET['username'];
    $concertid = $_GET["concert_id"];
    $sql = "SELECT * from concert where id =$concertid";
    $result = $link->query($sql);
    $row = $result->fetch_assoc();
    // Check if the user is already logged in, if yes then redirect him to welcome page
    session_start();
    if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        header("location: adminlogin.php");
        exit;
    }
       
   if($_SERVER["REQUEST_METHOD"] == "POST"){
    $newname = $_POST["newname"];
    $newtype = $_POST["type"];
    $newdetails = $_POST["newdetails"];
    $newdate = $_POST["newdate"];
    $newstartTime = $_POST["newstartTime"];
    $newendTime = $_POST["newendTime"];
    $target_dir = "image/";
    $target_file = $target_dir.uniqid().basename($_FILES['fileToUpload']['name']);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    $checktime = "SELECT * from concert WHERE DATE(date) = '$newdate' AND id != $concertid";
    $result = mysqli_query($link,$checktime);
    while($row = mysqli_fetch_assoc($result)){        
        if($row["name"] !=  "$newname"){
            if($startTime>=$row["start_time"] &&$startTime <=$row["end_time"]){
                    header("Location: addNewConcert.php?username=$id&submit=start_time_clash");
                    exit();
            } elseif($endTime<=$row["end_time"]&& $endTime>=$row["start_time"]  ){
                header("Location: addNewConcert.php?username=$id&submit=end_time_clash");
                exit();
            } elseif($row["start_time"]>=$startTime && $row["start_time"]<=$endTime) {
                header("Location: addNewConcert.php?username=$id&submit=end_time_clash");
                exit();
            } elseif($row["end_time"]>=$startTime && $row["end_time"]<=$endTime){
                header("Location: addNewConcert.php?username=$id&submit=end_time_clash");
                exit();
            }
        } else {
            header("Location: addNewConcert.php?username=$id&submit=concert_name_clash");
            exit();
        }
    }

        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

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
                header("Location: editConcertpage.php?username=$id&concert_id=$concertid&submit=file_upload_error");
                exit();
              // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                  echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
                  $upfile = "UPDATE concert SET image_path = '$target_file' WHERE id = $concertid";
                  if(mysqli_query($link,$upfile)){
                    echo "Record updated successfully";
                  }else{
                    echo "Error updating record: " . mysqli_error($link); 
                  }
                
                } else {
                  echo "Sorry, there was an error uploading your file.";
                }
            }

    
    $edit = "UPDATE concert SET name = '$newname', type = '$newtype', details = '$newdetails', date = '$newdate',
    start_time = '$newstartTime',
    end_time = '$newendTime'
    WHERE id = $concertid";
    
    if(mysqli_query($link,$edit)){
        echo "Record updated successfully";
        header("Location: editConcertpage.php?username=$id&concert_id=$concertid&submit=success");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($link);
    }
}

if(isset($_GET["submit"])){
    if(strcmp($_GET["submit"], "success") == 0){
        echo "<script>";
        echo "window.alert('Successfully editted');";
        echo "window.location = './adminHomepage.php?"."username=".$_GET['username']."';";
        echo "</script>";
    }else if(strcmp($_GET["submit"], "start_time_clash") == 0){
        echo "<script>";
        echo "window.alert('Please pick another date or start time, it is clashed with other concert.');";
        echo "</script>";
    }else if(strcmp($_GET["submit"], "end_time_clash") == 0){
        echo "<script>";
        echo "window.alert('Please pick another date or end time, it is clashed with other concert.');";
        echo "</script>";
    }else if(strcmp($_GET["submit"], "concert_name_clash") == 0){
        echo "<script>";
        echo "window.alert('Please pick another concert name, it is clashed with other concert.');";
        echo "</script>";
    }else if(strcmp($_GET["submit"], "file_upload_error") == 0){
        echo "<script>";
        echo "window.alert('Please ensure the file you upload is an image, png/jpg/jpeg/gif type file and less than 5MB.');";
        echo "</script>";
    } 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./cssfile/headerstyle.css">
    <link rel="stylesheet" href="./cssfile/styleAddNewConcert.css">
</head>
<body>
    <?php include "adminHeader.php" ?>
    <?php include "adminNavigation.php" ?>
    <div class="heading">
        <h3>Edit Concert</h3>
    </div>
    <div class="mainbox">

        <form action="<?php $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']?>" method="POST"  enctype="multipart/form-data">
            <div>
                <label>Name</label>
                <input type="text" name="newname" maxlength="18" value="<?php 
                
                echo $row["name"]?>" required>
            </div>
            <div class="opt">
                <label>Type</label>
                <select name="type" id="type">
                    <option value="Classical">Classical</option>
                    <option value="Threatical">Threatical</option>
                    <option value="Recital">Recital</option>
                 </select>
            </div>
            <div>
                <label>Details</label>
                <?php $string = $row["details"]; ?>
                <input type="text" name="newdetails" value="<?php echo $string;?>" maxlength="255" required>
            </div>
            <div>
                <label>Date</label>
                <input type="date" name="newdate" value=<?php echo $row["date"]?> required>
            </div> 
            <div>
                <label>Start Time</label>
                <input type="time" name="newstartTime" value=<?php echo $row["start_time"]?> required> 
            </div>
            <div>
                <label>End Time</label>
                <input type="time" name="newendTime" value=<?php echo $row["end_time"]?> required>
            </div>
            <div>
                <label>Poster</label>
                <br>
                <label>Select image to upload:</label>
                <input type="file" name="fileToUpload" id="fileToUpload" required>     
            </div>
            <div>
             <input type="submit" id="submit" value="Edit">
            </div>  
        </form>
   
    </div>
</body>
</html>