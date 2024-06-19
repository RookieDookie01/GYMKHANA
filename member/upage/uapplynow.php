<!DOCTYPE html>
<html lang="zxx">
<title>GymKhana | Trainer Application</title>
<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
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
                        <h2>Trainer Application</h2>
                        <div class="bt-option">
                            <a href="/myWeb/GYMKHANA/member/index.php">Home</a>
                            <a href="#">Pages</a>
                            <span>Apply Now</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="blog-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 p-0">
                    <div class="leave-comment">
                        <h5>Be part of us!</h5>
                        <form method="post" action="../Requires/mysql.php" enctype="multipart/form-data" required>
                            <input type="text" name="apply_name" placeholder="Full Name" required>
                            <input type="text" name="apply_class_name" placeholder="Class Name" required>
                            <select class="custom-select" name="apply_class_type" id="apply_class_type" required>
                                <option selected disabled>Choose your option</option>
                                <option value="Cardio">Cardio</option>
                                <option value="Strength">Strength</option>
                                <option value="other">Other</option>
                            </select>

                            <!-- Input field for other type -->
                            <div id="otherTypeContainer" style="display: none;">
                                <label for="otherType" style="color: white;">Enter your own type:</label>
                                <input type="text" class="form-control" name="otherType" id="otherType">
                            </div>
                            &nbsp;
                            <input type="text" name="apply_class_desc" placeholder="Class Description" required>
                            <input type="email" name="apply_email" placeholder="Email" required>
                            <input type="tel" name="apply_contact" placeholder="Contact" required>
                            <input type="text" name="apply_address" placeholder="Address" required>
                            <p>Upload Trainer Image</p>
                            <input type="file" name="apply_image" accept="image/*" required>
                            <a href="/myWeb/GYMKHANA/member/upage/utrainer.php">
                                <p>Cancel Application</p>
                            </a>
                            <button type="submit" name="apply_btn">apply now</button>
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

    <script>
        // JavaScript to toggle visibility of the input field based on the selected option
        document.getElementById('apply_class_type').addEventListener('change', function () {
            var otherTypeContainer = document.getElementById('otherTypeContainer');
            otherTypeContainer.style.display = this.value === 'other' ? 'block' : 'none';
        });
    </script>
</body>
<style>
    .custom-select {
        width: 100%;
        padding: 5px;
        font-size: 16px;
        appearance: none;
        outline: none;
        border: 1px solid #333;
        background-color: #111;
        cursor: pointer;
        color: white;
        border-radius: 0;
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