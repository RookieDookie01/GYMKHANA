<!-- updateprofile.php -->
<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>GymKhana | Profile</title>
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
                        <h2>Profile</h2>
                        <div class="bt-option">
                            <a href="/myWeb/GYMKHANA/member/index.php">Home</a>
                            <span>Profile</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="blog-section spad">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 p-0 mx-auto">
                    <?php
                    if (isset($_SESSION['auth'])) {
                        ?>
                        <div class="leave-comment">
                            <form method="post" action="../Requires/mysql.php">
                                <h5>Your Profile</h5>
                                <?php
                                $customer_username = $_SESSION['auth_user']['customer_username'];
                                $customer_query = "SELECT * FROM customer WHERE customer_username ='$customer_username'";
                                $customer_run = mysqli_query($con, $customer_query);

                                if (mysqli_num_rows($customer_run) > 0) {
                                    $customer = mysqli_fetch_assoc($customer_run);
                                    ?>
                                    <?php if (!empty($customer['customer_name'])): ?>
                                        <h5>Name :
                                            <?= $customer['customer_name']; ?>
                                        </h5>
                                    <?php endif; ?>

                                    <?php if (!empty($customer['customer_email'])): ?>
                                        <h5>Email :
                                            <?= $customer['customer_email']; ?>
                                        </h5>
                                    <?php endif; ?>

                                    <?php if (!empty($customer['customer_contact'])): ?>
                                        <h5>Contact :
                                            <?= $customer['customer_contact']; ?>
                                        </h5>
                                    <?php endif; ?>

                                    <?php if (!empty($customer['customer_address'])): ?>
                                        <h5>Address :
                                            <?= $customer['customer_address']; ?>
                                        </h5>
                                    <?php endif; ?>

                                    <?php if (!empty($customer['customer_plan'])): ?>
                                        <h5>Current Plan :
                                            <?= $customer['customer_plan']; ?>
                                        </h5>
                                    <?php endif; ?>

                                    <?php
                                    // Fetch membership details
                                    $customer_id = $customer['customer_id'];
                                    $membership_query = "SELECT * FROM membership WHERE customer_id ='$customer_id'";
                                    $membership_run = mysqli_query($con, $membership_query);

                                    if ($membership_run && mysqli_num_rows($membership_run) > 0) {
                                        $membership = mysqli_fetch_assoc($membership_run); ?>
                                        <h5>Membership Start Date:
                                            <?= date('d-m-Y', strtotime($membership['membership_start_date'])); ?>
                                        </h5>
                                        <h5>Membership End Date:
                                            <?= date('d-m-Y', strtotime($membership['membership_end_date'])); ?>
                                        </h5>
                                    <?php } ?>

                                    &nbsp;
                                </form>
                            </div>
                            <div class="leave-comment">
                                <div class="button-container">
                                    <a href="/myWeb/GYMKHANA/member/upage/umyclass.php"
                                        class="modern-button button-left">My Class</a>
                                    <a href="/myWeb/GYMKHANA/member/upage/uupdateprofile.php"
                                        class="modern-button button-left">Update Profile</a>
                                    <a href="/myWeb/GYMKHANA/member/upage/uupdatepassword.php"
                                        class="modern-button button-right">Update Password</a>
                                </div>
                            </div>
                            <?php
                                }
                    } else {
                        ?>
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
<style>
    .button-container {
        display: flex;
    }

    .modern-button {
        flex: 1;
        text-align: center;
        text-decoration: none;
        padding: 15px;
        margin: 5px;
        border: none;
        cursor: pointer;
        font-size: 18px;
        font-weight: bold;
        color: #ffffff;
        transition: background-color 0.3s;
        overflow: hidden;
    }

    .button-left,
    .button-right {
        position: relative;
        background-color: #FF7700;
        border-radius: 0;
    }

    .button-left::before,
    .button-right::before {
        content: "";
        position: absolute;
        top: 0;
        bottom: 0;
        width: 10px;
        background-color: #FF7700;
        clip-path: polygon(100% 0, 0 50%, 100% 100%);
    }

    .button-left::before {
        left: -10px;
    }

    .button-right::before {
        right: -10px;
        transform: scaleX(-1);
    }

    .modern-button:hover {
        background-color: #FF6347;
    }
</style>

</html>