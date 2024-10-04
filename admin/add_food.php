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


        <?php
        

        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
    ?>
    </div>



    <form action="" method="POST" class="addAdminForm" enctype="multipart/form-data">
    <fieldset class="formFieldset">
        <legend class="formLegend">Add New Food Item</legend>
        
        <div class="formGroup">
            <label for="title" class="formLabel">Title</label>
            <input type="text" id="title" name="title" class="formInput" placeholder="Title of the food">
        </div>

        <div class="formGroup">
            <label for="description" class="formLabel">Description</label>
            <textarea id="description" name="description" class="formInput" cols="30" rows="10" placeholder="Description of the food"></textarea>
        </div>

        <div class="formGroup">
            <label for="price" class="formLabel">Price</label>
            <input type="number" id="price" name="price" class="formInput" placeholder="Price of the food">
        </div>

        <div class="formGroup">
            <label for="image" class="formLabel">Select Image</label>
            <input type="file" id="image" name="image" class="formInput">
        </div>

        <div class="formGroup">
            <label for="category" class="formLabel">Category</label>
            <select id="category" name="category" class="formInput">
                <?php
                    // PHP code to fetch and display categories
                    $sql = "SELECT * FROM categorytbl WHERE active = 'Yes'";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);

                    if ($count > 0) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            $id = $row['id'];
                            $title1 = $row['title'];
                            echo "<option value=\"$id\">$title1</option>";
                        }
                    } else {
                        echo "<option value=\"0\">No categories found</option>";
                    }
                ?>
            </select>
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

        <button type="submit" name="submit" class="btn_secondary">Add Food</button>
    </fieldset>
</form>


    <?php
        //check if button has been clicked or not
        if(isset($_POST['submit'])){
            //add food in database
            //echo "clicked";

            //1. Get the data from form
            echo $title = $_POST['title'];
            echo $description = $_POST['description'];
            echo $price = $_POST['price'];
            //echo $category = $_POST['category'];
            if(isset($_POST['category'])){
                echo $category = $_POST['category'];
                echo "cat set";
            }else{
                //$featured = "No"; //settings for default value
                echo "Category not set";
            }

            //check if radio buttons for featured and active have been clicked
            if(isset($_POST['featured'])){
                echo $featured = $_POST['featured'];
            }else{
                $featured = "No"; //settings for default value
            }

            if(isset($_POST['active'])){
                echo $active = $_POST['active'];
            }else{
                $active = "No"; //settings for default value
            }


            //2. Upload the image if selected
            //check weather image is selected or not and set value for image name accordingly
            if(isset($_FILES['image']['name'])){

                
                ini_set('display_errors', 1);
                ini_set('display_startup_errors', 1);
                error_reporting(E_ALL);
                //upload image
                //to upload image we need image name, source path and destination path
                //Get the details of the selected image
                $image_name = $_FILES['image']['name'];

                //check if image is selcetd or not and upload image only when image has been selected
                if($image_name != ""){
                
                //Image is selected
                //Auto rename our image
                //get the extension of our image (jpj,png,gif e.t.c) e.g food1.jpg
                $ext = end(explode('.', $image_name));

                //rename the image
                $image_name = "food".rand(000, 999).'.'.$ext;

                //get the source path and destination path
                $source_path = $_FILES['image']['tmp_name'];
                $target = "/images/category/";
                $destination_path = "food_images/".$image_name; //destination path for the image to be uploaded

                //upload the image
                //initialize upload for the food image
                $upload = move_uploaded_file($source_path, $destination_path);
                ini_set('display_errors', 1);
                ini_set('display_startup_errors', 1);
                error_reporting(E_ALL);
                //check if image was uploaded or not
                //if image was not uploaded then we will stop the process and redirect with error message
                if($upload == false){
                    //set message
                    $_SESSION['upload']= "<div class='error'>Failed to upload image</div>";

                    //redirect to add category page
                    header("location: add_food.php");

                    //stop the process
                    die();
                    
                    
                }
            }
            }else{

                //dont upload image and set image_name value as blank
                $image_name = "";
            }

            //3. Insert into database
            //create sql query to insert food details into database
            $sql2 = "INSERT INTO food SET 
                title = '$title', 
                description = '$description', 
                price = $price, 
                image_name = '$image_name', 
                category_id = $category, 
                featured = '$featured', 
                active = '$active'
            ";

            //Execute the query
            $res2 = mysqli_query($conn, $sql2);
            
            //check if data was inserted or not
            //4. redirect with message to manage.food page
            if($res2 == true){
                //data inserted successfully
                $_SESSION['add'] = "<div class='success'>Food added successfully</div>";
                header("location: manage.food.php");
            }else{
                //failed to insert data
                $_SESSION['add'] = "<div class='error'>Failed to add food</div>";
                header("location: manage.food.php");
            }
            
        }
    
    ?>
</section>

<?php
ob_end_flush();
include('templates/footer.php'); 
?>