<?php
ob_start();// output buffering
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');

$errors = [
    'doctor' =>'',
    'patient' =>'',
    'cash_history' =>'',
    'medication' =>'',
    'medication_form_pharamacist' =>'',
    'description' =>'',
    'date'=>''   
    
];

if(isset($_POST['update'])){
    $id = mysqli_real_escape_string($conn,$_POST['id']);
  $doctor = mysqli_real_escape_string($conn,$_POST['doctor']);
  $patient= mysqli_real_escape_string($conn,$_POST['patient']);
  $cash_history = mysqli_real_escape_string($conn,$_POST['cash_history']);
  $medication = mysqli_real_escape_string($conn,$_POST['medication']);
  $medication_form_pharamacist = mysqli_real_escape_string($conn,$_POST['medication_form_pharamacist']);
  $description = mysqli_real_escape_string($conn,$_POST['description']);
  $date = mysqli_real_escape_string($conn,$_POST['date']);

// validation doctor id  
if(empty($doctor)){
    $errors['doctor'] = "doctor id is required";
}
if(empty($patient)){
    $errors['patient'] = "patient id is required";
}
if(empty($cash_history)){
    $errors['cash_history'] = "case history is required";
}
if(!preg_match('/^[a-zA-Z\s]+$/',$cash_history)){
    $errors['cash_history'] ="only use letter,number and space allowed";
}
if(empty($medication)){
    $errors['medication'] = "medication is required";
}
if(!preg_match('/^[a-zA-Z0-9]+$/',$medication)){
    $errors['medication'] = "only use letter number and space allowed";
}
if(empty($medication_form_pharamacist)){
    $errors['medication_form_pharamacist'] = "medication form pharamacist is required";
}
if(empty($description)){
    $errors['description'] = "description is required";
}
if(empty($date)){
    $errors['date'] = 'date is required';
}
elseif(!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)){
    $errors['date'] = "Invalid date Formate. Please use YYYY-MM-DD";
 }

  if(empty(array_filter($errors))){
    $update_query = "UPDATE `prescription` SET doctor_id='$doctor',`patient_id`='$patient',`case_history`='$cash_history',`medication`='$medication'
    ,`medication_form_pharamcist`='$medication_form_pharamacist',`description`='$description',`date`='$date' WHERE id = $id";   
 if(mysqli_query($conn, $update_query)){
    $_SESSION['alert'] ="Update Successfully";
        $_SESSION['alert_code'] ="success";
        header('location:manage_prescription.php');
        exit();
 }
 else{
    $_SESSION['alert'] ="Failed";
    $_SESSION['alert_code'] ="error";
 }
 }
  }
ob_end_flush();// output buffering data after header() redirection
?>
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header">
                 Add  Prescription
                </div>
                <?php
                $id = $_GET['id'];
                $select_query = "SELECT * FROM prescription WHERE id = $id";
                $result = mysqli_query($conn, $select_query) or die("Query Failed");
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_array($result);
                ?>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                        <div class="form-group">
                            <label for="">Doctor Name:</label>
                            <select name="doctor" id="" class="form-control">
                                <option selected>Select Doctor</option>
                                <?php
                                    $select_doctor = "SELECT * FROM doctors";
                                    $result2 = mysqli_query($conn, $select_doctor);
                                    while ($record = mysqli_fetch_assoc($result2)) {
                                        $selected = ($record['id'] == $row['doctor_id']) ? 'selected' : '';
                                        echo "<option value='" . $record['id'] . "'$selected>" . $record['name'] . "</option>";
                                    }

                                    ?>
                            </select>
                            <span style='color:red' ;><?php echo $errors['doctor'] ?></span>
                            </div>
                        <div class="form-group">
                            <label for=""> Patient Name</label>
                            <select name="patient" id="" class="form-control">
                                <option selected>Select Patient</option>
                                <?php
                                $select_query_patient_table = "SELECT * FROM patient";
                                $result = mysqli_query($conn, $select_query_patient_table);
                                while ($row = mysqli_fetch_assoc($result)) {

                                    echo "<option value='" . $row['id'] . "'$seleted>" . $row['name'] . "</option>";
                                }
                                ?>
                            </select>
                            <span style='color:red' ;><?php echo $errors['patient'] ?></span>
                            </div>
                        <div class="form-group">
                            <label for="">Case History</label>
                            <textarea name="cash_history" class="form-control" id="editor"><?php echo $record['case_history'];?></textarea>
                            <span style='color:red' ;><?php echo $errors['cash_history'] ?></span>
                        </div>
                        <div class="form-group">
                            <label for="">Medication</label>
                            <textarea name="medication" class="form-control" id="editor"><?php echo $row['medication'];?></textarea>
                            <span style='color:red' ;><?php echo $errors['medication'] ?></span>
                        </div>
                        <div class="form-group">
                            <label for="">Medication Form  Pharamacist</label>
                            <textarea name="medication_form_pharamacist" class="form-control" id="editor"><?php echo  $row['medication_form_pharamacist']?></textarea>
                            <span style='color:red' ;><?php echo $errors['medication_form_pharamacist'] ?></span>
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea name="description" class="form-control" id="editor"><?php echo $row['description']?></textarea>
                            <span style='color:red' ;><?php echo $errors['description'] ?></span>
                        </div>
                        <div class="form-group">
                            <label for="">Date</label>
                           <input type="date" name="date" class="form-control" value="<?php echo $row['date']?>">
                            <span style='color:red' ;><?php echo $errors['date'] ?></span>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="update" class="btn btn-outline-primary">Update</button>
                        </div>
                    </form>
                </div>
                <?php }  ?>
            </div>
        </div>
    </div>

    <?php
    include('includes/scripts.php');
    include('includes/footer.php');
