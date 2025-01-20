<?php
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');
$id= $_GET['id'];
$sql = "SELECT a.phone,a.address,a.gender,
a.qualification, user_tbl.user_name as username, 
user_tbl.user_email,user_tbl.role, user_tbl.id   FROM accountant as a
INNER JOIN `user_tbl` ON a.user_id = user_tbl.id";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result)>0){
    $record = mysqli_fetch_array($result);
?>

<div class="container-fluid">
    <!-- DataTales Example -->                               
    <div class="card  mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Accountant Infromation
              <a href="accountant_add.php">  <button type="button"  class="btn btn-primary mr-2" data-toggle="modal" data-target="#exampleModal">
                    Add New Accountant
                </button>
                </a>
            </h6>
        </div>
        <div class="card-body">
       <!-- Php code -->
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <input type="hidden" name='id'  value="<?php echo $record['id'] ?>"> 
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
                   <a href="manage_accountant.php"><button class="btn btn-outline-success w-40">Go Back</button></a>
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