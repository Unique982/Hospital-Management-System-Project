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
    'time' => ''
];
if (isset($_POST['add'])) {
    $doctor = isset($_POST['doctor']) ? mysqli_real_escape_string($conn, trim($_POST['doctor'])) : '';
    $patient = isset($_POST['patient']) ? mysqli_real_escape_string($conn, $_POST['patient']) : '';
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $time = mysqli_real_escape_string($conn, $_POST['time']);

    // bed number validation 
    if (empty($doctor) || $doctor === 'Select One') {
        $errors['doctor'] = 'Doctor is required';
    }

    // patient 
    if (empty($patient) || $patient === 'Select One') {
        $errors['patient'] = 'Patient number is required';
    }
    // Date validation 
    if (empty($date)) {
        $errors['date'] = 'Appointment date is required';
    } elseif (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
        $errors['date'] = "Invalid date Formate. Please use YYYY-MM-DD";
    } elseif ($date < date('Y-m-d')) {
        $errors['date'] = "Please select today or a future date";
    } else {
        if ($date == date('Y-m-d')) {
            if (empty($time)) {
                $errors['time'] = "Time is required";
            } elseif (!preg_match('/^(0[6-9]|10):[0-5][0-9]$/', $time)) {
                $errors['time'] = "Invalid time formate. Plase select between 06:00 am to 10:00 am";
            } else {
                $current_time = date("H:i");
                if ($time < $current_time) {
                    $errors['time'] = "sorry select next date";
                } elseif ($current_time > '10:00') {
                    $errors['time'] = "Booking for today is closed after 2 PM. Please select the next day!";
                }
            }
        }
    }
    if (empty(array_filter($errors))) {
        // check the patient already app with the doctor
        $sql_patient = "SELECT app_id FROM appointments WHERE patient_id = '$patient' AND appointment_date >= CURDATE()";
        $result_patient = mysqli_query($conn, $sql_patient) or die("Query failed");
        if (mysqli_num_rows($result_patient) > 0) {
            $_SESSION['alert'] = "Patient already has an appointment  today.";
            $_SESSION['alert_code'] = "info";
            header('location:appointment_list.php');
            exit();
        } 
        // check the patient already visited this doctor within the last 7 day 
        $sql_7day = "SELECT app_id FROM appointments WHERE patient_id = '$patient' AND doctor_id = '$doctor' AND appointment_date >= DATE_SUB(CURDATE(),INTERVAL 7 DAY)";
        $result_check = mysqli_query($conn, $sql_7day) or die("Query failed");
        if (mysqli_num_rows($result_check) > 0) {
            $_SESSION['alert'] = "Patient already visited this doctor within the  last 7days.";
            $_SESSION['alert_code'] = "info";
            header('location:appointment_list.php');
            exit();
        }
        // check doctor per day 30 patient 
        $doctor_limit = "SELECT COUNT(*) as patient_count FROM appointments WHERE doctor_id = '$doctor' AND appointment_date  = CURDATE()";
        $result_doctor = mysqli_query($conn, $doctor_limit) or die("Query failed");
        $data_limit = mysqli_fetch_assoc($result_doctor);
        if ($data_limit['patient_count'] >= 30) {
            $_SESSION['alert'] = "Doctor had already reached the maximun number of appointments for today";
            $_SESSION['alert_code'] = "info";
            header('location:appointment_list.php');
            exit();
        }
        
        else {
            $insert_query = "INSERT INTO `appointments`(`patient_id`, `doctor_id`,`status`, `appointment_date`,`appointment_time`)
     VALUES('$patient','$doctor','confirmed','$date','$time')";
            if (mysqli_query($conn, $insert_query)) {
                $_SESSION['alert'] = "Your Appointment successfully";
                $_SESSION['alert_code'] = "success";
                header('location:appointment_list.php');
                exit();
            } else {
                $_SESSION['alert'] = "Your appointemnt Failed";
                $_SESSION['alert_code'] = "error";
            }
        }
    }
}
ob_end_flush();

?>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Appointment</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
$selected_doctor_id = isset($_GET['doctor_id']) ? $_GET['doctor_id'] : '';

