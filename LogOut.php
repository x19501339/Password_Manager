<?php
// Include the configuration file
include('config.php');

// Start a new session
session_start();
// Unset all session variables
session_unset();
// Destroy the session
session_destroy();

// Redirect the user to the Index.php page
header('location:Index.php');

?>
