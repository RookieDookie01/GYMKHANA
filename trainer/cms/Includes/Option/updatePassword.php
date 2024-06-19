<?php
if (isset($_POST['submit_btn'])) {
    $update=false;
    $currentPassword = md5($_POST['current_password']);
    $newPassword = escapeString($_POST['new_password']);
    $confirmPassword = escapeString($_POST['confirm_new_password']);

    if ($newPassword === $confirmPassword) {
        $trainerID = $_SESSION['trainer_id'];
        $passwordQuery = "SELECT trainer_password FROM trainer WHERE trainer_id = $trainerID";
        $passwordResult = $mysqli->query($passwordQuery);

        if ($passwordResult) {
            $row = $passwordResult->fetch_assoc();
            $currentDBPassword = $row['trainer_password'];

            if ($currentPassword === $currentDBPassword) {
                // Hash the new password with MD5
                $hashedPassword = md5($newPassword);

                $updateQuery = "UPDATE trainer SET trainer_password = '$hashedPassword' WHERE trainer_id = $trainerID";
                $updateResult = $mysqli->query($updateQuery);

                if ($updateResult) {
                    $update=true;
                }
            }
        } 
    }
    if($update){
        echo '<script>window.location.href = "option.php?page=updatePassword&success=true";</script>';
        exit;
       }else{
        echo '<script>window.location.href = "option.php?page=updatePassword&success=false";</script>';
        exit;
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


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
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
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="option.php?page=updatePassword" method="post">
                                <div class="card card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">Update Password</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Current Password</label>
                                            <div class="col-sm-10">
                                                <input name="current_password" type="password" class="form-control"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">New Password</label>
                                            <div class="col-sm-10">
                                                <input name="new_password" type="password" class="form-control"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Confirm New Password</label>
                                            <div class="col-sm-10">
                                                <input name="confirm_new_password" type="password" class="form-control"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" name="submit_btn" class="btn btn-info">Update
                                            Password</button>
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