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
                        <h2>Log in</h2>
                        <div class="bt-option">
                            <a href="/myWeb/GYMKHANA/member/index.php">Home</a>
                            <a href="#">Pages</a>
                            <span>Log In</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="blog-section spad">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 p-0 mx-auto"> <!-- Center the content within the column -->
                    <div class="leave-comment">
                        <h5>log in now!</h5>
                        <form method="post" action="../Requires/mysql.php">
                            <input type="text" name="customer_username" placeholder="Username">
                            <input type="password" name="customer_password" placeholder="Password">
                            <a href="/myWeb/GYMKHANA/member/upage/uforgotpass.php">
                                <p>Forgot Password</p>
                            </a>
                            <a href="/myWeb/GYMKHANA/member/upage/uregister.php">
                                <p>Create New Account</p>
                            </a>
                            <button name="login_btn" type="submit">Log in</button>
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