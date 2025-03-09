<?php 
ob_start();
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');

if(!isset($_SESSION['id'])){
  header('location:index.php');
}

$id= $_GET['id'];
$sql = "SELECT p.id, p.name,p.age,p.sex,p.blood_group,p.address,p.phone, user_tbl.user_name,user_tbl.user_email, user_tbl.id FROM patient as p
INNER JOIN user_tbl ON p.user_id = user_tbl.id
WHERE user_id = $id ";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result)>0){
    $record = mysqli_fetch_array($result);

    ob_end_flush();
?>

<div class="container-fluid">
    <!-- DataTales Example -->
  
                                 
    <div class="card  mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Patient List
              <a href="patient_add.php">  <button type="button"  class="btn btn-primary mr-2" data-toggle="modal" data-target="#exampleModal">
                    Add New Patient
                </button>
                </a>
            </h6>
        </div>
        <div class="card-body">
       <!-- Php code -->
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <input type="hidden" value="<?php echo $record['id'] ?>"> 
                   <tr>
                     <th>Username:</th>
                    <td><?php echo $record['user_name'] ?></td>
                   </tr>
                   <tr>
                     <th>Name:</th>
                    <td><?php echo $record['name'] ?></td>
                   </tr>
                   <tr>
                     <th>Email:</th>
                    <td><?php echo $record['user_email'] ?></td>
                   </tr>
                   <tr>
                     <th>Age:</th>
                    <td><?php echo $record['age'] ?></td>
                   </tr><tr>
                     <th>Sex:</th>
                    <td><?php echo $record['sex'] ?></td>
                   </tr>
                   <tr>
                     <th>Phone:</th>
                    <td><?php echo $record['phone'] ?></td>
                   </tr>
                   <tr>
                     <th>Address:</th>
                    <td><?php echo $record['address'] ?></td>
                   </tr>
                   <tr>
                     <th>Blood:</th>
                    <td><?php echo $record['blood_group'] ?></td>
                   </tr>
                   <td colspan="2">
                   <a href="patient_list.php"><button class="btn btn-outline-success w-40">Go Back</button></a>
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