<?php 
ob_start();
include('../database/config.php');

if(!isset($_SESSION['id'])){
    header('location:index.php');
}

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
ob_end_flush();
?>