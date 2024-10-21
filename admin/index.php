<?php
session_start();
include('../database/config.php');
if(isset($_POST['login'])){
    $user_name_or_email= mysqli_real_escape_string($conn,$_POST['user_name_or_email']);
    $user_type = mysqli_real_escape_string($conn,$_POST['user_type']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);
if($user_type==='admin' || $user_type==='doctor' || $user_type==='nurse' || $user_type==='pharmacist' || $user_type==='laboratorist'||  $user_type==='accountant'){
    $sql = "SELECT user_name, user_email, role, password FROM user_tbl 
    WHERE (user_name = '$user_name_or_email' OR user_email = '$user_name_or_email') 
    AND role = '$user_type'";
 $result = mysqli_query($conn,$sql); 
 if(mysqli_num_rows($result)>0){
    $user_data = mysqli_fetch_assoc($result);
    if(password_verify($password,$user_data['password'])){
        $_SESSION['user_data'] = $user_data;
        switch($user_type){
            case 'admin':   
        $_SESSION['alert'] ="Login successful";
        $_SESSION['alert_code'] ="success";
                header("Location:dashboard.php");
                exit();
                break;
                case 'doctor':
                    $_SESSION['alert'] ="Login successful";
                    $_SESSION['alert_code'] ="success";
                    header("Location:dashboard.php");
                exit();
                break;
                    case 'nurse':
                        $_SESSION['alert'] ="Login successful";
                        $_SESSION['alert_code'] ="success";
                        header("Location:dashboard.php");
                        exit();
                        break;
                        case 'pharmacist':
                            $_SESSION['alert'] ="Login successful";
                            $_SESSION['alert_code'] ="success";
                            header("Location:dashboard.php");
                            exit();
                            break;
                            case 'laboratorist':
                            $_SESSION['alert'] ="Login successful";
                            $_SESSION['alert_code'] ="success";
                            header("Location:dashboard.php");
                            exit();
                            break;     
    }
 }
 else {
    $_SESSION['alert'] ="Invalid Password";
    $_SESSION['alert_code'] ="warning";
 }}
 else{
    $_SESSION['alert'] ="Invalid username or email";
    $_SESSION['alert_code'] ="warning";
 }
}
 else if($user_type==='patient') {
    $sql1 = "SELECT name, email, password FROM patient WHERE (name = '$user_name_or_email' OR email = '$user_name_or_email')";
    $result2 = mysqli_query($conn, $sql1);
 if(mysqli_num_rows($result2)>0){
    $pateint_data = mysqli_fetch_assoc($result2);
    if(password_verify($password,$pateint_data['password'])){
        $_SESSION['pateint_data'] = $pateint_data;
        header("location:dashboard.php");
     exit();
    }
    else{
       
        $_SESSION['alert'] ="Invalid Password";
        $_SESSION['alert_code'] ="warning";
    }
 }
 else{
    $_SESSION['alert'] ="Invalid Username or email";
    $_SESSION['alert_code'] ="warning";
   
 }
 }
 else{
    $_SESSION['alert'] ="Please Select a Valid UserType";
    $_SESSION['alert_code'] ="warning";
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

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <style>
    body{
        font-family: 'Times New Roman';
        background-image: url("../assets/images/Tiny doctors and patients near hospital flat vector illustration.jpg");
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
    }
</style>
  <body>
      <div class="container mt-5 ">
        <div class="row justify-content-center">
            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                <div class="card shadow">
                <div class="card-header text-center text-primary p-2">
                <h1> Login Page</h1>    
                </div>
                <div class="card-body">
            <form action="" method="post">
                <div class="form-group">
                    <label for="">Username or Email</label>
                    <input type="text" name="user_name_or_email" class="form-control" placeholder="Username/Email">
                </div>
                <div class="form-group">
                    <label for="">User Type:</label>
                    <select name="user_type" id="" class="form-control">
                        <option selected>Select User Type</option>
                        <option value="admin">Admin</option>
                        <option value="doctor">Doctor</option>
                        <option value="nurse">Nurse</option>
                        <option value="pharmacist">Pharmacist</option>
                        <option value="laboratorist">Laboratorist</option>
                        <option value="accountant">Accountant</option>
                        <option value="patient">Patient</option>
                    </select>
                </div>
                <div class="fomr-group">
                    <label for="">Password</label>
                    <input type="password" class="form-control" name="password">
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