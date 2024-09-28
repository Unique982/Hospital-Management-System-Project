<?php
include("./includes/header.php");
include("./includes/navbar.php");
include('../database/config.php');
if(isset($_POST['save'])){
    $id = mysqli_real_escape_string($conn,$_POST['id']);
    $sm_name = mysqli_real_escape_string($conn,$_POST['sm_name']);
    $sm_title = mysqli_real_escape_string($conn,$_POST['sm_title']);
    $sm_email = mysqli_real_escape_string($conn,$_POST['sm_email']);
    $sm_address = mysqli_real_escape_string($conn,$_POST['sm_address']);
    $sm_number = mysqli_real_escape_string($conn,$_POST['sm_number']);
    $footer = mysqli_real_escape_string($conn,$_POST['footer']);
 $update_query = "UPDATE setting SET website_name = '$sm_name', website_address='$sm_address', 
 website_email = '$sm_email', website_phone = '$sm_number', website_title = '$sm_title',
  footer = '$footer' WHERE id=$id";
if(mysqli_query($conn,$update_query)){
    echo "<div class='alert alert-alert role='alert'>Update Successfullt?</div>";
}
else{
    echo "<div class='alert alert-alert role='alert'>Failed Update</div>";
}
}
?>
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header">
                    Add Setting
                </div>
                <?php 
             
                $select_query = "SELECT * FROM setting ";
                $result = mysqli_query($conn,$select_query) or die("Error Query");
                if(mysqli_num_rows($result)>0){
                    while($record = mysqli_fetch_assoc($result)){ 
                ?>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $record['id'] ?>">  
                    <div class="form-group">
                            <label for="">System Name</label>
                            <input type="text" name="sm_name" value="<?php echo $record['website_name'] ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">System Title</label>
                           <input type="text" name="sm_title" value="<?php echo $record['website_title'] ?>"  class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                           <input type="email" name="sm_email" value="<?php echo $record['website_email'] ?>"  class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Address</label>
                           <input type="text" name="sm_address" value="<?php echo $record['website_address'] ?>"  class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Phone Number</label>
                           <input type="number" name="sm_number" value="<?php echo $record['website_phone'] ?>"  class="form-control">
                        </div>
                       
                        <div class="form-group">
                            <label for="">Footer</label>
                            <textarea name="footer" class="form-control"  id=""><?php echo $record['footer'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="save" class="btn btn-outline-primary">Save Setting</button>
                        </div>
                    </form>
                    <?php
                    }}
                    
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php
    include('./includes/scripts.php');
    include('./includes/footer.php');
    ?>