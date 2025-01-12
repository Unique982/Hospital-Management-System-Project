<?php
require_once("includes/header.php");
require_once("includes/navbar.php");
include('../database/config.php');

if (isset($_POST['add'])) {
  $title = mysqli_real_escape_string($conn,$_POST['title']);
  $notice = mysqli_real_escape_string($conn,$_POST['notice']);
 $insert_query = "INSERT INTO `notice_board`(`notice_title`,`notice`,`created_at`) VALUES
    ('$title','$notice',NOW())";
  if (mysqli_query($conn, $insert_query)) {

    $_SESSION['alert'] = "Insert Notice sSucessfully";
    $_SESSION['alert_code'] = "success";
  } else {
    $_SESSION['alert'] = "failed";
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
              <label for="">Title</label>
              <input type="text"  name="title" class="form-control" placeholder="Enter Title">
            </div>
            <div class="form-group">
              <label for="">Notice</label>
            <textarea name="notice" id="notice" class="form-control" placeholder="Enter Notice"></textarea>
            </div>
            <div class="form-group">
              <button type="submit" name="add" class="btn btn-outline-primary">Save</button>
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