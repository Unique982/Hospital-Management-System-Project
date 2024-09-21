<?php 
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');
?>
<div class="container-fluid">

<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                Edit Doctor Details
            </div>
            <?php 
            
           $id=$_GET['id'];
         $select_query = "SELECT * FROM `user_tbl` WHERE id='$id'";
         $result = mysqli_query($conn, $select_query) or die("Query Failed");
         
         if(mysqli_num_rows($result)>0){
            $row = mysqli_fetch_array($result);
         
             
          ?>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <tr>
                    <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                    </tr>
               
                    <tr>
                        <th>Doctor Name:</th>
                        <td><?php echo $row['user_name'];?></td>
                    </tr>
                  
                    <!-- Add more rows as needed for other details -->
                </table>
            </div>
            <?php      }
                ?>
        </div>
    </div>
</div>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
