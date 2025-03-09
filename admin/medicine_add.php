<?php
ob_start();
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');

if(!isset($_SESSION['id'])){
  header('location:index.php');
}

$errors = [
  'Med_name' =>'',
  'Med_category' =>'',
  'Med_description' =>'',
  'Med_price' =>'',
  'Mf_company' =>'',
  'Mf_date' =>'',
  'Stock' =>''
];


if (isset($_POST['add_med'])) {
  $med_name = mysqli_real_escape_string($conn, $_POST['med_name']);
  $med_category =isset($_POST['med_category'])? mysqli_real_escape_string($conn, $_POST['med_category']) :'';
  $med_des = mysqli_real_escape_string($conn, $_POST['med_des']);
  $med_price = mysqli_real_escape_string($conn, $_POST['med_price']);
  $mf_company = mysqli_real_escape_string($conn, $_POST['mf_company']);
  $mf_date = mysqli_real_escape_string($conn, $_POST['mf_date']);
  $stock = mysqli_real_escape_string($conn, $_POST['stock']);
  


  if(empty($med_name)){
    $errors['Med_name'] = "Enter Medicine Name";
  }
  elseif(!preg_match('/^[a-zA-Z0-9\s]+$/',$med_name)){
  $errors['Med_name'] = "Only letter and number are allowed";
  }

  // validation med Category is required
  if(empty($med_category) || $med_category==='Select Medicine Category'){
  $errors['Med_category'] = "Category is required";
  }

  // description is requried
  if(empty($med_des)){
 $errors['Med_description'] = "Description is required";
  }
  elseif(!preg_match('/^[a-zA-Z\s\x{0900}-\x{097F}]+$/u',$med_des)){
    $errors['Med_description'] = "Only letter and  number are allowed";
  }
  elseif(strlen($med_des) > 1000){
    $errors['Med_description'] ='Description must be at least 1000 characters';
  }
 
  // Price 
  if(empty($med_price)){
    $errors['Med_price'] = 'Price is required';
  }
  elseif(!is_numeric($med_price)){
  $errors['Med_price'] = 'price must be a number';
  }
  elseif($med_price<=0 || $med_price >  10000000){
    $errors['Med_price'] = 'Amount must be greater than 0 and amount cannot exceed 1,000,0000';
  }

  // company validation 
  if(empty($mf_company)){
    $errors['Mf_company'] = 'Company is required';
  }
  elseif(!preg_match('/^[a-zA-Z\s]+$/',$mf_company)){
    $errors['Mf_company'] = 'Only letter or space are allowed';
  }

  // Manufacturing Dates: validation 
  if(empty($mf_date)){
    $errors['Mf_date'] = 'Date is required';
  }
  elseif(!preg_match('/^\d{4}-\d{2}-\d{2}$/',$mf_date)){
   $errors['Mf_date'] = 'Please use YYYY-MM-DD format';
  }
  else {
    list($year, $month,$day) = explode('-',$mf_date);
  if(!checkdate((int)$month,(int)$day,(int)$year)){
$errors['Mf_date'] = "Invalid  date. Please provide a valid date calender date";
  }
}

// stock
if(empty($stock)){
  $errors['Stock'] = "Stock is required";
}
elseif(!preg_match('/^\d+$/',$stock)){
  $errors['Stock'] = "only number allowed";
}
 if(empty(array_filter($errors))){
 
 $insert_query = "INSERT INTO `medicine`(`medicine_name`, `category`, `price`, `description`, `manufacuturin_company`, `manufacuturin_date`, `stock`) VALUES
    ('$med_name','$med_category','$med_price','$med_des','$mf_company','$mf_date','$stock')";
  if (mysqli_query($conn, $insert_query)) {

    $_SESSION['alert'] = "Medicine added sucessfully";
    $_SESSION['alert_code'] = "success";
    header('location:medicine_list.php');
    exit();
  } else {
    $_SESSION['alert'] = "Insert failed";
    $_SESSION['alert_code'] = "warning";
  }
}
}
ob_end_flush();
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
              <input type="text" name="med_name" class="form-control" placeholder="Enter Medicine Name" value="<?php echo isset($med_name) ? $med_name:'';?>">
         <span style='color:red;'><?php echo $errors['Med_name'] ?></span>
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
              <span style='color:red;'><?php echo $errors['Med_category'] ?></span>
            </div>
            <div class="form-group">
              <label for="">Description</label>
              <textarea name="med_des" id="med_des" class="form-control" placeholder="Enter Description"><?php echo isset($med_des) ? $med_des:'';?></textarea>
              <span style='color:red;'><?php echo $errors['Med_description'] ?></span>
            </div>
            <div class="form-group">
              <label for="">Price</label>
              <input type="number" name="med_price" class="form-control" placeholder="Enter Price" value="<?php echo isset($med_price) ? $med_price:'';?>">
              <span style='color:red;'><?php echo $errors['Med_price'] ?></span>
            </div>
            <div class="form-group">
              <label for="">Manufacturing Company</label>
              <input type="text" name="mf_company" class="form-control" placeholder="Enter Manufacturing Company" value="<?php echo isset($mf_company) ? $mf_company:'';?>">
              <span style='color:red;'><?php echo $errors['Mf_company'] ?></span>
            </div>
            <div class="form-group">
              <label for="">Manufacturing Dates</label>
              <input type="date" name="mf_date" class="form-control" placeholder="Enter MedicineName"  value="<?php echo isset($mf_date) ? $mf_date:'';?>">
              <span style='color:red;'><?php echo $errors['Mf_date'] ?></span>
            </div>
            <div class="form-group">
              <label for="">Stock</label>
              <input type="number" name="stock" class="form-control" placeholder="Enter Stock" value="<?php echo isset($stock) ? $stock:'';?>">
              <span style='color:red;'><?php echo $errors['Stock'] ?></span>
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