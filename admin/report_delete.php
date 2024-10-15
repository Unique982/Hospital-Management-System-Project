<?php
include('../database/config.php');
if(isset($_POST['delete'])){
    $id = $_POST['id'];
    $delete_query = "DELETE FROM report WHERE rep_id  = $id";
    $result = mysqli_query($conn, $delete_query);
    if($result){
        echo "<script>alert('Delete successfully')</script>";
        header('location:manage_report.php');
        exit();
    }
    else{
        echo "<script>alert('Not Delete Data')</script>";
    }
}


?>