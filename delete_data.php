<?php

require "includes/db_connect.php";
require "includes/get_data_id.php";

// connect to the database server
$conn = connectDB();

if (isset($_GET['id'])){
    // Delete the data in the database server by its id row
    $sql = "DELETE FROM rooms_record 
            WHERE id = ?";

    // Prepares an SQL statement for execution
    $stmt = mysqli_prepare($conn, $sql);
    
    // Bind variables for the parameter markers in the SQL statement prepared
    mysqli_stmt_bind_param($stmt, "i", $_GET['id']);

    // Executes a prepared statement
    $results = mysqli_stmt_execute($stmt);

    // it is more advisable to use absolute paths below than relative path
    header("Location: http://localhost/hotel_room_reservation-app/admin.php"); 
    exit;
        
}



// READING or RETRIEVING from the database to get specific article post by their ids
if (isset($_GET['id'])){

    // checks if the article's id exits in the database, then returns an associative array
    $customer_data = getCustomerData($conn, $_GET['id']); 

    if ($customer_data){
        // Get array values from its keys, which is used in the HTML form below
        $id = $customer_data['id'];
    } else {
        echo "No article found from such ID to be deleted.";
    }

} else{
    echo "Invalid delete action. Page not found.";
}

?>

