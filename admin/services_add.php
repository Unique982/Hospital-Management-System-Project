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

if(isset($_POST['service_add'])){
   
    $service_name = mysqli_real_escape_string($conn,$_POST['service_name']);
    $service_slug = mysqli_real_escape_string($conn,$_POST['service_slug']);

    $file_name = $_FILES['service_icon']['name'];
    $file_temp_icon = $_FILES['service_icon']['tmp_name'];
    $file_type = $_FILES['service_icon']['type'];
    $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
    $extensions = array('jpg', 'png', 'jpeg','svg');
    $traget_folder = "Service_icon/".$file_name;

    if(empty($file_name)){
        $errors['service_icon'] = "Service is required";
    }
    elseif(!in_array($file_ext, $extensions)){
        $errors['service_icon']="Plase Upload a valid file png, jpg or jpeg";
    }
    elseif($_FILES['service_icon']['size']>1*1024){
        $errors['service_icon'] = "file size must be 1MB";
    }
    if(!move_uploaded_file($file_temp_icon,$traget_folder)){
        $errors['sub_img'] = "upload failed";
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
 // limit add service 
 $limit = 6;
 $select_data = "SELECT COUNT(*) as total FROM services_page";
 $count_result = mysqli_query($conn,$select_data);
 $count_row = mysqli_fetch_assoc($count_result);
 if($count_row['total'] >= $limit){
    $_SESSION['alert'] ="Insert limit reached Maximum $limit services allowed";
    $_SESSION['alert_code'] ="info";
    header('location:services_manage.php');
    exit();
    } else{
    $select_query = "SELECT * FROM services_page WHERE services_name='$service_name' OR services_slug ='$service_slug'";
    $result = mysqli_query($conn,$select_query) or die("failed Query");
    if(mysqli_num_rows($result)>0){
    $_SESSION['alert'] ="Already exists";
    $_SESSION['alert_code'] ="info";
    }
    else{
        $insert_query ="INSERT INTO `services_page`(`icon`, `services_name`, `services_slug`)
        VALUES('$file_name','$service_name','$service_slug')"; 
        if(mysqli_query($conn,$insert_query)){
            $_SESSION['alert'] ="Service add successfully!";
            $_SESSION['alert_code'] ="success";
            header('location:services_manage.php');
            exit();
        } else{
            $_SESSION['alert'] ="Already exists";
            $_SESSION['alert_code'] ="info";
        }
    }
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
                  Add Services
                </div>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                            <label for="">Service Name</label>
                            <input type="text" name="service_name" class="form-control" value="<?php echo isset($service_name) ? $service_name:'';?>">
                            <span style='color:red' ;><?php echo $errors['service_name'] ?></span>
                        </div>
                        <div class="form-group">
                            <label for="">Service Slug</label>
                            <input type="text" name="service_slug" class="form-control" value="<?php echo isset($service_slug) ? $service_slug:'';?>">
                            <span style='color:red' ;><?php echo $errors['service_slug'] ?></span>
                        </div>
                        <div class="form-group">
                            <label for="">Icon</label>
                            <input type="file" name="service_icon" class="form-control" value="<?php echo isset($service_icon) ? $service_icon:'';?>">
                            <span style='color:red' ;><?php echo $errors['service_icon'] ?></span>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" name="service_add" class="btn btn-outline-primary">Add Services</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
    include('includes/scripts.php');
    include('includes/footer.php');
    ?>