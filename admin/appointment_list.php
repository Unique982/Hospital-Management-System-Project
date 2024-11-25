<?php
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');
if(isset($_POST['add'])){
    $doctor = mysqli_real_escape_string($conn,$_POST['doctor']);
    $patient = mysqli_real_escape_string($conn,$_POST['patient']);
    $date = mysqli_real_escape_string($conn,$_POST['date']);
    
    $insert_query = "INSERT INTO `appointments`(`patient_id`, `doctor_id`, `appointment_date`, `created_at`)
     VALUES('$patient','$doctor','$date',Now())";
     if(mysqli_query($conn,$insert_query)){
        echo '<div class="alert alert-success role="alert">Appointment Add Sucessful?</div>';
     }
     else{
     echo '<div class="alert alert-success role="alert"> Appointment failed.<div>';
     }

}
?>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Appointment</h5>
            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="" method="POST" class="needs-validation" novalidate>
        <div class="modal-body">
            <div class="form-group">
                <label for="">Doctor</label>
                <select name="doctor" id="doctor" class="form-control" required>
                <option selected disabled> Select One</option>
                <?php
                $select_doctor_table = "SELECT * FROM user_tbl WHERE role='doctor'";
                $doctor_result = mysqli_query($conn,$select_doctor_table);
                while($doctor_table_data = mysqli_fetch_assoc($doctor_result)){
                  
                    echo "<option value='".$doctor_table_data['id']."'>".$doctor_table_data['user_name']."</option>";
                }
                ?>
                 </select>
              
            </div>
            <div class="form-group">
                <label for="">Patient</label>
                <select name="patient" id="patient" class="form-control" required>
      <option selected disabled> Select One</option>
                    <?php 
                    $select_query_patient_table = "SELECT * FROM patient";
                    $result = mysqli_query($conn,$select_query_patient_table);
                    while($row = mysqli_fetch_assoc($result)){
                    
                        echo "<option value='".$row['patient_id']."'>".$row['name']."</option>";
                    
            }
                  ?>
                </select>
              
            </div>
            <div class="form-group">
                <label for="">Date</label>
                <input type="date" name="date" class="form-control" required>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="add" class="btn btn-primary">Add</button>
        </div>
        </form>
    </div>
</div>
</div>

<div class="container-fluid">
<div class="card mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Appointment List
            <button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#exampleModal">
                Add Appointment
            </button>
        </h6>
        <!-- fetch Data  -->
         <?php 
         $appoinment_data = "SELECT appointments.id, patient.name AS patient_name,user_tbl.user_name AS
          doctor_name, appointments.appointment_date, appointments.created_at
         FROM appointments
         INNER JOIN patient ON appointments.patient_id= patient.patient_id
         INNER JOIN user_tbl ON appointments.doctor_id = user_tbl.id
        ORDER BY appointments.id ASC
         ";
         $app_result = mysqli_query($conn,$appoinment_data); 
         ?>

    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Patient Name</th>
                        <th>Doctor</th>
                        <th>Appointment Date</th>
                        <th>Created_at</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sn =+1;
                    if(mysqli_num_rows($app_result)>0){
                        while($app = mysqli_fetch_assoc($app_result)){
                    
                    ?>
                    <tr>
                        <td><?php echo $sn ?></td>
                        <td><?php echo $app['patient_name'] ?></td>
                        <td><?php echo $app['doctor_name'] ?></td>
                        <td><?php echo date("Y M d ", strtotime( $app['appointment_date'] )) ?></td>
                        <td><?php echo date("Y M d ", strtotime( $app['created_at'] ))?></td>
                        <td>
                            <a href=""><button type="button" class="btn btn-outline-warning btn-sm">View</button></a>
                            <a href="appointment_edit.php?id=<?php echo $app['id'];?>" class="btn btn-outline-success btn-sm">Edit</a>
                            
                            <form action="appointment_delete.php" method="POST" id="deleteForm" style="display:inline-block; margin:2px;">
                                <input type="hidden" name="id" value="<?php echo $app['id'] ?>" class="delete_id">
                                <button type="submit" name="delete" class="btn btn-outline-danger btn-sm deletebtn" data-delete-url="appointment_delete.php">Delete</button>
                            </form> 
                        </td>
                    </tr>
                    <?php 
                     $sn++;
                        }}
                        else{
                            echo "Not Found";
                        }
                ?>
                </tbody>
                
            </table>
        </div>
    </div>
</div>
</div>

<script>
function confirmDelete() {
    return confirm("Are you sure you want to delete this appointment?");
}
</script>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
