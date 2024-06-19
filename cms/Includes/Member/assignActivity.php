<?php
if(!isset($_GET['id']) || $_GET['id']==""){
    echo '<script>window.location.href = "member.php?page=activity";</script>';
    exit;
}

$customer_id=escapeString($_GET['id']);


if(isset($_POST['hide']) && $_POST['hide'] == '1'){
    $activity=escapeString($_POST['customer_activity']);
    // classid|||activityid
    if(isset($activity) && is_array($activity)){
        //remove all
        $sql="UPDATE customer_activity set table_delete_date = '".TODAY."' WHERE customer_id='".$customer_id."'";
        $mysqli->query($sql);
        //remove all
        //add new
        foreach($activity as $temp){
            $data=explode("|||",$temp);
            $sql2="INSERT INTO customer_activity(customer_id,class_id,activity_id,table_create_date) VALUES (
                '".$customer_id."',
                '".$data[0]."',
                '".$data[1]."',
                '".TODAY."'
            )
            ";
            
            $mysqli->query($sql2);
        }
    }
    echo '<script>window.location.href = "member.php?page=assignActivity&id='.$customer_id.'&success=true";</script>';
    exit;
}

if(isset($_GET['success']) && $_GET['success']=='true'){
  $more_script.=<<<EOF
  toast.success("Activity Edit Successful","Edit Successful");
  EOF;
}

if(isset($_GET['success']) && $_GET['success']=='false'){
  $more_script.=<<<EOF
  toast.fail("User Data Edit UnSuccessful","Edit Error");
  EOF;
}


$sql="SELECT * FROM customer WHERE customer_id='".$customer_id."' AND customer_delete_date = '0000-00-00 00:00:00' limit 1";
$CustomerQuery=$mysqli->query($sql);
if($CustomerQuery->num_rows==0){
    echo '<script>window.location.href = "member.php?page=all";</script>';
    exit;
}
$data=$CustomerQuery->fetch_assoc();

