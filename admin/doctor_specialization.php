<?php include("includes/header.php");
include("includes/navbar.php");
?>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post"></form>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Specialization</label>
                    <input type="text" name="specialization" class="form-control" placeholder="Enter Specialization">
                </div>
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="add" class="btn btn-primary">Add</button>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="container-fluid">
    <!-- DataTales Example -->
  
                                 
    <div class="card mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">User List
                <button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#exampleModal">
                    Add Doctor
                </button>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Specialization</th>
                            <th>Creation Date</th>
                            <th>Update Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Orthopaedic Surgery</td>
                            <td>2024/04/25</td>
                            <td>2024/12/12</td>
                            <td><button type="button" class="btn btn-outline-warning">View</button>
                                <button type="button" class="btn btn-outline-success">Edit</button>
                                <button type="button" class="btn btn-outline-danger">Delete</button>

                            </td>
                        </tr>
                        <tr>
                        <td>2</td>
                            <td>Orthopaedic Surgery</td>
                            <td>2024/04/25</td>
                            <td>2024/12/12</td>
                            <td><button type="button" class="btn btn-outline-warning">View</button>
                                <button type="button" class="btn btn-outline-success">Edit</button>
                                <button type="button" class="btn btn-outline-danger">Delete</button>

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