<?php include('templates/header.php'); ?>

<section class="mainContent">
    <div class="sectionName">
        <h2>
            Manage Admins
        </h2>

 
        <br> <br> 


        <a href="add_admin.php" class="btn_primary">Change Password</a>
    </div>

    <?php
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
    ?>

    <form action="" method="POST" class="addAdminForm">

        <div class="addAdminFormContainer">
            <div class="labels">
                <label for="fullname">Current Password</label> <br>
                <label for="username">New Password</label> <br>
                <label for="password">Confirm Password</label> <br>
            </div>

            <div class="inputs">
                <input type="text" name="current_password" placeholder="Current Password">
                <br>

                
                <input type="text" name="new_password" placeholder="New Password">
                <br>

                <input type="password" name="confirm_password" placeholder="Confirm Password">
                <br>
            </div>
        </div>
        
        <input type="hidden" name="id" value="<?php echo $id;?>" class="btn_secondary">
        <input type="submit" name="submit" value="Change Password" class="btn_secondary">
    </form>

    
    
</section>

<?php
        

        // Process the value from the form and save it in the database

        // check wheather the submit button is clicked or not
        if(isset($_POST['submit'])){
            //connect to database
            include('config/config.php');
            
            
            //get the data from form
            $id = $_POST['id'];
            $current_password = md5($_POST['current_password']);
            $new_password = md5($_POST['new_password']);
            $confirm_password = md5($_POST['confirm_password']);
            

            

            //sql query to save data into the database
            $sql = "SELECT * FROM admintbl WHERE id =  $id AND password = '$current_password'";

            //execte quey and save into database
            // $conn = mysqli_connect('localhost', 'root', ''); //database connction
            // $db_select = mysqli_select_db($conn, 'foodie') or die(mysqli_error()); //selecting database

            

            //executing query and saving data into the database
            $res = mysqli_query($conn, $sql);

            if ($res == true){
                //check wheather data is available or not
                $count = mysqli_num_rows($res);

                if($count == 1){
                    //user exists and password can be chsnged
                    //echo 'user found';
                    //check wheather the new pass and confirm password match or not
                    if($new_password == $confirm_password){
                        //update password
                        //echo 'password match';
                        $sql2 = "UPDATE admintbl SET
                        password = '$new_password'
                        WHERE id = $id
                        ";

                        //execute the query
                        $res2 = mysqli_query($conn, $sql2);

                        //check wheather query executed or not
                        if($res2 == true){
                            //display successs message
                            $_SESSION['changed_password'] = "<div class='success'>Password changed successfully</div>";

                        //redirect page
                        header("location: admin.php");
                        }else{
                            //display error message
                            $_SESSION['changed_password'] = "<div class='error'>Failed to change password</div>";

                        //redirect page
                        header("location: admin.php");
                        }
                    }else{
                        //redirect to admin page with error message
                        $_SESSION['password_not_match'] = "<div class='error'>Password did not match</div>";

                        //redirect page
                        header("location: admin.php");
                        }
                }else{
                    //user does not exist, set message and redirect
                    $_SESSION['user_not_found'] = "<div class='error'>user not found</div>";

                    //redirect page
                    header("location: admin.php");
                }


            }
        }
    ?>



<?php include('templates/footer.php');?>