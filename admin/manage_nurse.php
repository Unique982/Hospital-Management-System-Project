<?php
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');

$data_display = "SELECT nurse.id,nurse.phone, nurse.address,nurse.gender,nurse.qualification, user_tbl.user_name as username, user_tbl.user_email,user_tbl.role, user_tbl.id   FROM `nurse` 
INNER JOIN `user_tbl` ON nurse.user_id = user_tbl.id
ORDER BY nurse.id DESC";
$result1 = mysqli_query($conn, $data_display) or die("Query failed");
$count_row = mysqli_num_rows($result1);

?>
    <div class="container-fluid">
   
        <!-- DataTales Example -->
        <div class="card  mb-4">
            <div class="card-header py-3 d-flex justify-content-start align-item-center">
                <h6 class="m-0 font-weight-bold text-primary"> Nurse List
                    <a href="nurse_add.php"><button type="button" class="btn btn-primary mr-2" >
                            Add Nurse
                        </button>
                    </a>
                </h6>
            </div>
            <div class="card-body">
                <!-- Php code -->
                <div class="table-responsive">
                    <table style="width:100%" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Gender</th>
                                <th>Position</th>
                                <!-- <th>Start date</th> -->
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
                                $sn = +1;
                                if($count_row > 0){
                                while ($row = mysqli_fetch_assoc($result1)) { ?>
                                    <td><?php echo $sn; ?></td>
                                    <td><?php echo $row['username']; ?></td>
                                    <td><?php echo $row['user_email']; ?></td>
                                    <td><?php echo $row['phone']; ?></td>
                                    <td><?php echo ucfirst($row['gender']); ?></td>
                                    <td><?php echo ucfirst($row['role']); ?></td>
                                    <td>
    <!-- Dropdown for mobile responsiveness -->
    <div class="dropdown d-inline-block">
        <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Actions
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a href="nurse_view.php?id=<?php echo $row['id']; ?>" class="dropdown-item">
                <button type="button" class="btn btn-outline-warning btn-sm w-100">View</button>
            </a>
            <a href="nurse_edit.php?id=<?php echo $row['id']; ?>" class="dropdown-item">
                <button type="button" class="btn btn-outline-success btn-sm w-100">Edit</button>
            </a>
            <form action="nurse_delete.php" method="POST" style="display:inline-block; width: 100%;">
                <input type="hidden" name="id" value="<?php echo $row['id'] ?>" class="delete_id">
                <button type="submit" name="delete" class="btn btn-outline-danger btn-sm w-100 deletebtn" data-delete-url="nurse_delete.php">Delete</button>
            </form>
        </div>
    </div>

    <!-- For larger screens, the original buttons will remain -->
    <div class="d-none d-md-inline">
        <a href="nurse_view.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-warning btn-sm">View</a>
        <a href="nurse_edit.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-success btn-sm">Edit</a>
        <form action="nurse_delete.php" method="POST" id="deleteForm" style="display:inline-block; margin:2px;">
            <input type="hidden" name="id" value="<?php echo $row['id'] ?>" class="delete_id">
            <button type="submit" name="delete" class="btn btn-outline-danger btn-sm deletebtn" data-delete-url="nurse_delete.php">Delete</button>
        </form>
    </div>
</td>
                            </tr>
                        <?php
                                    $sn++;
                                }
                            }
                            else {
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