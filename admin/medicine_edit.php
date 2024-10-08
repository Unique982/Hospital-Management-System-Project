<?php
require_once("includes/header.php");
require_once("includes/navbar.php");
include('../database/config.php');
if (isset($_POST['update'])) {
    $id = mysqli_real_escape_string($conn,$_POST['id']);
  $med_name = mysqli_real_escape_string($conn, $_POST['med_name']);
  $med_category = mysqli_real_escape_string($conn, $_POST['med_category']);
  $med_des = mysqli_real_escape_string($conn, $_POST['med_des']);
  $med_price = mysqli_real_escape_string($conn, $_POST['med_price']);
  $mf_company = mysqli_real_escape_string($conn, $_POST['mf_company']);
  $mf_date = mysqli_real_escape_string($conn, $_POST['mf_date']);
  $stock = mysqli_real_escape_string($conn, $_POST['stock']);
  $update_query = "UPDATE `medicine` SET medicine_name ='$med_name', category = '$med_category', price ='$med_price', description = '$med_des',
   manufacuturin_company = '$mf_company', manufacuturin_date='$mf_date', stock='$stock' where id = '$id'";
  if (mysqli_query($conn, $update_query)) {

    $_SESSION['alert'] = "Update  sucessfully";
    $_SESSION['alert_code'] = "success";
  } else {
    $_SESSION['alert'] = "Update failed";
    $_SESSION['alert_code'] = "warning";
  }
}


?>
<div class="container-fluid">

  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header">
          Add Medicine
        </div>
<?php 
$id = $_GET['id'];
$select_query = "select *  from medicine where id='$id'";
$result = mysqli_query($conn,$select_query) OR die("Query failed");
if(mysqli_num_rows($result)){
    while($record = mysqli_fetch_array($result)){

?>

        <div class="card-body">
          <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $record['id'] ?>">
            <div class="form-group">
              <label for=""> Medicine Name</label>
              <input type="text" name="med_name" value="<?php echo $record['medicine_name'] ?>" class="form-control" placeholder="Enter Medicine Name">
            </div>
            <div class="form-group">
              <label for=""> Medicine Category</label>
              <select name="med_category" id="" class="form-control">
                <?php $select_query = "select * from medicine_cat";
                $result = mysqli_query($conn, $select_query) or die("Query failed");
                while ($data = mysqli_fetch_assoc($result)) {
                if($data['id'] == $record['category']){
                    $selected = "selected";
                }
                else{
                    $selected="";
                }
                echo "<option value ='{$data['id']}'{$selected}>{$data['medicine_name']}</option>";
                }
                ?>
              </select>
              <input type="hidden" name="old_category" value="<?php echo $data['category'] ?>">
            </div>
            <div class="form-group">
              <label for="">Description</label>
              <textarea name="med_des" id="med_des" class="form-control" placeholder="Enter Description"><?php echo $record['description'] ?></textarea>
            </div>
            <div class="form-group">
              <label for="">Price</label>
              <input type="number" name="med_price" value="<?php echo $record['price']?>" class="form-control" placeholder="Enter Price">
            </div>
            <div class="form-group">
              <label for="">Manufacturing Company</label>
              <input type="text" name="mf_company" value="<?php echo $record['manufacuturin_company'] ?>" class="form-control" placeholder="Enter Manufacturing Company">
            </div>
            <div class="form-group">
              <label for="">Manufacturing Date</label>
              <input type="date" name="mf_date" value="<?php echo $record['manufacuturin_date'] ?>" class="form-control" placeholder="Enter MedicineName">
            </div>
            <div class="form-group">
              <label for="">Stock</label>
              <input type="number" value="<?php echo $record['stock'] ?>" name="stock" class="form-control" placeholder="Enter Stock">
            </div>
            <div class="form-group">
            <a href="medicine_list.php" class="btn btn-danger">Cancel</a>
            
            <button type="submit" name="update" class="btn btn-primary">Update</button>
            </div>
          </form>
          <?php 
          }
        }
          ?>
        </div>
      </div>
    </div>
  </div>
  <?php
  include('includes/scripts.php');
  include('includes/footer.php');
  ?>