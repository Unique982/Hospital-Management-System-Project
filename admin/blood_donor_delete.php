<?php
include('../database/config.php');
if(isset($_POST['delete'])){
$blood_donor_id = $_POST['blood_donor_id'];
$delete_query = "DELETE FROM blood_donors WHERE blood_donor_id ='$blood_donor_id'";
$result = mysqli_query($conn, $delete_query);
    if($result){
        echo "<script>alert('Blood Donor Reacord  Delete successfully')</script>";
        header('location:blood_donor_list.php');
        exit();
    }
else{
    echo "<script>alert('Not Delete Data')</script>";
}
}


?>