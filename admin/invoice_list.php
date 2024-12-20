<?php
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');
$select_query = "SELECT i.invoice_id, i.invoice_num, p.name AS patient_id, i.title, i.payment_method, i.amount, i.payment_status, i.invoice_date 
FROM invoice  i
INNER JOIN patient p on i.patient_id = p.patient_id
ORDER BY i.invoice_id DESC ";
$result = mysqli_query($conn, $select_query);
$count = mysqli_num_rows($result);
if($count){
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
              <a href="invoice_add.php">  <button type="button"  class="btn btn-primary btn-sm">
                    Add Invoice
                </button>
              </a>
                <button type="button"  class="btn btn-primary btn-sm text-start" data-toggle="modal" data-target="#exampleModal1">
                 Show Qr for Payment
                </button>
              
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
                        <tr>
                            <?php 
                            $sn = +1;
                            while($row = mysqli_fetch_assoc($result)){

                           
                           ?>
                            <td><?php echo $sn; ?></td>
                            <td><?php echo $row['invoice_num'] ?></td>
                            <td><?php echo $row['patient_id'] ?></td>
                            <td><?php echo $row['title'] ?></td>
                            <td><?php echo $row['amount'] ?></td>
                            <td><?php echo $row['payment_method'] ?></td>
                            <td>
                                
    <?php if ($row['payment_status'] == 'unpaid') { ?>
        <span class="badge badge-danger">Unpaid</span>
        <form action="verify_payment.php" method="POST" style="display: inline;">
            <input type="hidden" name="payment_id" value="<?php echo $row['invoice_id']; ?>">
            <input type="hidden" name="title" value="<?php echo $row['title']; ?>">
            <input type="hidden" name="invoice_num" value="<?php echo $row['invoice_num']; ?>">
            <input type="hidden" name="patient_id" value="<?php echo $row['patient_id'] ?>">
            <input type="hidden" name="amount" value="<?php echo $row['amount']; ?>">
            <input type="hidden" name="payment_method" value="<?php echo $row['payment_method']; ?>">
            <input type="hidden" name="transcation_id">
            <input type="submit" name="save" value="Payment Vriefy" class="btn btn-gray btn-mini" 
                   onclick="return confirm('Are you sure you want to mark this payment as paid?');">
        </form>
    <?php } else { ?>
        Paid
    <?php } ?>
</td>

                            <td><a href="invoice_view.php?invoice_id=<?php echo $row['invoice_id'] ?>"><button type="button" class="btn btn-outline-warning btn-sm">View</button></a>
                          <a href="invoice_edit.php?invoice_id=<?php echo $row['invoice_id'] ?>" class="btn btn-outline-success btn-sm">Edit</a>     
                          <form action="invoice_delete.php" method="POST" id="deleteForm" style="display:inline-block; margin:2px;">
                              <input type="hidden" name="invoice_id" value="<?php echo $row['invoice_id'] ?>" class="delete_id">
                              <button type="submit" name="delete" class="btn btn-outline-danger btn-sm deletebtn" data-delete-url="invoice_delete.php">Delete</button>
                              </form> 

                            </td>
                        </tr>
                        <?php 
                        $sn++;
                            }
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