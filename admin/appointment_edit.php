<?php
 include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');
if(isset($_POST['update'])){
    $id = mysqli_real_escape_string($conn,$_POST['id']);
   $doctor = mysqli_real_escape_string($conn,$_POST['doctor']);
   $patient = mysqli_real_escape_string($conn,$_POST['patient']);
   $date = mysqli_real_escape_string($conn,$_POST['date']);
   // update query 
   $update_query = "UPDATE appointments SET patient_id = '$patient' , doctor_id = '$doctor', appointment_date = '$date' WHERE id=$id";
  if(mysqli_query($conn,$update_query)){
// success msg
   $_SESSION['alert'] ="Successfully updated appointment";
   $_SESSION['alert_code'] ="success";   
  }
 else{
    $_SESSION['alert'] ="update Failed";
    $_SESSION['alert_code'] ="error"; 
  }
}

?>

<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header">
                    Edit Information
                </div>
                <?php 
                $id = $_GET['id'];
                $select_query = "SELECT * FROM appointments WHERE id='$id'";
                $result = mysqli_query($conn, $select_query) or die("Query Failed");
                if(mysqli_num_rows($result)>0){
                    while($row = mysqli_fetch_assoc($result)){
                
                
                ?>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                        <div class="form-group">
                            <label for="">Doctore Name</label>
                           <select name="doctor" id="" class="form-control">
                           <?php
                $select_doctor_table = "SELECT * FROM user_tbl WHERE role='doctor'";
                $doctor_result = mysqli_query($conn,$select_doctor_table);
                while($doctor_table_data = mysqli_fetch_assoc($doctor_result)){
                   $selected = ($doctor_table_data['id'] == $doctor) ? 'selected':'';
                   echo "<option value='".$doctor_table_data['id']."'$selected>".$doctor_table_data['user_name']."</option>";
                }
                ?>
                           </select>
                        </div>
                       
                        <div class="form-group">
                <label for="">Patient</label>
                <select name="patient" id="patient" class="form-control" required>
                    <?php 
                    $select_query_patient_table = "SELECT * FROM patient";
                    $result = mysqli_query($conn,$select_query_patient_table);
                    while($row1 = mysqli_fetch_assoc($result)){
                        $selected = ($row1['id'] == $patient) ? 'selected':'';
                        echo "<option value='".$row1['patient_id']."'$selected>".$row1['name']."</option>";
                     }
                     ?>
                    
                   
                </select>
            </div>
            <div class="form-group">
                <label for="">Date</label>
                 <input type="date" name="date" class="form-control" value="<?php echo $row['appointment_date']; ?>" required>
            </div>
        </div>
        <div class="modal-footer">
            <a href="appointment_list.php" class="btn btn-danger">Cancel</a>
            
            <button type="submit" name="update" class="btn btn-primary">Update</button>
        </div>
        </form>
        <?php }} ?>
                </div>
            </div>
        </div>
    </div>


    <?php
    include('includes/scripts.php');
    include('includes/footer.php');
    ?>