<?php
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');

$data_display = "SELECT doctors.id as id, doctors.first_name, doctors.last_name, specialization.specialization,
doctors.phone,doctors.address, doctors.created_at, user_tbl.user_name as username, user_tbl.user_email,user_tbl.role, user_tbl.id   FROM `doctors` 
INNER JOIN `user_tbl` ON doctors.user_id = user_tbl.id
INNER JOIN `specialization` ON doctors.specialization = specialization.id
ORDER BY doctors.id DESC";
$result1 = mysqli_query($conn, $data_display) or die("Query failed");
$count_row = mysqli_num_rows($result1);

?>
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card  mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"> Doctor List
                <?php 
                        if($user_type=='admin'){
                            ?>    
                <a href="doctors_add.php"> <button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#exampleModal">
                            Add Doctor
                        </button>
                    </a>
                    <?php } ?>
                </h6>
            </div>
            <div class="card-body">
                <!-- Php code -->
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <?php 
                        if($user_type=='admin'){
                            ?>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>specialization</th>
                                <th>Position</th>
                                <th>Action</th>
                            </tr>
                        
                            <?php 
                       }elseif($user_type=='patient'){
                            ?>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>specialization</th>
                            </tr>
                            <?php  } ?>
                            
                        </thead>
                        <tbody>
                            <tr>
                                <?php
                                
                                $sn = 1;
                                if($count_row > 0){
                                while ($row = mysqli_fetch_assoc($result1)) { 
                                 if($user_type=='admin'){
                                    ?>
                                    <td><?php echo $sn; ?></td>
                                    <td><?php echo $row['username']; ?></td>
                                    <td><?php echo $row['user_email']; ?></td>
                                    <td><?php echo $row['specialization']; ?></td>
                                    <td><?php echo ucfirst($row['role']); ?></td>
                                    <td><a href="doctors_view.php?id=<?php echo $row['id']; ?>"><button type="button" class="btn btn-outline-warning btn-sm">View</button></a>
                                        <a href="doctors_edit.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-success btn-sm">Edit</a>
                                        <form action="doctors_delete.php" method="POST" id="deleteForm" style="display:inline-block; margin:2px;">
                                            <input type="hidden" name="id" value="<?php echo $row['id'] ?>" class="delete_id">
                                            <button type="submit" name="delete" class="btn btn-outline-danger btn-sm deletebtn" data-delete-url="doctors_delete.php">Delete</button>
                                        </form>

                                    </td>
                                   
                            </tr>
                        <?php
                                 
                                    
                                 }
                                 elseif($user_type=='patient'){  ?>
                                 <tr>
                             
                             <td><?php echo $sn; ?></td>
                                    <td><?php echo $row['username']; ?></td>
                                    <td><?php echo $row['specialization']; ?></td>
                                 
                                </tr>
                                <?php
$sn++;
                                 }
                                 }
                                }
                            else {
                                echo "<tr><td colspan='7' class='text-center'>No record</td></tr>";
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