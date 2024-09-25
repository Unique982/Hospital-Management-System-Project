<?php
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');

?>
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header">
                    Add Patient
                </div>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="">Bed Number</label>
                            <select name="bed_number" id="bed_number" class="form-control">
                                <option selected> Selct Now</option>
                                <option value="">Ward</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for=""> Patient</label>
                            <select name="patient" id="patient" class="form-control">
                                <option selected> Selct Now</option>
                                <option value="">Ward</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Allocate Time</label>
                       <input type="date" name="allocate_time" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Discharge Time</label>
                            <input type="date" name="discharge_time" class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="submit" name="add_bed" class="btn btn-outline-primary">Add New Bed</button>
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