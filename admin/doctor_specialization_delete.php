<?php
include('../database/config.php');
if(isset($_POST['delete_btn_set'])){
    $del_id = $_POST['delete_id'];
    $delete_query = "DELETE FROM `specialization` WHERE id = $del_id";
    $result = mysqli_query($conn,  $delete_query);
    if($result){
        header("Location:doctor_specialization.php ");
        exit();

    }
    else{
        echo "Failed To Delete";
    }
}


?>