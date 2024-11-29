<?php
include('../database/config.php');
if(isset($_POST['delete_btn_set'])){
    $del_id = $_POST['delete_id'];
    $delete_query = "DELETE FROM notice_board WHERE notice_id = $del_id";
    $result = mysqli_query($conn, $delete_query);
    if($result){
        header('location:notice_board_list.php');
        exit();
    }
    else{
        echo "<script>alert('Not Delete Data')</script>";
    }
}


?>