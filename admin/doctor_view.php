<?php include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');
$id= $_GET['id'];
$sql = "SELECT * FROM user_tbl WHERE id =$id";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result)>0){
    $record = mysqli_fetch_array($result);
?>

<div class="container-fluid">
    <!-- DataTales Example -->                               
    <div class="card  mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Infromation
              <a href="patient_add.php">  <button type="button"  class="btn btn-primary mr-2" data-toggle="modal" data-target="#exampleModal">
                    Add New Employee
                </button>
                </a>
            </h6>
        </div>
        <div class="card-body">
       <!-- Php code -->
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <input type="hidden"  value="<?php echo $record['id'] ?>"> 
                    <tr>
                        <th>Doctor Name:</th>
                        <td><?php echo $record['user_name'];?></td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td><?php echo $record['user_email'];?></td>
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
                        <th>Role:</th>
                        <td><?php echo $record['role'];?></td>
                    </tr>
                   <td colspan="2">
                   <a href="employee_add.php"><button class="btn btn-outline-success w-40">Go Back</button></a>
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