<?php
$sql="SELECT a.*,b.customer_name FROM payment a
LEFT JOIN customer b ON a.customer_id=b.customer_id"
;
$paymetQuery=$mysqli->query($sql);
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

                    <h3 class="card-tools">
                        <a href="payment.php?page=excel" target="_blank" class="btn btn-primary" style="width:70px">Excel</a>
                    </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="memberTable" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Amount (RM)</th>
                    <th>Payment Method</th>
                    <th>Payment Status</th>
                  </tr>
                  </thead>
                  <tbody>
                  
                  <?php
                  if($paymetQuery->num_rows>0){
                    while($row=$paymetQuery->fetch_assoc()){
                      echo '<tr>
                              <td>
                                '.$row['paymet_id'].'
                              </td>
                              <td>
                                '.$row['customer_name'].'
                              </td>
                              <td>
                                '.$row['payment_amount'].'
                              </td>
                              <td>
                                '.$row['payment_method'].'
                              </td>
                              <td class="text-center">
                                <div data-value="'.$row['payment_status'].'" class="badge '.(getStatusBadgeClass($row['payment_status'])).'">
                                '.$row['payment_status'].'
                                </div>
                                <select class="select_status" style="display:none;" data-id='.$row['paymet_id'].'>
                                  <option value="Pending" ' . ($row['payment_status'] == 'Pending' ? 'selected' : '') . '>Pending</option>
                                  <option value="Paid" '.($row['payment_status'] == 'Paid' ? 'selected' : '').'>Paid</option>
                                  <option value="Failed" '.($row['payment_status'] == 'Failed' ? 'selected' : '').'>Failed</option>
                                  <option value="Refunded" '.($row['payment_status'] == 'Refunded' ? 'selected' : '').'>Refunded</option>
                                  <option value="Cancelled" '.($row['payment_status'] == 'Cancelled' ? 'selected' : '').'>Cancelled</option>
                                </select>
                                
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
    "pageLength": 15,
    "select": true
  });

  
  $('#memberTable').on('click', '.deleteButton', function(e) {
    e.preventDefault();
    pop.delete($(this), 'member',$('#memberTable').DataTable());
});

});

EOF;
?>