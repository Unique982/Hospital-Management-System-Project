<?php
ob_start();
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');

$errors = [
    'username' =>'',
    'name' => '',
    'email' => '',
    'phone' => '',
    'address' => '',
    'gender' => '',
    'age' => '',
    'blood' => '',
    'password' => '',
];

if (isset($_POST['update'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $pt_name = mysqli_real_escape_string($conn, $_POST['pt_name']);
    $pt_email = mysqli_real_escape_string($conn, $_POST['pt_email']);
    $pt_phone = mysqli_real_escape_string($conn, $_POST['pt_phone']);
    $pt_address = mysqli_real_escape_string($conn, $_POST['pt_address']);
    $pt_age = mysqli_real_escape_string($conn, $_POST['pt_age']);
    $pt_sex = mysqli_real_escape_string($conn, $_POST['pt_sex']);
    $pt_blood = mysqli_real_escape_string($conn, $_POST['pt_blood']);
    // validation 
    $namePattern = '/^[a-zA-Z\s]+$/';
    $emailPattern = '/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/';
    $phonePattern = '/^\d{10}$/';
    $addressPattern = '/^[a-zA-Z]+$/';
    $passwordPattern = "/^[a-zA-Z0-9\s]*$/";
    $agePattern = '/^\d{2}$/';

// username 
if (empty($username)) {
    $errors['username'] = "User is required";
} elseif (!preg_match($namePattern, $username)) {
    $errors['username'] = "Invalid Name. Only letters and spaces are allowed";
}


    // Name validation
    if (empty($pt_name)) {
        $errors['name'] = "Please enter name";
    } elseif (!preg_match($namePattern, $pt_name)) {
        $errors['name'] = "Invalid Name. Only letters and spaces are allowed";
    }

    // Email validation
    if (empty($pt_email)) {
        $errors['email'] = "Please enter an email address";
    } elseif (!preg_match($emailPattern, $pt_email)) {
        $errors['email'] = "Please enter a valid email address";
    }

    //Phone
    if (empty($pt_phone)) {
        $errors['phone'] = "Please enter  phone number";
    } elseif (!preg_match($phonePattern, $pt_phone)) {
        $errors['phone'] = "Please enter a valid phone number";
    }

    // Address validation
    if (empty($pt_address)) {
        $errors['address'] = "Please enter an address";
    } elseif (!preg_match($addressPattern, $pt_address)) {
        $errors['address'] = "Invalid address. Only letters, numbers, and spaces are allowed";
    }

    if (empty($pt_age)) {
        $errors['age'] = "Please enter  age";
    } elseif (!preg_match($agePattern, $pt_age)) {
        $errors['age'] = "Please enter a valid age";
    }
    // Gender validation
    $genderValid = ['male', 'female', 'other'];
    if (empty($pt_sex)) {
        $errors['gender'] = "Select a gender";
    } elseif (!in_array($pt_sex, $genderValid)) {
        $errors['gender'] = "Invalid gender selected";
    }


    // Blood group validation
    $bloodValid = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
    if (empty($pt_blood)) {
        $errors['blood'] = "Please select a blood group";
    } elseif (!in_array($pt_blood, $bloodValid)) {
        $errors['blood'] = "Invalid blood group selected";
    }
if (empty(array_filter($errors))) {
    $user_tbl_update = "UPDATE user_tbl SET user_name='$username', user_email='$pt_email' WHERE id=$id ";
    if (mysqli_query($conn, $user_tbl_update)) {
        $update_query = "UPDATE `patient` SET `name`='$pt_name',`age`='$pt_age',`sex`='$pt_sex',`blood_group`='$pt_blood',`address`='$pt_address',`phone`='$pt_phone' WHERE user_id = $id";
        if (mysqli_query($conn, $update_query)) {
            $_SESSION['alert'] = "update successfully";
            $_SESSION['alert_code'] = "success";
            header('location:patient_list.php');
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
                    Update Patient
                </div>
                <?php
                $id = $_GET['id'];
                $select_query = "SELECT p.patient_id,p.user_id,p.patient_id,  p.name,p.age, p.sex, p.blood_group, p.address, p.phone, user_tbl.id,user_tbl.user_name,user_tbl.user_email FROM patient as p
                INNER JOIN user_tbl ON p.user_id = user_tbl.id
                 WHERE p.user_id=$id";
                $result = mysqli_query($conn, $select_query) or die("Query Failed");
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <div class="card-body">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo $row['patient_id'] ?>">
                                <div class="form-group">
                                    <label>Patient Username:</label>
                                    <input type="text" name="username" value="<?php echo $row['user_name'] ?>" class="form-control" placeholder="Enter username">
                               
                                    <span style='color:red' ;><?php echo $errors['username'] ?></span>
                                 </div>
                                <div class="form-group">
                                    <label>Patient Name:</label>
                                    <input type="text" name="pt_name" value="<?php echo $row['name'] ?>" class="form-control" placeholder="Enter Patient Name">
                               
                                    <span style='color:red' ;><?php echo $errors['name'] ?></span>
                                 </div>
                                <div class="form-group">
                                    <label>Patient Email:</label>
                                    <input type="email" name="pt_email" value="<?php echo $row['user_email'] ?>" class="form-control" placeholder="Enter Patient Email">
                                    <span style='color:red' ;><?php echo $errors['email'] ?></span>
                                </div>
                                <div class="form-group">
                                    <label>Patient Phone No:</label>
                                    <input type="number" name="pt_phone" value="<?php echo $row['phone'] ?>" class="form-control" placeholder="Enter Patient Phone No">
                                    <span style='color:red' ;><?php echo $errors['phone'] ?></span>
                                </div>
                                <div class="form-group">
                                    <label>Patient Address:</label>
                                    <input type="text" name="pt_address" value="<?php echo $row['address'] ?>" class="form-control" placeholder="Enter Patient Address">
                                    <span style='color:red' ;><?php echo $errors['address'] ?></span>
                                </div>
                                <div class="form-group">
                                    <label>Patient Age:</label>
                                    <input type="number" name="pt_age" value="<?php echo $row['age'] ?>" class="form-control" placeholder="Enter Patient Age">
                                    <span style='color:red' ;><?php echo $errors['age'] ?></span>
                                </div>
                                <div class="form-group">
                                    <label>Patient Sex:</label>
                                    <select name="pt_sex" id="sex" class="form-control">
                                        <option selected>Select Option</option>

                                        <option value="male" <?php echo ($row['sex'] == 'male') ? 'selected' : ''; ?>>Male</option>
                                        <option value="female" <?php echo ($row['sex'] == 'female') ? 'selected' : ''; ?>>Female</option>
                                        <option value="other" <?php echo ($row['sex'] == 'other') ? 'selected' : ''; ?>>Other</option>
                                    </select>
                                    <span style='color:red' ;><?php echo $errors['gender'] ?></span>
                                </div>
                                <div class="form-group">
                                    <label>Patient Blood:</label>
                                    <select name="pt_blood" id="" class="form-control">
                                        <option selected>Select Option</option>
                                        <option value="A+" <?php echo ($row['blood_group'] == 'A+') ? 'selected' : ''; ?>>A+</option>
                                        <option value="A-" <?php echo ($row['blood_group'] == 'A-') ? 'selected' : ''; ?>>A-</option>
                                        <option value="B+" <?php echo ($row['blood_group'] == 'B+') ? 'selected' : ''; ?>>B+</option>
                                        <option value="B-" <?php echo ($row['blood_group'] == 'B-') ? 'selected' : ''; ?>>B-</option>
                                        <option value="AB+" <?php echo ($row['blood_group'] == 'AB+') ? 'selected' : ''; ?>>AB+</option>
                                        <option value="AB-" <?php echo ($row['blood_group'] == 'AB-') ? 'selected' : ''; ?>>AB-</option>
                                        <option value="O+" <?php echo ($row['blood_group'] == 'O+') ? 'selected' : ''; ?>>O+</option>
                                        <option value="O-" <?php echo ($row['blood_group'] == 'O-') ? 'selected' : ''; ?>>O-</option>
                                    </select>
                                    <span style='color:red' ;><?php echo $errors['blood'] ?></span>
                                </div>

                                <div class="form-group">
                                    <a href="patient_list.php" class="btn btn-danger mr-2">Cancel</a>
                                    <button type="submit" name="update" class="btn btn-success">Update Patient</button>
                                </div>
                            </form>
                            <?php 
                    }}
                    ?>

                        </div>
            </div>
        </div>
    </div>


    <?php
    include('includes/scripts.php');
    include('includes/footer.php');
    ?>