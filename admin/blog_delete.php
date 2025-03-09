<?php
ob_start();
include('../database/config.php');
if(!isset($_SESSION['id'])){
    header('location:index.php');
}

if(isset($_POST['delete_btn_set'])){
    $del_id = $_POST['delete_id'];
    $sql = "SELECT * FROM blog WHERE id = $del_id";
    $result1 = mysqli_query($conn,$sql) or die("error");
    if(mysqli_num_rows($result1)){
    $row = mysqli_fetch_array($result1);
    unlink("Blog_img/banner/".$row['image_1']);
    unlink("Blog_img/sub_img/".$row['image_2']);
    
    $blog_delete = "DELETE FROM blog WHERE id = $del_id";
    $result = mysqli_query($conn, $blog_delete);
    if($result){
        header('location:blog_manage.php');
        exit();
    } else{
        echo "delete Failed";
    }
}
   
}
ob_end_flush();
?>