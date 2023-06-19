<?php

require "classes/DbConnect.php";
require "classes/Auth.php;";

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    // Check if the submit button has been clicked, and check if the fields ain't empty also
    if (isset($_POST['sign-in'])){

        if (!empty($_POST['username']) && !empty($_POST['password'])){
            if (User::authenticate($conn, $_POST['username'], $_POST['password'])){

                Auth::login();
                
                // redirect to the index page
                header('Location: http://localhost/hotel_room_reservation-app/admin.php');
                exit;

            } 
        }
    }
}

?>
