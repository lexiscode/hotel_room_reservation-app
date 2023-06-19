<?php

require "classes/DbConnect.php";
require "classes/GetDataId.php";
require "classes/Auth.php";

// Initialize the session.
session_start();

// in this case of the admin page, you must be login to access this page
Auth::requireLogin();

// Connect to the Database Server
$conn = new DbConnect();
$conn->getConn();

// READING or RETRIEVING from the database to get specific article post by their ids
if (isset($_GET['id'])){

    // checks if the article's id exits in the database, then returns an associative array, which stores in $article variable
    $customer_data = GetDataId::getDataById($conn, $_GET['id']); 

    if (!$customer_data){
        // if a non-existing id number is in the link
        die("Invalid ID. No article found");
    }

} else {
    // if no id is in the link
    die("ID not supplied. No articles found");
}



// DELETE PDO query
$results = $customer_data->deleteData($conn);

// checking for errors, if none, then redirect the user to the new article page
if ($results){
    // it is more advisable to use absolute paths below than relative path
    header("Location: http://localhost/hotel_room_reservation-app/admin.php"); 
    exit;
}
    