<?php
ob_start();
require_once("includes/header.php");
require_once("includes/navbar.php");
include('../database/config.php');

if(!isset($_SESSION['id'])){
    header('location:index.php');
}
$errors = [
    'report' => '',
    'description' => '',
    'date' => '',
    'doctor' => '',
    'patient' => '',
];
if (isset($_POST['Update'])) {
    $rep_id = mysqli_real_escape_string($conn, $_POST['rep_id']);
    $report_type = mysqli_real_escape_string($conn, $_POST['report_type']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $doctor = mysqli_real_escape_string($conn, $_POST['doctor']);
    $patient = mysqli_real_escape_string($conn, $_POST['patient']);



    // report type is required validation 
    if (empty($report_type) || $report_type === 'Select Option') {
        $errors['report'] = 'Report type is required';
    }
    if (empty($description)) {
        $errors['description'] = 'Description is required';
    }
    if (empty($date)) {
        $errors['date'] = 'Date is required';
    } elseif (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
        $errors['date'] = "Invalid date Formate. Please use YYYY-MM-DD";
    } else {
        // check date valid calander date
        list($year, $month, $day) = explode('-', $date);
        if (!checkdate((int)$month, (int)$day, (int)$year)) {
            $errors['date'] = "Invalid  date. Please provide a valid date calender date";
        }
    }
    if (empty($doctor) || $doctor === 'Select Doctor') {
        $errors['doctor'] = 'Doctor is required';
    }
    if (empty($patient) || $patient === 'Select Patient') {
        $errors['patient'] = 'Patient is required';
    }


    if (empty(array_filter($errors))) {

        $update_query = "UPDATE report SET report_type ='$report_type',description = '$description',date='$date',
    doctor_id ='$doctor', patient_id = '$patient' WHERE rep_id = '$rep_id'";
        if (mysqli_query($conn, $update_query)) {
            $_SESSION['alert'] = "Updated Successfully";
            $_SESSION['alert_code'] = "success";
            header('location:manage_report.php');
            exit();
        } else {
            $_SESSION['alert'] = "failed";
            $_SESSION['alert_code'] = "warning";
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
                    Add Report
                </div>
                <?php
                $rep_id = $_GET['rep_id'];
                $select_query = "SELECT * FROM report WHERE rep_id = '$rep_id'";
                $result = mysqli_query($conn, $select_query) or die("Query failed");
                if (mysqli_num_rows($result)) {
                    while ($data = mysqli_fetch_assoc($result)) {

                ?>
                        <div class="card-body">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="rep_id" value="<?php echo $data['rep_id'] ?>">
                                <div class="form-group">
                                    <label for="">Report Type</label>
                                    <select name="report_type" id="report_type" class="form-control">
                                        <option disabled>Select</option>
                                        <option value="operation" <?php echo ($data['report_type'] == 'operation') ? 'selected' : ''; ?>>Operation</option>
                                        <option value="birth" <?php echo ($data['report_type'] == 'birth') ? 'selected' : ''; ?>>Birth</option>
                                        <option value="death" <?php echo ($data['report_type'] == 'death') ? 'selected' : ''; ?>>Death</option>
                                        <option value="other" <?php echo ($data['report_type'] == 'other') ? 'selected' : ''; ?>>Other</option>

                                    </select>
                                    <span style='color:red' ;><?php echo $errors['report'] ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="">Description</label>
                                    <textarea name="description" id="" class="form-control"><?php echo $data['description'] ?></textarea>
                                    <span style='color:red' ;><?php echo $errors['description'] ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="">Date</label>
                                    <input type="date" name="date" value="<?php echo date('Y-m-d', strtotime($data['date'])); ?>" class="form-control">
                                    <span style='color:red' ;><?php echo $errors['date'] ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="">Doctor</label>
                                    <select name="doctor" id="" class="form-control">
                                        
                                        <?php
                                        $select_doctor_table = "SELECT d.id, CONCAT(d.first_name,'',d.last_name) as username FROM doctors as d
                                        INNER JOIN user_tbl ON d.user_id = user_tbl.id ";
                                        $doctor_result = mysqli_query($conn,$select_doctor_table);

                                        while ($doctor_table_data = mysqli_fetch_assoc($doctor_result)) {
                                            if ($doctor_table_data['id'] == $data['rep_id']) {
                                                $selected = 'selected';
                                            } else {
                                                $selected = '';
                                            }
                                            echo "<option value='" . $doctor_table_data['id'] . "'$selected>" . $doctor_table_data['username'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                    <span style='color:red' ;><?php echo $errors['doctor'] ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="">Patient</label>
                                    <select name="patient" id="" class="form-control">
                                        <?php
                                        $select_query_patient_table = "SELECT * FROM patient";
                                        $result = mysqli_query($conn, $select_query_patient_table);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            if ($row['id'] == $data['patient_id']) {
                                                $selected = 'selected';
                                            } else {
                                                $selected = '';
                                            }
                                            echo "<option value='" . $row['id'] . "'$selected>" . $row['name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                    <span style='color:red' ;><?php echo $errors['patient'] ?></span>
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="Update" class="btn btn-outline-primary">Update</button>
                                </div>
                            </form>
                    <?php
                    }
                } ?>
                        </div>
            </div>
        </div>
    </div>
    <?php
    include('includes/scripts.php');
    include('includes/footer.php');
    ?>