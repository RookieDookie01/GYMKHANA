<?php
include 'Config/cms-config.php';
include 'Requires/function.php';
if(isset($_SESSION["trainer_id"]) && isset($_SESSION['trainer_name'])){
    header("Location: dashboard.php");
    exit;
}

//content
include "Requires/header.php";
?>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="index.php"><b>Gymkhana</b>GYM</a>
  </div>
  <!-- /.login-logo -->
  <div class="card" id="card1">
    <div class="card-body login-card-body">
      <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>

      <form action="#" method="post" id="forgotPassword">
        <div class="input-group mb-3">
          <input type="email" class="email form-control" name="email" required placeholder="Email" id="forgotEmail">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" id="forgotbtn" class="btn btn-primary btn-block">Request new password</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1">
        <a href="index.php">Login</a>
      </p>
      
    </div>
    <!-- /.login-card-body -->
  </div>

  <div class="card" style="display:none;" id="card2">
    <div class="card-body login-card-body">
      <p class="login-box-msg">The 6 digit code was sent to your email please check it and fill in here. You have 60 second to fill up this else the system will redirect back to forgot password page</p>

      <form action="#" method="post" id="forgotPassword2">
        <div class="input-group mb-3">
          <input type="text" class="code form-control" placeholder="6 digit code">
          <div class="input-group-append">
            <div class="input-group-text">
              <span id="countdown">60</span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" id="forgotbtn2" class="btn btn-primary btn-block">Submit</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1">
        <a href="index.php">Login</a>
      </p>
      
    </div>
    <!-- /.login-card-body -->
  </div>

  <div class="card" style="display:none;" id="card3">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Please Key In your new Password</p>

      <form action="#" method="post" id="forgotPassword3">
        <div class="input-group mb-3">
          <input type="password" minlength="8" required class="form-control newpassword" placeholder="New Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fa fa-key" aria-hidden="true"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" minlength="8" required class="form-control conpassword" placeholder="Confirm Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fa fa-key" aria-hidden="true"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" id="forgotbtn3" class="btn btn-primary btn-block">Submit</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1">
        <a href="index.php">Login</a>
      </p>
      
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
<!--no need footer-->
<script src="Scripts/top.js"></script>
<script src="Plugin/jquery/jquery.min.js"></script>
<script src="Plugin/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="Plugin/toast/jquery.toast.js"></script>
<script src="Dist/js/adminlte.min.js"></script>
<script src="Plugin/swal/dist/sweetalert2.js"></script>
<script src="Plugin/pace-progress/pace.min.js"></script>
<script src="Plugin/magnific-popup/dist/jquery.magnific-popup.min.js"></script>

<script src="Scripts/all.js"></script>
</body>
</html>
