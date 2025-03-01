<?php
ob_start();
include('./includes/header.php');
include("includes/navbar.php");
include('../database/config.php');


$select_query = "SELECT * from blog  ORDER BY  id DESC";
$result = mysqli_query($conn, $select_query);
$count_row = mysqli_num_rows($result);
ob_end_flush();

?>

<div class="container-fluid">
    <div class="card mb-4 border-0">
        <div class="card-header py-3">
            Manage Blog
            <a href="blog_add.php"> <button class="btn btn-primary btn-sm">Add Blog</button></a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sn = 1;
                        if ($count_row > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {

                        ?>
                                <tr>

                                    <td><?php echo $sn; ?></td>
                                    <td><?php echo substr($row['blog_title'], 0, 20) ?>...</td>
                                    <td><?php echo substr($row['blog_des'], 0, 20) ?>..</td>
                                    <td><?php echo $row['category'] ?></td>
                                    <td><?php echo date('Y,M,D', strtotime($row['create_date'])) ?></td>
                                    <td>
                                        <a href="blog_view.php?id=<?php echo $row['id']; ?>"><button class="btn btn-primary btn-sm">View</button></a>
                                        <a href="blog_edit.php?id=<?php echo $row['id'] ?>"><button class="btn btn-success btn-sm">Edit</button></a>
                                        <form action="blog_delete.php" method="POST" id="deleteForm" style="display:inline-block; margin:2px;">
                                            <input type="hidden" name="id" value="<?php echo $row['id'] ?>" class="delete_id">
                                            <button type="submit" name="delete" class="btn btn-outline-danger btn-sm deletebtn" data-delete-url="blog_delete.php">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                    </tbody>

            <?php $sn++;
                            }
                        }

            ?>
                </table>
            </div>
        </div>

    </div>

</div>
<?php
include('./includes/scripts.php');
include('./includes/footer.php')

?>