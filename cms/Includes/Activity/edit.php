<?php
if(!isset($_GET['id']) || $_GET['id']==""){
    echo '<script>window.location.href = "activity.php?page=all";</script>';
    exit;
}

$activity_id=escapeString($_GET['id']);

if(isset($_POST['hide']) && $_POST['hide'] == '1'){
    $time=escapeString($_POST['activity_hour']).":".escapeString($_POST['activity_minute'])."-".escapeString($_POST['activity_hour']+1).":".escapeString($_POST['activity_minute']);
    $data=array(
        'activity_name' => escapeString($_POST['activity_name']),
        'activity_time'=>$time,
        'plan_id'=>escapeString($_POST['activity_plan']),
        'activity_day'=>escapeString($_POST['activity_day']),
        'activity_type'=>escapeString($_POST['activity_type']),
        'activity_edit_date'=>TODAY,
      );
  
   
    $querydata='';
    foreach($data as $table=>$value){
      $querydata.= $table." = '".$value."' ,";
    };
  
    $querydata=substr($querydata,0,-2);
  
      $sql="UPDATE activity SET ".$querydata." WHERE activity_id = ".$activity_id;
    $query=$mysqli->query($sql);
  
     if($query){
      echo '<script>window.location.href = "activity.php?page=edit&id='.$activity_id.'&success=true";</script>';
      exit;
     }else{
      echo '<script>window.location.href = "activity.php?page=edit&id='.$activity_id.'&success=fail";</script>';
      exit;
     }
   
  
}

if(isset($_GET['success']) && $_GET['success']=='true'){
    $more_script.=<<<EOF
    toast.success("Activity Data Edit Successful","Edit Successful");
    EOF;
}
  
if(isset($_GET['success']) && $_GET['success']=='false'){
    $more_script.=<<<EOF
    toast.fail("Activity Data Edit UnSuccessful","Edit Error");
    EOF;
}


$sql="SELECT * FROM activity WHERE activity_id='".$activity_id."' AND (activity_delete_date IS NULL or activity_delete_date='0000-00-00 00:00:00') limit 1";
$activityQuery=$mysqli->query($sql);
if($activityQuery->num_rows==0){
    echo '<script>window.location.href = "activity.php?page=all";</script>';
    exit;
}
$data=$activityQuery->fetch_assoc();
$hour=explode(":",explode("-",$data['activity_time'])[0])[0];
$minute=explode(":",explode("-",$data['activity_time'])[0])[1];

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
                   
                        <form method="POST" action="activity.php?page=edit&id=<?=$activity_id?>">
                          <div class="row">
                            <div class="form-group col-12">
                                <label for="activity_name">Activity Title <span style="color:red">*</span></label>
                                <input type="text" class="form-control" value="<?=$data['activity_name']?>" name="activity_name"  placeholder="Enter Name" required>
                            </div>
                          </div>

                          <div class="row">
                            <div class="form-group col-12">
                                <label for="activity_day">Activity Day <span style="color:red">*</span></label>
                                <select class="form-control" name="activity_day" required>
                                      <option value='' disabled>Please Choose One Day</option>
                                      <option value="Monday" <?=($data['activity_day']=='Monday'?'selected':'')?> >Monday</option>
                                      <option value="Tuesday" <?=($data['activity_day']=='Tuesday'?'selected':'')?> >Tuesday</option>
                                      <option value="Wednesday" <?=($data['activity_day']=='Wednesday'?'selected':'')?>>Wednesday</option>
                                      <option value="Thursday" <?=($data['activity_day']=='Thursday'?'selected':'')?>>Thursday</option>
                                      <option value="Friday" <?=($data['activity_day']=='Friday'?'selected':'')?>>Friday</option>
                                      <option value="Saturday" <?=($data['activity_day']=='Saturday'?'selected':'')?>>Saturday</option>
                                      <option value="Sunday" <?=($data['activity_day']=='Sunday'?'selected':'')?>>Sunday</option>
                                  </select>
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group col-12">
                                <label for="activity_plan">Activity Plan Required <span style="color:red">*</span></label>
                                <select class="form-control" name="activity_plan" required>
                                      <option value='' disabled>Please Choose One Plan</option>
                                      <option value="0" <?=($data['plan_id']=='0'?"selected":"")?>>No Plan Required</option>
                                      <?php 
                                        $option="";
                                        $sql="SELECT * FROM plan where plan_delete_date='0000-00-00 00:00:00' or plan_delete_date is NULL";
                                        $query=$mysqli->query($sql);
                                        if($query->num_rows>0){
                                          while($row=$query->fetch_assoc()){
                                            $option.="<option ".($row['plan_id']==$data['plan_id']?"selected":"")." value='".$row["plan_id"]."'>".$row['plan_name']."</option>";
                                          }
                                        }
                                        echo $option;
                                      ?>  
                                  </select>
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group col-6">
                              <label for="exampleInputEmail1">Activity Starting Hour <span style="color:red">*</span></label>
                                  <select class="form-control" name="activity_hour" required>
                                    <?php
                                      $options="<option value='' disabled>Please Choose the Starting Hour</option>";
                                        for($i=10;$i<23;$i++){
                                            $options.="<option ".($i==$hour?"selected":"")." value='".$i."'>".$i."</option>";
                                        }
                                        echo $options  
                                    ?>
                                      
                                  </select>
                                 
                            </div>
                            <div class="form-group col-6">
                              <label for="exampleInputEmail1">Activity Starting Minute <span style="color:red">*</span></label>
                                  <select class="form-control" name="activity_minute" required>
                                    <option value='' disabled>Please Choose the Starting Minute</option>
                                    <option value='00' <?=($minute=="00"?"selected":"")?>>00</option>
                                    <option value='30' <?=($minute=="00"?"selected":"")?>>30</option>
                                  </select>
                                 
                            </div>
                          </div>
                         
                          <div class="row">
                            <div class="form-group col-12">
                              <label for="activity_type">Activity Type <span style="color:red">*</span></label>
                              <input type="text" class="form-control" name="activity_type" value="<?=$data['activity_type']?>"  placeholder="Enter Type" required>
                            </div>
                            <input type="hidden" name="hide" value="1">
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