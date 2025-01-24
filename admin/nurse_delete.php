<?php
include('../database/config.php');
if(isset($_POST['delete_btn_set'])){
    $del_id = $_POST['delete_id'];
    $delete_query = "DELETE FROM user_tbl WHERE id = $del_id";
    if(mysqli_query($conn,$delete_query)){
        // doctor table delete data 
    $nurse_doctor = "DELETE FROM nurse WHERE user_id = $del_id";
    $result = mysqli_query($conn, $nurse_doctor);
    if($result){
        header('location:manage_nurse.php');
        exit();
    }
    else{
        echo "<script>alert('Not Delete Data')</script>";
    }
}
}


?>