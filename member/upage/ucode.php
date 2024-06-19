<!DOCTYPE html>
<html lang="zxx">
<title>GymKhana | Regisration Code</title>
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
                        <h2>Regisration Code</h2>
                        <div class="bt-option">
                            <a href="/myWeb/GYMKHANA/member/index.php">Home</a>
                            <a href="#">Pages</a>
                            <a href="/myWeb/GYMKHANA/member/upage/utrainer.php">Trainer</a>
                            <span>Regisration Code</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="blog-section spad">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="leave-comment">
                        <h5>Enter the 6-digit code given</h5>
                        <form method="post" action="../Requires/mysql.php" class="comment-form">
                            <div class="form-group">
                                <input type="password" name="apply_code" class="form-control" placeholder="Code"
                                    required>
                            </div>
                            <div class="form-group text-center">
                                <button name="code_btn" type="submit">submit</button>
                            </div>
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