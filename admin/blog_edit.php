<?php
ob_start();
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');

$errors = [
    'blog_title' => '',
    'blog_desc' => '',
    'category' => '',
    'banner' => '',
    'sub_img' => '',
    'blog_tag' => '',
];

if (isset($_POST['update'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $blog_title = mysqli_real_escape_string($conn, $_POST['blog_title']);
    $blog_desc = mysqli_real_escape_string($conn, $_POST['blog_desc']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $blog_tag = mysqli_real_escape_string($conn, $_POST['blog_tag']);

    // banner 
    $new_img_name = $_POST['old_banner'];
    if (!empty($_FILES['new_banner']['name'])) {
        $file_name = $_FILES['new_banner']['name'];
        $file_temp_banner = $_FILES['new_banner']['tmp_name'];
        $file_type = $_FILES['new_banner']['type'];
        $file_ext_banner = pathinfo($file_name, PATHINFO_EXTENSION);
        $extensions = array('jpg', 'png', 'jpeg');
       if(in_array($file_ext_banner, $extensions)){
        $new_img_name = time() . "--" . basename($file_name);
        $target_banner = "Blog_img/banner/".$new_img_name;
       } else{
        $errors['banner'] = "Plase Upload a valid file png, jpg or jpeg";
       
    } 
}
    $new_sub_img = $_POST['old_sub'];
    if (!empty($_FILES['new_sub_img']['name'])) {
        $file_img = $_FILES['new_sub_img']['name'];
        $file_temp_sub = $_FILES['new_sub_img']['tmp_name'];
        $file_type = $_FILES['new_sub_img']['type'];
        $file_ext_sub = pathinfo($file_img, PATHINFO_EXTENSION);
        $extensions_img = array('jpg', 'png', 'jpeg');
        
     if(in_array($file_ext_sub, $extensions_img)){
        $new_sub_img = time(). "--" .basename($file_img);
        $target_sub = "Blog_img/sub_img/" .$new_sub_img;
    } else{
        $errors['sub_img'] = "Plase Upload a valid file png, jpg or jpeg";
    }
}
    // validation code 
    if (empty($blog_title)) {
        $errors['blog_title'] = "Blog Title is required";
    }
    // } elseif (!preg_match('/^[a-zA-Z\s]+$/', $blog_title)) {
    //     $errors['blog_title'] = 'Title must contain letter and space';
    // }
    if (empty($blog_desc)) {
        $errors['blog_desc'] = " Description is required";
        // } elseif (!preg_match('/^[a-zA-Z\s]+$/', $blog_desc)) {
        //     $errors['blog_desc'] = 'Description must contain letter and space';
    } elseif (strlen($blog_desc) > 10000) {
        $errors['blog_desc'] = 'Notice must be at least 5000 characters';
    }
    if (empty($category)) {
        $errors['category'] = "Category is required";
    } elseif (!preg_match('/^[a-zA-Z\s]+$/', $category)) {
        $errors['category'] = "Category must conatin letter";
    }
    if (empty($blog_tag)) {
        $errors['blog_catgeory'] = "Tag is required";
    }
  
    if (!empty($_FILES['new_banner']['name']) && !move_uploaded_file($file_temp_banner, $target_banner)) {
        $errors['banner'] = "upload failed";
    }
    if (!empty($_FILES['new_sub_img']['name']) && !move_uploaded_file($file_temp_sub, $target_sub)) {
        $errors['sub_img'] = "upload failed";
    }
    if (empty(array_filter($errors))) {

        $update_query = "UPDATE `blog` SET `blog_title`='$blog_title',`blog_des`='$blog_desc',
            `category`='$category',`tag`='$blog_tag',`image_1`='$new_img_name',`image_2`='$new_sub_img' WHERE `id` = $id";
        if (mysqli_query($conn, $update_query)) {
            $_SESSION['alert'] = "Update Successfully";
            $_SESSION['alert_code'] = "success";
            header('location:blog_manage.php');
            exit();
        } else {
            $_SESSION['alert'] = "Failed";
            $_SESSION['alert_code'] = "error";
        }
    }
}

ob_end_flush();
?>

<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header">
                    Edit Blog
                </div>
                <?php
                $id = $_GET['id'];
                $sql = "SELECT * FROM blog WHERE id = $id";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);

                ?>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                                <label for="">Title</label>
                                <input type="text" name="blog_title" class="form-control" placeholder="Enter Title" value="<?php echo $row['blog_title']  ?>">
                                <span style='color:red' ;><?php echo $errors['blog_title'] ?></span>
                            </div>
                            <div class="form-group">
                                <label for="">Description</label>
                                <textarea name="blog_desc" id="blog_desc" spellcheck="false" rows="5" cols="5" class="form-control"><?php echo $row['blog_des']; ?></textarea>
                                <span style='color:red' ;><?php echo $errors['blog_desc'] ?></span>
                            </div>
                            <div class="form-group">
                                <label for="">Category</label>
                                <input type="text" name="category" class="form-control" placeholder="Enter Category" value="<?php echo $row['category']; ?>">
                                <span style='color:red' ;><?php echo $errors['category'] ?></span>
                            </div>
                            <div class="form-group">
                                <label for="">Tag</label>
                                <input type="text" name="blog_tag" id="blog_tag" class="form-control" placeholder="Enter tag" value="<?php echo $row['tag']; ?>">
                                <span style='color:red' ;><?php echo $errors['blog_tag'] ?></span>
                            </div>
                            <div class="form-group">
                                <label for="">Banner</label>
                                <input type="file" name="new_banner" class="form-control">
                                <img src="Blog_img/banner/<?php echo $row['image_1'] ?>" alt="" class="img-fluid mt-2" height="200px" width="200px" style="object-fit:cover;">
                                <input type="hidden" name="old_banner" value="<?php echo $row['image_1'] ?>">
                                <span style='color:red' ;><?php echo $errors['banner'] ?></span>
                            </div>
                            <div class="form-group">
                                <label for="">Sub Image</label>
                                <input type="file" name="new_sub_img" class="form-control">
                                <img src="Blog_img/sub_img/<?php echo $row['image_2'] ?>" alt="" class="img-fluid mt-2" height="200px" width="200px" style="object-fit:cover;">
                                <input type="hidden" name="old_sub" value="<?php echo $row['image_2'] ?>">
                                <span style='color:red' ;><?php echo $errors['sub_img'] ?></span>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="update" class="btn btn-outline-primary">Update</button>

                            </div>
                        </form>
                    <?php }  ?>
                    </div>
            </div>
        </div>
    </div>


    <?php
    include('includes/scripts.php');
    include('includes/footer.php');
    ?>