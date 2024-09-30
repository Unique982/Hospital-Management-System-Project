<?php include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');
if(isset($_POST['register'])){
    $bl_name = mysqli_real_escape_string($conn, $_POST['bl_name']);
    $bl_email = mysqli_real_escape_string($conn, $_POST['bl_email']);
    $bl_gender = mysqli_real_escape_string($conn, $_POST['bl_gender']);
    $bl_age = mysqli_real_escape_string($conn, $_POST['bl_age']); 
    $bl_phone = mysqli_real_escape_string($conn, $_POST['bl_phone']); 
    $bl_address = mysqli_real_escape_string($conn, $_POST['bl_address']);
 $bl_blood = mysqli_real_escape_string($conn, $_POST['bl_blood']);
$bl_last_time = mysqli_real_escape_string($conn, $_POST['bl_last_time']);
$bl_available = isset($_POST['bl_available']) ? 1 : 0;

// check
$select_query = "SELECT email, phone FROM blood_donors WHERE email='$bl_email'OR phone = '$bl_phone'";
$result = mysqli_query($conn,$select_query);
if(mysqli_num_rows($result)>0){
    $_SESSION['alert'] ="Already Create";
    $_SESSION['alert_code'] ="info";
   
}
else{
   $insert_query = "INSERT INTO `blood_donors`(`name`, `email`, `gender`, `blood_group`, `phone`, `address`, `age`, `last_donated`, `is_available`, `created_at`) 
   VALUES('$bl_name','$bl_email','$bl_gender','$bl_blood','$bl_phone','$bl_address','$bl_age','$bl_last_time','$bl_available',Now())";
   if(mysqli_query($conn,$insert_query)){
    $_SESSION['alert'] ="User Create Successfully";
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
                    Add Blood Donor
                </div>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="bl_name" class="form-control" placeholder="Enter Name">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="bl_email" class="form-control" placeholder="Enter Email">
                        </div>
                        <div class="form-group">
                            <label for="">Gender</label>
                            <select name="bl_gender" id="gender" class="form-control">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Age</label>
                            <input type="date" name="bl_age" class="form-control" placeholder="Enter Age">
                        </div>
                        <div class="form-group">
                        <label for="">Phone</label>
                        <input type="phone" name="bl_phone" class="form-control" placeholder="Enter Phone">
                        </div>
                        <div class="form-group">
                        <label for="">Address</label>
                        <input type="address" name="bl_address" class="form-control" placeholder="Enter address">
                        </div>
                        <div class="form-group">
                            <label>Blood Group:</label>
                          <select name="bl_blood" id="" class="form-control">
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
                        <label for="">Last Donated Date</label>
                        <input type="date" name="bl_last_time" class="form-control">
                        </div>
                        <div class="form-group">
                        <label for="">Available for Donation</label>
                        <input type="checkbox" name="bl_available" class="form-checkbox">
                        </div>
                        <div class="form-group">
                        <button type="submit" name="register" class="btn btn-outline-primary" >Register For Donation</button>
                      
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