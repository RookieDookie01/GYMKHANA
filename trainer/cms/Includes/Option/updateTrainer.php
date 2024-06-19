<?php
$trainer_id = 1;
$sql = "SELECT * FROM trainer WHERE trainer_id = $trainer_id";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $trainer_name = $row['trainer_name'];
  $trainer_email = $row['trainer_email'];
  $trainer_contact = $row['trainer_contact'];
  $trainer_address = $row['trainer_address'];
  $trainer_info = $row['trainer_info'];
  $trainer_height = $row['trainer_height'];
  $trainer_weight = $row['trainer_weight'];
  $trainer_age = $row['trainer_age'];
  $trainer_image = $row['trainer_image'];
}

if (isset($_POST['update_btn'])) {
  $updated_fields = array();
  if (!empty($_POST['trainer_name'])) {
    $updated_fields[] = "trainer_name = '" . $_POST['trainer_name'] . "'";
  }
  if (!empty($_POST['trainer_email'])) {
    $updated_fields[] = "trainer_email = '" . $_POST['trainer_email'] . "'";
  }
  if (!empty($_POST['trainer_contact'])) {
    $updated_fields[] = "trainer_contact = '" . $_POST['trainer_contact'] . "'";
  }
  if (!empty($_POST['trainer_address'])) {
    $updated_fields[] = "trainer_address = '" . $_POST['trainer_address'] . "'";
  }
  if (!empty($_POST['trainer_info'])) {
    $updated_fields[] = "trainer_info = '" . $_POST['trainer_info'] . "'";
  }
  if (!empty($_POST['trainer_height'])) {
    $updated_fields[] = "trainer_height = '" . $_POST['trainer_height'] . "'";
  }
  if (!empty($_POST['trainer_weight'])) {
    $updated_fields[] = "trainer_weight = '" . $_POST['trainer_weight'] . "'";
  }
  if (!empty($_POST['trainer_age'])) {
    $updated_fields[] = "trainer_age = '" . $_POST['trainer_age'] . "'";
  }

  if (!empty($_FILES['trainer_image']['name'])) {
    $uploadDir = 'C:/xampp/htdocs/GYMKHANA/cms/Upload/';
    $fileName = $trainer_id . '-' . date('Ymd') . '-' . uniqid() . '.jpg';
    $targetFilePath = $uploadDir . $fileName;
    $fileType = strtolower(pathinfo($_FILES['trainer_image']['name'], PATHINFO_EXTENSION));

    $allowTypes = array('jpg', 'jpeg', 'png', 'gif');
    if (in_array($fileType, $allowTypes)) {
      if (move_uploaded_file($_FILES['trainer_image']['tmp_name'], $targetFilePath)) {
        $updated_fields[] = "trainer_image = '" .TRAINERIMGPATH.$fileName . "'";
      }
    }
  }
  
  $update_sql = "UPDATE trainer SET " . implode(", ", $updated_fields) . " WHERE trainer_id = $trainer_id";
  
  if ($mysqli->query($update_sql) === TRUE) {
    echo '<script>window.location.href = "option.php?page=updateTrainer&success=true";</script>';
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

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Self Profile</title>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            
            <div class="col-sm-6">
              <h1>Update Self Profile</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active">Change Password</li>
              </ol>
            </div>
          </div>
        </div>
      </section>
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <form action="option.php?page=updateTrainer" method="post" enctype="multipart/form-data">
                    <div class="row">
                      <div class="form-group col-6">
                        <label for="exampleInputEmail1">Trainer Name <span style="color:red">*</span></label>
                        <input type="text" class="form-control" name="trainer_name"
                          placeholder="<?php echo $trainer_name; ?>">
                      </div>
                      <div class="form-group col-6">
                        <label for="exampleInputEmail1">Trainer Email <span style="color:red">*</span></label>
                        <input type="text" class="form-control gmail" name="trainer_email"
                          placeholder="<?php echo $trainer_email; ?>">
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-6">
                        <label for="exampleInputEmail1">Trainer Contact <span style="color:red">*</span></label>
                        <input type="text" class="form-control" name="trainer_contact"
                          placeholder="<?php echo $trainer_contact; ?>">
                      </div>
                      <div class="form-group col-6">
                        <label for="exampleInputEmail1">Trainer Address <span style="color:red">*</span></label>
                        <input type="text" class="form-control" name="trainer_address"
                          placeholder="<?php echo $trainer_address; ?>">
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-12">
                        <label for="exampleInputEmail1">Trainer Info<span style="color:red">*</span></label>
                        <input type="text" class="form-control" name="trainer_info"
                          placeholder="<?php echo $trainer_info; ?>">
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-6">
                        <label for="exampleInputEmail1">Trainer Height <span style="color:red">*</span></label>
                        <input type="text" class="form-control" name="trainer_height"
                          placeholder="<?php echo $trainer_height; ?>">
                      </div>
                      <div class="form-group col-6">
                        <label for="exampleInputEmail1">Trainer Weight <span style="color:red">*</span></label>
                        <input type="text" class="form-control" name="trainer_weight"
                          placeholder="<?php echo $trainer_weight; ?>">
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-6">
                        <label for="exampleInputEmail1">Trainer Age <span style="color:red">*</span></label>
                        <input type="text" class="form-control" name="trainer_age"
                          placeholder="<?php echo $trainer_age; ?>">
                      </div>
                      <div class="form-group col-6">
                        <label for="exampleInputEmail1">Trainer Image <span style="color:red">*</span></label>
                        <input type="file" class="form-control" name="trainer_image">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-12">
                        <button type="submit" name="update_btn" class="btn btn-primary float-right">Submit</button>
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
  </div>
</body>

</html>