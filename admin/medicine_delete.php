<?php
include('../database/config.php');
if(isset($_POST['delete_btn_set'])){
    $del_id = $_POST['delete_id'];
    $delete_query = "DELETE FROM medicine WHERE id = $del_id";
    $result = mysqli_query($conn, $delete_query);
    if($result){
        echo "<script>alert('User Delete successfully')</script>";
        header('location:medicine_list.php');
        exit();
    }
    else{
        echo "<script>alert('Not Delete Data')</script>";
    }
}


?>