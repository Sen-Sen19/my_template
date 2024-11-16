


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Web Template</title>
  <link rel="icon" href="dist/img/logo.ico" type="image/x-icon" />
  <link rel="stylesheet" href="dist/css/font.min.css">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
  <div class="login-box">
    <div class="card">
      <div class="card-body login-card-body">
      <div class="login-logo">
      <img src="dist/img/owl.png" style="height:150px;">
      <h2><b>Sen</b></h2>
    </div>
        <p class="login-box-msg"><b>Sign in to start your session</b></p>

        <form action="<?=htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" id="login_form">
          <div class="form-group">
            <div class="input-group">
              <input type="text" class="form-control" id="username" name="username" placeholder="Username" autocomplete="off" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col">
              <button type="submit" class="btn bg-primary btn-block" name="Login" value="login">Login</button>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col">
              <button type="button" href="#" target="_blank" class="btn bg-danger btn-block" id="wi">Work Instruction</button>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <center>
                <a href="page/viewer/">Go Back to Home Page</a>
              </center>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

<!-- jQuery -->
<script src="plugins/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<noscript>
    <br>
    <span>We are facing <strong>Script</strong> issues. Kindly enable <strong>JavaScript</strong>!!!</span>
    <br>
    <span>Call IT Personnel Immediately!!! They will fix it right away.</span>
</noscript>

</body>
</html>

