<?php
ob_start();
require_once("includes/header.php");
require_once("includes/navbar.php");
include('../database/config.php');
$errors = [
  'notice_title' => '',
  'notice' => ''
];
if (isset($_POST['update'])) {
    $notice_id = mysqli_real_escape_string($conn, $_POST['notice_id']);
  $notice_title = mysqli_real_escape_string($conn,$_POST['notice_title']);
  $notice = mysqli_real_escape_string($conn,$_POST['notice']);

// validation 
if(empty($notice_title)){
  $errors['notice_title'] = 'Title is required';
 }
 elseif(!preg_match('/^[a-zA-Z\s\x{0900}-\x{097F}]+$/u',$notice_title)){
 $errors['notice_title'] = 'Title must contain  english or nepali language';
}
elseif(strlen($title) > 30){
  $errors['notice_title'] = 'Title must be at least 30 characters';
}

// validation description
if(empty($notice)){
  $errors['notice'] = 'Notice is required';
 }
 elseif(!preg_match('/^[a-zA-Z\s\x{0900}-\x{097F}]+$/u',$notice)){
 $errors['notice'] = 'Notice must contain  english or nepali language';
}
elseif(strlen($notice) > 1000){
  $errors['notice'] = 'Notice must be at least 1000 characters';
}
if (empty(array_filter($errors))) {


 $update_query = "UPDATE notice_board SET notice_title = '$notice_title',notice='$notice' WHERE notice_id = '$notice_id'";
  if (mysqli_query($conn, $update_query)) {

    $_SESSION['alert'] = "Notice added sucessfully";
    $_SESSION['alert_code'] = "success";
    header('locatio:notice_board_list.php');
    exit();
  } else {
    $_SESSION['alert'] = "failed";
    $_SESSION['alert_code'] = "warning";
  }
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
                 $notice_id = $_GET['notice_id'];
                 $select_query = "SELECT * FROM notice_board where notice_id = $notice_id";
                 $result = mysqli_query($conn, $select_query) or die("Query failed");
                
                if(mysqli_num_rows($result)>0){
                    while($record = mysqli_fetch_assoc($result)){ 
                ?>
        <div class="card-body">
          <form action="" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="notice_id" value="<?php echo $record['notice_id'] ?>">
            <div class="form-group">
              <label for="">Title</label>
              <input type="text" name="notice_title" value="<?php echo $record['notice_title'] ?>" class="form-control" placeholder="Enter Title">
              <span style='color:red' ;><?php echo $errors['notice_title'] ?></span>
            </div>
            <div class="form-group">
              <label for="">Notice</label>
            <textarea name="notice" id="notice" class="form-control" placeholder="Enter Notice"><?php echo $record['notice'] ?></textarea>
            <span style='color:red' ;><?php echo $errors['notice'] ?></span>  
          </div>
            <div class="form-group">
              <button type="submit" name="update" class="btn btn-outline-primary">Update</button>
            </div>
          </form>
          <?php } }?>
        </div>
      </div>
    </div>
  </div>
  <?php
  include('includes/scripts.php');
  include('includes/footer.php');
  ?>