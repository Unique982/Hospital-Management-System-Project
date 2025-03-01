<?php
ob_start();
 include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');

if(!isset($_SESSION['id'])){
    header('location:index.php');
}

if(isset($_POST['update'])){
    $id = mysqli_real_escape_string($conn,$_POST['id']);
    $page_title = mysqli_real_escape_string($conn, $_POST['page_title']);
    $page_description = mysqli_real_escape_string($conn, $_POST['page_description']);

    // update sql query
    $update_query = "UPDATE about_page SET page_title ='$page_title', page_description ='$page_description' WHERE id='$id'";
    if(mysqli_query($conn,$update_query)){

        $_SESSION['alert'] ="Update Successfully ";
        $_SESSION['alert_code'] ="success";
    }
    else{
        $_SESSION['alert'] ="Failed Update";
        $_SESSION['alert_code'] ="error";
    
    }
    }
    ob_end_flush();
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header">
                 About Page
                </div>
                <?php 
                 $select_query = "SELECT * FROM about_page";
                 $result = mysqli_query($conn, $select_query) or die("query failed");
                 if(mysqli_num_rows($result)){
                    while($row = mysqli_fetch_assoc($result)){
                
                ?>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                        <div class="form-group">
                            <label for="">Page Title</label>
                            <input type="text" name="page_title" value="<?php echo $row['page_title'] ?>" class="form-control" placeholder="Enter Name">
                        </div>
                        <div class="form-group">
                            <label for="">Page Description</label>
                         <textarea name="page_description" id="" class="form-control"><?php echo $row['page_description'] ?></textarea>
                        </div>
                        
                        <div class="form-group">
                        <button type="submit" name="update" class="btn btn-outline-primary" >Save</button>
                      
                        </div>

                    </form>
                    <?php
                     }
                
                    }
                    
                    ?>
                </div>
            </div>
        </div>
    </div>


    <?php
    include('includes/scripts.php');
    include('includes/footer.php');
    ?>