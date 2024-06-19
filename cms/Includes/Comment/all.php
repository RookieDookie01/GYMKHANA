<?php
$sql="SELECT a.*,b.customer_name,b.customer_email,b.customer_contact FROM comment a 
LEFT JOIN customer b ON (a.customer_id=b.customer_id)
ORDER BY comment_id desc";
$commentQuery=$mysqli->query($sql);
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All comments</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">comment</li>
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
              <!-- /.card-header -->
              <div class="card-body">
                <table id="commentTable" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Comment By</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Comment Type</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  
                  <?php
                  if($commentQuery->num_rows>0){
                    $i=0;
                    while($row=$commentQuery->fetch_assoc()){
                        //process 
                        $date=new DateTime($row['comment_create_date']);
                        $current=new DateTime();
                        $difference=$current->diff($date);
                      echo '<tr>
                              <td>
                                '.$row['comment_id'].'
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
                                '.$row['comment_type'].'
                              </td>
                              <td class="commentstatus '.($row['comment_status']=="Read"?"text-success":"text-danger").'">
                                '.$row['comment_status'].'
                              </td>
                              <td class="text-center">
                              
                              <a href="#modal-view'.$i.'" style="color:black" data-id="'.$row['comment_id'].'" title="View Comment" class="'.($row['comment_status']=="Unread"?"unreadComment":"").' open-model"><i class="fas fa-eye"></i></a>
                              </td>
                            </tr>
                            <div id="modal-view'.$i.'" class="mfp-hide custom-popup">
                              <div class="card">
                                <div class="card-header">
                                  <h2 class="card-title">'.$row['comment_type'].'</h2>
                                 
                                  <div class="card-tools">
                                  <button class="close-model">X</button>
                                  </div>
                                </div>
                                <div class="card-body">
                                  <p class="card-text">'.$row['comment_desc'].'</p>
                                </div>
                                <div class="card-footer text-muted">
                                    '.getDifferenceDate($difference).'
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
  $('#commentTable').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": true,
    "ordering": false,
    "info": true,
    "autoWidth": false,
    "responsive": true,
    "pageLength": 15
  });
  $('#commentTable').on('click', '.deleteButton', function(e) {
    e.preventDefault();
    pop.delete($(this), 'comment',$('#commentTable').DataTable());
});

});

EOF;
?>