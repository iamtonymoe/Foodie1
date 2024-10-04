<?php 
include('templates/header.php'); 
include('config/config.php');

include('logincheck.php');
?>


<section class="mainContent">
    <div class="sectionName">
        <h2>
            Manage Admins
        </h2>

        <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

        
            if (isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }

            if (isset($_SESSION['user_not_found'])){
                echo $_SESSION['user_not_found'];
                unset($_SESSION['user_not_found']);
            }

            if (isset($_SESSION['password_not_match'])){
                echo $_SESSION['password_not_match'];
                unset($_SESSION['password_not_match']);
            }

            if (isset($_SESSION['changed_password'])){
                echo $_SESSION['changed_password'];
                unset($_SESSION['changed_password']);
            }

           
        ?>
        <br> <br> 


        <a href="add_admin.php" class="btn_primary">Add Admin</a>
    </div>

    <div class="table">
        <table class="tbl_full">
            <tr>
                <th>S.N</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>

            <?php
                //query to get all admin
                $sql = "SELECT * FROM admintbl";

                //execute query
                $res = mysqli_query($conn, $sql);

                //check weather the query is executed or not
                if($res == true){
                    //count rows to check wheather we have data in our database or not
                    $count = mysqli_num_rows($res);
                    echo $count; //function to get all the rows in a database

                    $sn = 1; //create a variable and assign the value

                    //check the number of rows
                    if($count > 0){
                        //if we have data in our database
                        while($rows = mysqli_fetch_assoc($res)){
                            //using the while loop to get all the data from the databsae
                            //and while loop will run it as long as we have data in our database

                            $id = $rows['id'];
                            $fullname = $rows['full_name'];
                            $username = $rows['username'];

                            //display the values in our table
                            ?>
                            <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $fullname; ?></td>
                            <td><?php echo $username; ?></td>
                            <td>
                                <a href="update.password.php?id=<?php echo $id?>" class="btn btn_primary">Change Password</a>
                                <a href="update.admin.php?id=<?php echo $id?>" class="btn btn_secondary">Update Admin</a>
                                <a href="delete.admin.php?id=<?php echo $id?>" class="btn btn_danger">Delete Admin</a>
                            </td>
                            </tr>

                            <?php
                        }
                    }
                }else{
                    //we do not have data in the database
                }
            ?>

         
        </table>
    </div>
</section>




<?php include('templates/footer.php'); ?>