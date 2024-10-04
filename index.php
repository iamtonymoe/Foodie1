<?php
include("config/config.php");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document22</title>
    <link rel="stylesheet" href="CSS/style3.css">
    <link rel="stylesheet" href="CSS/cat.carousel.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>
    <!-- <div class="loader" id="loader"></div> -->

    <section id="modalSection">

        <div id="modal" class="modal">
            <div class="modal-content">
                    <span class="close-btn">&times;</span>
                    <div class="slider">
                        <div class="slides">
                            <div class="slide active">
                                <img src="assets/pic1.png" alt="" id="img1">
                                <h2>Free Delivery Offers</h2>
                                <p>Welcome to the best dining experience.</p>
                            </div>
                            <div class="slide">
                                <img src="assets/pic2.png" alt="" id="img1"><br><br><br>
                                <h2>All your favourites</h2>
                                <p>Explore our diverse and delicious menu.</p>
                            </div>
                            <div class="slide">
                                <img src="assets/pic3.png" alt="" id="img1">
                                <h2>There's food for everyone</h2>
                                <p>Get your loved ones food in one place.</p>
                            </div>
                        </div>
                        
                    </div>

                    
                    <button class="skip-btn modal-button">Skip</button>    
                    <button class="next-btn modal-button">Next</button>
                
            </div>
        </div>
    </section>
    



    <section id="main-content">
        
    <header>
    <nav id="navbar">
        <div id="logo">
            <img src="assets/goatmeat1.jpg" alt="Company Logo" class="logo-img">
            <a href="/" class="company-name">Foodie</a>
        </div>

        <div class="nav-btn">
            <a href="customer/login.php" class="btn" aria-label="Log out">Get Ready</a>
        </div>
    </nav>
    
    <!-- Search bar below the navbar -->
    <div class="search-bar">
        <input type="text" placeholder="Search..." aria-label="Search">
        <button type="submit" aria-label="Search Button"><i class="fas fa-search"></i></button>
    </div>
</header>


        <div class="slider2">
            <script src="js/sliderjs.js"></script>
            <div class="slides2">
                <!-- Slide 1 -->
                <div class="slide2">
                    <img src="assets/slide1.jpg" alt="Slide 1">
                </div>
                <!-- Slide 2 -->
                <div class="slide2">
                    <img src="assets/Slide2.jpg" alt="Slide 2">
                </div>
                <!-- Slide 3 -->
                <div class="slide2">
                    <img src="assets/goatmeat1.jpg" alt="Slide 3">
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


    <section>
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
                    //create sql query to display category from the database
                    $sql = "SELECT * FROM categorytbl WHERE featured = 'Yes' AND active = 'Yes'";

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
                            
                            ?>
                                <div class="category-card">
                                    <img src="admin/category_images/<?php echo $image_name; ?>" alt="Category 1">
                                    <h2><?php echo $title; ?></h2>
                                </div>
                            <?php
                        }
                    }else{

                    }
                    
                ?>

                    
                    <!-- Add more category cards here -->
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
                                                <img src="admin/food_images/<?php echo $image_name; ?>" alt="Gourmet Pizza">
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
  e   <div class="avatar" id="avatar1">

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

    <footer class="grid">
        <div id="fblock1">
            <h1>Foodie</h1>
        </div>
        
        <div id="fblock2">
            <h3>Lets do it together</h3>
            <a href="">Careers</a>
            <a href="">Foodie for partners</a>
            <a href="">Couriers</a>
            <a href="">Foodie Business</a>
        </div>

        <div id="fblock3">
            <h3>Links Of Interest</h3>
            <a href="">About us</a>
            <a href="">FAQ</a>
            <a href="">Foodie Prime</a>
            <a href="">Blogs</a>
            <a href="">Contact us</a>
            <a href="">Security</a>
        </div>

        <div id="fblock4">
            <h3>Follow Us</h3>
            <a href="">Facebook</a>
            <a href="">Twitter</a>
            <a href="">Instagram</a>
        </div>

        <div id="fblock5">
            <a href="">Terms & Conditions</a>
            <a href="">Privacy Policy</a>
            <a href="">Cookies Policy</a>
            <a href="">Compliance</a>
        </div>
        
    </footer>





    <script src="js/script.js"></script>
</body>
</html>