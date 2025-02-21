<?php
include('header.php');
include('./database/config.php');

?>
<main>
  <!-- Hero Section -->
  <div class="slider-wrapper owl-carousel owl-theme" id="hero-slider">
    <div class="sliderOne min-vh-100 d-flex align-items-center">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <h3>Lorem ipsum dolor sit amet.</h3>
            <p class="align-text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia delectus nihil dolorem?
              <br> Rem eligendi
              voluptate in temporibus quia, natus dolorum.
            </p>
            <a href="#" class="btn btn-success">Book Appointment</a>

          </div>
        </div>
      </div>
    </div>
    <div class="sliderTwo min-vh-100 d-flex align-items-center">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <h3>Lorem ipsum dolor sit amet.</h3>
            <p class="content-justify-space">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia delectus nihil dolorem?
              <br> Rem eligendi
              voluptate in temporibus quia, natus dolorum.
            </p>
            <a href="#" class="btn btn-success">Book Appointment</a>
          </div>
        </div>
      </div>
    </div>
    <div class="sliderThree min-vh-100 d-flex align-items-center">
      <div class="container">
        <div class="row">

          <div class="col-12 col-md-6">
            <h3>Lorem ipsum dolor sit amet.</h3>
            <p class="content-justify-space">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia delectus nihil dolorem?
              <br> Rem eligendi
              voluptate in temporibus quia, natus dolorum.
            </p>
            <a href="#" class="btn btn-success">Book Appointment</a>
          </div>
        </div>
      </div>
    </div>

  </div>
  <!-- end hero section -->

  <!-- About Section -->
  <section class="about bg-light" id="about">
    <div class="container">
      <div class="row py-3 justify-content-center  text-center">
        <div class="col-12 col-lg-6">
          <h6 class="text-uppercase text-muted">About us</h6>
        </div>
      </div>
      <div class="row">
        <div class="col-12 col-lg-6">
          <div class="card-body">
            <img src="./assets/images/Tiny doctors and patients near hospital flat vector illustration.jpg" alt="">
          </div>
        </div>
        <div class="col-12 col-lg-6">
          <?php
          $select_abou_page = "SELECT * FROM about_page";
          $result = mysqli_query($conn, $select_abou_page);
          if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

          ?>
            <div class="about_sec">
              <h1><?php echo $row['page_title'] ?></h1>
              <p><?php echo substr($row['page_description'], 0, 800) ?>...</p>
              <a href="single.php" class="btn btn-danger btn-sm w-10">Read More</a>
            </div>
          <?php }  ?>
        </div>
      </div>
    </div>
  </section>
  <!-- End About Section -->
  <!--  Services Section -->
  <section class="services" id="services">
    <div class="container">
      <div class="row py-3 justify-content-center text-center ">
        <div class="col-lg-4 col-md-6 col-sm-12">
          <h6 class="text-uppercase text-muted">Services</h6>
          <p class="text-muted text-center">Providing quality healthcare services with advanced technology.</p>
        </div>
      </div>
      <div class="row g-4">
        <div class="col-lg-4 col-md-6 col-sm-12">
          <div class="py-3 card text-center">
            <i class="fas fa-user-md service-icon"></i>
            <h5 class="mt-3">Qualified Doctors</h5>
            <p class="text-muted">Highly skilled and experienced doctors available 24/7.</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
          <div class=" py-3 card text-center">
            <i class="fas fa-procedures service-icon"></i>
            <h5 class="mt-3">Emergency Care</h5>
            <p class="text-muted">24/7 emergency services with quick response and treatment.</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
          <div class="py-3 card text-center">
            <i class="fas fa-heartbeat service-icon"></i>
            <h5 class="mt-3">Heart Care</h5>
            <p class="text-muted">Advanced cardiology department with expert heart specialists.</p>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-12">
          <div class="py-3 card text-center">
            <i class="fas fa-flask service-icon"></i>
            <h5 class="mt-3">Laboratory Tests</h5>
            <p class="text-muted">High-tech labs for accurate and quick diagnostic results.</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
          <div class="py-3 card text-center">
            <i class="fas fa-ambulance service-icon"></i>
            <h5 class="mt-3">Ambulance Service</h5>
            <p class="text-muted">Quick ambulance response for emergency patient transport.</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
          <div class="py-3 card text-center">
            <i class="fas fa-clinic-medical service-icon"></i>
            <h5 class="mt-3">Pharmacy</h5>
            <p class="text-muted">24/7 pharmacy with all essential medicines and drugs.</p>
          </div>
        </div>

      </div>
    </div>
    </div>

  </section>
  <!-- End Services Section -->
   
  <!-- Team Seaction -->
   <section class="team bg-light" id="team">
    <div class="container">
      <div class="row py-3 justify-content-center text-center">
    <div class="col-lg-4 col-md-6 col-sm-12">
          <h6 class="text-uppercase text-muted">Our Team</h6>
          <p class="text-muted text-center">Our dedicated professionals ensuring the best services.</p>
        </div>
      </div>
      <div class="row g-4">
        <div class="col-lg-4 col-md-6 col-sm-12">
          <div class="card  text-center p-3">
            <div class="card-body">
              <img src="https://cdn.pixabay.com/photo/2024/02/21/15/01/doctor-8587851_960_720.png" alt="">
              <h5 class="mt-3"><small>Name: </small>Jhon</h5>
              <p class="text-dark">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae, dolores?</p>
              <div class="socail-link">
              <a href="https://www.facebook.com/neupane.unique.16"><i class="fa-brands fa-facebook"></i></a>
                    <a href="https://github.com/account"><i class="fa-brands fa-github"></i></a>
                    <a href="https://www.khemrajneupane.com.np"><i class="fa-solid fa-globe"></i></a>
                    <a href="https://www.youtube.com/@uniqueonlineupdate"><i class="fa-brands fa-youtube"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
          <div class="card text-center p-3">
            <div class="card-body">
              <img src="./assets/images/team-doctors-standing-row_107420-84772.jpg" alt="">
              <h5 class="mt-3"><small>Name: </small>Jhon</h5>
              <p class="text-dark">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae, dolores?</p>
              <div class="socail-link">
              <a href="https://www.facebook.com/neupane.unique.16"><i class="fa-brands fa-facebook"></i></a>
                    <a href="https://github.com/account"><i class="fa-brands fa-github"></i></a>
                    <a href="https://www.khemrajneupane.com.np"><i class="fa-solid fa-globe"></i></a>
                    <a href="https://www.youtube.com/@uniqueonlineupdate"><i class="fa-brands fa-youtube"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-lg-4 col-md-6">
          <div class="card  text-center p-3">
            <div class="card-body">
              <img src="https://img.freepik.com/free-photo/smiling-doctor-with-strethoscope-isolated-grey_651396-974.jpg?t=st=1740021514~exp=1740025114~hmac=ddda15b4f7562cbe4c230e930885fe7e3ecb97f6daeeafb3bede4b52bb9c9b21&w=996" alt="">
              <h5 class="mt-3"><small>Name: </small>Jhon</h5>
              <p class="text-dark">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae, dolores?</p>
              <div class="socail-link">
              <a href="https://www.facebook.com/neupane.unique.16"><i class="fa-brands fa-facebook"></i></a>
                    <a href="https://github.com/account"><i class="fa-brands fa-github"></i></a>
                    <a href="https://www.khemrajneupane.com.np"><i class="fa-solid fa-globe"></i></a>
                    <a href="https://www.youtube.com/@uniqueonlineupdate"><i class="fa-brands fa-youtube"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
          <div class="card  text-center p-3">
            <div class="card-body">
              <img src="https://img.freepik.com/free-photo/beautiful-young-female-doctor-looking-camera-office_1301-7807.jpg?t=st=1740021447~exp=1740025047~hmac=33a0876c35b3054efc8b980444ca1ebf5295bae477e3187835ad1aade6148727&w=360" alt="">
              <h5 class="mt-3"><small>Name :</small>Jhon</h5>
              <p class="text-dark">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae, dolores?</p>
              <div class="socail-link">
              <a href="https://www.facebook.com/neupane.unique.16"><i class="fa-brands fa-facebook"></i></a>
                    <a href="https://github.com/account"><i class="fa-brands fa-github"></i></a>
                    <a href="https://www.khemrajneupane.com.np"><i class="fa-solid fa-globe"></i></a>
                    <a href="https://www.youtube.com/@uniqueonlineupdate"><i class="fa-brands fa-youtube"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
          <div class="card  text-center p-3">
            <div class="card-body">
              <img src="./assets/images/team-doctors-standing-row_107420-84772.jpg" alt="">
              <h5 class="mt-3"><small>Name: </small>Jhon</h5>
              <p class="text-dark">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae, dolores?</p>
              <div class="socail-link">
              <a href="https://img.freepik.com/free-photo/portrait-smiling-young-doctors-standing-together-portrait-medical-staff-inside-modern-hospital-smiling-camera_657921-885.jpg?t=st=1740021556~exp=1740025156~hmac=6a1df83d58b37c5c983ad634cc8b5371b8390d5451b579d0cba5f62cd5603d9d&w=996"><i class="fa-brands fa-facebook"></i></a>
                    <a href="https://github.com/account"><i class="fa-brands fa-github"></i></a>
                    <a href="https://www.khemrajneupane.com.np"><i class="fa-solid fa-globe"></i></a>
                    <a href="https://www.youtube.com/@uniqueonlineupdate"><i class="fa-brands fa-youtube"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
          <div class="card text-center p-3">
            <div class="card-body">
              <img src="https://img.freepik.com/free-photo/handsome-smiling-medical-professional-examining-with-stethoscope-colored-background_662251-366.jpg?t=st=1740021625~exp=1740025225~hmac=c638917d2bc6069203699b170f17e59a8b560ae3bd2c6a5962f23d4bd527ebdc&w=740" alt="">
              <h5 class="mt-3"><small>Name: </small>Jhon</h5>
              <p class="text-dark">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae, dolores?</p>
              <div class="socail-link">
              <a href="https://www.facebook.com/neupane.unique.16"><i class="fa-brands fa-facebook"></i></a>
                    <a href="https://github.com/account"><i class="fa-brands fa-github"></i></a>
                    <a href="https://www.khemrajneupane.com.np"><i class="fa-solid fa-globe"></i></a>
                    <a href="https://www.youtube.com/@uniqueonlineupdate"><i class="fa-brands fa-youtube"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
    </div>

   </section>

  <!-- Blog Section -->

  <section class="blog" id="blog">
    <div class="container">
      <div class="row justify-content-center  text-center">
        <div class="col-sm-12 col-lg-4 col-md-6">
          <h6 class="text-uppercase text-muted">Our Blog</h6>
          <h1 class='text-muted py-3'>Lastest Blog Post</h1>
        </div>
      </div>

      <div class="row g-4 mb-4">
        <div class="col-sm-12 col-lg-4 col-md-6">
          <div class="card">
            <div class="card-body">
              <div class="blog-post">
                <img src="./assets/images/team-doctors-standing-row_107420-84772.jpg" alt="" class="img-fluid">
                <small class="text-muted">12-Feb, 2025</small>
                <a href="single.php">
                  <h3>Lorem ipsum dolor sit amet consectetur.</h3>
                </a>
                <p class="text-dark ">Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                  Repellendus, dolor eligendi <br>pariatur neque iste nihil quos ducimus
                  dicta tempore consectetur repudiandae,<br> distinctio non explicabo
                  dolorum delectus laboriosam impedit nobis beatae!</p>
                <a href="single.php" class="btn btn btn-danger btn-sm">Read More</a>
              </div>
            </div>
          </div>
        </div>

        <div class=" col-sm-12 col-lg-4 col-md-6">
          <div class="card">
            <div class="card-body">
              <div class="blog-post">
                <img src="./assets/images/team-young-specialist-doctors-standing-corridor-hospital_1303-21199.avif" alt="" class="img-fluid">
                <small class="text-muted p-3">12-Feb, 2025</small>
                <a href="">
                  <h3>Lorem ipsum dolor sit amet consectetur.</h3>
                </a>
                <p class="text-dark">Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                  Repellendus, dolor eligendi <br>pariatur neque iste nihil quos ducimus
                  dicta tempore consectetur repudiandae,<br> distinctio non explicabo
                  dolorum delectus laboriosam impedit nobis beatae!</p>
                <a href="#" class="btn btn btn-danger btn-sm">Read More</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-lg-4 col-md-6">
          <div class="card">
            <div class="card-body">
              <div class="blog-post">
                <img src="./assets/images/freepik__the-style-is-candid-image-photography-with-natural__70005.png" alt="" class="img-fluid">
                <small class="text-muted">12-Feb, 2025</small>
                <a href="single.php">
                  <h3>Lorem ipsum dolor sit amet consectetur.</h3>
                </a>
                <p class="text-dark">Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                  Repellendus, dolor eligendi <br>pariatur neque iste nihil quos ducimus
                  dicta tempore consectetur repudiandae,<br> distinctio non explicabo
                  dolorum delectus laboriosam impedit nobis beatae!</p>
                <a href="single.php" class="btn btn btn-danger btn-sm">Read More</a>
              </div>
            </div>
          </div>
        </div>
        

      </div>
    </div>
  </section>

  <!-- Contact Section -->
   <section class="contact bg-body-tertiary " id="contact">
    <div class="container">
      <div class="row py-3 justify-content-center text-center">
        <div class="col-sm-12 col-lg-4 col-md-6">
        <h6 class="text-uppercase text-muted ">Contact Us</h6>
        <p class="text-muted text-justify">A hospital contact page provides essential contact details, including phone, email, address, and a form for inquiries or appointments.</p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="row">
              <div class="col-md-8">
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14130.927001396652!2d85.33981834999997!3d27.694684600000016!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb199a06c2eaf9%3A0xc5670a9173e161de!2sNew%20Baneshwor%2C%20Kathmandu%2044600!5e0!3m2!1sen!2snp!4v1740023921844!5m2!1sen!2snp" width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
          
            <div class="col-md-4">
              <div class="card-body">
                <h3 class="text-center text-muted">Contact Form</h3>
              <form action="">
                <div class="form-group mb-2">
                  <label for="">Name:</label>
                  <input type="text" class="form-control" placeholder="Enter Your Name">
                </div>
                <div class="form-group mb-2">
                  <label for="">Email:</label>
                  <input type="email" class="form-control" placeholder="Enter Your Email">
                </div>
                <div class="form-group mb-2">
                  <label for="">Phone:</label>
                  <input type="number" class="form-control" placeholder="Enter Your Phone">
                </div>
                <div class="form-group mb-2">
                  <label for="">Message:</label>
               <textarea name="message" id="message" rows="5" cols="5" class="form-control"></textarea>
                </div>
                <div class="form-group mb-2">
                <button type="submit" name="contact_us" class="btn btn-primary btn-sm w-100">Submit</button>
                </div>
              </form>
              </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
   </section>

  <!-- End Blog Section -->
</main>
<?php
include('footer.php');
?>