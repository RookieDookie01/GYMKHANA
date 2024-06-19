<!DOCTYPE html>
<html lang="zxx">
<title>GymKhana | Main Page</title>
<?php
include("Requires/headeruser.php");
?>

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Gym Template">
    <meta name="keywords" content="Gym, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald:300,400,500,600,700&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/flaticon.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/barfiller.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<body>
    <div id="preloder">
        <div class="loader"></div>
    </div>
    <section class="hero-section">
        <div class="hs-slider owl-carousel">
            <div class="hs-item set-bg" data-setbg="img/hero/hero-1.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 offset-lg-6">
                            <?php
                            if (isset($_SESSION['auth'])) { ?>
                                <div class="hi-text">
                                    <span>Shape your body</span>
                                    <h1>Be <strong>strong</strong> training hard</h1>
                                    <?php
                                    if (isset($_SESSION['auth'])) { ?>
                                        <span>Hello,
                                            <?= $_SESSION['auth_user']['customer_name']; ?>
                                        </span></p>
                                    <?php } ?>
                                    <a href="/myWeb/GYMKHANA/member/upage/uclasses.php" class="primary-btn">Go to classes</a>
                                </div>
                            <?php } else {?>
                                <div class="hi-text">
                                    <span>Shape your body</span>
                                    <h1>Be <strong>strong</strong> training hard</h1>
                                    <a href="/myWeb/GYMKHANA/member/upage/ulogin.php" class="primary-btn">Log In Now</a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hs-item set-bg" data-setbg="img/hero/hero-2.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 offset-lg-6">
                        <?php
                            if (isset($_SESSION['auth'])) { ?>
                                <div class="hi-text">
                                    <span>Shape your body</span>
                                    <h1>Be <strong>strong</strong> training hard</h1>
                                    <?php
                                    if (isset($_SESSION['auth'])) { ?>
                                        <span>Hello,
                                            <?= $_SESSION['auth_user']['customer_name']; ?>
                                        </span></p>
                                    <?php } ?>
                                    <a href="/myWeb/GYMKHANA/member/upage/uservices.php" class="primary-btn">Make a plan</a>
                                </div>
                            <?php } else {?>
                                <div class="hi-text">
                                    <span>Shape your body</span>
                                    <h1>Be <strong>strong</strong> training hard</h1>
                                    <a href="/myWeb/GYMKHANA/member/upage/uregister.php" class="primary-btn">Register Now</a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
    include("ushortcut/uschoseus.php");
    if (!isset($_SESSION['auth'])) {
        include("ushortcut/usregister.php");
    }
    include("Requires/footeruser.php");
    ?>
</body>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/masonry.pkgd.min.js"></script>
<script src="js/jquery.barfiller.js"></script>
<script src="js/jquery.slicknav.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/main.js"></script>

</html>