?>
            <form action="" method="POST" class="needs-validation" novalidate>
                <div class="modal-body">
                    <!-- only doctor -->
                    <?php
                    if($user_type == 'doctor'){
                    ?>
                      <div class="form-group">
                        <?php 
                        $select_dotcor_fe = "SELECT id FROM doctors WHERE user_id = $user_id";
                        $result_d = mysqli_query($conn,$select_dotcor_fe);
                        if(mysqli_num_rows($result_d)){
                            $row_d = mysqli_fetch_assoc($result_d);
                            $doctor_id = $row_d['id'];

                        
                        ?>
                        <label for="">Doctor Name</label>
                      <input type="hidden" name="doctor"  value="<?php echo  $doctor_id;?>">
                        <input type="text" value="<?php echo isset($_SESSION['user_name']) ? $_SESSION['user_name']:''?>" class="form-control"readonly>
                    <?php }  ?>
                    </div>
                    <?php 
                    }
                     ?>
                      <?php if($user_type =='admin'  || $user_type =='nurse' || $user_type=='patient') {
                        ?>
                    <div class="form-group">
                        <label for="">Doctor</label>
                        <select name="doctor" id="doctor" class="form-control" required>
                            <option selected disabled>Select Doctor</option>
                            <?php
                            $select_doctor_table = "SELECT d.id, CONCAT(d.first_name,'',d.last_name) as username FROM doctors as d
                    INNER JOIN user_tbl ON d.user_id = user_tbl.id ";
                            $doctor_result = mysqli_query($conn, $select_doctor_table);
                            while ($doctor_table_data = mysqli_fetch_assoc($doctor_result)) {

                                echo "<option value='" . $doctor_table_data['id'] . "'>" . $doctor_table_data['username'] . "</option>";
                            }
                            ?>
                        </select>
                        <span style='color:red';><?php echo $errors['doctor'] ?></span>
                    </div>
                    <?php }  ?>
                
                    <!-- if user type admin doctor and nurse ho vanni select user  -->
                    <?php if($user_type =='admin' || $user_type =='doctor' || $user_type =='nurse') {
                        ?>
                    <div class="form-group">
                        <label for="">Patient</label>
                        <select name="patient" id="patient" class="form-control" required>
                            <option selected disabled> Select One</option>
                            <?php
                            $select_query_patient_table = "SELECT * FROM patient";
                            $result = mysqli_query($conn, $select_query_patient_table);   
                            while ($row = mysqli_fetch_assoc($result)) {

                                echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                            }
                        
                            ?>
                        </select>
                        <span style='color:red';><?php echo $errors['patient'] ?></span>

                    </div>
                <?php  }?>
                <?php if($user_type=='patient'){

                 ?>
                    <!-- if patient login add appointment then select already patient -->
                    <div class="form-group">
                        <?php 
                        $select_patient_fe = "SELECT id FROM patient WHERE user_id = $user_id";
                        $result1 = mysqli_query($conn,$select_patient_fe);
                        if(mysqli_num_rows($result1)){
                            $row1 = mysqli_fetch_assoc($result1);
                            $Patient_id = $row1['id'];
                        
                        ?>
                        <label for="">Patient Name</label>
                      <input type="hidden" name="patient"  value="<?php echo  $Patient_id ;?>">
                        <input type="text" value="<?php echo isset($_SESSION['user_name']) ? $_SESSION['user_name']:''?>" class="form-control"readonly>
                    </div>
                    <?php } } ?>
                    <div class="form-group">
                        <label for="">Date</label>
                        <input type="date" name="date" class="form-control" required>
                        <span style='color:red' ;><?php echo $errors['date'] ?></span>
                    </div>
                    <div class="form-group">
                        <label for="">Time</label>
                        <input type="time" name="time" class="form-control" required>
                        <span style='color:red' ;><?php echo $errors['time'] ?></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="add" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Appointment List
                <button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#exampleModal" >
                    Add Appointment
                </button>
            </h6>
            <!-- fetch Data  -->
            <?php if ($user_type == 'admin' || $user_type =='nurse') {
                $appoinment_data = "SELECT ap.app_id,patient.id, patient.name AS patient_name,
             CONCAT(doctors.first_name,'',doctors.last_name) as doctor_name, ap.doctor_id, ap.status,appointment_date, ap.appointment_time
            FROM appointments as ap
            INNER JOIN patient ON ap.patient_id= patient.id
            INNER JOIN doctors ON ap.doctor_id = doctors.id
            ORDER BY ap.app_id ASC";
            } elseif ($user_type == 'doctor') {
                $appoinment_data = "SELECT ap.app_id,patient.id, patient.name AS patient_name,
        CONCAT(doctors.first_name,'',doctors.last_name) as doctor_name, ap.doctor_id, ap.status,appointment_date, ap.appointment_time
       FROM appointments as ap
       INNER JOIN patient ON ap.patient_id= patient.id
       INNER JOIN doctors ON ap.doctor_id = doctors.id
       WHERE doctors.user_id =$user_id
       ORDER BY ap.app_id ASC";
            } elseif ($user_type == 'patient') {
                $appoinment_data = "SELECT ap.app_id,patient.id, patient.name AS patient_name,
            CONCAT(doctors.first_name,'',doctors.last_name) as doctor_name, ap.doctor_id, ap.status,appointment_date, ap.appointment_time
           FROM appointments as ap
           INNER JOIN patient ON ap.patient_id= patient.id
           INNER JOIN doctors ON ap.doctor_id = doctors.id
           WHERE patient.user_id=$user_id
           ORDER BY ap.app_id ASC";
            }
            $app_result = mysqli_query($conn, $appoinment_data);
            ?>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Patient Name</th>
                            <th>Doctor</th>
                            <th>Status</th>
                            <th>Appointment Date</th>
                            <th>Appointment Time</th>

                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sn = 1;
                        if (mysqli_num_rows($app_result)  > 0) {
                            while ($app = mysqli_fetch_assoc($app_result)) {

                        ?>
                                <tr>
                                    <td><?php echo $sn ?></td>
                                    <td><?php echo $app['patient_name'] ?></td>
                                    <td><?php echo $app['doctor_name'] ?></td>
                                    <td><?php echo $app['status'] ?></td>
                                    <td><?php echo date("Y M d ", strtotime($app['appointment_date'])) ?></td>
                                    <td><?php echo date("h:i:A ", strtotime($app['appointment_time'])) ?></td>

                                    <td>
                                        <?php if($user_type==='patient') {
                                            if ($app['status'] == 'completed' || $app['status']=='cancel') { ?>
                                                <form action="appointment_delete.php" method="POST" id="deleteForm" style="display:inline-block; margin:2px;">
                                                    <input type="hidden" name="app_id" value="<?php echo $app['app_id'] ?>" class="delete_id">
                                                    <button type="submit" name="delete" class="btn btn-outline-danger btn-sm deletebtn" data-delete-url="appointment_delete.php">Delete</button>
                                                </form>
                                            <?php   }elseif ($app['status'] == 'confirmed') {?>
                                                <form action="appointment_status.php" method="GET" style="display:inline-block; margin:2px;">
                                                <input type="hidden" name="app_id" value="<?php echo $app['app_id'] ?>">
                                                <button type="submit" name="Cancel" class="btn btn-outline-danger btn-sm ">Cancell</button>
                                            </form>
                                           <?php  }}
                                            ?>

                                           
                                        <?php if ($user_type === 'doctor') { 
                                             if ($app['status'] == 'cancel') { ?>
                                            <form action="appointment_delete.php" method="POST" id="deleteForm" style="display:inline-block; margin:2px;">
                                                    <input type="hidden" name="app_id" value="<?php echo $app['app_id'] ?>" class="delete_id">
                                                    <button type="submit" name="delete" class="btn btn-outline-danger btn-sm deletebtn" data-delete-url="appointment_delete.php">Delete</button>
                                                </form>
                                                <?php }else{ ?>
                                            <form action="appointment_status.php" method="GET" style="display:inline-block; margin:2px;">   
                                            <input type="hidden" name="app_id" value="<?php echo $app['app_id'] ?>">
                                                <button type="submit" name="checkin" class="btn btn-outline-primary btn-sm ">Check In</button>
                                            </form>
                                            <?php } } ?>
                                            
                                            <?php if($user_type =='admin' || $user_type =='nurse' ){ ?>
                                            <!-- <a href=""><button type="button" class="btn btn-outline-warning btn-sm">Checkin</button></a> -->
                                            <a href="appointment_edit.php?id=<?php echo $app['app_id']; ?>" class="btn btn-outline-success btn-sm">Edit</a>

                                            <form action="appointment_delete.php" method="POST" id="deleteForm" style="display:inline-block; margin:2px;">
                                                <input type="hidden" name="app_id" value="<?php echo $app['app_id'] ?>" class="delete_id">
                                                <button type="submit" name="delete" class="btn btn-outline-danger btn-sm deletebtn" data-delete-url="appointment_delete.php">Delete</button>
                                            </form>

                                    </td>
                                <?php }
                                $sn++;  ?>
                                </tr>
                        <?php
                                
                            } }else{
                                
                            
                        }


                        ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>



<?php
include('includes/scripts.php');
include('includes/footer.php');
?>