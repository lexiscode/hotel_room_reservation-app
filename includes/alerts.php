<?php

// Check if admin login button is clicked
if (isset($_POST['reserve_now'])){
    if (!empty($_POST['customer_name']) && !empty($_POST['room_type']) && !empty($_POST['booking_date']) && !empty($_POST['booking_time'])){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Form submitted successfully!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>';
    } else if(empty($_POST['customer_name']) || empty($_POST['room_type']) || empty($_POST['booking_date']) || empty($_POST['booking_time'])) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Please fill in all the required fields.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>';
    }
    
}

?>