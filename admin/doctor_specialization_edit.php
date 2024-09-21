<?php include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');
if(isset($_POST['update'])){
    $id =mysqli_real_escape_string($conn, $_POST['id']);
    $specialization = mysqli_real_escape_string($conn,$_POST['specialization']);
    $update_query= "UPDATE specialization SET specialization = '$specialization' WHERE id = '$id'";
    if(mysqli_query($conn,$update_query)){
        echo "<div class='alert alert-primary' role='alert'>Update Successfully</div>";
    }
    else{
        echo "<div class='alert alert-danger' role='alert'>Update failed</div>";
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
            
                       $id=$_GET['id'];
                $select_query = "SELECT * FROM `specialization` WHERE id ='$id'";
                $result = mysqli_query($conn, $select_query) or die("Query Failed");
                
                if(mysqli_num_rows($result) >0){
                    while($row = mysqli_fetch_assoc($result)){
                    
                 ?>
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                <div class="form-group">
                    <label for="">Specialization</label>
                    <input type="text" name="specialization" value="<?php echo $row['specialization'] ?>" class="form-control" placeholder="Enter Specialization">
                   
                </div>
                <div class="form-group">
                <a href="doctor_specialization.php" class="btn btn-danger">Cancel</a>
                    <button class="btn btn-primary" type="submit" name="update">Update</button>
                   
                    
                </div>
                </form>
                <?php }
                
                }else{
                    echo '<div class="alert alert-danger">Not Fonnd</div>';
                }
                
     
           ?>
            </div>
            </div>
        </div>
    </div>




<?php
include('includes/scripts.php');
include('includes/footer.php');
?>