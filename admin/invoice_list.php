<?php
ob_start();
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');

if(!isset($_SESSION['id'])){
    header('location:index.php');
}

$user_type = $_SESSION['user_data']['role'];
$user_id = $_SESSION['id'];
if ($user_type == 'admin' || $user_type =='accountant') {

    $select_query = "SELECT i.invoice_id, i.invoice_num,i.patient_id, pt.name as patient_name , i.title, i.payment_method, i.amount, i.payment_status, i.invoice_date 
    FROM invoice  i
    INNER JOIN patient pt on i.patient_id = pt.id
   ";
} elseif ($user_type == 'patient') {

    $select_query = "SELECT i.invoice_id, i.invoice_num, i.patient_id, pt.user_id ,pt.name as patient_name, i.title, i.payment_method, i.amount, i.payment_status, i.invoice_date 
FROM invoice  i
INNER JOIN patient pt on i.patient_id = pt.id
WHERE pt.user_id=$user_id ORDER BY i.invoice_id DESC";
}

$result = mysqli_query($conn, $select_query);
$count = mysqli_num_rows($result);
ob_end_flush();

?>
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Scan the QR Code to Pay</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <img src="../assets/images/Untitled.png" alt="Scan QR to Pay" style="width: 300px; height: 300px; margin-bottom:20px;">
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
            </form>
        </div>
    </div>
