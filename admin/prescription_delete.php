<?php

include('../database/config.php');
session_start();
if(isset($_POST['delete_btn_set'])){
$del_id = $_POST['delete_id'];
$delete_query = "DELETE FROM prescription WHERE id =$del_id";
$result = mysqli_query($conn, $delete_query);
    if($result){
        header('location:manage_prescription.php');
        exit();
    }
else{
   echo "failed to delete";

}
}
?>
