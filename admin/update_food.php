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
        if(isset($_GET['id'])){
            //get the id and all other details
            $id = $_GET['id'];

            //create sql query to get all other details
            $sql2 = "SELECT * FROM food WHERE id = $id";

            //execute query
            $res2 = mysqli_query($conn, $sql2);

            //count the rows to check if the id is valid or not
            $count2 = mysqli_num_rows($res2);

            if($count2 == 1){
                //get all the data
                $row2 = mysqli_fetch_assoc($res2);
                $title = $row2['title'];
                $current_image = $row2['image_name'];
                $description = $row2['description'];
                $price = $row2['price'];
                $current_category = $row2['category_id'];
                $featured = $row2['featured'];
                $active = $row2['active'];
            }else{
                //redirect to manage.category page with message
                $_SESSION['no_category_found'] = "<div class='error'>Category not found</div>";
                header("location: manage.food.php");
            }
        }else{
            //redirect to mana.category page
            header(header: "location: manage.food.php");
        }
    ?>
    </div>



    <form action="" method="POST" class="addAdminForm" enctype="multipart/form-data">
    <fieldset class="formFieldset">
        <legend class="formLegend">Update Food Item</legend>
        
        <div class="formGroup">
            <label for="title" class="formLabel">Title</label>
            <input 
                type="text" 
                id="title" 
                name="title" 
                class="formInput" 
                placeholder="Title of the food" 
                value="<?php echo htmlspecialchars($title); ?>"
                required>
        </div>

        <div class="formGroup">
            <label for="current_image" class="formLabel">Current Image</label>
            <div class="currentImage">
                <?php
                    if ($current_image != "") {
                        // Display the image
                        echo "<img src='food_images/$current_image' alt='Current food image' width='100px'>";
                    } else {
                        // Display message
                        echo "<div class='error'>Image not added</div>";
                    }
                ?>
            </div>
        </div>

        <div class="formGroup">
            <label for="description" class="formLabel">Description</label>
            <textarea 
                id="description" 
                name="description" 
                class="formInput" 
                cols="30" 
                rows="10" 
                placeholder="Description of the food"
                required><?php echo htmlspecialchars($description); ?></textarea>
        </div>

        <div class="formGroup">
            <label for="price" class="formLabel">Price</label>
            <input 
                type="number" 
                id="price" 
                name="price" 
                class="formInput" 
                placeholder="Price of the food" 
                value="<?php echo htmlspecialchars(number_format($price, 2)); ?>"
                min="0" 
                step="0.01" 
                required>
        </div>

        <div class="formGroup">
            <label for="image" class="formLabel">Select New Image (optional)</label>
            <input 
                type="file" 
                id="image" 
                name="image" 
                class="formInput">
        </div>

        <div class="formGroup">
            <label for="category" class="formLabel">Category</label>
            <select id="category" name="category" class="formInput" required>
                <?php
                    $sql = "SELECT * FROM categorytbl WHERE active = 'Yes'";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);

                    if ($count > 0) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            $category_id = $row['id'];
                            $category_title = $row['title'];
                            $selected = ($current_category == $category_id) ? 'selected' : '';
                            echo "<option value=\"$category_id\" $selected>$category_title</option>";
                        }
                    } else {
                        echo "<option value=\"0\">Category not available</option>";
                    }
                ?>
            </select>
        </div>

        <div class="formGroup">
            <span class="formLabel">Featured</span>
            <div class="formRadioGroup">
                <label class="custom-radio">
                    <input type="radio" id="featured-yes" name="featured" value="Yes" <?php echo ($featured == 'Yes') ? 'checked' : ''; ?>>
                    <span class="radio-custom"></span>
                    Yes
                </label>
                <label class="custom-radio">
                    <input type="radio" id="featured-no" name="featured" value="No" <?php echo ($featured == 'No') ? 'checked' : ''; ?>>
                    <span class="radio-custom"></span>
                    No
                </label>
            </div>
        </div>

        <div class="formGroup">
            <span class="formLabel">Active</span>
            <div class="formRadioGroup">
                <label class="custom-radio">
                    <input type="radio" id="active-yes" name="active" value="Yes" <?php echo ($active == 'Yes') ? 'checked' : ''; ?>>
                    <span class="radio-custom"></span>
                    Yes
                </label>
                <label class="custom-radio">
                    <input type="radio" id="active-no" name="active" value="No" <?php echo ($active == 'No') ? 'checked' : ''; ?>>
                    <span class="radio-custom"></span>
                    No
                </label>
            </div>
        </div>

        <input type="hidden" name="current_image" value="<?php echo htmlspecialchars($current_image); ?>">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
        <button type="submit" name="submit" class="btn_secondary">Update Food</button>
    </fieldset>
</form>


    <?php
        //check if button has been clicked or not
       if(isset($_POST['submit'])){
        //echo "clicked";

        //1. get all the details from the form
        $id = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $current_image = $_POST['current_image'];
        $category = $_POST['category'];
        $featured = $_POST['featured'];
        $active = $_POST['active'];

        //check if upload button has been clicked or not
        if(isset($_FILES['image']['name'])){
            //upload button is clicked
            $image_name = $_FILES['image']['name']; //new image name

            //2. Upload if the image if selected
            //check if the file is available or not
            if($image_name != ""){
                //image is available
                //A. Uploading new image
                //rename the image
                $ext = end(explode('.',$image_name)); //gets the extension of the image

                $image_name = "food".rand(0000, 9999).".".$ext; //this will be renamed image

                //get the source path and destination path
                $source_path = $_FILES['image']['tmp_name']; //source path
                $destination_path = "food_images/".$image_name; //destination path

                //upload the image
                $upload = move_uploaded_file($source_path, $destination_path);

                //check if image was uploaded or not
                if($upload == false){
                    //failed to upload
                    $_SESSION['upload'] = "<div class='error'>Failed to upload new image</div>";
                    //redirect to manage food page
                    header("location: manage.food.php");
                    //stop the process
                    die();
                }

                //3. Remove the image if new image is uploaded and current image exists
                //B. Remove current image if available
                if($current_image != ""){
                    //current image is available
                    //Remove the image
                    $remove_path = "food_images/".$current_image;

                    $remove = unlink($remove_path);

                    //check if the image was removed or not
                    if($remove == false){
                        //failed to remove
                        $_SESSION['failed_remove'] = "<div class='error'>Failed to remove current image</div>";
                        //redirect to manage food page
                        header("location: manage.food.php");
                        //stop the process
                        die();
                    }
                }
            }else{
                $image_name = $current_image;
            }

        }else{
            $image_name = $current_image;
        }
        

        //4. Update food in the database
        $sql3 = "UPDATE food SET 
            title = '$title', 
            description = '$description', 
            price = '$price', 
            image_name = '$image_name', 
            category_id = '$category', 
            featured = '$featured', 
            active = '$active'
            WHERE id = $id;
        ";

        //Execute the sql query 
        $res3 = mysqli_query($conn, $sql3);

        //check if query was executed or not
        if($res3 == true){
            //query executed and food updated
            $_SESSION['update'] = "<div class='success'>Food updated successfully</div>";
            header("location: manage.food.php");
        }else{
            //failed to upload
            $_SESSION['update'] = "<div class='error'>Failed to update food</div>";
            header("location: manage.food.php");
        }

       }
    
    ?>
</section>

<?php 
ob_end_flush();
include('templates/footer.php'); 
?>