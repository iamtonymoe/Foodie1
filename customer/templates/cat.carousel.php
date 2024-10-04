
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
            $sql = "SELECT * FROM categorytbl";

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
                            <img src="../../admin/food_images/<?php echo $image_name; ?>" alt="Category 1">
                            <h2><?php echo $title; ?></h2>
                        </div>
                    <?php
                }
            }else{

            }
            
        ?>

            <!-- Category Cards -->
            <div class="category-card">
                <img src="chicken1.jpg" alt="Category 1">
                <h2>Category 1</h2>
            </div>
            <div class="category-card">
                <img src="pexels-valeriya-1199957.jpg" alt="Category 2">
                <h2>Category 2</h2>
            </div>

            <div class="category-card">
                <img src="pexels-vanmalidate-769289.jpg" alt="Category 1">
                <h2>Category 1</h2>
            </div>
            <div class="category-card">
                <img src="chicken1.jpg" alt="Category 2">
                <h2>Category 2</h2>
            </div>

            <div class="category-card">
                <img src="chicken1.jpg" alt="Category 1">
                <h2>Category 1</h2>
            </div>
            <div class="category-card">
                <img src="pexels-valeriya-1199957.jpg" alt="Category 2">
                <h2>Category 2</h2>
            </div>

            <div class="category-card">
                <img src="pexels-vanmalidate-769289.jpg" alt="Category 1">
                <h2>Category 1</h2>
            </div>
            <div class="category-card">
                <img src="chicken1.jpg" alt="Category 2">
                <h2>Category 2</h2>
            </div>
            <!-- Add more category cards here -->
        </div>
    </div>
    
    
    

    
    

    