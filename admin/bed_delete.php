<?php 
ob_start();
session_start();
include('../database/config.php');

if(isset($_POST['delete_btn_set'])){
    $del_id = $_POST['delete_id'];
    $delete_query = "DELETE FROM bed WHERE bed_id = $del_id";
    $result = mysqli_query($conn, $delete_query) or die('Query failed');
    if($result){
        
        header('location:bed_list.php');
        exit();
    }
else{
    echo "<script>alert('Not Delete Data')</script>";
}

}
ob_end_flush();

?>