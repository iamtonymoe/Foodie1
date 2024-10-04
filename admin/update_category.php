<?php 
ob_start();
include('config/config.php');
include('templates/header.php'); 
include('logincheck.php');
?>

<section class="mainContent">
    <div class="sectionName">
        <h2>
            Update Category
        </h2>
        
        <?php
            //check if id is set or not
            if($_GET['id']){
                //get the id and all other details
                $id = $_GET['id'];

                //create sql query to get all other details
                $sql = "SELECT * FROM categorytbl WHERE id = $id";

                //execute query
                $res = mysqli_query($conn, $sql);

                //count the rows to check if the id is valid or not
                $count = mysqli_num_rows($res);

                if($count == 1){
                    //get all the data
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                }else{
                    //redirect to manage.category page with message
                    $_SESSION['no_category_found'] = "<div class='error'>Category not found</div>";
                    header("location: manage.category.php");
                }
            }else{
                //redirect to mana.category page
                header("location: manage.category.php");
            }
        ?>
    </div>



    <form action="" method="POST" class="addAdminForm" enctype="multipart/form-data">
    <fieldset class="formFieldset">
        <legend class="formLegend">Update Category</legend>

        <div class="formGroup">
            <label for="title" class="formLabel">Title</label>
            <input type="text" id="title" name="title" class="formInput" value="<?php echo $title; ?>" placeholder="Enter category title">
        </div>

        <div class="formGroup">
            <label for="current_image" class="formLabel">Current Image</label>
            <div class="currentImageContainer">
                <?php
                    if($current_image != ""){
                        //display the image
                        ?>
                            <img src="category_images/<?php echo $current_image; ?>" alt="Current Image" width="100px">
                        <?php
                    } else {
                        //display message
                        echo "<div class='error'>Image not added</div>";
                    }
                ?>
            </div>
        </div>

        <div class="formGroup">
            <label for="image" class="formLabel">Select Image</label>
            <input type="file" id="image" name="image" class="formInput">
        </div>

        <div class="formGroup">
            <span class="formLabel">Featured</span>
            <div class="formRadioGroup">
                <label class="custom-radio">
                    <input type="radio" id="featured-yes" name="featured" value="Yes" <?php if($featured == "Yes"){echo "checked";} ?>>
                    <span class="radio-custom"></span>
                    Yes
                </label>
                <label class="custom-radio">
                    <input type="radio" id="featured-no" name="featured" value="No" <?php if($featured == "No"){echo "checked";} ?>>
                    <span class="radio-custom"></span>
                    No
                </label>
            </div>
        </div>

        <div class="formGroup">
            <span class="formLabel">Active</span>
            <div class="formRadioGroup">
                <label class="custom-radio">
                    <input type="radio" id="active-yes" name="active" value="Yes" <?php if($active == "Yes"){echo "checked";} ?>>
                    <span class="radio-custom"></span>
                    Yes
                </label>
                <label class="custom-radio">
                    <input type="radio" id="active-no" name="active" value="No" <?php if($active == "No"){echo "checked";} ?>>
                    <span class="radio-custom"></span>
                    No
                </label>
            </div>
        </div>

        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <button type="submit" name="submit" class="btn_secondary">Update Category</button>
    </fieldset>
</form>


    <?php
       if(isset($_POST['submit'])){
        //1.get all the values from form
        //echo 'clicked';
        $id = $_POST['id'];
        $title = $_POST['title'];
        $current_image = $_POST['current_image'];
        $featured = $_POST['featured'];
        $active = $_POST['active'];

        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        //2.updating new image if selected
        //check if image was selected or not
        if(isset($_FILES['image']['name'])){
            //get the image details 
            $image_name = $_FILES['image']['name'];

            //check if image is available or not
            if($image_name != ""){
                //image available
                //upload the new image
                //Auto rename our image
                //get the extension of our image (jpj,png,gif e.t.c) e.g food1.jpg
                $ext = end(explode('.', $image_name));

                //rename the image
                $image_name = "food_category_".rand(000, 999).'.'.$ext;


                $source_path = $_FILES['image']['tmp_name'];
                $target = "/images/category/";
                $destination_path = "category_images/".$image_name;

                //upload the image
                $upload = move_uploaded_file($source_path, $destination_path);

                //check if image was uploaded or not
                //a.if image was not uploaded then we will stop the process and redirect with error message
                if($upload == false){
                    //set message
                    $_SESSION['upload']= "<div class='error'>Failed to upload image</div>";

                    //redirect to add category page
                    header("location: update_category.php");

                    //stop the process
                    die();
                    
                    
                }


                //b.remove current image if available
                if($current_image != ""){
                    $remove_path = "category_images/" . $current_image;
                    $remove = unlink($remove_path);

                    //check if image was removed or not
                    //if it fails to remove, display message and stop the process
                    if($remove == false){
                        //failed to remove image
                        $_SESSION['failed_remove'] = "<div class='error'>Failed to remove current image</div";
                        header("location: manage.category.php");
                        die(); //stop the process
                    }
                }
                

            }else{
                $image_name = $current_image;
            }
        }else{
            $image_name = $current_image;
        }


        //3.Update the database
        $sql2 = "UPDATE categorytbl SET
        title = '$title',
        image_name = '$image_name',
        featured = '$featured',
        active = '$active'
        WHERE id = $id
        ";

        //Execute the query
        $res2 = mysqli_query($conn, $sql2);

        //4.redirect to manage.category page with message
        //check if query executed or not
        if($res2 == true){
            //category update
            $_SESSION['update'] = "<div class='success'>Category update successfully</div>";

            header("location: manage.category.php");
        }else{
            //failed to update category
            $_SESSION['update'] = "<div class='error'>Failed to update category</div>";

            header("location: manage.category.php");
        }
       }
    ?>


</section>


<?php
ob_end_flush();
include('templates/footer.php'); 
?>
