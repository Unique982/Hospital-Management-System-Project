<?php include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');


$bed_id= $_GET['bed_id'];
$sql = "SELECT * FROM bed where bed_id =$bed_id";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result)>0){
    $record = mysqli_fetch_array($result);
?>

<div class="container-fluid">
    <!-- DataTales Example -->
  
                                 
    <div class="card  mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Bed List
              <a href="bed_add.php"><button type="button"  class="btn btn-primary mr-2" data-toggle="modal" data-target="#exampleModal">
                   Add Bed
                </button>
                </a>
            </h6>
        </div>
        <div class="card-body">
       <!-- Php code -->
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <input type="hidden" value="<?php echo $record['bed_id'] ?>"> 
                   <tr>
                     <th>Bed Number:</th>
                    <td><?php echo $record['bed_num'] ?></td>
                   </tr>
                   <tr>
                     <th>Bed Type:</th>
                    <td><?php echo $record['bed_type'] ?></td>
                   </tr>
                   <tr>
                     <th>Description:</th>
                    <td><?php echo $record['description'] ?></td>
                   </tr><tr>
                   <tr>
                   <td colspan="2">
                   <a href="bed_list.php"><button class="btn btn-outline-success w-40">Go Back</button></a>
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