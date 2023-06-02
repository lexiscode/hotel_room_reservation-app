<?php require "app_db.php";?>
<?php require "login_verify.php";?>
<?php require "alerts.php";?>

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
                <label for="task" style="color: white">Name:</label>
                <input class="form-control" type="text" name="name" id="name" placeholder="Enter Your Full Name">
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
                <input class="form-control" type="date" name="due_date" id="due_date">
                <br>
                <label for="set_time" style="color: white">Set Time:</label>
                <input class="form_control" type="time" name="set_time" id="set_time" placeholder='hh:mm'>

            </div>
            <br> 

            <div class="container text-center">
                <div class="row">
                    <!-- GRID 1 -->
                    <div class="col">
                        <div align="center">
                            <button type="submit" class="btn btn-primary" name="addTask" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
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
                    Are you an admin? If yes, please kindly click
                    <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        <i>Admin Login</i>
                    </button>
                    to login in.
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
                    <label for="passcode" style="color: white">Passcode:</label>
                    <input class="form-control" type="password" name="passcode" id="passcode" placeholder="Enter Your Password" required>
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
                <button type="submit" class="btn btn-primary" name="admin_login">Login</button>
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