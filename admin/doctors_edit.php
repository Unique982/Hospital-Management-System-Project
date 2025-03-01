<?php
ob_start();
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');


$errors =[
    'first_name' =>'',
    'last_name' =>'',
    'username' =>'',
'specialization' => '',
    'email' =>'',
    'phone' =>'',
    'address' =>''
];
if (isset($_POST['update'])) {
    $id= $_POST['id'];
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $specialization = mysqli_real_escape_string($conn, $_POST['specialization']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    
    if(empty($username)){
        $errors['username'] ='Username is required';
       }
       elseif(!preg_match('/^[a-zA-Z\s]+$/',$username)){
  $errors['username'] ='only use letter and space allowed';
       }
       if(empty($first_name)){
        $errors['first_name'] ='First Name is required';
       }
       elseif(!preg_match('/^[a-zA-Z\s]+$/',$first_name)){
  $errors['first_name'] ='only use letter and space allowed';
       }
       if(empty($last_name)){
        $errors['last_name'] ='Last name is required';
       }
       elseif(!preg_match('/^[a-zA-Z\s]+$/',$last_name)){
  $errors['last_name'] ='only use letter and space allowed';
       }

       // validation email 
       if(empty($email)){
        $errors['email'] ='Email is required';
       }
       elseif(!preg_match('/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/',$email)){
        $errors['email'] ='Invalid Email';
       }
       // phone number
       if(empty($phone)){
        $errors['phone'] ='Phone number is required';
       }
       elseif(!preg_match('/^\d{10}$/',$phone)){
        $errors['phone'] ='Please enter a valid phone number';
       }
       
       //address 
       if(empty($address)){
        $errors['address'] ='Address is required';
       }
       elseif(!preg_match('/^[a-zA-Z]+$/',$address)){
        $errors['address'] ='Please enter a valid address';
       }

       if (empty($specialization) || $specialization === 'Select Specialization') {
        $errors['specialization'] = 'Specialization is required';
    }
     // role

       if (empty(array_filter($errors))) {   
 $user_tbl_update = "UPDATE user_tbl SET user_name='$username', user_email='$email' WHERE id=$id ";
if(mysqli_query($conn,$user_tbl_update)){
    $doctor_update = "UPDATE doctors SET first_name = '$first_name',last_name='$last_name', specialization='$specialization',phone='$phone',address='$address' WHERE user_id= $id";
     if(mysqli_query($conn, $doctor_update)){
        $_SESSION['alert'] ="update successfully";
        $_SESSION['alert_code'] ="success";
        header('location:manage_doctor.php');
        exit();
     }else{
        $_SESSION['alert'] ="Update failed";
        $_SESSION['alert_code'] ="warning";
     }
}
}}
ob_end_flush();
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
                 $select_query = "SELECT doctors.id as doctors_id, doctors.first_name, doctors.last_name,
doctors.phone,doctors.address, doctors.created_at, user_tbl.user_name as username, user_tbl.user_email,user_tbl.role, user_tbl.id 
,specialization.specialization  FROM `doctors` 
INNER JOIN `user_tbl` ON doctors.user_id = user_tbl.id
INNER JOIN `specialization` ON doctors.specialization = specialization.id WHERE user_id = $id";
                 $result = mysqli_query($conn, $select_query) or die("Query failed");
                if(mysqli_num_rows($result)>0){
                    while($row = mysqli_fetch_assoc($result)){ 
                ?>

                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                        <div class="form-group">
                    <label for="">User Name</label>
                    <input type="text" name="username" class="form-control" placeholder="Enter username"  value="<?php echo $row['username'] ?>">
                    <span style='color:red' ;><?php echo $errors['username'] ?></span>
                </div>
                <div class="form-group">
                    <label for="">First Name</label>
                    <input type="text" name="first_name" class="form-control" placeholder="Enter firstname"  value="<?php echo $row['first_name'] ?>">
                    <span style='color:red' ;><?php echo $errors['first_name'] ?></span>
                </div>
                <div class="form-group">
                    <label for="">Last Name</label>
                    <input type="text" name="last_name" class="form-control" placeholder="Enter lastname" value="<?php echo $row['last_name'] ?>">
                    <span style='color:red' ;><?php echo $errors['last_name'] ?></span>
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter email"  value="<?php echo $row['user_email'] ?>" >
                    <span style='color:red' ;><?php echo $errors['email'] ?></span>
                </div>
                <div class="form-group">
                    <label for="">Phone No</label>
                    <input type="number" name="phone" class="form-control" placeholder="Enter Phone" value="<?php echo $row['phone'] ?>">
                    <span style='color:red' ;><?php echo $errors['phone'] ?></span>
                </div>
                <div class="form-group">
                    <label for="">Address</label>
                    <input type="address" name="address" class="form-control" placeholder="Enter Address"  value="<?php echo $row['address'] ?>">
                    <span style='color:red' ;><?php echo $errors['address'] ?></span>
                </div>
               

                <div class="form-group">
                                    <label for="">Specialization</label>
                                    <select name="specialization" id="" class="form-control">
                                        <?php
                                        $select_query_table = "SELECT * FROM specialization";
                                        $result = mysqli_query($conn, $select_query_table);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            if ($row['id'] == $data['id']) {
                                                $selected = 'selected';
                                            } else {
                                                $selected = '';
                                            }
                                            echo "<option value='" . $row['id'] . "'$selected>" . $row['specialization'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                    <span style='color:red' ;><?php echo $errors['specialization'] ?></span>
                                </div>
                      
                <div class="modal-footer">
                            
                            <a href="manage_doctors.php" class="btn btn-danger">Cancel</a>
                                <button type="submit" name="update" class="btn btn-primary">Update</button>
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