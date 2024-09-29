<div class="modal fade"  aria-hid="editModal" tabindex="-2" role="dialog" aria-labelledby="editModalLabelidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel">Edit Appointment</h5>
            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <?php 
                $id = $_GET['id'];
                $select_query = "SELECT * FROM appointment WHERE id = '$id'";
                $edit_result = mysqli_query($conn, $select_query);
                if(mysqli_num_rows($edit_result)>0)
                {
                    while($row = mysqli_fetch_assoc($edit_result))
{                
                ?>
        </div>
        <form action="" method="POST" class="needs-validation" novalidate>
            <input type="hidden" name="<?php  echo $row['id']?>">
        <div class="modal-body">
            <div class="form-group">
                <label for="">Doctor</label>
                <select name="doctor" id="doctor" class="form-control" required>
                <?php
                $select_doctor_table = "SELECT * FROM user_tbl WHERE role='doctor'";
                $doctor_result = mysqli_query($conn,$select_doctor_table);
                while($doctor_table_data = mysqli_fetch_assoc($doctor_result)){
                    echo"<option selected disabled> Select One</option>";
                    echo "<option value='".$doctor_table_data['id']."'>".$doctor_table_data['user_name']."</option>";
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
                    while($row = mysqli_fetch_assoc($result)){
                     echo"   <option selected disabled> Select One</option>";
                        echo "<option value='".$row['patient_id']."'>".$row['name']."</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="">Date</label>
                <input type="date" name="date" value="<?php echo $row['appointment_date'] ?>" class="form-control" required>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="add" class="btn btn-primary">Update</button>
        </div>
        </form>
                <?php }} ?>
    </div>
</div>
</div>