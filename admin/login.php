<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Food order system</title>
    <link rel="stylesheet" href="CSS/styles10.css">
</head>
<body>
    <div>
        <h1>
            Login
        </h1>

        <form action="" class="addAdminForm" method="POST">

    <?php
        include('config/config.php');
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }

        if (isset($_SESSION['no_login_message'])) {
            echo $_SESSION['no_login_message'];
            unset($_SESSION['no_login_message']);
        }
    ?>

    <!-- Fieldset to Group Form Elements -->
    <fieldset class="formFieldset">
        <legend class="formLegend">Login</legend>

        <!-- Username and Password Inputs -->
        <div class="formGroup">
            <label for="username" class="formLabel">Username</label>
            <input type="text" name="username" id="username" class="formInput" placeholder="Enter Username" required>
        </div>

        <div class="formGroup">
            <label for="password" class="formLabel">Password</label>
            <input type="password" name="password" id="password" class="formInput" placeholder="Enter Password" required>
        </div>

        <!-- Hidden ID Field (if applicable) -->
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <!-- Submit Button -->
        <div class="formGroup">
            <input type="submit" name="submit" value="Login" class="btn_secondary btn">
        </div>

        <!-- Footer with Attribution -->
        <div class="formGroup" style="text-align: center;">
            <p>Created by <a href="" style="color: #007bff;">Anthony Mokogwu</a></p>
        </div>
    </fieldset>

</form>

    </div>
</body>
</html>

<?php

    // check wheather the submit button is clicked or not
    if(isset($_POST['submit'])){
        //connect to database
        include('config/config.php');
        
        
        //get the data from form
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        

        

        //sql query to save data into the database
        $sql = "SELECT * FROM admintbl WHERE username = '$username' AND password = '$password'";

        

        //executing query and saving data into the database
        $res = mysqli_query($conn, $sql);

        //check wheather data is available or not
        $count = mysqli_num_rows($res);

        if ($count == 1){

            //user available and login success
            $_SESSION['login'] = "<div class='success'>Login is successful</div>";
            $_SESSION['user'] = $username; //to check if user is logged in or not and logout will unset it

            //redirect to home page or dashboard
            header("location: index.php");

        }else{
            
            //user not available and login fail
            $_SESSION['login'] = "<div class='error'>Username or password did not match</div>";

            //redirect to home page or dashboard
            header("location: login.php");
        }
    }
?>