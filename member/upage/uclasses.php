<!DOCTYPE html>
<html lang="zxx">

<body>
    <title>GymKhana | Classes</title>
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
                        <h2>Classes</h2>
                        <div class="bt-option">
                            <a href="/myWeb/GYMKHANA/member/index.php">Home</a>
                            <a href="#">Pages</a>
                            <span>Services</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <section class="class-timetable-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-title">
                        <span>My Schedule</span>
                        <h2>View Your Timetable</h2>
                    </div>
                </div>
                <div class="col-lg-6">
                    <a href="/myWeb/GYMKHANA/member/upage/umyclass.php"
                        class="primary-btn btn-normal appoinment-btn">Timetable</a>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Our Classes</span>
                        <h2>WHAT WE CAN OFFER</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                $select_query = "SELECT class.*, trainer.trainer_name, trainer.trainer_image
                    FROM class
                    INNER JOIN trainer ON class.trainer_id = trainer.trainer_id";

                $result = mysqli_query($con, $select_query);

                if ($result && mysqli_num_rows($result) > 0) {
                    foreach ($result as $row) {
                        $class_type = $row['class_type'];
                        $class_name = $row['class_name'];
                        ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="class-item">
                                <div class="ci-text">
                                    <span>
                                        <?= $class_type ?>
                                    </span>
                                    <h5>
                                        <?= $class_name ?>
                                    </h5>
                                    <a href="uclass-details.php?class=<?= urlencode($class_name) ?>"><i
                                            class="fa fa-angle-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "No trainers found.";
                }
                ?>
            </div>
        </div>
    </section>
    <!-- ChoseUs Section End -->
    <?php
    if (!isset($_SESSION['auth'])) { ?>
        <section class="banner-section set-bg" data-setbg="../img/banner-bg.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="bs-text">
                            <h2>Log In or register now to start joining our class</h2>
                            <a href="/myWeb/GYMKHANA/member/upage/ulogin.php" class="primary-btn btn-normal">Log
                                in/Register</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php }
    include("../Requires/footeruser.php");
    ?>
</body>

</html>