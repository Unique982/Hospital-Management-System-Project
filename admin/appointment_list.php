<?php
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');
?>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Appointment</h5>
            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="" method="POST" class="needs-validation" novalidate>
        <div class="modal-body">
            <div class="form-group">
                <label for="">Doctor</label>
                <input type="text" name="doctor" class="form-control" placeholder="Enter Doctor" required>
            </div>
            <div class="form-group">
                <label for="">Patient</label>
                <select name="patient" id="patient" class="form-control" required>
                    <option selected disabled> Select One</option>
                    <option value="1">Patient 1</option>
                    <option value="2">Patient 2</option>
                    <option value="3">Patient 3</option>
                </select>
            </div>
            <div class="form-group">
                <label for="">Date</label>
                <input type="date" name="date" class="form-control" required>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="add" class="btn btn-primary">Save</button>
        </div>
        </form>
    </div>
</div>
</div>

<div class="container-fluid">
<div class="card mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Appointment List
            <button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#exampleModal">
                Add Appointment
            </button>
        </h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Patient Name</th>
                        <th>Doctor</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Unique Neupane</td>
                        <td>New Doctor</td>
                        <td>2089-10-1</td>
                        <td>
                            <a href=""><button type="button" class="btn btn-outline-warning mr-2">View</button></a>
                            <a href="" class="btn btn-outline-success mr-2">Edit</a>
                            <form action="" method="POST" id="deleteForm" style="display:inline-block; margin:2px;">
                                <input type="hidden" name="patient_id" value="">
                                <button type="submit" name="delete" class="btn btn-outline-danger" onclick="return confirmDelete()">Delete</button>
                            </form> 
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

<script>
function confirmDelete() {
    return confirm("Are you sure you want to delete this appointment?");
}
</script>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
