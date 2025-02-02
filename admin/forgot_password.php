<?php
session_start();
include('../database/config.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$errors = [
  'email' => '',
];
if (isset($_POST['reset_password'])) {
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $otp_code = rand(100000, 999999);
  $otp_exp = date("Y-m-d H:i:s", strtotime("+1 minutes"));
  // Email validation
  if (empty($email)) {
    $errors['email'] = "Please enter an email address";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "Please enter a valid email address";
  } else {

    // check email in database
    $select_query = "SELECT user_email FROM user_tbl WHERE user_email='$email'";
    $result = mysqli_query($conn, $select_query);
    $_SESSION['user_email'] =$email;
    if (mysqli_num_rows($result) > 0) {

      $update_query = "UPDATE user_tbl SET otp_code = '$otp_code', otp_exp = '$otp_exp' WHERE user_email = '$email'";
      if (mysqli_query($conn, $update_query)) {
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);
        $token = bin2hex(random_bytes(16));
        $website_link = "http://192.168.18.8/Project%20List/Hospital%20Management%20System%20Project/admin/index.php?token=" . $token;
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
          $mail->addAddress($email);     //Add a recipient


          //Content
          $mail->isHTML(true);                                  //Set email format to HTML
          $mail->Subject = 'Password Reset Request: Hospital Management System';
          $mail->Body    = '<p>Dear,' . $username . '</p>
    <p>We have recevied a request to rest your password foer your account at our hospital management system.<p>
    <p></p>
    <span>Otp code :</span><p>' . $otp_code . '</p> <br>
  
      <br> 
      <p> click the link below to log in to your account:</p>
      <a href=' . $website_link . '>Login in Your Account
    
    ';
          if ($mail->send()) {
            $_SESSION['alert'] = "Otp has been sent to your email";
            $_SESSION['alert_code'] = "success";
            header('location:otp_password.php');
            exit();
          } else {
            $_SESSION['alert'] = "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
            $_SESSION['alert_code'] = "error";
            header('location:index.php');
            exit();
          }
        } catch (Exception $e) {
          $_SESSION['alert'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
          $_SESSION['alert_code'] = "error";
          header('location:index.php');
          exit();
        }
      }
    } else {
      $errors['email'] = "Invalid email address! Please enter a registere valid email.";
    }
  }
}


?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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
  <div class="container d-flex justify-content-center align-items-center vh-100 ">
    <div class="row justify-content-center w-100">
      <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
        <div class="card shadow">
          <div class="card-header text-center text-primary p-2">
            Forgot Your Password?
          </div>
          <div class="card-body">
            <form action="" method="post">
              <div class="form-group">
                <label for="">Email</label>
                <input type="text" name="email" class="form-control" placeholder="Enter your email">
                <span style='color:red' ;><?php echo $errors['email'] ?></span>
              </div>
              <div class="form-group">
                <button type="submit" name="reset_password" class="btn btn-success w-100">Reset Password</button>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <?php
    include('includes/scripts.php');

    ?>
</body>

</html>