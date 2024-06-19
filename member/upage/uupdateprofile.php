<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>GymKhana | Update Profile</title>
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
                        <h2>Update Profile</h2>
                        <div class="bt-option">
                            <a href="/myWeb/GYMKHANA/member/index.php">Home</a>
                            <a href="/myWeb/GYMKHANA/member/upage/uprofile.php">Profile</a>
                            <span>Update Profile</span>
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
                                <h5>Update Profile</h5>
                                <?php
                                $customer_username = $_SESSION['auth_user']['customer_username'];
                                $customer_query = "SELECT * FROM customer WHERE customer_username ='$customer_username'";
                                $customer_run = mysqli_query($con, $customer_query);

                                if (mysqli_num_rows($customer_run) > 0) {
                                    $customer = mysqli_fetch_assoc($customer_run);
                                    ?>

                                    <?php if (empty($customer['customer_email'])): ?>
                                        <input type="text" placeholder="Add Email : " name="customer_email" required
                                            pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}">
                                    <?php else: ?>
                                        <input type="text" placeholder=" Current Email : <?= $customer['customer_email']; ?>"
                                            name="customer_email" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}">
                                    <?php endif; ?>

                                    <?php if (empty($customer['customer_contact'])): ?>
                                        <input type="text" placeholder="Add Contact : " name="customer_contact" required
                                            pattern="\d{10,11}">
                                    <?php else: ?>
                                        <input type="text" placeholder="Current Contact : <?= $customer['customer_contact']; ?>"
                                            name="customer_contact" required pattern="\d{10,11}">
                                    <?php endif; ?>

                                    <?php if (empty($customer['customer_address'])): ?>
                                        <input type="text" placeholder="Add Address : " name="customer_address" required>
                                    <?php else: ?>
                                        <input type="text" placeholder="Current Address : <?= $customer['customer_address']; ?>"
                                            name="customer_address" required>
                                    <?php endif; ?>

                                    <!-- Add hidden fields to store current values -->
                                    <input type="hidden" name="current_email" value="<?= $customer['customer_email']; ?>">
                                    <input type="hidden" name="current_contact" value="<?= $customer['customer_contact']; ?>">
                                    <input type="hidden" name="current_address" value="<?= $customer['customer_address']; ?>">
                                    <button type="submit" name="update_profile_btn">Update Profile</button>
                                </form>
                            </div>
                            <?php
                                }
                    } else { ?>
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