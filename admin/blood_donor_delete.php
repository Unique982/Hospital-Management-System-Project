<?php
include('../database/config.php');
if(isset($_POST['delete_btn_set'])){
$del_id = $_POST['delete_id'];
$delete_query = "DELETE FROM blood_donors WHERE blood_donor_id ='$del_id'";
$result = mysqli_query($conn, $delete_query);
    if($result){
        header('location:blood_donor_list.php');
        exit();
    }
else{
    echo "<script>alert('Not Delete Data')</script>";
}
}


?>