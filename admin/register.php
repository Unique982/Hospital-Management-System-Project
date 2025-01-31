<?php
include('../database/config.php');
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';



$errors = [
  'username' =>'',
  'name' => '',
  'email' => '',
  'phone' => '',
  'address' => '',
  'gender' => '',
  'blood' => '',
  'password' => '',
  'age' =>'',
];

if (isset($_POST['add_patient'])) {
  $username = mysqli_real_escape_string($conn,trim($_POST['username']));
  $pt_name = mysqli_real_escape_string($conn, trim($_POST['pt_name']));
  $pt_email = mysqli_real_escape_string($conn, trim($_POST['pt_email']));
  $pt_phone = mysqli_real_escape_string($conn,  trim($_POST['pt_phone']));
  $pt_address = mysqli_real_escape_string($conn, trim($_POST['pt_address']));
  $pt_age = mysqli_real_escape_string($conn,trim($_POST['pt_age']));
  $pt_sex =isset($_POST['pt_sex']) ? mysqli_real_escape_string($conn, trim($_POST['pt_sex'])):'';
  $pt_blood =isset($_POST['pt_blood']) ? mysqli_real_escape_string($conn, trim($_POST['pt_blood'])):'';
  $plan_password= $_POST['pt_password'];
  $pt_password = mysqli_real_escape_string($conn, password_hash($plan_password,PASSWORD_BCRYPT));

  // Regular expressions
  $namePattern = "/^[a-zA-Z\s]+$/";
  
  $emailPattern = "/^[a-z\._\-[0-9]*[@][a-z]*[\.][a-z]{2,4}$/";
  $phonePattern = "/^\d{10}$/";
    $addressPattern = "/^[a-zA-Z0-9\s]*$/";
  // $dobPattern = "/^\d{2}-\d{2}-\d{4}$/";
  $passwordPattern = "/^[a-zA-Z0-9\s]*$/";

  // username validation 
  if (empty($username)) {
    $errors['username'] = "username is requird";
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
  if(empty($pt_phone)) {
    $errors['phone'] = "Please enter  phone number";
  }
  elseif (!preg_match($phonePattern,$pt_phone)){
$errors['phone'] = "Please enter a valid phone number";
  }
    
  
  
  // Address validation
  if (empty($pt_address)) {
    $errors['address'] = "Please enter an address";
  } elseif (!preg_match($addressPattern, $pt_address)) {
    $errors['address'] = "Invalid address. Only letters, numbers, and spaces are allowed";
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

  // Password validation
  if (empty($pt_password)) {
    $errors['password'] = "Please enter a password";
  } elseif (strlen($_POST['pt_password']) < 8) {
    $errors['password'] = "Password must be at least 8 characters long.";
  } elseif (!preg_match($passwordPattern, $_POST['pt_password'])) {
    $errors['password'] = "Invalid password format.";
  }
  
  // If no errors, proceed with database insertion
  if (empty(array_filter($errors))) {
    // check user_tbal is record exists
   $check = "SELECT user_email FROM user_tbl WHERE user_email ='$pt_email'";
   $check_result = mysqli_query($conn,$check);
   if(mysqli_num_rows($check_result) < 0){
     $_SESSION['alert'] = 'User already exists';
     $_SESSION ['alert_code'] = 'info';
     header('location:index.php');
     exit();

   }else{
     $insert_user_table = "INSERT INTO `user_tbl`(user_name,user_email,role,password)VALUES
     ('$username','$pt_email','patient','$pt_password')";    
   if(mysqli_query($conn,$insert_user_table)){
     $user_id = mysqli_insert_id($conn);
     // insert data table patient 
     $insert_pateint = "INSERT INTO patient (`user_id`, `name`, `age`, `sex`, `blood_group`, `address`, `phone`)
     VALUES('$user_id','$pt_name','$pt_age','$pt_sex','$pt_blood','$pt_address','$pt_phone')";
     if(mysqli_query($conn,$insert_pateint)){
            
//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
$token = bin2hex(random_bytes(16));
$website_link = "http://192.168.18.8/Project%20List/Hospital%20Management%20System%20Project/admin/index.php?token=".$token;
try {
    //Server settings
   
    $mail->isSMTP();           
                                     //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'khemrajneupane111@gmail.com';                     //SMTP username
    $mail->Password   = 'dlps wtrg ctyt jgwt';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //ENCRYPTION_SMTPS 465 - Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('khemrajneupane111@gmail.com', 'Unique Neupane');
    $mail->addAddress($pt_email, $username);     //Add a recipient
  

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Register of Hospital Management System';
    $mail->Body    = '<p>Welcome,'.$username.'</p>
    <p>Thank you for registering at our hospital. Your information has been successfully added to our system.<p>
    <span>UserName :</span><p>'.$username.'</p> <br>
     <span>Email : </span><p>'.$pt_email.'</p><br>
      <span>Password :</span><p>'.$plan_password.'<b>
      <br> 
      <p> click the link below to log in to your account:</p>
      <a href='.$website_link.'>Login in Your Account
    
    ';
    if( $mail->send())
{
    $_SESSION['alert'] ="Send Email Successfully";
    $_SESSION['alert_code'] ="success";
    header('location:index.php');
    exit();
}
else{
    $_SESSION['alert'] ="Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
    $_SESSION['alert_code'] ="error";
    header('location:index.php');
    exit();
}
} catch (Exception $e) {
    $_SESSION['alert'] ="Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    $_SESSION['alert_code'] ="error";
    header('location:index.php');
    exit();
}
}
}
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

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<style>
  body {
    font-family: 'Times New Roman';
    background-image: url("../assets/images/Tiny doctors and patients near hospital flat vector illustration.jpg");
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
  }
</style>

<body>
  <div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="row justify-content-center w-100">
      <div class="col-md-8">
        <div class="card shadow">
          <div class="card-header text-center text-primary p-2">
            <h3> Register Form</h3>
          </div>
          <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data" autocapitalize="off" >             <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                    <label>User Name:</label>
                    <input type="text" name="username" class="form-control" placeholder="Enter username">
                    <span style='color:red' ;><?php echo $errors['username'] ?></span>
                  </div>
                  <div class="form-group">
                    <label>Patient Name:</label>
                    <input type="text" name="pt_name" class="form-control" placeholder="Enter Patient Name">
                    <span style='color:red' ;><?php echo $errors['name'] ?></span>
                  </div>
                  <div class="form-group md-6">
                    <label>Patient Email:</label>
                    <input type="email" name="pt_email" class="form-control" placeholder="Enter Patient Email">
                    <span style='color:red' ;><?php echo $errors['email'] ?></span>
                  </div>
                  <div class="form-group">
                    <label>Patient Phone No:</label>
                    <input type="number" name="pt_phone" class="form-control" placeholder="Enter Patient Phone No">
                    <span style='color:red' ;><?php echo $errors['phone'] ?></span>
                  </div>
                  <div class="form-group">
                    <label>Patient Age:</label>
                    <input type="number" name="pt_age" class="form-control" placeholder="Enter age">
                    <span style='color:red' ;><?php echo $errors['age'] ?></span>
                  </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label>Patient Address:</label>
                    <input type="text" name="pt_address" class="form-control" placeholder="Enter Patient Address">
                    <span style='color:red' ;><?php echo $errors['address'] ?></span>
                  </div>
                  <div class="form-group">
                    <label>Patient Gender:</label>
                    <select name="pt_sex" id="sex" class="form-control">
                      <option disabled selected>Select Option</option>
                      <option value="male">Male</option>
                      <option value="female">Female</option>
                      <option value="other">Other</option>
                    </select>
                    <span style='color:red' ;><?php echo $errors['gender'] ?></span>
                  </div>
                 
                  <div class="form-group">
                    <label>Patient Blood:</label>
                    <select name="pt_blood" id="" class="form-control">
                      <option disabled selected>Select Option</option>
                      <option value="A+">A+</option>
                      <option value="A-">A-</option>
                      <option value="B+">B+</option>
                      <option value="B-">B-</option>
                      <option value="AB+">AB+</option>
                      <option value="AB-">AB-</option>
                      <option value="O+">O+</option>
                      <option value="O-">O-</option>
                    </select>
                    <span style='color:red' ;><?php echo $errors['blood'] ?></span>
                  </div>
                  <div class="form-group">
                    <label>Patient Password:</label>
                    <input type="password" name="pt_password" class="form-control" placeholder="Enter Patient Password">
                    <span style='color:red' ;><?php echo $errors['password'] ?></span>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <button type="submit" name="add_patient" class="btn btn-success w-100">Signup Now</button>
              </div>
              <hr>
              <div class="form-group">
                <p class="text-muted">
                  When You Register by clicking Signup button, You Agree to ours
                  <a href="#">Terms and Conditions</a> and <a href="#">Privacy Policy</a>
                </p>
                <p class="text-center text-muted">Alread Have an Account ?
                  <a href="index.php">Login here</a>
                </p>
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