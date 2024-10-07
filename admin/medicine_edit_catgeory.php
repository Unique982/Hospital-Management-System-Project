<?php
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $med_name = mysqli_real_escape_string($conn,$_POST['med_name']);
    $med_des = mysqli_real_escape_string($conn,$_POST['med_des']);
    
    $update_query = "UPDATE medicine_cat SET medicine_name = '$med_name', medicine_description = '$med_des' WHERE id = $id";
     if(mysqli_query($conn, $update_query)){
        $_SESSION['alert'] ="update successfully";
        $_SESSION['alert_code'] ="success";
    
     }
     else{
        $_SESSION['alert'] ="Update failed";
        $_SESSION['alert_code'] ="warning";
     }
}
?>
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header">
                    Edit Doctor Details
                </div>
                <?php 
                 $id = $_GET['id'];
                 $select_query = "SELECT * FROM medicine_cat where id = $id";
                 $result = mysqli_query($conn, $select_query) or die("Query failed");
                //  echo "<pre>";
                //  print_r($result);
                if(mysqli_num_rows($result)>0){
                    while($record = mysqli_fetch_assoc($result)){ 
                ?>

                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $record['id'] ?>">
                        <div class="form-group">
                            <label for=""> Medicine Name</label>
                          <input type="text" name="med_name" value="<?php echo $record['medicine_name'] ?>" class="form-control" placeholder="Enter MedicineName">
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
<textarea name="med_des" id="med_des" class="form-control"><?php echo $record['medicine_description'] ?></textarea>
                        </div>

                        <div class="modal-footer">
                            
                        <a href="medicine_list_catgeory.php" class="btn btn-danger">Cancel</a>
                            <button type="submit" name="update" class="btn btn-primary">Update</button>
                        </div>

                    </form>
                    <?php      }
                } ?>

                </div>
            </div>
        </div>
    </div>


    <?php
    include('includes/scripts.php');
    include('includes/footer.php');
    ?>