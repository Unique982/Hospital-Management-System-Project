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

if (isset($_POST['update'])) {
    $invoice_id = mysqli_real_escape_string($conn, $_POST['invoice_id']);
    $patient = mysqli_real_escape_string($conn, $_POST['patient']);
    $in_title = mysqli_real_escape_string($conn, $_POST['in_title']);
    $amount = mysqli_real_escape_string($conn, $_POST['amount']);
    $payment_method = mysqli_real_escape_string($conn, $_POST['payment_method']);
    $payment_status = mysqli_real_escape_string($conn, $_POST['payment_status']);
    // $invoice_number = rand(100000,999999);


    // validation Patient 
    if (empty($patient) || $patient === 'Select Patient Name') {
        $errors['patient'] = 'Patient filled is required';
    }
    // title validation 
    if (empty($in_title)) {
        $errors['title'] = 'Title is required';
    } elseif (!preg_match('/^[a-zA-Z\s]+$/', $in_title)) {
        $errors['title'] = 'Title must contain only letter or space';
    } elseif (strlen($in_title) > 50) {
        $errors['title'] = 'Title must be at least 50 characters';
    }
    // amount validation 
    if (empty($amount)) {
        $errors['amount'] = 'Amount is required';
    } elseif (!is_numeric($amount)) {
        $errors['amount'] = 'Amount must be a valid number';
    } elseif ($amount <= 0 || $amount > 10000000) {
        $errors['amount'] = 'Amount must be greater than 0 and amount cannot exceed 1,000,0000';
    }
    // payment status validation
    if (empty($payment_status) || $payment_status === 'Select Payment Status') {
        $errors['payment_status'] = 'Payment status must be required';
    }
    if (empty($payment_method) || $payment_method === 'Select Payment Method') {
        $errors['payment_method'] = 'Payment method must be required';
    }

    if (empty(array_filter($errors))) {
        // check  get old status 
        $payment_status_query = "SELECT payment_status FROM invoice WHERE invoice_id = $invoice_id";
        $payment_status_result = mysqli_query($conn,$payment_status_query);
        $payment_row= mysqli_fetch_assoc($payment_status_result);
        // assigning old value
        $old_payment_status = $payment_row['payment_status'];
// udate query
        $update_query = "UPDATE `invoice` SET `patient_id`='$patient',`title`='$in_title',
            `payment_method`='$payment_method',`amount`='$amount',`payment_status`='$payment_status' WHERE invoice_id=$invoice_id";
        if( mysqli_query($conn,$update_query)){

            if($old_payment_status==='unpaid' && $payment_status ==='paid'){
                // insert query payment table
                $transaction_id = rand(1000000000,9999999999);
              $insert_payment_table = "INSERT INTO `payment`(`payment_type`, `transaction_id`, `invoice_id`, `patient_id`, `payment_method`, `amount`, `time`)
              VALUES ('$in_title','$transaction_id','$invoice_id','$patient','$payment_method','$amount',Now())";
              mysqli_query($conn,$insert_payment_table);
          }
        
       
        if($old_payment_status==='paid' && $payment_status==='unpaid'){
            // delete payment table data
            $delete_query = "DELETE FROM payment WHERE invoice_id= $invoice_id";
            mysqli_query($conn,$delete_query);
            
        }
            $_SESSION['alert'] = "Update Successfully";
            $_SESSION['alert_code'] = "info";
            header('location:invoice_list.php');
            exit();
        } else {
            $_SESSION['alert'] = "Update Failed";
            $_SESSION['alert_code'] = "warning";
        }
        }}
    

ob_end_flush();

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
                if (mysqli_num_rows($result) > 0) {
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
                                    $result2 = mysqli_query($conn, $select_query);
                                    while ($record = mysqli_fetch_assoc($result2)) {
                                        $selected = ($record['id'] == $row['patient_id']) ? 'selected' : '';
                                        echo "<option value='" . $record['id'] . "'$selected>" . $record['name'] . "</option>";
                                    }

                                    ?>
                                </select>
                                <span style='color:red' ;><?php echo $errors['patient'] ?></span>
                            </div>
                            <div class="form-group">
                                <label for="">Title</label>
                                <input type="text" name="in_title" class="form-control" value="<?php echo $row['title'] ?>">
                                <span style='color:red' ;><?php echo $errors['title'] ?></span>
                            </div>
                            <div class="form-group">
                                <label for="">Amount</label>
                                <input type="number" name="amount" class="form-control" value="<?php echo $row['amount'] ?>">
                                <span style='color:red' ;><?php echo $errors['amount'] ?></span>
                            </div>
                            <div class="form-group">
                                <label for="">Payment Method</label>
                                <select name="payment_method" id="" class="form-control">
                                    <option value="cash" <?php echo ($row['payment_method'] == 'cash') ? 'selected' : ''; ?>>Cash</option>
                                    <option value="card" <?php echo ($row['payment_method'] == 'card') ? 'selected' : ''; ?>>Card</option>
                                    <option value="online" <?php echo ($row['payment_method'] == 'online') ? 'selected' : ''; ?>>Online</option>
                                    <option value="insurance" <?php echo ($row['payment_method'] == 'insurance') ? 'selected' : ''; ?>>Insurance</option>
                                </select>
                                <span style='color:red' ;><?php echo $errors['payment_method'] ?></span>
                            </div>
                            <div class="form-group">
                                <label for="">Payment Status</label>
                                <select name="payment_status" id="" class="form-control">
                                    <option value="paid" <?php echo ($row['payment_status'] == 'paid') ? 'selected' : ''; ?>>Paid</option>
                                    <option value="unpaid" <?php echo ($row['payment_status'] == 'unpaid') ? 'selected' : ''; ?>>Unpaid</option>

                                </select>
                                <span style='color:red' ;><?php echo $errors['payment_status'] ?></span>
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