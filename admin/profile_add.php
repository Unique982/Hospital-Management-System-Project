<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');
$user_id = $_SESSION['id'];
$user_type = $_SESSION['user_data']['role'];

if (isset($_POST['update'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);


    $user_tbl_update = "UPDATE user_tbl SET user_name='$name', user_email='$email' WHERE id= $user_id";
    if (mysqli_query($conn, $user_tbl_update)) {
        // user role admin
        if ($user_type === 'admin') {
            $update_query = "UPDATE profile SET phone='$phone',address='$address' WHERE user_id=  $user_id";
        }
        // user role doctor
        elseif ($user_type === 'doctor') {
            $update_query = "UPDATE doctors SET phone='$phone',address='$address' WHERE user_id=  $user_id";
        }
        // user role is pateint
        elseif ($user_type === 'patient') {
            $update_query = "UPDATE patient SET phone='$phone',address='$address' WHERE user_id=  $user_id";
        }
        // user role is accountant
        elseif ($user_type === 'accountant') {
            $update_query = "UPDATE accountant SET phone='$phone',address='$address' WHERE user_id= $user_id";
        }
        // user role pharmacist
        elseif ($user_type === 'pharmacist') {
            $update_query = "UPDATE pharmacist SET phone='$phone',address='$address' WHERE user_id=  $user_id";
        }
        // user role laboratorist
        elseif ($user_type === 'laboratorist') {
            $update_query = "UPDATE laboratorists SET phone='$phone',address='$address' WHERE user_id=  $user_id";
        }
        // user role nurse
        elseif ($user_type === 'nurse') {
            $update = "UPDATE nurse SET phone='$phone',address='$address' WHERE user_id=  $user_id";
        }
        if (mysqli_query($conn, $update_query)) {
            $_SESSION['alert'] = "Update Successfully ";
            $_SESSION['alert_code'] = "success";
        } else {
            $_SESSION['alert'] = "Failed Update";
            $_SESSION['alert_code'] = "error";
        }
    }
}

$select_query="";
if ($user_type === 'admin') {
    $select_query = "SELECT pr.user_id,pr.phone,pr.address, user_tbl.user_name as username,user_tbl.user_email FROM profile as pr
             INNER JOIN user_tbl ON pr.user_id= user_tbl.id
             WHERE pr.user_id=$user_id";
} elseif ($user_type === 'doctor') {
    $select_query = "SELECT doctors.id ,doctors.phone,doctors.address, 
                     user_tbl.user_name as username, user_tbl.user_email   FROM `doctors` 
                    INNER JOIN `user_tbl` ON doctors.user_id = user_tbl.id
                    WHERE doctors.user_id=$user_id";
} elseif ($user_type === 'pharmacist') {
    $select_query = "SELECT  pharmacist.phone, pharmacist.address, user_tbl.user_name as username, user_tbl.user_email
                    FROM `pharmacist` 
                    INNER JOIN `user_tbl` ON pharmacist.user_id = user_tbl.id
                     WHERE pharmacist.user_id=$user_id";
} elseif ($user_type === 'accountant') {
    $select_query = "SELECT a.id, a.phone, a.address, user_tbl.user_name as username, user_tbl.user_email
                       FROM accountant as a 
                    INNER JOIN `user_tbl` ON a.user_id = user_tbl.id
                      WHERE a.user_id=$user_id";
} elseif ($user_type === 'laboratorist') {
    $select_query = "SELECT l.id, l.phone,l.address,
                     user_tbl.user_name as username,user_tbl.user_email
                     FROM laboratorists as l
                   INNER JOIN user_tbl ON l.user_id = user_tbl.id 
                    WHERE l.user_id=$user_id";
} elseif ($user_type === 'nurse') {
    $select_query = "SELECT nurse.phone, nurse.address, user_tbl.user_name as username, user_tbl.user_email
                      FROM `nurse` 
                   LEFT JOIN `user_tbl` ON nurse.user_id = user_tbl.id
                     WHERE nurse.user_id=$user_id";
} elseif ($user_type === 'patient') {
    $select_query = "SELECT p.phone,p.address, user_tbl.user_name as username, 
                    user_tbl.user_email FROM patient as p
                    INNER JOIN `user_tbl` ON p.user_id = user_tbl.id
                    WHERE p.user_id=$user_id";
}

$result = mysqli_query($conn,$select_query) or die("Error Query");
if (mysqli_num_rows($result) > 0) {
    $record = mysqli_fetch_assoc($result);
}
else{
    $record= [
        'username' =>'',
        'user_email' =>'',
        'phone' =>'',
        'address' =>''
    ];
}

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
                            <input type="hidden" name="id" value="<?php echo $user_id ?>">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" name="name" value="<?php echo $record['username']; ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" value="<?php echo $record['user_email']; ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Phone</label>
                                <input type="number" name="phone" class="form-control" value="<?php echo $record['phone']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Address</label>
                                <input type="text" name="address" class="form-control" value="<?php echo $record['address'] ?>">
                            </div>
                            <div class="form-group">
                                <button type="submit" name="update" class="btn btn-primary">Save Change</button>
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