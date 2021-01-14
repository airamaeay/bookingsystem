<?php
    session_start();
    require "config.php";
    require "variables.php";
    require "must-have-ticket.php";
    if(isset($_GET['service_id']) && isset($_GET['inquiring_id']) && isset($_GET['booking_id'])){
        if(isset($_GET['message'])){
            $user_id = $user['id'];
            $message = sanitize($con,$_GET['message']);
            $book_id = sanitize($con,$_GET['booking_id']);
            $result = mysqli_query($con,"SELECT * FROM books WHERE id = '$book_id'");
            $book = mysqli_fetch_array($result,MYSQLI_ASSOC);
            if($book['status']=='7'){
                echo json_encode("reported");
                exit;
            }
            if($message != ""){
                mysqli_query(
                    $con,
                    "INSERT INTO `messages`
                    (`message`, `sender`, `booking`, `created`, `modified`, `seen`) VALUES
                    ('$message','$user_id','$book_id',NOW(),NOW(),'0')");
            }
        }

        $last_id = sanitize($con,$_GET['last_id']);
        $service_id = sanitize($con,$_GET['service_id']);
        $booking_id = sanitize($con,$_GET['booking_id']);
        $inquiring_id = sanitize($con,$_GET['inquiring_id']);
        $result = mysqli_query($con,
            "SELECT 
                m.*,
                b.*,
                s.*,
                u.id this_user_id,
                u.online_status,
                us.picture user_picture,
                m.id message_id,
                bs.status bs_status,
                bs.color bs_color,
                bs.action bs_action
            FROM messages m
                LEFT JOIN books b
                    ON m.booking = b.id
                LEFT JOIN services s
                    ON b.service = s.id
                LEFT JOIN users u
                    ON b.consumer = u.id
                LEFT JOIN users us
                    ON m.sender = us.id
                LEFT JOIN booking_status bs
                    ON b.status = bs.id
            WHERE s.id = '$service_id' AND u.id = '$inquiring_id' AND m.id > '$last_id' AND b.id = '$booking_id'
        ");
        $messages = mysqli_fetch_all($result,MYSQLI_ASSOC);
        echo json_encode(array("data"=>$messages,"id"=>$user['id'],"booking_id"=>$booking_id));
    }
    
    ?>