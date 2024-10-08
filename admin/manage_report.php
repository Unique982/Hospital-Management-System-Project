<?php 
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');
$select_query = "SELECT r.rep_id, p.name AS patient,d.user_name As doctor, r.report_type,r.date
FROM report AS r
INNER JOIN patient AS p ON r.patient_id =p.patient_id
INNER JOIN user_tbl AS d ON r.doctor_id = d.id
";
$result = mysqli_query($conn,$select_query);
$count = mysqli_num_rows($result);
if($count){



?>
<div class="container-fluid">
    <!-- DataTales Example -->          
    <div class="card  mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Manage Report
              <a href="manage_operation.php"><button type="button"  class="btn">
              <i class="fa-solid fa-bars"></i> Operation 
                </button>
                </a>
                <a href="manage_birth_report.php">  <button type="button"  class="btn">
              <i class="fa-solid fa-bars"></i> Birth
                </button>
                </a>
                <a href="manage_death_report.php"> <button type="button"  class="btn mr-2">
              <i class="fa-solid fa-bars"></i> Death
                </button>
                </a>
                <a href="report_add.php"> <button type="button"  class="btn btn-primary mr-2">
               Add Report
                </button>
                </a>
            </h6>
        </div>
        <div class="card-body">
       <!-- Php code -->
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Pateint Name</th>
                            <th>Doctor Name</th>
                            <th>Report Type</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php 
                            $sn = +1;
                            while($record = mysqli_fetch_assoc($result)){
                                if($record['report_type']=='other'){

                           
                           ?>
                           <td><?php echo $sn; ?></td>
                           <td><?php echo $record['patient'] ?></td>
                           <td><?php echo $record['doctor']  ?></td>
                           <td><?php echo $record['report_type']?> </td>
                           <td><?php echo $record['date']?> </td>
                           
                            <td><a href=""><button type="button" class="btn btn-outline-warning mr-2">View</button></a>
                          <a href="" class="btn btn-outline-success mr-2">Edit</a>     
                          <form action="" method="POST" id="deleteForm" style="display:inline-block; margin:2px;">
                              <input type="hidden" name="" value="">
                              <button type="submit" name="delete" class="btn btn-outline-danger" onclick="confirmDetele()">Delete</button>
                              </form> 

                            </td>
                        </tr>
                        <?php 
                        
                                }$sn++;
                            }
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