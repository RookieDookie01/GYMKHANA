<?php
if(!isset($_GET['id']) || $_GET['id']==""){
    echo '<script>window.location.href = "admin.php?page=all";</script>';
    exit;
}

$admin_id=escapeString($_GET['id']);

if(isset($_POST['hide']) && $_POST['hide'] == '1'){

  $data=array(
    'admin_name' => escapeString($_POST['admin_name']),
    'admin_contact'=> escapeString($_POST['admin_contact']),
    'admin_email'=>escapeString($_POST['admin_email']),
    'admin_username'=>escapeString($_POST['admin_username']),
    'admin_position'=>escapeString($_POST['admin_position']),
    'admin_status'=>escapeString($_POST['admin_status']),
    'admin_edit_date'=>TODAY,
  );

 
  $querydata='';
  foreach($data as $table=>$value){
    $querydata.= $table." = '".$value."' ,";
  };

  if($_POST['admin_password']!=''){
    $querydata.= "admin_password"." = '".md5(escapeString($_POST['admin_password']))."' ,";
  }

  $querydata=substr($querydata,0,-2);

    $sql="UPDATE admin SET ".$querydata." WHERE admin_id = ".$admin_id;
  $query=$mysqli->query($sql);

   if($query){
    echo '<script>window.location.href = "admin.php?page=edit&id='.$admin_id.'&success=true";</script>';
    exit;
   }else{
    echo '<script>window.location.href = "admin.php?page=edit&id='.$admin_id.'&success=fail";</script>';
    exit;
   }
 

}

if(isset($_GET['success']) && $_GET['success']=='true'){
    $more_script.=<<<EOF
    toast.success("User Data Edit Successful","Edit Successful");
    EOF;
}
  
if(isset($_GET['success']) && $_GET['success']=='false'){
    $more_script.=<<<EOF
    toast.fail("User Data Edit UnSuccessful","Edit Error");
    EOF;
}
  

$sql="SELECT * FROM admin WHERE admin_id='".$admin_id."' AND admin_delete_date IS NULL limit 1";
$adminQuery=$mysqli->query($sql);
if($adminQuery->num_rows==0){
    echo '<script>window.location.href = "admin.php?page=all";</script>';
    exit;
}
$data=$adminQuery->fetch_assoc();

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
                   
                        <form method="POST" class="addEditform" action="admin.php?page=edit&id=<?=$admin_id?>">
                          <div class="row">
                            <div class="form-group col-6">
                                <label for="exampleInputEmail1">Admin Name <span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="admin_name" value="<?=$data['admin_name']?>" placeholder="Enter Name" required>
                            </div>

                            <div class="form-group col-6">
                                <label for="exampleInputEmail1">Admin Contact <span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="admin_contact" value="<?=$data['admin_contact']?>" placeholder="Enter Contact Number"  required>
                            </div>
                          </div>

                          <div class="row">
                            <div class="form-group col-6">
                                <label for="exampleInputEmail1">Admin Email <span style="color:red">*</span></label>
                                <input type="text" class="form-control gmail edit" name="admin_email" value="<?=$data['admin_email']?>" placeholder="Enter email" required>
                            </div>

                            <div class="form-group col-6">
                            <label for="exampleInputEmail1">Admin Position</label>
                                <select class="form-control" name="admin_position" required>
                                    <option value='' disabled>Please Choose One Position</option>
                                    <option value="admin" <?=($data['admin_position']=="admin"?"selected":"")?>>Admin</option>
                                    <option value="finance" <?=($data['admin_position']=="finance"?"selected":"")?>>Finance</option>
                                </select>
                            </div>
                            </div>
                          <div class="row">
                            <div class="form-group col-6">
                                <label for="exampleInputEmail1">Admin Username <span style="color:red">*</span></label>
                                <input type="text" class="form-control username edit" name="admin_username" value='<?=$data['admin_username']?>' placeholder="Enter Username"  required>
                            </div>

                            <div class="form-group col-6">
                                <label for="exampleInputEmail1">Admin Password (Minumum 7 digit)</label>
                                <input type="password" class="form-control" name="admin_password"  placeholder="Enter Password (DEFAULT last 3 character of name with contact 4 digit)">
                            </div>
                          </div>
                          <div class="row">
                          <div class="form-group col-12">
                                <label for="exampleInputEmail1">Admin Status</label>
                                <select class="form-control" name="admin_status" required>
                                    <option value='' disabled >Please Choose One Status</option>
                                    <option value="active" <?=($data['admin_status']=="active"?"selected":"")?>>Active</option>
                                    <option value="inactive" <?=($data['admin_status']=="inactive"?"selected":"")?>>InActive</option>
                                </select>
                            </div>
                            <input type="hidden" name="hide" value="1">
                            <input type="hidden" name="id" value="<?=$admin_id?>">
                          </div>
                          <div class="row">
                            <div class="col-12">
                            <button type="submit" class="btn btn-primary float-right">Submit</button>
                            </div>
                          </div>
                        </form>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>
</div>