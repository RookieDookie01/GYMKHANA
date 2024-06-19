<!DOCTYPE html>
<html lang="zxx">
<title>GymKhana | Login</title>
<?php
include("../Requires/headeruser.php");
?>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="../img/breadcrumb-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb-text">
                        <h2>Forgot Password</h2>
                        <div class="bt-option">
                            <a href="/myWeb/GYMKHANA/member/index.php">Home</a>
                            <a href="#">Pages</a>
                            <span>Forgot Password</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="blog-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 p-0">
                    <div class="leave-comment">
                        <h5>Forgot your password?</h5>
                        <form action="#">
                            <input type="text" placeholder="Enter Your Email">
                            <a href="/myWeb/GYMKHANA/member/upage/ulogin.php"><p>Log In to An Existing Account</p></a>
                            <button type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
    include("../Requires/footeruser.php");
    ?>
    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
</body>

</html>

<!-- /.login-box -->