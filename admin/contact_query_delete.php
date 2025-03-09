<?php 
ob_start();
include('../database/config.php');
if(!isset($_SESSION['id'])){
    header('location:index.php');
}

if(isset($_POST['delete_btn_set'])){
    $del_id = $_POST['delete_id'];
    $delete_query = "DELETE FROM query_contact WHERE id = $del_id";
    $result = mysqli_query($conn, $delete_query) or die('Query failed');
    if($result){
        
        header('location:read_contact.php');
        exit();
    }
else{
    echo "<script>alert('Not Delete Data')</script>";
}

}
ob_end_flush();

?>