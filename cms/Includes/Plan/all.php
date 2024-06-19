<?php
$sql="SELECT * FROM plan WHERE  plan_delete_date IS NULL";
$planQuery=$mysqli->query($sql);
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All plans</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">plan</li>
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
                        <a href="plan.php?page=add" class="btn btn-primary">Add More plan</a>
                    </h3>
                    
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="planTable" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Price (RM)</th>
                    <th>Description</th>
                    <th>Duration (minute)</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  
                  <?php
                  if($planQuery->num_rows>0){
                    $i=0;
                    while($row=$planQuery->fetch_assoc()){
                      //process describtion
                      $description=$row['plan_description'];
                      if(strlen($description)>40){
                        $description = substr($description, 0, 40).'...';
                      }
                      echo '<tr>
                              <td>
                                '.$row['plan_id'].'
                              </td>
                              <td>
                                '.$row['plan_name'].'
                              </td>
                              <td>
                                '.$row['plan_price'].'
                              </td>
                              <td>
                                '.$description.'
                              </td>
                              <td>
                                '.$row['plan_duration'].'
                              </td>

                              <td class="text-center">
                              <a href="plan.php?page=edit&id='.$row['plan_id'].'" style="color:black"><i class="fas fa-edit"></i></a>
                              <b>|</b>
                              <a href="#" style="color:black" class="deleteButton" data-id="'.$row['plan_id'].'" ><i class="fas fa-trash"></i></a>
                              <b>|</b>
                              <a href="#modal-view'.$i.'" style="color:black" class="open-model"><i class="fas fa-eye"></i></a>
                              </td>
                            </tr>
                            
                            <div id="modal-view'.$i.'" class="mfp-hide custom-popup">
                              <div class="card">
                                <div class="card-header">
                                  <h2 class="card-title">'.$row['plan_name'].'</h2>
                                 
                                  <div class="card-tools">
                                  <button class="close-model">X</button>
                                  </div>
                                </div>
                                <div class="card-body">
                                  <p class="card-text">'.$row['plan_description'].'</p>
                                </div>
                              </div>
                            </div>';
                            $i++;
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
  $('#planTable').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": true,
    "ordering": false,
    "info": true,
    "autoWidth": false,
    "responsive": true,
    "pageLength": 15
  });
  $('#planTable').on('click', '.deleteButton', function(e) {
    e.preventDefault();
    pop.delete($(this), 'plan',$('#planTable').DataTable());
});

});

EOF;
?>