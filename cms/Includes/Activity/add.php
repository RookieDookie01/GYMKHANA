<?php
if(isset($_POST['hide']) && $_POST['hide'] == '1'){
  //18:00-19:00
  $time=escapeString($_POST['activity_hour']).":".escapeString($_POST['activity_minute'])."-".escapeString($_POST['activity_hour']+1).":".escapeString($_POST['activity_minute']);

  $data=array(
    'activity_name' => escapeString($_POST['activity_name']),
    'activity_time'=>$time,
    'plan_id'=>escapeString($_POST['activity_plan']),
    'activity_day'=>escapeString($_POST['activity_day']),
    'activity_type'=>escapeString($_POST['activity_type']),
    'activity_create_date'=>TODAY,
  );


  $tb='';
  $vl='';
  foreach($data as $table=>$value){
    $tb.= $table." ,";
    $vl.= "'".$value."' ,";
  };
  $tb=substr($tb,0,-2);
  $vl=substr($vl,0,-2);

  $sql="INSERT INTO activity(".$tb.") VALUES (".$vl.")";
  $query=$mysqli->query($sql);

   if($query){
    echo '<script>window.location.href = "activity.php?page=add&success=true";</script>';
    exit;
   }else{
    echo '<script>window.location.href = "activity.php?page=add&success=fail";</script>';
    exit;
   }
 

}

if(isset($_GET['success']) && $_GET['success']=='true'){
  $more_script.=<<<EOF
  toast.success("New Activity Add Successful","Add Successful");
  EOF;
}

if(isset($_GET['success']) && $_GET['success']=='false'){
  $more_script.=<<<EOF
  toast.fail("New Activity Add UnSuccessful","Add UnSuccessful");
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
                   
                        <form method="POST" action="activity.php?page=add">
                          <div class="row">
                            <div class="form-group col-12">
                                <label for="activity_name">Activity Title <span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="activity_name"  placeholder="Enter Name" required>
                            </div>
                          </div>

                          <div class="row">
                            <div class="form-group col-12">
                                <label for="activity_day">Activity Day <span style="color:red">*</span></label>
                                <select class="form-control" name="activity_day" required>
                                      <option value='' disabled selected>Please Choose One Day</option>
                                      <option value="Monday">Monday</option>
                                      <option value="Tuesday">Tuesday</option>
                                      <option value="Wednesday">Wednesday</option>
                                      <option value="Thursday">Thursday</option>
                                      <option value="Friday">Friday</option>
                                      <option value="Saturday">Saturday</option>
                                      <option value="Sunday">Sunday</option>
                                  </select>
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group col-12">
                                <label for="activity_plan">Activity Plan Required <span style="color:red">*</span></label>
                                <select class="form-control" name="activity_plan" required>
                                      <option value='' disabled selected>Please Choose One Plan</option>
                                      <option value="0">No Plan Required</option>
                                      <?php 
                                        $option="";
                                        $sql="SELECT * FROM plan where plan_delete_date='0000-00-00 00:00:00' or plan_delete_date is NULL";
                                        $query=$mysqli->query($sql);
                                        if($query->num_rows>0){
                                          while($row=$query->fetch_assoc()){
                                            $option.="<option value='".$row["plan_id"]."'>".$row['plan_name']."</option>";
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
                                      $options="<option value='' disabled selected>Please Choose the Starting Hour</option>";
                                        for($i=10;$i<23;$i++){
                                            $options.="<option value='".$i."'>".$i."</option>";
                                        }
                                        echo $options  
                                    ?>
                                      
                                  </select>
                                 
                            </div>
                            <div class="form-group col-6">
                              <label for="exampleInputEmail1">Activity Starting Minute <span style="color:red">*</span></label>
                                  <select class="form-control" name="activity_minute" required>
                                    <option value='' disabled selected>Please Choose the Starting Minute</option>
                                    <option value='00'>00</option>
                                    <option value='30'>30</option>
                                  </select>
                                 
                            </div>
                          </div>
                         
                          <div class="row">
                            <div class="form-group col-12">
                              <label for="activity_type">Activity Type <span style="color:red">*</span></label>
                              <input type="text" class="form-control" name="activity_type"  placeholder="Enter Type" required>
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