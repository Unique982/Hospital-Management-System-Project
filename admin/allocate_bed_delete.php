<?php
include('../database/config.php');
if(isset($_POST['delete_btn_set'])){
    $del_id = $_POST['delete_id'];
    $delete_query = "DELETE FROM bed_allocate WHERE bed_allocate_id = $del_id";
    $result = mysqli_query($conn, $delete_query);
    if($result){
      
        header('location:allocate_bed_list.php');
        exit();
    }
  
}


?>