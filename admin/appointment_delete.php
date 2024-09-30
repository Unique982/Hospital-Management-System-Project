<?php

include('../database/config.php');
session_start();
if(isset($_POST['delete'])){
$id = $_POST['id'];
$delete_query = "DELETE FROM appointments WHERE id ='$id'";
$result = mysqli_query($conn, $delete_query);
    if($result){
        $_SESSION['alert'] =" Delete Successfully appointment";
        $_SESSION['alert_code'] ="success";
        header('location:appointment_list.php');
        exit();
    }
else{
    $_SESSION['alert'] ="Detele Failed";
    $_SESSION['alert_code'] ="error";

}
}
?>
<?php

include('includes/scripts.php');
?>