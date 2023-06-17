<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    // Check if the submit button has been clicked, and check if the fields ain't empty also
    if (isset($_POST['sign-in'])){

        if (!empty($_POST['username']) && !empty($_POST['password'])){
            if ($_POST['username'] == 'lexiscode' && $_POST['password'] == 'secret123'){

                // this helps prevent session fixation attacks
                session_regenerate_id(true);

                $_SESSION['is_logged_in'] = true;
                
                // redirect to the index page
                header('Location: http://localhost/hotel_room_reservation-app/admin.php');
                exit;

            } 
        }
    }
}

?>
