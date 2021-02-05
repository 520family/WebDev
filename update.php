<?php
        session_start();
        require_once "config.php";
        $id = $_GET["username"];
        $concert_id = $_GET["concert_id"];
        if(isset($_POST['selected_seat'])) {
            $selected_seats = $_SESSION['seats'];
            $seat_price = $_SESSION['price'];
            $total_price = $_SESSION["total_price"];
            $index = 0;
            $selected_seats = $_POST['selected_seat']; 
            foreach($selected_seats as $selected_seat){
                $selected_seat = "SELECT * from seat WHERE id = '$selected_seat'";
                if($result = mysqli_query($link, $selected_seat)){
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_array($result)){  
                            array_push($seat_price, $row["price"]);
                            $total_price = $total_price + $row["price"];
                        }
                    }
                }
            }
        } else {
        
                echo "
                    <script type=\"text/javascript\">
                    alert('You do not select a seat');
                    </script>
                ";  
        }
        $_SESSION["seats"] = $selected_seats;
        $_SESSION["price"] = $seat_price;
        $_SESSION["total_price"] = $total_price;
        header("Location: ConcertDetails.php?username=$id&concert_id=$concert_id");
?>