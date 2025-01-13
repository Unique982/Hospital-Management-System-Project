<?php
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');
$select_query = "SELECT * FROM payment
ORDER BY payment_id DESC ";
$result = mysqli_query($conn, $select_query);
$count = mysqli_num_rows($result);

?>

<div class="container-fluid">
    <!-- DataTales Example -->             
    <div class="card  mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Payment History
              <!-- <a href="invoice_add.php">  <button type="button"  class="btn btn-primary btn-sm">
                    Add Invoice
                </button>
              </a>
                <button type="button"  class="btn btn-primary btn-sm text-start" data-toggle="modal" data-target="#exampleModal1">
                 Show Qr for Payment
                </button> -->
              
            </h6>
        </div>
        <div class="card-body">
       <!-- Php code -->
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Invoice Id</th>
                            <th>Transcation Id</th>
                            <th>Patient Name</th>
                            <th>payment Type</th>
                            <th>Payment Method</th>
                            <th>Amount</th>
                            <th>Date/ Time</th>
                           
                          
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php 
                            $sn = +1;
                            if($count >0 ){
                            while($row = mysqli_fetch_assoc($result)){
                           ?>
                            <td><?php echo $sn; ?></td>
                            <td><?php echo $row['invoice_id'] ?></td>
                            <td><?php echo $row['transaction_id'] ?></td>
                            <td><?php echo $row['patient_id'] ?></td>
                            <td><?php echo $row['payment_type'] ?></td>
                            <td><?php echo $row['payment_method'] ?></td>
                            <td><?php echo $row['amount'] ?></td>
                           
                            <td><?php echo date('Y-m-d H:i:s', strtotime( $row['time'])) ?></td>
                        </tr>
                        <?php 
                        $sn++;
                            }
                        }
                        else{
                            echo "<tr><td colspan='7' class='text-center'>No Date Found</td></tr>";
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