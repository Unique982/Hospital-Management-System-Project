<?php
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');
if(isset($_POST['update'])){
    $invoice_id = mysqli_real_escape_string($conn,$_POST['invoice_id']);
    $patient = mysqli_real_escape_string($conn,$_POST['patient']);
    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $amount = mysqli_real_escape_string($conn,$_POST['amount']);
    $payment_method = mysqli_real_escape_string($conn,$_POST['payment_method']);
    $payment_status = mysqli_real_escape_string($conn,$_POST['payment_status']); 
    // $invoice_number = rand(100000,999999);
   
            $update_query = "UPDATE `invoice` SET `patient_id`='$patient',`title`='$title',
            `payment_method`='$payment_method',`amount`='$amount',`payment_status`='$payment_status' WHERE invoice_id='$invoice_id'";
   if(mysqli_query($conn,$update_query)){
    $_SESSION['alert'] ="Update Successfully";
    $_SESSION['alert_code'] ="info";
   }
   else{
   $_SESSION['alert'] ="Update Failed";
   $_SESSION['alert_code'] ="warning";
}
        }
    

?>
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header">
                    Edit Invoice Information
                </div>
                <?php
                $invoice_id = $_GET['invoice_id'];
                $select_query = "SELECT * FROM invoice WHERE invoice_id = $invoice_id";
                $result = mysqli_query($conn, $select_query) or die("Query Failed");
                if(mysqli_num_rows($result)>0){
                    $row = mysqli_fetch_array($result);
                ?>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                  <input type="hidden" name="invoice_id" value="<?php echo $row['invoice_id'] ?>">
                        <div class="form-group">
                            <label for=""> Patient</label>
                            <select name="patient" id="patient" class="form-control">
                            <?php 
                    $select_query = "SELECT * FROM patient";
                    $result2 = mysqli_query($conn,$select_query);
                    while($record = mysqli_fetch_assoc($result2)){
                     $selected = ($record['patient_id']== $row['patient_id'])? 'selected' : '';
                        echo "<option value='".$record['patient_id']."'$selected>".$record['name']."</option>";
            }
        
              ?>
                </select>
                        </div>
                        <div class="form-group">
                        <label for="">Title</label>
                       <input type="text" name="title" class="form-control" value="<?php echo $row['title'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Amount</label>
                       <input type="number" name="amount" class="form-control" value="<?php echo $row['amount'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Payment Method</label>
                            <select name="payment_method" id="" class="form-control">
                            <option value="cash"<?php echo ($row['payment_method'] =='cash') ?'selected' :''; ?>>Cash</option>
                            <option value="card"<?php echo ($row['payment_method'] =='card') ?'selected' :''; ?>>Card</option>
                            <option value="online"<?php echo ($row['payment_method'] =='online') ?'selected' :''; ?>>Online</option>
                            <option value="insurance" <?php echo ($row['payment_method'] =='insurance') ?'selected' :''; ?>>Insurance</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Payment Status</label>
                            <select name="payment_status" id="" class="form-control">
                            <option value="paid" <?php echo ($row['payment_status'] == 'paid') ? 'selected' : ''; ?>>Paid</option>
                                <option value="unpaid" <?php echo ($row['payment_status'] == 'unpaid') ? 'selected' : ''; ?>>Unpaid</option>
                                <option value="pending" <?php echo ($row['payment_status'] == 'pending') ? 'selected' : ''; ?>>Pending</option>
                            </select>
                        </div>

                        <div class="form-group">
                        <a href="invoice_list.php" class="btn btn-danger">Cancel</a>
                            <button type="submit" name="update" class="btn btn-primary btn-md">Update</button>
                        </div>
                      
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
    <?php }  ?>

    <?php
    include('includes/scripts.php');
    include('includes/footer.php');
    ?>