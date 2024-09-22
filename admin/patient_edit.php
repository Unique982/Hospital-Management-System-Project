<?php include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');
if(isset($_POST['update'])){
    $patient_id = mysqli_real_escape_string($conn, $_POST['patient_id']);
    $pt_name = mysqli_real_escape_string($conn, $_POST['pt_name']);
    $pt_email = mysqli_real_escape_string($conn, $_POST['pt_email']);
    $pt_phone = mysqli_real_escape_string($conn, $_POST['pt_phone']);
    $pt_address = mysqli_real_escape_string($conn,$_POST['pt_address']);
    $pt_dob = mysqli_real_escape_string($conn,$_POST['pt_dob']);
    $pt_age = mysqli_real_escape_string($conn,$_POST['pt_age']);
    $pt_sex = mysqli_real_escape_string($conn,$_POST['pt_sex']);
    $pt_blood = mysqli_real_escape_string($conn,$_POST['pt_blood']);

        $update_query = "UPDATE `patient` SET `name`='$pt_name',`age`='$pt_age',`sex`='$pt_sex',`dob`='$pt_dob',`blood_group`='$pt_blood',`address`='$pt_address',`phone`='$pt_phone',`email`='$pt_email' WHERE patient_id = $patient_id";
      if(mysqli_query($conn, $update_query)){
       
        echo '<div class="alert alert-danger">Patient Add Successfully </div>';
    
      }
      else{
        echo '<div class="alert alert-danger">Insert failed </div>';

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
                <?php 
                $patient_id = $_GET['patient_id'];
                $select_query = "SELECT * FROM patient WHERE patient_id='$patient_id'";
                $result = mysqli_query($conn, $select_query) or die("Query Failed");
                if(mysqli_num_rows($result)>0){
                    while($row = mysqli_fetch_assoc($result)){
                
                
                ?>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="patient_id" value="<?php echo $row['patient_id'] ?>">
                        <div class="form-group">
                            <label>Patient Name:</label>
                            <input type="text" name="pt_name" value="<?php echo $row['name'] ?>" class="form-control" placeholder="Enter Patient Name">
                        </div>
                        <div class="form-group">
                            <label>Patient Email:</label>
                            <input type="email" name="pt_email" value="<?php echo $row['email'] ?>" class="form-control" placeholder="Enter Patient Email">
                        </div>
                        <div class="form-group">
                            <label>Patient Phone No:</label>
                            <input type="number" name="pt_phone" value="<?php echo $row['phone'] ?>" class="form-control" placeholder="Enter Patient Phone No">
                        </div>
                        <div class="form-group">
                            <label>Patient Address:</label>
                            <input type="text" name="pt_address" value="<?php echo $row['address'] ?>" class="form-control" placeholder="Enter Patient Address">
                        </div>
                        <div class="form-group">
                            <label>Patient Age:</label>
                            <input type="number" name="pt_age" value="<?php echo $row['age'] ?>" class="form-control" placeholder="Enter Patient Age">
                        </div>
                        <div class="form-group">
                            <label>Patient Sex:</label>
                          <select name="pt_sex" id="sex" class="form-control">
                            <option selected>Select Option</option>

                            <option value="male"<?php echo ($row['sex'] =='male') ?'selected' :''; ?>>Male</option>
                            <option value="female"<?php echo ($row['sex'] =='female') ?'selected' :''; ?>>Female</option>
                            <option value="other"<?php echo ($row['sex'] =='other') ?'selected' :''; ?>>Other</option>
                          </select>
                        </div>
                        <div class="form-group">
                            <label>Patient DOB:</label>
                            <input type="date" name="pt_dob" value="<?php echo $row['dob'] ?>" class="form-control" placeholder="Enter Patient Name">
                        </div>
                        <div class="form-group">
                            <label>Patient Blood:</label>
                          <select name="pt_blood" id="" class="form-control">
                            <option selected>Select Option</option>
                            <option value="A+"<?php echo ($row['blood_group'] =='A+') ?'selected' :''; ?>>A+</option>
                            <option value="A-"<?php echo ($row['blood_group'] =='A-') ?'selected' :''; ?>>A-</option>
                            <option value="B+"<?php echo ($row['blood_group'] =='B+') ?'selected' :''; ?>>B+</option>
                            <option value="B-" <?php echo ($row['blood_group'] =='B-') ?'selected' :''; ?>>B-</option>
                            <option value="AB+" <?php echo ($row['blood_group'] =='AB+') ?'selected' :''; ?>>AB+</option>
                            <option value="AB-" <?php echo ($row['blood_group'] =='AB-') ?'selected' :''; ?>>AB-</option>
                            <option value="O+"<?php echo ($row['blood_group'] =='O+') ?'selected' :''; ?>>O+</option>
                            <option value="O-"<?php echo ($row['blood_group'] =='O-') ?'selected' :''; ?>>O-</option>
                          </select>
                        </div>
                        
                        <div class="form-group">
                        <a href="patient_list.php" class="btn btn-danger mr-2">Cancel</a>
                            <button type="submit" name="update" class="btn btn-success">Update Patient</button>
                        </div>
                    </form>
                    <?php  }}
                    else{
                        echo "<div class='alert alert-text'>No data Found</div>";
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>


    <?php
    include('includes/scripts.php');
    include('includes/footer.php');
    ?>