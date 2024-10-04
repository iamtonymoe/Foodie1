<?php include('templates/header.php'); 
include('config/config.php');
include('logincheck.php');
?>



<section class="mainContent">
    <div class="sectionName">

    <?php
             if (isset($_SESSION['login'])){
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }

            
    ?>

    <h4>
            Hello
            <?php
            if(isset($_SESSION['user'])){
                $username = $_SESSION['user'];
                $sql = "SELECT * FROM admintbl WHERE username = '$username'";
                $res = mysqli_query($conn, $sql);
                
                $count = mysqli_num_rows($res);
                if ($count == 1){
                    while($row = mysqli_fetch_assoc($res)){
                        echo $fullname = $row['full_name'];
                        
                    }
                }
            }
            ?>,
        </h4>

        <h2>
            Home
        </h2>

        
    </div>
</section>






<?php include('templates/footer.php'); ?>
   

    <!-- <script src="script1.js"></script> -->
</body>
</html>
