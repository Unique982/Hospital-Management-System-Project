<?php
ob_start();
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');

$user_type = $_SESSION['user_data']['role'];
$user_id = $_SESSION['id'];

if ($user_type == 'admin' || $user_type='pharmacist') {
    $select_query = "SELECT p.id, p.case_history,p.medication,p.medication_form_pharamcist,p.description,
     p.date,CONCAT(d.first_name,'',d.last_name)  As doctor, pt.name AS patient FROM prescription as p
     LEFT JOIN doctors as d ON p.doctor_id = d.id
     LEFT JOIN patient as pt ON p.patient_id = pt.id         
    ORDER BY p.id DESC";
}
// doctor 
else if ($user_type == 'doctor') {
    $select_query = "SELECT p.id, p.case_history,p.medication,p.medication_form_pharamcist,p.description,
     p.date,CONCAT(d.first_name,'',d.last_name)  As doctor, pt.name AS patient FROM prescription as p
     LEFT JOIN doctors as d ON p.doctor_id = d.id
     LEFT JOIN patient as pt ON p.patient_id = pt.id         
    WHERE d.user_id =$user_id ORDER BY p.id DESC";
} elseif ($user_type == 'patient') {
    $select_query = "SELECT p.id, p.patient_id, p.case_history, p.medication, p.medication_form_pharamcist, p.description,p.date
    , CONCAT(d.first_name,'',d.last_name)  As doctor, pt.name AS patient FROM prescription as p
    LEFT JOIN doctors as d ON p.doctor_id = d.id
    LEFT JOIN patient as pt ON p.patient_id = pt.id         
    WHERE pt.user_id =$user_id ORDER BY p.id DESC";
}

$result = mysqli_query($conn, $select_query) or die('error');
$count_row = mysqli_num_rows($result);

ob_end_flush(); ?>
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card  mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Manage Prescription
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
                            <th>Date</th>
                                <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            $sn = 1;
                            if ($count_row > 0) {

                                while ($record = mysqli_fetch_assoc($result)) {


                            ?>
                                    <td><?php echo $sn; ?></td>
                                    <td><?php echo $record['patient'] ?></td>
                                    <td><?php echo $record['doctor']  ?></td>

                                    <td><?php echo $record['date'] ?> </td>
                                        <td><a href="prescription_view.php?id=<?php echo $record['id'] ?>"><button type="button" class="btn btn-outline-warning btn-sm">View</button></a>
                                        <a href="prescription_edit.php?id=<?php echo $record['id'] ?>"><button type="button" class="btn btn-outline-warning btn-sm">Add Diagnosis Report</button></a>  
                                        <a href="prescription_edit.php?id=<?php echo $record['id'] ?>" class="btn btn-outline-success btn-sm">Edit</a>
                                       
                                        <form action="prescription_delete.php" method="POST" id="deleteForm" style="display:inline-block; margin:2px;">
                                                <input type="hidden" name="id" value="<?php echo $record['id'] ?>" class="delete_id">
                                                <button type="submit" name="delete" class="btn btn-outline-danger btn-sm deletebtn" data-delete-url="prescription_delete.php">Delete</button>
                                            </form>
                                      
                                 
                                        </td>
                        </tr>
                <?php

                                    $sn++;
                                }
                            }else {
                                echo "<tr><td colspan='6' class='text-center'>Not Found Data</td></td>";
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