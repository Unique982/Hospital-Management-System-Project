<?php
ob_start();
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');

if(!isset($_SESSION['id'])){
    header('location:index.php');
}

$errors = [
    'name' => '',
    'email' => '',
    'gender' => '',
    'age' => '',
    'phone' => '',
    'address' => '',
    'blood' => '',
    'last_time' => '',

];

if (isset($_POST['register'])) {
    $bl_name = mysqli_real_escape_string($conn, $_POST['bl_name']);
    $bl_email = mysqli_real_escape_string($conn, $_POST['bl_email']);
    $bl_gender = mysqli_real_escape_string($conn, $_POST['bl_gender']);
    $bl_age = mysqli_real_escape_string($conn, $_POST['bl_age']);
    $bl_phone = mysqli_real_escape_string($conn, $_POST['bl_phone']);
    $bl_address = mysqli_real_escape_string($conn, $_POST['bl_address']);
    $bl_blood = mysqli_real_escape_string($conn, $_POST['bl_blood']);
    $bl_last_time = mysqli_real_escape_string($conn, $_POST['bl_last_time']);
    $bl_available = isset($_POST['bl_available']) ? 1 : 0;

    // validation Pattern formate 
    $namePattern = '/^[a-zA-Z\s]+$/';
    $emailPattern = '/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/';
    $agePattern = '/^\d+$/';
    $phonePattern = '/^\d{10}$/';
    $addressPattern = '/^[a-zA-Z]+$/';
    $DatePattern = '/^\d{4}-\d{2}-\d{2}$/';


    // validation  name
    if (empty($bl_name)) {
        $errors['name'] = "Name is required";
    } elseif (!preg_match($namePattern, $bl_name)) {
        $errors['name'] = "Invalid Name. Only letters and spaces are allowed";
    }

    // email validation 
    if (empty($bl_email)) {
        $errors['email'] = "Email is required";
    } elseif (!preg_match($emailPattern, $bl_email)) {
        $errors['email'] = "Email invalid";
    }

    // Gender Validation 
    $genderValid = ['male', 'female', 'other'];
    if (empty($bl_gender)) {
        $errors['gender'] = "Select a gender";
    } elseif (!in_array($bl_gender, $genderValid)) {
        $errors['gender'] = "Invalid gender selected";
    }

    // age Validation 
    if (empty($bl_age)) {
        $errors['age'] = "Age is Required";
    } elseif (!preg_match($agePattern, $bl_age)) {
        $errors['age'] = 'Invalid Age';
    } elseif ($bl_age < 18 || $bl_age > 40) {
        $errors['age'] = 'Age must be between 18 and 40';
    }

    // Phone Validation 
    if (empty($bl_phone)) {
        $errors['phone'] = "Phone is Required";
    } elseif (!preg_match($phonePattern, $bl_phone)) {
        $errors['phone'] = 'Invalid Phone';
    }

    // address Validation 
    if (empty($bl_address)) {
        $errors['address'] = "Address is Required";
    } elseif (!preg_match($addressPattern, $bl_address)) {
        $errors['address'] = 'Invalid Address';
    }
    // Blood group validation
    $bloodValid = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
    if (empty($bl_blood)) {
        $errors['blood'] = "Please select a blood group";
    } elseif (!in_array($bl_blood, $bloodValid)) {
        $errors['blood'] = "Invalid blood group selected";
    }
    // date formate Validation 
    if (empty($bl_last_time)) {
        $errors['last_time'] = "Please last donated date";
    } elseif (!preg_match($DatePattern, $bl_last_time)) {
        $errors['last_time'] = "Invalid date Formate. Please use YYYY-MM-DD";
    } else {
        // check date valid calander date
        list($year, $month, $day) = explode('-', $bl_last_time);
        if (!checkdate((int)$month, (int)$day, (int)$year)) {
            $errors['last_time'] = "Invalid  date. Please provide a valid date calender date";
        }
    }


    if (empty(array_filter($errors))) {
        // check
        $select_query = "SELECT email, phone FROM blood_donors WHERE email='$bl_email'OR phone = '$bl_phone'";
        $result = mysqli_query($conn, $select_query);
        if (mysqli_num_rows($result) > 0) {
            $_SESSION['alert'] = "Already Create";
            $_SESSION['alert_code'] = "info";
        } else {
            $insert_query = "INSERT INTO `blood_donors`(`name`, `email`, `gender`, `blood_group`, `phone`, `address`, `age`, `last_donated`, `is_available`, `created_at`) 
   VALUES('$bl_name','$bl_email','$bl_gender','$bl_blood','$bl_phone','$bl_address','$bl_age','$bl_last_time','$bl_available',Now())";
            if (mysqli_query($conn, $insert_query)) {
                $_SESSION['alert'] = "Blood Donor Create Successfully";
                $_SESSION['alert_code'] = "success";
                header('location:blood_donor_list.php');
                exit();
            } else {
                $_SESSION['alert'] = "Failed";
                $_SESSION['alert_code'] = "error";
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
                    Add Blood Donor
                </div>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="bl_name" class="form-control" placeholder="Enter Name" value="<?php echo isset($bl_name) ? $bl_name : ''; ?>">
                            <span style='color:red' ;><?php echo $errors['name'] ?></span>
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="bl_email" class="form-control" placeholder="Enter Email" value="<?php echo isset($bl_email) ? $bl_email : ''; ?>">
                            <span style='color:red' ;><?php echo $errors['email'] ?></span>
                        </div>
                        <div class="form-group">
                            <label for="">Gender</label>
                            <select name="bl_gender" id="gender" class="form-control">
                                <option selected>Select Option</option>
                                <option value="male" <?php echo isset($bl_gender) && $bl_gender == 'male' ? 'selected' : ''; ?>>Male</option>
                                <option value="female" <?php echo isset($bl_gender) && $bl_gender == 'female' ? 'selected' : ''; ?>>Female</option>
                                <option value="other" <?php echo isset($bl_gender) && $bl_gender == 'other' ? 'selected' : ''; ?>>Other</option>
                            </select>
                            <span style='color:red' ;><?php echo $errors['gender'] ?></span>
                        </div>
                        <div class="form-group">
                            <label for="">Age</label>
                            <input type="number" name="bl_age" class="form-control" placeholder="Enter Age" value="<?php echo isset($bl_age) ? $bl_age : ''; ?>">
                            <span style='color:red' ;><?php echo $errors['age'] ?></span>
                        </div>
                        <div class="form-group">
                            <label for="">Phone</label>
                            <input type="phone" name="bl_phone" class="form-control" placeholder="Enter Phone" value="<?php echo isset($bl_phone) ? $bl_phone : ''; ?>">
                            <span style='color:red' ;><?php echo $errors['phone'] ?></span>
                        </div>
                        <div class="form-group">
                            <label for="">Address</label>
                            <input type="address" name="bl_address" class="form-control" placeholder="Enter address" value="<?php echo isset($bl_address) ? $bl_address : ''; ?>">
                            <span style='color:red' ;><?php echo $errors['address'] ?></span>
                        </div>
                        <div class="form-group">
                            <label>Blood Group:</label>
                            <select name="bl_blood" id="" class="form-control">
                                <option selected>Select Option</option>
                                <option value="A+" <?php echo isset($bl_blood) && $bl_blood == 'A+' ? 'selected' : ''; ?>>A+</option>
                                <option value="A-" <?php echo isset($bl_blood) && $bl_blood == 'B-' ? 'selected' : ''; ?>>A-</option>
                                <option value="B+" <?php echo isset($bl_blood) && $bl_blood == 'B+' ? 'selected' : ''; ?>>B+</option>
                                <option value="B-" <?php echo isset($bl_blood) && $bl_blood == 'B-' ? 'selected' : ''; ?>>B-</option>
                                <option value="AB+" <?php echo isset($bl_blood) && $bl_blood == 'AB+' ? 'selected' : ''; ?>>AB+</option>
                                <option value="AB-" <?php echo isset($bl_blood) && $bl_blood == 'AB-' ? 'selected' : ''; ?>>AB-</option>
                                <option value="O+" <?php echo isset($bl_blood) && $bl_blood == 'O+' ? 'selected' : ''; ?>>O+</option>
                                <option value="O-" <?php echo isset($bl_blood) && $bl_blood == 'O-' ? 'selected' : ''; ?>>O-</option>
                            </select>
                            <span style='color:red' ;><?php echo $errors['blood'] ?></span>
                        </div>
                        <div class="form-group">
                            <label for="">Last Donated Date</label>
                            <input type="date" name="bl_last_time" class="form-control" value="<?php echo isset($bl_last_time) ? $bl_last_time : ''; ?>">
                            <span style='color:red' ;><?php echo $errors['last_time'] ?></span>
                        </div>
                        <div class="form-group">
                            <label for="">Available for Donation</label>
                            <input type="checkbox" name="bl_available" class="form-checkbox">
                        </div>
                        <div class="form-group">
                            <button type="submit" name="register" class="btn btn-outline-primary">Register For Donation</button>

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