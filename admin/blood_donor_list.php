<?php include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');

// select Query
$select_query = "SELECT * FROM blood_donors";
$result = mysqli_query($conn, $select_query);
$count = mysqli_num_rows($result);
if($count){


?>
<div class="container-fluid">
    <!-- DataTales Example -->
  
                                 
    <div class="card  mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Blood Donor
              <a href="blood_donor_add.php">  <button type="button"  class="btn btn-primary mr-2" data-toggle="modal" data-target="#exampleModal">
                    Add New Blood Donor
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
                            <th>Name</th>
                            <th>Age</th>
                            <th>Sex</th>
                            <th>Blood Group</th>
                            <th>last Donation Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $sn = +1;
                        while($row = mysqli_fetch_assoc($result)){ ?>
                        <tr>
                            <td><?php echo $sn; ?></td>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php  echo $row['age'] ?></td>
                            <td><?php  echo ucfirst($row['gender']) ?></td>
                            <td><?php  echo $row['blood_group'] ?></td>
                            <td><?php  echo date("Y M d ", strtotime($row['last_donated'])) ?></td>
                          
                            
                            <td><a href=""><button type="button" class="btn btn-outline-warning mr-2">View</button></a>
                          <a href="blood_donor_edit.php?blood_donor_id=<?php echo $row['blood_donor_id'] ?>" class="btn btn-outline-success mr-2">Edit</a>     
                          <form action="blood_donor_delete.php" method="POST" id="deleteForm" style="display:inline-block; margin:2px;">
                              <input type="hidden" name="blood_donor_id" value="<?php echo $row['blood_donor_id'] ?>">
                              <button type="submit" name="delete" class="btn btn-outline-danger" onclick="confirmDetele()">Delete</button>
                              </form> 

                            </td>
                        </tr>
                        <?php 
                        $sn++;
                            }
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