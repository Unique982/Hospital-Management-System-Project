<?php 
ob_start();
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');
$errors = [
    'name' => '',
    'email' => '',
    'phone' => '',
    'address' => '',
    'gender' => '',
    'age' => '',
    'blood' => '',
    'password' => '',
  ];
if(isset($_POST['add_patient'])){
    $pt_name = mysqli_real_escape_string($conn, $_POST['pt_name']);
    $pt_email = mysqli_real_escape_string($conn, $_POST['pt_email']);
    $pt_phone = mysqli_real_escape_string($conn, $_POST['pt_phone']);
    $pt_address = mysqli_real_escape_string($conn,$_POST['pt_address']);
    $pt_age = mysqli_real_escape_string($conn,$_POST['pt_age']);
    $pt_sex = mysqli_real_escape_string($conn,$_POST['pt_sex']);
    $pt_blood = mysqli_real_escape_string($conn,$_POST['pt_blood']);
    $pt_password = mysqli_real_escape_string($conn,password_hash($_POST['pt_password'],PASSWORD_BCRYPT));
    
    // validation 
    $namePattern = '/^[a-zA-Z\s]+$/';
    $emailPattern ='/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/';
    $phonePattern ='/^\d{10}$/';
    $addressPattern= '/^[a-zA-Z]+$/';
    $passwordPattern = "/^[a-zA-Z0-9\s]*$/";
    $agePattern = '/^\d{2}$/';

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
  
    if(empty($pt_age)) {
      $errors['age'] = "Please enter  age";
    }
    elseif (!preg_match($agePattern,$pt_age)){
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

    // check user already exists or not
    $select_query = "SELECT  email, phone FROM `patient` WHERE email = '$pt_email' OR phone='$pt_phone'";
    $result = mysqli_query($conn, $select_query) or die("Query failed");
    if(mysqli_num_rows($result) >0){
        
    $_SESSION['alert'] =" Patient Already Add ";
    $_SESSION['alert_code'] ="info";
       
    }
    else{
        $insert_query = "INSERT INTO `patient`( `name`, `age`, `sex`,  `blood_group`, `address`, `phone`, `password`, `email`) 
        VALUES('$pt_name','$pt_age','$pt_sex','$pt_blood','$pt_address','$pt_phone','$pt_password','$pt_email')";
      if(mysqli_query($conn, $insert_query)){
        
    $_SESSION['alert'] ="Patient Add Successfully ";
    $_SESSION['alert_code'] ="success";
    header('location:patient_list.php');
    exit();
      }
      else{
    $_SESSION['alert'] ="Failed";
    $_SESSION['alert_code'] ="error";
      }
    }
}  
}
?>
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header">
                   Add Patient
                </div>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Patient Name:</label>
                            <input type="text" name="pt_name" class="form-control" placeholder="Enter Patient Name" value="<?php echo isset($pt_name)? $pt_name:''?>">
                            <span style='color:red' ;><?php echo $errors['name'] ?></span>
                          </div>
                        <div class="form-group">
                            <label>Patient Email:</label>
                            <input type="email" name="pt_email" class="form-control" placeholder="Enter Patient Email" value="<?php echo isset($pt_email) ? $pt_email:'' ?>">
                            <span style='color:red' ;><?php echo $errors['email'] ?></span>
                          </div>
                        <div class="form-group">
                            <label>Patient Phone No:</label>
                            <input type="number" name="pt_phone" class="form-control" placeholder="Enter Patient Phone No" value="<?php echo isset($pt_phone) ? $pt_phone:'' ?>">
                            <span style='color:red' ;><?php echo $errors['phone'] ?></span>
                          </div>
                        <div class="form-group">
                            <label>Patient Address:</label>
                            <input type="text" name="pt_address" class="form-control" placeholder="Enter Patient Address" value="<?php echo isset($pt_address) ? $pt_address:'' ?>">
                            <span style='color:red' ;><?php echo $errors['address'] ?></span>
                          </div>
                        <div class="form-group">
                            <label>Patient Age:</label>
                            <input type="number" name="pt_age" class="form-control" placeholder="Enter Patient Age" value="<?php echo isset($pt_age) ? $pt_age:'' ?>">
                            <span style='color:red' ;><?php echo $errors['age'] ?></span>
                          </div>
                        <div class="form-group">
                            <label>Patient Sex:</label>
                          <select name="pt_sex" id="sex" class="form-control">
                            <option selected>Select Option</option>
                            <option value="male" <?php  echo isset($pt_sex) && $pt_sex=='male' ? 'selected' :'' ;?>>Male</option>
                            <option value="female" <?php echo isset($pt_sex) && $pt_sex=='female' ? 'selected' :''; ?>>Female</option>
                            <option value="other" <?php echo isset($pt_sex) && $pt_sex=='other' ? 'selected' :''; ?>>Other</option>
                          </select>
                          <span style='color:red' ;><?php echo $errors['gender'] ?></span>
                        </div>
                       
                        <div class="form-group">
                            <label>Patient Blood:</label>
                          <select name="pt_blood" id="" class="form-control">
                            <option selected>Select Option</option>
                            <option value="A+" <?php echo isset($pt_blood) && $pt_blood=='A+' ? 'selected' :''; ?>>A+</option>
                            <option value="A-" <?php echo isset($pt_bllod) && $pt_blood=='A-'? 'selected' :''; ?> >A-</option>
                            <option value="B+" <?php echo isset($pt_blood) && $pt_blood=='B+' ? 'selected' :''; ?>>B+</option>
                            <option value="B-"<?php echo isset($pt_blood) && $pt_blood=='B-' ? 'selected' :''; ?>>B-</option>
                            <option value="AB+" <?php echo isset($pt_blood) && $pt_blood=='AB+' ? 'selected' :''; ?>>AB+</option>
                            <option value="AB-" <?php echo isset($pt_blood) && $pt_blood=='AB-' ? 'selected' :''; ?>>AB-</option>
                            <option value="O+" <?php echo isset($pt_blood) && $pt_blood=='O+' ? 'selected' :''; ?>>O+</option>
                            <option value="O-" <?php echo isset($pt_blood) && $pt_blood=='O-' ? 'selected' :''; ?>>O-</option>
                          </select>
                          <span style='color:red' ;><?php echo $errors['blood'] ?></span>
                        </div>
                        <div class="form-group">
                            <label>Patient Password:</label>
                            
                            <input type="password" name="pt_password" class="form-control" placeholder="Enter Patient Password">
                            <span style='color:red' ;><?php echo $errors['password'] ?></span>
                          </div>
                        <div class="form-group">
                            <button type="submit" name="add_patient" class="btn btn-success">Add Patient</button>
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