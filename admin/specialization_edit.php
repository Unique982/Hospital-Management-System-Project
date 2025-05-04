<?php
ob_start();
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');

if (!isset($_SESSION['id'])) {
    header('location:index.php');
}

$errors = [
    'specialization' => '',
    'description' => '',
    'symptoms' => ''
];

if (isset($_POST['update'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $specialization = mysqli_real_escape_string($conn, $_POST['specialization']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $symptoms = mysqli_real_escape_string($conn, $_POST['symptoms']);
    $specializationPattern = "/^[a-zA-Z\s]+$/";
    if (empty($specialization)) {
        $errors['specialization'] = "Please enter a specialization";
    } else if (!preg_match($specializationPattern, $specialization)) {
        $errors['specialization'] = "Invalid specialization. Only latter and spaces are allowed.";
    }

    // validation description
    if (empty($description)) {
        $errors['description'] = 'Description is required';
    } elseif (strlen($description) > 1000) {
        $errors['description'] = 'Description must be at least 1000 characters';
    }
    if (empty($symptoms)) {
        $errors['symptoms'] = "Symptoms is required";
    }
    if (empty(array_filter($errors))) {
        $update_query = "UPDATE specialization SET specialization = '$specialization', description='$description', symptoms ='$symptoms' WHERE id = '$id'";

        if (mysqli_query($conn, $update_query)) {
            $_SESSION['alert'] = "Update successfully";
            $_SESSION['alert_code'] = "success";
            header('location:manage_specialization.php');
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
                    Edit Doctor Details
                </div>
                <?php
                $id = $_GET['id'];
                $select_query = "SELECT * FROM `specialization` WHERE id ='$id'";
                $result = mysqli_query($conn, $select_query) or die("Query Failed");

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {

                ?>
                        <div class="card-body">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                                <div class="form-group">
                                    <label for="">Specialization</label>
                                    <input type="text" name="specialization" value="<?php echo $row['specialization'] ?>" class="form-control" placeholder="Enter Specialization">
                                    <span style='color:red' ;><?php echo $errors['specialization'] ?></span>
                                </div>
                                <div class="form-group">
                                    <label>Description:</label>
                                    <textarea name="description" id="" class="form-control" placeholder="Enter Description"><?php echo  $row['description'] ?></textarea>
                                    <span style='color:red' ;><?php echo $errors['description'] ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="">Symtoms</label>
                                    <input type="text" name="symptoms" value="<?php echo $row['symptoms'] ?>" class="form-control" placeholder="Enter Symptoms">
                                    <span style='color:red' ;><?php echo $errors['symptoms'] ?></span>
                                </div>
                                <div class="form-group">
                                    <a href="manage_specialization.php" class="btn btn-danger">Cancel</a>
                                    <button class="btn btn-primary" type="submit" name="update">Update</button>


                                </div>
                            </form>
                    <?php }
                } else {
                    echo '<div class="alert alert-danger">Not Fonnd</div>';
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