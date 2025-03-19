<?php
ob_start();// output buffering
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');

if(!isset($_SESSION['id'])){
    header('location:index.php');
}

$user_type = $_SESSION['user_data']['role'];
$user_id = $_SESSION['id'];
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
    $id = intval($_POST['id']);
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
    $errors['cash_history'] ="only use letter space allowed";
}
if(empty($medication)){
    $errors['medication'] = "medication is required";
}
if(!preg_match('/^[a-zA-Z0-9]+$/',$medication)){
    $errors['medication'] = "only use letter space allowed";
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
                 Update Prescription
                </div>
                <?php
                $id = $_GET['id'];
                $select_query = "SELECT p. *, 
    pt.name AS patient, CONCAT(d.first_name,' ',d.last_name)  As doctor
    FROM prescription AS p
    INNER JOIN doctors AS d ON p.doctor_id = d.id
    INNER JOIN patient AS pt ON p.patient_id =pt.id
WHERE p.id= $id";
                $result = mysqli_query($conn, $select_query) or die("Query Failed");
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $patient_id =$row['patient_id'];
                ?>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>"> 
                        <div class="form-group">
                            <label for="">Doctor Name:</label>
                            <select name="doctor" id="" class="form-control">
                                <option selected>Select Doctor</option>
                                <?php
                                    $select_doctor = "SELECT * FROM doctors";
                                    $doctor_result = mysqli_query($conn, $select_doctor);
                                    while ($doctor = mysqli_fetch_assoc($doctor_result)) {
                                        $selected = ($doctor['id'] == $row['doctor_id']) ? 'selected' : '';
                                        echo "<option value='" . $doctor['id'] . "'$selected>" . $doctor['first_name']. $doctor['last_name'] . "</option>";
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
                                $patient_result = mysqli_query($conn, $select_query_patient_table);
                                while ($patient = mysqli_fetch_assoc($patient_result)) {
                                  $selected= ($patient['id'] == $row['patient_id']) ? 'selected' :'';
                                    echo "<option value='{$patient['id']}'$selected>{$patient['name']}  </option>";
                                }
                                ?>
                            </select>
                            <span style='color:red' ;><?php echo $errors['patient'] ?></span>
                            </div>
                        <div class="form-group">
                            <label for="">Case History</label>
                            <textarea name="cash_history" class="form-control"><?php echo $row['case_history'];?></textarea>
                            <span style='color:red' ;><?php echo $errors['cash_history'] ?></span>
                        </div>
                        <div class="form-group">
                            <label for="">Medication</label>
                            <textarea name="medication" class="form-control"><?php echo $row['medication'];?></textarea>
                            <span style='color:red' ;><?php echo $errors['medication'] ?></span>
                        </div>
                        <div class="form-group">
                            <label for="">Medication Form  Pharamacist</label>
                            <textarea name="medication_form_pharamacist" class="form-control" ><?php echo  $row['medication_form_pharamcist']?></textarea>
                            <span style='color:red' ;><?php echo $errors['medication_form_pharamacist'] ?></span>
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea name="description" class="form-control" ><?php echo $row['description']?></textarea>
                            <span style='color:red' ;><?php echo $errors['description'] ?></span>
                        </div>
                        <div class="form-group">
                            <label for="">Date</label>
                           <input type="date" name="date" class="form-control" value="<?php echo $row['date'];?>">
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
    
    <?php if($user_type==='laboratorist'){ ?>
     <!-- Diagnosis Report  -->
     <?php
         $id = $_GET['id']; 
      $select= "SELECT * FROM `diagnosis_report` WHERE 
        prescription_id = $id";
         $result = mysqli_query($conn, $select) or die("Query Failed");
            $row = mysqli_fetch_assoc($result);
            
         ?>

    
        <div class="table-responsive ">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Report Type</th>
                            <th>Document Type</th>
                            <th>Download</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Laboratorist</th>
                            <th>Option</th>
                          
                        </tr>
                    </thead>
                </table>
            </div>

    <div class="card mb-4">
        <div class="card-header">
            Add Diagnosis Report
        </div>
       
        <div class="card-body">
            <form action="diagnosis_report_add.php?id=<?php echo $id ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="prescription_id" value="<?php echo $id; ?>">
            <input type="hidden" name="patient_id" value="<?php echo $patient_id ?>">
                <div class="form-group">
                    <label for="">Report Type</label>
                    <span class="badge bg-primary text-white mt-2 mb-2 py-2" >report_type can be x-ray, blood-test etc</span>
                   <input type="text" name="report_type" id=""  placeholder="Report Type" class="form-control" value=<?php echo isset($row['report_type']) ? $row['report_type']:''; ?>>
                   
                   <span style='color:red';><?php  if(isset($_SESSION['error']['report_type'])){ echo$_SESSION['error']['report_type']; } ?></span>
                </div>
                <div class="form-group">
                    <label for="">Document Type</label>
                   <select name="document_type" id="" class="form-control">
                    <option selected>Select Document Type</option>
                    <option value="pdf"<?php  echo isset($row['document_type']) && $row['document_type'] =='pdf' ?  'selected' : '' ;?>>PDF</option>
                    <option value="image"<?php  echo isset($row['document_type'])&& $row['document_type'] =='image' ? 'selected' :'' ;?> >Image</option>
                    <option value="excel" <?php  echo isset($row['document_type']) && $row['document_type']=='excel' ? 'selected' :'' ;?>>Excel</option>
                    <option value="other" <?php  echo isset($row['document_type']) && $row['document_type'] =='other' ? 'selected' :'' ;?>>Other</option>
                   </select>
                   <span style='color:red';><?php  if(isset( $_SESSION['error']['document_type'] )){ echo $_SESSION['error']['document_type'] ; } ?></span>
                </div>
                <div class="form-group">
                    <label for="">Upload Document</label>
                   <input type="file" name="upload_doc" id=""  class="form-control"  placeholder="Report Type" value="<?php echo isset($row['file_name']) ? $row['file_name']:'' ?>">
                  
                   <?php if(!empty($row['file_name'])) {
                  // file extcheck 
                  $file_ext = pathinfo($row['file_name'], PATHINFO_EXTENSION);
                  $images_ext = ["jpg", "png", "jpeg"];
                  $exl =["xls","xlsx"];
                  $pdf_ext = ['pdf'];
                   ?>
                   <div class="mt-2">
                    <?php if(in_array($file_ext,$images_ext)){?>
                        <img src="<?php echo $row['file_name']; ?>" alt="Upload Doc" class="img-fluid mt-2" style="max-width: 500px;">
                   <?php  } elseif(in_array($file_ext,$pdf_ext)) { ?>
                    <embed src="<?php echo $row['file_name']; ?>" type="application/pdf" width="800px" height="500px" >
                    

                 <?php } elseif(in_array($file_ext,$exl)){ ?>
                    <a href="<?php echo $row['file_name']; ?>" class="btn btbn-primary"> <i class="fa fa-download" aria-hidden="true">Download</i></a>
                <?php } else { ?>
                <a href="<?php echo ($row['file_name']=='other')? 'selected' : $row['file_name']; ?>" class="btn btbn-primary"> <i class="fa fa-download" aria-hidden="true"></i>Download</a>

                <?php 
                } ?>
                </div>
                   <?php }  ?>   
                   <span style='color:red';><?php  if(isset( $_SESSION['error']['upload_doc'] )){ echo $_SESSION['error']['upload_doc'] ; } ?></span>
                </div>
                <div class="form-group">
                    <label for="">Description</label>
                  <textarea name="des" id="" class="form-control"><?php echo isset($row['description']) ?  $row['description'] :'' ?></textarea>
                  <span style='color:red';><?php  if(isset($_SESSION['error']['des'] )){ echo$_SESSION['error']['des'] ; } ?></span>
                </div>
                <div class="form-group">
                    <button type="submit" name="add_diagnosis" class="btn btn-outline-primary">
                   <?php echo ($row)? "Update": "Add Diagnosis Report"; ?>
                    </button>
                </div>
            </form>
       
        <?php } 
            ?>
           
</div>
</div>

    <?php
    include('includes/scripts.php');
    include('includes/footer.php');
