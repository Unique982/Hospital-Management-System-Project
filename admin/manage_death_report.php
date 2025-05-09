<?php
ob_start();
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');

if(!isset($_SESSION['id'])){
    header('location:index.php');
}

$user_type = $_SESSION['user_data']['role'];
$user_id = $_SESSION['id'];
if ($user_type == 'admin' || $user_type == 'doctor' || $user_type == 'nurse') {
    $select_query = "SELECT r.rep_id,r.patient_id, p.name AS patient,CONCAT(d.first_name,'',d.last_name)  As doctor,
    r.report_type,r.date
    FROM report AS r
    INNER JOIN patient AS p ON r.patient_id =p.id
    INNER JOIN doctors AS d ON r.doctor_id = d.id
    ORDER BY r.rep_id DESC";
}
if ($user_type == 'patient') {
    $select_query = "SELECT r.rep_id,r.patient_id,p.user_id, p.name AS patient,CONCAT(d.first_name,'',d.last_name)  As doctor,
    r.report_type as report_type,r.date
    FROM report AS r
    INNER JOIN patient AS p ON r.patient_id =p.id
    INNER JOIN doctors AS d ON r.doctor_id = d.id
    WHERE p.user_id= $user_id";
}
$result = mysqli_query($conn, $select_query);
$count = mysqli_num_rows($result);



ob_end_flush();
?>
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card  mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Manage Report
                <a href="manage_operation.php"><button type="button" class="btn btn-sm">
                        <i class="fa-solid fa-bars"></i> Operation
                    </button>
                </a>
                <a href="manage_birth_report.php"> <button type="button" class="btn btn-sm">
                        <i class="fa-solid fa-bars"></i> Birth
                    </button>
                </a>
                <a href="manage_death_report.php"> <button type="button" class="btn btn-sm">
                        <i class="fa-solid fa-bars"></i> Death
                    </button>
                </a>
                <?php if ($user_type == 'doctor' || $user_type == 'admin' || $user_type == 'nurse') { ?>
                    <a href="report_add.php"> <button type="button" class="btn btn-primary btn-sm">
                            Add Report
                        </button>
                    <?php }  ?>
                    </a>
            </h6>
        </div>
        <div class="card-body">
            <!-- Php code -->
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Pateint Name</th>
                            <th>Doctor Name</th>
                            <th>Report Type</th>
                            <th>Date</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $sn = +1;
                        if ($count > 0) {
                            while ($record = mysqli_fetch_assoc($result)) {
                                if ($record['report_type'] == 'death') {
                        ?> <tr>
                                        <td><?php echo $sn; ?></td>
                                        <td><?php echo $record['patient'] ?></td>
                                        <td><?php echo $record['doctor']  ?></td>
                                        <td><?php echo $record['report_type'] ?> </td>
                                        <td><?php echo $record['date'] ?> </td>
                                        <td><a href="report_view.php?rep_id=<?php echo $record['rep_id'] ?>"><button type="button" class="btn btn-outline-warning btn-sm">View</button></a>
                                            <?php if ($user_type == 'doctor' || $user_type == 'admin' || $user_type == 'nurse') { ?>
                                                <a href="report_edit.php?rep_id=<?php echo $record['rep_id'] ?>" class="btn btn-outline-success btn-sm">Edit</a>
                                                <form action="report_delete.php" method="POST" id="deleteForm" style="display:inline-block; margin:2px;">
                                                    <input type="hidden" name="id" value="<?php echo $record['rep_id'] ?>" class="delete_id">
                                                    <button type="submit" name="delete" class="btn btn-outline-danger btn-sm deletebtn" data-delete-url="report_delete.php">Delete</button>
                                                </form>
                                            <?php }  ?>
                                        </td>

                                    </tr>
                        <?php
                                    $sn++;
                                }
                            }
                        } else {
                            echo "<tr><td colspan='5' class='text-center'>Not Found Data</td></td>";
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