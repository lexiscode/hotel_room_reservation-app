<?php


require "classes/DbConnect.php";
require "classes/GetDataId.php";

// Initialize the session.
session_start();

// Connect to the Database Server
$conn = new DbConnect();
$conn->getConn();

// This gets the id from the browser tab when the save button was clicked in the new article page
if (isset($_GET['id'])){

    // Reading from the database to get specific article row by their id
    $submitted_data = GetDataId::getDataById($conn, $_GET['id']); // this holds an associative array
    
} else {
    // no error message printed when there's no id included in the url link
    $submitted_data = null; 
}
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Booking</title>
</head>
<body>


    <!--if the article contents anything other than false or null, then run as true-->
    <?php if ($submitted_data): ?>

        <article>
            <!--had to change from assoc array to obj format in order to tally with the getArticleById method-->
            <h2><?php echo htmlspecialchars($submitted_data->customer_name) ?></h2> 
            <p><?php echo $submitted_data->room_type; ?></p>
            <p><?php echo $submitted_data->booking_date; ?></p>
            <p><?php echo $submitted_data->booking_time; ?></p>
        </article>

    <?php else: ?>
    <!--this runs when the article it is false or null-->
    <p>No articles found.</p>
    <?php endif; ?>
    
</body>
</html>


    



