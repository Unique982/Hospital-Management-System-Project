<?php
include('./database/config.php');
?>
<footer class="bg-white text-dark py-5">
    <div class="container">
        <div class="row">
            <?php
            $select_query = "SELECT * FROM about_page";
            $result = mysqli_query($conn, $select_query);
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);

            ?>
                <div class="col-sm-12 col-lg-3 col-md-6">
                    <h1 class="footer-head"><?php echo $row['page_title'] ?></h1>
                    <p><?php echo substr($row['page_description'],0,200)?>..</p>
                </div>
            <?php } ?>
            <div class="col-sm-12 col-lg-3 col-md-6">
                <?php
                $select_setting = "SELECT * FROM contact_page";
                
                $result1 = mysqli_query($conn, $select_setting);
                if (mysqli_num_rows($result1) > 0) {
                    $row1 = mysqli_fetch_assoc($result1);

                ?>
                    <h1 class="footer-head">Contact Us</h1>
                    <ul class="contact_info">
                        <li><strong>Phone: </strong><a href="tel:<?php echo $row1['phone_num']; ?>"> <?php echo $row1['phone_num']; ?></a></li>
                        <li> <strong>Email:</strong><a href="mailto:<?php echo $row1['email']; ?>"> <?php echo $row1['email']; ?></a></li>
                        <li><strong>Address:</strong><a href="map:<?php echo $row1['address']; ?>"> <?php echo $row1['address']; ?></a></li>
                        <li><strong>tel: </strong><a href="tel:<?php echo $row1['tel_number']; ?>"> <?php echo $row1['tel_number']; ?></a></li>
                    </ul>
            </div>
            <?php }  ?>

            <div class="col-sm-12 col-lg-3 col-md-6">
                <h1 class="footer-head">Quick Links</h1>
                <ul>
                    <li><a href="#" class="quick-link">Home</a></li>
                    <li><a href="#" class="quick-link">About</a></li>
                    <li><a href="#" class="quick-link">Services</a></li>
                    <li><a href="#" class="quick-link">Team</a></li>
                    <li><a href="#" class="quick-link">Blog</a></li>
                    <li><a href="#" class="quick-link">Contact US</a></li>
                </ul>

            </div>
            <div class="col-sm-12 col-lg-3 col-md-6">
                <h1 class="footer-head">Follow US</h1>
                <div class="socail-link">
                    <a href="https://www.facebook.com/neupane.unique.16"><i class="fa-brands fa-facebook"></i></a>
                    <a href="https://github.com/account"><i class="fa-brands fa-github"></i></a>
                    <a href="https://www.khemrajneupane.com.np"><i class="fa-solid fa-globe"></i></a>
                    <a href="https://www.youtube.com/@uniqueonlineupdate"><i class="fa-brands fa-youtube"></i></a>
                </div>
            </div>
    
    <div class="footer-bottom">
        <div class="container">
            <?php
            $select_footer = "select * from setting";
            $result = mysqli_query($conn,$select_footer);
            if(mysqli_num_rows($result)){
                $row = mysqli_fetch_assoc($result);
            
            
            ?>
            <div class="row">
            <p class="text-center"><?php echo $row['footer']; ?> </p>
            </div>
         <?php  } ?>
        </div>
    </div>
                </div>
                </div>

</footer>
<!-- Bootstrap JavaScript Libraries -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script
    src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
    crossorigin="anonymous"></script>

<script src="./assets/js/owl.carousel.min.js"></script>
<script src="./assets/js/app.js"></script>

</body>

</html>