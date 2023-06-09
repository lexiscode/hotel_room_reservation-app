<?php

require "classes/Auth.php";
require "classes/DbConnect.php";
require "classes/GetAll.php";
require "classes/GetDataId.php";

// Initialize the session.
session_start();

// in this case of the admin page, you must be login to access this page
Auth::requireLogin();

// Connect to the Database Server
$conn = new DbConnect();
$conn->getConn();

// READING FROM THE DATABASE AND CHECKING FOR ERRORS
$all_data = GetAll::getAll($conn);

// defining variables
$customer_name = '';
$room_type = '';
$booking_time = '';
$booking_date = '';

$customer_data = new GetDataId();

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    if (isset($_POST['reserve_now'])){
        if (!empty($_POST['customer_name']) && !empty($_POST['room_type']) && !empty($_POST['booking_date']) && !empty($_POST['booking_time'])){

            // getting fields contents, then checking for possible empty fields
            $customer_data->customer_name = $_POST['customer_name'];
            $customer_data->room_type = $_POST['room_type'];
            $customer_data->booking_date = $_POST['booking_date'];
            $customer_data->booking_time = $_POST['booking_time'];

            // INSERT into the database
            $results = $customer_data->newData($conn);

            // checking for errors, if none, then redirect the user to the new article page
            if ($results){
                
                // it is more advisable to use absolute paths below than relative path
                header("Location: http://localhost/hotel_room_reservation-app/admin.php"); 
                exit;
            }
        
        }else{
            $error = "No fields must be left empty.";
        }
    }
 
}


// Check if the "Clear All" button was clicked
if(isset($_POST['clear_all'])) {
    
    // SQL query to delete all data from the table
    // $sql = DELETE FROM rooms_record
    $sql = "TRUNCATE TABLE rooms_record";

    // Execute SQL query
    $conn->query($sql);

    header("Location: http://localhost/hotel_room_reservation-app/admin.php");
    exit;
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

        <div class="container text-center">
            <div class="row">
                <!-- GRID 1 -->
                <div class="col">
                    
                    <!-- Button trigger modal -->
                    <div align="right">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Reserve Now!
                        </button>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="" method="POST" autocomplete="off">
                        <div class="modal-content" style="background-color: gray">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel" style="color: white">Room Booking</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div class="w-50 m-auto">
                                <label for="name" style="color: white">Name:</label>
                                <input class="form-control" type="text" name="customer_name" id="name" placeholder="Enter Your Full Name" required>
                                <br>
                                <label for="room_type" style="color: white">Room Type:</label> <br>
                                <select class="form-control" name="room_type" id="room_type" required>
                                    <option selected="selected" value="Regular">Regular</option>
                                    <option value="Deluxe">Deluxe</option>
                                    <option value="Smoking Room">Smoking Room</option>
                                    <option value="Standard Suite">Standard Suite</option>
                                    <option value="Villa Suite">Villa Suite</option>
                                    <option value="Presidental Suite">Presidental Suite</option>
                                </select>
                                <br>
                                <label for="due_date" style="color: white">Date:</label>
                                <input class="form-control" type="date" name="booking_date" id="due_date" required>
                                <br>
                                <label for="set_time" style="color: white">Set Time:</label>
                                <input class="form_control" type="time" name="booking_time" id="set_time" placeholder='hh:mm' required>
            
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="reserve_now">Submit</button>
                        </div>
                        </div>
                        </form>
                    </div>
                    </div>

                </div>
                <!-- GRID 2 -->
                <div class="col" align="left">
                    
                    <form action="" method="POST">
                        <button type="submit" class="btn btn-secondary" name="clear_all">Clear Lists</button>
                    </form>
                
                </div>
            </div>
        </div>

        
        <br>

        <!--Horizontal line demacation-->
        <hr class="bg-dark w-50 m-auto">

        <!-- Table class="w-50 m-auto"-->
        <div class="container-fluid">
            
            <div style="margin: 25px 50px 25px 50px; background-color: black; color: white; border-radius:20px">
                <h1 align="center">Reservation Table</h1>
            </div>
            <table class="table table-dark table-hover">
                <thead align="center">
                    <tr>
                    <th scope="col">#ID</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Room Type</th>
                    <th scope="col">Booking Date</th>
                    <th scope="col">Booking Time</th>
                    <th scope="col">Action</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>

                <?php if (!empty($all_data)): ?>

                <tbody align="center">

                    <?php foreach ($all_data as $index => $data): ?>
                    <tr>
                        <td>RUM<?= $index + 1; ?></td> 
                        <td><?= htmlspecialchars($data["customer_name"]) ?></td> 
                        <td><?= htmlspecialchars($data["room_type"]) ?></td>
                        <td><?= htmlspecialchars($data["booking_date"]) ?></td>
                        <td><?= htmlspecialchars($data["booking_time"]) ?></td>
                        <td><a href="edit_data.php?id=<?= $data["id"]; ?>">Edit</a></td>
                        <td><a href="delete_data.php?id=<?= $data['id']; ?>">Delete</a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>

            <?php else: ?>
                <p style="color: white;">No articles found.</p>
            <?php endif; ?>

            </table>

            
            <div align="center">
                <i><a class="btn btn-link" href="index.php" role="button" style="color: white">Back to Homepage</a></i>
            </div>
            
        </div>
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>


