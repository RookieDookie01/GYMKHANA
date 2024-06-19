<!DOCTYPE html>
<html lang="zxx">
<title>GymKhana | Class Details</title>

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
                        <h2>Classes detail</h2>
                        <div class="bt-option">
                            <a href="/myWeb/GYMKHANA/member/index.php">Home</a>
                            <a href="uclasses.php">Classes</a>
                            <span>Body building</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Class Details Section Begin -->
    <?php
    $selected_class = isset($_GET['class']) ? mysqli_real_escape_string($con, $_GET['class']) : '';

    // Query to fetch details of the selected class
    $select_query = "SELECT trainer.*, class.* 
    FROM trainer 
    INNER JOIN class ON trainer.trainer_id = class.trainer_id 
    WHERE class.class_name = '$selected_class'";
    $result = mysqli_query($con, $select_query);

    if ($result && mysqli_num_rows($result) > 0) {
        $class_details = mysqli_fetch_assoc($result);
        ?>

        <section class="class-details-section spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="class-details-text">
                            <!-- <div class="cd-pic">
                                <img src="<?= $class_details['class_image'] ?>" alt="">
                            </div> -->
                            <div class="cd-text">
                                <div class="cd-single-item">
                                    <h3>
                                        Class name :
                                        <?= $class_details['class_name'] ?>
                                    </h3>
                                    <p>
                                        Class Type :
                                        <?= $class_details['class_type'] ?>
                                    </p>
                                    <p>
                                        Class Day :
                                        <?= $class_details['class_day'] ?>
                                    </p>
                                    <p>
                                        Class Time :
                                        <?= $class_details['class_time'] ?>
                                    </p>
                                    <p>
                                        Class Description :
                                        &nbsp;
                                        <?= $class_details['class_desc'] ?>
                                    </p>
                                </div>
                                <div class="cd-single-item">
                                    <h3>Trainer</h3>
                                </div>
                            </div>
                            <div class="cd-trainer">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="cd-trainer-pic">
                                            <!-- You can fetch trainer image from the database if available -->
                                            <img src="<?= $class_details['trainer_image'] ?>" alt="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="cd-trainer-text">
                                            <div class="trainer-title">
                                                <h4>
                                                    <?= $class_details['trainer_name'] ?>
                                                </h4>
                                            </div>
                                            <!-- Additional trainer details from the database -->
                                            <div class="trainer-social">
                                                <!-- You can add social media links here if available -->
                                            </div>
                                            <ul class="trainer-info">
                                                <li><span>Age</span>
                                                    <?= $class_details['trainer_age'] ?>
                                                </li>
                                                <li><span>Weight</span>
                                                    <?= $class_details['trainer_weight'] ?> kg
                                                </li>
                                                <li><span>Height</span>
                                                    <?= $class_details['trainer_height'] ?> cm
                                                </li>
                                            </ul>
                                            <p>
                                                <?= $class_details['trainer_info'] ?>
                                            </p>
                                            <?php
                                            $customer_id = isset($_SESSION['auth_user']['customer_id']) ? $_SESSION['auth_user']['customer_id'] : '';
                                            $class_name = isset($_GET['class']) ? urldecode($_GET['class']) : '';

                                            $enrollmentQuery = "SELECT timetable.*, class.class_name FROM timetable
                                            JOIN class ON timetable.class_id = class.class_id
                                            WHERE timetable.customer_id = '$customer_id' 
                                            AND class.class_name = '$class_name' 
                                            AND timetable.timetable_status = 'active'";
                                            $enrollmentResult = mysqli_query($con, $enrollmentQuery);
                                            $isEnrolled = mysqli_num_rows($enrollmentResult) > 0;
                                            ?>

                                            <form action="../Requires/mysql.php" method="post">
                                                <div class="leave-comment">
                                                    <div class="leave-comment">
                                                        <div class="button-container">
                                                            <?php if (isset($_SESSION['auth_user'])): ?>
                                                                <?php if ($isEnrolled): ?>
                                                                    <input type="hidden" name="class"
                                                                        value="<?= htmlspecialchars($class_name) ?>">
                                                                    <button type="submit" name="remove_class"
                                                                        class="modern-button button-left">Remove Class</button>
                                                                <?php else: ?>
                                                                    <input type="hidden" name="class"
                                                                        value="<?= htmlspecialchars($class_name) ?>">
                                                                    <button type="submit" name="add_class"
                                                                        class="modern-button button-left">Add Class</button>
                                                                <?php endif; ?>
                                                            <?php else: ?>
                                                                <a href="/myWeb/GYMKHANA/member/upage/login.php"
                                                                    class="modern-button button-left">Sign In to Add Class</a>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-8">
                        <div class="sidebar-option">
                            <div class="so-categories">
                                <h5 class="title">Categories</h5>
                                <ul>
                                    <li><a href="#">Yoga <span>12</span></a></li>
                                    <li><a href="#">Runing <span>32</span></a></li>
                                    <li><a href="#">Weightloss <span>86</span></a></li>
                                    <li><a href="#">Cario <span>25</span></a></li>
                                    <li><a href="#">Body buiding <span>36</span></a></li>
                                    <li><a href="#">Nutrition <span>15</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    } else {
        echo "Class not found.";
    }
    ?>

    <!-- Class Details Section End -->

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