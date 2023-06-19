<?php

require "classes/DbConnect.php";
require "classes/GetDataId.php";
require "classes/Auth.php";


// Initialize the session.
session_start();

// in this case of the admin page, you must be login to access this page
Auth::requireLogin();

// connect to the database server
$conn = new DbConnect();
$conn->getConn();

// READING or RETRIEVING from the database to get specific article post by their ids
if (isset($_GET['id'])){

    // checks if the article's id exits in the database, then returns an associative array, which stores in $article variable
    $customer_data = GetDataId::getDataById($conn, $_GET['id']); 

    if (!$customer_data){
        // if a non-existing id number is in the link
        die("Invalid ID. No data found");
    }

} else {
    // if no id is in the link
    die("ID not supplied. No data found");
}



// REPEAT VALIDATION, no need declaring $title, $content, or $date_published variables again here
if ($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if the save/submit button has been clicked, and check if the fields ain't empty also
    if (isset($_POST['reserve_now'])){
        if (!empty($_POST['customer_name']) && !empty($_POST['room_type']) && !empty($_POST['booking_date']) && !empty($_POST['booking_time'])){

            // getting fields contents, then checking for possible empty fields
            //$id = $customer_data['id'];  gets id for which we wish to edit from
            $customer_data->customer_name = $_POST['customer_name'];
            $customer_data->room_type = $_POST['room_type'];
            $customer_data->booking_date = $_POST['booking_date'];
            $customer_data->booking_time = $_POST['booking_time'];

            // UPDATE PDO query
            $result = $customer_data->updateData($conn);

            if ($result){
                // it is more advisable to use absolute paths below than relative path
                header("Location: http://localhost/hotel_room_reservation-app/admin.php"); // get id for which we wish to edit from
                exit;
            }
            
        }
    }
}



?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HOTEL BOOKING APP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  </head>
  <body style="background-color: #025464">

    <div class="container">
        <!--Introduction header-->
        <h1 class="text-center my-4 py-4" style="font-family: Tahoma, Verdana, Segoe, sans-serif; color: white">Hotel Room Reservation System</h1>
        <h2 class="text-center my-4 py-4" style="font-family: Tahoma, Verdana, Segoe, sans-serif; color: blue">Update Customer Data</h2>

        <form action="" method="POST">
            <div class="w-50 m-auto">
                <label for="name" style="color: white">Name:</label>
                <input class="form-control" type="text" name="customer_name" id="name" value="<?= htmlspecialchars($customer_data->customer_name); ?>" placeholder="Enter Your Full Name">
                <br>

                <label for="room_type" style="color: white">Room Type:</label> <br>
                <select class="form-control" name="room_type" id="room_type">
                    <?php
                    $room_types = ["Regular", "Deluxe", "Smoking Room", "Standard Suite", "Villa Suite", "Presidental Suite"];

                    foreach ($room_types as $type) {
                        $selected = ($type === $customer_data->room_type) ? "selected" : "";
                        echo "<option value='$type' $selected>$type</option>";
                    }
                    ?>
                </select>
                <br>
                
                <label for="due_date" style="color: white">Date:</label>
                <input class="form-control" type="date" name="booking_date" id="due_date" value="<?= $customer_data->booking_date ?>">
                <br>
                <label for="set_time" style="color: white">Set Time:</label>
                <input class="form_control" type="time" name="booking_time" id="set_time" value="<?= $customer_data->booking_time ?>" placeholder='hh:mm'>

            </div>
            <br> 

            <div class="container text-center">
                <div class="row">
                    <!-- GRID 1 -->
                    <div class="col">
                        <div align="center">
                            <button type="submit" class="btn btn-primary" name="reserve_now" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">
                            Reserve Now!
                            </button>
                        </div>
                    </div>       
                </div>
            </div>
        </form>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>