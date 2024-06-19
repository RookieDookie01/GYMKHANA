<?php
$sql="SELECT * FROM trainer WHERE trainer_delete_date = '0000-00-00 00:00:00' ORDER BY trainer_id desc";
$trainerQuery=$mysqli->query($sql);
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All Trainers</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Trainers</li>
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
                        <a href="trainer.php?page=add" class="btn btn-primary">Add More Trainer</a>
                    </h3>
                    <h3 class="card-tools">
                        <a href="trainer.php?page=excel" target="_blank" class="btn btn-primary" style="width:70px">Excel</a>
                    </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="trainerTable" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Branch</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  
                  <?php
                  if($trainerQuery->num_rows>0){
                    while($row=$trainerQuery->fetch_assoc()){
                      echo '<tr>
                              <td>
                                '.$row['trainer_id'].'
                              </td>
                              <td>
                                '.$row['trainer_name'].'
                              </td>
                              <td>
                                '.$row['trainer_email'].'
                              </td>
                              <td>
                                '.$row['trainer_contact'].'
                              </td>
                              <td>
                                '.$row['trainer_address'].'
                              </td>
                              <td class="text-center">
                              <a href="trainer.php?page=edit&id='.$row['trainer_id'].'" style="color:black"><i class="fas fa-edit"></i></a>
                              <b>|</b>
                              <a href="#" style="color:black" class="deleteButton" data-id="'.$row['trainer_id'].'" ><i class="fas fa-trash"></i></a>
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
  $('#trainerTable').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": true,
    "ordering": false,
    "info": true,
    "autoWidth": false,
    "responsive": true,
    "pageLength": 15
  });
  $('#trainerTable').on('click', '.deleteButton', function(e) {
    e.preventDefault();
    pop.delete($(this), 'trainer',$('#trainerTable').DataTable());
});

});

EOF;
?>