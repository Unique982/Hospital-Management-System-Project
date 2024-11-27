<?php
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');
?>

<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">System File Backup</h6>
        </div>
        <div class="card-body">
            <!-- PHP code -->
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>File Name</th>
                            <th>Download</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>System Data File</td>
                            <td><a href="backup_code.php"><i class="fas fa-database"></i>
                            </a>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Nurse Data File</td>
                            <td><a href=""><i class="fas fa-database"></i>
                            </a>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Patients Data File</td>
                            <td><a href=""><i class="fas fa-database"></i>
                            </a>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>All System Backup file</td>
                            <td><a href=""><i class="fas fa-database"></i>
                            </a>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>All System Backup file</td>
                            <td><a href=""><i class="fas fa-database"></i>
                            </a>
                            </td>
                        </tr>
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