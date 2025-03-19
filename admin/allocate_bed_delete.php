<?php
ob_start();
session_start();
include('../database/config.php');

if (!isset($_SESSION['id'])) {
    header('location:index.php');
}
if (isset($_POST['delete_btn_set'])) {
    $del_id = $_POST['delete_id'];
    // selct 

    $slect_query = "SELECT bed_id FROM bed_allocate WHERE bed_allocate_id = $del_id";
    $result_bed = mysqli_query($conn, $slect_query);
    if (mysqli_num_rows($result_bed)) {
        $row = mysqli_fetch_assoc($result_bed);
        $bed_number = $row['bed_id'];

        $delete_query = "DELETE FROM bed_allocate WHERE bed_allocate_id = $del_id";
        $result = mysqli_query($conn, $delete_query);

        if ($result) {
        $update="UPDATE bed SET status ='available' WHERE bed_id = '$bed_number'";
        mysqli_query($conn,$update);

            header('location:allocate_bed_list.php');
            exit();
        }
    }
}
ob_end_flush();
