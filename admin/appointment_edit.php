<?php
ob_start();
 include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');
$user_type = $_SESSION['user_data']['role'];
$user_id = $_SESSION['id'];
$errors = [
    'doctor' => '',
    'patient' => '',
    'date' => '',
    'time' =>''
];
if(isset($_POST['update'])){
    $app_id = mysqli_real_escape_string($conn,$_POST['app_id']);
   $doctor = mysqli_real_escape_string($conn,$_POST['doctor']);
   $patient = mysqli_real_escape_string($conn,$_POST['patient']);
   $date = mysqli_real_escape_string($conn,$_POST['date']);
   $time = mysqli_real_escape_string($conn,$_POST['time']);
     // bed number validation 
if(empty($doctor)){
    $errors['doctor'] = 'Doctor is required';

}

// patient 
if(empty($patient)){
    $errors['patient'] = 'Patient number is required';
}
// Date validation tar
if(empty($date)){
    $errors['date'] = 'Appointment date is required';
}
elseif(!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)){
    $errors['date'] = "Invalid date Formate. Please use YYYY-MM-DD";
 }
 elseif($date < date('Y-m-d')){
 $errors['date'] = "Please select today or a future date";
    }
    else{
       if ($date == date('Y-m-d')) {
        if(empty($time)){
            $errors['time'] = "Time is required";
        }
        elseif(!preg_match('/^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/',$time)){
            $errors['time'] = "Invalid time formate .Please use HH:MM";
        }
        else{
            $current_time =date("H:i");
            if($time < $current_time){
                $errors['time'] ="sorry select next date";
            }
            elseif($current_time > '14:00'){
                $errors['date'] = "Booking for today is closed after 2 PM. Please select the next day!"; 

            }
        }
           
    }}   
    if (empty(array_filter($errors))) {
   // update query 
   $update_query = "UPDATE appointments SET patient_id = '$patient' , doctor_id = '$doctor', appointment_date = '$date', appointment_time='$time' WHERE app_id=$app_id";
  if(mysqli_query($conn,$update_query)){
// success msg
   $_SESSION['alert'] ="Successfully updated appointment";
   $_SESSION['alert_code'] ="success";
   header('location:appointment_list.php');
   exit();   
  }
 else{
    $_SESSION['alert'] ="update Failed";
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
                    Edit Information
                </div>
                <?php 
                $id = $_GET['id'];
                $select_query = "SELECT ap.app_id,patient.id as patient_id, patient.name AS patient_name,
             CONCAT(doctors.first_name,'',doctors.last_name) as doctor_name, ap.doctor_id, ap.status,appointment_date, ap.appointment_time
            FROM appointments as ap
            INNER JOIN patient ON ap.patient_id= patient.id
            INNER JOIN doctors ON ap.doctor_id = doctors.id WHERE ap.app_id=$id";
                $result = mysqli_query($conn, $select_query) or die("Query Failed");
                if(mysqli_num_rows($result)>0){
                    while($row = mysqli_fetch_assoc($result)){
                $doctor_id = $row['doctor_id'];
                $patient_id = $row['patient_id'];
                
                ?>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="app_id" value="<?php echo $row['app_id'] ?>">
                        <div class="form-group">
                            <label for="">Doctore Name</label>
                        
                           <select name="doctor" id="" class="form-control">
                           
                           <?php
                $select_doctor_table = "SELECT * FROM doctors";
                $doctor_result = mysqli_query($conn,$select_doctor_table);
                while($doctor_table_data = mysqli_fetch_assoc($doctor_result)){
                   $selected = ($doctor_id == $doctor_table_data['id']) ? 'selected':'';
                   echo "<option value='".$doctor_table_data['id']."'$selected>".$doctor_table_data['first_name']. "" . $doctor_table_data['last_name']."</option>";
                }
                ?>
                           </select>
                           <span style='color:red' ;><?php echo $errors['doctor'] ?></span>
                        </div>
                       
                        <div class="form-group">
                <label for="">Patient</label>
                <select name="patient" id="patient" class="form-control" required>
                 
                    <?php 
                    $select_query_patient_table = "SELECT * FROM patient";
                    $result = mysqli_query($conn,$select_query_patient_table);
                    while($row1 = mysqli_fetch_assoc($result)){
                        $selected = ($patient_id ==$row1['id'] ) ? 'selected':'';
                        echo "<option value='".$row1['id']."'$selected>".$row1['name']."</option>";
                     }
                     ?>
                    
                   
                </select>
                <span style='color:red' ;><?php echo $errors['patient'] ?></span>
            </div>
            <div class="form-group">
                <label for="">Date</label>
                 <input type="date" name="date" class="form-control" value="<?php echo $row['appointment_date']; ?>" required>
                 <span style='color:red' ;><?php echo $errors['date'] ?></span>
            </div>
            <div class="form-group">
                <label for="">Time</label>
                 <input type="time" name="time" class="form-control" value="<?php echo $row['appointment_time']; ?>" required>
                 <span style='color:red' ;><?php echo $errors['time'] ?></span>
                </div>
        </div>
        <div class="modal-footer">
            <a href="appointment_list.php" class="btn btn-danger">Cancel</a>
            
            <button type="submit" name="update" class="btn btn-primary">Update</button>
        </div>
        </form>
        <?php }} ?>
                </div>
            </div>
        </div>
    </div>


    <?php
    include('includes/scripts.php');
    include('includes/footer.php');
    ?>