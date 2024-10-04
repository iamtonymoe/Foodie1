<?php
include("config/config.php");



// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to login page
header("location: login.php");
exit(); // Ensure no further code is executed
?>
