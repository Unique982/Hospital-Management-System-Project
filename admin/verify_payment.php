<?php
include('../database/config.php');
if(isset($_POST['save'])){
    $payment_id = $_POST['payment_id'];
    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $invoice_num = mysqli_real_escape_string($conn,$_POST['invoice_num']);
    $patient_id = mysqli_real_escape_string($conn,$_POST['patient_id']); 
    $amount = mysqli_real_escape_string($conn,$_POST['amount']);
    $transaction_id = rand(1000000000,9999999999);
    $payment_method = mysqli_real_escape_string($conn,$_POST['payment_method']);
    $insert_query ="INSERT INTO `payment`(`payment_type`, `transaction_id`, `invoice_id`, `patient_id`, `payment_method`, `amount`, `time`)
     VALUES ('$title','$transaction_id','$invoice_num','$patient_id','$payment_method','$amount',Now());";
    if(mysqli_query($conn,$insert_query)){
        $update_query = "UPDATE invoice SET payment_status = 'paid' WHERE invoice_id = '$payment_id'";
    }
    if(mysqli_query($conn,$update_query)){
        
$_SESSION['alert'] = "Vrefiy payment Successfully";
$_SESSION['alert_code'] = "success";
header("location:invoice_list.php");
exit();
} else {
$_SESSION['alert'] = "failed";
$_SESSION['alert_code'] = "warning";
}
}
    ?>

