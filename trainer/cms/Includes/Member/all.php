<?php
$sql="SELECT * FROM customer WHERE customer_delete_date = '0000-00-00 00:00:00'";
$CustomerQuery=$mysqli->query($sql);
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All Members</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Members</li>
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
                        <a href="member.php?page=add" class="btn btn-primary">Add More Member</a>
                    </h3>
                    <h3 class="card-tools">
                        <a href="#" class="btn btn-primary" style="width:70px">PDF</a>
                        <a href="member.php?page=excel" target="_blank" class="btn btn-primary" style="width:70px">Excel</a>
                    </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="memberTable" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Price Plan</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  
                  <?php
                  if($CustomerQuery->num_rows>0){
                    while($row=$CustomerQuery->fetch_assoc()){
                      echo '<tr>
                              <td>
                                '.$row['customer_id'].'
                              </td>
                              <td>
                                '.$row['customer_name'].'
                              </td>
                              <td>
                                '.$row['customer_email'].'
                              </td>
                              <td>
                                '.$row['customer_contact'].'
                              </td>
                              <td>
                                '.$row['customer_plan'].'
                              </td>
                              <td class="text-center">
                              <a href="member.php?page=edit&id='.$row['customer_id'].'" style="color:black"><i class="fas fa-edit"></i></a>
                              <b>|</b>
                              <a href="#" style="color:black" class="deleteButton" data-id="'.$row['customer_id'].'" ><i class="fas fa-trash"></i></a>
                              </td>
                            </tr>';
                    }
                  }
                  ?>
                
                 
                  </tbody>
                 
                </table>
              </div>
            </div>
            <div class="card">
              <div class="card-header">
                    <h3 class="card-title">
                        <a href="member.php?page=add" class="btn btn-primary">Add More Member</a>
                    </h3>
                    <h3 class="card-tools">
                        <a href="#" class="btn btn-primary" style="width:70px">PDF</a>
                        <a href="member.php?page=excel" target="_blank" class="btn btn-primary" style="width:70px">Excel</a>
                    </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="memberTable" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Price Plan</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  
                  <?php
                  if($CustomerQuery->num_rows>0){
                    while($row=$CustomerQuery->fetch_assoc()){
                      echo '<tr>
                              <td>
                                '.$row['customer_id'].'
                              </td>
                              <td>
                                '.$row['customer_name'].'
                              </td>
                              <td>
                                '.$row['customer_email'].'
                              </td>
                              <td>
                                '.$row['customer_contact'].'
                              </td>
                              <td>
                                '.$row['customer_plan'].'
                              </td>
                              <td class="text-center">
                              <a href="member.php?page=edit&id='.$row['customer_id'].'" style="color:black"><i class="fas fa-edit"></i></a>
                              <b>|</b>
                              <a href="#" style="color:black" class="deleteButton" data-id="'.$row['customer_id'].'" ><i class="fas fa-trash"></i></a>
                              </td>
                            </tr>';
                    }
                  }
                  ?>
                
                 
                  </tbody>
                 
                </table>
              </div>
            </div><div class="card">
              <div class="card-header">
                    <h3 class="card-title">
                        <a href="member.php?page=add" class="btn btn-primary">Add More Member</a>
                    </h3>
                    <h3 class="card-tools">
                        <a href="#" class="btn btn-primary" style="width:70px">PDF</a>
                        <a href="member.php?page=excel" target="_blank" class="btn btn-primary" style="width:70px">Excel</a>
                    </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="memberTable" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Price Plan</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  
                  <?php
                  if($CustomerQuery->num_rows>0){
                    while($row=$CustomerQuery->fetch_assoc()){
                      echo '<tr>
                              <td>
                                '.$row['customer_id'].'
                              </td>
                              <td>
                                '.$row['customer_name'].'
                              </td>
                              <td>
                                '.$row['customer_email'].'
                              </td>
                              <td>
                                '.$row['customer_contact'].'
                              </td>
                              <td>
                                '.$row['customer_plan'].'
                              </td>
                              <td class="text-center">
                              <a href="member.php?page=edit&id='.$row['customer_id'].'" style="color:black"><i class="fas fa-edit"></i></a>
                              <b>|</b>
                              <a href="#" style="color:black" class="deleteButton" data-id="'.$row['customer_id'].'" ><i class="fas fa-trash"></i></a>
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
  $('#memberTable').on('click', '.deleteButton', function(e) {
    e.preventDefault();
    pop.delete($(this), 'member',$('#memberTable').DataTable());
  });

});

EOF;
?>