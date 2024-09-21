<?php include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');
?>
<div class="container-fluid">
    <!-- DataTales Example -->
  
                                 
    <div class="card  mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">User List
                <button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#exampleModal">
                    Add User
                </button>
            </h6>
        </div>
        <div class="card-body">
       <!-- Php code -->
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Phone</th>
                            <th>Sex</th>
                            <th>Blood Group</th>
                            <th>DOB</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                           
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><a href=""><button type="button" class="btn btn-outline-warning mr-2">View</button></a>
                          <a href="" class="btn btn-outline-success mr-2">Edit</a>     
                          <form action="" method="POST" id="deleteForm" style="display:inline-block; margin:2px;">
                              <input type="hidden" name="id" value="">
                              <button type="submit" name="delete" class="btn btn-outline-danger" onclick="confirmDetele()">Delete</button>
                              </form> 

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