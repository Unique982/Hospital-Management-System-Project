<?php
include('../database/config.php');
if(isset($_POST['delete'])){
    $id = $_POST['id'];
    $delete_query = "DELETE FROM user_tbl WHERE id = $id";
    $result = mysqli_query($conn, $delete_query);
    if($result){
        echo "<script>alert('User Delete successfully')</script>";
        header('location:employee_add.php');
        exit();
    }
    else{
        echo "<script>alert('Not Delete Data')</script>";
    }
}


?>