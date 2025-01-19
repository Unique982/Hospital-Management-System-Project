<?php 
ob_start();
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');

$errors = [
    'specialization' =>'',
    'description' =>''
];

if(isset($_POST['add'])){
    $specialization = mysqli_real_escape_string($conn, $_POST['specialization']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
  // 
  $specializationPattern = "/^[a-zA-Z\s]+$/";
  if(empty($specialization)){
    $errors['specialization'] = "Please enter a specialization";
  }
  else if(!preg_match($specializationPattern,$specialization)){
    $errors['specialization'] = "Invalid specialization. Only latter and spaces are allowed.";
  }

   // validation description
   if(empty($description)){
    $errors['description'] = 'Description is required';
   }
  
  elseif(strlen($description) > 1000){
    $errors['description'] = 'Description must be at least 1000 characters';
  }
  if(empty(array_filter($errors))){
    $sql = "INSERT INTO `specialization`(specialization,description,created_at) VALUES ('$specialization','$description', Now())";
   if(mysqli_query($conn, $sql)){
    $_SESSION['alert'] = "Added successfully";
    $_SESSION['alert_code'] = "success";
    header('location:manage_specialization.php');
    exit();
   
    }
    else{
        $_SESSION['alert'] = "Failed";
        $_SESSION['alert_code'] = "error";
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
                   Add Specialization
                </div>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Specialization:</label>
                            <input type="text" name="specialization" class="form-control" placeholder="Enterspecialization" value="<?php echo isset($specialization)? $specialization:''?>">
                            <span style='color:red' ;><?php echo $errors['specialization'] ?></span>
                          </div>
                        <div class="form-group">
                            <label>Description:</label>
                           <textarea name="description" id="" class="form-control" placeholder="Enter Description"><?php echo isset($description) ? $description:'' ?></textarea>
                           <span style='color:red' ;><?php echo $errors['description'] ?></span>
                          </div>
                       
                        <div class="form-group">
                        <button type="submit" name="add" class="btn btn-primary">Save</button>
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