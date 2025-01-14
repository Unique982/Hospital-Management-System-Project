<?php 
include('../database/config.php');
if(isset($_GET['checkin'])){
    $id = $_GET['id'];

    $update_query = "UPDATE `appointments` SET `status` = 'completed' WHERE `id` = $id";
    $result = mysqli_query($conn,$update_query);
    if($result){
        header('location:appointment_list.php');
    }
    else{
        echo "Failed to update";
    }

}

?>