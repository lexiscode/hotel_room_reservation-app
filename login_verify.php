<?php

// Check if admin login button is clicked
if (isset($_POST['admin_login'])){
    if (!empty($_POST['passcode'])){
        $passcode = "mqwW!8V#O452";
        if ($_POST['passcode'] === $passcode){
            // Redirect to the admin page
            header("Location: admin.php");
            exit; // Make sure to call exit after the redirect
        }else{
            // Redirect to back to the homepage
            header("Location: index.php");
            exit; // Make sure to call exit after the redirect
        }
    }
}

?>
