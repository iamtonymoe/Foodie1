<?php
include('config/config.php');
//get the id of admin to be deleted 
$id = $_GET['id'];

//create sql query and delete data from our database 
$sql = "DELETE FROM admintbl WHERE id = $id";

//execute the query
$res = mysqli_query($conn, $sql);

//check wheather query executed successfully or not
if($res == true){
    //query executed successfully and admin deleted
    //echo "Admin deleted";
    //create session variable to display message
    $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully</div>";

    //redirect to admin page
    header("location:admin.php");
}else{
    //failed to delete admin
    //echo "failed to delete admin";
    $_SESSION['delete'] = "<div class='error'>Failed to Delete admin! Try again later.</div>";
}

//create sql query to delete admin

//redirect to admin page with message(either success or error)