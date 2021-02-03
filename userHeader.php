<div class=top>
    <h2>Concert Ticketing System</h2>
    <div class="row">
        <div class="column">
          <form action="process_search.php?username=<?php echo $id; ?>" id="reservation-form" method="post" onsubmit="myFunction()">
             <fieldset>
              <div class="field" >
                                  <input type="text"  placeholder="Search the Concert Name Here..."   id="search111" name="searching">
                                  <input type="image" img src ="image/search.png" value="Search" alt="icon" id="topIcon">
            </div>       	
             </fieldset>
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
