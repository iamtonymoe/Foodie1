<?php
ob_start();
include('templates/header.php'); 
include('config/config.php');

include('logincheck.php');
?>

<section class="mainContent">
    <div class="sectionName">
        <h2>Add Category</h2>
        
        <?php
        if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }


        if(isset($_SESSION['remove'])){
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);
        }

        if(isset($_SESSION['delete'])){
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        if(isset($_SESSION['no_category_found'])){
            echo $_SESSION['no_category_found'];
            unset($_SESSION['no_category_found']);
        }

        if(isset($_SESSION['update'])){
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }

        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        if(isset($_SESSION['failed_remove'])){
            echo $_SESSION['failed_remove'];
            unset($_SESSION['failed_remove']);
        }
    ?>
    <br>

        <a href="add_category.php" class="btn_primary">Add Category</a>

    </div>

    <div class="table">
        <table class="tbl_full">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>

            </tr>

            <?php
                //query to get all admin
                $sql = "SELECT * FROM categorytbl";

                //execute query
                $res = mysqli_query($conn, $sql);

                //check weather the query is executed or not
                if($res == true){
                    //count rows to check wheather we have data in our database or not
                    $count = mysqli_num_rows($res);
                  

                    $sn = 1; //create a variable and assign the value

                    //check the number of rows
                    if($count > 0){
                        //if we have data in our database
                        while($rows = mysqli_fetch_assoc($res)){
                            //using the while loop to get all the data from the databsae
                            //and while loop will run it as long as we have data in our database

                            $id = $rows['id'];
                            $title = $rows['title'];
                            $image_name = $rows['image_name'];
                            $featured = $rows['featured'];
                            $active = $rows['active'];

                            //display the values in our table
                            ?>
                            <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $title; ?></td>

                            <td>
                                <?php 
                                    //check if image name is available or not
                                    if($image_name != ""){
                                        //display image
                                        ?>
                                            <img src="category_images/<?php echo $image_name; ?>" alt="" width="200px">
                                        <?php
                                    }else{
                                        //display the message
                                        echo "<div class='error'>Image not added</div>";
                                    }
                                ?>
                            </td>
                            
                            <td><?php echo $featured; ?></td>
                            <td><?php echo $active; ?></td>
                            <td>
                                <a href="update_category.php?id=<?php echo $id?>" class="btn btn_secondary">Update Category</a>
                                <a href="delete_category.php?id=<?php echo $id?> &image_name=<?php echo $image_name?>" class="btn btn_danger">Delete Category</a>
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


<?php
ob_end_flush();
include('templates/footer.php'); ?>