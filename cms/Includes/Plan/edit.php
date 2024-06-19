<?php
if(!isset($_GET['id']) || $_GET['id']==""){
    echo '<script>window.location.href = "plan.php?page=all";</script>';
    exit;
}

$plan_id=escapeString($_GET['id']);


if(isset($_POST['hide']) && $_POST['hide'] == '1'){

  $data=array(
    'plan_name' => escapeString($_POST['plan_name']),
    'plan_price'=>escapeString($_POST['plan_price']),
    'plan_duration'=>escapeString($_POST['plan_duration']),
    'plan_description'=>escapeString($_POST['plan_description']),
    'plan_edit_date'=>TODAY
  );

  $querydata='';
  foreach($data as $table=>$value){
    $querydata.= $table." = '".$value."' ,";
  };

  $querydata=substr($querydata,0,-2);


  $sql="UPDATE plan SET ".$querydata." WHERE plan_id = ".$plan_id;
  
  $query=$mysqli->query($sql);
   if($query){
    echo '<script>window.location.href = "plan.php?page=edit&id='.$plan_id.'&success=true";</script>';
    exit;
   }else{
    echo '<script>window.location.href = "plan.php?page=add&id='.$plan_id.'&success=fail";</script>';
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


$sql="SELECT * FROM plan WHERE plan_id='".$plan_id."' AND plan_delete_date = '0000-00-00 00:00:00' limit 1";
$planQuery=$mysqli->query($sql);
if($planQuery->num_rows==0){
    echo '<script>window.location.href = "plan.php?page=all";</script>';
    exit;
}
$data=$planQuery->fetch_assoc();
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Plan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Plan</li>
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
                <form method="POST" action="plan.php?page=edit&id=<?=$plan_id?>">
                          <div class="row">
                            <div class="form-group col-12">
                                <label for="plan_name">Plan Name<span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="plan_name" value="<?=$data['plan_name']?>" placeholder="Enter Name" required>
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group col-12">
                                <label for="plan_price">Plan Price (In RM)<span style="color:red">*</span></label>
                                <input type="number" class="form-control" id="plan_price" value="<?=$data['plan_price']?>" name="plan_price" min="10" step="0.01"  required placeholder="Enter Price">
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group col-12">
                                <label for="plan_description">Plan Description<span style="color:red">*</span></label>
                                <textarea class="form-control" id="plan_description" name="plan_description"><?=$data['plan_description']?></textarea>
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group col-12">
                                <label for="plan_duration">Plan Duration (In Minutes)<span style="color:red">*</span></label>
                                <input type="number" class="form-control" id="plan_duration" value="<?=$data['plan_duration']?>" name="plan_duration" min="10"  required placeholder="Enter Duration">
                            </div>
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