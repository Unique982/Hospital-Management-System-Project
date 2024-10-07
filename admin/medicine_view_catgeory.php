<?php
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');
$id= $_GET['id'];
$sql = "SELECT * FROM medicine_cat WHERE id =$id";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result)>0){
    $record = mysqli_fetch_array($result);
?>

<div class="container-fluid">
    <!-- DataTales Example -->                               
    <div class="card  mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Medicine Category Infromation
              <a href="medicine_add_catgeory.php">  <button type="button"  class="btn btn-primary mr-2" data-toggle="modal" data-target="#exampleModal">
                   Add Medicine Category
                </button>
                </a>
            </h6>
        </div>
        <div class="card-body">
       <!-- Php code -->
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <input type="hidden"  value="<?php echo $record['id'] ?>"> 
                    <tr>
                        <th>Medicine Category:</th>
                        <td><?php echo $record['medicine_name'];?></td>
                    </tr>
                    <tr>
                        <th>Description:</th>
                        <td><?php echo $record['medicine_description'];?></td>
                    </tr>
                    <tr>
                        <th>Created_at:</th>
                        <td><?php echo $record['created_at'];?></td>
                    </tr>
                    
                   <td colspan="2">
                   <a href="medicine_list_catgeory.php"><button class="btn btn-outline-success w-40">Go Back</button></a>
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