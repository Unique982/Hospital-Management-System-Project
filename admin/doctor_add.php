<?php include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');
if(isset($_POST['add'])){
      $username = mysqli_real_escape_string($conn, $_POST['username']);
      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $phone = mysqli_real_escape_string($conn, $_POST['phone']);
      $address = mysqli_real_escape_string($conn, $_POST['address']);
      $role = mysqli_real_escape_string($conn, $_POST['role']);
      $password = mysqli_real_escape_string($conn, $_POST['password']);
      $confrim_password = mysqli_real_escape_string($conn, $_POST['confrim_password']);

       // Query 
       $sql = "SELECT user_name, user_email, phone FROM user_tbl WHERE user_name = '$username'OR user_email='$email' OR phone= '$phone'";
       $result = mysqli_query($conn, $sql) or die("Query failed");
       if(mysqli_num_rows($result) >0){
        echo "<div class='text text-danger'>User alread exits </div>";
       }
       else{
        $insert_query = "INSERT INTO `user_tbl` (`user_name`, `user_email`, `phone`, `address`, `role`,
         `password`, `confirm_password`, `created_at`)
         VALUES('$username','$email','$phone','$address','$role','$password','$confrim_password',Now()) ";
         if(mysqli_query($conn,$insert_query)){
            echo "<div class='text text-danger'>New User Add Successfully</div>";

         }
         else{
            echo "<div class='text text-danger'>error </div>";
         }
        }
 }
?>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" class="needs-validation" novalidate>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">User Name</label>
                    <input type="text" name="username" class="form-control" placeholder="Enter Doctor">
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter Email">
                </div>
                <div class="form-group">
                    <label for="">Phone No</label>
                    <input type="number" name="phone" class="form-control" placeholder="Enter Phone">
                </div>
                <div class="form-group">
                    <label for="">Address</label>
                    <input type="address" name="address" class="form-control" placeholder="Enter Address">
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
                    <select name="role" id="role" class="form-control">
                        <option selected>Select</option>
                        <option value="Admin">Admin</option>
                        <option value="Doctor">Doctor</option>
                        <option value="Nurse">Nurse</option>
                        <option value="Receptionist">Receptionist</option>
                        <option value="Patient">Patient</option>

                    </select>
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter Password">
                </div>
                <div class="form-group">
                    <label for="">Confirm Password</label>
                    <input type="password" name="confrim_password" class="form-control" placeholder="Enter Confirm Password">
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="add" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="container-fluid">
    <!-- DataTales Example -->
  
                                 
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">User List
                <button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#exampleModal">
                    Add User
                </button>
            </h6>
        </div>
        <div class="card-body">
            <?php 
             $data_display= "SELECT * FROM user_tbl";
             $result1 = mysqli_query($conn,$data_display) or die("Query failed");
             $count_row = mysqli_num_rows($result1);
        if($count_row > 0){

             
            
            ?>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <td>Position</td>
                            <th>Start date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php 
                            $sn = +1;
                            while($row = mysqli_fetch_assoc($result1)){ ?>
                            <td><?php echo $sn; ?></td>
                            <td><?php echo $row['user_name'] ;?></td>
                            <td><?php echo $row['user_email'];?></td>
                            <td><?php echo $row['phone']; ?></td>
                            <td><?php echo $row['address']; ?></td>
                            <td><?php echo ucfirst($row['role']) ;?></td>
                            <td><?php echo date("Y M d ", strtotime($row['created_at'])) ?></td>
                            <td><button type="button" class="btn btn-outline-warning">View</button>
                          <a href="doctor_edit.php?id=<?php echo $row['id'] ?>" class="btn btn-outline-success">Edit</a>     
                                <button type="button" class="btn btn-outline-danger">Delete</button>

                            </td>
                        </tr>
                        <?php
                     $sn++;
                    
                    }?>
                    </tbody>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>

</div>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>