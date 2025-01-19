<?php
ob_start();
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');
$errors = [
    'username' => '',
    'email' => '',
    'phone' => '',
    'address' => '',
    'gender' => '',
    'qualification' => ''

];
if (isset($_POST['update'])) {
    $id =  $_POST['id'];
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $qualification = mysqli_real_escape_string($conn, $_POST['qualification']);


    if (empty($username)) {
        $errors['username'] = 'Username is required';
    } elseif (!preg_match('/^[a-zA-Z\s]+$/', $username)) {
        $errors['username'] = 'only use letter and space allowed';
    }
    // validation email 
    if (empty($email)) {
        $errors['email'] = 'Email is required';
    } elseif (!preg_match('/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/', $email)) {
        $errors['email'] = 'Invalid Email';
    }
    // phone number
    if (empty($phone)) {
        $errors['phone'] = 'Phone number is required';
    } elseif (!preg_match('/^\d{10}$/', $phone)) {
        $errors['phone'] = 'Please enter a valid phone number';
    }

    //address 
    if (empty($address)) {
        $errors['address'] = 'Address is required';
    } elseif (!preg_match('/^[a-zA-Z]+$/', $address)) {
        $errors['address'] = 'Please enter a valid address';
    }
    //qualification
    if (empty($qualification)) {
        $errors['qualification'] = 'Qualification is required';
    }
    // gender
    $genderValid = ['male', 'female', 'other'];
    if (empty($gender)) {
        $errors['gender'] = "Select a gender";
    } elseif (!in_array($gender, $genderValid)) {
        $errors['gender'] = "Invalid gender selected";
    }
    if (empty(array_filter($errors))) {
        $user_tbl_update = "UPDATE user_tbl SET user_name='$username', user_email='$email' WHERE id=$id ";
        if (mysqli_query($conn, $user_tbl_update)) {
            $nurse_update = "UPDATE nurse SET phone='$phone',address='$address',gender='$gender',qualification='$qualification' WHERE user_id=$id";
            if (mysqli_query($conn, $nurse_update)) {
                $_SESSION['alert'] = "update successfully";
                $_SESSION['alert_code'] = "success";
                header('location:manage_nurse.php');
                exit();
            } else {
                $_SESSION['alert'] = "Update failed";
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
                    Edit Nurse Details
                </div>
            
                <?php
                $id = $_GET['id'];
                $select_query = "SELECT nurse.nurse_id,nurse.phone, nurse.address,nurse.gender,
                nurse.qualification, user_tbl.user_name as username, user_tbl.user_email,user_tbl.role, 
                user_tbl.id   FROM `nurse` 
INNER JOIN `user_tbl` ON nurse.user_id = user_tbl.id
  WHERE user_id = $id";

                $result = mysqli_query($conn, $select_query) or die("Query failed");
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>

                        <div class="card-body">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo $row['nurse_id'] ?>">
                                <div class="form-group">
                                    <label for="">User Name</label>
                                    <input type="text" name="username" class="form-control" placeholder="Enter username" value="<?php echo $row['username'] ?>">
                                    <span style='color:red' ;><?php echo $errors['username'] ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Enter email" value="<?php echo $row['user_email'] ?>">
                                    <span style='color:red' ;><?php echo $errors['email'] ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="">Phone No</label>
                                    <input type="number" name="phone" class="form-control" placeholder="Enter Phone" value="<?php echo $row['phone'] ?>">
                                    <span style='color:red' ;><?php echo $errors['phone'] ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="">Address</label>
                                    <input type="address" name="address" class="form-control" placeholder="Enter Address" value="<?php echo $row['address'] ?>">
                                    <span style='color:red' ;><?php echo $errors['address'] ?></span>
                                </div>
                                <div class="form-group">
                                    <label>Gender:</label>
                                    <select name="gender" id="gender" class="form-control">
                                        <option selected>Select Option</option>

                                        <option value="male" <?php echo ($row['gender'] == 'male') ? 'selected' : ''; ?>>Male</option>
                                        <option value="female" <?php echo ($row['gender'] == 'female') ? 'selected' : ''; ?>>Female</option>
                                        <option value="other" <?php echo ($row['gender'] == 'other') ? 'selected' : ''; ?>>Other</option>
                                    </select>
                                    <span style='color:red' ;><?php echo $errors['gender'] ?></span>
                                </div>

                                <div class="form-group">
                                    <label for="">Qualification</label>
                                    <input type="text" name="qualification" class="form-control" placeholder="Enter Address" value="<?php echo $row['qualification'] ?>">
                                    <span style='color:red' ;><?php echo $errors['qualification'] ?></span>
                                </div>

                                <div class="modal-footer">

                                    <a href="manage_nurse.php" class="btn btn-danger">Cancel</a>
                                    <button type="submit" name="update" class="btn btn-primary">Update</button>
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