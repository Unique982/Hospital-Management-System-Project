<?php
include('../database/config.php');
if(isset($_POST['delete'])){
    $id = $_POST['id'];
    $delete_query = "DELETE FROM `specialization` WHERE id = '$id'";
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