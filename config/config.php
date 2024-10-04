<?php
//start session
session_start();

//create constatnts to store repeating values
define('SITEURL', 'localhost/foodie/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('PASSWORD', '');
define('DB_NAME', 'foodie');

 //execte quey and save into database
 $conn = mysqli_connect(LOCALHOST, DB_USERNAME, PASSWORD); //database connction
 $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error()); //selecting database


  //$res = mysqli_query($conn, $sql) or die(mysqli_error());



  
 