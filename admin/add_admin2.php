<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <!-- Google Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="CSS/login1.css">
</head>
<body>
    <div class="form-container">
    <form action="" method="POST" class="addAdminForm">

<div class="addAdminFormContainer">
    <div class="labels">
        <label for="fullname">Full Name</label> <br>
        <label for="username">UserName</label> <br>
        <label for="password">Password</label> <br>
    </div>

    <div class="inputs">
        <input type="text" name="fullname">
        <br>

        
        <input type="text" name="username">
        <br>

        <input type="password" name="password">
        <br>
    </div>
</div>

<input type="submit" name="submit" value="Add Amin" class="btn_secondary">
</form>
    </div>
</body>
</html>

<?php

if(isset($_POST['submit'])){
    
    //get the data from form
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); //encryption with md5

    //sql query to save data into the database
    $sql = "INSERT INTO admintbl SET 
    full_name = '$fullname',
    username = '$username',
    password = '$password'
    ";

    //execte quey and save into database
    // $conn = mysqli_connect('localhost', 'root', ''); //database connction
    // $db_select = mysqli_select_db($conn, 'foodie') or die(mysqli_error()); //selecting database

    include('config/config.php');

    //executing query and saving data into the database
     $res = mysqli_query($conn, $sql) or die(mysqli_error());

     if ($res == true){
        echo "Admin added";
     }else{
        echo "Failed to add Admin";
     }
}

?>