<?php
include('../database/config.php');
session_start();
$errors = [
  'otp_code' => '',
];



if (isset($_POST['submit_otp'])) {
   $otp_code =trim($_POST['otp_code']);
 

   if (empty($otp_code)) {
    $errors['otp_code'] = "Please enter otp number";
  }else {
    
    $select_query = "SELECT otp_code FROM user_tbl";
    $result = mysqli_query($conn,$select_query);
    if(mysqli_num_rows($result) > 0){
      $otp_data = mysqli_fetch_assoc($result);
      $stored_code = $otp_data['otp_code'];

      if($otp_code==$stored_code){
        $_SESSION['alert'] = "OTP verified! You can reset password";
        $_SESSION['alert_code'] = "success";
        header("location:new_password.php");
        exit();
      }
   }  else{
        $_SESSION['alert'] = "invalid or expired OTP!";
        $_SESSION['alert_code'] = "error";
        header("location:index.php");
        exit();
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
            OTP?

          </div>
          <div class="card-body">
            <form action="" method="post">
              <div class="alert alert-primary" role="alert">
                Please check your email enter 
                receive OTP!.
              </div>
              <div class="form-group">
                <label for="">OTP</label>
                <input type="text" name="otp_code" class="form-control" placeholder="Enter Your OTP">
                <span style='color:red' ;><?php echo $errors['otp_code'] ?></span>
              </div>
              <div class="form-group">
                <button type="submit" name="submit_otp" class="btn btn-success w-100">OTP</button>
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
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>