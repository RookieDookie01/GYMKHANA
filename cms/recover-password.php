<?php
include 'Config/cms-config.php';
include 'Requires/function.php';
if(isset($_SESSION["user_id"]) && isset($_SESSION['user_name'])){
    header("Location: dashboard.php");
    exit;
}

//content
include "Requires/header.php";
?>
<head>
  <style>
    @keyframes myAnimation {
      0% {
        transform: translateY(0);
      }
      50% {
        transform: translateY(50px);
      }
      100% {
        transform: translateY(0);
      }
    }
    .card{
      animation-duration: 1s;
    }
    .card1{

    }
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box" id="box1">
  <div class="login-logo">
    <a href="../../index2.html"><b>Admin</b>LTE</a>
  </div>

  <!-- /.login-logo -->
  <div class="card" id="card1">
    <div class="card-body login-card-body">
      <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>

      <form action="login.html" method="post" >
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Change password</button>
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

  <div class="card" id="card2">
    <div class="card-body login-card-body">
      <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>

      <form action="#" method="post" id="forgotPassword">
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email">
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
</div>
<!-- /.login-box -->



<!--no need footer-->
<script src="Plugin/jquery/jquery.min.js"></script>
<script src="Plugin/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="Plugin/toast/jquery.toast.js"></script>
<script src="Dist/js/adminlte.min.js"></script>
<script src="Plugin/swal/dist/sweetalert2.js"></script>

<script src="Scripts/all.js"></script>
</body>
</html>
