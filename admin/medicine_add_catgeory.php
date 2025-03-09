<?php
ob_start();
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');

if(!isset($_SESSION['id'])){
    header('location:index.php');
}

$errors = [
    'Med_name' => '',
    'Med_description' => '',
];
if (isset($_POST['add_med'])) {
    $med_name = mysqli_real_escape_string($conn, $_POST['med_name']);
    $med_des = mysqli_real_escape_string($conn, $_POST['med_des']);

    $med_namePattern  = "/^[a-zA-Z0-9\s]+$/";

    // validation
    if (empty($med_name)) {
        $errors['Med_name'] = "Enter Medicine Name";
    } else if (!preg_match($med_namePattern, $med_name)) {
        $errors['Med_name'] = "Invalid Medicine Name. Only latters,Number and spaces are allowed ";
    }

    // description 
    if (empty($med_des)) {
        $errors['Med_description'] = "Enter Medicine Description";
    }

    if (empty(array_filter($errors))) {

        $select_query = "select medicine_name from medicine_cat where medicine_name = '$med_name'";
        $result = mysqli_query($conn, $select_query) or die("Query failed");
        if (mysqli_num_rows($result) > 0) {

            $_SESSION['alert'] = " Medicine Category Already add ";
            $_SESSION['alert_code'] = "info";
        } else {
            $insert_query = "INSERT INTO `medicine_cat`( `medicine_name`, `medicine_description`, `created_at`) VALUES ('$med_name','$med_des',Now())";
            if (mysqli_query($conn, $insert_query)) {

                $_SESSION['alert'] = "Medicine added sucessfully";
                $_SESSION['alert_code'] = "success";
                header('location:medicine_list_catgeory.php');
                exit();
            } else {
                $_SESSION['alert'] = "Insert failed";
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
                    Add Medicine Category
                </div>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for=""> Medicine Name</label>
                            <input type="text" name="med_name" class="form-control" placeholder="Enter MedicineName">
                            <span style='color:red' ;><?php echo $errors['Med_name'] ?></span>
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea name="med_des" id="med_des" class="form-control"></textarea>
                            <span style='color:red' ;><?php echo $errors['Med_description'] ?></span>
                        </div>

                        <div class="form-group">
                            <button type="submit" name="add_med" class="btn btn-outline-primary">Add</button>
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