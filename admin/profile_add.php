<?php include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');
if(isset($_POST['update'])){
    $id = mysqli_real_escape_string($conn,$_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $link = mysqli_real_escape_string($conn, $_POST['link']);
    $bio = mysqli_real_escape_string($conn, $_POST['bio']);
    $image = mysqli_real_escape_string($conn, $_POST['image']);

$update_query = "UPDATE profile SET name = '$name',email = '$email', phone = '$phone',
address = '$address',website_link = '$link',bio = '$bio',image='image' WHERE id =$id";
if(mysqli_query($conn,$update_query)){
    echo "<div class='alert alert-alert role='alert'>Update Successfullt?</div>";
}
else{
    echo "<div class='alert alert-alert role='alert'>Failed Update</div>";
}
}

?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                  Profile Page
                </div>
                <?php 
             
             $select_query = "SELECT * FROM profile";
             $result = mysqli_query($conn,$select_query) or die("Error Query");
             if(mysqli_num_rows($result)>0){
                 while($record = mysqli_fetch_assoc($result)){ 
             ?>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="../assets/images/<?php echo $record['image'] ?>" alt="" width="250px" class=" rounded img-thumbnail mb-3" height="100">
                            <form action="" method="post">
                            <div class="form-group">
                                <label for=""></label>
                                <input type="file" name="image" value="<?php echo $record['image'] ?>">
                            </div>

                            <hr>
                            <p><strong class="text-mute">Name:</strong><span class="ml-1"><?php echo $record['name'] ?></span></p>
                            <p><strong class="text-mute">Email:</strong><span class="ml-1"><?php echo $record['email'] ?></span></p>
                            <p><strong class="text-mute">Phone:</strong><span class="ml-1"><?php echo $record['phone'] ?></span></p>
                            <p><strong class="text-mute">Address:</strong><span class="ml-1"><?php echo $record['address'] ?></span></p>
                            <p><strong class="text-mute">Website:</strong><span class="ml-1"><a href=""><?php echo $record['website_link'] ?> </a></span></p>
                            <p><strong class="text-mute">Bio:</strong><span class="ml-1"><?php echo $record['bio'] ?></span></p>
                             
                        </div>
                        
                        
                    <div class="col-md-8"> 
                    <input type="hidden" name="id" value="<?php echo $record['id'] ?>">  
                    <div class=" form-group mb-3">
                            <label for="">Name</label>
                            <input type="text" name="name" value="<?php echo $record['name'] ?>" class="form-control">
                    </div>   <div class="form-group mb-3">
                        <label for="">Email</label>
                        <input type="email" name="email" value="<?php echo $record['email'] ?>" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Phone</label>
                        <input type="number" name="phone" value="<?php echo $record['phone'] ?>" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Address</label>
                        <input type="text" name="address" value="<?php echo $record['address'] ?>" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Website Url</label>
                        <input type="ulr" name="link" value="<?php echo $record['website_link'] ?>" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="">Bio</label>
                        <textarea name="bio" class="form-control" id=""><?php echo $record['bio'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="update" class="btn btn-primary">Save Change</button>
                    </div>
                    
                    

                    </div>
                    </form>
                    <?php }} ?>
                   
                </div>
            </div>
        </div>
    </div>
</div>
</div>



</div>
<?php
include('includes/scripts.php');
include('includes/footer.php');
?>