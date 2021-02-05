<?php
    echo "aaa";
    exit();
    $selected_seats = $_POST['selected_seat'];  
    echo $selected_seats;
    exit();
        foreach($selected_seats as $selected_seat){
                echo $selected_seat;
                exit();
        }

        if(isset($_POST['selected_seat'])) {
            $selected_seats = $_POST['selected_seat']; 
        
            echo "You chose the following color(s): <br>";
            foreach ($selected_seats as $selected_seat){
            echo $selected_seat;
            }} // end brace for if(isset
        
            else {
        
            echo "You did not choose a color.";
        
            }
?>