<?php
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');
if(isset($_POST['save'])){
    $bed_number = mysqli_real_escape_string($conn,$_POST['bed_number']);
    $patient = mysqli_real_escape_string($conn,$_POST['patient']);
    $allocate_time = mysqli_real_escape_string($conn,$_POST['allocate_time']);
    $discharge_time = mysqli_real_escape_string($conn,$_POST['discharge_time']);

    $duplicate_date = "SELECT bed_id,pateint_id FROM bed_allocate WHERE bed_id='$bed_number' OR pateint_id='$patient'";
    $result = mysqli_query($conn,$duplicate_date) or die("Query failed");
    if(mysqli_num_rows($result) >0){
        
        $_SESSION['alert'] ="Bednumber  Already bocked by patient";
        $_SESSION['alert_code'] ="info";
           
        }
        else{
            $insert_query = "INSERT INTO `bed_allocate`(`bed_id`, `pateint_id`, `allocated_at`, `discharge`)
             VALUES ('$bed_number','$patient','$allocate_time','$discharge_time')";
   if(mysqli_query($conn,$insert_query)){
    $_SESSION['alert'] ="Bed Allocated Successfully";
    $_SESSION['alert_code'] ="info";
   }
   else{
   $_SESSION['alert'] ="Bed Allocated Failed";
   $_SESSION['alert_code'] ="warning";
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
                            <label for="">Bed Number</label>
                            <select name="bed_number" id="bed_number" class="form-control">
                                <option selected>Select</option>
                                <?php 
                    $select_query_patient_table = "SELECT * FROM bed";
                    $result = mysqli_query($conn,$select_query_patient_table);
                    while($row = mysqli_fetch_assoc($result)){
                    
                        echo "<option value='".$row['bed_id']."'>".$row['bed_num']."</option>";
                    
            }
                  ?>
                </select>
                           
                        </div>
                        <div class="form-group">
                            <label for=""> Patient</label>
                            <select name="patient" id="patient" class="form-control">
                                <option selected> Selct Now</option>
                                <?php 
                    $select_query_patient_table = "SELECT * FROM patient";
                    $result = mysqli_query($conn,$select_query_patient_table);
                    while($row = mysqli_fetch_assoc($result)){
                    
                        echo "<option value='".$row['patient_id']."'>".$row['name']."</option>";
                    
            }
                  ?>
                </select>
                        </div>
                        <div class="form-group">
                            <label for="">Allocate Time</label>
                       <input type="datetime-local" name="allocate_time" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Discharge Time</label>
                            <input type="datetime-local" name="discharge_time" class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="submit" name="save" class="btn btn-outline-primary">Add New Bed</button>
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