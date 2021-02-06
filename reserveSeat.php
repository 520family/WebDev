<?php
        session_start();
        require_once "config.php";
        $id = $_GET["username"];
        $concert_id = $_GET["concert_id"];
        $selected_seats = $_SESSION['selected_seats'];
        $total_price = $_SESSION['total_price'];
        $status = 0;
        $insert_reservation = "INSERT INTO reservation (user_id, status, concert_id, total_price) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($link);
        if(!mysqli_stmt_prepare($stmt, $insert_reservation)){
            echo "SQL error";
            exit();
        }else{
            mysqli_stmt_bind_param($stmt, "ssss", $id, $status, $concert_id, $total_price);
            mysqli_stmt_execute($stmt);
            $reservation_id = $link->insert_id;
            foreach($selected_seats as $selected_seat){
                $insert_reservation_seat = "INSERT INTO reservation_seat (seat_id, reservation_id) VALUES (?, ?)";
                $stmt_seat = mysqli_stmt_init($link);
                if(!mysqli_stmt_prepare($stmt_seat, $insert_reservation_seat)){
                    echo "SQL error";
                    exit();
                }else{
                    mysqli_stmt_bind_param($stmt_seat, "ss", $selected_seat, $reservation_id);
                     mysqli_stmt_execute($stmt_seat);
                }
            }
        }

        header("Location: ConcertDetails.php?username=$id&concert_id=$concert_id");
?> 