<?php
ob_start();
include("includes/header.php");
include("includes/navbar.php");
include('../database/config.php');

if(!isset($_SESSION['id'])){
    header('location:index.php');
}

$errors = [
    'blog_title' => '',
    'blog_desc' => '',
    'category' => '',
    'banner' => '',
    'sub_img' => '',
    'blog_tag' => '',
];

if (isset($_POST['save'])) {
    $blog_title = mysqli_real_escape_string($conn, $_POST['blog_title']);
    $blog_desc = mysqli_real_escape_string($conn, $_POST['blog_desc']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $blog_tag = mysqli_real_escape_string($conn, $_POST['blog_tag']);

    // banner 
    $file_name = $_FILES['banner']['name'];
    $file_temp_banner = $_FILES['banner']['tmp_name'];
    $file_type = $_FILES['banner']['type'];
    $file_ext_banner = pathinfo($file_name, PATHINFO_ALL);
    $extensions = array('jpg', 'png', 'jpeg');
    $banner = $extensions;
    $traget_banner = "Blog_img/banner/".$file_name;
    // sub img 
    $file_img = $_FILES['sub_img']['name'];
    $file_temp_sub = $_FILES['sub_img']['tmp_name'];
    $file_type = $_FILES['sub_img']['type'];
    $file_ext_sub = pathinfo($file_img, PATHINFO_ALL);
    $extensions_img = array('jpg', 'png', 'jpeg');
    $sub_img = $extensions_img;
    $traget_sub = "Blog_img/sub_img/".$file_img;

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
    if(empty($blog_tag)){
        $errors['blog_catgeory'] ="Tag is required";
    }
    if(empty($banner)){
        $errors['banner'] = "Banner is required";
    } elseif($banner ==$file_ext_banner){
        $errors['banner']="Plase Upload a valid file png, jpg or jpeg";
    }
    if(empty($sub_img)){
        $errors['sub_img'] = "Image is required";
    } elseif( $sub_img == $file_ext_sub){
        $errors['sub_img']="Plase Upload a valid file png, jpg or jpeg";
    }
    if(!move_uploaded_file($file_temp_banner,$traget_banner)){
        $errors['banner'] = "upload failed";
    }
    if(!move_uploaded_file($file_temp_sub,$traget_sub)){
        $errors['sub_img'] = "upload failed";
    }
    if (empty(array_filter($errors))) {
        
        // check
        $select_query = "SELECT blog_title FROM blog WHERE blog_title='$blog_title'";
        $result = mysqli_query($conn, $select_query);
        if (mysqli_num_rows($result) > 0) {
            $_SESSION['alert'] = "Alread Create Post";
            $_SESSION['alert_code'] = "info";
        } else {
            $insert_query = "INSERT INTO `blog`(`blog_title`, `blog_des`, `category`, `tag`, `image_1`, `image_2`,`create_date`) 
   VALUES('$blog_title','$blog_desc','$category','$blog_tag','$file_name','$file_img',Now())";
            if (mysqli_query($conn, $insert_query)) {
                $_SESSION['alert'] = "Post Create Successfully";
                $_SESSION['alert_code'] = "success";
                header('location:blog_manage.php');
                exit();
            } else {
                $_SESSION['alert'] = "Failed";
                $_SESSION['alert_code'] = "error";
            }
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
                    Add Blog Post
                </div>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data" >
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" name="blog_title" class="form-control" placeholder="Enter Title" value="<?php echo isset($blog_title) ? $blog_title : ''; ?>">
                            <span style='color:red' ;><?php echo $errors['blog_title'] ?></span>
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea name="blog_desc" id="blog_desc" spellcheck="false" rows="5" cols="5" class="form-control"><?php echo isset($blog_desc) ? $blog_desc : ''; ?></textarea>
                            <span style='color:red' ;><?php echo $errors['blog_desc'] ?></span>
                        </div>
                        <div class="form-group">
                            <label for="">Category</label>
                            <input type="text" name="category" class="form-control" placeholder="Enter Category" value="<?php echo isset($category) ? $category : ''; ?>">
                            <span style='color:red' ;><?php echo $errors['category'] ?></span>
                        </div>
                        <div class="form-group">
                            <label for="">Tag</label>
                            <input type="text" name="blog_tag" id="blog_tag" class="form-control" placeholder="Enter tag" value="<?php echo isset($blog_tag) ? $blog_tag : ''; ?>">
                            <span style='color:red' ;><?php echo $errors['blog_tag'] ?></span>
                        </div>
                        <div class="form-group">
                            <label for="">Banner</label>
                            <input type="file" name="banner" class="form-control" value="<?php echo isset($banner) ? $banner : ''; ?>">
                            <span style='color:red' ;><?php echo $errors['banner'] ?></span>
                        </div>
                        <div class="form-group">
                            <label for="">Image</label>
                            <input type="file" name="sub_img" class="form-control" value="<?php echo isset($sub_img) ? $sub_img : ''; ?>">
                            <span style='color:red' ;><?php echo $errors['sub_img'] ?></span>
                        </div>

                        <div class="form-group">
                            <button type="submit" name="save" class="btn btn-outline-primary">Save</button>

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