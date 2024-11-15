<?php include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');

if(isset($_POST['update'])){
    $id = mysqli_real_escape_string($conn,$_POST['id']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $tel_number = mysqli_real_escape_string($conn, $_POST['tel_number']);

    // update sql query
    $update_query = "UPDATE contact_page SET email = '$email', address='$address', phone_num='$phone', tel_number ='$tel_number' WHERE id='$id'";
    if(mysqli_query($conn,$update_query)){

        $_SESSION['alert'] ="Update Successfully ";
        $_SESSION['alert_code'] ="success";
    }
    else{
        $_SESSION['alert'] ="Failed Update";
        $_SESSION['alert_code'] ="error";
    
    }
    }
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header">
                Contact Page
                </div>
                <?php 
                 $select_query = "SELECT * FROM contact_page";
                 $result = mysqli_query($conn, $select_query) or die("query failed");
                 if(mysqli_num_rows($result)){
                    while($row = mysqli_fetch_assoc($result)){
                
                ?>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" name="email" value="<?php echo $row['email'] ?>" class="form-control" placeholder="Enter Email">
                        </div>
                        <div class="form-group">
                            <label for="">Address</label>
                         <input type="text" name="address" class="form-control" value="<?php echo $row['address'] ?>" placeholder="Enter Address">
                        </div>
                        <div class="form-group">
                            <label for="">Phone Number</label>
                         <input type="number" name="phone" class="form-control" value="<?php echo $row['phone_num'] ?>" placeholder="Enter Phone Number">
                        </div>
                        <div class="form-group">
                            <label for="">Tel Phone</label>
                         <input type="number" name="tel_number" class="form-control" value="<?php echo $row['tel_number'] ?>" placeholder="Enter Phone Number">
                        </div>
                        
                        <div class="form-group">
                        <button type="submit" name="update" class="btn btn-outline-primary" >Save</button>
                      
                        </div>

                    </form>
                    <?php
                     }
                
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