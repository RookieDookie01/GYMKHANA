<!-- Team Section Begin -->
<section class="team-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="team-title">
                    <div class="section-title">
                        <span>Our Team</span>
                        <h2>TRAIN WITH EXPERTS</h2>
                    </div>
                    <a href="/myWeb/GYMKHANA/member/upage/utrainer.php" class="primary-btn btn-normal appoinment-btn">appointment</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="ts-slider owl-carousel">
                <?php
                $select_query = "SELECT apply_name, apply_class_name, apply_class_desc, apply_image FROM applynow";
                $result = mysqli_query($con, $select_query);

                if ($result && mysqli_num_rows($result) > 0) {
                    foreach ($result as $row) {
                        $apply_name = $row['apply_name'];
                        $apply_class_name = $row['apply_class_name'];
                        $apply_class_desc = $row['apply_class_desc'];
                        $apply_image = $row['apply_image'];
                        ?>
                        <div class="col-lg-4">
                            <div class="ts-item set-bg" data-setbg="<?= $apply_image ?>">
                                <div class="ts_text">
                                    <h4>
                                        <?= $apply_name ?>
                                    </h4>
                                    <span>
                                        <?= $apply_class_name ?>
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
    </div>
</section>
<!-- Team Section End -->