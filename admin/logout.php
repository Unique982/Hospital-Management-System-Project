<?php
include('../database/config.php');
session_start();

$user_name = $_SESSION['user_name'] ?? $_SESSION ['patient_data']['name'];
$user_type = $_SESSION['user_data']['role'] ?? $_SESSION['user_type']??'patient';
// $user_id = $_SESSION['user_id'];
$ip_address = $local_ip = getHostByName(getHostName());
// $ip_address = $_SESSION['REMOTE_ADDR'];
$time = date('Y-m-d H:i:s');
$status = "unactive";
$insert_query = "INSERT INTO activity_log (user_name,user_type, ip_address, status, time) VALUES('$user_name','$user_type', '$ip_address', '$status', '$time')";
$result = mysqli_query($conn,$insert_query) or die("Query failed!");
if($result){
    session_unset();
    session_destroy();
}
header("Location:index.php");

?>