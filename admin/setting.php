<?php
ob_start();
include("./includes/header.php");
include("./includes/navbar.php");
include('../database/config.php');

if(!isset($_SESSION['id'])){
    header('location:index.php');
}

if(isset($_POST['save'])){
    $id = mysqli_real_escape_string($conn,$_POST['id']);
    $sm_name = mysqli_real_escape_string($conn,$_POST['sm_name']);
    $sm_title = mysqli_real_escape_string($conn,$_POST['sm_title']);
    $footer = mysqli_real_escape_string($conn,$_POST['footer']);
 $update_query = "UPDATE setting SET website_name = '$sm_name', 
  website_title = '$sm_title',
  footer = '$footer' WHERE id=$id";
if(mysqli_query($conn,$update_query)){
    $_SESSION['alert'] = "Update Successfully";
    $_SESSION['alert_code'] = "success";
}
else{
    $_SESSION['alert'] = "Failed Update";
                $_SESSION['alert_code'] = "error";
}
}
ob_end_flush();
?>
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header">
                    Add Setting
                </div>
                <?php 
             
                $select_query = "SELECT * FROM setting ";
                $result = mysqli_query($conn,$select_query) or die("Error Query");
                if(mysqli_num_rows($result)>0){
                    while($record = mysqli_fetch_assoc($result)){ 
                ?>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $record['id'] ?>">  
                    <div class="form-group">
                            <label for="">System Name</label>
                            <input type="text" name="sm_name" value="<?php echo $record['website_name'] ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">System Title</label>
                           <input type="text" name="sm_title" value="<?php echo $record['website_title'] ?>"  class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Footer</label>
                            <textarea name="footer" class="form-control"  id=""><?php echo $record['footer'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="save" class="btn btn-outline-primary">Save Setting</button>
                        </div>
                    </form>
                    <?php
                    }}
                    
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php
    include('./includes/scripts.php');
    include('./includes/footer.php');
    ?>