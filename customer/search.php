<?php
include("config/config.php");
include("templates/header.php");
?>

<section id="searched">
    <h2 class="">Based on your search: <span><?php echo $_POST['search']; ?></span></h2>
    <div class="menuGrid">
    <?php
        if(isset($_POST['submit'])){
            $search = $_POST['search'];

            //sql query to get foods based on the search kehyword
            $sql = "SELECT * FROM food WHERE title LIKE '%$search%' or description LIKE '%$search%'";
                
            $res = mysqli_query($conn, $sql);

            //count rows
            $count = mysqli_num_rows($res);

            //check if food is available or not
            if($count > 0){
                //food available
                while($row = mysqli_fetch_assoc($res)){
                    //get the details
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    $price = $row['price'];
                    $description = $row['description'];
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
                //food not available
                echo "<div class='error'>Food not found</div>";
            }
        }
    ?>

               
        <!-- Repeat for other cards -->
        
    </div>
</section>

<?php
include("templates/footer.php");
?>

