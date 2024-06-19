<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>GymKhana | Services</title>
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
                        <h2>Services</h2>
                        <div class="bt-option">
                            <a href="/myWeb/GYMKHANA/member/index.php">Home</a>
                            <span>Services</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Pricing Section Begin -->
    <section class="pricing-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>SUBSCRIBE NOW</span>
                        <h2>subscribe to our plan and join any classes without limit!</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <?php
                $select_query = 'SELECT * FROM plan';
                $select_query_run = mysqli_query($con, $select_query);

                if ($select_query_run) {
                    // Assuming customer_plan is stored in the session
                    if (isset($_SESSION['auth_user']) && isset($_SESSION['auth_user']['customer_plan'])) {
                        $customer_plan = $_SESSION['auth_user']['customer_plan'];

                        // Loop through the results
                        while ($plan = mysqli_fetch_assoc($select_query_run)) {
                            ?>
                            <div class="col-lg-4 col-md-8">
                                <div class="ps-item">
                                    <h3>
                                        <?php echo $plan['plan_name']; ?>
                                    </h3>
                                    <div class="pi-price">
                                        <h2>RM
                                            <?php echo $plan['plan_price']; ?>
                                        </h2>
                                        <span>
                                            <?php echo $plan['plan_duration']; ?> days
                                        </span>
                                    </div>
                                    <ul>
                                        <li>Free Entry</li>
                                        <li>Unlimited equipments</li>
                                        <li>Personal trainer</li>
                                        <li>Weight losing classes</li>
                                        <li>Join classes without limits</li>
                                        <li>No time restriction</li>
                                    </ul>

                                    <?php if (isset($_SESSION['auth'])): ?>
                                        <?php if ($customer_plan == 'No Active Plan'): ?>
                                            <a href="/myWeb/GYMKHANA/member/upage/upayment.php?plan_id=<?php echo $plan['plan_id']; ?>"
                                                class="primary-btn pricing-btn">Enroll now</a>
                                        <?php else: ?>
                                            <button class="primary-btn pricing-btn enrolled-btn" disabled>Already Enrolled</button>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <a class="primary-btn pricing-btn" href="/myWeb/GYMKHANA/member/upage/login.php">Sign In to
                                            Enroll</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        // Handle the case when customer_plan is not set (session not logged in)
                        $customer_plan = 'No Active Plan'; // or set a default value
                        // Loop through the results
                        while ($plan = mysqli_fetch_assoc($select_query_run)) {
                            ?>
                            <div class="col-lg-4 col-md-8">
                                <div class="ps-item">
                                    <h3>
                                        <?php echo $plan['plan_name']; ?>
                                    </h3>
                                    <div class="pi-price">
                                        <h2>RM
                                            <?php echo $plan['plan_price']; ?>
                                        </h2>
                                        <span>
                                            <?php echo $plan['plan_duration']; ?> days
                                        </span>
                                    </div>
                                    <ul>
                                        <li>Free Entry</li>
                                        <li>Unlimited equipments</li>
                                        <li>Personal trainer</li>
                                        <li>Weight losing classes</li>
                                        <li>Join classes without limits</li>
                                        <li>No time restriction</li>
                                    </ul>
                                    <a class="primary-btn pricing-btn" href="/myWeb/GYMKHANA/member/upage/login.php">Sign In to
                                        Enroll</a>
                                </div>
                            </div>
                            <?php
                        }
                    }
                } else {
                    // Your code for handling a failed query execution
                    echo 'Error: ' . mysqli_error($con);
                }
                ?>
            </div>
        </div>
    </section>
    <!-- Pricing Section End -->

    <?php
    if (!isset($_SESSION['auth'])): ?>
        <section class="banner-section set-bg" data-setbg="../img/banner-bg.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="bs-text">
                            <h2>Log In or register now to start subscribing to our plan</h2>
                            <a href="/myWeb/GYMKHANA/member/upage/ulogin.php" class="primary-btn btn-normal">Log
                                in/Register</a>
                        </div>
                    </div>
                </div>
            </div>f
        </section>
    <?php endif; ?>

    <!-- Services Section Begin -->

    <section class="services-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>What we do?</span>
                        <h2>PUSH YOUR LIMITS FORWARD</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                $select_query = "SELECT trainer.trainer_name, class.class_name, class.class_desc, trainer.trainer_image 
                FROM class 
                INNER JOIN trainer ON class.trainer_id = trainer.trainer_id";

                $result = mysqli_query($con, $select_query);

                if ($result && mysqli_num_rows($result) > 0) {
                    foreach ($result as $row) {
                        $trainer_name = $row['trainer_name'];
                        $class_name = $row['class_name'];
                        $class_desc = $row['class_desc'];
                        $trainer_image = $row['trainer_image'];
                        ?>
                        <div class="col-lg-3 col-md-6 p-0">
                            <div class="ss-pic">
                                <img src="<?= $trainer_image ?>" alt="">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 p-0">
                            <div class="ss-text">
                                <h4>
                                    <?= $trainer_name ?>
                                </h4>
                                <p>
                                    <?= $class_name ?>
                                </p>
                                <a href="uclass-details.php?class=<?= urlencode($class_name) ?>">Explore</a>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "No classes found.";
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Services Section End -->

    <?php
    include("../Requires/footeruser.php");
    ?>
</body>
<style>
    .enrolled-btn {
        display: block;
        margin: 0 auto;
    }
</style>

</html>