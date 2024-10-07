<?php
require_once("includes/header.php");
require_once("includes/navbar.php");
include('../database/config.php');
if (isset($_POST['add_med'])) {
  $med_name = mysqli_real_escape_string($conn, $_POST['med_name']);
  $med_category = mysqli_real_escape_string($conn, $_POST['med_category']);
  $med_des = mysqli_real_escape_string($conn, $_POST['med_des']);
  $med_price = mysqli_real_escape_string($conn, $_POST['med_price']);
  $mf_company = mysqli_real_escape_string($conn, $_POST['mf_company']);
  $mf_date = mysqli_real_escape_string($conn, $_POST['mf_date']);
  $stock = mysqli_real_escape_string($conn, $_POST['stock']);
  $insert_query = "INSERT INTO `medicine`(`medicine_name`, `category`, `price`, `description`, `manufacuturin_company`, `manufacuturin_date`, `stock`) VALUES
    ('$med_name','$med_category','$med_price','$med_des','$mf_company','$mf_date','$stock')";
  if (mysqli_query($conn, $insert_query)) {

    $_SESSION['alert'] = "Medicine added sucessfully";
    $_SESSION['alert_code'] = "success";
  } else {
    $_SESSION['alert'] = "Insert failed";
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
        <div class="card-body">
          <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label for=""> Medicine Name</label>
              <input type="text" name="med_name" class="form-control" placeholder="Enter Medicine Name">
            </div>
            <div class="form-group">
              <label for=""> Medicine Category</label>
              <select name="med_category" id="" class="form-control">
                <option selected disabled>Select Medicine Category</option>
                <?php $select_query = "select * from medicine_cat";
                $result = mysqli_query($conn, $select_query) or die("Query failed");
                while ($data = mysqli_fetch_assoc($result)) {
                  echo "<option value='" . $data['id'] . "'>" . $data['medicine_name'] . "</option>";
                }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="">Description</label>
              <textarea name="med_des" id="med_des" class="form-control" placeholder="Enter Description"></textarea>
            </div>
            <div class="form-group">
              <label for="">Price</label>
              <input type="number" name="med_price" class="form-control" placeholder="Enter Price">
            </div>
            <div class="form-group">
              <label for="">Manufacturing Company</label>
              <input type="text" name="mf_company" class="form-control" placeholder="Enter Manufacturing Company">
            </div>
            <div class="form-group">
              <label for="">Manufacturing Date</label>
              <input type="date" name="mf_date" class="form-control" placeholder="Enter MedicineName">
            </div>
            <div class="form-group">
              <label for="">Stock</label>
              <input type="number" name="stock" class="form-control" placeholder="Enter Stock">
            </div>
            <div class="form-group">
              <button type="submit" name="add_med" class="btn btn-outline-primary">Add</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <?php
  include('includes/scripts.php');
  include('includes/footer.php');
  ?>