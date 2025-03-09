<?php 
ob_start();
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');

if(!isset($_SESSION['id'])){
    header('location:index.php');
}

$user_type = $_SESSION['user_data']['role'];
$user_id = $_SESSION['id'];
$rep_id= $_GET['rep_id'];
$sql = "SELECT r.rep_id, p.name AS patient,CONCAT(d.first_name,'',d.last_name)  As doctor_id,
r.report_type,r.date,r.description
FROM report AS r
INNER JOIN patient AS p ON r.patient_id =p.id
INNER JOIN doctors AS d ON r.doctor_id = d.id
where r.rep_id =$rep_id";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result)>0){
    $record = mysqli_fetch_array($result);
    ob_end_flush();
?>

<div class="container-fluid">
    <!-- DataTales Example -->
  
                                 
    <div class="card  mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Report Information
              <?php if($user_type=='admin' || $user_type=='doctor' || $user_type=='nurse') { ?>
            <a href="report_add.php">  <button type="button"  class="btn btn-primary mr-2" data-toggle="modal" data-target="#exampleModal">
                    Add Report
                </button>
                </a>
                <?php  } ?>
            </h6>
        </div>
        <div class="card-body">
       <!-- Php code -->
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <input type="hidden" value="<?php echo $record['rep_id'] ?>"> 
                   <tr>
                     <th>Report Type:</th>
                    <td><?php echo $record['report_type'] ?></td>
                   </tr>
                   <tr>
                     <th>Description:</th>
                    <td><?php echo $record['description'] ?></td>
                   </tr>
                   <tr>
                     <th>Date:</th>
                    <td><?php echo $record['date'] ?></td>
                   </tr>
                   <tr>
                     <th>Doctor:</th>
                    <td><?php echo $record['doctor_id'] ?></td>
                   </tr>
                   <tr>
                     <th>Patient:</th>
                    <td><?php echo $record['patient'] ?></td>
                   </tr>

                 
                   <td colspan="2">
                   <a href="manage_report.php"><button class="btn btn-outline-success w-40">Go Back</button></a>
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