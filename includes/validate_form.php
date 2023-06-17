<?php

/**
 * Validate the article properties
 * 
 * @param string $customer_name Customer Name, required
 * @param string $room_type Room Type, required
 * @param string $booking_date Booking Date, required
 * @param string $booking_time Booking Time, required
 * 
 * @return array An array of validation error messages
 */


function validateArticle($customer_name, $room_type, $booking_date, $booking_time){
    
    $errors = [];

    if ($customer_name == ''){
        $errors[] = 'Customer name field must not be empty';
    }
    if ($room_type == ''){
        $errors[] = 'Room type field must not be empty';
    }
    if ($booking_date == ''){
        $errors[] = 'Booking date must not be empty';
    }
    if ($booking_time == ''){
        $errors[] = 'Booking time must not be empty';
    }

    return $errors;
}

