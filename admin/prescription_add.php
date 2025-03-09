<?php
ob_start(); // output buffering
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');

if(!isset($_SESSION['id'])){
    header('location:index.php');
}

$errors = [
    'doctor' => '',
    'patient' => '',
    'cash_history' => '',
    'medication' => '',
    'medication_form_pharamacist' => '',
    'description' => '',
    'date' => ''

];

if (isset($_POST['add_bed'])) {
    $doctor = mysqli_real_escape_string($conn, $_POST['doctor']);
    $patient = mysqli_real_escape_string($conn, $_POST['patient']);
    $cash_history = mysqli_real_escape_string($conn, $_POST['cash_history']);
    $medication = mysqli_real_escape_string($conn, $_POST['medication']);
    $medication_form_pharamacist = mysqli_real_escape_string($conn, $_POST['medication_form_pharamacist']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);

    // validation doctor id  
    if (empty($doctor)) {
        $errors['doctor'] = "doctor id is required";
    }
    if (empty($patient)) {
        $errors['patient'] = "patient id is required";
    }
    if (empty($cash_history)) {
        $errors['cash_history'] = "case history is required";
    }
    if (!preg_match('/^[a-zA-Z\s]+$/', $cash_history)) {
        $errors['cash_history'] = "only use letter,number and space allowed";
    }
    if (empty($medication)) {
        $errors['medication'] = "medication is required";
    }
    if (!preg_match('/^[a-zA-Z0-9]+$/', $medication)) {
        $errors['medication'] = "only use letter number and space allowed";
    }
    if (empty($medication_form_pharamacist)) {
        $errors['medication_form_pharamacist'] = "medication form pharamacist is required";
    }
    if (empty($description)) {
        $errors['description'] = "description is required";
    }
    if (empty($date)) {
        $errors['date'] = 'date is required';
    } elseif (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
        $errors['date'] = "Invalid date Formate. Please use YYYY-MM-DD";
    }

    if (empty(array_filter($errors))) {
        $insert_query = "INSERT INTO `prescription`(`doctor_id`, `patient_id`, `case_history`, `medication`, `medication_form_pharamcist`, `description`, `date`)
     VALUES('$doctor','$patient','$cash_history','$medication','$medication_form_pharamacist','$description','$date')";
        if (mysqli_query($conn, $insert_query)) {
            $_SESSION['alert'] = "Added Successfully";
            $_SESSION['alert_code'] = "success";
            header('location:manage_prescription.php');
            exit();
        } else {
            $_SESSION['alert'] = "Failed";
            $_SESSION['alert_code'] = "error";
        }
    }
}



ob_end_flush(); // output buffering data after header() redirection
?>
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header">
                    Add Prescription
                </div>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="">Doctor Name:</label>
                            <select name="doctor" id="" class="form-control">
                                <option selected>Select Doctor</option>
                                <?php
                                $select_doctor_table = "SELECT d.id, CONCAT(d.first_name,'',d.last_name) as username FROM doctors as d
                    INNER JOIN user_tbl ON d.user_id = user_tbl.id ";
                                $doctor_result = mysqli_query($conn, $select_doctor_table);
                                while ($doctor_table_data = mysqli_fetch_assoc($doctor_result)) {

                                    echo "<option value='" . $doctor_table_data['id'] . "'>" . $doctor_table_data['username'] . "</option>";
                                }
                                ?>
                            </select>
                            <span style='color:red' ;><?php echo $errors['doctor'] ?></span>
                        </div>
                        <div class="form-group">
                            <label for=""> Patient Name</label>
                            <select name="patient" id="patient" class="form-control">
                                <option selected>Select Patient</option>
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
                            <label for="">Case History</label>
                            <textarea name="cash_history" class="form-control" id=""><?php echo isset($cash_history) ? $cash_history : ''; ?></textarea>
                            <span style='color:red' ;><?php echo $errors['cash_history'] ?></span>
                        </div>
                        <div class="form-group">
                            <label for="">Medication</label>
                            <textarea name="medication" class="form-control" id=""><?php echo isset($medication) ? $medication : ''; ?></textarea>
                            <span style='color:red' ;><?php echo $errors['medication'] ?></span>
                        </div>
                        <div class="form-group">
                            <label for="">Medication Form Pharamacist</label>
                            <textarea name="medication_form_pharamacist" class="form-control" id=""><?php echo isset($medication_form_pharamacist) ? $medication_form_pharamacist : ''; ?></textarea>
                            <span style='color:red' ;><?php echo $errors['medication_form_pharamacist'] ?></span>
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea name="description" class="form-control" id=""><?php echo isset($description) ? $description : ''; ?></textarea>
                            <span style='color:red' ;><?php echo $errors['description'] ?></span>
                        </div>
                        <div class="form-group">
                            <label for="">Date</label>
                            <input type="date" name="date" class="form-control" value="<?php echo isset($date) ? $date : ''; ?>">

                            <span style='color:red' ;><?php echo $errors['date'] ?></span>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="add_bed" class="btn btn-outline-primary">Add New Bed</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>


</div>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>