<?php
include('config/config.php');
include('logincheck.php');
echo "delete page";

//check if id and imagename is set or not
if(isset($_GET['id']) AND isset($_GET['image_name'])){
    //get the value and delete
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    //remove the image file if available
    if($image_name != ""){
        //image is available so remove it
        $path = "category_images/".$image_name;

        //remove image
        $remove = unlink($path);

        //if failed to remove image, then add an error message and stop the process
        if($remove = false){
            //set the session message
            $_SESSION['remove'] = "<div class='error'>Failed to remove category image</div>";

            //redirect to manage.category.php
            header("location: manage.category.php");

            //stop the process
            die();
        }
    }

    //delete data from database
    //sql query to delete data from database
    $sql = "DELETE FROM categorytbl WHERE id = $id";

    //execute the query
    $res = mysqli_query($conn, $sql);

    //check id data has been deleted from the database or not
    if($res = true){
        //set success message and redirect
        $_SESSION['delete'] = "<div class='success'>Deleted successfully</div>";

        //redirect to manage.category.php
        header("location: manage.category.php");
    }else{
        //set fail message and redirect
        $_SESSION['delete'] = "<div class='error'>Failed to delete category</div>";

        //redirect to manage.category.php
        header("location: manage.category.php");
    }

    //redirect to manage category page with message
}else{
    //redirect to manage page
    header("location: manage.category.php");
}

?>