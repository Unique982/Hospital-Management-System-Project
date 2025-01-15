<?php
ob_start();
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');
$errors = [
    'number' => '',
    'patient' => '',
    'allocation_time' => '',
    'discharge_time' => '',
];


if (isset($_POST['save'])) {
    $bed_allocate_id = mysqli_real_escape_string($conn, $_POST['bed_allocate_id']);
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
    if (empty($discharge_time)) {
        $errors['discharge_time'] = 'Discharge time is required';
    }

    if (empty(array_filter($errors))) {

        $update_query = "UPDATE `bed_allocate` SET `bed_id`='$bed_number',`pateint_id`='$patient',`allocated_at`='$allocate_time',`discharge`='$discharge_time' WHERE bed_allocate_id=$bed_allocate_id";
        if (mysqli_query($conn, $update_query)) {
            $_SESSION['alert'] = "Update Successfully";
            $_SESSION['alert_code'] = "success";
            header('location:allocate_bed_list.php');
            exit();
        } else {
            $_SESSION['alert'] = "Update Failed";
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
                    Add Patient
                </div>
                <?php
                $bed_allocate_id = $_GET['bed_allocate_id'];
                $select_query = "SELECT * FROM bed_allocate WHERE bed_allocate_id='$bed_allocate_id'";
                $result = mysqli_query($conn, $select_query) or die("Query Failed");
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {


                ?>
                        <div class="card-body">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="bed_allocate_id" value="<?php echo $row['bed_allocate_id'] ?>">
                                <div class="form-group">
                                    <label for="">Bed Number</label>
                                    <select name="bed_number" id="bed_number" class="form-control">

                                        <?php
                                        $select1 = "SELECT * FROM bed";
                                        $result_ba = mysqli_query($conn, $select1);
                                        while ($bed_ba = mysqli_fetch_assoc($result_ba)) {
                                            $selected = ($bed_ba['bed_id'] == $row['bed_id']) ? 'selected' : '';
                                            echo "<option value='" . $bed_ba['bed_id'] . "'$selected>" . $bed_ba['bed_num'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                    <span style='color:red' ;><?php echo $errors['number'] ?></span>
                                </div>
                                <div class="form-group">
                                    <label for=""> Patient</label>
                                    <select name="patient" id="patient" class="form-control">

                                        <?php
                                        $select_query = "SELECT * FROM patient";
                                        $result2 = mysqli_query($conn, $select_query);
                                        while ($record = mysqli_fetch_assoc($result2)) {
                                            $selected = ($record['patient_id'] == $row['pateint_id']) ? 'selected' : '';
                                            echo "<option value='" . $record['patient_id'] . "'$selected>" . $record['name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                    <span style='color:red' ;><?php echo $errors['patient'] ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="">Allocate Time</label>
                                    <input type="datetime-local" name="allocate_time" value="<?php echo $row['allocated_at']; ?>" class="form-control">
                                    <span style='color:red' ;><?php echo $errors['allocation_time'] ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="">Discharge Time</label>
                                    <input type="datetime-local" name="discharge_time" value="<?php echo $row['discharge'] ?>" class="form-control">
                                    <span style='color:red' ;><?php echo $errors['discharge_time'] ?></span>
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="save" class="btn btn-outline-primary">Add New Bed</button>
                                </div>
                            </form>
                    <?php }
                }  ?>
                        </div>
            </div>
        </div>
    </div>
    <?php
    include('includes/scripts.php');
    include('includes/footer.php');
    ?>