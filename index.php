<?php 

require "includes/alerts.php";
require "classes/Auth.php";
require "classes/DbConnect.php";
require "classes/GetDataId.php";

// Initialize the session.
session_start();

// defining the variables
$customer_name = '';
$room_type = '';
$booking_date = '';
$booking_time = '';

$customer_data = new GetDataId();

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    if (isset($_POST['reserve_now'])){
        if (!empty($_POST['customer_name']) && !empty($_POST['room_type']) && !empty($_POST['booking_date']) && !empty($_POST['booking_time'])){

            // gets connection to database
            $conn = new DbConnect();
            $conn->getConn();

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
                header("Location: http://localhost/hotel_room_reservation-app/index.php"); 
                exit;
            }
        
        }else{
            $error = "No fields must be left empty.";
        }
    }
 
}



// Check if the submit button has been clicked, and check if the fields ain't empty also
if (isset($_POST['sign-in'])){
    if (!empty($_POST['username']) && !empty($_POST['password'])){
        if ($_POST['username'] == 'lexiscode' && $_POST['password'] == 'secret123'){

            Auth::login();
            
            // redirect to the index page
            header('Location: http://localhost/hotel_room_reservation-app/admin.php');
            exit;

        } else {

            $error = "login details incorrect";
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

        <form action="" method="POST">
            <div class="w-50 m-auto">
                <label for="name" style="color: white">Name:</label>
                <input class="form-control" type="text" name="customer_name" id="name" placeholder="Enter Your Full Name">
                <br>
                <label for="room_type" style="color: white">Room Type:</label> <br>
                <select class="form-control" name="room_type" id="room_type">
                    <option selected="selected" value="Regular">Regular</option>
                    <option value="Deluxe">Deluxe</option>
                    <option value="Smoking Room">Smoking Room</option>
                    <option value="Standard Suite">Standard Suite</option>
                    <option value="Villa Suite">Villa Suite</option>
                    <option value="Presidental Suite">Presidental Suite</option>
                </select>
                <br>
                <label for="due_date" style="color: white">Date:</label>
                <input class="form-control" type="date" name="booking_date" id="due_date">
                <br>
                <label for="set_time" style="color: white">Set Time:</label>
                <input class="form_control" type="time" name="booking_time" id="set_time" placeholder='hh:mm'>

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

        <br>
        <form action="" method="POST">
        <div align="center">
            <p style="color: white">
                <i>
                    <!-- Working with Sessions-->
            
                    <?php if (Auth::isLoggedIn()): ?>
                        <p>You are logged in. See <a href="admin.php">Database</a> or <a href="logout.php">Logout</a></p>

                    <?php else: ?>

                        Are you an admin? If yes, please kindly click
                        <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            <i>Admin Login</i>
                        </button>
                        to login in.
                    <?php endif; ?>

                </i>
            </p>
            <p style="color: #B2BEB5">Copyright &copy; 2023 | Designed by Lexiscode</p>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="" method="POST" autocomplete="off">
            <div class="modal-content" style="background-color: gray">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel" style="color: white">Login As Admin</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="w-50 m-auto">
                    <label for="username" style="color: white">Username:</label>
                    <input class="form-control" type="text" name="username" id="username" placeholder="Enter Your Username" required>
                    <br>

                    <label for="password" style="color: white">Password:</label>
                    <input class="form-control" type="password" name="password" id="password" placeholder="Enter Your Password" required>
                    <br>
                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="dropdownCheck">
                            <label class="form-check-label" for="dropdownCheck" style="color: white">
                            Remember me
                            </label>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="sign-in">Login</button>
            </div>
            </div>
            </form>
        </div>
        </div>


        </form>

        


    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>