<?php
ob_start();
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');

if(!isset($_SESSION['id'])){
    header('location:index.php');
 }
$sql1 = "SELECT * FROM specialization  ORDER BY `id` DESC";
$result1 = mysqli_query($conn, $sql1) or die("Error Query");
$count_row = mysqli_num_rows($result1);
ob_end_flush();
?>
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card  mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"> Specialization Information
                    <a href="specialization_add.php"> <button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#exampleModal">
                            Add New Specialization
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
                                <th>Specialization</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sn = +1;
                            if($count_row > 0){
                            while ($row = mysqli_fetch_assoc($result1)) {
                            ?>
                                <tr>
                                    <td><?php echo $sn; ?></td>
                                    <td><?php echo $row['specialization'] ?></td>
                                    <td><?php echo $row['description'] ?></td>

                                    <td>
                                        <a href="specialization_edit.php?id=<?php echo $row['id'] ?>" class="btn btn-outline-success btn-sm">Edit</a>
                                        <form action="specialization_delete.php" method="POST" id="deleteForm" style="display:inline-block; margin:2px;">
                                            <input type="hidden" name="id" value="<?php echo $row['id'] ?>" class="delete_id">
                                            <button type="submit" name="delete" class="btn btn-outline-danger btn-sm deletebtn" data-delete-url="specialization_delete.php">Delete</button>

                                        </form>


                                    </td>
                                </tr>
                        <?php
                                $sn++;
                            }
                        }else{
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