<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<div class=top>
  <img class="logo" src="image/logo.png">
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
