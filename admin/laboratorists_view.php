<?php
ob_start();
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');

if(!isset($_SESSION['id'])){
    header('location:index.php');
}

$id= $_GET['id'];
$sql = "SELECT l.phone,l.address,l.gender,
l.qualification, user_tbl.user_name as username, 
user_tbl.user_email,user_tbl.role, user_tbl.id   FROM laboratorists as l
INNER JOIN `user_tbl` ON l.user_id = user_tbl.id 
WHERE user_id = $id";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result)>0){
    $record = mysqli_fetch_array($result);

    ob_end_flush();
?>

<div class="container-fluid">
    <!-- DataTales Example -->                               
    <div class="card  mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Accountant Infromation
              <a href="laboratorists_add.php">  <button type="button"  class="btn btn-primary mr-2" data-toggle="modal" data-target="#exampleModal">
                    Add New Laboratorists
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
                   <a href="manage_laboratorists.php"><button class="btn btn-outline-success w-40">Go Back</button></a>
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