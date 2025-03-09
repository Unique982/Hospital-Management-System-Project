<?php
ob_start();
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');

if(!isset($_SESSION['id'])){
    header('location:index.php');
}

$data_display = "SELECT * FROM notice_board ORDER BY  notice_id DESC";
$result1 = mysqli_query($conn, $data_display) or die("Query failed");
$count_row = mysqli_num_rows($result1);

ob_end_flush();
?>
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card  mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Notice List
                <a href="notice_board_add.php"> <button type="button" class="btn btn-primary btn-sm">
                        Add Notice
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
                            <th>#</th>
                            <th>Notice Title</th>
                            <th>Notice</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            $sn = +1;
                            if ($count_row > 0) {
                                while ($row = mysqli_fetch_assoc($result1)) { ?>
                                    <td><?php echo $sn; ?></td>
                                    <td><?php echo substr($row['notice_title'],0,50)?>...</td>
                                    <td><?php echo substr( $row['notice'],0,50) ?>...</td>
                                    <td><?php echo date('F d, Y', strtotime($row['created_at'])); ?></td>

                                    <td><a href="notice_board_view.php?notice_id=<?php echo $row['notice_id'] ?>"><button type="button" class="btn btn-outline-warning btn-sm">View</button></a>
                                        <a href="notice_board_edit.php?notice_id=<?php echo $row['notice_id']  ?>" class="btn btn-outline-success btn-sm">Edit</a>
                                        <form action="notice_board_delete.php" method="POST" id="deleteForm" style="display:inline-block; margin:2px;">
                                            <input type="hidden" name="notice_id" value="<?php echo $row['notice_id'] ?>" class="delete_id">
                                            <button type="submit" name="delete" class="btn btn-outline-danger btn-sm deletebtn" data-delete-url="notice_board_delete.php">Delete</button>
                                        </form>

                                    </td>


                        </tr>
                <?php
                                    $sn++;
                                }
                            } else {
                                echo "<tr><td colspan='7' class='text-center'>No record</td></tr>";
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