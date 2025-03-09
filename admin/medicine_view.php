<?php 
ob_start();
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');

if(!isset($_SESSION['id'])){
  header('location:index.php');
}


$id= $_GET['id'];
$sql = "SELECT m.id, m.medicine_name, c.medicine_name AS category, m.price,m.description,
m.manufacuturin_company,m.manufacuturin_date,m.stock
 FROM medicine AS m
 INNER JOIN medicine_cat AS c ON m.category  = c.id
 WHERE m.id = $id";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result)>0){
    $record = mysqli_fetch_array($result);

    ob_end_flush();
?>

<div class="container-fluid">
    <!-- DataTales Example -->
  
                                 
    <div class="card  mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Midicine Information
              <a href="medicine_add.php">  <button type="button"  class="btn btn-primary mr-2" data-toggle="modal" data-target="#exampleModal">
                    Add MedicineName
                </button>
                </a>
            </h6>
        </div>
        <div class="card-body">
       <!-- Php code -->
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <input type="hidden" value="<?php echo $record['id'] ?>"> 
                   <tr>
                     <th>Medicine:</th>
                    <td><?php echo $record['medicine_name'] ?></td>
                   </tr>
                   <tr>
                     <th>Medicine Categroy</th>
                    <td><?php echo $record['category'] ?></td>
                   </tr>
                   <tr>
                     <th>Description</th>
                    <td><?php echo $record['description'] ?></td>
                   </tr><tr>
                     <th>Price:</th>
                    <td><?php echo $record['price'] ?></td>
                   </tr>
                   <tr>
                     <th>Manufacturing Company</th>
                    <td><?php echo $record['manufacuturin_company'] ?></td>
                   </tr>

                   <tr>
                     <th>Manufacturing Date:</th>
                    <td><?php echo $record['manufacuturin_date'] ?></td>
                   </tr>
                   <tr>
                     <th>Stock:</th>
                    <td><?php echo $record['stock'] ?></td>
                   </tr>
                  
                   <td colspan="2">
                   <a href="medicine_list.php"><button class="btn btn-outline-success w-40">Go Back</button></a>
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