<?php
include('../database/config.php');
$select_query = "SELECT * FROM setting";
$result = mysqli_query($conn, $select_query);
 $title = "";
 if($row=mysqli_fetch_assoc($result)){
    $title = $row['website_title'];
 }

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $title; ?></title>
    

    <!-- Custom fonts for this template-->
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

           <link href="./assets/css/style.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">
    <!-- <script src="https://khalti.com/static/khalti-checkout.js"></script> -->
    <link rel="apple-touch-icon.png" type="image/png" sizes="512*512" href="./assets/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="512*512" href="../assets/favicon/android-chrome-512x512.png"
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/favicon/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="96x96" href="../assets/favicon/favicon-96x96.png">
    <link rel="manifest" href="../assets/favicon/site.webmanifest">
    <!-- tag input -->
    <link rel="stylesheet" href="../assets/css/bootstrap-tagsinput.css">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
