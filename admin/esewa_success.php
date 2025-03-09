<?php
session_start();
include('../database/config.php');

$invoice_id =$_GET['id'];
$transaction_uuid =rand(1000000000,9999999999);


//feth
$select_query = "SELECT * FROM invoice WHERE invoice_id = '$invoice_id'";
// $select_query = "SELECT * FROM invoice WHERE invoice_id = '$invoice_id'";
$result = mysqli_query($conn,$select_query);

if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_assoc($result);
    $invoice_num = $row['invoice_id'];
    $payment_type = $row['title'];
    $patient = $row['patient_id'];
    $amount = $row['amount'];
    $payment_method = $row['payment_method'];

//Update Query
$update = "UPDATE invoice  SET payment_status ='paid' WHERE invoice_id ='$invoice_id'";
if(mysqli_query($conn,$update)){
    $insert_sql = "INSERT INTO payment (invoice_id, payment_type, patient_id, amount, payment_method, transaction_id, time)
    VALUES('$invoice_num','$payment_type','$patient','$amount','$payment_method',$transaction_uuid,NOW())";
   
    if(mysqli_query($conn,$insert_sql)){
        $_SESSION['alert'] = "Payment Success!";
    $_SESSION['alert_code'] = "success";
    }else{
        $_SESSION['alert'] = "Failed Payment Success!";
    $_SESSION['alert_code'] = "error";
    }}else{
        $_SESSION['alert'] = "Invoice update failed!";
        $_SESSION['alert_code'] = "error";
    }
    header("location: invoice_list.php"); 
    exit();
}


?>