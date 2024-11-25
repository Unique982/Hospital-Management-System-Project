<?php 
if(!isset($_SESSION['user_name'])){
    header("location:index.php");
}
include('../database/config.php');
if(isset($_POST['delete_btn_set'])){
    $del_id = $_POST['delete_id'];
    $delete_query = "DELETE FROM patient WHERE patient_id = $del_id";
    $result = mysqli_query($conn, $delete_query) or die('Query failed');
    if($result){
        echo "<script>alert('Patient Delete successfully')</script>";
        header('location:patient_list.php');
        exit();
    }
else{
    echo "<script>alert('Not Delete Data')</script>";
}

}


?>