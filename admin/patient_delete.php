<?php 
include('../database/config.php');
if(isset($_POST['delete'])){
    $patient_id = $_POST['patient_id'];
    $delete_query = "DELETE FROM patient WHERE patient_id = $patient_id";
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