</div>
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card  mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Invoice List

                <?php if ($user_type == 'admin' || $user_type == 'accountant') { ?>
                    <a href="invoice_add.php"> <button type="button" class="btn btn-primary btn-sm">
                            Add Invoice
                        </button>
                    </a>
                    <button type="button" class="btn btn-primary btn-sm text-start" data-toggle="modal" data-target="#exampleModal1">
                        Show Qr for Payment
                    </button>
                <?php  } ?>
            </h6>
        </div>
        <div class="card-body">
            <!-- Php code -->
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Invoice No</th>
                            <th>Patient Name</th>
                            <th>Title</th>
                            <th>Amount</th>
                            <th>Payment Method</th>
                            <th>Payment Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $sn = 1;
                        if ($count > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?><tr>
                                    <td><?php echo $sn; ?></td>
                                    <td><?php echo $row['invoice_num'] ?></td>
                                    <td><?php echo $row['patient_name'] ?></td>
                                    <td><?php echo $row['title'] ?></td>
                                    <td><?php echo $row['amount'] ?></td>
                                    <td><?php echo $row['payment_method'] ?></td>

                                    <td>

                                        <?php if ($row['payment_status'] == 'unpaid') { ?>

                                            <span class="badge badge-danger">Unpaid</span>
                                            <?php if ($user_type == 'admin' || $user_type == 'accountant') { ?>
                                                <form action="verify_payment.php" method="POST" style="display: inline;">
                                                    <input type="hidden" name="payment_id" value="<?php echo $row['invoice_id']; ?>">
                                                    <input type="hidden" name="title" value="<?php echo $row['title']; ?>">
                                                    <input type="hidden" name="invoice_id" value="<?php echo $row['invoice_id']; ?>">
                                                    <input type="hidden" name="patient_id" value="<?php echo $row['patient_id'] ?>">
                                                    <input type="hidden" name="amount" value="<?php echo $row['amount']; ?>">
                                                    <input type="hidden" name="payment_method" value="<?php echo $row['payment_method']; ?>">
                                                    <input type="hidden" name="transcation_id">
                                                    <input type="submit" name="save" value="Payment Vriefy" class="btn btn-gray btn-mini"
                                                        onclick="return confirm('Are you sure you want to mark this payment as paid?');">
                                                </form>
                                            <?Php } ?>
                                        <?php } else { ?>
                                            <span class="badge badge-success">Paid</span>
                                        <?php }
                                        ?>
                                    </td>
                                    <?php if ($user_type == 'admin' || $user_type =='accountant') { ?>
                                        <td><a href="invoice_view.php?invoice_id=<?php echo $row['invoice_id'] ?>"><button type="button" class="btn btn-outline-warning btn-sm">View</button></a>
                                            <a href="invoice_edit.php?invoice_id=<?php echo $row['invoice_id'] ?>" class="btn btn-outline-success btn-sm">Edit</a>
                                            <form action="invoice_delete.php" method="POST" id="deleteForm" style="display:inline-block; margin:2px;">
                                                <input type="hidden" name="invoice_id" value="<?php echo $row['invoice_id'] ?>" class="delete_id">
                                                <button type="submit" name="delete" class="btn btn-outline-danger btn-sm deletebtn" data-delete-url="invoice_delete.php">Delete</button>
                                            </form>
                                        </td>

                                    <?php } elseif ($user_type == 'patient') { ?>
                                        <td>
                                            <?php if ($row['payment_status'] == 'unpaid') { ?>
                                                <?php
                                                // Define the secret key 
                                                $secret_key = "8gBm/:&EnhH.1/q";
                                                

                                                // Values that you want to use in the signature
                                                $total_amount = $row['amount'];  // Example total amount
                                                $transaction_uuid = uniqid('txn_') . time(); 
                                                 // Unique transaction UUID based on current time and unique identifier
                                                $product_code = "EPAYTEST";  // Example product code
                                                $server_charge = 0;
                                                // Prepare the signature string
                                                $signature_string = "total_amount={$row['amount']},transaction_uuid={$transaction_uuid},product_code={$product_code}";

                                                // Generate the HMAC SHA256 hash with the secret key
                                                $signature_hash = hash_hmac('sha256', $signature_string, $secret_key, true);

                                                // Base64 encode the hash to get the signature
                                                $signature_base64 = base64_encode($signature_hash);
                                                
                                                $success_url = "http://localhost/Project%20List/Hospital%20Management%20System%20Project/admin/esewa_success.php?id=". urlencode($row['invoice_id']);
                                                $failure_url ="http://localhost/Project%20List/Hospital%20Management%20System%20Project/admin/failure_url.php";


                                                ?>
                                                <form action="https://rc-epay.esewa.com.np/api/epay/main/v2/form" method="POST">
                                                  
                                                    <input type="hidden" name="payment_id">
                                                    <input type="hidden" name="title" value="<?php echo htmlspecialchars($row['title']); ?>">
                                                    <input type="hidden" name="invoice_id" value="<?php echo htmlspecialchars($row['invoice_id']); ?>">
                                                    <input type="hidden" name="patient_id" value="<?php echo htmlspecialchars($row['patient_id']) ?>">
                                                    <input type="hidden" name="payment_method" value="<?php echo htmlspecialchars($row['payment_method']); ?>">                                    
                                                    <input type="hidden" id="amount" name="amount" value="<?php echo htmlspecialchars($total_amount); ?>" required>
                                                    <input type="hidden" id="tax_amount" name="tax_amount" value="0" required>
                                                    <input type="hidden" id="total_amount" name="total_amount" value="<?php echo htmlspecialchars($total_amount); ?>" required>
                                                    <!-- Use the dynamically generated transaction_uuid -->
                                                    <input type="hidden" id="transaction_uuid" name="transaction_uuid" value="<?php echo htmlspecialchars($transaction_uuid); ?>" required>
                                                    <input type="hidden" id="product_code" name="product_code" value="EPAYTEST" required>
                                                    <input type="hidden" id="product_service_charge" name="product_service_charge" value="<?php echo   $server_charge  ?>" required>
                                                    <input type="hidden" id="product_delivery_charge" name="product_delivery_charge" value="0" required>
                                                    <input type="hidden" id="success_url" name="success_url" value="<?php echo  $success_url ?>" required>
                                                    <input type="hidden" id="failure_url" name="failure_url" value="<?php echo $failure_url ?>" required>
                                                    <input type="hidden" id="signed_field_names" name="signed_field_names" value="total_amount,transaction_uuid,product_code" required>
                                                    <!-- Dynamically generate and add the signature -->
                                                    <input type="hidden" id="signature" name="signature" value="<?php echo htmlspecialchars($signature_base64); ?>" required>
                                                    <input value="Take Payment" type="submit" class="btn btn-primary" name="add_payment">
                                                </form>

                                            <?php

                                            } else { ?>

                                                <span class="badge badge-success">Paid</span>

                                            <?php       }
                                            ?>
                                        </td>
                                    <?php }  ?>
                                </tr>
                        <?php
                                $sn++;
                            }
                        } else {
                            echo "<tr><td colspan='8'class='text-center'>Not Data Found</td></tr>";
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