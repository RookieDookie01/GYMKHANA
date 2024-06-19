<?php
// Select classes for the trainer
$classSql = "SELECT * FROM class WHERE trainer_id = ".$_SESSION['trainer_id'];
$classResult = $mysqli->query($classSql);
$classDetails = array();

while ($classRow = $classResult->fetch_assoc()) {
    // Extract activity IDs from class_subject
    $activityIds = json_decode($classRow['class_subject'], true);

    // Fetch activity names based on activity IDs
    $activityNames = array();
    foreach ($activityIds as $activityId) {
        $activityNameSql = "SELECT activity_name FROM activity WHERE activity_id = $activityId";
        $activityNameResult = $mysqli->query($activityNameSql);
        $activityRow = $activityNameResult->fetch_assoc();
        $activityNames[] = $activityRow['activity_name'];
    }
    $activities = implode(", ", $activityNames);
    
    // Select customers based on activity IDs and class ID
    $customerSql = "SELECT DISTINCT ca.customer_id, c.customer_name, c.customer_email, c.customer_contact
                    FROM customer_activity ca
                    INNER JOIN customer c ON ca.customer_id = c.customer_id
                    WHERE ca.activity_id IN (" . implode(',', $activityIds) . ") AND ca.class_id = " . $classRow['class_id'];
               
    $customerResult = $mysqli->query($customerSql);

    while ($customerRow = $customerResult->fetch_assoc()) {
        $classDetails[$classRow['class_id']][] = array(
            'class_name' => $classRow['class_name'],
            'activity' => $activities,
            'customer_name' => $customerRow['customer_name'],
            'customer_email' => $customerRow['customer_email'],
            'customer_contact' => $customerRow['customer_contact']
        );
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Members</title>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h3>All Student</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="">Home</a></li>
                                <li class="breadcrumb-item active">View Member</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <?php foreach ($classDetails as $classId => $classDetailArray): ?>
                                <div class="card">
                                   
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table class="table table-bordered table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Class</th>
                                                    <th>Activity</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Contact</th>
                                               
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($classDetailArray as $classDetail): ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $classDetail['class_name']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $classDetail['activity']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $classDetail['customer_name']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $classDetail['customer_email']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $classDetail['customer_contact']; ?>
                                                        </td>
                                                        
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</body>

</html>

<?php
$more_script .= <<<EOF
$(document).ready(function(){
  // Initialize DataTable for memberTable
  $('.table').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": false,
    "responsive": true,
    "pageLength": 15
  });
  
  // Handle delete button click event for each table
  $('.table').on('click', '.deleteButton', function(e) {
    e.preventDefault();
    pop.delete($(this), 'member', $('.table').DataTable());
  });
});
EOF;
?>