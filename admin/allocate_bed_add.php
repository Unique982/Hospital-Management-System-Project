<?php
ob_start();
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');

if(!isset($_SESSION['id'])){
    header('location:index.php');
    exit();
}

$errors = [
    'number' => '',
    'patient' => '',
    'allocation_time' => '',
    'discharge_time' => '',
];


if (isset($_POST['save'])) {
    $bed_number = mysqli_real_escape_string($conn, $_POST['bed_number']);
    $patient = mysqli_real_escape_string($conn, $_POST['patient']);
    $allocate_time = mysqli_real_escape_string($conn, $_POST['allocate_time']);
    $discharge_time = mysqli_real_escape_string($conn, $_POST['discharge_time']);

    // bed number validation 
    if (empty($bed_number) || $bed_number === 'Select') {
        $errors['number'] = 'Bed number is required';
    }

    // patient 
    if (empty($patient) || $patient === 'Select') {
        $errors['patient'] = 'Patient number is required';
    }

    // allocate_time validation 
    if (empty($allocate_time)) {
        $errors['allocation_time'] = 'Allocation time is required';
    } 
    elseif (strtotime($allocate_time) <=time()) {
        $errors['allocation_time'] ="Allocated time must be futre time";
    }
    if (empty($discharge_time)) {
        $errors['discharge_time'] = 'Discharge time is required';
    }elseif (strtotime($discharge_time) <=time()) {
        $errors['discharge_time'] ="Discharge Date must be futre date";
    }elseif(strtotime($discharge_time)<=strtotime($allocate_time)){
        $errors['discharge_time'] ="Discharge time must be after allocateion";

    }

    if (empty(array_filter($errors))) {
       // check patient allocated read already or not 
        $duplicate_date_patient = "SELECT * FROM bed_allocate WHERE pateint_id='$patient' AND ('$allocate_time' BETWEEN allocated_at AND discharge OR '$discharge_time' BETWEEN allocated_at AND discharge)";
        $result_pa = mysqli_query($conn, $duplicate_date_patient) or die("Query failed");
        if (mysqli_num_rows($result_pa) > 0) {
           
            $_SESSION['alert'] = "This  patient is alread has a bed allocated during this date ";
            $_SESSION['alert_code'] = "info";
            header('location:allocate_bed_list.php');
            exit();
        }
            //check bed availabe or note
            $duplicate_date_bed = "SELECT * FROM bed_allocate WHERE bed_id='$bed_number' AND ('$allocate_time' BETWEEN allocated_at AND discharge OR '$discharge_time' BETWEEN allocated_at AND discharge)";
            $result_bed = mysqli_query($conn, $duplicate_date_bed) or die("Query failed");
            if (mysqli_num_rows($result_bed) > 0) {
                $row= mysqli_fetch_assoc($result_bed);
                if($row['bed_id']==$bed_number){
                $_SESSION['alert'] = "The selected bed  already booked";
                $_SESSION['alert_code'] = "info";
                header('location:allocate_bed_list.php');
                     exit();
        }  
    }
    else {
            $insert_query = "INSERT INTO `bed_allocate`(`bed_id`, `pateint_id`, `allocated_at`, `discharge`)
             VALUES ('$bed_number','$patient','$allocate_time','$discharge_time')";
            if (mysqli_query($conn, $insert_query)) {
                mysqli_query($conn,"UPDATE bed SET status ='booked' WHERE bed_id = '$bed_number'");
                $_SESSION['alert'] = "Bed Allocated Successfully";
                $_SESSION['alert_code'] = "success";
                header('location:allocate_bed_list.php');
                exit();
            } else {
                $_SESSION['alert'] = "Bed Allocated Failed";
                $_SESSION['alert_code'] = "warning";
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
                    Add Allocate Bed
                </div>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="">Bed Number</label>
                            <select name="bed_number" id="bed_number" class="form-control">
                                <option selected>Select</option>
                                <?php
                                $select_query_bed_table = "SELECT * FROM bed WHERE status ='available'";
                                $result = mysqli_query($conn, $select_query_bed_table);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='" . $row['bed_id'] . "'>" . $row['bed_num'] . "</option>";
                                }
                                ?>
                            </select>
                            <span style='color:red' ;><?php echo $errors['number'] ?></span>

                        </div>
                        <div class="form-group">
                            <label for=""> Patient</label>
                            <select name="patient" id="patient" class="form-control">
                                <option selected>Select</option>
                                <?php
                                $select_query_patient_table = "SELECT * FROM patient";
                                $result = mysqli_query($conn, $select_query_patient_table);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                                }
                                ?>
                            </select>
                            <span style='color:red' ;><?php echo $errors['patient'] ?></span>
                        </div>
                        <div class="form-group">
                            <label for="">Allocate Time</label>
                            <input type="datetime-local" name="allocate_time" class="form-control" value="<?php echo isset($allocate_time) ? $allocate_time : ''; ?>">
                            <span style='color:red' ;><?php echo $errors['allocation_time'] ?></span>
                        </div>
                        <div class="form-group">
                            <label for="">Discharge Time</label>
                            <input type="datetime-local" name="discharge_time" class="form-control" value="<?php echo isset($discharge_time) ? $discharge_time : ''; ?>">
                            <span style='color:red' ;><?php echo $errors['discharge_time'] ?></span>
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