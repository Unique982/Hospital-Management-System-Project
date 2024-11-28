<?php include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');
$bed_allocate_id= $_GET['bed_allocate_id'];
$select_query = "SELECT ba.bed_allocate_id,
 b.bed_num AS bed_number,  p.name  AS patient_name, ba.allocated_at,ba.discharge
  FROM bed_allocate ba 
INNER JOIN bed b on ba.bed_id = b.bed_id
INNER JOIN patient p on ba.pateint_id = p.patient_id where bed_allocate_id =$bed_allocate_id";
$result = mysqli_query($conn, $select_query);
if(mysqli_num_rows($result)>0){
    $record = mysqli_fetch_array($result);
?>

<div class="container-fluid">
    <!-- DataTales Example -->
  
                                 
    <div class="card  mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Bed Allocate Information
              <a href="allocate_bed_add.php">  <button type="button"  class="btn btn-primary mr-2" data-toggle="modal" data-target="#exampleModal">
                    Add New Bed Allocate
                </button>
                </a>
            </h6>
        </div>
        <div class="card-body">
       <!-- Php code -->
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <input type="hidden" value="<?php echo $record['bed_allocate_id'] ?>"> 
                   <tr>
                     <th>Bed Number</th>
                    <td><?php echo $record['bed_number'] ?></td>
                   </tr>
                   <tr>
                     <th>Patient Name:</th>
                    <td><?php echo $record['patient_name'] ?></td>
                   </tr>
                   <tr>
                     <th>Allocate At:</th>
                    <td><?php echo $record['allocated_at'] ?></td>
                   </tr><tr>
                     <th>Discharge Date:</th>
                    <td><?php echo $record['discharge'] ?></td>
                   </tr>
                   
                   <td colspan="2">
                   <a href="allocate_bed_list.php"><button class="btn btn-outline-success w-40">Go Back</button></a>
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