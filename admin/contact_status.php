<?php 
include('../database/config.php');
if(isset($_GET['contact_status'])){
    $id = $_GET['id'];

    $update_query = "UPDATE `query_contact` SET `status` = 'read' WHERE `id` = $id";
    $result = mysqli_query($conn,$update_query);
    if($result){
        header('location:read_contact.php');
    }
    else{
        echo "Failed to update";
    }

}
?>