<?php
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
   
    $sql = "UPDATE user_tbl SET user_name = '$username', user_email = '$email', 
    phone='$phone', address = '$address', role='$role' WHERE id = $id";
     if(mysqli_query($conn, $sql)){
        $_SESSION['alert'] ="update successfully";
        $_SESSION['alert_code'] ="success";
    
     }
     else{
        $_SESSION['alert'] ="Update failed";
        $_SESSION['alert_code'] ="warning";
     }
}
?>
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header">
                    Edit Doctor Details
                </div>
                <?php 
                 $id = $_GET['id'];
                 $select_query = "SELECT * FROM user_tbl where id = $id";
                 $result = mysqli_query($conn, $select_query) or die("Query failed");
                //  echo "<pre>";
                //  print_r($result);
                if(mysqli_num_rows($result)>0){
                    while($row = mysqli_fetch_assoc($result)){ 
                ?>

                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                        <div class="form-group">
                            <label for="">User Name</label>
                            <input type="text" name="username" value="<?php echo $row['user_name'] ?>" class="form-control" placeholder="Enter Doctor">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" value="<?php echo $row['user_email'] ?>" class="form-control" placeholder="Enter Email">
                        </div>
                        <div class="form-group">
                            <label for="">Phone No</label>
                            <input type="number" name="phone" value="<?php echo $row['phone'] ?>" class="form-control" placeholder="Enter Phone">
                        </div>
                        <div class="form-group">
                            <label for="">Address</label>
                            <input type="address" name="address" value="<?php echo $row['address'] ?>" class="form-control" placeholder="Enter Address">
                        </div>
                        <!-- <div class="form-group">
                    <label for="">Specialization</label>
                   <select name="specialization" id="specialization" class="form-control">
                    <option selected >Select One</option>
                    <option value="web"> Web Developer</option>
 
                   </select>
                </div> -->
                 
                        <div class="form-group">
                            <label for="">Role</label>
                            <select name="role" id="role" class="form-control" value="<?php echo $row['row'] ?>">
                            
        <option selected>Select</option>
       <option value="admin"<?php echo ($row['role'] =='admin') ?'selected' :''; ?>>Admin</option>
       <option value="doctor"<?php echo ($row['role'] =='doctor') ?'selected' :''; ?>>Doctor</option>
       <option value="nurse"<?php echo ($row['role'] =='nurse') ?'selected' :''; ?>>Nurse</option>
       <option value="patient"<?php echo ($row['role'] =='patient') ?'selected' :''; ?>>Patient</option>
       <option value="receptionist"<?php echo ($row['role'] =='receptionist') ?'selected' :''; ?>>Reciptionst</option>

                            </select>
                        </div>


                        <div class="modal-footer">
                            
                        <a href="employee_add.php" class="btn btn-danger">Cancel</a>
                            <button type="submit" name="update" class="btn btn-primary">Update</button>
                        </div>

                    </form>
                    <?php      }
                } ?>

                </div>
            </div>
        </div>
    </div>


    <?php
    include('includes/scripts.php');
    include('includes/footer.php');
    ?>