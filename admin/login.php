<!doctype html>
<html lang="en">
  <head>
    <title>Login Page</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <style>
    body{
        font-family: 'Times New Roman';
        background-image: url("../assets/images/Tiny doctors and patients near hospital flat vector illustration.jpg");
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
    }
</style>
  <body>
      <div class="container mt-5 ">
        <div class="row justify-content-center">
            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                <div class="card shadow">
                <div class="card-header text-center text-primary p-2">
                <h1> Login Page</h1>    
                </div>
                <div class="card-body">
            <form action="" method="post">
                <div class="form-group">
                    <label for="">Username or Email</label>
                    <input type="text" name="user__name/email" class="form-control" placeholder="Username/Email">
                </div>
                <div class="form-group">
                    <label for="">Select Role:</label>
                    <select name="user_type" id="" class="form-control">
                        <option selected>Select User Role</option>
                        <option value="admin">Admin</option>
                        <option value="doctor">Doctor</option>
                        <option value="patient">Patient</option>
                        <option value="laber">Laber</option>
                    </select>
                </div>
                <div class="fomr-group">
                    <label for="">Password</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <div class="form-check mt-2">
                    <input type="checkbox" name="remember" class="form-check-input">
                    <label for="">Remember</label>
                </div>
                <div class="from-group">
                    <button type="submit" name="login" class="btn btn-success w-100">Login</button>
                </div>
                <hr>
                <div class="form-group">
    <p>Don't you have an account? 
        <a href="#">Create Now</a>
    </p>
</div>

<div class="form-group">
    <a href="forgot_password.php">Forgot password?</a>
</div>        
            </form>
             </div>
                </div>
                </div>
            </div>
        </div>
      </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>