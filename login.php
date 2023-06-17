<?php

/*
// Check if admin login button is clicked
if (isset($_POST['admin_login'])){
    if (!empty($_POST['passcode'])){
        $passcode = "mqwW!8V#O452";
        if ($_POST['passcode'] === $passcode){
            // Redirect to the admin page
            header("Location: admin.php");
            exit; // Make sure to call exit after the redirect
        }else{
            // Redirect to back to the homepage
            header("Location: index.php");
            exit; // Make sure to call exit after the redirect
        }
    }
}
*/



if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    // Check if the submit button has been clicked, and check if the fields ain't empty also
    if (isset($_POST['sign-in'])){

        if (!empty($_POST['username']) && !empty($_POST['password'])){
            if ($_POST['username'] == 'lexiscode' && $_POST['password'] == 'secret123'){

                // this helps prevent session fixation attacks
                session_regenerate_id(true);

                $_SESSION['is_logged_in'] = true;
                
                // redirect to the index page
                header('Location: http://localhost/hotel_room_reservation/admin.php');
                exit;

            } 
        }
    }
}

?>
