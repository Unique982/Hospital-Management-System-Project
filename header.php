<!doctype html>
<html lang="en">

<head>
  <?php
  include('./database/config.php');
  $select_title = "SELECT * FROM setting";
  $result = mysqli_query($conn, $select_title);
  if (mysqli_num_rows($result)) {
    $row = mysqli_fetch_assoc($result);

  ?>
    <title><?php echo $row['website_title'] ?></title>
    <!-- Required meta tags -->

    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no" />

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

    <link rel="apple-touch-icon" sizes="180x180" href="./assets/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/favicon//favicon-16x16.png">
    <link rel="manifest" href="./assets/favicon/site.webmanifest">
</head>

<body data-bs-spy="scroll" data-bs-target=".navbar">
  <header>
    <nav class="navbar navbar-expand-lg bg-light sticky-top">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php"><?php echo $row['website_name'] ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0 ">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="#about">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="#services">Services</a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="#team">Team</a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="#blog">Blog</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#contact">Contact us</a>
            </li>
            <li class="nav-item">
              <a href="./admin/index.php"><button class="btn btn-success ms-lg-3">Login</button></a>
            </li>
          </ul>

        </div>
      </div>
    </nav>
  </header>
<?php } ?>