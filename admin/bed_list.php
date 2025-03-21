<?php
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');

if(!isset($_SESSION['id'])){
    header('location:index.php');
  }

$select_query = "SELECT * FROM bed ORDER BY  bed_id ASC ";
$result = mysqli_query($conn, $select_query);
$count = mysqli_num_rows($result);
$update_status ="UPDATE bed  JOIN bed_allocate ON bed.bed_id = bed_allocate.bed_id
SET bed.status ='available' WHERE DATE(bed_allocate.discharge)<=CURDATE()";
mysqli_query($conn,$update_status);
?>
<div class="container-fluid">
    <!-- DataTales Example -->             
    <div class="card  mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Bed List
              <a href="bed_add.php">  <button type="button"  class="btn btn-primary mr-2" data-toggle="modal" data-target="#exampleModal">
                    Add Bed
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
                            <th>ID</th>
                            <th>Bed Number</th>
                            <th>Type</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Action</th>
                          
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php 
                            $sn = +1;
                            if($count >0){
                            while($row = mysqli_fetch_assoc($result)){

                           
                           ?>
                            <td><?php echo $sn; ?></td>
                            <td><?php echo $row['bed_num'] ?></td>
                            <td><?php echo $row['bed_type'] ?></td>
                            <td><?php echo $row['description'] ?></td>
                            <td><?php if($row['status']=='booked'){?>
                                <span class="badge badge-danger">Booked</span>
                                    <?php } elseif($row['status']=='available') { ?>
                                        <span class="badge badge-success">Available</span>
                                    
                               <?php  } ?></td>
                            <td><a href="bed_view.php?bed_id=<?php echo $row['bed_id'] ?>"><button type="button" class="btn btn-outline-warning btn-sm">View</button></a>
                          <a href="bed_edit.php?bed_id=<?php echo $row['bed_id'] ?>" class="btn btn-outline-success btn-sm">Edit</a>     
                          <form action="bed_delete.php" method="POST" id="deleteForm" style="display:inline-block; margin:2px;">
                              <input type="hidden" name="bed_id" value="<?php echo $row['bed_id'] ?>" class="delete_id">
                              <button type="submit" name="delete" class="btn btn-outline-danger btn-sm deletebtn" data-delete-url="bed_delete.php">Delete</button>
                              </form> 

                            </td>
                        </tr>
                        <?php 
                        $sn++;
                            }
                        }
                        else{
                            echo "<tr><td colspan='5' class='text-center'>Data Not Found</td></tr>";
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