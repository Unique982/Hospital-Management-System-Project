<?php
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');



$user_type = $_SESSION['user_data']['role'];
$user_id = $_SESSION['id'];
if ($user_type == 'admin' || $user_type == "nurse" || $user_type=='doctor') {
    $select_query = "SELECT ba.bed_allocate_id,
 b.bed_num AS bed_number,  p.name  AS patient_name, ba.allocated_at,ba.discharge
  FROM bed_allocate ba 
INNER JOIN bed b on ba.bed_id = b.bed_id
INNER JOIN patient p on ba.pateint_id = p.id
ORDER BY ba.bed_allocate_id DESC ";
}
if ($user_type == 'patient') {
    $select_query = "SELECT ba.bed_allocate_id,
 b.bed_num AS bed_number,  p.name  AS patient_name, ba.allocated_at,ba.discharge
  FROM bed_allocate ba 
INNER JOIN bed b on ba.bed_id = b.bed_id
INNER JOIN patient p on ba.pateint_id = p.id
 WHERE p.user_id = $user_id
ORDER BY ba.bed_allocate_id DESC ";
}
$result = mysqli_query($conn, $select_query);
$count = mysqli_num_rows($result);

?>
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card  mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Bed Allocated List
            <?php if ($user_type == 'admin' || $user_type == "nurse" || $user_type=='doctor') { ?>
                <a href="allocate_bed_add.php"> <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
                        Add Bed allocated
                    </button>
                </a>
                <?php  } ?>
            </h6>
        </div>
        <div class="card-body">
            <!-- Php code -->
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Bed Number</th>
                            <th>Patient Name</th>
                            <th>Allocated_at</th>
                            <th>Discharge</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sn = +1;
                        if ($count > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                                <tr>
                                    <td><?php echo $sn; ?></td>
                                    <td><?php echo $row['bed_number'] ?></td>
                                    <td><?php echo $row['patient_name'] ?></td>
                                    <td><?php echo date('d M Y,H:i A', strtotime($row['allocated_at'])); ?></td>
                                    <td><?php echo date('d M Y,H:i A', strtotime($row['discharge'])); ?></td>
                                    <td><a href="allocate_bed_view.php?bed_allocate_id=<?php echo $row['bed_allocate_id'] ?>"><button type="button" class="btn btn-outline-warning btn-sm">View</button></a>

                                        <?php if ($user_type == 'admin' || $user_type == "nurse" || $user_type=='doctor') { ?>
                                            <a href="allocate_bed_edit.php?bed_allocate_id=<?php echo $row['bed_allocate_id'] ?>" class="btn btn-outline-success btn-sm">Edit</a>
                                            <form action="allocate_bed_delete.php" method="POST" id="deleteForm" style="display:inline-block; margin:2px;">
                                                <input type="hidden" name="bed_allocate_id" value="<?php echo $row['bed_allocate_id'] ?>" class="delete_id">
                                                <button type="submit" name="delete" class="btn btn-outline-danger btn-sm deletebtn" data-delete-url="allocate_bed_delete.php">Delete</button>
                                            </form>

                                    </td>
                                <?php }  ?>
                                </tr>
                        <?php
                                $sn++;
                            }
                        } else {
                            echo "<tr><td colspan='6' class='text-center'>Not Found</td></tr>";
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