<?php
ob_start();
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');

if(!isset($_SESSION['id'])){
    header('location:index.php');
}

$id= $_GET['id'];
$sql = "SELECT * FROM query_contact WHERE id = $id";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result)>0){
    $record = mysqli_fetch_array($result);

    ob_end_flush();
?>

<div class="container-fluid">
    <!-- DataTales Example -->                               
    <div class="card  mb-4">
        <div class="card-header py-3">
            Contact Query User Detalis
        </div>
        <div class="card-body">
       <!-- Php code -->
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <input type="hidden" name='id'  value="<?php echo $record['id'] ?>"> 
                    <tr>
                        <th>User Name:</th>
                        <td><?php echo $record['name'];?></td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td><?php echo $record['email'];?></td>
                    </tr>
                    <tr>
                        <th>Phone:</th>
                        <td><?php echo $record['phone'];?></td>
                    </tr>
                    <tr>
                        <th>Phone:</th>
                        <td><?php echo $record['phone'];?></td>
                    </tr>
                    <tr>
                        <th>Message:</th>
                        <td><textarea name="" id="" cols="6" rows="5" class="form-control"><?php echo $record['message'] ?></textarea></td>
                    </tr>
                    <tr>
                        <th>Status:</th>
                        <td><?php echo ucfirst($record['status']);?></td>
                    </tr>
                   <td colspan="2">
                   <a href="unread_contact.php"><button class="btn btn-outline-success w-40">Go Back</button></a>
</td>

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