<?php
include('./database/config.php');
$current_page = basename($_SERVER['PHP_SELF']);
$select_title = "SELECT * FROM setting";
$result = mysqli_query($conn, $select_title);
if (mysqli_num_rows($result)) {
  $row = mysqli_fetch_assoc($result);
  $website_page_title = $row['website_title'];
?>

<!doctype html>
<html lang="en">

<head>

  <!-- Required meta tags -->

  <meta charset="utf-8" />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title><?php echo $website_page_title; ?></title>
  <!-- Bootstrap CSS v5.2.1 -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
    crossorigin="anonymous" />
  <link href="./assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="./assets/css/style.css" rel="stylesheet">

  <link rel="stylesheet" href="./assets/css/owl.carousel.min.css">
  <link rel="stylesheet" href="./assets/css/owl.theme.default.min.css">

  <link rel="apple-touch-icon.png" type="image/png" sizes="512*512" href="./assets/favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="512*512" href="./assets/favicon/android-chrome-512x512.png"
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="./assets/favicon/favicon-16x16.png">
  <link rel="icon" type="image/png" sizes="96x96" href="./assets/favicon/favicon-96x96.png">
  <link rel="manifest" href="./assets/favicon/site.webmanifest">
 
</head>

<body data-bs-spy="scroll" data-bs-target=".navbar">
  <header class="sticky-top">
    <nav class="navbar navbar-expand-lg bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php"><?php echo $row['website_name'] ?></a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <!-- <span class="navbar-toggler-icon"></span> -->
          <i class="fa-solid fa-bars-staggered"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0 ">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="<?php echo ($current_page == 'single.php' ||  $current_page=='about_detalis_page.php' ) ? 'index.php#about' : '#about'; ?>">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="<?php echo ($current_page == 'single.php' ||  $current_page=='about_detalis_page.php') ? 'index.php#services' : '#services'; ?>">Services</a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="<?Php echo ($current_page == 'single.php' ||  $current_page=='about_detalis_page.php') ? 'index.php#team' : '#team'; ?>">Team</a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="<?php echo ($current_page == 'single.php' ||  $current_page=='about_detalis_page.php') ? 'index.php#blog' : '#blog'; ?>">Blog</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo ($current_page == 'single.php' ||  $current_page=='about_detalis_page.php') ? 'index.php#contact' : '#contact'; ?>">Contact us</a>
            </li>
            <li class="nav-item">
              <a href="./admin/index.php"><button class="btn btn-primary ms-lg-3">Login</button></a>
            </li>
          </ul>

        </div>
      </div>
    </nav>
  </header>

  <?php }  ?>