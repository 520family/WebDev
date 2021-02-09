<div class=top>
  <img class="logo" src="image/logo.png">
  <?php
    $uname = $_GET['username'];
    $sql = "SELECT first_name from user WHERE user_id = '$uname'";
    $qresult = mysqli_query($link,$sql);
    $displayname = mysqli_fetch_array($qresult);
  ?>
  <b>Hello,<?php echo $displayname['first_name']?></b>
  <a href="logout.php" class="logout-button"><img src="./image/logout.png"></a>
    <div class="row">
        <div class="column">
          <form action="process_search.php?username=<?php echo $id; ?>" id="reservation-form" method="post" onsubmit="myFunction()">
              <div class="field" >
                <input type="text"  placeholder="Search the Concert Name Here..."   id="search111" name="searching">
                <button value="search" alt="icon" id="topIcon"><img src ='image/search.png'></button>
                </div>       	
              </form>
              <div class="clear"></div>
        </div>
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
