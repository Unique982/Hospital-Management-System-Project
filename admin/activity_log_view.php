<?php
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');

$select_query = "SELECT a.user_id,a.user_type,a.status,a.ip_address,a.time, user_tbl.id,user_tbl.user_name  FROM activity_log as a
INNER JOIN user_tbl ON a.user_id = user_tbl.id
 WHERE user_id='".$_SESSION['id']."'";
$result = mysqli_query($conn,$select_query);

?>

<div class="container-fluid">
    <!-- DataTales Example -->             
    <div class="card mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Activity Log</h6>
        </div>
        <div class="card-body">
            <!-- PHP code -->
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User Name</th>
                            <th>User Role</th>
                            <th>Status</th>
                            <th>IP Address</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php 
                       $sn = 1;
                       while ($row = mysqli_fetch_array($result)){
                        ?>
                        <tr>
                            <td><?php echo $sn; ?></td>
                            <td><?php echo $row['user_name'] ?></td>
                            <td><?php echo $row['user_type'] ?></td>
                            <td><?php  if ($row['status']=='active'){ ?>
                           <span style='color:green'>●Active</span>
                            <?php
                          }else{ ?>
                           <span style='color:red;'>●Unactive</span>
                        <?php 
                          }
                          ?>
                            </td>
                            <td><?php echo $row['ip_address'] ?></td>
                            <td><?php echo $row['time'] ?></td>
                        </tr>
                        <?php
                    $sn ++;    
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
