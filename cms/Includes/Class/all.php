<?php
$sql="SELECT a.*,b.trainer_name FROM class a 
      LEFT JOIN trainer b ON a.trainer_id=b.trainer_id
      WHERE (a.class_delete_date = '0000-00-00 00:00:00' or a.class_delete_date is null)
      ORDER BY a.class_id DESC";
$classQuery=$mysqli->query($sql);
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All Class</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Classs</li>
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
                        <a href="class.php?page=add" class="btn btn-primary">Add More class</a>
                    </h3>
                  
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="classTable" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Incharge Trainer</th>
                    <th>Class Type</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  
                  <?php
                  if($classQuery->num_rows>0){
                    while($row=$classQuery->fetch_assoc()){
                      echo '<tr>
                              <td>
                                '.$row['class_id'].'
                              </td>
                              <td>
                                '.$row['class_name'].'
                              </td>
                              <td>
                                '.$row['trainer_name'].'
                              </td>
                              <td>
                                '.$row['class_type'].'
                              </td>
                              <td class="text-center">
                              <a href="class.php?page=edit&id='.$row['class_id'].'" style="color:black"><i class="fas fa-edit"></i></a>
                              <b>|</b>
                              <a href="#" style="color:black" class="deleteButton" data-id="'.$row['class_id'].'" ><i class="fas fa-trash"></i></a>
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
  $('#classTable').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": true,
    "ordering": false,
    "info": true,
    "autoWidth": false,
    "responsive": true,
    "pageLength": 15
  });
  $('#classTable').on('click', '.deleteButton', function(e) {
    e.preventDefault();
    pop.delete($(this), 'class',$('#classTable').DataTable());
});

});

EOF;
?>