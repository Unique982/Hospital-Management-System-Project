<?php
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');
$select_query = "SELECT * FROM medicine_cat ORDER BY  id DESC ";
$result = mysqli_query($conn, $select_query);
$count = mysqli_num_rows($result);
if($count){
?>
<div class="container-fluid">
    <!-- DataTales Example -->             
    <div class="card  mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Medicine Category List
              <a href="medicine_add_catgeory.php">  <button type="button"  class="btn btn-primary mr-2" data-toggle="modal" data-target="#exampleModal">
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
                            <th>M_Category</th>
                            <th>Description</th>
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
                            <td><?php echo $record['medicine_description'] ?></td>
                            <td><a href="medicine_view_catgeory.php?id=<?php echo $record['id'] ?>"><button type="button" class="btn btn-warning btn-sm"><i class="fas fa-eye"></i></button></a>
                          <a href="medicine_edit_catgeory.php?id=<?php echo $record['id'] ?>" class="btn btn-outline-success btn-sm"><i class="fas fa-edit"></i></a>     
                          <form action="medicine_delete_catgeory.php" method="POST" id="deleteForm" style="display:inline-block; margin:2px;">
                              <input type="hidden" name="id" value="<?php echo $record['id'] ?>" class="delete_id">
                              <button type="submit" name="delete" class="btn btn-outline-danger btn-sm deletebtn" data-delete-url="medicine_delete_catgeory.php"><i class="fas fa-trash-alt"></i></button>
                              </form> 

                            </td>
                          
                        </tr>
                       
                     
                    </tbody>
                  
                    <?php 
                        $sn++;
                            }
                            
                        
                      
                        }
                        else {
                            echo "No records found";
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