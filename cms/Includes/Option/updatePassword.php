<?php
if(isset($_POST['hide']) && $_POST['hide'] == '1'){
    
  $update=false;
  $newPassword=escapeString($_POST['newpassword']);
  $conPassword=escapeString($_POST['conpassword']);

  if($newPassword==$conPassword){
    $sql="UPDATE admin set admin_password='".md5($conPassword)."' where admin_id='".$_SESSION['user_id']."'";
    $mysqli->query($sql);
    if($mysqli->affected_rows>0){
        $update=true;
    }
  }

   if($update){
    echo '<script>window.location.href = "option.php?page=changePassword&success=true";</script>';
    exit;
   }else{
    echo '<script>window.location.href = "option.php?page=changePassword&success=false";</script>';
    exit;
   }
 

}

if(isset($_GET['success']) && $_GET['success']=='true'){
  $more_script.=<<<EOF
  toast.success("Your Password change Successful","Change Successful");
  EOF;
}

if(isset($_GET['success']) && $_GET['success']=='false'){
  $more_script.=<<<EOF
  toast.fail("Your Password change Unsuccessful the password does not match","Changes Successful");
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
              <li class="breadcrumb-item active">Change Password</li>
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
                   
                <form action="option.php?page=changePassword" method="post">
                    
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="exampleInputEmail1">New Password (Password length should more than 7 digit)<span style="color:red">*</span></label>
                            <input type="password" minlength="7" required name="newpassword" class="form-control newpassword" placeholder="New Password">
                        </div>
                    </div> 
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="exampleInputEmail1">Confirm Password (Password length should more than 7 digit) <span style="color:red">*</span></label>
                            <input type="password" minlength="7" required name="conpassword" class="form-control conpassword" placeholder="Confirm Password">
                        </div>
                    </div>    
                    
                    <div class="row">
                        <div class="col-12">
                            <input type="hidden" name="hide" value="1">
                        <button type="submit" class="btn btn-primary float-right">Submit</button>
                    </div>
                </form>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>
</div>