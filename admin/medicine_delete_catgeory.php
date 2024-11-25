<?php
include('../database/config.php');
if(isset($_POST['delete_btn_set'])){
    $del_id = $_POST['delete_id'];
    $delete_query = "DELETE FROM medicine_cat WHERE id = $del_id";
    $result = mysqli_query($conn, $delete_query);
    if($result){
        echo "<script>alert('Delete successfully')</script>";
        header('location:medicine_list_catgeory.php');
        exit();
    }
    else{
        echo "<script>alert('Not Delete Data')</script>";
    }
}


?>