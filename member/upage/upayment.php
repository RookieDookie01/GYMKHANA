<!DOCTYPE html>
<html lang="zxx">
<title>GymKhana | Payment</title>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>
    <?php
    include("../Requires/headeruser.php");
    ?>
    <style>
        .expiration-inputs {
            display: flex;
            gap: 10px;
            /* Adjust the gap between MM and YY inputs */
        }

        .expiration-inputs input {
            width: 40px;
            /* Adjust the width of the input boxes as needed */
        }
    </style>
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="../img/breadcrumb-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb-text">
                        <h2>PAYMENT</h2>
                        <div class="bt-option">
                            <a href="/myWeb/GYMKHANA/member/index.php">Home</a>
                            <span>Payment</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="blog-section spad">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 p-0" style="margin-left: auto; margin-right: auto;">
                    <!-- Center the content within the column -->
                    <div class="leave-comment">
                        <?php
                        // Check if the 'plan_id' parameter is set in the URL
                        if (isset($_GET['plan_id'])) {
                            $selectedPlanId = $_GET['plan_id'];

                            // Fetch plan details based on the selected plan_id
                            $select_query = "SELECT * FROM plan WHERE plan_id = $selectedPlanId";
                            $select_query_run = mysqli_query($con, $select_query);

                            if ($select_query_run && mysqli_num_rows($select_query_run) > 0) {
                                $plan = mysqli_fetch_assoc($select_query_run);
                                $plan_name = $plan['plan_name'];
                                $plan_price = $plan['plan_price'];

                                $formattedAmount = number_format($plan_price, 2);
                                // Display plan information in the form
                                echo "<h5>Plan Name: $plan_name</h5>";
                                echo "<h5>Total Amount: RM$formattedAmount</h5>";
                            } else {
                                // Handle the case when no plan is found for the provided plan_id
                                echo "<p>Error: Plan not found.</p>";
                            }
                        } else {
                            // Handle the case when 'plan_id' parameter is not set
                            echo "<p>Error: Plan ID not provided.</p>";
                        }
                        ?>
                        <form method="post" action="../Requires/mysql.php">
                            <input type="hidden" name="plan_id" value="<?php echo $selectedPlanId; ?>">

                            <input type="text" placeholder="Card Number" name="card_number" required>
                            <input type="text" placeholder="Card Holder" name="card_holder" required>
                            <div class="expiration-inputs">
                                <input type="text" placeholder="CVC" name="card_cvc" required>
                                <input type="text" placeholder="MM" name="card_mm" required>
                                <input type="text" placeholder="YY" name="card_yy" required>
                            </div>
                            <a href="/myWeb/GYMKHANA/member/upage/uservices.php">
                                <p>View Plan</p>
                            </a>
                            <button type="submit" name="pay_btn">Confirm Payment</button>
                        </form>
                    </div>
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