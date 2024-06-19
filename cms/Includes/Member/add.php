<?php
if(isset($_POST['hide']) && $_POST['hide'] == '1'){
  if($_POST['customer_password']!=''){
    $password=escapeString($_POST['customer_password']);
  }else{
    $password=substr(escapeString($_POST['customer_name']), -3).substr(escapeString($_POST['customer_contact']),-5);
  }
  $data=array(
    'customer_name' => escapeString($_POST['customer_name']),
    'customer_contact'=> escapeString($_POST['customer_contact']),
    'customer_email'=>escapeString($_POST['customer_email']),
    'customer_plan'=>escapeString($_POST['customer_plan']),
    'customer_username'=>escapeString($_POST['customer_username']),
    'customer_password'=>md5($password),
    'customer_address'=>escapeString($_POST['customer_address']),
    'customer_create_date'=>TODAY,
  );

  $tb='';
  $vl='';
  foreach($data as $table=>$value){
    $tb.= $table." ,";
    $vl.= "'".$value."' ,";
  };
  $tb=substr($tb,0,-2);
  $vl=substr($vl,0,-2);

  $sql="INSERT INTO customer(".$tb.") VALUES (".$vl.")";
  $query=$mysqli->query($sql);
   if($query){
    echo '<script>window.location.href = "member.php?page=add&success=true";</script>';
    exit;
   }else{
    echo '<script>window.location.href = "member.php?page=add&success=fail";</script>';
    exit;
   }
 

}

if(isset($_GET['success']) && $_GET['success']=='true'){
  $more_script.=<<<EOF
  toast.success("New User Add Successful","Add Successful");
  EOF;
}

if(isset($_GET['success']) && $_GET['success']=='false'){
  $more_script.=<<<EOF
  toast.fail("New User Add UnSuccessful","Add Successful");
  EOF;
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All New Member</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Member</li>
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
                   
                        <form method="POST" class="addEditform" action="member.php?page=add">
                          <div class="row">
                            <div class="form-group col-6">
                                <label for="exampleInputEmail1">Customer Name <span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="customer_name"  placeholder="Enter Name" required>
                            </div>

                            <div class="form-group col-6">
                                <label for="exampleInputEmail1">Customer Contact <span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="customer_contact" placeholder="Enter Contact Number"  required>
                            </div>
                          </div>

                          <div class="row">
                            <div class="form-group col-6">
                                <label for="exampleInputEmail1">Customer Email <span style="color:red">*</span></label>
                                <input type="text" class="form-control gmail" name="customer_email"  placeholder="Enter email" required>
                            </div>

                            <div class="form-group col-6">
                                <label for="exampleInputEmail1">Customer Plan <span style="color:red">*</span></label>
                                <select  class="form-control" name="customer_plan" required>
                                  <?php
                                  $sql="SELECT * FROM plan WHERE  plan_delete_date IS NULL or plan_delete_date='0000-00-00 00:00:00'";
                                  $query=$mysqli->query($sql);
                                  $options="<option value='' disabled selected>Please choose A plan</option>
                                            <option value='No Active Plan'>No Active Plan</option>";
                                  if($query->num_rows>0){
                                    while($row=$query->fetch_assoc()){
                                      $options.="<option value='".$row['plan_name']."'>".$row['plan_name']."</option>";
                                    }
                                  }
                                  echo $options;
                                  ?>
                                </select>
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group col-6">
                                <label for="exampleInputEmail1">Customer Username <span style="color:red">*</span></label>
                                <input type="text" class="form-control username" name="customer_username" placeholder="Enter Username"  required>
                            </div>

                            <div class="form-group col-6">
                                <label for="exampleInputEmail1">Customer Password (Minumum 7 digit)</label>
                                <input type="password" class="form-control" name="customer_password" minlength="7" placeholder="Enter Password (DEFAULT last 3 character of name with contact 4 digit)">
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group col-12">
                                <label for="exampleInputEmail1">Customer Address <span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="customer_address" placeholder="Enter email">
                            </div>
                            <input type="hidden" name="hide" value="1">
                          </div>
                          <div class="row">
                            <div class="col-12">
                            <button type="submit" class="btn btn-primary float-right">Submit</button>
                            </div>
                          </div>
                          <input type="hidden" name="hide" value="1">
                        </form>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>
</div>