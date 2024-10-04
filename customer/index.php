<?php
include("config/config.php");
include("templates/header.php")
?>
    <section>

        <div class="slider2">
            <script src="js/sliderjs.js"></script>
            <div class="slides2">
                <!-- Slide 1 -->
                <div class="slide2">
                    <img src="images/slide1.jpg" alt="Slide 1">
                </div>
                <!-- Slide 2 -->
                <div class="slide2">
                    <img src="images/Slide2.jpg" alt="Slide 2">
                </div>
                <!-- Slide 3 -->
                <div class="slide2">
                    <img src="images/goatmeat1.jpg" alt="Slide 3">
                </div>
            </div>
    
            <!-- Navigation tabs at the bottom center -->
            <div class="nav-tabs">
                <span class="tab" onclick="currentSlide(0)"></span>
                <span class="tab" onclick="currentSlide(1)"></span>
                <span class="tab" onclick="currentSlide(2)"></span>
            </div>
        </div>


       
    
        
    </section>

    <section class="">
        
        <script>
                function navigateToCategory(url) {
                const overlay = document.getElementById('transition-overlay');
                
                // Add active class to start transition
                overlay.classList.add('active');
                
                // Wait for the transition to complete before navigating
                setTimeout(() => {
                    window.location.href = url;
                }, 500); // 500ms matches the transition duration
            }

        </script>

        <div class="section-container">
            <h1 class="section-header">Discover Our Delicious Selections</h1>
            <div class="horizontal-scroll-container">
                <?php
                    // Create SQL query to display categories from the database
                    $sql = "SELECT * FROM categorytbl WHERE featured = 'Yes' AND active = 'Yes'";

                    // Execute the query
                    $res = mysqli_query($conn, $sql);

                    // Count rows to check if categories are available
                    $count = mysqli_num_rows($res);  

                    if($count > 0){
                        // Categories available
                        while($row = mysqli_fetch_array($res)){
                            // Get the values like id, title, and image name
                            $id = $row['id'];
                            $title = $row['title'];
                            $image_name = $row['image_name'];
                            ?>
                                <!-- Wrap the category card inside a link -->
                                <a href="category.php?category_id=<?php echo $id; ?>" class="category-card" id="">
                                    <img src="../admin/category_images/<?php echo $image_name; ?>" alt="<?php echo $title; ?>">
                                    <h2><?php echo $title; ?></h2>
                                </a>
                            <?php
                        }
                    } else {
                        echo "<p>No categories available.</p>";
                    }
                ?>
            </div>
        </div>

    
    
    </section>

    

<section id="explore">
    <h2 class="textCenter">Explore our delicious menu</h2>
    <div class="menuGrid">
    <?php
            //create sql query to display category from the database
            $sql = "SELECT * FROM food WHERE featured = 'Yes' AND active = 'Yes'";

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
                        <a href="order.php" class="price-card-link">
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
            }
        ?>

               
        <!-- Repeat for other cards -->
        
    </div>
</section>




    <section class="teamUp grid">
        <!-- <div id="topDesign">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#0099ff" fill-opacity="1" d="M0,96L60,80C120,64,240,32,360,16C480,0,600,0,720,21.3C840,43,960,85,1080,112C1200,139,1320,149,1380,154.7L1440,160L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"></path></svg>
            <div id="iconCont">
            
            </div>

            <h1 id="hed">Team with us</h1>
            
        </div> -->

        <div id="teamUpHead">
            <h2 id="">
                Team with us
            </h2>
        </div>

        <div class="partners" id="block1">
            <div class="avatar" id="avatar1">

            </div>

            <p>Become a rider</p>

            <p>
                Enjoy flexibility, freedom and competitive earnings by delivering through Glovo 
            </p>

            <button>Register here</button>
        </div>


        <div class="partners" id="block2">
            <div class="avatar" id="avatar2">

            </div>

            <p>Become a partner</p>

            <p>
                Grow with Glovo! Our technology and user base can boost your sales.
            </p>

            <button>Register here</button>
        </div>


        <div class="partners" id="block3">
            <div class="avatar" id="avatar3">

            </div>

            <p>Careers</p>

            <p>
                Ready for an exciting new challenge? If you’re ambitious, humble.
            </p>

            <button>Register here</button>
        </div>



    </section>

<?php
include("templates/footer.php")
?>