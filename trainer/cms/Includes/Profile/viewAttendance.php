<?php
// Include your database connection file and establish the connection

// Fetch the activity ID from the URL
$activityID = $_GET['activity_id'];
$classID = $_GET['class_id'];

if(isset($_POST['hide']) && $_POST['hide']=='1'){
    $customer_id_array=escapeString($_POST['class_attendance']);   
    foreach($customer_id_array as $id){
        $data=array(
            "attendance_user" => $id,
            "attendance_class" => $classID,
            "attendance_subject" =>$activityID,
            "attendance_result" =>"",
            "attendance_status" =>"active",
            "attendance_create_date" =>TODAY
        );

        $tb='';
        $vl='';
        foreach($data as $table=>$value){
            $tb.= $table." ,";
            $vl.= "'".$value."' ,";
        };
        $tb=substr($tb,0,-2);
        $vl=substr($vl,0,-2);

        $sql="INSERT INTO attendance(".$tb.") VALUES (".$vl.")";
        $query=$mysqli->query($sql);
        
    }
    echo '<script>window.location.href = "profile.php?page=viewAttendance&activity_id='.$activityID.'&class_id='.$classID.'&success=true";</script>';
    exit;
}


if(isset($_GET['success']) && $_GET['success']=='true'){
    $more_script.=<<<EOF
    toast.success(Attendance Update Successful","Attendance Updated Successful");
    EOF;
}
  

  
// Query to get the activity name
$activityNameQuery = "SELECT activity_name FROM activity WHERE activity_id = $activityID";
$activityNameResult = $mysqli->query($activityNameQuery);
$activityNameRow = $activityNameResult->fetch_assoc();
$activityName = $activityNameRow['activity_name'];

$customerQuery =    "SELECT c.customer_id, c.customer_name, c.customer_email, c.customer_contact 
                    FROM customer_activity ca 
                    JOIN customer c ON ca.customer_id = c.customer_id 
                    WHERE ca.activity_id = $activityID
                    AND ca.class_id = $classID
                    GROUP BY c.customer_id";
$customerResult = $mysqli->query($customerQuery);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Include your head content here -->
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div class="content-wrapper">
            <!-- Include your content header here -->

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="col-sm-6">
                                        <h1>Activity name :
                                            <?php echo $activityName; ?>
                                        </h1>
                                    </div>
                                    <!-- Include your buttons here -->
                                </div>
                                <div class="card-body">
                                    <form action="profile.php?page=viewAttendance&activity_id=<?=$activityID?>&class_id=<?=$classID?>" method="POST">
                                    <table id="memberTable" class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Contact</th>
                                                <th class="text-center">Attendance</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $attendance=array();

                                            while ($customerRow = $customerResult->fetch_assoc()):
                                                $cusid=$customerRow['customer_id']; 
                                                $check=false;  
                                                $sql="SELECT * FROM attendance where attendance_user = '".$cusid."' AND attendance_create_date like'%".TODAYDATE."%' AND attendance_status='active' LIMIT 1"; 
                                                $query=$mysqli->query($sql);
                                                if($query->num_rows>0){
                                                    $check=true;
                                                    $data=$query->fetch_assoc();
                                                    $attendance[$customerRow['customer_id']]=array(
                                                        'name'=>$customerRow['customer_name'],
                                                        'email'=>$customerRow['customer_email'],
                                                        'contact'=>$customerRow['customer_contact'],
                                                        'created_time'=>$data['attendance_create_date']
                                                    );
                                                }else{
                                                    ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $customerRow['customer_name']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $customerRow['customer_email']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $customerRow['customer_contact']; ?>
                                                    </td>
                                                    <td class="text-center"><input type="checkbox" name="class_attendance[]" <?=($check?"checked":"")?> value="<?=$customerRow['customer_id']?>" class="presentCheckbox"
                                                            data-customer-id="<?php echo $customerRow['customer_id']; ?>">
                                                    </td>
                                                </tr> 
                                                <?php

                                                }endwhile; ?>
                                        </tbody>
                                    </table>
                                    <input type="hidden" name="hide" value='1'>
                                    <input type="submit" name="submit" class="btn btn-primary float-right from-group">
                                            
                                        </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="col-sm-6">
                                        <h1>
                                            Attendance
                                        </h1>
                                    </div>
                                    <!-- Include your buttons here -->
                                </div>
                                <div class="card-body">
                                    <table id="memberTable" class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Contact</th>
                                                <th>Attendance Create Time</th>
                                                <th class="text-center">Attendance</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                foreach($attendance as $id => $array){
                                                    echo '<tr>
                                                            <td>
                                                                '.$array["name"].'
                                                            </td>
                                                            <td>
                                                                '.$array['email'].'
                                                            </td>
                                                            <td>
                                                                '.$array['contact'].'
                                                            </td>
                                                            <td>
                                                                '.$array['created_time'].'
                                                            </td>

                                                            <td class="text-center">
                                                                <div class="badge bg-success">Attend</div>
                                                            </td>
                                                            '
                                                            ;

                                                }   
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            // Initialize DataTable
            $('#memberTable').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": false,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "pageLength": 15
            });

            // Handle checkbox change event
            $('.presentCheckbox').change(function () {
                var customerId = $(this).data('customer-id');
                var status = $(this).prop('checked') ? 'Present' : 'Absent';

                $.ajax({
                    url: '',
                    type: 'POST',
                    data: { customerId: customerId, status: status },
                    success: function (response) {
                        console.log('Status updated successfully');
                    },
                    error: function (xhr, status, error) {
                        console.error('Error updating status:', error);
                    }
                });
            });
        });
    </script>
</body>

</html>