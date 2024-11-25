<?php
include('../database/config.php');
if(isset($_POST['delete_btn_set'])){
    $del_id = $_POST['delete_id'];
    $delete_query = "DELETE FROM user_tbl WHERE id = $del_id";
    $result = mysqli_query($conn, $delete_query);
    if($result){
      
        header('location:employee_add.php');
        exit();
    }
    else{
        echo "<script>alert('Not Delete Data')</script>";
    }
}


?>