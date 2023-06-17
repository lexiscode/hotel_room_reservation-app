<?php

require "includes/auth.php";
require "includes/db_connect.php";

// Initialize the session.
session_start();

// NB: This below will no longer be necessary if you won't be displaying the new article link page for non-login users
if (!isLoggedIn()){
    
    die("Unauthorized. You must be logged in first." . PHP_EOL . "<a href='index.php'>Back To Homepage</a>");
}


// connect to the database server
$conn = connectDB();

// READING FROM THE DATABASE AND CHECKING FOR ERRORS
$sql = "SELECT * 
        FROM rooms_record 
        ORDER BY booking_date, booking_time DESC;";

$results = mysqli_query($conn, $sql); 

$all_data = mysqli_fetch_all($results, MYSQLI_ASSOC);
// print_r($all_data);  prints an associative array


// Defining the variables in the global
$customer_name = '';
$room_type = '';
$booking_date = '';
$booking_time = '';

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    if (isset($_POST['reserve_now'])){
        if (!empty($_POST['customer_name']) && !empty($_POST['room_type']) && !empty($_POST['booking_date']) && !empty($_POST['booking_time'])){

            // getting fields contents, then checking for possible empty fields
            $customer_name = $_POST['customer_name'];
            $room_type = $_POST['room_type'];
            $booking_date = $_POST['booking_date'];
            $booking_time = $_POST['booking_time'];


            // the ADD functionality should go through if no errors (non-empty fields) are encountered 
            // connect to the database server
            $conn = connectDB();

            // inserts the data into the database server
            $sql = "INSERT INTO rooms_record (customer_name, room_type, booking_date, booking_time)
                    VALUES (?, ?, ?, ?)";

            // Prepares an SQL statement for execution
            $stmt = mysqli_prepare($conn, $sql);

            // Bind variables for the parameter markers in the SQL statement prepared
            mysqli_stmt_bind_param($stmt, "ssss", $customer_name, $room_type, $booking_date, $booking_time);

            // Executes a prepared statement
            $results = mysqli_stmt_execute($stmt);

            // it is more advisable to use absolute paths below than relative path
            header("Location: http://localhost/hotel_room_reservation-app/admin.php"); 
            exit;
            
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
                        <button type="submit" class="btn btn-secondary" name="clearLists">Clear Lists</button>
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
                        <td><?= $index; ?></td> 
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


