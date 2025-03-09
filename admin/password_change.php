
<?php
ob_start();
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');

if(!isset($_SESSION['id'])){
    header('location:index.php');
}

$user_id = $_SESSION['id'];
$user_type = $_SESSION['user_data']['role'];
$errors=[
    'current_password'=>'',
    'new_password' =>'',
    'confirm_password'=>''
];
if(isset($_POST['change'])){
    $current_password = mysqli_real_escape_string($conn,$_POST['current_password']);
    $new_password= mysqli_real_escape_string($conn,$_POST['new_password']);
    $confirm_password = mysqli_real_escape_string($conn,$_POST['confirm_password']);
    $user_id = $_SESSION['id'];
// fetch current passsword
$fetch_password = "SELECT password FROM user_tbl WHERE id ='$user_id'";
$result = mysqli_query($conn,$fetch_password) or die('query failed');
if(mysqli_num_rows($result)>0){
    $row=mysqli_fetch_assoc($result);
    $st_password = $row['password'];// fetch and store password
}
if(!password_verify($current_password,$st_password)){
    $errors['current_password']="current password is incorrect!.";
}elseif(empty($new_password)){
    $errors['new_password'] = "new password is requried";
}elseif($new_password!==$confirm_password){
    $errors['confirm_password'] ='New password amd confirm password do not match!';
}
elseif (strlen($_POST['new_password']) < 8) {
    $errors['new_password'] = "Password must be at least 8 characters long.";
}
else{
    $hased_password = password_hash($new_password,PASSWORD_BCRYPT);
    $update_query = "UPDATE user_tbl SET password ='$hased_password' WHERE id='$user_id'";
    if(mysqli_query($conn,$update_query)){
        $_SESSION['alert'] = "Password change Successfully.";
        $_SESSION['alert_code'] = "success";
    }
    else{
        $_SESSION['alert'] = 'falied';
        $_SESSION['alert_code'] = 'error';
    }
}

}
ob_end_flush();
?>
<div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header">
                        Profile
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="">Current Password</label>
                                <input type="text" name="current_password"  class="form-control" value="<?php echo isset($current_password) ? $current_password:'' ;?>">
                                <span style='color:red' ;><?php echo $errors['current_password'] ?></span>
                            </div>
                            <div class="form-group">
                                <label for="">New Password</label>
                                <input type="text" name="new_password" class="form-control" value="<?php echo isset($new_password) ? $new_password:'' ?>">
                                <span style='color:red' ;><?php echo $errors['new_password'] ?></span>
                            </div>
                            <div class="form-group">
                                <label for="">Confim Password</label>
                                <input type="text" name="confirm_password" class="form-control" value="<?php echo isset($confirm_password) ? $confirm_password:'' ?>">
                                <span style='color:red' ;><?php echo $errors['confirm_password'] ?></span>
                            </div>
                           
                            <div class="form-group">
                                <button type="submit" name="change" class="btn btn-primary">Save Change</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
      
    <?php
    include('includes/scripts.php');
    include('includes/footer.php');
    ?>