<?php
ob_start();
include('../database/config.php');

if(!isset($_SESSION['id'])){
    header('location:index.php');
}
if(isset($_POST['delete_btn_set'])){
    $del_id = $_POST['delete_id'];
    $delete_query = "DELETE FROM report WHERE rep_id  = $del_id";
    $result = mysqli_query($conn, $delete_query);
    if($result){
        header('location:manage_report.php');
        exit();
    }
    else{
        echo "<script>alert('Not Delete Data')</script>";
    }
}
ob_end_flush();

?>