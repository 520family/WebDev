<?php
    require_once "config.php";
    $id = $_GET['username'];
    $concertid = $_GET["concert_id"];
    $sql = "SELECT * from concert where id =$concertid";
    $result = $link->query($sql);
    $row = $result->fetch_assoc();
    // Check if the user is already logged in, if yes then redirect him to welcome page
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        header("location: adminHomepage.php");
        exit;
    }
       
   if($_SERVER["REQUEST_METHOD"] == "POST"){
    $newname = $_POST["newname"];
    $newtype = $_POST["newtype"];
    $newdetails = $_POST["newdetails"];
    $newdate = $_POST["newdate"];
    $newstartTime = $_POST["newstartTime"];
    $newendTime = $_POST["newendTime"];
    $target_dir = "image/";
    $target_file = $target_dir.uniqid().basename($_FILES['fileToUpload']['name']);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    $checktime = "SELECT * from concert WHERE DATE(date) = '$newdate' AND id <> '$concertid'";
    $result = mysqli_query($link,$checktime);
    while($row = mysqli_fetch_assoc($result)){        
        if($row["name"] != "$newname"){
            if($row["date" ]== "$newdate"){
               if($row["start_time"]>=$newstartTime && $row["start_time"]<=$newendTime){
                    header("Location: editConcert.php?username=$id&concert_id=$concertid&submit=start_time_clash");
                    exit();
                } elseif($row["end_time"]<=$newendTime && $row["end_time"] >= $newstartTime){
                    header("Location: editConcert.php?username=$id&concert_id=$concertid&submit=end_time_clash");
                    exit();
                } 
            } 
        } 
    }

    if(empty($newname) || empty($newdetails) || empty($newdate) || empty($newstartTime) || empty($newendTime) || empty($_FILES['fileToUpload']['name'])){
        header("Location: editConcert.php?username=$id&concert_id=$concertid&submit=empty");
        exit();
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
            $uploadOk = 1;
        }

            if ($uploadOk == 1) {
                header("Location: editConcert.php?username=$id&concert_id=$concertid&submit=file_upload_error");
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
        header("Location: editConcert.php?username=$id&concert_id=$concertid&submit=success");
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
    }
    if(strcmp($_GET["submit"], "empty") == 0){
        echo "<script>";
        echo "window.alert('Please fill in all required fields');";
        echo "window.location = './editConcert.php?"."username=".$_GET['username']."&concert_id=".$concertid."'';";
        echo "</script>";
    }else if(strcmp($_GET["submit"], "start_time_clash") == 0){
        echo "<script>";
        echo "window.alert('Please pick another date or start time, it is clashed with other concert.');";
        echo "window.location = './editConcert.php?"."username=".$_GET['username']."&concert_id=".$concertid."'';";
        echo "</script>";
    }else if(strcmp($_GET["submit"], "end_time_clash") == 0){
        echo "<script>";
        echo "window.alert('Please pick another date or end time, it is clashed with other concert.');";
        echo "window.location = './editConcert.php?"."username=".$_GET['username']."&concert_id=".$concertid."'';";
        echo "</script>";
    }else if(strcmp($_GET["submit"], "concert_name_clash") == 0){
        echo "<script>";
        echo "window.alert('Please pick another concert name, it is clashed with other concert.');";
        echo "window.location = './editConcert.php?"."username=".$_GET['username']."&concert_id=".$concertid."';";
        echo "</script>";
    }else if(strcmp($_GET["submit"], "file_upload_error") == 0){
        echo "<script>";
        echo "window.alert('Please ensure the file you upload is an image, png/jpg/jpeg/gif type file and less than 5MB.');";
        echo "window.location = './editConcert.php?"."username=".$_GET['username']."concert_id=".$concertid."';";
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
    <a href="logout.php" class="logout-button"><img src="./image/logout.png"></a>
</head>
<body>
    <?php include "adminHeader.html" ?>
    <?php include "adminNavigation.php" ?>
    <div class="heading">
        <h3>Edit Concert</h3>
    </div>
    <div class="mainbox">

        <form action="<?php $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']?>" method="POST"  enctype="multipart/form-data">
            <div>
                <label>Name</label>
                <input type="text" name="newname" value=<?php 
                
                echo $row["name"]?>>
            </div>
            <div>
                <label>Type</label>
                <input type="text" name="newtype" value=<?php echo $row["type"]?>>
            </div>
            <div>
                <label>Details</label>
                <?php $string = $row["details"]; ?>
                <input type="text" name="newdetails" value="<?php echo $string;?>">
            </div>
            <div>
                <label>Date</label>
                <input type="date" name="newdate" value=<?php echo $row["date"]?>>
            </div> 
            <div>
                <label>Start Time</label>
                <input type="time" name="newstartTime" value=<?php echo $row["start_time"]?>> 
            </div>
            <div>
                <label>End Time</label>
                <input type="time" name="newendTime" value=<?php echo $row["end_time"]?>>
            </div>
            <div>
                <label>Select image to upload:</label>
                <input type="file" name="fileToUpload" id="fileToUpload">     
            </div>
            <div>
             <input type="submit" id="submit" value="Edit">
            </div>  
        </form>
   
    </div>
</body>
</html>