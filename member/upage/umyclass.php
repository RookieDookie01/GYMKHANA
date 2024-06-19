<!DOCTYPE html>
<html lang="zxx">

<body>
    <title>GymKhana | My Class</title>
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
                        <h2>My Class</h2>
                        <div class="bt-option">
                            <a href="/myWeb/GYMKHANA/member/index.php">Home</a>
                            <a href="/myWeb/GYMKHANA/member/upage/uprofile.php">Profile</a>
                            <span>My Class</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Now you can use $timetableData to generate your HTML -->
    <section class="class-timetable-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-title">
                        <h2>My Timetable</h2>
                    </div>
                </div>
                <div class="col-lg-6">
                    <a href="/myWeb/GYMKHANA/member/upage/uclasses.php"
                        class="primary-btn btn-normal appoinment-btn">Add Class</a>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="class-timetable">
                        <table>
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Monday</th>
                                    <th>Tuesday</th>
                                    <th>Wednesday</th>
                                    <th>Thursday</th>
                                    <th>Friday</th>
                                    <th>Saturday</th>
                                    <th>Sunday</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $current_user = $_SESSION['auth_user']['customer_id'];

                                $select_query = "SELECT class.*, trainer.*
                                FROM class
                                LEFT JOIN trainer ON class.trainer_id = trainer.trainer_id
                                JOIN timetable ON class.class_id = timetable.class_id
                                WHERE timetable.timetable_status = 'active'
                                AND timetable.customer_id = '$current_user'
                                ORDER BY class.class_day, class.class_time";

                                $result = mysqli_query($con, $select_query);

                                $timetableData = [];
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $class_day = $row['class_day'];
                                    $class_time = $row['class_time'];
                                    $class_name = $row['class_name'];
                                    $trainer_name = $row['trainer_name'];
                                    $class_type = $row['class_type'];

                                    $timetableData[$class_day][$class_time][] = [
                                        'class_name' => $class_name,
                                        'trainer_name' => $trainer_name,
                                        'class_type' => $class_type,
                                    ];
                                }

                                $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                                $times = ['18:00-19:00', '19:00-20:00', '20:00-21:00', '21:00-23:00'];

                                foreach ($times as $time) {
                                    echo '<tr>';
                                    echo '<td class="class-time">' . $time . '</td>';

                                    foreach ($days as $day) {
                                        echo '<td>';
                                        if (isset($timetableData[$day][$time])) {
                                            foreach ($timetableData[$day][$time] as $class) {
                                                echo '<div class="' . $class['class_type'] . '-bg hover-bg ts-meta" data-tsmeta="' . $class['class_type'] . '">';
                                                echo '<a href="uclass-details.php?class=' . urlencode($class['class_name']) . '">';
                                                echo '<h5>' . $class['class_name'] . '</h5>';
                                                echo '<span>' . $class['trainer_name'] . '</span>';
                                                echo '</a>';
                                                echo '</div>';
                                            }
                                        } else {
                                            echo '<div class="empty-cell">';
                                            echo '<p>No class</p>';
                                            echo '</div>';
                                        }
                                        echo '</td>';
                                    }

                                    echo '</tr>';
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </section>
    <!-- Class Timetable Section End -->
    <?php
    include("../Requires/footeruser.php");
    ?>
</body>

</html>