<?php
$sql = "SELECT * FROM trainer WHERE trainer_id = ".$_SESSION['trainer_id'];
$TrainerQuery = $mysqli->query($sql);
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
                
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="">Home</a></li>
            <li class="breadcrumb-item active">View Profile</li>
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
              <h1>My Profile</h1>
              <?php
              if ($TrainerQuery->num_rows > 0) {
                while ($row = $TrainerQuery->fetch_assoc()) {
                  echo '<form action="option.php?page=updateTrainer" method="post">

                  <div class="row">
                    <div class="form-group col-12">
                        <div class="text-left">
                          <img class="profile-user-img" src="'.($row['trainer_image']!=''?$row['trainer_image']:"Dist/img/user.jpg").'" alt="Trainer Image">
                        </div>
                    </div>
                  </div>

                  <div class="row">
                      <div class="form-group col-6">
                          <label for="exampleInputEmail1">Trainer Name</label>
                          <p>' . $row['trainer_name'] . '</p>
                      </div>
                      <div class="form-group col-6">
                          <label for="exampleInputEmail1">Trainer Email</label>
                          <p>' . $row['trainer_email'] . '</p>
                      </div>
                  </div>
      
                  <div class="row">
                      <div class="form-group col-6">
                          <label for="exampleInputEmail1">Trainer Contact</label>
                          <p>' . $row['trainer_contact'] . '</p>
                      </div>
                      <div class="form-group col-6">
                          <label for="exampleInputEmail1">Trainer Address</label>
                          <p>' . $row['trainer_address'] . '</p>
                      </div>
                  </div>
      
                  <div class="row">
                      <div class="form-group col-6">
                          <label for="exampleInputEmail1">Trainer Info</label>
                          <p>' . $row['trainer_info'] . '</p>
                      </div>
                      <div class="form-group col-6">
                          <label for="exampleInputEmail1">Trainer Age</label>
                          <p>' . $row['trainer_age'] . '</p>
                      </div>
                  </div>
      
                  <div class="row">
                      <div class="form-group col-6">
                          <label for="exampleInputEmail1">Trainer Height</label>
                          <p>' . $row['trainer_height'] . '</p>
                      </div>
                      <div class="form-group col-6">
                          <label for="exampleInputEmail1">Trainer Weight</label>
                          <p>' . $row['trainer_weight'] . '</p>
                      </div>
                  </div>
      
                  <div class="row">
                      <div class="col-12">
                          <a href="option.php?page=updateTrainer" class="btn btn-primary float-right">Update Profile</a>
                      </div>
                  </div>
      
                  <input type="hidden" name="hide" value="1">
              </form>';

                }
              }
              ?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>