<?php
include('header.php');
include('./database/config.php');

?>

<!-- Single blog page -->
<section class="single-detalis py-5" id="single-detalis">
    <div class="container">
        <div class="row">
            <?php
            $id = $_GET['id'];
            $select = "select * from blog where id = $id";
            $result = mysqli_query($conn, $select) or die("Error");
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
                    <div class="col-lg-8">
                        <div class="card border-0">
                            <img src="./admin/Blog_img/banner/<?php echo $row['image_1'] ?>" alt="" class="img-fluid">
                            <div class="card-body">
                                <h5><?php echo $row['blog_title'] ?></h5>
                                <small class="text-muted"><i class="fa-solid fa-clock"></i> <?php echo date("M-d-Y", strtotime($row['create_date'])) ?> </small>
                                <small class="text-muted"><i class="fa-solid fa-tag"></i> <?php echo $row['category'] ?></small>
                                <small class="text-muted"><i class="fa-solid fa-user"></i> Admin</small>
                                

                                <p><?php echo nl2br(substr($row['blog_des'], 0, 2900)) ?>...
                                </p>

                                <img src="./admin/Blog_img/sub_img/<?php echo $row['image_2'] ?>" alt="" class="img-fluid">
                                <p><?php echo nl2br(substr($row['blog_des'], 2900)) ?>
                                </p>
                                <div style="display:inline-block">
                                <button class="btn btn-light btn-sm"><?php echo $row['category'] ?></button>
                                <button class="btn btn-light btn-sm"><?php echo $row['tag'] ?></button> 
                                </div>
                              
                               <!-- <a href="#" class="btn btn-primary btn-sm">Read More <i class="fa-solid fa-arrow-right"></i></a> -->
                            </div>
                        </div>
                <?php }
            } ?>
                <!-- Comment section -->
                <div class="mt-2">
                    <h5 class="text-muted py-3">Leave Comment</h5>
                    <form action="">
                        <div class="form-group mb-3">
                            <label for="">Name:</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="form-label">Email:</label>
                            <input type="text" class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <label for="" class="form-label">Comment:</label>
                            <textarea name="comment" id="comment" cols="6" rows="6" class="form-control"></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" name="submit" class="btn btn-success btn-sm">Comment</button>
                        </div>
                    </form>
                </div>

                <!-- comment dispaly nested -->
                <div class="mt-4">
                    <h5 class="text-muted py-3">Comment</h5>
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <img src="./assets/images/360_F_619264680_x2PBdGLF54sFe7kTBtAvZnPyXgvaRw0Y - Copy.jpg" alt="comment_log" style="height:50px; width:50px;border-radius:50%;margin-right:20px; border:2px solid #000">
                                <span class="text-muted">User Name</span>
                            </div>
                            <p class="text-muted mt-2 text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam, suscipit.</p>
                            <button type="button" class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#replyFrom">
                                Reply</button>

                            <!-- reply section -->
                            <div class="collapse" id="replyFrom">
                                <div class="card">
                                    <div class="card-body mt-2">
                                        <form action="">
                                            <div class="form-group mb-3">
                                                <label for="">Name:</label>
                                                <input type="text" class="form-control">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="" class="form-label">Email:</label>
                                                <input type="text" class="form-control">
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="" class="form-label">Comment:</label>
                                                <textarea name="comment" id="comment" cols="6" rows="6" class="form-control"></textarea>
                                            </div>
                                            <button class="btn btn-success btn-sm">Reply</button>
                                        </form>
                                    </div>
                                </div>


                                <!-- Nested Comment section -->
                                <div class="ms-4 mt-3">
                                    <div class="d-flex align-items-center">
                                        <img src="./assets/images/360_F_619264680_x2PBdGLF54sFe7kTBtAvZnPyXgvaRw0Y - Copy.jpg" alt="" style="height:50px; border:2px solid #000; width:50px;border-radius:50%;margin-right:20px;">
                                        <span class="text-muted">User Name2</span>
                                    </div>
                                    <p class="text-muted mt-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam, suscipit.</p>
                                    <button type="button" class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#replyFrom1">
                                        Reply</button>
                                    <div class="card border-0">
                                        <div class="card-body mt-2">
                                            <div class="collapse" id="replyFrom1">
                                                <form action="">
                                                    <div class="form-group mb-3">
                                                        <label for="">Name:</label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="" class="form-label">Email:</label>
                                                        <input type="text" class="form-control">
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label for="" class="form-label">Comment:</label>
                                                        <textarea name="comment" id="comment" cols="6" rows="6" class="form-control"></textarea>
                                                    </div>
                                                    <button class="btn btn-success btn-sm">Reply</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                    </div>
                    <div class="col-lg-4 py-3 sticky">
                        <h5 class="recent-head">Resent Post</h5>
                        <?php
                        $limit = 4;
                        $select_recent = "select * from blog ORDER BY id DESC LIMIT {$limit}";
                        $result_recent = mysqli_query($conn, $select_recent) or die("Error");
                        if (mysqli_num_rows($result_recent)) {
                            while ($row2 = mysqli_fetch_assoc($result_recent)) {
                        ?>
                                <div class="recent-info">
                                    <span>
                                        <a href="single.php?id=<?php echo $row2['id'] ?>"><img src="./admin/Blog_img/banner/<?php echo $row2['image_1'] ?>" alt="" class="img-fluid">
                                        </a>
                                    </span>
                                    <h1>
                                        <?php echo substr($row2['blog_title'], 0, 150) ?>....
                                        <a href="single.php?id=<?php echo $row2['id'] ?>">Read More</a>
                                    </h1>
                                </div>
                        <?php }
                        }  ?>


                    </div>
        </div>

    </div>
    </div>
</section>

<?php

include('footer.php');

?>