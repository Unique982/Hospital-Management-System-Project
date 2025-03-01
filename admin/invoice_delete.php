<?php
ob_start();
session_start();
include('../database/config.php');


if(isset($_POST['delete_btn_set'])){
    $del_id = $_POST['delete_id'];
    $delete_query = "DELETE FROM invoice WHERE invoice_id = $del_id";
    $result = mysqli_query($conn, $delete_query);
    if($result){
        
        header('location:invoice_list.php');
        exit();
    }
}


?>