<?php
require_once("includes/header.php");
require_once("includes/navbar.php");
include('../database/config.php');
$errors = [
    'report'=>'',
    'description'=>'',
    'date'=>'',
    'doctor' =>'',
    'patient'=>'',
];
if (isset($_POST['report'])) {
    $report_type = mysqli_real_escape_string($conn,$_POST['report_type']);
    $description = mysqli_real_escape_string($conn,$_POST['description']);
    $date = mysqli_real_escape_string($conn,$_POST['date']);
    $doctor = mysqli_real_escape_string($conn,$_POST['doctor']);
    $patient = mysqli_real_escape_string($conn,$_POST['patient']);

 
    // report type is required validation 
    if(empty($report_type) ||$report_type==='Select Option'){
        $errors['report'] ='Report type is required';
    }
    if(empty($description)){
        $errors['description'] ='Description is required';
    }
    if(empty($date)){
        $errors['date'] ='Date is required';
    }elseif(!preg_match('/^\d{4}-\d{2}-\d{2}$/',$data)){
    $errors['date'] = "Invalid date Formate. Please use YYYY-MM-DD";
}else{
   // check date valid calander date
   list($year, $month,$day) = explode('-',$date);
   if(!checkdate((int)$month,(int)$day,(int)$year)){
$errors['date'] = "Invalid  date. Please provide a valid date calender date";
   }
}
if(empty($doctor) || $doctor==='Select Doctor'){
    $errors['doctor'] = 'Doctor is required';
}
if(empty($patient) || $patient==='Select Patient'){
    $errors['patient'] ='Patient is required';
}


if (empty(array_filter($errors))) {
    $insert_query = "INSERT INTO `report`(`report_type`, `description`, `date`, `doctor_id`, `patient_id`) VALUES
    ('$report_type','$description',Now(),'$doctor','$patient')";
    
    if(mysqli_query($conn,$insert_query)){
        $_SESSION['alert'] ="Added Successfully";
        $_SESSION['alert_code'] ="success";
    }
    else{
        $_SESSION['alert'] ="failed";
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
                    Add Report
                </div>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="">Report Type</label>
                            <select name="report_type" id="" class="form-control">
                                <option selected>Select Option</option>
                                <option value="operation">Operation</option>
                                <option value="birth">Birth</option>
                                <option value="death">Death</option>
                                <option value="other">Other</option>
                            </select>
                            <span style='color:red' ;><?php echo $errors['report'] ?></span>
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea name="description" id="" class="form-control"></textarea>
                            <span style='color:red' ;><?php echo $errors['description'] ?></span>
                        </div>
                        <div class="form-group">
                            <label for="">Date</label>
                            <input type="date" name="date" class="form-control">
                            <span style='color:red' ;><?php echo $errors['date'] ?></span>
                        </div>
                        <div class="form-group">
                            <label for="">Doctor</label>
                           <select name="doctor" id="" class="form-control">
                            <option selected>Select Doctor</option>
                            <?php
                $select_doctor_table = "SELECT * FROM user_tbl WHERE role='doctor'";
                $doctor_result = mysqli_query($conn,$select_doctor_table);
                while($doctor_table_data = mysqli_fetch_assoc($doctor_result)){
                  
                    echo "<option value='".$doctor_table_data['id']."'>".$doctor_table_data['user_name']."</option>";
                }
                ?>
                 </select>
                 <span style='color:red' ;><?php echo $errors['doctor'] ?></span>
                        </div>
                        <div class="form-group">
                            <label for="">Patient</label>
                            <select name="patient" id="" class="form-control">
                                <option selected>Select Patient</option>
                                <?php 
                    $select_query_patient_table = "SELECT * FROM patient";
                    $result = mysqli_query($conn,$select_query_patient_table);
                    while($row = mysqli_fetch_assoc($result)){
                    
                        echo "<option value='".$row['patient_id']."'>".$row['name']."</option>";
                    
            }
                  ?>
                </select>
                <span style='color:red' ;><?php echo $errors['patient'] ?></span>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="report" class="btn btn-outline-primary">Add</button>
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