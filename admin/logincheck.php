<?php

if (!$_SESSION['user']){
    //user is not logged in
    //redirect to login page
    $_SESSION['no_login_message'] = "<div class='error'>Please login to access admin panel</div>";

    //redirect to login page
    header("location: login.php");
}
?>