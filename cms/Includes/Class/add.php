<?php
if(isset($_POST['hide']) && $_POST['hide'] == '1'){
  $subjectarray=escapeString($_POST['class_subject']);
  
  $data=array(
    'class_name' => escapeString($_POST['class_name']),
    'class_type'=> escapeString($_POST['class_type']),
    'trainer_id'=>escapeString($_POST['trainer_id']),
    'class_desc'=>escapeString($_POST['class_description']),
    'class_subject'=>json_encode($subjectarray),
    'class_create_date'=>TODAY,
  );

  $tb='';
  $vl='';
  foreach($data as $table=>$value){
    $tb.= $table." ,";
    $vl.= "'".$value."' ,";
  };
  $tb=substr($tb,0,-2);
  $vl=substr($vl,0,-2);

  $sql="INSERT INTO class(".$tb.") VALUES (".$vl.")";
  $query=$mysqli->query($sql);
   if($query){
    echo '<script>window.location.href = "class.php?page=add&success=true";</script>';
    exit;
   }else{
    echo '<script>window.location.href = "class.php?page=add&success=fail";</script>';
    exit;
   }
 

}

if(isset($_GET['success']) && $_GET['success']=='true'){
  $more_script.=<<<EOF
  toast.success("New Class Add Successful","Add Successful");
  EOF;
}

if(isset($_GET['success']) && $_GET['success']=='false'){
  $more_script.=<<<EOF
  toast.fail("New Class Add UnSuccessful","Add Successful");
  EOF;
}

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All New class</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">class</li>
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
                        <form method="POST" action="class.php?page=add">
                          <div class="row">
                            <div class="form-group col-6">
                                <label for="class_name">Class Name <span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="class_name" placeholder="Enter Name" required>
                            </div>
                            
                            <div class="form-group col-6">
                                <label for="class_type">Class Type <span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="class_type" placeholder="Enter Class Type"  required>
                            </div>
                          </div>
                          
                          <div class="row">          
                            <div class="form-group col-12">
                                <label for="trainer_id">Incharge Trainer <span style="color:red">*</span></label>
                                <select class="form-control" name="trainer_id" required>
                                  <?php
                                    $options= $options="<option value='' disabled selected>Please choose a Trainer</option>";
                                    $sql="select * from trainer where trainer_delete_date='0000-00-00 00:00:00' OR trainer_delete_date IS NULL";
                                    $query=$mysqli->query($sql);
                                    if($query->num_rows>0){
                                      while($row=$query->fetch_assoc()){
                                        $options.="<option value='".$row['trainer_id']."'>".$row['trainer_name']."</option>";
                                      } 
                                    }
                                    echo $options;
                                  ?>
                                </select>
                            </div>
                          </div>

                          <div class="row">          
                            <div class="form-group col-12">
                                <label for="class_description">Class Description <span style="color:red">*</span></label>
                                <textarea class="form-control" name="class_description" placeholder="Enter The Description"></textarea>
                            </div>
                          </div>

                         
                          <div class="row subject">
                          <div class="form-group col-6">
                                <label for="class_name">Class Subject<span style="color:red">*</span></label>
                                <div class="input-group">
                                <select class="form-control" name="class_subject[]" required>
                                  <?php
                                  $options="<option value='' disabled selected>Please choose a subject</option>";
                                  $sql="select * from activity where activity_delete_date='0000-00-00 00:00:00' OR activity_delete_date IS NULL";
                                  $query=$mysqli->query($sql);
                                  if($query->num_rows>0){
                                    while($row=$query->fetch_assoc()){
                                      $options.="<option value='".$row['activity_id']."'>".$row['activity_name']."</option>";
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
                          </div>
                          
                          <div class="row">
                            <div class="col-12">
                            <input type="hidden" name="hide" value="1">
                            <button type="submit" class="btn btn-primary float-right">Submit</button>
                            <button type="button" class="btn btn-primary addmoreField float-right mr-3">Add more Subject</button>
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
$more_script.=<<<EOF
$(document).ready(function(){
  $(".addmoreField").on("click",function(){
    if ($(".subject .form-group").length == 6) {
      pop.fail("One Class Maximum only can have 6 activity");
    }else{
      newField=$(".subject .form-group:first").clone();
      newField.find("select").val(""); // clear input
      $(".subject").append(newField);
    }
    updateDisabledOptions();
  });
  $(".subject").on("click", ".removeField", function(){
    if ($(".subject .form-group").length > 1) {
      $(this).closest(".form-group").remove();
      updateDisabledOptions();
    }else{
      pop.fail("A Class Minumum Should have 1 activity");
    }
  });
  $(".subject").on("change", "select", function(){
      updateDisabledOptions();
  });

  function updateDisabledOptions() {
    $(".subject select option:not(:first-child)").prop("disabled",false);
    $(".subject select").each(function(){
        var selectedSubject = $(this).val();
        var siblingSelects = $(this).closest(".subject").find("select").not(this);
        if (siblingSelects.length > 0) {
          siblingSelects.find("option[value='" + selectedSubject + "']").prop("disabled", true);
        }
    });
  }
});
EOF;
?>