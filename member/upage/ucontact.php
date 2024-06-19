<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>GymKhana | Contact</title>
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
                        <h2>Contact Us</h2>
                        <div class="bt-option">
                            <a href="/myWeb/GYMKHANA/member/index.php">Home</a>
                            <a href="#">Pages</a>
                            <span>Contact us</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Contact Section Begin -->
    <section class="contact-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title contact-title">
                        <span>Contact Us</span>
                        <h2>GET IN TOUCH</h2>
                        <p>&nbsp;</p>
                        <div class="col-lg-12">
                            <div class="leave-comment">
                                <?php
                                if (!isset($_SESSION['auth'])): ?>
                                    <div class="bs-text mx-auto text-center">
                                        <h2>SIGN UP NOW TO ADD CLASSES, VIEW AND UPDATE YOUR PROFILE</h2>
                                        <a href="/myWeb/GYMKHANA/member/upage/ulogin.php" class="primary-btn btn-normal">Log
                                            in/Register</a>
                                    </div>
                                <?php else: ?>
                                    <?php
                                    $customer_id = $_SESSION['auth_user']['customer_id'];
                                    $customer_email = $_SESSION['auth_user']['customer_email'];
                                    ?>
                                    <form action="../Requires/mysql.php" method="post">
                                        <select class="custom-select my-custom-select" name="comment_type" id="comment_type"
                                            required>
                                            <option class="default-option" selected disabled>Choose your option</option>
                                            <option value="Ideas">Ideas</option>
                                            <option value="Complaint">Complaint</option>
                                            <option value="Profile Issues">Profile Issues</option>
                                            <option value="Class Issues">Class Issues</option>
                                        </select>
                                        &nbsp;
                                        <textarea name="comment" placeholder="Comment"></textarea>
                                        <button type="submit" name="comment_btn">Submit</button>
                                    </form>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="map">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12087.069761554938!2d-74.2175599360452!3d40.767139456514954!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c254b5958982c3%3A0xb6ab3931055a2612!2sEast%20Orange%2C%20NJ%2C%20USA!5e0!3m2!1sen!2sbd!4v1581710470843!5m2!1sen!2sbd"
                    height="550" style=lscreen=""></iframe>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->

    <?php
    include("../Requires/footeruser.php");
    ?>

</body>
<style>
    .custom-select {
        width: 100%;
        padding: 10px;
        height: 45px;
        /* Adjust the height as needed */
        font-size: 16px;
        appearance: none;
        outline: none;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: rgba(0, 0, 0, 0.9);
        cursor: pointer;
        color: white;
        /* Set text color to white */
    }

    .default-option {
        color: #777;
    }
</style>




</html>