<?php
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');

$data_display = "SELECT * FROM query_contact WHERE status='read' ORDER BY id DESC";
$result1 = mysqli_query($conn, $data_display) or die("Query failed");
$count_row = mysqli_num_rows($result1);

?>
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card  mb-4">
        <div class="card-header py-3 d-flex justify-content-start align-item-center">
           Contact Read Information
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
                            <th>Message</th>
                        
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
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['phone']; ?></td>
                                    <td><?php echo substr($row['message'],0,50); ?>...</td>
                                    <td>
                                        <div class="d-none d-md-inline">
                                        <a href=contact_query_view.php?id="<?php echo $row['id']; ?>" class="btn btn-outline-warning btn-sm">View</a>
                                            <form action="contact_query_delete.php" method="POST" id="deleteForm" style="display:inline-block; margin:2px;">
                                                <input type="hidden" name="id" value="<?php echo $row['id'] ?>" class="delete_id">
                                                <button type="submit" name="delete" class="btn btn-outline-danger btn-sm deletebtn" data-delete-url="contact_query_delete.php">Delete</button>
                                            </form>
                                        </div>
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