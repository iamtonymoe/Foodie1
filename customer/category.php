<?php
include("config/config.php");
include("templates/header.php");
?>

<section id="categorySection">
    <?php
        //check if id is passed or not
        if(isset($_GET['category_id'])){
            //category id is set, get the id
            $category_id = $_GET['category_id'];

             //create sql query to get category title based on category id
             $sql = "SELECT title FROM categorytbl WHERE id = $category_id";

             //execute query
             $res = mysqli_query($conn, $sql);

             //get the value from database
             $row = mysqli_fetch_assoc($res);

             //get the title
             $category_title = $row['title'];

        }else{
            //category not passed
            //redirect to homepage
            header("location: index.php");
        }
    ?>
    <h2 class="textCenter">Foods in <?php echo $category_title; ?></h2>
    <div class="menuGrid">
        <?php
            
                
                
                //create sql query to display category from the database
                $sql = "SELECT * FROM food WHERE category_id = $category_id";

                //execute the query 
                $res = mysqli_query($conn, $sql);

                //count rows to check if category is available or not
                $count = mysqli_num_rows($res);

                if($count > 0){
                    //category available
                    while($row = mysqli_fetch_array($res)){
                        //get the values like id, title and image name
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        $price = $row['price'];
                        ?>
                            <a href="link-to-product1.html" class="price-card-link">
                                <div class="price-card">
                                    <div class="food-image">
                                        <?php
                                            //check if image is available or not
                                            if($image_name == ""){
                                                //display message
                                                echo "<div class='error'>Image not available</div>";
                                            }else{
                                                //Image available
                                                ?>
                                                    <img src="../admin/food_images/<?php echo $image_name; ?>" alt="Gourmet Pizza">
                                                <?php
                                            }
                                        ?>
                                        
                                    </div>
                                    <div class="card-details">
                                        <h2><?php echo $title; ?></h2>
                                        <p class="price"><?php echo $price; ?></p>
                                        <div class="button-container">
                                            <button class="order-btn">
                                                <i class="fas fa-shopping-cart"></i>
                                                <span class="button-text">Add to Cart</span>
                                            </button>

                                        </div>
                                    </div>
                                </div>
                            </a>
                        <?php
                    }
                }else{
                    //category not available
                    echo "<div class='error'>Food not available</div>";
                }
                
        ?>

               
        <!-- Repeat for other cards -->
        
    </div>
</section>

<?php
include("templates/footer.php");
?>