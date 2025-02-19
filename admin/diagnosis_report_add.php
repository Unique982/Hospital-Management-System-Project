<?php
ob_start();
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');

$user_id = $_SESSION['id'];

$_SESSION['error'] = [
    'report_type' => '',
    'document_type' => '',
    'desc' => '',
    'upload_doc' =>''

];


if (isset($_POST['add_diagnosis'])) {
    
    $laboratorist_id = $_SESSION['id'];
    $patient_id = mysqli_real_escape_string($conn,$_POST['patient_id']);
    $prescription_id = mysqli_real_escape_string($conn, $_POST['prescription_id']);
    $report_type = mysqli_real_escape_string($conn, $_POST['report_type']);
    $document_type = mysqli_real_escape_string($conn, $_POST['document_type']);
    $des = mysqli_real_escape_string($conn, $_POST['des']);

    // validation code 
    if (empty($report_type)) {
        $_SESSION['error']['report_type'] = 'Report Type is required';
    } elseif (!preg_match('/^[a-zA-Z\s]+$/', $report_type)) {
        $_SESSION['error']['report_type'] = 'Only use letter and space allwoed';
    }

    // validation des
    if (empty($des)) {
        $_SESSION['error']['des'] = 'Description is required';
    }
    // image upload 
    $file_name = $_FILES['upload_doc']['name'];
    $file_temp = $_FILES['upload_doc']['tmp_name'];
    $file_type = $_FILES['upload_doc']['type'];
    $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
    $extensions = array("jpg", "png", "jpeg", "pdf", "xls","xlsx","other");
    $target = "Diagnosis_Report_Doc/" . $file_name;

    // docutype validation 
    $images_ext = ['"jpg", "png", "jpeg"'];
    $exl =["xls","xlsx"];
    if (empty($document_type) || $document_type=='Select Document Type') {
        $_SESSION['error']['upload_doc'] = 'Document type is required';
    }elseif($document_type=='pdf' && $file_ext!='pdf'){
        $_SESSION['error']['upload_doc'] = 'Plase upload a valid file pdf!';
}elseif($document_type=='pdf' && $file_ext!='pdf'){
    $_SESSION['error']['upload_doc'] = 'Plase upload a pdf!';
} 
elseif($document_type=='image' && in_array($file_ext,$images_ext)){
    $_SESSION['error']['upload_doc'] = 'Plase upload a valid image filejpg,jpeg,png!';
}
elseif($document_type=='excel' && in_array($file_ext,$exl)){
    $error['document_type'] = 'Plase upload a valid excel file xls xlsx!';
}elseif($document_type=='other' && $file_ext!=='other'){
    $_SESSION['error']['upload_doc'] = 'Plase upload a valid file other!';
}

if(empty(array_filter( $_SESSION['error']))){
        // check record exit or not
        $select_query = "SELECT * FROM diagnosis_report WHERE prescription_id='$prescription_id'";
        $result = mysqli_query($conn, $select_query) or die("Query failed");
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
          
        
        // new img upload delete old img
 
}

        if (!empty($file_name) && in_array($file_ext, $extensions)) {
            if (move_uploaded_file($file_temp, $target)) {
                if (mysqli_num_rows($result) > 0) {

                    $update_query = "UPDATE diagnosis_report SET report_type='$report_type', document_type='$document_type', file_name ='$target',description='$des' WHERE
     prescription_id='$prescription_id'";
                    if (mysqli_query($conn, $update_query)) {
                        $_SESSION['alert'] = "Update Successfully";
                        $_SESSION['alert_code'] = "success";
                        header('location:manage_prescription.php');
                        exit();
                    } else {
                        $_SESSION['alert'] = "Failed";
                        $_SESSION['alert_code'] = "error";
                    }
                } else {
                    // insert query

                    $insert_query = "INSERT INTO `diagnosis_report`(`report_type`, `document_type`, `file_name`, `description`, `prescription_id`,`laboratorist_id`,`patient_id`) 
    VALUES('$report_type','$document_type','$target','$des','$prescription_id','$laboratorist_id','$patient_id')";

                    if (mysqli_query($conn, $insert_query)) {
                        $_SESSION['alert'] = "Added Successfully";
                        $_SESSION['alert_code'] = "success";
                        header('location:manage_prescription.php');
                        exit();
                    } else {
                        $_SESSION['alert'] = "Failed";
                        $_SESSION['alert_code'] = "error";
                    }
                }
            } else {
                $_SESSION['alert'] = "invalid File type";
                $_SESSION['alert_code'] = "error";
            }
        }
    }
}

ob_end_flush();
?>