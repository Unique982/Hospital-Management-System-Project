<?php
ob_start();
include('../database/config.php');
$_SESSION['alert'] = "Payment failed!";
$_SESSION['alert_code'] = "success";
header("location:invoice_list.php");
?>
