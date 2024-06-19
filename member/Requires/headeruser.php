<?php
include("mysql.php");

// if (isset($_SESSION['message'])) {
//     echo "<script>alert('{$_SESSION['message']}');</script>";
//     unset($_SESSION['message']); 
// }
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
    <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="../css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="../css/flaticon.css" type="text/css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="../css/barfiller.css" type="text/css">
    <link rel="stylesheet" href="../css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="../css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="../css/style.css" type="text/css">
</head>
<body>
    <header class="header-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3">
                    <div class="logo">
                        <a href="/index.php">
                            <img src="img/GYMKHANA.png" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="nav-menu">
                        <ul>
                            <li><a href="/myWeb/GYMKHANA/member/index.php">Home</a></li>
                            <li><a href="/myWeb/GYMKHANA/member/upage/uprofile.php">Profile</a></li>
                            <li><a href="/myWeb/GYMKHANA/member/upage/uservices.php">Services</a></li>
                            <li><a href="/myWeb/GYMKHANA/member/upage/uclasses.php">Classes</a></li>
                            <li><a href="/myWeb/GYMKHANA/member/upage/ucontact.php">Contact</a></li>
                            <li><a href="#">Pages</a>
                                <ul class="dropdown">
                                    <li><a href="/myWeb/GYMKHANA/member/upage/utrainer.php">Our Trainer</a></li>
                                    <li><a href="/myWeb/GYMKHANA/member/upage/uabout-us.php">About us</a></li>
                                    <li><a href="/myWeb/GYMKHANA/member/upage/ubmi-calculator.php">Bmi calculate</a></li>
                                    <li><a href="/myWeb/GYMKHANA/member/upage/ublog.php">Our blog</a></li>
                                </ul>
                            </li>
                            <?php
                            if (!isset($_SESSION['auth'])) { ?>
                                <li><a href="/myWeb/GYMKHANA/member/upage/ulogin.php">Log in</a></li>
                            <?php } ?>
                            <?php if (isset($_SESSION['auth'])) { ?>
                                <li><a href="/myWeb/GYMKHANA/member/upage/ulogout.php">Log out</a></li>
                            <?php } ?>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="canvas-open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>

    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="canvas-close">
            <i class="fa fa-close"></i>
        </div>
        <div class="canvas-search search-switch">
            <i class="fa fa-search"></i>
        </div>
        <nav class="canvas-menu mobile-menu">
            <ul>
                <li><a href="/myWeb/GYMKHANA/index.php">Home</a></li>
                <li><a href="/myWeb/GYMKHANA/member/upage/uprofile.php">Profile</a></li>
                <li><a href="/myWeb/GYMKHANA/member/upage/uservices.php">Services</a></li>
                <li><a href="/myWeb/GYMKHANA/member/upage/uclasses.php">Classes</a></li>
                <li><a href="/myWeb/GYMKHANA/member/upage/ucontact.php">Contact</a></li>
                <li>
                    <a href="#">Pages</a>
                    <ul class="dropdown">
                        <li><a href="/myWeb/GYMKHANA/member/upage/utrainer.php">Our Trainer</a></li>
                        <li><a href="/myWeb/GYMKHANA/member/upage/uabout-us.php">About us</a></li>
                        <li><a href="/myWeb/GYMKHANA/member/upage/ubmi-calculator.php">Bmi calculate</a></li>
                        <li><a href="/myWeb/GYMKHANA/member/upage/ublog.php">Our blog</a></li>
                    </ul>
                </li>
                <?php
                if (!isset($_SESSION['auth'])) { ?>
                    <li><a href="/myWeb/GYMKHANA/member/upage/ulogin.php">Log in</a></li>
                <?php } ?>
                <?php if (isset($_SESSION['auth'])) { ?>
                    <li><a href="/myWeb/GYMKHANA/member/upage/ulogout.php">Log out</a></li>
                <?php } ?>
            </ul>
        </nav>
    </div>
</body>