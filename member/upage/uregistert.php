<!DOCTYPE html>
<html lang="zxx">
<title>GymKhana | Trainer Registration</title>
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
                        <h2>Trainer Registration</h2>
                        <div class="bt-option">
                            <a href="/myWeb/GYMKHANA/member/index.php">Home</a>
                            <a href="#">Pages</a>
                            <span>Trainer Registration</span>
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
                        <h5>Complete the form below</h5>
                        <form method="post" action="../Requires/mysql.php">
                            <h5>Create an Account</h5>
                            <input type="hidden" name="apply_code"
                            value="<?php echo isset($_POST['apply_code']) ? $_POST['apply_code'] : ''; ?>">
                            <input type="text" name="trainer_username" placeholder="Username" required>
                            <input type="password" name="trainer_password" placeholder="Password" required>
                            <input type="password" name="trainer_cpassword" placeholder="Confirm Password" required>
                            <h5>Profile Detail</h5>
                            <input type="text" name="trainer_age" placeholder="Age" required>
                            <input type="text" name="trainer_height" placeholder="Height (cm)" required>s
                            <input type="text" name="trainer_weight" placeholder="Weight (kg)" required>
                            <input type="text" name="trainer_info" placeholder="Tell something about you" required>
                            <h5>Class Detail</h5>
                            <select class="custom-select" id="class_day" name="class_day" required>
                                <option selected disabled>Choose the day</option>
                                <option value="Monday">Monday</option>
                                <option value="Tuesday">Tuesday</option>
                                <option value="Wednesday">Wednesday</option>
                                <option value="Thursday">Thursday</option>
                                <option value="Friday">Friday</option>
                                <option value="Saturday">Saturday</option>
                                <option value="Sunday">Sunday</option>
                            </select>
                            &nbsp;
                            <select class="custom-select" id="class_time" name="class_time" required>
                                <option selected disabled>Choose the time</option>
                                <option value="18:00-19:00">6pm - 7pm</option>
                                <option value="19:00-20:00">7pm - 8pm</option>
                                <option value="20:00-21:00">8pm - 9pm</option>
                                <option value="21:00-23:00">9pm - 11pm</option>
                            </select>
                            &nbsp;
                            <button type="submit" name="registert_btn">Submit</button>
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

    .custom-select::-ms-expand {
        display: none;
    }

    /* Style for the arrow icon (optional) */
    .custom-select::after {
        content: '\25BC';
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        pointer-events: none;
    }

    #otherTypeContainer {
        margin-top: 10px;
    }

    #otherTypeContainer label {
        margin-bottom: 5px;
    }
</style>

</html>