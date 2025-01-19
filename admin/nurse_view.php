<?php
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');
$id= $_GET['id'];
$sql = "SELECT nurse.nurse_id,nurse.phone, nurse.address,nurse.gender,
nurse.qualification,  user_tbl.user_name as username, user_tbl.user_email,user_tbl.role, user_tbl.id
  FROM `nurse` 
INNER JOIN `user_tbl` ON nurse.user_id = user_tbl.id
";

$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result)>0){
    $record = mysqli_fetch_array($result);
?>

<div class="container-fluid">
    <!-- DataTales Example -->                               
    <div class="card  mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Infromation
              <a href="nurse_add.php">  <button type="button"  class="btn btn-primary mr-2" data-toggle="modal" data-target="#exampleModal">
                    Add New Nurse
                </button>
                </a>
            </h6>
        </div>
        <div class="card-body">
       <!-- Php code -->
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <input type="hidden" name='nurse_id'  value="<?php echo $record['nurse_id'] ?>"> 
                    <tr>
                        <th>User Name:</th>
                        <td><?php echo $record['username'];?></td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td><?php echo $record['user_email'];?></td>
                    </tr>
                    <tr>
                        <th>Qualification:</th>
                        <td><?php echo $record['qualification'];?></td>
                    </tr>
                    <tr>
                        <th>Phone:</th>
                        <td><?php echo $record['phone'];?></td>
                    </tr>
                    <tr>
                        <th>Address:</th>
                        <td><?php echo $record['address'];?></td>
                    </tr>
                    <tr>
                        <th>Gender:</th>
                        <td><?php echo ucfirst($record['gender']);?></td>
                    </tr>
                    <tr>
                        <th>Role:</th>
                        <td><?php echo ucfirst($record['role']);?></td>
                    </tr>
                   <td colspan="2">
                   <a href="manage_nurse.php"><button class="btn btn-outline-success w-40">Go Back</button></a>
</td>

                        <?php 
}
                        ?>
                     
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