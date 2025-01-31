<?php
include('../database/config.php');
session_start();

$errors = [
  'new_password' => '',
  'confirm_password' => ''
];
if(isset($_POST['reset_password'])){
  $new_password = isset($_POST['new_password']) ?  mysqli_real_escape_string($conn,$_POST['new_password']) :'';
  $confirm_password = isset($_POST['confirm_password']) ? mysqli_real_escape_string($conn,$_POST['confirm_password']):'';
  
  // validation password 
  if(empty($new_password)){
    $errors['new_password'] = "New password is required";
  } elseif (strlen($_POST['new_password']) < 8) {
    $errors['new_password'] = "Password must be at least 8 characters long.";
  } 
  if(empty($confirm_password)){
    $errors['confirm_password'] = "Confirm password is required";
  }elseif($new_password!== $confirm_password){
    $errors['confirm_password'] = "Password do not match";
  }
 
  if (empty(array_filter($errors))) {
    $hashed_password = password_hash($new_password,PASSWORD_BCRYPT);
 $update_query = "UPDATE user_tbl SET password='$hashed_password'";
 if(mysqli_query($conn,$update_query)){
  $_SESSION['alert'] = "Password Reset Successfully";
  $_SESSION['alert_code'] = "success";
  header('location:index.php');
  exit();
 } else{
  $_SESSION['alert'] = "Failed";
  $_SESSION['alert_code'] = "error";
  header('location:index.php');
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
  <div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="row justify-content-center w-100">
      <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6 mx-auto">
        <div class="card shadow">
          <div class="card-header text-center text-primary p-2">
            Create New Password
          </div>
          <div class="card-body">
            <form action="" method="post">
              <div class="form-group">
                <label for="">New password</label>
                <input type="text" name="new_password" class="form-control" placeholder="Enter new password" value="<?php echo isset($new_password) ? $new_password:'' ;?>">
                <span style='color:red' ;><?php echo $errors['new_password'] ?></span>
              </div>
              <div class="form-group">
                <label for="">Confirm password</label>
                <input type="text" name="confirm_password" class="form-control" placeholder="Enter Confimr Password"value="<?php echo isset($confirm_password) ? $confirm_password:'' ;?>">
                <span style='color:red' ;><?php echo $errors['confirm_password'] ?></span>
            
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
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>