<?php
require_once("includes/header.php");
require_once("includes/navbar.php");
include('../database/config.php');
if (isset($_POST['Update'])) {
    $rep_id= mysqli_real_escape_string($conn, $_POST['rep_id']);
    $report_type = mysqli_real_escape_string($conn,$_POST['report_type']);
    $description = mysqli_real_escape_string($conn,$_POST['description']);
    $date = mysqli_real_escape_string($conn,$_POST['date']);
    $doctor = mysqli_real_escape_string($conn,$_POST['doctor']);
    $patient = mysqli_real_escape_string($conn,$_POST['patient']);

    $update_query ="UPDATE report SET report_type ='$report_type',description = '$description',date='$date',
    doctor_id ='$doctor', patient_id = '$patient' WHERE rep_id = '$rep_id'";
    if(mysqli_query($conn,$update_query)){
        $_SESSION['alert'] ="Updated Successfully";
        $_SESSION['alert_code'] ="success";
    }
    else{
        $_SESSION['alert'] ="failed";
        $_SESSION['alert_code'] ="warning";
    }
}
?>
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header">
                    Add Report
                </div>
                <?php
                 $rep_id = $_GET['rep_id'];
                 $select_query = "SELECT * FROM report WHERE rep_id = '$rep_id'";
                 $result = mysqli_query($conn,$select_query) or die("Query failed");
                    if(mysqli_num_rows($result)){
                        while($data = mysqli_fetch_assoc($result)){
                
                ?>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="rep_id" value="<?php echo $data['rep_id'] ?>">
                        <div class="form-group">
                            <label for="">Report Type</label>
                            <select name="report_type" id="" class="form-control">
                             <?php
                $report_select = "SELECT * FROM report";
                $report_result  = mysqli_query($conn,$report_select);
                while($report= mysqli_fetch_assoc($report_result)){
                  if($report['rep_id']==$data['report_type']){
                    $selected = 'selected';
                  }
                  else{
                    $selected = '';

                  }
                    echo "<option value='".$report['rep_id']."'$selected>".$report['report_type']."</option>";
                }
                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea name="description" id="" class="form-control"><?php echo $data['description'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Date</label>
                            <input type="date" name="date" value="<?php echo date('Y-m-d', strtotime($data['date'])); ?>" class="form-control">

                        </div>
                        <div class="form-group">
                            <label for="">Doctor</label>
                           <select name="doctor" id="" class="form-control">
                            <?php
                $select_doctor_table = "SELECT * FROM user_tbl WHERE role='doctor'";
                $doctor_result = mysqli_query($conn,$select_doctor_table);
                while($doctor_table_data = mysqli_fetch_assoc($doctor_result)){
                  if($doctor_table_data['id']==$data['rep_id']){
                    $selected = 'selected';
                  }
                  else{
                    $selected = '';

                  }
                    echo "<option value='".$doctor_table_data['id']."'$selected>".$doctor_table_data['user_name']."</option>";
                }
                ?>
                 </select>
                        </div>
                        <div class="form-group">
                            <label for="">Patient</label>
                            <select name="patient" id="" class="form-control">
                                <?php 
                    $select_query_patient_table = "SELECT * FROM patient";
                    $result = mysqli_query($conn,$select_query_patient_table);
                    while($row = mysqli_fetch_assoc($result)){
                        if($row['patient_id']==$data['patient_id']){
                            $selected = 'selected';
                          }
                          else{
                            $selected = '';
        
                          }
                        echo "<option value='".$row['patient_id']."'$selected>".$row['name']."</option>";
                    
            }
                  ?>
                </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="Update" class="btn btn-outline-primary">Update</button>
                        </div>
                    </form>
                    <?php
                      }
                      
                    } ?>
                </div>
            </div>
        </div>
    </div>
    <?php
    include('includes/scripts.php');
    include('includes/footer.php');
    ?>