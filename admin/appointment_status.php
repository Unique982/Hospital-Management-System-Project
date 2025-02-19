<?php 
include('../database/config.php');
if(isset($_GET['checkin'])){
    $app_id = $_GET['app_id'];

    $update_query = "UPDATE `appointments` SET `status` = 'completed' WHERE `app_id` = $app_id";
    $result = mysqli_query($conn,$update_query);
    if($result){
        header('location:appointment_list.php');
    }
    else{
        echo "Failed to update";
    }

}
if(isset($_GET['Cancel'])){
    $app_id = $_GET['app_id'];

    $update_query = "UPDATE `appointments` SET `status` = 'cancel' WHERE `app_id` = $app_id";
    $result = mysqli_query($conn,$update_query);
    if($result){
        header('location:appointment_list.php');
    }
    else{
        echo "Failed to update";
    }

}

?>