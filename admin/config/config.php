<?php
// Start session
session_start();

// Create constants to store repeating values
define('SITEURL', 'localhost/foodie/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('PASSWORD', '');
define('DB_NAME', 'foodie');

// Execute query and save into database
$conn = mysqli_connect(LOCALHOST, DB_USERNAME, PASSWORD, DB_NAME);

// Check connection
if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}

// Select database
$db_select = mysqli_select_db($conn, DB_NAME);
if (!$db_select) {
    die('Error selecting database: ' . mysqli_error($conn));
}
