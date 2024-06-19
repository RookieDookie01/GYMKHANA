<?php
if(!isset($_GET['id']) || $_GET['id']==""){
    echo '<script>window.location.href = "member.php?page=all";</script>';
    exit;
}

$customer_id=escapeString($_GET['id']);


if(isset($_POST['hide']) && $_POST['hide'] == '1'){

  $data=array(
    'customer_name' => escapeString($_POST['customer_name']),
    'customer_contact'=> escapeString($_POST['customer_contact']),
    'customer_email'=>escapeString($_POST['customer_email']),
    'customer_plan'=>escapeString($_POST['customer_plan']),
    'customer_username'=>escapeString($_POST['customer_username']),
    'customer_address'=>escapeString($_POST['customer_address']),
    'customer_edit_date'=>TODAY
  );

  $querydata='';
  foreach($data as $table=>$value){
    $querydata.= $table." = '".$value."' ,";
  };

  if($_POST['customer_password']!=''){
    $querydata.= "customer_password"." = '".md5(escapeString($_POST['customer_password']))."' ,";
  }

  $querydata=substr($querydata,0,-2);


  $sql="UPDATE customer SET ".$querydata." WHERE customer_id = ".$customer_id;
  
  $query=$mysqli->query($sql);
   if($query){
    echo '<script>window.location.href = "member.php?page=edit&id='.$customer_id.'&success=true";</script>';
    exit;
   }else{
    echo '<script>window.location.href = "member.php?page=add&id='.$customer_id.'&success=fail";</script>';
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


$sql="SELECT * FROM customer WHERE customer_id='".$customer_id."' AND customer_delete_date = '0000-00-00 00:00:00' limit 1";
$CustomerQuery=$mysqli->query($sql);
if($CustomerQuery->num_rows==0){
    echo '<script>window.location.href = "member.php?page=all";</script>';
    exit;
}
$data=$CustomerQuery->fetch_assoc();
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All New Members</h1>
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
              <!-- /.card-header -->
                <div class="card-body">
                        <form method="POST" class="addEditform" action="member.php?page=edit&id=<?=$customer_id?>">
                          <div class="row">
                            <div class="form-group col-6">
                                <label for="exampleInputEmail1">Customer Name <span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="customer_name"  placeholder="Enter Name" value="<?=$data['customer_name']?>" required>
                            </div>

                            <div class="form-group col-6">
                                <label for="exampleInputEmail1">Customer Contact <span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="customer_contact" placeholder="Enter Contact Number" value="<?=$data['customer_contact']?>" required>
                            </div>
                          </div>

                          <div class="row">
                            <div class="form-group col-6">
                                <label for="exampleInputEmail1">Customer Email <span style="color:red">*</span></label>
                                <input type="text" class="form-control gmail edit" name="customer_email"  placeholder="Enter email" value="<?=$data['customer_email']?>" required>
                            </div>

                            <div class="form-group col-6">
                                <label for="exampleInputEmail1">Customer Plan <span style="color:red">*</span></label>
                                <select  class="form-control" name="customer_plan" required>
                                  <?php
                                  $sql2="SELECT * FROM plan WHERE  plan_delete_date IS NULL or plan_delete_date='0000-00-00 00:00:00'";
                                  $query2=$mysqli->query($sql2);
                                  $options="<option value='' disabled>Please choose A plan</option>
                                            <option value='No Active Plan' ".($data['customer_plan']=='No Active Plan'?"selected":"").">No Active Plan</option>";
                                  
                                  if($query2->num_rows>0){
                                    while($row=$query2->fetch_assoc()){
                                      $options.="<option value='".$row['plan_name']."'".($data['customer_plan']==$row['plan_name']?'selected':'').">".$row['plan_name']."</option>";
                                    }
                                  }
                                  echo $options;
                                  ?>
                                </select>
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group col-6">
                                <label for="exampleInputEmail1">Customer Username <span style="color:red">*</span></label>
                                <input type="text" class="form-control username edit" name="customer_username" placeholder="Enter Username" value="<?=$data['customer_username']?>" required>
                            </div>

                            <div class="form-group col-6">
                                <label for="exampleInputEmail1">Customer Password (Minumum 7 digit)</label>
                                <input type="password" class="form-control" name="customer_password" placeholder="Enter Password (Default will be Original Password)">
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group col-12">
                                <label for="exampleInputEmail1">Customer Address <span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="customer_address" placeholder="Enter Addres" value="<?=$data['customer_address']?>" required>
                            </div>
                            <input type="hidden" name="hide" value="1">
                            <input type="hidden" name="id" value="<?=$customer_id?>">
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