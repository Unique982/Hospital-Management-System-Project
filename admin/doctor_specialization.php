<?php 
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');
$errors = [
    'specialization' =>''
];

if(isset($_POST['add'])){
    $specialization = mysqli_real_escape_string($conn, $_POST['specialization']);
  // 
  $specializationPattern = "/^[a-zA-Z\s]+$/";
  if(empty($specialization)){
    $errors['specialization'] = "Please enter a specialization";
  }
  else if(!preg_match($specializationPattern,$specialization)){
    $errors['specialization'] = "Invalid specialization. Only latter and spaces are allowed.";
  }
  if(empty(array_filter($errors))){
    $sql = "INSERT INTO `specialization`(specialization,created_at) VALUES ('$specialization', Now())";
   if(mysqli_query($conn, $sql)){
    $_SESSION['alert'] = "Added successfully";
    $_SESSION['alert_code'] = "success";
   
    }
    else{
        $_SESSION['alert'] = "Failed";
        $_SESSION['alert_code'] = "error";
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
            <form action="" method="POST" enctype="multipart/form-data" >
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Specialization</label>
                    <input type="text" name="specialization" class="form-control" placeholder="Enter Specialization">
                    <span style='color:red' ;><?php echo $errors['specialization'] ?></span> 
                </div>
               
            </div>
            <div class="modal-footer">
                <a href="doctor_specialization.php" class="btn btn-secondary">Close</a>
                <button type="submit" name="add" class="btn btn-primary">Add</button>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="container-fluid">
    <!-- DataTales Example -->
  
                                 
    <div class="card mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">User List
                <button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#exampleModal">
                    Add Doctor
                </button>
            </h6>
        </div>
        <div class="card-body">
            <?php
             $sql1 = "SELECT * FROM specialization  ORDER BY `id` DESC";
             $result1 = mysqli_query($conn,$sql1) or die("Error Query"); 
             $count_row = mysqli_num_rows($result1);
             if($count_row >0){

             
            
            ?>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Specialization</th>
                            <th>Creation Date</th>
                            <th>Update Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $sn = +1 ;
                        while($row = mysqli_fetch_assoc($result1)){

                        
                        ?>
                        <tr>
                            <td><?php echo $sn; ?></td>
                            <td><?php echo $row['specialization'] ?></td>
                            <td><?php echo date("Y M d ", strtotime($row['created_at'])) ; ?></td>
                            <td>2024/12/12</td>
                            <td><button type="button" class="btn btn-outline-warning btn-sm">View</button>
                              <a href="doctor_specialization_edit.php?id=<?php echo $row['id'] ?>" class="btn btn-outline-success btn-sm">Edit</a> 
                              <form action="doctor_specialization_delete.php" method="POST" id="deleteForm" style="display:inline-block; margin:2px;">
                              <input type="hidden" name="id" value="<?php echo $row['id'] ?>" class="dalete_id">
                              <button type="submit" name="delete" class="btn btn-outline-danger btn-sm deletebtn" data-delete-url="doctor_specialization_delete.php">Delete</button>
                            
                            </form> 
                              

                            </td>
                        </tr>
                        <?php
                     $sn ++;
                    }} ?>

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
