<?php
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');

if(!isset($_SESSION['id'])){
    header('location:index.php');
}

$user_type = $_SESSION['user_data']['role'];
$user_id = $_SESSION['id'];

$select_query = "SELECT p.id,p.user_id,p.name,p.age,p.sex,p.blood_group,p.address,p.phone,
     user_tbl.user_name,user_tbl.user_email, user_tbl.id,CONCAT(d.first_name,'',d.last_name) as doctor_name FROM patient as p
LEFT JOIN user_tbl ON p.user_id = user_tbl.id
LEFT JOIN doctors  as d ON p.added_by = d.user_id
 ORDER BY  p.id DESC";

$result = mysqli_query($conn, $select_query);
$count = mysqli_num_rows($result);

?>

<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card  mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Patient List
                <!-- <a href="patient_add.php"> <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
                        Add New Patient
                    </button>
                </a> -->
                <a href="patient_report_print.php"> <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
                        Print pdf
                    </button>
                </a>
            </h6>
        </div>
        <div class="card-body">
            <!-- Php code -->
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Age</th>
                            <th>Phone</th>
                            <th>Blood Group</th>             
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            $sn = +1;
                            if ($count > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {


                            ?>
                                    <td><?php echo $sn; ?></td>
                                    <td><?php echo $row['user_name'] ?></td>
                                    <td><?php echo $row['user_email'] ?></td>
                                    <td><?php echo $row['age'] ?></td>
                                    <td><?php echo $row['phone'] ?></td>
                                    <td><?php echo $row['blood_group'] ?></td>
                                    <td><a href="patient_view.php?id=<?php echo $row['id'] ?>"><button type="button" class="btn btn-outline-warning btn-sm">View</button></a>
                                        <a href="patient_edit.php?id=<?php echo $row['id']  ?>" class="btn btn-outline-success btn-sm">Edit</a>
                                        <form action="patient_delete.php" method="POST" id="deleteForm" style="display:inline-block; margin:2px;">
                                            <input type="hidden" name="id" value="<?php echo $row['id'] ?>" class="delete_id">
                                            <button type="submit" name="delete" class="btn btn-outline-danger btn-sm deletebtn" data-delete-url="patient_delete.php">Delete</button>
                                        </form>

                                    </td>
                        </tr>
                <?php
                                    $sn++;
                                }
                            } else {
                                echo "<tr><td colspan='8' class='text-center'>Not Found Data</td></tr>";
                            }
                ?>

                    </tbody>

                </table>
            </div>
        </div>
    </div>

</div>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>