<?php
if(isset($_POST['hide']) && $_POST['hide'] == '1'){
  if($_POST['trainer_password']!=''){
    $password=escapeString($_POST['trainer_password']);
  }else{
    $password=substr(escapeString($_POST['trainer_name']), -3).substr(escapeString($_POST['trainer_contact']),-5);
  }
  $data=array(
    'trainer_name' => escapeString($_POST['trainer_name']),
    'trainer_contact'=> escapeString($_POST['trainer_contact']),
    'trainer_email'=>escapeString($_POST['trainer_email']),
    'trainer_age'=>escapeString($_POST['trainer_age']),
    'trainer_username'=>escapeString($_POST['trainer_username']),
    'trainer_password'=>md5($password),
    'trainer_weight'=>escapeString($_POST['trainer_weight']),
    'trainer_height'=>escapeString($_POST['trainer_height']),
    'trainer_address'=>escapeString($_POST['trainer_address']),
    'trainer_info'=>escapeString($_POST['trainer_info']),
    'trainer_create_date'=>TODAY,
  );

  $tb='';
  $vl='';
  foreach($data as $table=>$value){
    $tb.= $table." ,";
    $vl.= "'".$value."' ,";
  };
  $tb=substr($tb,0,-2);
  $vl=substr($vl,0,-2);

  $sql="INSERT INTO trainer(".$tb.") VALUES (".$vl.")";
  $query=$mysqli->query($sql);
  
  
   if($query){
    echo '<script>window.location.href = "trainer.php?page=add&success=true";</script>';
    exit;
   }else{
    echo '<script>window.location.href = "trainer.php?page=add&success=fail";</script>';
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
            <h1>All New Trainer</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Trainer</li>
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
                   
                        <form method="POST" class="addEditform" action="trainer.php?page=add">
                          <div class="row">
                            <div class="form-group col-6">
                                <label for="trainer_name">Trainer Name <span style="color:red">*</span></label>
                                <input type="text" id="trainer_name" class="form-control" name="trainer_name"  placeholder="Enter Name" required>
                            </div>

                            <div class="form-group col-6">
                                <label for="trainer_contact">Trainer Contact <span style="color:red">*</span></label>
                                <input type="text" class="form-control" id="trainer_contact" name="trainer_contact" placeholder="Enter Contact Number"  required>
                            </div>
                          </div>

                          <div class="row">
                            <div class="form-group col-6">
                                <label for="trainer_email">Trainer Email <span style="color:red">*</span></label>
                                <input type="text" class="form-control gmail" id="trainer_email" name="trainer_email"  placeholder="Enter email" required>
                            </div>

                            <div class="form-group col-6">
                                <label for="trainer_age">Trainer Age <span style="color:red">*</span></label>
                                <input type="number" class="form-control" id="trainer_age" name="trainer_age" placeholder="Enter Age" required min="19">
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group col-6">
                                <label for="trainer_username">Trainer Username <span style="color:red">*</span></label>
                                <input type="text" class="form-control username" id="trainer_username" name="trainer_username" placeholder="Enter Username"  required>
                            </div>

                            <div class="form-group col-6">
                                <label for="trainer_password">Trainer Password (Minumum 7 digit)</label>
                                <input type="password" class="form-control" id="trainer_password" name="trainer_password" placeholder="Enter Password (DEFAULT last 3 character of name with contact 4 digit)">
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group col-6">
                                <label for="trainer_weight">Trainer Weight <span style="color:red">*</span></label>
                                <input type="number" class="form-control" id="trainer_weight" name="trainer_weight" placeholder="Enter trainer's Weight"  required>
                            </div>

                            <div class="form-group col-6">
                                <label for="trainer_height">Trainer Height<span style="color:red">*</span></label>
                                <input type="number" class="form-control" id="trainer_height" name="trainer_height" placeholder="Enter trainer's Height"  required>
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group col-12">
                                <label for="trainer_address">Trainer Address <span style="color:red">*</span></label>
                                <input type="text" class="form-control" id="trainer_address" name="trainer_address" placeholder="Enter Address">
                            </div>
                            <input type="hidden" name="hide" value="1">
                          </div>
                          <div class="row">
                            <div class="form-group col-12">
                                <label for="trainer_info">Trainer Information <span style="color:red">*</span></label>
                                <textarea class="form-control" id="trainer_info" name="trainer_info" placeholder="Enter trainer's information" rows="4" required></textarea>
                            </div>
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