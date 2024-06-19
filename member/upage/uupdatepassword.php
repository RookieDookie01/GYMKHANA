<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>GymKhana | Update Password</title>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>
    <?php
    include("../Requires/headeruser.php");
    ?>
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="../img/breadcrumb-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb-text">
                        <h2>Update Password</h2>
                        <div class="bt-option">
                            <a href="/myWeb/GYMKHANA/member/index.php">Home</a>
                            <a href="/myWeb/GYMKHANA/member/upage/uprofile.php">Profile</a>
                            <span>Update Password</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="blog-section spad">
        <div class="container">
            <div class="row justify-content-center"> <!-- Center the content within the row -->
                <div class="col-lg-8 p-0">
                    <?php
                    if (isset($_SESSION['auth'])) {
                        ?>
                        <div class="leave-comment">
                            <form method="post" action="../Requires/mysql.php">
                                <h5>Change Password</h5>
                                <input type="password" placeholder="Current Password : " name="cpassword" required>
                                <input type="password" placeholder="New Password : " name="npassword" required>
                                <input type="password" placeholder="Confirm New Password : " name="cnpassword" required>
                                <button type="submit" name="update_password_btn">Update Password</button>
                            </form>
                        </div>

                    <?php } else { ?>
                        <div class="bs-text mx-auto">
                            <h2>SIGN UP NOW TO ADD CLASSES, VIEW AND UPDATE YOUR PROFILE</h2>
                            <a href="/myWeb/GYMKHANA/member/upage/ulogin.php" class="primary-btn btn-normal">Log
                                in/Register</a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Breadcrumb Section End -->
    <?php
    include("../Requires/footeruser.php");
    ?>
</body>

</html>