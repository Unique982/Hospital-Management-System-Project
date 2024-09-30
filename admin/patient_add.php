<?php include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');
if(isset($_POST['add_patient'])){
    $pt_name = mysqli_real_escape_string($conn, $_POST['pt_name']);
    $pt_email = mysqli_real_escape_string($conn, $_POST['pt_email']);
    $pt_phone = mysqli_real_escape_string($conn, $_POST['pt_phone']);
    $pt_address = mysqli_real_escape_string($conn,$_POST['pt_address']);
    $pt_dob = mysqli_real_escape_string($conn,$_POST['pt_dob']);
    $pt_age = mysqli_real_escape_string($conn,$_POST['pt_age']);
    $pt_sex = mysqli_real_escape_string($conn,$_POST['pt_sex']);
    $pt_blood = mysqli_real_escape_string($conn,$_POST['pt_blood']);
    $pt_password = mysqli_real_escape_string($conn,$_POST['pt_password']);

    // check user already exists or not
    $select_query = "SELECT  email, phone FROM `patient` WHERE email = '$pt_email' OR phone='$pt_phone'";
    $result = mysqli_query($conn, $select_query) or die("Query failed");
    if(mysqli_num_rows($result) >0){
        
    $_SESSION['alert'] =" Patient Already Add ";
    $_SESSION['alert_code'] ="info";
       
    }
    else{
        $insert_query = "INSERT INTO `patient`( `name`, `age`, `sex`, `dob`, `blood_group`, `address`, `phone`, `password`, `email`) 
        VALUES('$pt_name','$pt_age','$pt_sex','$pt_dob','$pt_blood','$pt_address','$pt_phone','$pt_password','$pt_email')";
      if(mysqli_query($conn, $insert_query)){
        
    $_SESSION['alert'] ="Patient Add Successfully ";
    $_SESSION['alert_code'] ="success";
      }
      else{
    $_SESSION['alert'] ="Failed";
    $_SESSION['alert_code'] ="error";
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
                            <input type="text" name="pt_name" class="form-control" placeholder="Enter Patient Name">
                        </div>
                        <div class="form-group">
                            <label>Patient Email:</label>
                            <input type="email" name="pt_email" class="form-control" placeholder="Enter Patient Email">
                        </div>
                        <div class="form-group">
                            <label>Patient Phone No:</label>
                            <input type="number" name="pt_phone" class="form-control" placeholder="Enter Patient Phone No">
                        </div>
                        <div class="form-group">
                            <label>Patient Address:</label>
                            <input type="text" name="pt_address" class="form-control" placeholder="Enter Patient Address">
                        </div>
                        <div class="form-group">
                            <label>Patient Age:</label>
                            <input type="number" name="pt_age" class="form-control" placeholder="Enter Patient Age">
                        </div>
                        <div class="form-group">
                            <label>Patient Sex:</label>
                          <select name="pt_sex" id="sex" class="form-control">
                            <option selected>Select Option</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                          </select>
                        </div>
                        <div class="form-group">
                            <label>Patient DOB:</label>
                            <input type="date" name="pt_dob" class="form-control" placeholder="Enter Patient Name">
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
                        </div>
                        <div class="form-group">
                            <label>Patient Password:</label>
                            <input type="password" name="pt_password" class="form-control" placeholder="Enter Patient Password">
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