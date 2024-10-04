<?php 
ob_start();
include('config/config.php');
include('templates/header.php');
include('logincheck.php');
 ?>


<section class="mainContent">
    <div class="sectionName">
        <h2>
            Manage Admins
        </h2>
        <br>
        <br>
        <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        ?>

        <a href="" class="btn_primary">Add Admin</a>
    </div>

    <form action="" method="POST" class="addAdminForm">
    <fieldset class="formFieldset">
        <legend class="formLegend">Add Admin</legend>

        <div class="formGroup">
            <label for="fullname" class="formLabel">Full Name</label>
            <input type="text" id="fullname" name="fullname" class="formInput" required>
        </div>

        <div class="formGroup">
            <label for="username" class="formLabel">User Name</label>
            <input type="text" id="username" name="username" class="formInput" required>
        </div>

        <div class="formGroup">
            <label for="password" class="formLabel">Password</label>
            <input type="password" id="password" name="password" class="formInput" required>
        </div>

        <button type="submit" name="submit" class="btn_secondary">Add Admin</button>
    </fieldset>
</form>

</section>




<?php include('templates/footer.php'); ?>

<?php
// Process the value from the form and save it in the database

// check wheather the submit button is clicked or not
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



    //executing query and saving data into the database
     $res = mysqli_query($conn, $sql) or die(mysqli_error());

     if ($res == true){
        $_SESSION['add'] = "<div class='success'>Admin added Successfully</div>";

        //redirect page
        header("location: admin.php");
     }else{
        $_SESSION['add'] = "<div class='success'>Failed to add Admin</div>";

        //redirect page
        header("location: add_admin.php");
     }
}

ob_end_flush();

?>