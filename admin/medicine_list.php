<?php
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');
$select_query = "SELECT * FROM medicine ORDER BY  id DESC ";
$result = mysqli_query($conn, $select_query);
$count = mysqli_num_rows($result);
if($count){
?>
<div class="container-fluid">
    <!-- DataTales Example -->             
    <div class="card  mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Medicine Category List
              <a href="medicine_add.php">  <button type="button"  class="btn btn-primary mr-2" data-toggle="modal" data-target="#exampleModal">
                   Medicine Category Add
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
                            <th>ManCompany</th>
                            <th>Manu Date</th>
                            <th>Stock</th>
                            <th>Action</th>
                          
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php 
                            $sn = +1;
                            while($record = mysqli_fetch_assoc($result)){

                           
                           ?>
                            <td><?php echo $sn; ?></td>
                            <td><?php echo $record['medicine_name'] ?></td>
                            <td><?php echo $record['category'] ?></td>
                            <td><?php echo $record['description'] ?></td>
                            <td><?php echo $record['price'] ?></td>
                            <td><?php echo $record['manufacuturin_company'] ?></td>
                            <td><?php echo $record['manufacuturin_date'] ?></td>
                            <td><?php echo $record['stock'] ?></td>
                            
                            <td><a href="medicine_view.php?id=<?php echo $record['id'] ?>"><button type="button" class="btn btn-warning mr-2"><i class="fas fa-eye"></i></button></a>
                          <a href="medicine_edit.php?id=<?php echo $record['id'] ?>" class="btn btn-outline-success mr-2"><i class="fas fa-edit"></i></a>     
                          <form action="medicine_delete.php" method="POST" id="deleteForm" style="display:inline-block; margin:2px;">
                              <input type="hidden" name="id" value="<?php echo $record['id'] ?>">
                              <button type="submit" name="delete" class="btn btn-outline-danger" onclick="confirmDetele()"><i class="fas fa-trash-alt"></i></button>
                              </form> 

                            </td>
                        </tr>
                        <?php 
                        $sn++;
                            }
                            
                        
                      
                        }
                        else {
                            echo "No records found";
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