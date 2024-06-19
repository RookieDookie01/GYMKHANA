<?php
$currentDate = TODAYDATE;
$currentDay = date('l', strtotime($currentDate));
$firstDayOfMonth = date('Y-m-01', strtotime($currentDate));
$lastDayOfMonth = date('Y-m-t', strtotime($firstDayOfMonth));
?>

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

  <section class="content">
    <!-- Display the current date and day -->
    <div class="card">
      <div class="card-body">
        <h1>My Calendar</h1>
        <div class="calendar">
          <h2>
            <?php echo date('F Y', strtotime($currentDate)); ?>
          </h2>

          <!-- Display the calendar -->
          <table class="styled-calendar">
            <tr class="days-header">
              <th>Sun</th>
              <th>Mon</th>
              <th>Tue</th>
              <th>Wed</th>
              <th>Thu</th>
              <th>Fri</th>
              <th>Sat</th>
            </tr>
            <?php
            $firstDayOfWeek = date('w', strtotime($firstDayOfMonth));
            $lastDayOfMonthNumber = date('j', strtotime($lastDayOfMonth));
            $currentDayOfMonth = 1;
            $dayCount = 0;

            $sql = "SELECT * FROM class WHERE trainer_id = '".$_SESSION['trainer_id']."'";
            $customerQuery = $mysqli->query($sql);

            $classSchedule = [];
            while ($row = $customerQuery->fetch_assoc()) {
              $classSubjects = json_decode($row['class_subject'], true);
              foreach ($classSubjects as $activityId) {
                $activityInfo = getActivityInfo($activityId);
                if ($activityInfo) {
                  $classSchedule[] = $activityInfo;
                }
              }
            }
            function getActivityInfo($activityId)
            {
              global $mysqli;
              $activitySql = "SELECT * FROM activity WHERE activity_id = $activityId";
              $activityResult = $mysqli->query($activitySql);
              return $activityResult->fetch_assoc();
            }

            for ($i = 0; $i < 6; $i++) {
              echo '<tr class="days">';
              for ($j = 0; $j < 7; $j++) {
                if ($dayCount >= $firstDayOfWeek && $currentDayOfMonth <= $lastDayOfMonthNumber) {
                  $date = date('Y-m-d', strtotime($firstDayOfMonth . '+' . $currentDayOfMonth - 1 . ' days'));
                  $class = ($date == $currentDate) ? 'current-day' : '';

                  echo '<td class="' . $class . '">';
                  echo '<div class="date-container">' . date('j', strtotime($date)) . '</div>';

                  foreach ($classSchedule as $activityInfo) {
                    $activityDayOfWeek = date('l', strtotime($activityInfo['activity_day']));
                    if ($activityDayOfWeek == date('l', strtotime($date))) {
                      echo '<div class="class-info">';
                      echo 'Activity: ' . $activityInfo['activity_name'] . '<br>';
                      echo 'Time: ' . $activityInfo['activity_time'];
                      echo '</div>';
                    }
                  }

                  echo '</td>';
                  $currentDayOfMonth++;
                } else {
                  echo '<td></td>';
                }
                $dayCount++;
              }
              echo '</tr>';
            }

            ?>



          </table>
        </div>

      </div>
    </div>

    <!-- Your other content goes here -->
  </section>
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>My Class</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <section class="content">
    <!-- Display the current date and day -->
    <div class="card">
      <div class="card-body">
        <?php
        $sql = "SELECT class.*, trainer.trainer_name FROM class
                JOIN trainer ON class.trainer_id = trainer.trainer_id
                WHERE class.trainer_id = '".$_SESSION['trainer_id']."'";

                    $customerQuery = $mysqli->query($sql);

                    echo '<div class="cards-container" style="display: flex; flex-wrap: wrap;">';

                    while ($row = $customerQuery->fetch_assoc()) {
                      $classID = $row['class_id'];
                      $className = $row['class_name'];
                      $classType = $row['class_type'];
                      $trainerName = $row['trainer_name'];

                      echo '
                  <a href="profile.php?page=viewActivity&&class_id=' . $classID . '" style="text-decoration: none;">
                      <div class="card card-just-text custom-card" style="width: 350px; height: 140px; background-color: #5794c3; margin: 10px;"
                          data-background="color" data-color="blue" data-radius="none">
                          <div class="content">
                              <p class="description">
                                  ' . $className . '<br>
                                  Class Type : ' . $classType . '<hr>
                                  <div class="stats" style="padding: 10px;">
                                      <div class="pull-right">
                                          <small> Trainer: ' . $trainerName . ' </small>
                                      </div>
                                  </div>
                              </p>
                          </div>
                      </div>
                  </a>';
                    }
        echo '</div>';
        ?>
      </div>
    </div>
  </section>
</div>

<style>
  /* Add your CSS styles here */
  .calendar {
    font-family: Arial, sans-serif;
    text-align: center;
    margin-top: 20px;
  }

  .calendar h2,
  .calendar p {
    margin: 0;
  }

  .styled-calendar {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
  }

  .styled-calendar th {
    width: 109px;
    background-color: #5794c3;
  }

  .days-header {
    height: 20px;
  }

  .days {
    height: 100px;
  }

  .styled-calendar td {
    width: 109px;
    height: 100px;
    /* Set the height equal to the width for square cells */
    border: 1px solid #ddd;
    text-align: center;
    font-size: 14px;
    position: relative;
  }

  .date-container {
    position: absolute;
    top: 5px;
    right: 5px;
  }

  .class-info {
    font-size: 12px;
    margin-top: 5px;
  }

  .current-day {
    background-color: #5794c3;
    color: white;
  }

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