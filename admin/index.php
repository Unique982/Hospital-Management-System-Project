<?php
session_start();
include('../database/config.php');


$errors = [
    'user_name' => '',
    'user_type' => '',
    'password' => ''
];

if (isset($_POST['login'])) {
    $user_name_or_email = mysqli_real_escape_string($conn, $_POST['user_name_or_email']);
    $user_type = isset($_POST['user_type']) ? mysqli_real_escape_string($conn, trim($_POST['user_type']))  :'';
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (empty($user_name_or_email)) {
        $errors['user_name'] = 'Required user name or email';
    }

    if (empty($user_type)) {
        $errors['user_type'] = "Select User Type";
    }

    if (empty($password)) {
        $errors['password'] = "Password Required";
    }

    if (empty($errors['user_name']) && empty($errors['user_type']) && empty($errors['password'])) {
        if ($user_type === 'admin' || $user_type === 'doctor' || $user_type === 'nurse' || $user_type === 'pharmacist' || $user_type === 'laboratorist' || $user_type === 'accountant' || $user_type = 'patient') {
            $sql = "SELECT id ,user_name, user_email, role, password FROM user_tbl 
                    WHERE (user_name = '$user_name_or_email' OR user_email = '$user_name_or_email') 
                    AND role ='$user_type'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);
                if (password_verify($password, $user_data['password'])) {
                    //
                    $_SESSION['user_name'] = $user_data['user_name'];
                    $_SESSION['id'] = $user_data['id'];
                    $_SESSION['user_data'] = $user_data;
                    $user_type = $_SESSION['user_data']['role'];

                    // get data 
                    $user_name = $_SESSION['user_name'];
                    $user_type = $_SESSION['user_data']['role'];
                    $user_id = $_SESSION['id'];

                    $ip_address = $local_ip = getHostByName(getHostName());
                    $status = "active";
                    $time = date('Y-m-d H:i:s');
                    $insert_query = "INSERT INTO activity_log( user_id,user_type, status, ip_address, time) 
                                     VALUES('".$_SESSION['id']. "', '$user_type', '$status', '$ip_address', '$time')";
                    if (!mysqli_query($conn, $insert_query)) {
                        $_SESSION['alert'] = "Activity Log insertion failed: " . mysqli_error($conn);
                        $_SESSION['alert_code'] = "warning";
                    }

                    // User redirect based on role
                    switch ($user_type) {
                        case 'admin':
                        case 'doctor':
                        case 'nurse':
                        case 'pharmacist':
                        case 'laboratorist':
                        case 'accountant':
                        case 'patient':
                            $_SESSION['alert'] = "Login successful";
                            $_SESSION['alert_code'] = "success";
                            header("Location: dashboard.php");
                            exit();
                            break;
                    }
                } else {
                    $_SESSION['alert'] = "Invalid password";
                    $_SESSION['alert_code'] = "warning";
                }
            } else {
                $_SESSION['alert'] = "Invalid username or email";
                $_SESSION['alert_code'] = "warning";
            }
        } else{
            $_SESSION['alert'] = "Please Select a Valid UserType";
            $_SESSION['alert_code'] = "warning";
        }
    }
}

?>


<!doctype html>
<html lang="en">

<head>
    <title>Login Page</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon.png" type="image/png" sizes="512*512" href="./assets/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="512*512" href="../assets/favicon/android-chrome-512x512.png"
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/favicon/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="96x96" href="../assets/favicon/favicon-96x96.png">
    <link rel="manifest" href="../assets/favicon/site.webmanifest">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<style>
    body {
        font-family: 'Times New Roman';
        background-image: url("https://acsonnet.com/wp-content/uploads/2021/07/Hospital-Management-Software.jpg");
       background-size: cover;
        background-position: center;
       background-repeat: no-repeat;

    }
</style>

<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="row justify-content-center w-100">
            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                <div class="card shadow">
                    <div class="card-header text-center text-primary p-2">
                        <h4> Login Page</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="">Username or Email</label>
                                <input type="text" name="user_name_or_email" class="form-control" placeholder="Username/Email">
                                <span style='color:red' ;><?php echo $errors['user_name'] ?></span>
                            </div>
                            <div class="form-group">
                                <label for="">User Type:</label>
                                <select name="user_type" id="" class="form-control">
                                    <option disabled selected>Select User Type</option>
                                    <option value="admin">Admin</option>
                                    <option value="doctor">Doctor</option>
                                    <option value="nurse">Nurse</option>
                                    <option value="pharmacist">Pharmacist</option>
                                    <option value="laboratorist">Laboratorist</option>
                                    <option value="accountant">Accountant</option>
                                    <option value="patient">Patient</option>

                                </select>
                                <span style='color:red' ;><?php echo $errors['user_type'] ?></span>
                            </div>
                            <div class="fomr-group">
                                <label for="">Password</label>
                                <input type="password" class="form-control" name="password">
                                <span style='color:red' ;><?php echo $errors['password'] ?></span>
                            </div>
                            <div class="form-check mt-2">
                                <input type="checkbox" name="remember" class="form-check-input">
                                <label for="">Remember</label>
                            </div>
                            <div class="from-group">
                                <button type="submit" name="login" class="btn btn-success w-100">Login</button>
                            </div>
                            <hr>
                            <div class="form-group">
                                <p class="text-center text-muted">Don't you have an account?
                                    <a href="register.php" class="text-center">Create Now</a>

                                </p>
                            </div>
                            <div class="form-group text-center text-muted">

                                <a href="forgot_password.php">Forgot password?</a>


                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php
    include('includes/scripts.php');

    ?>
</body>

</html>