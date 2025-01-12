<?php
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');
if(isset($_POST['save'])){
    
    $patient = mysqli_real_escape_string($conn,$_POST['patient']);
    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $amount = mysqli_real_escape_string($conn,$_POST['amount']);
    $payment_method = mysqli_real_escape_string($conn,$_POST['payment_method']);
    $payment_status = mysqli_real_escape_string($conn,$_POST['payment_status']); 
    $invoice_number = rand(100000,999999);
   
            $insert_query = "INSERT INTO `invoice`(`invoice_num`, `patient_id`, `title`,`payment_method`,`amount`,`payment_status`, `invoice_date`) 
             VALUES ('$invoice_number','$patient','$title','$payment_method','$amount','$payment_status',Now())";
   if(mysqli_query($conn,$insert_query)){
    $_SESSION['alert'] ="Invoice Successfully";
    $_SESSION['alert_code'] ="info";
   }
   else{
   $_SESSION['alert'] ="invoice Failed";
   $_SESSION['alert_code'] ="warning";
}
        }

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
                                <option selected> Select Patient Name</option>
                                <?php 
                    $select_query_patient_table = "SELECT * FROM patient";
                    $result = mysqli_query($conn,$select_query_patient_table);
                    while($row = mysqli_fetch_assoc($result)){
                    
                        echo "<option value='".$row['patient_id']."'>".$row['name']."</option>";
                    
            }
                  ?>
                </select>
                        </div>
                        <div class="form-group">
                        <label for="">Title</label>
                       <input type="text" name="title" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Amount</label>
                       <input type="number" name="amount" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Payment Method</label>
                            <select name="payment_method" id="" class="form-control">
                            <option selected disabled>Select Payment Method</option>
                            <option value="cash">Cash</option>
                            <option value="card">Card</option>
                            <option value="online">Online</option>
                            <option value="insurance">Insurance</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Payment Status</label>
                            <select name="payment_status" id="" class="form-control">
                            <option selected disabled>Select Payment Status</option>
                            <option value="paid">Paid</option>
                            <option value="unpaid">Unpaid</option>
                            
                            
                            </select>
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