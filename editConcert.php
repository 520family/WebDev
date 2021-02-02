<?php
    require_once "config.php";
    $admin = $_GET['adminid'];
    $concertid = $_GET['concertid'];
    $sql = "SELECT * from concert where id =$concertid";
    $result = $link->query($sql);
    $row = $result->fetch_assoc();

       
   if($_SERVER["REQUEST_METHOD"] == "POST"){
    $newname = $_POST["newname"];
    $newdetails = $_POST["newdetails"];
    $newdate = $_POST["newdate"];
    $newstartTime = $_POST["newstartTime"];
    $newendTime = $_POST["newendTime"];
    if(!empty($a = $_FILES["fileToUpload"])){
        $target_dir = "image/";
        $target_file = $target_dir.basename($_FILES['fileToUpload']['name']);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
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
    }
    
    $edit = "UPDATE concert SET name = '$newname', type = '$newdetails', date = '$newdate',
    start_time = '$newstartTime',
    end_time = '$newendTime' 
    WHERE id = $concertid";
    
    if(mysqli_query($link,$edit)){
        echo "Record updated successfully";
        header("location: adminHomepage.php?username=$admin");

    } else {
        echo "Error updating record: " . mysqli_error($link);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styleAddNewConcert.css">
</head>
<body>
    <?php include "adminHeader.html" ?>
    <?php include "adminNavigation.php" ?>
    <div class="heading">
        <h3>Add New Concert</h3>
    </div>
    <div class="mainbox">
        <form action="<?php $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']?>" method="POST"  enctype="multipart/form-data">
            <h4>Name</h4>
            <input type="text" name="newname" value=<?php echo $row["name"]?>>
            <h4>Details</h4>
            <input type="text" name="newdetails" value=<?php echo $row["type"]?>>
            <h4>Date</h4>
            <input type="date" name="newdate" value=<?php echo $row["date"]?>>
            <div class="row">
                <div class="column">
                    <h4>Start Time</h4>
                </div>
                <div class="column">
                    <h4>End Time</h4>
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <input type="time" name="newstartTime" value=<?php echo $row["start_time"]?>> 
                </div>
                <div class="column">
                    <input type="time" name="newendTime" value=<?php echo $row["end_time"]?>>
                </div>
            </div>
            <?php
                echo 'Select image to upload:';
                echo '';
            ?>
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="submit" id="submit" value="Edit">
        </form>
        
    </div>
</body>
</html>