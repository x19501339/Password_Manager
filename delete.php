<?php

// Include the configuration file that connects to the database
include ('config.php');
// Check if neither the admin nor the user is logged in
if(!isset($_SESSION['admin_name']) && !isset($_SESSION['user_name'])){
    // Redirect to the login page
    header('location:Indexss.php');
}

// Get the ID of the account to be deleted from the URL parameter
$id = $_GET['id'];
// Perform an OTP verification by checking if the account with the given ID exists in the database
$select     = mysqli_query($conn, "SELECT * FROM accounts WHERE id = $id  ") or die(mysqli_error($conn));
$user = mysqli_num_rows($select);
if ($user > 0) {
    // If the account exists, delete it from the database
    $delete  = mysqli_query($conn, "DELETE FROM accounts where id = $id LIMIT 1") or die(mysqli_error($conn));
}
// Check if the admin is logged in
if(isset($_SESSION['admin_name'] )){
    // Redirect to the admin dashboard
    header('location: Website_Admin.php');
} else {
    // Redirect to the user dashboard
    header('location: website.php');
}
?>
