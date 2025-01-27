<?php include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');
$id= $_GET['id'];
$sql = "SELECT p.id, p.case_history, p.medication, p.medication_form_pharamcist, p.description, p.date, 
    pt.name AS patient, CONCAT(d.first_name,' ',d.last_name)  As doctor
    FROM prescription AS p
    INNER JOIN doctors AS d ON p.doctor_id = d.id
    INNER JOIN patient AS pt ON p.patient_id =pt.id
WHERE p.id= $id";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result)>0){
    $record = mysqli_fetch_array($result);
?>

<div class="container-fluid">
    <!-- DataTales Example -->
  
                                 
    <div class="card  mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Prescription
              <a href="prescription_add.php"><button type="button"  class="btn btn-primary mr-2" data-toggle="modal" data-target="#exampleModal">
                Add Prescription
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
                     <th>Doctor Name:</th>
                    <td><?php echo $record['doctor'] ?></td>
                   </tr>
                   <tr>
                     <th>Patient Name:</th>
                    <td><?php echo $record['patient'] ?></td>
                   </tr>
                   <tr>
                     <th>Case History:</th>
                    <td><?php echo $record['case_history'] ?></td>
                   </tr>
                   <tr>
                     <th>Medication:</th>
                    <td><?php echo $record['medication'] ?></td>
                   </tr>
                   <tr>
                     <th>Medication Form Pharamcist:</th>
                    <td><?php echo $record['medication_form_pharamcist'] ?></td>
                   </tr>
                   <tr>
                     <th>Description:</th>
                    <td><?php echo $record['description'] ?></td>
                   </tr>
                   <tr>
                     <th>Date:</th>
                    <td><?php echo $record['date'] ?></td>
                   </tr>
                  
                   <td colspan="2">
                   <a href="manage_prescription.php"><button class="btn btn-outline-success w-40">Go Back</button></a>
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