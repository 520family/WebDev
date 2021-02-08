<?php
require_once "config.php";
    session_start();
    $id = $_GET['username'];
    $concertid = $_GET["concert_id"];
    $sql = "SELECT * from concert where id =$concertid";
    $result = $link->query($sql);
    $row = $result->fetch_assoc();
       
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
                        header("Location: editConcertpage.php?username=$id&concert_id=$concertid&submit=start_time_clash");
                        exit();
                    } elseif($row["end_time"]<=$newendTime && $row["end_time"] >= $newstartTime){
                        header("Location: editConcertpage.php?username=$id&concert_id=$concertid&submit=end_time_clash");
                        exit();
                    } 
                } 
            } 
        }
    
        if(empty($newname) || empty($newdetails) || empty($newdate) || empty($newstartTime) || empty($newendTime) || empty($_FILES['fileToUpload']['name'])){
            header("Location: editConcertpage.php?username=$id&concert_id=$concertid&submit=empty");
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
?>