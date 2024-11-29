<?php include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');
$notice_id= $_GET['notice_id'];
$sql = "SELECT * FROM notice_board WHERE notice_id='$notice_id'";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result)>0){
    $record = mysqli_fetch_array($result);
?>

<div class="container-fluid">
    <!-- DataTales Example -->
  
                                 
    <div class="card  mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Notice
              
            </h6>
        </div>
        <div class="card-body">
       <!-- Php code -->
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <input type="hidden" value="<?php echo $record['notice_id'] ?>"> 
                   <tr>
                     <th>Title:</th>
                    <td><?php echo $record['notice_title'] ?></td>
                   </tr>
                   <tr>
                     <th>Notice</th>
                    <td><?php echo $record['notice'] ?></td>
                   </tr>
                   <tr>
                     <th>Date</th>
                    <td><?php echo date('F d, Y', strtotime($record['created_at'])); ?></td>
                   </tr>
                   <td colspan="2">
                   <a href="notice_board_list.php"><button class="btn btn-outline-success w-40">Go Back</button></a>
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