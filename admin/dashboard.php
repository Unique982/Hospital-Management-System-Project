<?php 
session_start();
if(!isset($_SESSION['user_data']) && !isset($_SESSION['patient_data'])){
    header("location:index.php");
    exit();
}
include("includes/header.php");
include("includes/navbar.php");
?>


<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <div class="row">

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
                                            style="width: 80%" aria-valuenow="50" aria-valuemin="0"
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
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Pending Appointment Requests</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>






    <?php
    include('includes/scripts.php');
        include("includes/footer.php");
    ?>