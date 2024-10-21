<?php
include('../database/config.php');
$errors = [
  'name' => '',
  'email' => '',
  'phone' => '',
  'address' => '',
  'dob' => '',
  'gender' => '',
  'blood' => '',
  'password' => '',
];

if (isset($_POST['add_patient'])) {
  $pt_name = mysqli_real_escape_string($conn, trim($_POST['pt_name']));
  $pt_email = mysqli_real_escape_string($conn, trim($_POST['pt_email']));
  $pt_phone = mysqli_real_escape_string($conn,  trim($_POST['pt_phone']));
  $pt_address = mysqli_real_escape_string($conn, trim($_POST['pt_address']));
  $pt_dob = mysqli_real_escape_string($conn, trim($_POST['pt_dob']));
  $pt_sex = mysqli_real_escape_string($conn, trim($_POST['pt_sex']));
  $pt_blood = mysqli_real_escape_string($conn, trim($_POST['pt_blood']));
  $pt_password = mysqli_real_escape_string($conn, password_hash($_POST['pt_password'], PASSWORD_BCRYPT));


  //regular Expression
  $namePattern = "/^[a-zA-Z\s]+$/";
  $emailPattern = "/^[a-z\._\-[0-9]*[@][a-z]*[\.][a-z]{2,4}$/";
  $phonePattern = "/^\+977[-\s]?[\d]{1}[-\s]?[\d]{3}?[\d]{4}$/";
  $addressPattern = "/^[a-zA-Z0-9\s]*$/";
  $dobPattern = "/^\d{2}-\d{2}-\d{4}$/";
  $passwordPattern = "/^[a-zA-Z0-9\s]*$/";



  // validation Name 
  if (empty($pt_name)) {
    $errors['name'] = "Please enter name";
  } elseif (!preg_match($namePattern, $pt_name)) {
    $errors['name'] = "Invalid Name. Only letter and space are allowed";
  }

  // Validaton Email 
  if (empty($pt_email)) {
    $errors['email'] = "Please enter a email address";
  } elseif (!preg_match($emailPattern, $pt_name)) {
    $errors['email'] = "Please enter email formate";
  }

  //Phone Number Validations
  if (empty($pt_phone)) {
    $errors['phone'] = "Please enter phone number";
  } else if (!preg_match($phonePattern, $pt_phone)) {
    $errors['phone'] = "Phone number must be start with 977 and be in the formate +977-9-xx-xxxx. ";
  }

  // Address Validation
  if (empty($pt_address)) {
    $errors['address'] = "Please enter address";
  } elseif (!preg_match($addressPattern, $pt_address)) {
    $errors['address'] = "Invalid Address. Only latter,numper and space are allowed";
  }

  // Gender Validation 
  $genderValid = ['male', 'female', 'other'];
  if (empty($pt_sex)) {
    $errors['gender'] = "Select a gender";
  } elseif (!in_array($pt_sex, $genderValid)) {
    $errors['gender'] = "Invalid gender selected";
  }

  // dob validation 
  if (empty($pt_dob)) {
    $errors['dob'] = "Please enter dob";
  } elseif (!preg_match($dobPattern, $pt_dob)) {
    $errors['dob'] = "Invalid formate.please use mm-dd-yyyy formate.";
  }

  // blood validation 
  $bloodValid = ['A+', 'A-','B+','B-','AB+','Ab-','O+','O-'];
  if(empty($pt_blood)){
    $errors['blood'] = "Please select blood group";
  }
  elseif(!in_array($pt_blood,$bloodValid)){
    $errors['blood'] = "Invalid blood group selected";
  }
  // password validation 
  if(empty($pt_password)){
    $errors['password'] = "Please enter passwords";
  }
  elseif(strlen($pt_password<8)){
    $errors['password'] = "password must be at least 8 characters long.";
  }
  elseif(!preg_match($passwordPattern,$pt_password)){
    $errors['password'] = "Invalid";

  }
  // check user already exists or not
  if (empty(array_filter($errors))) {
    $select_query = "SELECT  email, phone FROM `patient` WHERE email = '$pt_email' OR phone='$pt_phone'";
    $result = mysqli_query($conn, $select_query) or die("Query failed");
    if (mysqli_num_rows($result) > 0) {

      $_SESSION['alert'] = " Patient Already Add ";
      $_SESSION['alert_code'] = "info";
      header("Location:index.php");
    } else {

      $insert_query = "INSERT INTO `patient`( `name`, `sex`, `dob`, `blood_group`, `address`, `phone`, `password`, `email`) 
        VALUES('$pt_name','$pt_sex','$pt_dob','$pt_blood','$pt_address','$pt_phone','$pt_password','$pt_email')";
      if (mysqli_query($conn, $insert_query)) {

        $_SESSION['alert'] = "Patient Add Successfully ";
        $_SESSION['alert_code'] = "success";
        header("Location:index.php");
        exit();
      } else {
        $_SESSION['alert'] = "Failed";
        $_SESSION['alert_code'] = "error";
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
  <div class="container mt-5 ">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card shadow">
          <div class="card-header text-center text-primary p-2">
            <h1> Register Form</h1>
          </div>
          <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-6">
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
                    <label>Patient Address:</label>
                    <input type="text" name="pt_address" class="form-control" placeholder="Enter Patient Address">
                    <span style='color:red' ;><?php echo $errors['address'] ?></span>
                  </div>

                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Patient Gender:</label>
                    <select name="pt_sex" id="sex" class="form-control">
                      <option selected>Select Option</option>
                      <option value="male">Male</option>
                      <option value="female">Female</option>
                      <option value="other">Other</option>
                    </select>
                    <span style='color:red' ;><?php echo $errors['gender'] ?></span>
                  </div>
                  <div class="form-group">
                    <label>Patient DOB:</label>
                    <input type="date" name="pt_dob" class="form-control" placeholder="Enter Patient Name">
                    <span style='color:red' ;><?php echo $errors['dob'] ?></span>
                  </div>
                  <div class="form-group">
                    <label>Patient Blood:</label>
                    <select name="pt_blood" id="" class="form-control">
                      <option selected>Select Option</option>
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