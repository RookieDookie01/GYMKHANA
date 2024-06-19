<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                   
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item active">View Tiem Table</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>My Activity</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <!-- Display the current date and day -->
        <div class="card">
            <div class="card-body">

                <?php
                $classID = $_GET['class_id'];
                $sql = "SELECT class_subject, trainer_id FROM class WHERE class_id = $classID";
                $result = $mysqli->query($sql);

                if ($result) {
                    $row = $result->fetch_assoc();
                    $classSubjectsJson = $row['class_subject'];
                    $trainerID = $row['trainer_id'];

                    $classSubjects = json_decode($classSubjectsJson);

                    foreach ($classSubjects as $activityID) {
                        $activitySql = "SELECT * FROM activity WHERE activity_id = $activityID";
                        $activityResult = $mysqli->query($activitySql);
                        $activityRow = $activityResult->fetch_assoc();

                        $trainerSql = "SELECT trainer_name FROM trainer WHERE trainer_id = $trainerID";
                        $trainerResult = $mysqli->query($trainerSql);
                        $trainerRow = $trainerResult->fetch_assoc();

                        $activityName = $activityRow['activity_name'];
                        $activityType = $activityRow['activity_type'];
                        $trainerName = $trainerRow['trainer_name'];

                        echo '
                        <a href="profile.php?page=viewAttendance&activity_id=' . $activityID . '&class_id='.$classID.'" style="text-decoration: none;">
                            <div class="cards-container" style="display: flex; flex-wrap: wrap;">
                                <div class="card card-just-text custom-card" style="width: 350px; height: 140px; background-color: #5794c3; margin: 10px;" data-background="color" data-color="blue" data-radius="none">
                                    <div class="content">
                                        <p class="description">
                                            ' . $activityName . '<br>
                                            Class Type: ' . $activityType . '<hr>
                                            <div class="stats" style="padding: 10px;">
                                                <div class="pull-right">
                                                    <small> Trainer: ' . $trainerName . '</small>
                                                </div>
                                            </div>
                                        </p>
                                    </div>
                                </div>';
                    }
                    echo '</div>
                        </a>';
                }
                ?>
            </div>
        </div>
    </section>
</div>

<style>
    .custom-card {
        width: 350px;
        height: 140px;
        background-color: #5794c3;
        display: flex;
        flex-direction: column;
        /* Make it a column layout */
    }

    .custom-card .content {
        padding: 20px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
    }

    .custom-card .description {
        color: #fff;
        margin: 0;
        font-size: 16px;
        margin-bottom: 10px;
    }

    hr {
        width: 100%;
        border: none;
        height: 1px;
        background-color: #000;
        margin: 10px 0;
    }

    .stats {
        width: 100%;
        height: 40px;
        display: flex;
        align-items: center;
        background-color: #5794c3;
        padding: 10px;
        box-sizing: border-box;
    }

    .pull-right {
        flex-grow: 1;
        /* Takes up remaining space */
        display: flex;
        justify-content: flex-end;
        align-items: center;
    }

    small {
        color: #fff;
        /* Change text color to white */
        /* Set a subtle color for small text */
        font-size: 14px;
    }
</style>