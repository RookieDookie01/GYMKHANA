<?php
$sql="SELECT * FROM admin WHERE (admin_delete_date='0000-00-00 00:00:00' or admin_delete_date IS NULL) AND admin_id!='".$_SESSION['user_id']."' AND admin_id!='1' ORDER BY admin_id desc";
$adminQuery=$mysqli->query($sql);
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All Admins</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Admin</li>
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
                        <a href="admin.php?page=add" class="btn btn-primary">Add More Admin</a>
                    </h3>
                    <h3 class="card-tools">
                        <a href="admin.php?page=excel" target="_blank" class="btn btn-primary" style="width:70px">Excel</a>
                    </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="adminTable" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Position</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  
                  <?php
                  if($adminQuery->num_rows>0){
                    while($row=$adminQuery->fetch_assoc()){
                      echo '<tr>
                              <td>
                                '.$row['admin_id'].'
                              </td>
                              <td>
                                '.$row['admin_name'].'
                              </td>
                              <td>
                                '.$row['admin_email'].'
                              </td>
                              <td>
                                '.$row['admin_contact'].'
                              </td>
                              <td>
                                '.$row['admin_position'].'
                              </td>
                              <td class="'.($row['admin_status']=="active"?"text-success":"text-danger").'">
                                '.$row['admin_status'].'
                              </td>
                              <td class="text-center">
                              <a href="admin.php?page=edit&id='.$row['admin_id'].'" style="color:black"><i class="fas fa-edit"></i></a>
                              <b>|</b>
                              <a href="#" style="color:black" class="deleteButton" data-id="'.$row['admin_id'].'" ><i class="fas fa-trash"></i></a>
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
  $('#adminTable').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": true,
    "ordering": false,
    "info": true,
    "autoWidth": false,
    "responsive": true,
    "pageLength": 15
  });
  $('#adminTable').on('click', '.deleteButton', function(e) {
    e.preventDefault();
    pop.delete($(this), 'admin',$('#adminTable').DataTable());
});

});

EOF;
?>