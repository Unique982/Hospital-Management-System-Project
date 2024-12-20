<?php include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');
$rep_id= $_GET['rep_id'];
$sql = "SELECT r.rep_id,r.report_type,r.description,r.date,user_name as doctor_id, p.name as patient_id   
FROM report As r
INNER JOIN patient AS p ON  p.patient_id = r.patient_id
  INNER JOIN user_tbl AS u ON u.id = r.doctor_id
where r.rep_id =$rep_id";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result)>0){
    $record = mysqli_fetch_array($result);
?>

<div class="container-fluid">
    <!-- DataTales Example -->
  
                                 
    <div class="card  mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Report Information
              <a href="patient_add.php">  <button type="button"  class="btn btn-primary mr-2" data-toggle="modal" data-target="#exampleModal">
                    Add Report
                </button>
                </a>
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
                    <td><?php echo $record['patient_id'] ?></td>
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