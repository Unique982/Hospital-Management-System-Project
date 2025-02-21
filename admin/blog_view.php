<?php include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');
$id= $_GET['id'];
$sql = "SELECT * FROM blog  WHERE id='$id'";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result)>0){
    $record = mysqli_fetch_array($result);
?>

<div class="container-fluid">
    <!-- DataTales Example -->
  
                                 
    <div class="card  mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Notice
              
            </h6>
        </div>
        <div class="card-body">
       <!-- Php code -->
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <input type="hidden" value="<?php echo $record['id'] ?>"> 
                   <tr>
                     <th>Title:</th>
                    <td><?php echo $record['blog_title'] ?></td>
                   </tr>
                   <tr>
                     <th>Description</th>
                    <td><textarea name="" id="" class="form-control"><?php echo $record['blog_des'] ?></textarea></td>
                   </tr>
                   <tr>
                    <th>Category</th>
                    <td><?php echo $record['category']; ?></td>
                   </tr>
                   <tr>
                    <tr>
                        <th>Tag</th>
                        <td><?php echo $record['tag'] ?></td>
                    </tr>
                   <tr>
                    <th>Banner</th>
                    <td>
                    <img src="./Blog_img/banner/<?php echo $record['image_1'] ?>" alt="" height="200px" width="200px" class="img-fluid" style="object-fil:cover;">
                    </td>
                   </tr>
                   <th>Sub Image</th>
                    <td>
                    <img src="./Blog_img/sub_img/<?php echo $record['image_2'] ?>" alt="" height="200px" width="200px" class="img-fluid" style="object-fil:cover;">
                    </td>
                   </tr>
                  
                     <th>Date</th>
                    <td><?php echo date('F d, Y', strtotime($record['create_date'])); ?></td>
                   </tr>
                   <td colspan="2">
                   <a href="notice_board_list.php"><button class="btn btn-outline-success w-40">Go Back</button></a>
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