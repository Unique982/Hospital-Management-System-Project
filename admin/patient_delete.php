<?php 
ob_start();
include('../database/config.php');

if(!isset($_SESSION['id'])){
    header('location:index.php');
}

if(isset($_POST['delete_btn_set'])){
    $del_id = $_POST['delete_id'];
    $delete_query_user = "DELETE FROM user_tbl WHERE id = $del_id";
    if(mysqli_query($conn,$delete_query_user )){
        // pateint table delete data 
    $delete_query ="DELETE FROM patient  WHERE user_id = $del_id";
    $result = mysqli_query($conn, $delete_query);
    if($result){
        header('location:patient_list.php');
        exit();
    }
    else{
        echo "<script>alert('Not Delete Data')</script>";
    }
}
}

ob_end_flush();
?>