<?php
ob_start();
include("includes/header.php");
include("includes/navbar.php");

if (!isset($_SESSION['id'])) {
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
        <?php if ($user_type == 'admin') { ?>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary  h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <?php $total_number = "SELECT Count(*) AS total_doctor From user_tbl WHERE role='doctor'";
                                $result = mysqli_query($conn, $total_number) or die("Query faileds");
                                if (mysqli_num_rows($result)) {
                                    $row = mysqli_fetch_array($result);
                                    $total_doctor = $row['total_doctor'];
                                } else {
                                    $total_doctor = 0; // no record found

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
                <div class="card border-left-success h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <?php $total_number = "SELECT Count(*) AS total_nurse From user_tbl WHERE role='nurse'";
                                $result = mysqli_query($conn, $total_number) or die("Query faileds");
                                if (mysqli_num_rows($result)) {
                                    $row = mysqli_fetch_array($result);
                                    $total_nurse = $row['total_nurse'];
                                } else {
                                    $total_nurse = 0; // no record found

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
                <div class="card border-left-primary h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <?php $total_number = "SELECT Count(*) AS total_pharamacist From user_tbl WHERE role='pharmacist'";
                                $result = mysqli_query($conn, $total_number) or die("Query faileds");
                                if (mysqli_num_rows($result)) {
                                    $row = mysqli_fetch_array($result);
                                    $total_pharamacist = $row['total_pharamacist'];
                                } else {
                                    $total_pharamacist = 0; // no record found

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
                <div class="card border-left-success h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <?php $total_number = "SELECT Count(*) AS total_accountant From user_tbl WHERE role='accountant'";
                                $result = mysqli_query($conn, $total_number) or die("Query faileds");
                                if (mysqli_num_rows($result)) {
                                    $row = mysqli_fetch_array($result);
                                    $total_accountant = $row['total_accountant'];
                                } else {
                                    $total_accountant = 0; // no record found

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
                <div class="card border-left-success  h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <?php $total_number = "SELECT Count(*) AS total_patient From patient ";
                                $result = mysqli_query($conn, $total_number) or die("Query faileds");
                                if (mysqli_num_rows($result)) {
                                    $row = mysqli_fetch_array($result);
                                    $total_patient = $row['total_patient'];
                                } else {
                                    $total_patient = 0; // no record found

                                }
                                ?>
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total Patient</div>
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
                <div class="card border-left-primary h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <?php $total_number = "SELECT Count(*) AS total_laboratorist From user_tbl WHERE role='laboratorist'";
                                $result = mysqli_query($conn, $total_number) or die("Query faileds");
                                if (mysqli_num_rows($result)) {
                                    $row = mysqli_fetch_array($result);
                                    $total_laboratorist = $row['total_laboratorist'];
                                } else {
                                    $total_laboratorist = 0; // no record found

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
                <div class="card border-left-info h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <?php $total_number = "SELECT Count(*) AS total_appointments From appointments";
                                $result = mysqli_query($conn, $total_number) or die("Query faileds");
                                if (mysqli_num_rows($result)) {
                                    $row = mysqli_fetch_array($result);
                                    $total_appointments = $row['total_appointments'];
                                } else {
                                    $total_appointments = 0; // no record found

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
                <div class="card border-left-warning  h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <?php $total_number = "SELECT Count(*) AS total_appointments From appointments  WHERE status='confirmed'";
                                $result = mysqli_query($conn, $total_number) or die("Query faileds");
                                if (mysqli_num_rows($result)) {
                                    $row = mysqli_fetch_array($result);
                                    $total_con = $row['total_appointments'];
                                } else {
                                    $total_con = 0; // no record found

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
            </div>
            <div class="col-md-8 mb-3">
        <div class="card border-left-danger  h-100">
            <div class="card-header text-xs font-weight-bold text-primary text-uppercase mb-1">view Payment</div>
            <?php
            $limit = 4;
            $select_query = "SELECT i.invoice_id, i.invoice_num, i.patient_id, pt.user_id ,pt.name as patient_name, i.title, i.payment_method, i.amount, i.payment_status, i.invoice_date 
                     FROM invoice  i
                     INNER JOIN patient pt on i.patient_id = pt.id
                     WHERE pt.user_id=$user_id ORDER BY i.invoice_id DESC LIMIT {$limit}";
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
                                            <?php } elseif ($row['payment_status'] == 'paid') { ?>
                                                <span class="badge badge-danger">Paid</span>
                                            <?php } ?>
                                        </td>


                                <?php $sn++;
                                }
                            }

                                ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
   





    <!-- Doctor view Dashboard -->
<?php }
        if ($user_type == 'doctor') {

?><!-- Doctor Appointments  Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary  shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <?php $total_number = "SELECT Count(*) AS total_appointments From 
                            appointments INNER JOIN doctors ON appointments.doctor_id= doctors.id
                             WHERE  doctors.user_id='$user_id'";
                        $result = mysqli_query($conn, $total_number) or die("Query faileds");
                        if (mysqli_num_rows($result)) {
                            $row = mysqli_fetch_array($result);
                            $total_con = $row['total_appointments'];
                        } else {
                            $total_con = 0; // no record found

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
                        $result = mysqli_query($conn, $total_number) or die("Query faileds");
                        if (mysqli_num_rows($result)) {
                            $row = mysqli_fetch_array($result);
                            $total_con = $row['total_appointments'];
                        } else {
                            $total_con = 0; // no record found

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
                        $result = mysqli_query($conn, $total_number) or die("Query faileds");
                        if (mysqli_num_rows($result)) {
                            $row = mysqli_fetch_array($result);
                            $total_con = $row['total_appointments'];
                        } else {
                            $total_con = 0; // no record found

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
                        $result = mysqli_query($conn, $total_number) or die("Query faileds");
                        if (mysqli_num_rows($result)) {
                            $row = mysqli_fetch_array($result);
                            $total_con = $row['total_appointments'];
                        } else {
                            $total_con = 0; // no record found

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
    <div class="col-md-8 mb-3">
        <div class="card border-left-danger  h-100">
            <div class="card-header text-xs font-weight-bold text-primary text-uppercase mb-1">view Payment</div>
            <?php
            $limit = 4;
            $select_query = "SELECT i.invoice_id, i.invoice_num, i.patient_id, pt.user_id ,pt.name as patient_name, i.title, i.payment_method, i.amount, i.payment_status, i.invoice_date 
                     FROM invoice  i
                     INNER JOIN patient pt on i.patient_id = pt.id
                     WHERE pt.user_id=$user_id ORDER BY i.invoice_id DESC LIMIT {$limit}";
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
                                            <?php } elseif ($row['payment_status'] == 'paid') { ?>
                                                <span class="badge badge-danger">Paid</span>
                                            <?php } ?>
                                        </td>


                                <?php $sn++;
                                }
                            }

                                ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

</div>
</div>
<?php } if($user_type=='pharmacist'){ ?>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary  shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <?php $total_number = "SELECT Count(*) AS total_appointments From 
                            appointments INNER JOIN doctors ON appointments.doctor_id= doctors.id
                             WHERE  doctors.user_id='$user_id'";
                        $result = mysqli_query($conn, $total_number) or die("Query faileds");
                        if (mysqli_num_rows($result)) {
                            $row = mysqli_fetch_array($result);
                            $total_con = $row['total_appointments'];
                        } else {
                            $total_con = 0; // no record found

                        }
                        ?>
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Provide Mediciation</div>
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
        <div class="card border-left-primary  shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <?php $total_number = "SELECT Count(*) AS total_appointments From 
                            appointments INNER JOIN doctors ON appointments.doctor_id= doctors.id
                             WHERE  doctors.user_id='$user_id'";
                        $result = mysqli_query($conn, $total_number) or die("Query faileds");
                        if (mysqli_num_rows($result)) {
                            $row = mysqli_fetch_array($result);
                            $total_con = $row['total_appointments'];
                        } else {
                            $total_con = 0; // no record found

                        }
                        ?>
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Provide Mediciation</div>
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
        <div class="card border-left-primary  shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <?php $total_number = "SELECT Count(*) AS total_appointments From 
                            appointments INNER JOIN doctors ON appointments.doctor_id= doctors.id
                             WHERE  doctors.user_id='$user_id'";
                        $result = mysqli_query($conn, $total_number) or die("Query faileds");
                        if (mysqli_num_rows($result)) {
                            $row = mysqli_fetch_array($result);
                            $total_con = $row['total_appointments'];
                        } else {
                            $total_con = 0; // no record found

                        }
                        ?>
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Provide Mediciation</div>
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
        <div class="card border-left-primary  shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <?php $total_number = "SELECT Count(*) AS total_appointments From 
                            appointments INNER JOIN doctors ON appointments.doctor_id= doctors.id
                             WHERE  doctors.user_id='$user_id'";
                        $result = mysqli_query($conn, $total_number) or die("Query faileds");
                        if (mysqli_num_rows($result)) {
                            $row = mysqli_fetch_array($result);
                            $total_con = $row['total_appointments'];
                        } else {
                            $total_con = 0; // no record found

                        }
                        ?>
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Provide Mediciation</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_con ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8 mb-3">
        <div class="card border-left-danger  h-100">
            <div class="card-header text-xs font-weight-bold text-primary text-uppercase mb-1">view Payment</div>
            <?php
            $limit = 4;
            $select_query = "SELECT p.id, p.case_history,p.medication,p.medication_form_pharamcist,p.description,
            p.date,CONCAT(d.first_name,'',d.last_name)  As doctor, pt.name AS patient FROM prescription as p
            LEFT JOIN doctors as d ON p.doctor_id = d.id
            LEFT JOIN patient as pt ON p.patient_id = pt.id         
           ORDER BY p.id DESC LIMIT {$limit}";
            $result = mysqli_query($conn, $select_query);
            $count_row = mysqli_num_rows($result);
            ?>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Pateint Name</th>
                            <th>Doctor Name</th>
                            <th>Date</th>
                                <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                            <?php
                            $sn = 1;
                            if ($count_row > 0) {

                                while ($record = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr>
                                    <td><?php echo $sn; ?></td>
                                    <td><?php echo $record['patient'] ?></td>
                                    <td><?php echo $record['doctor']  ?></td>
                                    <td><?php echo $record['date'] ?> </td>
                                        <td>
                                       <?php if($user_type=='laboratorist'){ ?>
                                       <a href="prescription_edit.php?id=<?php echo $record['id'] ?>"><button type="button" class="btn btn-outline-warning btn-sm">Add Diagnosis Report</button></a>  <?php  } ?>
                                        </td>
                                   </tr><?php
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
   

    <?php } if($user_type=='laboratorist'){ ?>
    <div class="col-md-4 mb-4">
        <div class="card border-left-primary  shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <?php $total_number = "SELECT Count(*) AS total_appointments From 
                            appointments INNER JOIN doctors ON appointments.doctor_id= doctors.id
                             WHERE  doctors.user_id='$user_id'";
                        $result = mysqli_query($conn, $total_number) or die("Query faileds");
                        if (mysqli_num_rows($result)) {
                            $row = mysqli_fetch_array($result);
                            $total_con = $row['total_appointments'];
                        } else {
                            $total_con = 0; // no record found

                        }
                        ?>
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                           Total Test</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_con ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card border-left-primary  shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <?php $total_number = "SELECT Count(*) AS total_appointments From 
                            appointments INNER JOIN doctors ON appointments.doctor_id= doctors.id
                             WHERE  doctors.user_id='$user_id'";
                        $result = mysqli_query($conn, $total_number) or die("Query faileds");
                        if (mysqli_num_rows($result)) {
                            $row = mysqli_fetch_array($result);
                            $total_con = $row['total_appointments'];
                        } else {
                            $total_con = 0; // no record found

                        }
                        ?>
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Pedding Report</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_con ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card border-left-primary  shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <?php $total_number = "SELECT Count(*) AS total_appointments From 
                            appointments INNER JOIN doctors ON appointments.doctor_id= doctors.id
                             WHERE  doctors.user_id='$user_id'";
                        $result = mysqli_query($conn, $total_number) or die("Query faileds");
                        if (mysqli_num_rows($result)) {
                            $row = mysqli_fetch_array($result);
                            $total_con = $row['total_appointments'];
                        } else {
                            $total_con = 0; // no record found

                        }
                        ?>
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Complete Report</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_con ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8 mb-3">
        <div class="card border-left-danger  h-100">
            <div class="card-header text-xs font-weight-bold text-primary text-uppercase mb-1">view Payment</div>
            <?php
            $limit = 4;
            $select_query = "SELECT p.id, p.case_history,p.medication,p.medication_form_pharamcist,p.description,
            p.date,CONCAT(d.first_name,'',d.last_name)  As doctor, pt.name AS patient FROM prescription as p
            LEFT JOIN doctors as d ON p.doctor_id = d.id
            LEFT JOIN patient as pt ON p.patient_id = pt.id         
           ORDER BY p.id DESC LIMIT {$limit}";
            $result = mysqli_query($conn, $select_query);
            $count_row = mysqli_num_rows($result);
            ?>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Pateint Name</th>
                            <th>Doctor Name</th>
                            <th>Date</th>
                                <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                            <?php
                            $sn = 1;
                            if ($count_row > 0) {

                                while ($record = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr>
                                    <td><?php echo $sn; ?></td>
                                    <td><?php echo $record['patient'] ?></td>
                                    <td><?php echo $record['doctor']  ?></td>
                                    <td><?php echo $record['date'] ?> </td>
                                        <td>
                                       <?php if($user_type=='laboratorist'){ ?>
                                       <a href="prescription_edit.php?id=<?php echo $record['id'] ?>"><button type="button" class="btn btn-outline-warning btn-sm">Add Diagnosis Report</button></a>  <?php  } ?>
                                        </td>
                                   </tr><?php
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

<?php  }
        if ($user_type === 'patient') { ?>
    <div class="col-md-4 mb-3">
        <div class="card border-left-success  h-100">
            <div class="card-header text-xs font-weight-bold text-primary text-uppercase mb-1">Upcoming Request</div>
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <?php
                    $limit = 3;
                    $appoinment_data = "SELECT ap.app_id,patient.id, patient.name AS patient_name,
                          CONCAT(doctors.first_name,'',doctors.last_name) as doctor_name, ap.doctor_id, ap.status,appointment_date, ap.appointment_time
                         FROM appointments as ap
                         INNER JOIN patient ON ap.patient_id= patient.id
                         INNER JOIN doctors ON ap.doctor_id = doctors.id
                         WHERE patient.user_id=$user_id
                         ORDER BY ap.app_id DESC LIMIT {$limit}";
                    $app_result = mysqli_query($conn, $appoinment_data);
                    ?>
                    <div class="col mr-2">
                        <ul>
                            <?php
                            if (mysqli_num_rows($app_result)  > 0) {
                                while ($app = mysqli_fetch_assoc($app_result)) {
                            ?>
                                    <?php if ($app['status'] == 'confirmed') { ?>
                                        <li><strong><?php echo $app['doctor_name'] ?></strong> - <?php echo date("Y M d ", strtotime($app['appointment_date'])) ?> at <?php echo date("h:i:A ", strtotime($app['appointment_time'])) ?></li>
                                <?php }
                                }
                            } else {  ?>
                                <li>No Uppcoming Appointment</li>
                            <?php }  ?>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card border-left-primary  h-100">
            <div class="card-header text-xs font-weight-bold text-primary text-uppercase mb-1">CancellAppointment</div>
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <?php
                    $limit = 2;
                    $appoinment_data = "SELECT ap.app_id,patient.id, 
                          CONCAT(doctors.first_name,'',doctors.last_name) as doctor_name, ap.doctor_id, ap.status,appointment_date, ap.appointment_time
                         FROM appointments as ap
                         INNER JOIN patient ON ap.patient_id= patient.id
                         INNER JOIN doctors ON ap.doctor_id = doctors.id
                         WHERE patient.user_id=$user_id
                         ORDER BY ap.app_id  DESC LIMIT $limit";
                    $app_result = mysqli_query($conn, $appoinment_data);
                    ?>
                    <div class="col mr-2">
                        <ul>
                            <?php
                            if (mysqli_num_rows($app_result)  > 0) {
                                while ($app1 = mysqli_fetch_assoc($app_result)) {
                            ?>
                                    <?php if($app1['status'] == 'cancel'){ ?>
                                        <li><strong>Dr.<?php echo $app1['doctor_name'] ?></strong> - <?php echo date("Y M d ", strtotime($app1['appointment_date'])) ?> at <?php echo date("h:i:A ", strtotime($app1['appointment_time'])) ?></li>
                                <?php }
                                }
                            }
                            else { ?><li>No Complete Appointment Record</li>
                            <?php  }  ?>
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
                    <?php $select_query = "SELECT p.id FROM prescription as p
                       LEFT JOIN patient as pt ON p.patient_id = pt.id         
                          WHERE pt.user_id =$user_id ORDER BY p.id DESC";
                    $result = mysqli_query($conn, $select_query) or die('error');
                   if(mysqli_num_rows($result)>0){
                    while($app = mysqli_fetch_assoc($result)){
                    ?>
                    <div class="col mr-2">
                                <p class="card-text">Check your latest prescriptions.</p>
                                <a href="prescription_view.php?id=<?php echo $record['id'] ?>" class="btn btn-light">View Prescriptions</a>
                    </div>
            <?php }
                        } else {
                            echo "<p class='card-text'>No Prescriptions Found.</p>";
                        } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8 mb-3">
        <div class="card border-left-danger  h-100">
            <div class="card-header text-xs font-weight-bold text-primary text-uppercase mb-1">view Payment</div>
            <?php
            $limit = 4;
            $select_query = "SELECT i.invoice_id, i.invoice_num, i.patient_id, pt.user_id ,pt.name as patient_name, i.title, i.payment_method, i.amount, i.payment_status, i.invoice_date 
                     FROM invoice  i
                     INNER JOIN patient pt on i.patient_id = pt.id
                     WHERE pt.user_id=$user_id ORDER BY i.invoice_id DESC LIMIT {$limit}";
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
                                            <?php } elseif ($row['payment_status'] == 'paid') { ?>
                                                <span class="badge badge-danger">Paid</span>
                                            <?php } ?>
                                        </td>


                                <?php $sn++;
                                }
                            }

                                ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
   






<?php }  ?>
<div class="col-md-4 mb-3">
        <div class="card border-left-primary h-100">
            <div class="card-header text-xs font-weight-bold text-primary text-uppercase mb-1">Activity Log</div>
            <div class="row no-gutters align-items-center mb-3">
                <div class="col mr-2">
                    <ul class="list-group ml-2 mb-3">
                    <?php
                    $limit = 5;
                    $select_query = "SELECT a.user_id,a.user_type,a.status,a.ip_address,a.time, user_tbl.id,user_tbl.user_name  FROM activity_log as a
                       INNER JOIN user_tbl ON a.user_id = user_tbl.id
                      WHERE user_id='".$_SESSION['id']."' ORDER BY a.time DESC LIMIT {$limit}";
                      $result = mysqli_query($conn,$select_query);
                       $sn = 1;
                       while ($row = mysqli_fetch_array($result)){
                                 ?>
                        <li class="list-group-item mb-2">
                      
                            <div class="d-flex justify-content-between ">
                                <span class="font-weight-bold"><?php echo $row['user_name'] ?></span>
                                <span class="text-muted"><?php echo $row['time'] ?></span>
                            </div>
                            <?php  if ($row['status']=='active'){ ?>
                                <p class="mb-0">Your Logged in Successfully</p>
                            <?php
                          }else{ ?>
                             <p class="mb-0">Logout Successfully</p>
                        <?php 
                          }
                          ?>
                          
                        </li>
                        <?php } ?>
                    </ul>


                </div>
            </div>
        </div>
    </div>

                        </div>

</div> <!--End container  -->

<?php
include('includes/scripts.php');
include("includes/footer.php");
?>