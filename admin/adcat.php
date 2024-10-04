<?php 
include('templates/footer.php'); 
?>

<?php
    if(isset($_POST['submit'])){
        include('config/config.php');
        //get the values from form

        //get the title
        $title = $_POST['title'];

        //for radio input, we need to check if the button is selected or not
        if(isset($_POST['featured'])){
            $featured = $_POST['featured'];
        }else{
            $featured = "No";
        }

        if(isset($_POST['active'])){
            $active = $_POST['active'];
        }else{
            $active = "No";
        }

        include('config/config.php');

        //create sql query to insert category into database
        $sql = "INSERT INTO categorytbl SET 
        title = '$title',
        featured = '$featured',
        active = '$active'
        ";

        //Execute the query and save in database
        $res = mysqli_query($conn, $sql);

        //check if query executed and if data is stored
        if ($res == true){
            //query executed and category added
            echo 'category added';
        }else{
            //failed to add category
            echo 'category not added';
        }
    }
?>