//use id get total activity
$sql2="SELECT * from customer_activity where customer_id='".$data['customer_id']."' AND (table_delete_date IS NULL or table_delete_date='0000-00-00 00:00:00')";
$query2=$mysqli->query($sql2);

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Assign Activity to Member</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
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
                    <h3 class="card-title">
                        Customer Name : <strong><?=$data['customer_name']?></strong>
                    </h3>
                    <div class="card-tools">
                        <?=($query2->num_rows>0 ?"This Customer Current Have : ".$query2->num_rows." Activities":"This Customer Current Still diden have any Activity")?>
                    </div>
               
                </div>
              <!-- /.card-header -->
                <div class="card-body">
                        <form method="POST" action="member.php?page=assignActivity&id=<?=$customer_id?>">
                          <div class="row">
                            <div class="form-group col-12">
                                <label for="exampleInputEmail1">Customer Current Plan</label>
                                <input type="text" class="form-control" name="customer_plan"  placeholder="Enter Name" disabled value="<?=($data['customer_plan']==""?"No Active Plan":$data['customer_plan'])?>">
                            </div>
                          </div>
                          <div class="row activity">
                            
                          <?php
                            if($query2->num_rows>0){
                                while($activityrow=$query2->fetch_assoc()){
                                    ?>
                                    <div class="form-group col-12">
                                <label for="class_name">Activity<span style="color:red">*</span></label>
                                <div class="input-group">
                                    <select class="form-control" name="customer_activity[]" required>
                                    <?php
                                    $options="<option value='' disabled selected>Please choose an activity</option>";
                                    $sql="select a.*,b.trainer_name from class a
                                    LEFT JOIN trainer b ON a.trainer_id=b.trainer_id
                                    order by a.trainer_id;";
                                    $query=$mysqli->query($sql);
                                    if($query->num_rows>0){
                                        while($row=$query->fetch_assoc()){
                                            //class layer
                                            $activity_id=implode(",",json_decode($row['class_subject']));
                                            $activitysql="SELECT * FROM activity where activity_id IN (".$activity_id.") AND (activity_delete_date='0000-00-00 00:00:00' OR activity_delete_date IS NULL)";
                                            $activityquery=$mysqli->query($activitysql);
                                            if($activityquery->num_rows>0){
                                                while($row2=$activityquery->fetch_assoc()){
                                                    $options.="<option ". (($row['class_id'] == $activityrow['class_id'] && $row2['activity_id'] == $activityrow['activity_id']) ? "selected" : "")." value='".$row['class_id']."|||".$row2['activity_id']."'>".$row2['activity_name']." - ".$row['class_name']." - ".$row['trainer_name']."</option>";
                                                }
                                                
                                            }
                                        } 
                                    }
                                    echo $options;
                                    ?>
                                    </select>
                                    <div class="input-group-append">
                                        <button class="btn btn-danger removeField" type="button">Remove</button>
                                    </div>
                                </div>
                            </div>
                                    <?php
                                }
                                //another action
                            }else{

                          ?>
                            <div class="form-group col-12">
                                <label for="class_name">Activity<span style="color:red">*</span></label>
                                <div class="input-group">
                                    <select class="form-control" name="customer_activity[]" required>
                                    <?php
                                    $options="<option value='' disabled selected>Please choose an activity</option>";
                                    $sql="select a.*,b.trainer_name from class a
                                    LEFT JOIN trainer b ON a.trainer_id=b.trainer_id
                                    order by a.trainer_id;";
                                    $query=$mysqli->query($sql);
                                    if($query->num_rows>0){
                                        while($row=$query->fetch_assoc()){
                                            //class layer
                                            $activity_id=implode(",",json_decode($row['class_subject']));
                                            $activitysql="SELECT * FROM activity where activity_id IN (".$activity_id.") AND (activity_delete_date='0000-00-00 00:00:00' OR activity_delete_date IS NULL)";
                                            $activityquery=$mysqli->query($activitysql);
                                            if($activityquery->num_rows>0){
                                                while($row2=$activityquery->fetch_assoc()){
                                                    $options.="<option value='".$row['class_id']."|||".$row2['activity_id']."'>".$row2['activity_name']." - ".$row['class_name']." - ".$row['trainer_name']."</option>";
                                                }
                                                
                                            }
                                        } 
                                    }
                                    echo $options;
                                    ?>
                                    </select>
                                    <div class="input-group-append">
                                        <button class="btn btn-danger removeField" type="button">Remove</button>
                                    </div>
                                </div>
                            </div>
                            <?php
                            } 
                            ?>
                          </div>

                         
                         
                         
                          <div class="row">
                            <div class="col-12">
                            <input type="hidden" name="hide" value="1">
                            <button type="submit" class="btn btn-primary float-right">Submit</button>
                            <button type="button"  class="btn btn-info addmoreField float-right mr-3">Add More Activity</button>
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

<?php 
$more_script.= <<< EOF
$(document).ready(function(){
    $(".addmoreField").on("click",function(){
      if ($(".activity .form-group").length == 6) {
        pop.fail("One Customer Maximum only can have 6 activity");
      }else{
        newField=$(".activity .form-group:first").clone();
        newField.find("select").val(""); // clear input
        $(".activity").append(newField);
      }
      updateDisabledOptions();
    });
    
    $(".activity").on("click", ".removeField", function(){
      if ($(".activity .form-group").length > 1) {
        $(this).closest(".form-group").remove();
        updateDisabledOptions();
      }else{
        pop.fail("A Class Minumum Should have 1 activity");
      }
    });
    $(".activity").on("change", "select", function(){
        updateDisabledOptions();
    });
  
    function updateDisabledOptions() {
      $(".activity select option:not(:first-child)").prop("disabled",false);
      $(".activity select").each(function(){
          var selectedSubject = $(this).val();
          var siblingSelects = $(this).closest(".activity").find("select").not(this);
          if (siblingSelects.length > 0) {
            siblingSelects.find("option[value='" + selectedSubject + "']").prop("disabled", true);
          }
      });
    }
    updateDisabledOptions();
  });
EOF;

?>