<?php
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');
$select_query = "SELECT m.id, m.medicine_name, c.medicine_name AS category, m.price,m.description,
m.manufacuturin_company,m.manufacuturin_date,m.stock
 FROM medicine AS m
 INNER JOIN medicine_cat AS c ON m.category  = c.id 
 ORDER BY m.id ASC
 ";
$result = mysqli_query($conn, $select_query);
$count = mysqli_num_rows($result);

?>
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card  mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Medicine List
                <a href="medicine_add.php"> <button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#exampleModal">
                        Medicine  Add
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
                            <th>Medicine Name</th>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $sn = 1;
                        if ($count > 0) {
                            while ($record = mysqli_fetch_assoc($result)) {
                        ?>
                                <tr>
                                    <td><?php echo $sn; ?></td>
                                    <td><?php echo $record['medicine_name'] ?></td>
                                    <td><?php echo $record['category'] ?></td>
                                    <td><?php echo substr($record['description'], 0, 50,) . '...' ?></td>
                                    <td><?php echo $record['price'] ?></td>


                                    <td><a href="medicine_view.php?id=<?php echo $record['id'] ?>"><button type="button" class="btn btn-warning btn-sm"><i class="fas fa-eye"></i></button></a>
                                        <a href="medicine_edit.php?id=<?php echo $record['id'] ?>" class="btn btn-outline-success btn-sm"><i class="fas fa-edit"></i></a>
                                        <form action="medicine_delete.php" method="POST" id="deleteForm" style="display:inline-block; margin:2px;">
                                            <input type="hidden" name="id" value="<?php echo $record['id'] ?>" class="delete_id">
                                            <button type="submit" name="delete" class="btn btn-outline-danger btn-sm deletebtn" data-delete-url="medicine_delete.php"><i class="fas fa-trash-alt"></i></button>
                                        </form>

                                    </td>
                                </tr>

                    </tbody>
            <?php
                                $sn++;
                            }
                        }
            ?>
                </table>
            </div>
        </div>
    </div>

</div>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>