<?php
include("config/config.php");
include("templates/header.php");
?>

<section class="">
    <div class="unique-nav-container">
        <ul class="unique-nav-tabs unique-scrollable-nav">
        <?php
            // Create SQL query to display categories from the database
            $sql = "SELECT * FROM categorytbl WHERE active = 'Yes'";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            $firstCategory = true; // Variable to track the first category

            if($count > 0){
                // Categories available
                while($row = mysqli_fetch_assoc($res)){
                    // Get values like id and title
                    $id = $row['id'];
                    $title = $row['title'];
                    ?>
                    <li class="unique-nav-item">
                        <a class="unique-nav-link <?php if($firstCategory) { echo 'active'; $firstCategory = false; } ?>" href="#category-<?php echo $id; ?>"><?php echo $title; ?></a>
                    </li>
                    <?php
                }
            } else {
                echo "<div class='error'>No categories found.</div>";
            }
        ?>
        </ul>
    </div>
    
    <div class="unique-tab-content">
        <?php
            // Get all categories again to display food items
            $sql2 = "SELECT * FROM categorytbl WHERE active = 'Yes'";
            $res2 = mysqli_query($conn, $sql2);
            $firstPane = true; // Variable to track the first tab pane
            if($res2){
                while($category = mysqli_fetch_assoc($res2)){
                    $category_id = $category['id'];
                    
                    // Get all food items under this category
                    $sql3 = "SELECT * FROM food WHERE active = 'Yes' AND category_id = '$category_id'";
                    $res3 = mysqli_query($conn, $sql3);
                    $food_count = mysqli_num_rows($res3);
                    ?>
                    <div id="category-<?php echo $category_id; ?>" class="unique-tab-pane <?php if($firstPane) { echo 'active'; $firstPane = false; } ?>">
                        <?php
                        if($food_count > 0){
                            while($food = mysqli_fetch_assoc($res3)){
                                $food_title = $food['title'];
                                $food_price = $food['price'];
                                $food_image = $food['image_name'];
                                ?>
                                <!-- Price card for each food item -->
                                <a href="link-to-product<?php echo $food['id']; ?>.html" class="price-card-link">
                                    <div class="price-card">
                                        <div class="food-image">
                                            <?php
                                                if($food_image == ""){
                                                    echo "<div class='error'>Image not available</div>";
                                                } else {
                                                    ?>
                                                    <img src="../admin/food_images/<?php echo $food_image; ?>" alt="<?php echo $food_title; ?>">
                                                    <?php
                                                }
                                            ?>
                                        </div>
                                        <div class="card-details">
                                            <h2><?php echo $food_title; ?></h2>
                                            <p class="price">$<?php echo $food_price; ?></p>
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
                        } else {
                            echo "<div class='error'>No food available in this category.</div>";
                        }
                        ?>
                    </div>
                    <?php
                }
            }
        ?>
    </div>

    <script src="JS/navtab.js"></script>
</section>

<?php
include("templates/footer.php");
?>
