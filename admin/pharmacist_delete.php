<?php
include('../database/config.php');
if(isset($_POST['delete_btn_set'])){
    $del_id = $_POST['delete_id'];
    $delete_query = "DELETE FROM user_tbl WHERE id = $del_id";
    if(mysqli_query($conn,$delete_query)){
        // doctor table delete data 
    $delete_pharmacist = "DELETE FROM pharmacist  WHERE user_id = $del_id";
    $result = mysqli_query($conn, $delete_pharmacist);
    if($result){
        header('location:manage_pharmacist.php');
        exit();
    }
    else{
        echo "<script>alert('Not Delete Data')</script>";
    }
}
}


?>