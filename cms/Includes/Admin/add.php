<?php
if(isset($_POST['hide']) && $_POST['hide'] == '1'){
  if($_POST['admin_password']!=''){
    $password=escapeString($_POST['admin_password']);
  }else{
    $password=substr(escapeString($_POST['admin_name']), -3).substr(escapeString($_POST['admin_contact']),-5);
  }
  $data=array(
    'admin_name' => escapeString($_POST['admin_name']),
    'admin_contact'=> escapeString($_POST['admin_contact']),
    'admin_email'=>escapeString($_POST['admin_email']),
    'admin_username'=>escapeString($_POST['admin_username']),
    'admin_password'=>md5($password),
    'admin_position'=>escapeString($_POST['admin_position']),
    'admin_status'=>escapeString($_POST['admin_status']),
    'admin_create_date'=>TODAY,
  );

  $tb='';
  $vl='';
  foreach($data as $table=>$value){
    $tb.= $table." ,";
    $vl.= "'".$value."' ,";
  };
  $tb=substr($tb,0,-2);
  $vl=substr($vl,0,-2);

  $sql="INSERT INTO admin(".$tb.") VALUES (".$vl.")";
  $query=$mysqli->query($sql);

   if($query){
    echo '<script>window.location.href = "admin.php?page=add&success=true";</script>';
    exit;
   }else{
    echo '<script>window.location.href = "admin.php?page=add&success=fail";</script>';
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
                   
                        <form method="POST" class="addEditform" action="admin.php?page=add">
                          <div class="row">
                            <div class="form-group col-6">
                                <label for="exampleInputEmail1">Admin Name <span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="admin_name"  placeholder="Enter Name" required>
                            </div>

                            <div class="form-group col-6">
                                <label for="exampleInputEmail1">Admin Contact <span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="admin_contact" placeholder="Enter Contact Number"  required>
                            </div>
                          </div>

                          <div class="row">
                            <div class="form-group col-6">
                                <label for="exampleInputEmail1">Admin Email <span style="color:red">*</span></label>
                                <input type="text" class="form-control gmail" name="admin_email"  placeholder="Enter email" required>
                            </div>

                            <div class="form-group col-6">
                            <label for="exampleInputEmail1">Admin Position</label>
                                <select class="form-control" name="admin_position" required>
                                    <option value='' disabled selected>Please Choose One Position</option>
                                    <option value="admin">Admin</option>
                                    <option value="finance">Finance</option>
                                </select>
                            </div>
                            </div>
                          <div class="row">
                            <div class="form-group col-6">
                                <label for="exampleInputEmail1">Admin Username <span style="color:red">*</span></label>
                                <input type="text" class="form-control username edit" name="admin_username" placeholder="Enter Username"  required>
                            </div>

                            <div class="form-group col-6">
                                <label for="exampleInputEmail1">Admin Password (Minumum 7 digit)</label>
                                <input type="password" minlength="7" class="form-control" name="admin_password" placeholder="Enter Password (DEFAULT last 3 character of name with contact 4 digit)">
                            </div>
                          </div>
                          <div class="row">
                          <div class="form-group col-12">
                                <label for="exampleInputEmail1">Admin Status</label>
                                <select class="form-control" name="admin_status" required>
                                    <option value='' disabled selected>Please Choose One Status</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">InActive</option>
                                </select>
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