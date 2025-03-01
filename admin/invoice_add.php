<?php
ob_start();
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');


 $errors = [
    'patient' => '',
    'title' => '',
    'amount' =>'',
    'payment_status' => '',
    'payment_method' => '',

 ];


if(isset($_POST['save'])){
    $patient = mysqli_real_escape_string($conn,$_POST['patient']);
    $in_title = mysqli_real_escape_string($conn,$_POST['in_title']);
    $amount = mysqli_real_escape_string($conn,$_POST['amount']);
    $payment_method = isset($_POST['payment_method']) ? mysqli_real_escape_string($conn,trim($_POST['payment_method'])):'';
    $payment_status = isset($_POST['payment_status']) ? mysqli_real_escape_string($conn,trim($_POST['payment_status'])):''; 
    $invoice_number = rand(100000,999999);
 
    // validation Patient 
    if(empty($patient)|| $patient==='Select Patient Name'){
        $errors['patient'] = 'Patient filled is required';
    }
    // title validation 
    if(empty($in_title)){
        $errors['title'] = 'Title is required';
    }
    elseif(!preg_match('/^[a-zA-Z\s]+$/',$in_title)){
        $errors['title'] = 'Title must contain only letter or space';
    }
    elseif(strlen($in_title)>50){
        $errors['title'] = 'Title must be at least 50 characters';
    }
// amount validation 
    if(empty($amount)){
        $errors['amount'] = 'Amount is required';
    }
    elseif(!is_numeric($amount)){
        $errors['amount'] = 'Amount must be a valid number';
    }
    elseif($amount <= 0 || $amount > 10000000){
        $errors['amount'] = 'Amount must be greater than 0 and amount cannot exceed 1,000,0000';
    }
    // payment status validation
     if(empty($payment_status) || $payment_status==='Select Payment Status'){
        $errors['payment_status'] = 'Payment status must be required';
     }
     if(empty($payment_method) || $payment_method==='Select Payment Method'){
        $errors['payment_method'] = 'Payment method must be required';
     }

     if (empty(array_filter($errors))) {
            $insert_query = "INSERT INTO `invoice`(`invoice_num`, `patient_id`, `title`,`payment_method`,`amount`,`payment_status`, `invoice_date`) 
             VALUES ('$invoice_number','$patient','$in_title','$payment_method','$amount','$payment_status',Now())";
   if(mysqli_query($conn,$insert_query)){
    $_SESSION['alert'] ="Invoice Successfully";
    $_SESSION['alert_code'] ="info";
    header('location:invoice_list.php');
    exit();
   }
   else{
   $_SESSION['alert'] ="invoice Failed";
   $_SESSION['alert_code'] ="warning";
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
                    Add Invoice
                </div>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                  
                        <div class="form-group">
                            <label for=""> Patient</label>
                            <select name="patient" id="patient" class="form-control">
                                <option selected>Select Patient Name</option>
                                <?php 
                    $select_query_patient_table = "SELECT * FROM patient";
                    $result = mysqli_query($conn,$select_query_patient_table);
                    while($row = mysqli_fetch_assoc($result)){
                    
                        echo "<option value='".$row['id']."'>".$row['name']."</option>";
                    
            }
                  ?>
                </select>
                <span style='color:red' ;><?php echo $errors['patient'] ?></span>
                        </div>
                        <div class="form-group">
                        <label for="">Title</label>
                       <input type="text" name="in_title" class="form-control" value="<?php echo isset($in_title) ? $in_title:''; ?>">
                       <span style='color:red' ;><?php echo $errors['title'] ?></span>
                        </div>
                        <div class="form-group">
                            <label for="">Amount</label>
                       <input type="number" name="amount" class="form-control" value="<?php echo isset($amount) ? $amount:'' ?>">
                       <span style='color:red' ;><?php echo $errors['amount'] ?></span>
                        </div>
                        <div class="form-group">
                            <label for="">Payment Method</label>
                            <select name="payment_method" id="" class="form-control">
                            <option selected >Select Payment Method</option>
                            <option value="cash" <?php echo isset($payment_method) && $payment_method =='cash' ? 'selected':'';  ?>>Cash</option>
                            <option value="card" <?php echo isset($payment_method) && $payment_method=='card' ? 'selected':''; ?>>Card</option>
                            <option value="online" <?php echo isset($payment_method) && $payment_method=='online' ? 'selected':'' ; ?>>Online</option>
                            <option value="insurance" <?php echo isset($payment_method) && $payment_method=='insurance' ? 'selected':''; ?>>Insurance</option>
                            </select>
                            <span style='color:red' ;><?php echo $errors['payment_method'] ?></span>
                        </div>
                        <div class="form-group">
                            <label for="">Payment Status</label>
                            <select name="payment_status" id="" class="form-control">
                            <option selected>Select Payment Status</option>
                            <option value="paid" <?php  echo isset($payment_status) && $payment_status =='paid' ? 'selected':'';?>>Paid</option>
                            <option value="unpaid" <?php echo isset($payment_status) && $payment_status=='unpaid' ? 'selected':''; ?>>Unpaid</option>    
                            </select>
                            <span style='color:red' ;><?php echo $errors['payment_status'] ?></span>
                        </div>

                        <div class="form-group">
                            <button type="submit" name="save" class="btn btn-primary btn-md">Save</button>
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