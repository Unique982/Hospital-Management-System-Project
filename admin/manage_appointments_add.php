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
                        <option value="admin">Admin</option>
                        <option value="doctor">Doctor</option>
                        <option value="nurse">Nurse</option>
                        <option value="receptionist">Receptionist</option>
                        <option value="patient">Patient</option>

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
                    Add Doctor
                </button>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Phone</th>
                            <th>Age</th>
                            <th>Start date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Tiger Nixon</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                            <td>2011/04/25</td>
                            <td><button type="button" class="btn btn-outline-warning">View</button>
                                <button type="button" class="btn btn-outline-success">Edit</button>
                                <button type="button" class="btn btn-outline-danger">Delete</button>

                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Garrett Winters</td>
                            <td>Accountant</td>
                            <td>Tokyo</td>
                            <td>63</td>
                            <td>2011/07/25</td>
                            <td><button type="button" class="btn btn-outline-warning">View</button>
                                <button type="button" class="btn btn-outline-success">Edit</button>
                                <button type="button" class="btn btn-outline-danger">Delete</button>

                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Ashton Cox</td>
                            <td>Junior Technical Author</td>
                            <td>San Francisco</td>
                            <td>66</td>
                            <td>2009/01/12</td>
                            <td><button type="button" class="btn btn-outline-warning">View</button>
                                <button type="button" class="btn btn-outline-success">Edit</button>
                                <button type="button" class="btn btn-outline-danger">Delete</button>

                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Cedric Kelly</td>
                            <td>Senior Javascript Developer</td>
                            <td>Edinburgh</td>
                            <td>22</td>
                            <td>2012/03/29</td>
                            <td><button type="button" class="btn btn-outline-warning">View</button>
                                <button type="button" class="btn btn-outline-success">Edit</button>
                                <button type="button" class="btn btn-outline-danger">Delete</button>

                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Airi Satou</td>
                            <td>Accountant</td>
                            <td>Tokyo</td>
                            <td>33</td>
                            <td>2008/11/28</td>
                            <td><button type="button" class="btn btn-outline-warning">View</button>
                                <button type="button" class="btn btn-outline-success">Edit</button>
                                <button type="button" class="btn btn-outline-danger">Delete</button>

                            </td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>Brielle Williamson</td>
                            <td>Integration Specialist</td>
                            <td>New York</td>
                            <td>61</td>
                            <td>2012/12/02</td>
                            <td><button type="button" class="btn btn-outline-warning">View</button>
                                <button type="button" class="btn btn-outline-success">Edit</button>
                                <button type="button" class="btn btn-outline-danger">Delete</button>

                            </td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>Herrod Chandler</td>
                            <td>Sales Assistant</td>
                            <td>San Francisco</td>
                            <td>59</td>
                            <td>2012/08/06</td>
                            <td><button type="button" class="btn btn-outline-warning">View</button>
                                <button type="button" class="btn btn-outline-success">Edit</button>
                                <button type="button" class="btn btn-outline-danger">Delete</button>

                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>