<?php
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');
$user_type = $_SESSION['user_data']['role'];
$user_id = $_SESSION['id'];
if($user_type=='admin' || $user_type=='accountant'){
$select_query = "SELECT i.invoice_id,  p.invoice_id, pt.name,  p.transaction_id,
p.payment_method,p.amount,p.time,p.payment_type,i.payment_status FROM payment  as p
 LEFT JOIN invoice as i ON p.invoice_id = i.invoice_id
 LEFT JOIN patient as pt on p.patient_id = pt.id
 ORDER BY p.payment_id  DESC
 ";}
elseif($user_type=='patient'){
    $select_query = "SELECT i.invoice_id,  p.invoice_id, pt.name,  p.transaction_id,
p.payment_method,p.amount,p.time,p.payment_type,i.payment_status, pt.user_id FROM payment  as p
 LEFT JOIN invoice as i ON p.invoice_id = i.invoice_id
 LEFT JOIN patient as pt on p.patient_id = pt.id 

 WHERE p.patient_id=$user_id
 ORDER BY p.payment_id  DESC
 ";
}
$result = mysqli_query($conn, $select_query);                
$count = mysqli_num_rows($result);

?>

<div class="container-fluid">
    <!-- DataTales Example -->             
    <div class="card  mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Payment History
              
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
                            <td><?php echo $row['name'] ?></td>
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
                            echo "<tr><td colspan='8' class='text-center'>No Date Found</td></tr>";
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