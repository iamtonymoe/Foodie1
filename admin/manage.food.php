<?php 
include('config/config.php');
include('templates/header.php'); 
include('logincheck.php');
?>


<section class="mainContent">
    <div class="sectionName">
        <h2>
            Manage Food
        </h2><br>

        <a href="add_food.php" class="btn_primary">Add Food</a><br> <br>

        <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }

            if(isset($_SESSION['failed_remove'])){
                echo $_SESSION['failed_remove'];
                unset($_SESSION['failed_remove']);
            }
        ?>
    </div>

    <div class="table">
        <table class="tbl_full">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php
                //create sql query to get all the food
                $sql = "SELECT * FROM food";

                //Execute the query
                $res = mysqli_query($conn, $sql);

                //count the number of rows to check if we have food or not
                $count = mysqli_num_rows($res);

                //create serial number and set default value as 1
                $sn = 1;

                if($count > 0){
                    //we have food in our database
                    while($row = mysqli_fetch_assoc($res)){
                        $id =  $row['id'];
                        $title =  $row['title'];
                        $price =  $row['price'];
                        $image_name =  $row['image_name'];
                        $featured =  $row['featured'];
                        $active =  $row['active'];
                        ?>

                <tr>
                    <td><?php echo $sn++; ?></td>
                    <td><?php echo $title; ?></td>
                    <td><?php echo $price; ?></td>
                    <td>
                        <?php 
                            //echo $image_name; 
                            //check if we have image or not 
                            if($image_name == ""){
                                //we do not have image, display error message
                                echo "<div class='error'>Image not added</div>";
                            }else{
                                //we have image, display image
                                ?>
                                    <img src="food_images/<?php echo $image_name; ?>" alt="" width="100px">
                                <?php
                            }
                        ?>
                    </td>
                    <td><?php echo $featured; ?></td>
                    <td><?php echo $active; ?></td>
                    <td>
                        <a href="update_food.php?id=<?php echo $id?>" class="btn btn_secondary">Update food</a>
                        <a href="delete_food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn btn_danger">Delete food</a>
                    </td>
                </tr>

                        <?php
                    }
                }else{
                    //food not added in database
                    echo "<div class='error'>Food not added</div>";
                }
            ?>

            
            
            
        </table>
    </div>
</section>




<?php include('templates/footer.php'); ?>