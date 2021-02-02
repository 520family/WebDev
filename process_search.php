<?php
require_once "config.php";
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
//$id = $_GET['username'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Concert Ticketing System</title>
    <link rel="stylesheet" href="style.css">
    <a href="logout.php" class="logout-button">Logout</a>
</head>
<body>
    <div class=top>
        <h2>Concert Ticketing System</h2>
				<div class="block">
        	<div class="wrap">
                <form action="process_search.php" id="reservation-form" method="post" onsubmit="myFunction()">
        		       <fieldset>
        		       	<div class="field" >
                                        <input type="text"  placeholder="Search Concepts Here..."  id="search111" name="searching">
                                        <input type="submit"   value="Search" name="search" id="button111">
            </div>
        		       </fieldset>
                    </form>
                    <div class="clear"></div>
           </div>
        </div>
        <script>
        function myFunction() {
             if($('#search111').val()=="")
                {
                    alert("Please enter a concert name...");//empty searchBar field
                }
          }
            </script>
    </div>
    <div class="topnav">
        <ul>
            <li><a href="myProfile.php?username=<?php echo $id; ?>" >My Profile</a></li>
            <li><a href="myReservation.php?username=<?php echo $id; ?>" >My Reservation</a></li>
            <li><a href="RecitalConcert.php?username=<?php echo $id; ?>" >Recital</a></li>
            <li><a href="ThreaticalConcert.php?username=<?php echo $id;?>">Threatical</a></li>
            <li><a href="ClassicalConcert.php?username=<?php echo $id;?>">Classical</a></li>
        </ul>
    </div>
	</div>
	<div class="content">
		<div class="wrap">
			<div class="content-top">
				<h3>Concerts</h3>
				<?php
							 $today=date("Y-m-d");
							 $search=$_POST['searching'];
							 $connection = mysqli_connect("localhost","root","");
							 $db = mysqli_select_db($connection,'concertbooking (3) (1)');
							 $name = $_POST['searching'];
							 $query = "SELECT * FROM concert where name='$name' ";
						 	$qry2=mysqli_query($connection,$query);
							if(isset($_POST['search'])){
								while($m=mysqli_fetch_array($qry2))
										 {
											?>
											<form action="" method="POST">
												$img_src = $m['image_path'];
												$concert_id = $m['id'];

											  echo "<a href='ConcertDetails.php?username=".$id."'&concert_id=".$concert_id."><img src=".$img_src."></a>";
											</form>

					<?php
						}
					}
						?>
		</div>
					<div class="clear"></div>
				</div>

    <script src="app.js"></script>
</body>
</html>
