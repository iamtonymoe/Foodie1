
<?php include('templates/header.php');?>

<section class="mainContent">
    <div class="sectionName">
        <h2>
            Update Admins
        </h2>
        <br>
        <br>

        <a href="" class="btn_primary">Add Admin</a>
    </div>

    <?php
        include('config/config.php');
        //get the id of admin to be deleted 
        $id = $_GET['id'];

        //create sql query and delete data from our database 
        $sql = "SELECT * FROM admintbl WHERE id = $id";

        //execute the query
        $res = mysqli_query($conn, $sql);

        //check wheather query executed successfully or not
        if($res == true){
            //check wheather the data is available or not
            $count = mysqli_num_rows($res);

            //check wheather we have data or not
            if($count == 1){
                echo 'we have data';
                //get the details
                $row = mysqli_fetch_assoc($res);
                $fullname = $row['full_name'];
                $username = $row['username'];
            }

        }else{
            //Redirect to admin page
            header("location: admin.php");
        }
    ?>

    <form action="" method="POST" class="addAdminForm">

        <div class="addAdminFormContainer">
            <div class="labels">
                <label for="fullname">Full Name</label> <br>
                <label for="username">UserName</label> <br>
               
            </div>

            <div class="inputs">
                <input type="text" name="fullname" value="<?php echo $fullname; ?>">
                <br>

                
                <input type="text" name="username" value="<?php echo $username; ?>">
                <br>


            </div>
        </div>
        <br>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="submit" name="submit" value="Update Amin" class="btn_secondary">
    </form>

    <div>
        
        
    </div>

    <?php
        include('config/config.php');

        // Process the value from the form and save it in the database

        // check wheather the submit button is clicked or not
        if(isset($_POST['submit'])){
            //connect to database
            
            
            //get the data from form
            $id = $_POST['id'];
            $fullname = $_POST['fullname'];
            $username = $_POST['username'];
            

            

            //sql query to save data into the database
            $sql = "UPDATE admintbl SET 
            full_name = '$fullname',
            username = '$username' 
            WHERE id = '$id'
            ";

            //execte quey and save into database
            // $conn = mysqli_connect('localhost', 'root', ''); //database connction
            // $db_select = mysqli_select_db($conn, 'foodie') or die(mysqli_error()); //selecting database

            

            //executing query and saving data into the database
            $res = mysqli_query($conn, $sql);

            if ($res == true){
                $_SESSION['update'] = "<div class='success'>Admin updated Successfully</div>";

                //redirect page
                header("location: admin.php");
            }else{
                $_SESSION['update'] = "<div class='error'>Failed to update Admin</div>";

                //redirect page
                header("location: admin.php");
            }
        }
    ?>

</section>

<?php include('templates/footer.php'); ?>