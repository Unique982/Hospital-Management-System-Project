<?php
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');
$invoice_id= $_GET['invoice_id'];
$select_query = "SELECT i.invoice_id, i.invoice_num, p.name AS patient_id, i.title, i.payment_method, i.amount, i.payment_status, i.invoice_date 
FROM invoice  i
INNER JOIN patient p on i.patient_id = p.id
WHERE invoice_id= '$invoice_id'";
$result = mysqli_query($conn, $select_query);
if(mysqli_num_rows($result)>0){
    $record = mysqli_fetch_array($result);
?>

<div class="container-fluid">
    <!-- DataTales Example -->                               
    <div class="card  mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Medicine Category Infromation
              <a href="invoice_add.php">  <button type="button"  class="btn btn-primary mr-2" data-toggle="modal" data-target="#exampleModal">
                   Add New Invoice
                </button>
                </a>
            </h6>
        </div>
        <div class="card-body">
       <!-- Php code -->
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <input type="hidden"  value="<?php echo $record['invoice_id'] ?>"> 
                    <tr>
                        <th>Invoice Number</th>
                        <td><?php echo $record['invoice_num'];?></td>
                    </tr>
                    <tr>
                        <th>Patient Name:</th>
                        <td><?php echo $record['patient_id'];?></td>
                    </tr>
                    <tr>
                        <th>Title:</th>
                        <td><?php echo $record['title'];?></td>
                    </tr>
                    
                    <tr>
                        <th>Amount:</th>
                        <td><?php echo $record['amount'];?></td>
                    </tr>
                    <tr>
                        <th>Payment Method</th>
                        <td><?php echo $record['payment_method'];?></td>
                    </tr>
                    <tr>
                        <th>Payment Status:</th>
                        <td><?php echo $record['payment_status'];?></td>
                    </tr>
                    
                    
                   <td colspan="2">
                   <a href="invoice_list.php"><button class="btn btn-outline-success w-40">Go Back</button></a>
</td>

                        <?php 
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