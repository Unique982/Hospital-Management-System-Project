<?php 
include('../database/config.php');
if(isset($_POST['delete'])){
    $bed_id = $_POST['bed_id'];
    $delete_query = "DELETE FROM bed WHERE bed_id = $bed_id";
    $result = mysqli_query($conn, $delete_query) or die('Query failed');
    if($result){
        echo "<script>alert('Bed Delete successfully')</script>";
        header('location:bed_list.php');
        exit();
    }
else{
    echo "<script>alert('Not Delete Data')</script>";
}

}


?>