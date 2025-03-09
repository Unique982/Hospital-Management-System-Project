<?php
ob_start();
include('../database/config.php');

if(!isset($_SESSION['id'])){
    header('location:index.php');
}


if(isset($_POST['delete_btn_set'])){
$del_id = $_POST['delete_id'];
$delete_query = "DELETE FROM appointments WHERE app_id =$del_id";
$result = mysqli_query($conn, $delete_query);
    if($result){
        header('location:appointment_list.php');
        exit();
    }
else{
   echo "failed to delete";

}
}
ob_end_flush();
?>
