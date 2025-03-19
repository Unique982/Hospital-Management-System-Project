<?php 
ob_start();
include("includes/header.php");
include("includes/navbar.php");

if(!isset($_SESSION['id'])){
   header('location:index.php');
}

$user_type = $_SESSION['user_data']['role'];
$user_id = $_SESSION['id'];  
ob_end_flush();
?>


<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary">
            <i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <div class="row">
        <?php if($user_type=='admin'){ ?>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <?php $total_number = "SELECT Count(*) AS total_doctor From user_tbl WHERE role='doctor'";
                        $result =mysqli_query($conn,$total_number) or die("Query faileds");
                        if(mysqli_num_rows($result)){
                            $row = mysqli_fetch_array($result);
                            $total_doctor = $row['total_doctor'];
                        }else{
                            $total_doctor = 0;// no record found
                           
                        }
                         ?>    
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            
                            Total Doctor</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_doctor; ?></div>
                        </div>
                        <div class="col-auto">
                        <i class="fas fa-user-md fa-2x text-gray-300"></i>
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <?php $total_number = "SELECT Count(*) AS total_nurse From user_tbl WHERE role='nurse'";
                        $result =mysqli_query($conn,$total_number) or die("Query faileds");
                        if(mysqli_num_rows($result)){
                            $row = mysqli_fetch_array($result);
                            $total_nurse = $row['total_nurse'];
                        }else{
                            $total_nurse = 0;// no record found
                           
                        }
                         ?>        
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                           Total Nurse</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_nurse ?>+</div>
                        </div>
                        <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <?php $total_number = "SELECT Count(*) AS total_pharamacist From user_tbl WHERE role='pharmacist'";
                        $result =mysqli_query($conn,$total_number) or die("Query faileds");
                        if(mysqli_num_rows($result)){
                            $row = mysqli_fetch_array($result);
                            $total_pharamacist = $row['total_pharamacist'];
                        }else{
                            $total_pharamacist = 0;// no record found
                           
                        }
                         ?>       
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total pharmacist</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_pharamacist ?></div>
                        </div>
                        <div class="col-auto">
                        <i class="fas fa-user-md fa-2x text-gray-300"></i>
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <?php $total_number = "SELECT Count(*) AS total_accountant From user_tbl WHERE role='accountant'";
                        $result =mysqli_query($conn,$total_number) or die("Query faileds");
                        if(mysqli_num_rows($result)){
                            $row = mysqli_fetch_array($result);
                            $total_accountant = $row['total_accountant'];
                        }else{
                            $total_accountant = 0;// no record found
                           
                        }
                         ?>    
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                          Accountant</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_accountant ?>+</div>
                        </div>
                        <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Earnings (Annual) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <?php $total_number = "SELECT Count(*) AS total_patient From patient ";
                        $result =mysqli_query($conn,$total_number) or die("Query faileds");
                        if(mysqli_num_rows($result)){
                            $row = mysqli_fetch_array($result);
                            $total_patient = $row['total_patient'];
                        }else{
                            $total_patient = 0;// no record found
                           
                        }
                         ?> 
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                          Total  Patient</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_patient ?>+</div>
                        </div>
                        <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <?php $total_number = "SELECT Count(*) AS total_laboratorist From user_tbl WHERE role='laboratorist'";
                        $result =mysqli_query($conn,$total_number) or die("Query faileds");
                        if(mysqli_num_rows($result)){
                            $row = mysqli_fetch_array($result);
                            $total_laboratorist = $row['total_laboratorist'];
                        }else{
                            $total_laboratorist = 0;// no record found
                           
                        }
                         ?> 
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Laboratorist</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_laboratorist ?>+</div>
                        </div>
                        <div class="col-auto">
                        <i class="fas fa-user-md fa-2x text-gray-300"></i>
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tasks Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <?php $total_number = "SELECT Count(*) AS total_appointments From appointments";
                        $result =mysqli_query($conn,$total_number) or die("Query faileds");
                        if(mysqli_num_rows($result)){
                            $row = mysqli_fetch_array($result);
                            $total_appointments = $row['total_appointments'];
                        }else{
                            $total_appointments = 0;// no record found
                           
                        }
                         ?> 
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Appointments
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $total_appointments ?>%</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-danger" role="progressbar"
                                            style="width:<?php echo $total_appointments ?>%" aria-valuenow="<?php echo $total_appointments ?>" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <?php $total_number = "SELECT Count(*) AS total_appointments From appointments  WHERE status='confirmed'";
                        $result =mysqli_query($conn,$total_number) or die("Query faileds");
                        if(mysqli_num_rows($result)){
                            $row = mysqli_fetch_array($result);
                            $total_con = $row['total_appointments'];
                        }else{
                            $total_con = 0;// no record found
                           
                        }
                         ?> 
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Appointment Requests Comfirmed</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_con ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div></div><!-- End of Annual Sectoion-->



        <!-- Doctor view Dashboard -->
            <?php }
            if($user_type=='doctor'){
            
            ?><!-- Doctor Appointments  Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary  shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                            <?php $total_number = "SELECT Count(*) AS total_appointments From 
                            appointments INNER JOIN doctors ON appointments.doctor_id= doctors.id
                             WHERE  doctors.user_id='$user_id'";
                            $result =mysqli_query($conn,$total_number) or die("Query faileds");
                            if(mysqli_num_rows($result)){
                                $row = mysqli_fetch_array($result);
                                $total_con = $row['total_appointments'];
                            }else{
                                $total_con = 0;// no record found
                               
                            }
                             ?> 
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Appointment Requests</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_con ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <?php $total_number = "SELECT Count(*) AS total_appointments, DATE(appointment_date) as appointment_date  From 
                            appointments INNER JOIN doctors ON appointments.doctor_id= doctors.id
                             WHERE doctors.user_id='$user_id'
                             GROUP BY DATE(appointment_date)";
                            $result =mysqli_query($conn,$total_number) or die("Query faileds");
                            if(mysqli_num_rows($result)){
                                $row = mysqli_fetch_array($result);
                                $total_con = $row['total_appointments'];
                            }else{
                                $total_con = 0;// no record found
                               
                            }
                             ?> 
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Appointment Per Day</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_con ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                            <?php $total_number = "SELECT Count(*) AS total_appointments, WEEK(appointment_date) as appointment_date  From 
                            appointments INNER JOIN doctors ON appointments.doctor_id= doctors.id
                             WHERE doctors.user_id='$user_id'
                             GROUP BY WEEK(appointment_date)";
                            $result =mysqli_query($conn,$total_number) or die("Query faileds");
                            if(mysqli_num_rows($result)){
                                $row = mysqli_fetch_array($result);
                                $total_con = $row['total_appointments'];
                            }else{
                                $total_con = 0;// no record found
                               
                            }
                             ?> 
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Appointment Per Week</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_con ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-dark shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                            <?php $total_number = "SELECT Count(*) AS total_appointments, MONTH(appointment_date) as appointment_date  From 
                            appointments INNER JOIN doctors ON appointments.doctor_id= doctors.id
                             WHERE doctors.user_id='$user_id'
                             GROUP BY MONTH(appointment_date)";
                            $result =mysqli_query($conn,$total_number) or die("Query faileds");
                            if(mysqli_num_rows($result)){
                                $row = mysqli_fetch_array($result);
                                $total_con = $row['total_appointments'];
                            }else{
                                $total_con = 0;// no record found
                               
                            }
                             ?> 
                                <div class="text-xs font-weight-bold text-Dark text-uppercase mb-1">
                                Total Appointment Last Month</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_con ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        

        </div>
        </div>
        
                
                <?phP  } 
                if($user_type==='patient'){?>
             <div class="col-md-4 mb-3">
                <div class="card border-left-success  h-100">
                    <div class="card-header text-xs font-weight-bold text-primary text-uppercase mb-1">Upcoming Request</div>
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                            <ul>
                                <li><strong>Dr. Smith</strong> - 5th March, 2025 at 10:00 AM</li>
                                <li><strong>Dr. Johnson</strong> - 10th March, 2025 at 2:00 PM</li>
                            </ul>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card border-left-primary  h-100">
                    <div class="card-header text-xs font-weight-bold text-primary text-uppercase mb-1">Complete Appointment</div>
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                            <ul>
                                <li><strong>Dr. Smith</strong> - 5th March, 2025 at 10:00 AM</li>
                                <li><strong>Dr. Johnson</strong> - 10th March, 2025 at 2:00 PM</li>
                            </ul>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
           
            <div class="col-md-4 mb-3">
                <div class="card border-left-danger  h-100">
                    <div class="card-header text-xs font-weight-bold text-primary text-uppercase mb-1">Prescriptions</div>
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                            <p class="card-text">Check your latest prescriptions.</p>
                            <a href="prescriptions.php" class="btn btn-light">View Prescriptions</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 mb-3">
                <div class="card border-left-danger  h-100">
                    <div class="card-header text-xs font-weight-bold text-primary text-uppercase mb-1">view Payment</div>
                    <?php 
                     $select_query = "SELECT i.invoice_id, i.invoice_num, i.patient_id, pt.user_id ,pt.name as patient_name, i.title, i.payment_method, i.amount, i.payment_status, i.invoice_date 
                     FROM invoice  i
                     INNER JOIN patient pt on i.patient_id = pt.id
                     WHERE pt.user_id=$user_id ORDER BY i.invoice_id DESC";
                     $result = mysqli_query($conn, $select_query);
                     $count = mysqli_num_rows($result);
                    ?>
                    <div class="card-body">
                    <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>

                        <tr>
                            <th>#</th>
                            <th>Invoice No</th>
                            <th>Title</th>
                            <th>Amount</th>
                            <th>Payment Status</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $sn = 1;
                        if ($count > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                        <td><?php echo $sn; ?></td>
                        <td><?php echo $row['invoice_num'] ?></td>
                        <td><?php echo $row['title'] ?></td>
                        <td><?php echo $row['amount'] ?></td>
                        <td><?php if ($row['payment_status'] == 'unpaid') { ?>
                        <span class="badge badge-danger">Unpaid</span>
                        <?php } elseif($row['payment_status'] == 'paid'){?>
                        <span class="badge badge-danger">Paid</span>
                        <?php } ?>
                        </td>
                     
                    
                    <?php }} 
                    ?>
                    </tbody>
                </table>    
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card border-left-danger  h-100">
                    <div class="card-header text-xs font-weight-bold text-primary text-uppercase mb-1">Activity Log</div>
                        <div class="row no-gutters align-items-center mb-3">
                            <div class="col mr-2">
                           <ul class="list-group">
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between ">
                                    <span class="font-weight-bold">User</span>
                                    <span class="text-muted">2005-19-18</span>
                                </div>
                                <p class="mb-0">Your Logged in Successfully</p>
                            </li>
                           </ul>
                          
                            
                        </div>
                    </div>
                </div>
            </div>
            
            
            
        </div>
        </div>
              
                
            <?php }  ?>
      
    </div> <!--End container  -->
   
    <?php
    include('includes/scripts.php');
        include("includes/footer.php");
    ?>
