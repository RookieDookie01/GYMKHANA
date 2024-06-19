<!DOCTYPE html>
<html lang="zxx">
<title>GymKhana | Team</title>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Section Begin -->
    <?php
    include("../Requires/headeruser.php");
    ?>
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="../img/breadcrumb-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb-text">
                        <h2>Our Trainer</h2>
                        <div class="bt-option">
                            <a href="/myWeb/GYMKHANA/member/index.php">Home</a>
                            <span>Our Trainer</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Team Section Begin -->
    <section class="team-section team-page spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="team-title">
                        <div class="section-title">
                            <span>Our Team</span>
                            <h2>Below are the Trainers</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                $select_query = "SELECT * FROM trainer";

                $result = mysqli_query($con, $select_query);

                if ($result && mysqli_num_rows($result) > 0) {
                    foreach ($result as $row) {
                        $trainer_name = $row['trainer_name'];
                        $trainer_email = $row['trainer_email'];
                        $trainer_image = $row['trainer_image'];
                        ?>
                        <div class="col-lg-4 col-sm-6">
                            <div class="ts-item set-bg" data-setbg="<?= $trainer_image ?>">
                                <div class="ts_text">
                                    <h4>
                                        <?= $trainer_name ?>
                                    </h4>
                                    <span>
                                        <?= $trainer_email ?>
                                    </span>
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
    <!-- Team Section End -->
    <?php
    include("../Requires/footeruser.php");
    ?>
</body>

</html>