<?php
ob_start();
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');
$errors = [
    'bedNumber' =>'',
    'bed_type' =>'',
    'description' =>''
];
if (isset($_POST['update'])) {
    $bed_id = mysqli_real_escape_string($conn, $_POST['bed_id']);
    $bed_number = mysqli_real_escape_string($conn, $_POST['bed_number']);
    $bed_type = mysqli_real_escape_string($conn, $_POST['bed_type']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    // regular Expressions validation 
    $BedNumberPattern = "/^[0-9]+$/";
    $Bed_typePattern = "/^[a-zA-Z0-9]+$/";

    // validation 
    if (empty($bed_number)) {
        $errors['bedNumber'] = "Enter a Bed Number";
    } else if (!preg_match($BedNumberPattern, $bed_number)) {
        $errors['bedNumber']  = "Invalid Bed Number. Only number alllowed";
    }

    // bed type validation
    if (empty($bed_type)) {
        $errors['bed_type'] = "Enter a Bed Type";
    } else if (!preg_match($Bed_typePattern, $bed_type)) {
        $errors['bed_type'] = "Invalid bed Type";
    }

    // descripton Validation
    if (empty($description)) {
        $errors['description'] = "Enter a description";
    }
    // if no error
    if (empty(array_filter($errors))) {

        $update_query = "UPDATE bed SET bed_num = '$bed_number', bed_type = '$bed_type', description = '$description' WHERE bed_id = '$bed_id'";
        if (mysqli_query($conn, $update_query)) {
            $_SESSION['alert'] = "Edit Successfully";
            $_SESSION['alert_code'] = "success";
            header('location:bed_list.php');
            exit();
        } else {
            $_SESSION['alert'] = "Failed";
            $_SESSION['alert_code'] = "error";
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
                <!-- Php code start -->
                <?php
                $bed_id = $_GET['bed_id'];
                $select_query = "SELECT * FROM bed WHERE bed_id = '$bed_id'";
                $result = mysqli_query($conn, $select_query);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <div class="card-body">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="bed_id" value="<?php echo $row['bed_id'] ?>">
                                <div class="form-group">
                                    <label for="">Bed</label>
                                    <input type="text" name="bed_number" class="form-control" value="<?php echo $row['bed_num'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for=""> Bed Type</label>
                                    <input type="text" name="bed_type" class="form-control" value="<?php echo $row['bed_type'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Description</label>
                                    <textarea name="description" class="form-control" id=""><?php echo $row['description'] ?></textarea>
                                </div>
                                <div class="form-group">
                                    <a href="bed_list.php" class="btn btn-outline-danger">Cancel</a>
                                    <button type="submit" name="update" class="btn btn-outline-primary">Update</button>
                                </div>
                            </form>
                    <?php  }
                } else {
                    echo "<div class='alert alert-text'>No data Found</div>";
                }
                    ?>
                        </div>
            </div>
        </div>
    </div>
    <?php
    include('includes/scripts.php');
    include('includes/footer.php');
    ?>