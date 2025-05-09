<?php
ob_start();
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');

if(!isset($_SESSION['id'])){
    header('location:index.php');
}

$data_display = "SELECT a.id, a.phone, a.address, a.gender,
a.qualification, user_tbl.user_name as username, user_tbl.user_email,user_tbl.role, 
user_tbl.id   FROM accountant as a 
INNER JOIN `user_tbl` ON a.user_id = user_tbl.id ORDER BY a.id DESC";
$result1 = mysqli_query($conn, $data_display) or die("Query failed");
$count_row = mysqli_num_rows($result1);
ob_end_flush();
?>
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card  mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Accountant Information
                <a href="accountant_add.php"> <button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#exampleModal">
                        Add New Accountant
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
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Position</th>
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
                                    <td><?php echo $row['username']; ?></td>
                                    <td><?php echo $row['user_email']; ?></td>
                                    <td><?php echo $row['phone']; ?></td>
                                    <td><?php echo $row['address']; ?></td>
                                    <td><?php echo ucfirst($row['role']); ?></td>
                                    
                                    <td><a href="accountant_view.php?id=<?php echo $row['id']; ?>"><button type="button" class="btn btn-outline-warning btn-sm">View</button></a>
                                        <a href="accountant_edit.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-success btn-sm">Edit</a>
                                        <form action="accountant_delete.php" method="POST" id="deleteForm" style="display:inline-block; margin:2px;">
                                            <input type="hidden" name="id" value="<?php echo $row['id'] ?>" class="delete_id">
                                            <button type="submit" name="delete" class="btn btn-outline-danger btn-sm deletebtn" data-delete-url="accountant_delete.php">Delete</button>
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