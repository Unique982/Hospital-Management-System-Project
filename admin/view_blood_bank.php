<?php
ob_start();
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');
if(!isset($_SESSION['id'])){
    header('location:index.php');
}

// select Query
$select_query = "SELECT blood_group, COUNT(*) as status FROM blood_donors WHERE is_available=1 GROUP BY blood_group ";
$result = mysqli_query($conn, $select_query);
$count = mysqli_num_rows($result);
ob_end_flush();
?>
<div class="container-fluid">
    <!-- DataTales Example -->
  
                                 
    <div class="card  mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Blood View
            </h6>
        </div>
        <div class="card-body">
       <!-- Php code -->
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Blood Group</th>
                            <th>Status</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $sn = +1;
                        if($count >0){
                        while($row = mysqli_fetch_assoc($result)){ ?>
                        <tr>
                            <td><?php echo $sn; ?></td>
                            <td><?php  echo $row['blood_group'] ?></td>
                            <td><?php  echo $row['status'] ?></td>
                    
                          
                            
                        </tr>
                        <?php 
                        
                        $sn++;
                            }
                        }else{
                            echo "<tr><td colspan='7' class='text-center'>Not Found Data</td></tr>";
                        }
                            
                        
                    ?>
                     
                    </tbody>
                  
                </table>
            </div>
        </div>
    </div>

</div>

<!-- <script>
    function checkdelete(){
        return confirm('Are you sure you want to delete this data?');

    }

</script> -->
<?php
include('includes/scripts.php');
include('includes/footer.php');
?>