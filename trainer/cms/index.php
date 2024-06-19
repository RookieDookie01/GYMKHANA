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
    <a href="#"><b>Gymkhana</b> GYM</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="#" method="post" id="loginform" class="mb-3">
        <div class="input-group mb-3">
          <input type="text" class="form-control username" required placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control password" required placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" id="loginbtn" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

    

      <p class="mb-1">
        <a href="forgot-password.php">I forgot my password</a>
      </p>
     
    </div>
  </div>
</div>

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
<script>
$(document).ready(function(){
  var user = localStorage.getItem('user');
  if(user !== null && user !== ''){
    let userdata=JSON.parse(user);
    $(".username").val(userdata.username);
    $(".password").val(userdata.password);
    $("#remember").prop("checked",true);
  }
});
</script>

</body>
</html>
