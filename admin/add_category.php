<?php
ob_start();
include('config/config.php');
include('templates/header.php'); 
include('logincheck.php');
?>

<section class="mainContent">
    <div class="sectionName">
        <h2>
            Add Category
        </h2>

        <a href="add_category.php" class="btn_primary">Add Category</a>

        <?php
        if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
    ?>
    </div>



    <form action="" method="POST" class="addAdminForm" enctype="multipart/form-data">
    <fieldset class="formFieldset">
        <legend class="formLegend">Add New Category</legend>
        
        <div class="formGroup">
            <label for="title" class="formLabel">Title</label>
            <input type="text" id="title" name="title" class="formInput" placeholder="Enter category title">
        </div>

        <div class="formGroup">
            <label for="image" class="formLabel">Select Image</label>
            <input type="file" id="image" name="image" class="formInput">
        </div>

        <div class="formGroup">
            <span class="formLabel">Featured</span>
            <div class="formRadioGroup">
                <label class="custom-radio">
                    <input type="radio" id="featured-yes" name="featured" value="Yes">
                    <span class="radio-custom"></span>
                    Yes
                </label>
                <label class="custom-radio">
                    <input type="radio" id="featured-no" name="featured" value="No">
                    <span class="radio-custom"></span>
                    No
                </label>
            </div>
        </div>

        <div class="formGroup">
            <span class="formLabel">Active</span>
            <div class="formRadioGroup">
                <label class="custom-radio">
                    <input type="radio" id="active-yes" name="active" value="Yes">
                    <span class="radio-custom"></span>
                    Yes
                </label>
                <label class="custom-radio">
                    <input type="radio" id="active-no" name="active" value="No">
                    <span class="radio-custom"></span>
                    No
                </label>
            </div>
        </div>

        <button type="submit" name="submit" class="btn_secondary">Add Category</button>
    </fieldset>
</form>





    <?php

    
    //check if submit button has been clicked or not
    if(isset($_POST['submit'])){
        ini_set('display_errors', 1);
                ini_set('display_startup_errors', 1);
                error_reporting(E_ALL);
        //get the values from our form

        //get the title value
        echo $title = $_POST['title'];

        //for radio input, we need to check if the button is selected or not
        if(isset($_POST['featured'])){
            // get the value from form else set the default value
            echo $featured = $_POST['featured'];
        }else{
            $featured = 'No';
        }

        if(isset($_POST['active'])){
            // get the value from form else set the default value
            echo $active = $_POST['active'];
        }else{
            $active = 'No';
        }

        //check weather image is selected or not and set value for image name accordingly
        if(isset($_FILES['image']['name'])){

            

            //upload image
            //to upload image we need image name, source path and destination path
            //Get the details of the selected image
            $image_name = $_FILES['image']['name'];

            //check if image is selcetd or not upload image only when image has been selected
            //remove this if statement
            if($image_name != ""){
            
            //Image is selected
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
            //if image was not uploaded then we will stop the process and redirect with error message
            if($upload == false){
                //set message
                $_SESSION['upload']= "<div class='error'>Failed to upload image</div>";

                //redirect to add category page
                header("location: add_category.php");

                //stop the process
                die();
                
                
            }
        }
        }else{

            //dont upload image and set image_name value as blank
            $image_name = "";
        }

        

        

        //CREATE SQL QUERY TO INSERT CATEGORY INTO DATABASE
        $sql = "INSERT INTO categorytbl SET
         title = '$title', 
         image_name = '$image_name',
         featured = '$featured', 
         active = '$active'
         ";


        //execute query and save in database
        $res = mysqli_query($conn, $sql);



        //check if query executed or not and if data is added or not
        if($res == true){
            //echo 'cat added';
            //Query executed and category added
            $_SESSION['add'] = "<div class='success'>Category added successfully</div>";

            //redirect to manage category page
            header("location: manage.category.php");
        }else{
            //echo 'not added';
            $_SESSION['add'] = "<div class='error'>Failed to add category</div>";

            //redirect to add category page
            header("location: add_category.php");
        }
    }
    ?>
</section>

    

<?php
ob_end_flush();
include('templates/footer.php'); 
?>



