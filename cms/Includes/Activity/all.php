<?php
$sql="SELECT a.*,b.plan_name FROM activity a
LEFT JOIN plan b ON a.plan_id=b.plan_id
WHERE  (a.activity_delete_date='0000-00-00 00:00:00' or a.activity_delete_date IS NULL)
ORDER BY a.activity_id desc";
$activityQuery=$mysqli->query($sql);
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All Activitys</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Activity</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                    <h3 class="card-title">
                        <a href="activity.php?page=add" class="btn btn-primary">Add More activity</a>
                    </h3>
                    <h3 class="card-tools">
                        <a href="activity.php?page=excel" target="_blank" class="btn btn-primary" style="width:70px">Excel</a>
                    </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="activityTable" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Day</th>
                    <th>Time</th>
                    <th>Type</th>
                    <th>Plan Required</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  
                  <?php
                  if($activityQuery->num_rows>0){
                    while($row=$activityQuery->fetch_assoc()){
                      echo '<tr>
                              <td>
                                '.$row['activity_id'].'
                              </td>
                              <td>
                                '.$row['activity_name'].'
                              </td>
                              <td>
                                '.$row['activity_day'].'
                              </td>
                              <td>
                                '.$row['activity_time'].'
                              </td>
                              <td>
                                '.$row['activity_type'].'
                              </td>
                              <td>
                                '.($row['plan_id']=="0"?"No Plan Required":$row['plan_name']).'
                              </td>
                              <td class="text-center">
                              <a href="activity.php?page=edit&id='.$row['activity_id'].'" style="color:black"><i class="fas fa-edit"></i></a>
                              <b>|</b>
                              <a href="#" style="color:black" class="deleteButton" data-id="'.$row['activity_id'].'" ><i class="fas fa-trash"></i></a>
                              </td>
                            </tr>';
                    }
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

<?php
$more_script .=<<<EOF
$(document).ready(function(){
  $('#activityTable').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": true,
    "ordering": false,
    "info": true,
    "autoWidth": false,
    "responsive": true,
    "pageLength": 15
  });
  $('#activityTable').on('click', '.deleteButton', function(e) {
    e.preventDefault();
    pop.delete($(this), 'activity',$('#activityTable').DataTable());
});

});

EOF;
?>