<?php
include('header.php');
include('./database/config.php');
?>

<!-- Single blog page -->
<section class="single-detalis py-5" id="about-detalis">
    <div class="container">
        <div class="row">
         
            <div class="col-lg-12">
                <?php
                $select_query = "SELECT * FROM about_page";
                $result = mysqli_query($conn,$select_query);
                if (mysqli_num_rows($result)) {
                    $row = mysqli_fetch_assoc($result);
                ?>
                <div class="card border-0">
                    <img src="./assets/images/Tiny doctors and patients near hospital flat vector illustration.jpg" alt="" class="img-fluid">
                    <div class="card-body">
                    <div class="about_sec">
              <h1><?php echo $row['page_title'] ?></h1>
              <p><?php echo $row['page_description'] ?></p>
            </div>
                    </div>
                </div>
                <?php }  ?>
            </div>
        </div>
                
</section>

<?php

include('footer.php');

?>