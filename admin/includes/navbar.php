<?php 
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
$user_type=$_SESSION['user_data']['role'] ?? '';
$user_name=$_SESSION['user_data']['user_name'] ?? '';
?>
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="./dashboard.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-hospital"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Un  <sup>HMS</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="dashboard.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

<?php
if($user_type === 'patient'){

 ?>
   <li class="nav-item">
                <a class="nav-link collapsed" href="./employee_add.php" data-toggle="collapse" data-target="#collapse1"
                    aria-expanded="true" aria-controls="collapse1">
                    <i class="fas fa-user-md"></i>
                    <span>Empolyee Manage</span>
                </a>
                <div id="collapse1" class="collapse" aria-labelledby="heading1" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Empolyee Manage</h6>
                      
                        <a class="collapse-item" href="./doctor_specialization.php">Doctor Specialization</a>
                        <a class="collapse-item" href="./employee_add.php">Manage Doctor</a>
                        <a class="collapse-item" href="./manage_nurse.php">Manage Nurse</a>
                        <a class="collapse-item" href="./manage_pharmacist.php">Manage pharmacist</a>
                        <a class="collapse-item" href="./manage_accountant.php">Manage Accountant</a>
                        <a class="collapse-item" href="./manage_laboratorist.php">Manage Laboratorist</a>
                    </div>
                </div>
            </li>
 <?php } ?>

           <?php
           if($user_type==='admin'){

           ?>

            <!-- Nav Item - Manage Doctors -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="./employee_add.php" data-toggle="collapse" data-target="#collapse1"
                    aria-expanded="true" aria-controls="collapse1">
                    <i class="fas fa-user-md"></i>
                    <span>Empolyee Manage</span>
                </a>
                <div id="collapse1" class="collapse" aria-labelledby="heading1" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Empolyee Manage</h6>
                      
                        <a class="collapse-item" href="./doctor_specialization.php">Doctor Specialization</a>
                        <a class="collapse-item" href="./employee_add.php">Manage Doctor</a>
                        <a class="collapse-item" href="./manage_nurse.php">Manage Nurse</a>
                        <a class="collapse-item" href="./manage_pharmacist.php">Manage pharmacist</a>
                        <a class="collapse-item" href="./manage_accountant.php">Manage Accountant</a>
                        <a class="collapse-item" href="./manage_laboratorist.php">Manage Laboratorist</a>
                    </div>
                </div>
            </li>
            <?php } ?>

            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-user-md"></i>
                    <span>User</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">User</h6>
                        <a class="collapse-item" href="./manage_appointments_add.php">List</a>
                    </div>
                </div>
            </li> -->
            <?php 
              if($user_type==='admin' || $user_type==='doctor' || $user_type==='nurse'){
            
            ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="./patient_list.php" data-toggle="collapse" data-target="#collapse2"
                    aria-expanded="true" aria-controls="collapse2">
                    <i class="fa-solid fa-users"></i>
                    <span>Manage Patients</span>
                </a>
                <div id="collapse2" class="collapse" aria-labelledby="heading2" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Manage Patient</h6>
                        <a class="collapse-item" href="./patient_add.php">Add</a>
                        <a class="collapse-item" href="./patient_list.php">List</a>
                    </div>
                </div>
            </li>
            <?php  }?>
            <?php
           if($user_type==='admin'|| $user_type==='doctor' || $user_type==='nurse'){

           ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse3"
                    aria-expanded="true" aria-controls="collapse3">
                    <i class="fas fa-calendar-check"></i>
                    <span>Manage Blood</span>
                </a>
                <div id="collapse3" class="collapse" aria-labelledby="heading3" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Manage Blood</h6>
                        <a class="collapse-item" href="./blood_donor_add.php">Add</a>
                        <a class="collapse-item" href="./blood_donor_list.php">List</a>
                    </div>
                </div>
            </li>
            <?php } ?>
            <?php
           if($user_type==='admin' || $user_type==='doctor' || $user_type==='nurse'){

           ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse4"
                    aria-expanded="true" aria-controls="6">
                    <i class="fas fa-calendar-check"></i>
                    <span>Manage Bed</span>
                </a>
                <div id="collapse4" class="collapse" aria-labelledby="heading4" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Manage Blood</h6>
                        <a class="collapse-item" href="./bed_add.php">Add Bed</a>
                        <a class="collapse-item" href="./bed_list.php">List Bed</a>
                        <a class="collapse-item" href="./allocate_bed_add.php">Bed allotment</a>
                        <a class="collapse-item" href="./allocate_bed_list.php">Bed Allotment List</a>
                    </div>
                </div>
            </li>
           <?php } ?>

           <?php
           if($user_type==='admin' ||  $user_type==='doctor' || $user_type==='nurse'){

           ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse5"
                    aria-expanded="true" aria-controls="collapse5">
                    <i class="fas fa-calendar-check"></i>
                    <span>Manage Appointments</span>
                </a>
                <div id="collapse5" class="collapse" aria-labelledby="heading5" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Manage Appointment</h6>
                        <a class="collapse-item" href="./appointment_list.php">List</a>
                    </div>
                </div>
            </li>
           <?php }  ?>

           <?php
           if($user_type==='admin' || $user_type==='doctor' || $user_type==='nurse'){

           ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse6"
                    aria-expanded="true" aria-controls="collapse6">
                    <i class="fas fa-file-alt"></i>
                    <span>Manage Report</span>
                </a>
                <div id="collapse6" class="collapse" aria-labelledby="heading6" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Manage Reports</h6>
                        <a class="collapse-item" href="report_add.php">Report Add</a>
                        <a class="collapse-item" href="manage_report.php">Manage Report</a>
                    </div>
                </div>
            </li>
           <?php } ?>
          
           <?php
            if($user_type==='pharmacist'){
           ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse7"
                    aria-expanded="true" aria-controls="collapse7">
                    <i class="fas fa-plus-circle"></i> 
                    <span>Medicine Category</span>
                </a>
                <div id="collapse7" class="collapse" aria-labelledby="heading7" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Medicine Category</h6>
                        <a class="collapse-item" href="medicine_add_catgeory.php">Medicine Category Add</a>
                        <a class="collapse-item" href="medicine_list_catgeory.php">Medicine Category List</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse8"
                    aria-expanded="true" aria-controls="collapse8">
                    <i class="fas fa-calendar-check"></i>
                    <span>Manage Medicine </span>
                </a>
                <div id="collapse8" class="collapse" aria-labelledby="heading8" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Manage Medicine</h6>
                        <a class="collapse-item" href="medicine_add.php">Medicine Add</a>
                        <a class="collapse-item" href="medicine_list.php">Medicine List</a>
                    </div>
                </div>
            </li>
           <?php }  ?>
           <?php
           if($user_type==='admin' || $user_type==='doctor' || $user_type==='nurse'){

           ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse7"
                    aria-expanded="true" aria-controls="collapse7">
                    <i class="fas fa-file-alt"></i>
                    <span>Manage Invoice</span>
                </a>
                <div id="collapse7" class="collapse" aria-labelledby="heading7" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Manage Payment</h6>
                        <a class="collapse-item" href="invoice_add.php">Manage Invoice</a>
                        <a class="collapse-item" href="invoice_list.php">View Invoice</a>
                        <a class="collapse-item" href="payment_history.php">Payment History</a>
                    </div>
                </div>
            </li>
           <?php } ?>
          
            <!-- Heading -->
            <?php
            if($user_type==='admin'){
           ?>
           
                  <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse8"
                    aria-expanded="true" aria-controls="collapse8">
                    <i class="fa-solid fa-message"></i>
                    <span>Contact Query </span>
                </a>
                <div id="collapse8" class="collapse" aria-labelledby="heading8" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Contact Query</h6>
                        <a class="collapse-item" href="unread.php">Unread Query</a>
                        <a class="collapse-item" href="read.php">Read Query</a>
                    </div>
                </div>
            </li>
            
             <!-- Nav Item - Pages Collapse Menu -->
             <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Pages</h6>
                        <a class="collapse-item" href="about_page.php">About Us</a>
                        <a class="collapse-item" href="contact_page.php">Contact Us</a>
                        <a class="collapse-item" href="notice_board_list.php">Manage Notice</a>
                        
                      
                    </div>
                </div>
            </li>

            <?php
            }
           ?>
      

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
          <!-- Content Wrapper -->
          <div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">

    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-light topbar mb-4 static-top shadow">

        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>

        <!-- Topbar Search -->
        <form
            class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                    aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-success" type="button">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form>

        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-search fa-fw"></i>
                </a>
                <!-- Dropdown - Messages -->
                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                    aria-labelledby="searchDropdown">
                    <form class="form-inline mr-auto w-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small"
                                placeholder="Search for..." aria-label="Search"
                                aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>

            <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1">
            <?php 
                    $select_query = "SELECT * FROM notice_board ";
                    $result = mysqli_query($conn,$select_query);
                    $count = mysqli_num_rows($result);
                    if($count){
                        
                    ?>    
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bell fa-fw"></i>
                    <!-- Counter - Alerts -->
                    <span class="badge badge-danger badge-counter">1+</span>
                </a>
                <!-- Dropdown - Alerts -->
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    aria-labelledby="alertsDropdown">
                    <h6 class="dropdown-header bg-gradient-dark">
                        Notice Alerts
                    </h6>
                    <?php while($row = mysqli_fetch_assoc($result)){ ?>
                    <a class="dropdown-item d-flex align-items-center" href="notice_board_view.php?notice_id=<?php echo$row['notice_id'] ?>">
                        <div class="mr-3">
                            <div class="icon-circle bg-primary">
                                <i class="fas fa-file-alt text-white"></i>
                            </div>
                        </div>
                        <div>
                            
                            <div class="small text-gray-500"><td><?php echo date('F d, Y', strtotime($row['created_at'])); ?></td></div>
                            <span class="font-weight-bold"><?php echo $row['notice_title'] ?></span>
                        </div>
                    </a>
                
                <?php 
              
                } } ?>
                
                    <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                </div>
                
            </li>
 
            <!-- Nav Item - Messages -->
            <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-envelope fa-fw"></i>
                    <!-- Counter - Messages -->
                    <span class="badge badge-danger badge-counter">7</span>
                </a>
                <!-- Dropdown - Messages -->
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    aria-labelledby="messagesDropdown">
                    <h6 class="dropdown-header bg-gradient-dark">
                        Message Center
                    </h6>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="dropdown-list-image mr-3">
                            <img class="rounded-circle" src="img/undraw_profile_1.svg"
                                alt="...">
                            <div class="status-indicator bg-success"></div>
                        </div>
                        <div class="font-weight-bold">
                            <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                problem I've been having.</div>
                            <div class="small text-gray-500">Emily Fowler · 58m</div>
                        </div>
                    </a>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="dropdown-list-image mr-3">
                            <img class="rounded-circle" src="img/undraw_profile_2.svg"
                                alt="...">
                            <div class="status-indicator"></div>
                        </div>
                        <div>
                            <div class="text-truncate">I have the photos that you ordered last month, how
                                would you like them sent to you?</div>
                            <div class="small text-gray-500">Jae Chun · 1d</div>
                        </div>
                    </a>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="dropdown-list-image mr-3">
                            <img class="rounded-circle" src="img/undraw_profile_3.svg"
                                alt="...">
                            <div class="status-indicator bg-warning"></div>
                        </div>
                        <div>
                            <div class="text-truncate">Last month's report looks great, I am very happy with
                                the progress so far, keep up the good work!</div>
                            <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                        </div>
                    </a>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="dropdown-list-image mr-3">
                            <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                alt="...">
                            <div class="status-indicator bg-success"></div>
                        </div>
                        <div>
                            <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                told me that people say this to all dogs, even if they aren't good...</div>
                            <div class="small text-gray-500">Chicken the Dog · 2w</div>
                        </div>
                    </a>
                    <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    
 <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $user_name ?></span>
                    <img class="img-profile rounded-circle"
                        src="../assets/images/WhatsApp Image 2024-07-09 at 17.55.10_f356836c.jpg">
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="profile_add.php">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Profile
                    </a>
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                        Password Change
                    </a>
                    <a class="dropdown-item" href="./setting.php">

                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                        Settings
                    </a>
                    <a class="dropdown-item" href="activity_log_view.php">
                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                        Activity Log
                    </a>
                    <?php
            if($user_type==='admin'){
           ?>
           <a class="dropdown-item" href="system_backup_file.php">
                        <i class="fas fa-cloud-upload-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Backup
                    </a>
           <?php  } ?>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="../logout.php" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </a>
                </div>
            </li>

        </ul>

    </nav>
        <!-- End of Sidebar -->
 <!-- End of Topbar -->
          <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

         <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="./logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

