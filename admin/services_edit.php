<?php 
ob_start();
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');

if(!isset($_SESSION['id'])){
    header('location:index.php');
}

$errors = [
 
    'service_icon'=>'',
    'service_name'=>'',
    'service_slug'=>'',
];
if(isset($_POST['service_update'])){
   $id = mysqli_real_escape_string($conn,$_POST['id']);
    $service_name = mysqli_real_escape_string($conn,$_POST['service_name']);
    $service_slug = mysqli_real_escape_string($conn,$_POST['service_slug']);

    $new_service_icon= $_POST['old_icon'];
    if (!empty($_FILES['new_service_icon']['name'])) {
        $file_icon = $_FILES['new_service_icon']['name'];
        $file_temp_icon = $_FILES['new_service_icon']['tmp_name'];
        $file_type = $_FILES['new_service_icon']['type'];
        $file_ext = pathinfo($file_icon, PATHINFO_EXTENSION);
        $extensions = array('jpg', 'png', 'jpeg','svg');
        
     if(in_array($file_ext, $extensions)){
        $new_service_icon = time(). "--" .basename($file_icon);
        $target_folder= "Service_icon/" . $new_service_icon;
        if (!move_uploaded_file($file_temp_icon, $target_folder)) {
            $errors['service_icon'] = "upload failed";
        }
    }
    else{
        $errors['service_icon'] = "Plase Upload a valid file png, jpg or jpeg";
    }
}
    if(empty($service_name)){
        $errors['service_name'] = "Service name is required";
    }
    elseif(!preg_match('/^[a-zA-Z\s]+$/',$service_name)){
      $errors['service_name'] ="Only use letter or space allwoed";
    }

    if(empty($service_slug)){
        $errors['service_slug'] = "Service slug is required";
    }

   if(empty(array_filter($errors))){
        $update_query ="UPDATE `services_page` SET `icon`='$new_service_icon',`services_name`='$service_name',
        `services_slug`='$service_slug' WHERE id = $id"; 
        if(mysqli_query($conn,$update_query)){
            $_SESSION['alert'] ="Update successfully!";
            $_SESSION['alert_code'] ="success";
            header('location:services_manage.php');
            exit();
        } else{
            $_SESSION['alert'] ="Update Failed";
            $_SESSION['alert_code'] ="error";
        }
    }
}

ob_end_flush();

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header">
                  Update Services
                </div>
           <?php 
           $id = $_GET['id'];
           $select_data = "SELECT * FROM services_page WHERE id = $id";
           $result_check = mysqli_query($conn,$select_data);
           if(mysqli_num_rows($result_check)>0){
            $row = mysqli_fetch_assoc($result_check);
           ?>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                    <div class="form-group">
                            <label for="">Service Name</label>
                            <input type="text" name="service_name" class="form-control" value="<?php echo $row['services_name'] ?>">
                            <span style='color:red' ;><?php echo $errors['service_name'] ?></span>
                        </div>
                        <div class="form-group">
                            <label for="">Service Slug</label>
                            <input type="text" name="service_slug" class="form-control" value="<?php echo $row['services_slug']?>">
                            <span style='color:red' ;><?php echo $errors['service_slug'] ?></span>
                        </div>
                        <div class="form-group">
                            <label for="">Icon</label>
                            <input type="file" name="new_service_icon" class="form-control">
                            <img src="Service_icon/<?php echo $row['icon'] ?>" alt="" width="50px" height="50px" class="mt-2">
                            <input type="hidden" name="old_icon" value="<?php echo $row['icon'] ?>">
                            <span style='color:red' ;><?php echo $errors['service_icon'] ?></span>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" name="service_update" class="btn btn-outline-primary">Update Services</button>
                        </div>
                    </form>
                    <?php }   ?>
                    </div>
            </div>
        </div>
    </div>
</div>

    <?php
    include('includes/scripts.php');
    include('includes/footer.php');
    ?>