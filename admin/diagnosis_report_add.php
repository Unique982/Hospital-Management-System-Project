<?php 
ob_start();
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');

 if(isset($_POST['add_diagnosis'])){
    $prescription_id = mysqli_real_escape_string($conn,$_POST['prescription_id']);
    $report_type = mysqli_real_escape_string($conn,$_POST['report_type']);
    $document_type = mysqli_real_escape_string($conn,$_POST['document_type']);
    $des = mysqli_real_escape_string($conn,$_POST['des']);
   

    // image upload 
    $file_name = $_FILES['upload_doc']['name'];
   $file_temp = $_FILES['upload_doc']['tmp_name'];
   $file_type = $_FILES['upload_doc']['type'];
   $file_ext = end(explode(".",$file_name));
   $extensions = array("jpg","png","jpeg","pdf","excel","doc","other");
   $target = "Diagnosis_Report_Doc/".$file_name;
   if(move_uploaded_file($file_temp,$target)){
    // insert query 
    $insert_query = "INSERT INTO `diagnosis_report`(`report_type`, `document_type`, `file_name`, `description`, `prescription_id`) 
    VALUES('$report_type','$document_type','$target','$des','$prescription_id') ";
    
    if(mysqli_query($conn,$insert_query)){
        $_SESSION['alert'] = "Added Successfully";
            $_SESSION['alert_code'] = "success";
            header('location:manage_prescription.php');
            exit();
    }
    else {
        $_SESSION['alert'] = "Failed";
        $_SESSION['alert_code'] = "error";
    }
   }

 }
ob_end_flush();
?>