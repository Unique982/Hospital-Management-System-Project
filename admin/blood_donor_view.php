<?php include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');
$blood_donor_id= $_GET['blood_donor_id'];
$sql = "SELECT * FROM blood_donors where blood_donor_id =$blood_donor_id";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result)>0){
    $record = mysqli_fetch_array($result);
?>

<div class="container-fluid">
    <!-- DataTales Example -->
  
                                 
    <div class="card  mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Blood Donor Information
              <a href="patient_add.php">  <button type="button"  class="btn btn-primary mr-2" data-toggle="modal" data-target="#exampleModal">
                    Add New Blood Donor
                </button>
                </a>
            </h6>
        </div>
        <div class="card-body">
       <!-- Php code -->
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <input type="hidden" value="<?php echo $record['blood_donor_id'] ?>"> 
                   <tr>
                     <th>Name:</th>
                    <td><?php echo $record['name'] ?></td>
                   </tr>
                   <tr>
                     <th>Email:</th>
                    <td><?php echo $record['email'] ?></td>
                   </tr>
                   <tr>
                     <th>Phone:</th>
                    <td><?php echo $record['phone'] ?></td>
                   </tr><tr>
                     <th>Gender:</th>
                    <td><?php echo $record['gender'] ?></td>
                   </tr>
                   <tr>
                     <th>Age:</th>
                    <td><?php echo $record['age'] ?></td>
                   </tr>

                   <tr>
                     <th>Blood Group:</th>
                    <td><?php echo $record['blood_group'] ?></td>
                   </tr>
                   <tr>
                     <th>Address:</th>
                    <td><?php echo $record['address'] ?></td>
                   </tr>
                   <tr>
                     <th>last Time Donated:</th>
                    <td><?php echo $record['last_donated'] ?></td>
                   </tr>
                   <tr>
                     <th>Available:</th>
                    <td><?php  if($record['is_available'] ==1){
                        echo "Yes";
                    }
                    else{
                        echo "No";
                    } ?></td>
                   </tr>
                   <tr>
                     <th>Created At:</th>
                    <td><?php echo $record['created_at'] ?></td>
                   </tr>
                   <td colspan="2">
                   <a href="blood_donor_list.php"><button class="btn btn-outline-success w-40">Go Back</button></a>
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