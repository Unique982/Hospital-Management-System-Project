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
    'qualification' => '',
    'password' => ''

];

if (isset($_POST['add'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $qualification = mysqli_real_escape_string($conn, $_POST['qualification']);
    $password = mysqli_real_escape_string($conn, password_hash($_POST['password'], PASSWORD_BCRYPT));

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
    // password
    if (empty($password)) {
        $errors['password'] = 'Password is required';
    } elseif (strlen($_POST['password']) < 8) {
        $errors['password'] = 'Password must be at least 8 characters long.';
    }
    if (empty(array_filter($errors))) {
        $check = "SELECT user_email FROM user_tbl WHERE user_email='$email'";
        $check_result = mysqli_query($conn, $check);
        if (mysqli_num_rows($check_result) > 0) {
            // check user_tbl data same xa ki nai 
            $_SESSION['alert'] = "User already exists";
            $_SESSION['alert_code'] = "info";
            header('location:manage_accountant.php');
            exit();
        } else {
            $insert_usertbale = "insert into user_tbl(user_name,user_email,role,password) 
        Values('$username','$email','accountant','$password')";
        }
        if (mysqli_query($conn, $insert_usertbale)) {
            $user_id = mysqli_insert_id($conn);
            // check data same xa ki nai doctors tabls
            $sql = "SELECT user_id,  phone FROM accountant WHERE user_id = '$user_id' OR phone= '$phone'";
            $result = mysqli_query($conn, $sql) or die("Query failed");
            if (mysqli_num_rows($result) < 0) {
                $_SESSION['alert'] = "User already exists";
                $_SESSION['alert_code'] = "info";
                header('location:manage_pharmacist.php');
                exit();
            } else {
                $insert_query = "INSERT INTO `accountant`(`user_id`, `phone`, `address`, `gender`, `qualification`) 
                VALUES('$user_id','$phone','$address','$gender','$qualification')";
                if (mysqli_query($conn, $insert_query)) {

                    $_SESSION['alert'] = "Add Pharmacist Successfully ";
                    $_SESSION['alert_code'] = "success";
                    header('location:manage_accountant.php');
                    exit();
                } else {

                    $_SESSION['alert'] = "Failed";
                    $_SESSION['alert_code'] = "error";
                }
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
                    Add New Accountant
                </div>
                <div class="card-body">
                    <form action="" method="POST" class="needs-validation" novalidate>

                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">User Name</label>
                                <input type="text" name="username" class="form-control" placeholder="Enter username" value="<?php echo isset($username) ? $username : ''; ?>">
                                <span style='color:red' ;><?php echo $errors['username'] ?></span>
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter email" value="<?php echo isset($email) ? $email : ''; ?>">
                                <span style='color:red' ;><?php echo $errors['email'] ?></span>
                            </div>
                            <div class="form-group">
                                <label for="">Phone No</label>
                                <input type="number" name="phone" class="form-control" placeholder="Enter Phone" value="<?php echo isset($phone) ? $phone : ''; ?>">
                                <span style='color:red' ;><?php echo $errors['phone'] ?></span>
                            </div>
                            <div class="form-group">
                                <label for="">Address</label>
                                <input type="text" name="address" class="form-control" placeholder="Enter Address" value="<?php echo isset($address) ? $address : ''; ?>">
                                <span style='color:red' ;><?php echo $errors['address'] ?></span>
                            </div>
                            <div class="form-group">
                                <label for="">Gender</label>
                                <select name="gender" id="gender" class="form-control">
                                    <option selected>Select Gender</option>
                                    <option value="male" <?php echo isset($gender) && $gender == 'male' ? 'selected' : '' ?>>Male</option>
                                    <option value="female <?php echo isset($gender) && $gender == 'female' ? 'selected' : '' ?>">Female</option>
                                    <option value="other" <?php echo isset($gender) && $gender = 'other' ? 'selected' : '' ?>>Other</option>
                                </select>
                                <span style='color:red' ;><?php echo $errors['gender'] ?></span>
                            </div>
                            <div class="form-group">
                                <label for="">Qualification</label>
                                <input type="text" name="qualification" class="form-control" placeholder="Enter Address" value="<?php echo isset($qualification) ? $qualification : ''; ?>">
                                <span style='color:red' ;><?php echo $errors['qualification'] ?></span>
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Enter Password">
                                <span style='color:red' ;><?php echo $errors['password'] ?></span>
                            </div>

                            <div class="form-group">
                                <button type="submit" name="add" class="btn btn-primary">Save</button>
                            </div>

                    </form>
                </div>
            </div>
        </div>
        <?php
        include('includes/scripts.php');
        include('includes/footer.php');
        ?>