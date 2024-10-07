<?php
include('../database/config.php');
if(isset($_POST['delete'])){
    $id = $_POST['id'];
    $delete_query = "DELETE FROM medicine WHERE id = $id";
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