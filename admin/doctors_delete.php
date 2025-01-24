<?php
include('../database/config.php');
if(isset($_POST['delete_btn_set'])){
    $del_id = $_POST['delete_id'];
    $delete_query = "DELETE FROM user_tbl WHERE id = $del_id";
    if(mysqli_query($conn,$delete_query)){
        // doctor table delete data 
    $delete_doctor = "DELETE FROM doctors WHERE user_id = $del_id";
    $result = mysqli_query($conn, $delete_doctor);
    if($result){
        header('location:manage_doctor.php');
        exit();
    }
    else{
        echo "<script>alert('Not Delete Data')</script>";
    }
    
}
}


?>
