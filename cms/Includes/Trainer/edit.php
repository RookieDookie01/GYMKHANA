<?php
if(!isset($_GET['id']) || $_GET['id']==""){
    echo '<script>window.location.href = "trainer.php?page=all";</script>';
    exit;
}

$trainer_id=escapeString($_GET['id']);


if(isset($_POST['hide']) && $_POST['hide'] == '1'){

  $data=array(
    'trainer_name' => escapeString($_POST['trainer_name']),
    'trainer_contact'=> escapeString($_POST['trainer_contact']),
    'trainer_email'=>escapeString($_POST['trainer_email']),
    'trainer_age'=>escapeString($_POST['trainer_age']),
    'trainer_username'=>escapeString($_POST['trainer_username']),
    'trainer_weight'=>escapeString($_POST['trainer_weight']),
    'trainer_height'=>escapeString($_POST['trainer_height']),
    'trainer_address'=>escapeString($_POST['trainer_address']),
    'trainer_info'=>escapeString($_POST['trainer_info']),
    'trainer_edit_date'=>TODAY
  );


  $querydata='';
  foreach($data as $table=>$value){
    $querydata.= $table." = '".$value."' ,";
  };

  if($_POST['trainer_password']!=''){
    $querydata.= "trainer_password"." = '".md5(escapeString($_POST['trainer_password']))."' ,";
  }

  $querydata=substr($querydata,0,-2);


  $sql="UPDATE trainer SET ".$querydata." WHERE trainer_id = ".$trainer_id;
  
  $query=$mysqli->query($sql);
   if($query){
    echo '<script>window.location.href = "trainer.php?page=edit&id='.$trainer_id.'&success=true";</script>';
    exit;
   }else{
    echo '<script>window.location.href = "trainer.php?page=add&id='.$trainer_id.'&success=fail";</script>';
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


$sql="SELECT * FROM trainer WHERE trainer_id='".$trainer_id."' AND trainer_delete_date = '0000-00-00 00:00:00' limit 1";
$trainerQuery=$mysqli->query($sql);
if($trainerQuery->num_rows==0){
    echo '<script>window.location.href = "trainer.php?page=all";</script>';
    exit;
}
$data=$trainerQuery->fetch_assoc();
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All New trainers</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">trainers</li>
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
                        <form method="POST" class="addEditform" action="trainer.php?page=edit&id=<?=$trainer_id?>">
                          <div class="row">
                            <div class="form-group col-6">
                                <label for="trainer_name">Trainer Name <span style="color:red">*</span></label>
                                <input type="text" id="trainer_name" class="form-control" name="trainer_name"  placeholder="Enter Name" required value="<?=$data['trainer_name']?>">
                            </div>

                            <div class="form-group col-6">
                                <label for="trainer_contact">Trainer Contact <span style="color:red">*</span></label>
                                <input type="text" class="form-control" id="trainer_contact" name="trainer_contact" placeholder="Enter Contact Number" required value="<?=$data['trainer_contact']?>">
                            </div>
                          </div>

                          <div class="row">
                            <div class="form-group col-6">
                                <label for="trainer_email">Trainer Email <span style="color:red">*</span></label>
                                <input type="text" class="form-control gmail edit" id="trainer_email" name="trainer_email"  placeholder="Enter email" required value="<?=$data['trainer_email']?>">
                            </div>

                            <div class="form-group col-6">
                                <label for="trainer_age">Trainer Age <span style="color:red">*</span></label>
                                <input type="number" class="form-control" id="trainer_age" name="trainer_age" placeholder="Enter Age" required min="19" value="<?=$data['trainer_age']?>">
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group col-6">
                                <label for="trainer_username">Trainer Username <span style="color:red">*</span></label>
                                <input type="text" class="form-control username edit" id="trainer_username" name="trainer_username" placeholder="Enter Username" required value="<?=$data['trainer_username']?>">
                            </div>

                            <div class="form-group col-6">
                                <label for="trainer_password">Trainer Password (Minumum 7 digit)</label>
                                <input type="password" class="form-control" id="trainer_password" name="trainer_password" placeholder="Enter Password (Default will be Original Password)">
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group col-6">
                                <label for="trainer_weight">Trainer Weight <span style="color:red">*</span></label>
                                <input type="number" class="form-control" id="trainer_weight" name="trainer_weight" placeholder="Enter trainer's Weight"  required value="<?=$data['trainer_weight']?>">
                            </div>

                            <div class="form-group col-6">
                                <label for="trainer_height">Trainer Height<span style="color:red">*</span></label>
                                <input type="number" class="form-control" id="trainer_height" name="trainer_height" placeholder="Enter trainer's Height"  required value="<?=$data['trainer_height']?>">
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group col-12">
                                <label for="trainer_address">Trainer Address <span style="color:red">*</span></label>
                                <input type="text" class="form-control" id="trainer_address" name="trainer_address" placeholder="Enter Address" value="<?=$data['trainer_address']?>">
                            </div>
                            <input type="hidden" name="hide" value="1">
                          </div>
                          <div class="row">
                            <div class="form-group col-12">
                                <label for="trainer_info">Trainer Information <span style="color:red">*</span></label>
                                <textarea class="form-control" id="trainer_info" name="trainer_info" placeholder="Enter trainer's information" rows="4" required><?=$data['trainer_info']?></textarea>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-12">
                            <button type="submit" class="btn btn-primary float-right">Submit</button>
                            </div>
                          </div>
                          <input type="hidden" name="hide" value="1">
                          <input type="hidden" name="id" value="<?=$trainer_id?>">
                        </form>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>
</div>