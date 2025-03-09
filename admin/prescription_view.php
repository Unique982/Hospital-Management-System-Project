<?php 
ob_start();
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');

if(!isset($_SESSION['id'])){
  header('location:index.php');
}

$id= $_GET['id'];
$sql = "SELECT p.id, p.case_history, p.medication, p.medication_form_pharamcist, p.description, p.date, 
    pt.name AS patient, CONCAT(d.first_name,' ',d.last_name)  As doctor ,dr.report_type, dr.document_type, dr.file_name, dr.description
    FROM prescription AS p
    INNER JOIN doctors AS d ON p.doctor_id = d.id
    INNER JOIN patient AS pt ON p.patient_id =pt.id
    INNER JOIN diagnosis_report AS dr ON p.patient_id = dr.patient_id
WHERE p.id= $id";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result)>0){
    $record = mysqli_fetch_array($result);

 ob_end_flush();   
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
</table>
            </div>
                  
     <div class="card mb-4">
        <div class="card-header">
            Diagnosis Report
        </div>
        <div class="table-responsive ">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Report Type</th>
                            <th>Description</th>
                            <th>Document Type</th>
                            <th>Download</th>
                          
                        </tr>
                    </thead>
                    
                        <tbody>
                        <?php
                        $count_id =1; 
                        
                        
                        ?>
                          <tr>
                            <td><?php echo $count_id; ?></td>
                          <td><?php echo $record['report_type'] ?></td>
                          <td><?php echo $record['description'] ?></td>
                          <td><?php echo $record['document_type'] ?></td>
                         <td>
                         <?php if(!empty($record['file_name'])) {
                  // file extcheck 
                  $file_ext = pathinfo($record['file_name'], PATHINFO_EXTENSION);
                  $images_ext = ["jpg", "png", "jpeg"];
                  $exl =["xls","xlsx"];
                  $pdf_ext = ['pdf'];
                   ?>
                   <div class="mt-2">
                    <?php if(in_array($file_ext,$images_ext)){?>
                      <div style="position:relative">
                      <img src="<?php echo $record['file_name']; ?>" alt="Upload Doc" class="img-fluid mt-2" style="max-width: 300px;filter:blur(5px);">
                      <a href="<?php echo (!empty($record['file_name'])? $record['file_name']:'selected'); ?>" class="btn btn-primary" download style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);z-index:10"> <i class="fa fa-download" aria-hidden="true"></i>Download</a>
                    </div> 


                        <?php  } elseif(in_array($file_ext,$pdf_ext)) { ?>
                          
                    <embed src="<?php echo $record['file_name']; ?>" type="application/pdf" width="800px" height="500px" style="filter:blur(5px);" download >
                    

                 <?php } elseif(in_array($file_ext,$exl)){ ?>
                    <a href="<?php echo $record['file_name']; ?>" class="btn btbn-primary" download> <i class="fa fa-download" aria-hidden="true">Download</i></a>
                <?php } else { ?>
                <a href="<?php echo ($record['file_name']=='other')? 'selected' : $record['file_name']; ?>" class="btn btbn-primary" download> <i class="fa fa-download" aria-hidden="true"></i>Download</a>

                <?php 
                } ?>
                </div>
                   <?php }  ?>   
                   
                   </td>
                          </tr>
                        </tbody>
                   
                </table>
            </div>
    </div>

                  
                   <td colspan="2">
                   <a href="manage_prescription.php"><button class="btn btn-outline-success w-40">Go Back</button></a>
</td>
                      

                   
            </div>
        </div>
        </div>
        <?php 
}
                        ?>
        

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>