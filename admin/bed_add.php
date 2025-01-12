<?php
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');

$errors = [
    'bedNumber' =>'',
    'bed_type' =>'',
    'description' =>''
];

if(isset($_POST['add_bed'])){
  $bed_number = mysqli_real_escape_string($conn, $_POST['bed_number']);
  $bed_type = mysqli_real_escape_string($conn, $_POST['bed_type']);
  $description = mysqli_real_escape_string($conn, $_POST['description']);

// regular Expressions validation 
$BedNumberPattern = "/^[0-9]+$/";
$Bed_typePattern = "/^[a-zA-Z0-9]+$/";

// validation 
if(empty($bed_number)){
    $errors['bedNumber'] = "Enter a Bed Number";
}
else if(!preg_match($BedNumberPattern, $bed_number)){
  $errors['bedNumber']  = "Invalid Bed Number. Only number alllowed";
}

// bed type validation
if(empty($bed_type)){
    $errors['bed_type'] = "Enter a Bed Type";
}
else if(!preg_match($Bed_typePattern, $bed_type)){
    $errors['bed_type'] = "Invalid bed Type";
}

// descripton Validation
if(empty($description)){
    $errors['description'] = "Enter a description";
}
  // if no error
  if(empty(array_filter($errors))){
  $sql = "SELECT bed_num FROM bed WHERE bed_num = '$bed_number'";
 $result = mysqli_query($conn, $sql)  or die("Query failed");
 
  if(mysqli_num_rows($result)>0){
    $_SESSION['alert'] ="Already exists";
    $_SESSION['alert_code'] ="info";
    
 }

 else{
    $insert_query = "INSERT INTO `bed`(`bed_num`, `bed_type`, `description`, `created_at`) VALUES
    ('$bed_number', '$bed_type', '$description', Now())";
 if(mysqli_query($conn, $insert_query)){
    $_SESSION['alert'] ="Added Successfully appointment";
        $_SESSION['alert_code'] ="success";
 }
 else{
    $_SESSION['alert'] ="Failed";
    $_SESSION['alert_code'] ="error";
 }
 
 }
  }

}

?>
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header">
                   Add Bed
                </div>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="">Bed Number</label>
                            <input type="text" name="bed_number" class="form-control">
                            <span style='color:red' ;><?php echo $errors['bedNumber'] ?></span>
                        </div>
                        <div class="form-group">
                            <label for=""> Bed Type</label>
                           <input type="text" name="bed_type" class="form-control">
                           <span style='color:red' ;><?php echo $errors['bed_type'] ?></span>
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea name="description" class="form-control" id=""></textarea>
                            <span style='color:red' ;><?php echo $errors['description'] ?></span>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="add_bed" class="btn btn-outline-primary">Add New Bed</button>
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