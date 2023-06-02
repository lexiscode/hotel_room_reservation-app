<?php require "app_db.php";?>

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
                                <input class="form-control" type="text" name="name" id="name" placeholder="Enter Your Full Name" required>
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
                                <input class="form-control" type="date" name="due_date" id="due_date" required>
                                <br>
                                <label for="set_time" style="color: white">Set Time:</label>
                                <input class="form_control" type="time" name="set_time" id="set_time" placeholder='hh:mm' required>
            
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="addTask">Submit</button>
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
                    <th scope="col">Name</th>
                    <th scope="col">Room Type</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                    <th scope="col">Action</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>

                <?php if (!empty($todoList)) : ?>

                <tbody align="center">
                    <?php foreach ($todoList as $index => $task) : ?>
                        <tr>
                            <td><?php taskNumber()?></td>
                            <td><?php echo $task['name']; ?></td>
                            <td><?php echo $task['room_type']; ?></td>
                            <td><?php echo $task['due_date']; ?></td>
                            <td><?php echo $task['set_time']; ?></td>
                            <td>
                                <form method="POST" action="">
                                    <input type="hidden" name="remove" value="<?php echo $index; ?>">
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                            <!-- Update section -->
                            <form action="" method="POST">
                                <input type="hidden" name="edit_index" value="<?php echo $index; ?>">

                                <td>

                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?php echo $index; ?>">
                                    Reschedule
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="staticBackdrop<?php echo $index; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel<?php echo $index; ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content" style="background-color: gray">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel<?php echo $index; ?>" style="color: white">Update Room Booking</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="w-50 m-auto">
                                            <label style="color: white">Update Name:</label> 
                                            <input class="form-control" type="text" name="updated_task" id="updated_task" size="5" placeholder="Edit Your Name" required>
                                            <br>
                                            <label for="room_type" style="color: white">Update Room Type:</label> <br>
                                            <select class="form-control" name="updated_room_type" id="updated_room_type">
                                                <option selected="selected" value="Regular">Regular</option>
                                                <option value="Deluxe">Deluxe</option>
                                                <option value="Smoking Room">Smoking Room</option>
                                                <option value="Standard Suite">Standard Suite</option>
                                                <option value="Villa Suite">Villa Suite</option>
                                                <option value="Presidental Suite">Presidental Suite</option>
                                            </select>
                                            <br>
                                            <label style="color: white">Update Due Date:</label> 
                                            <input class="form-control" type="date" name="updated_due_date" id="updated_due_date" required>
                                            <br>
                                            <label for="set_time" style="color: white">Set Time:</label>
                                            <input class="form_control" type="time" name="updated_set_time" id="set_time" placeholder='hh:mm' required>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                        </div>
                                    </div>
                                    </div>


                                </td>
                        
                            </form>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

                <?php else : ?>
                    <p style="color: white">No lists found.</p>
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
