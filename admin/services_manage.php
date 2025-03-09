<?php
ob_start();
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');

if(!isset($_SESSION['id'])){
    header('location:index.php');
}
$select_query = "SELECT * FROM services_page";
$result = mysqli_query($conn, $select_query);
$count_row = mysqli_num_rows($result);
ob_end_flush();
?>
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card  mb-4">
        <div class="card-header py-3">
            Manage Services
            <a href="services_add.php"><button class="btn btn-primary btn-sm">Add</button></a>
        </div>
        <div class="card-body">
            <!-- Php code -->
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Servicec Name</th>
                            <th>Services Slug</th>
                            <!-- <th>Icon</th> -->
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $sn = 1;
                        if ($count_row > 0) {
                            while ($record = mysqli_fetch_assoc($result)) {

                        ?>
                                <tr>
                                    <td><?php echo $sn; ?></td>
                                    <td><?php echo $record['services_name'] ?></td>
                                    <td><?php echo $record['services_slug']  ?></td>
                                    <td>
                                        <a href="services_edit.php?id=<?php echo $record['id'] ?>" class="btn btn-outline-success btn-sm">Edit</a>
                                        <form action="service_delete.php" method="POST" id="deleteForm" style="display:inline-block; margin:2px;">
                                            <input type="hidden" name="id" value="<?php echo $record['id'] ?>" class="delete_id">
                                            <button type="submit" name="delete" class="btn btn-outline-danger btn-sm deletebtn" data-delete-url="services_delete.php">Delete</button>
                                        </form>
                                    </td>
                                <?php
                                $sn++;
                            }  ?>
                                </tr>
                            <?php
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