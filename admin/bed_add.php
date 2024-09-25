<?php
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');
if(isset($_POST['add_bed'])){
  $bed_number = mysqli_real_escape_string($conn, $_POST['bed_number']);
  $bed_type = mysqli_real_escape_string($conn, $_POST['bed_type']);
  $description = mysqli_real_escape_string($conn, $_POST['description']);

  $sql = "SELECT bed_num FROM bed WHERE bed_num = '$bed_number'";
 $result = mysqli_query($conn, $sql)  or die("Query failed");
 if(mysqli_num_rows($result)>0){
    echo "<div class='alert alert-danger'>bed alread exits </div>";
 }
 else{
    $insert_query = "INSERT INTO `bed`(`bed_num`, `bed_type`, `description`, `created_at`) VALUES
    ('$bed_number', '$bed_type', '$description', Now())";
 if(mysqli_query($conn, $insert_query)){
    echo "<div class='alert alert-alert'>Add Successfully</div>";
 }
 else{
    echo "<div class='alert alert-alert'>failed</div>";
 }
 
 }

}

?>
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header">
                    Add Patient
                </div>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="">Bed</label>
                            <input type="text" name="bed_number" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for=""> Bed Type</label>
                           <input type="text" name="bed_type" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea name="description" class="form-control" id=""></textarea>
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