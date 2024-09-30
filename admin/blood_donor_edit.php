<?php include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');
if(isset($_POST['update'])){
    $blood_donor_id = $_POST['blood_donor_id'];
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
$update_query = "UPDATE blood_donors SET name ='$bl_name', email='$bl_email', gender = '$bl_gender',blood_group='$bl_blood',phone ='$bl_phone',
 address ='$bl_address', age = '$bl_age', last_donated= '$bl_last_time', is_available= '$bl_available' WHERE blood_donor_id = '$blood_donor_id'";
   if(mysqli_query($conn,$update_query)){
    echo "<div class='alert alert-success'>Blood donor record update successfully</div>";
    

   }
   else{
    echo "<div class='alert alert-danger'> Not update data</div>";
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
                <?php 
                $blood_donor_id = $_GET['blood_donor_id'];
                $select_query = "SELECT * FROM blood_donors WHERE blood_donor_id='$blood_donor_id'";
                $result = mysqli_query($conn, $select_query) or die("Query Failed");
                if(mysqli_num_rows($result)>0){
                    while($row = mysqli_fetch_assoc($result)){
                
                
                ?>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="blood_donor_id" value="<?php echo $row['blood_donor_id'] ?>">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="bl_name" value= "<?php echo $row['name'] ?>" class="form-control" placeholder="Enter Name">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="bl_email" value="<?php echo $row['email'] ?>" class="form-control" placeholder="Enter Email">
                        </div>
                        <div class="form-group">
                            <label for="">Gender</label>
                            <select name="bl_gender" id="gender" class="form-control">
                                <option  selected>Select One</option>
                            <option value="male"<?php echo ($row['gender'] =='male') ?'selected' :''; ?>>Male</option>
                            <option value="female"<?php echo ($row['gender'] =='female') ?'selected' :''; ?>>Female</option>
                            <option value="other"<?php echo ($row['gender'] =='other') ?'selected' :''; ?>>Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Age</label>
                            <input type="number" name="bl_age" value="<?php echo $row['age'] ?>" class="form-control" placeholder="Enter Age">
                        </div>
                        <div class="form-group">
                        <label for="">Phone</label>
                        <input type="phone" name="bl_phone" value="<?php echo $row['phone'] ?>" class="form-control" placeholder="Enter Phone">
                        </div>
                        <div class="form-group">
                        <label for="">Address</label>
                        <input type="address" name="bl_address" value="<?php echo $row['address'] ?>" class="form-control" placeholder="Enter address">
                        </div>
                        <div class="form-group">
                            <label>Blood Group:</label>
                          <select name="bl_blood" id="" class="form-control">
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
                        <label for="">Last Donated Date</label>
                        <input type="date" name="bl_last_time"   value="<?php echo $row['last_donated'] ?>"class="form-control">
                        </div>
                        <div class="form-group">
                        <label for="">Available for Donation</label>
                        <input type="checkbox" name="bl_available" class="form-checkbox"value="1" <?php echo ($row['is_available'] == 1) ? 'checked' : ''; ?>>
                        
                        </div>
                        <div class="form-group">
                        <button type="submit" name="update" class="btn btn-outline-primary" >Register For Donation</button>
                      
                        </div>

                    </form>
                    <?php 
                    }}
                    ?>
                </div>
            </div>
        </div>
    </div>


    <?php
    include('includes/scripts.php');
    include('includes/footer.php');
    ?>