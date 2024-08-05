<?php require 'process/login.php';

if (isset($_SESSION['username'])) {
  if ($_SESSION['role'] == 'admin') {
     header('location: page/admin/view.php');
     exit;
 }elseif($_SESSION['role'] == 'user'){
     header('location: page/user/view.php');
     exit;
 }
}
?>





<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sen Template</title>

  <link rel="icon" href="dist/img/penguin.png" type="image/x-icon" />
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="dist/css/font.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<style>
  body {
    background-image: url('dist/img/background.png');
    background-size: cover;
    background-position: center;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
  }
  

  .form1 {
    background: rgba(255, 255, 255, .1);
    border-radius: 16px;
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.5); 
    backdrop-filter: blur(10px); 
    border: 1px solid rgba(255, 255, 255, 0.5); 
    padding: 20px;
    width: 100%;
    max-width: 400px;
    position: relative; 
    overflow: hidden; 
}

  .login-logo img {
    height: 80px;
  }

  .login-logo h2 {
    color: black;
  }
  .login-box .btn {
  background: rgba(135, 206, 250, 0.3); 
  color: black; 
  border: 2px solid rgba(0, 102, 204, 0.1); 
  border-radius: 12px; 
  padding: 12px 20px; 
  font-size: 16px;
  text-transform: uppercase; /
  letter-spacing: 1px; 
  transition: background 0.3s, transform 0.3s; 
  backdrop-filter: blur(8px); 
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); 
  width: 100%; 
}


.login-box .btn:hover {
  background: rgba(255, 255, 255, 0.4);
  transform: scale(1.05);
}

.login-box .btn:active {
  background: rgba(255, 255, 255, 0.6);
  transform: scale(0.95); 
}

</style>
<div class="form1">
<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <img src="dist/img/penguin.png" style="height:50px;">
      <h2><b>Sen</b></h2>
    </div>
   
        <p class="login-box-msg"><b>Sign in</b></p>

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
            <button type="submit" class="btn" name="Login" value="login">Login</button>

            </div>
          </div>
          
          <div class="row">
        
          </div>
        </form>
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
 