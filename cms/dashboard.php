<?php
include "Config/cms-config.php";
include "Config/session.php";
$Maintab="dashboard";


if(isset($_GET['login'])){
    $user=$_SESSION['user_name'];
    $more_script.=<<<EOF
    toast.success("Welcome back $user","Login Successful");
    EOF;
}

include "Requires/header.php";
include "Requires/top.php";

//get payment number
$countpayment=0;
$payment=$mysqli->query("SELECT count(*) as num FROM $table_payment where 
                        payment_status IN ('Paid','Pending')");

if($payment->num_rows>0){
    $payment=$payment->fetch_assoc();
    $countpayment=$payment['num'];
}

//get user number
$countuser=0;
$user=$mysqli->query("SELECT count(*) as num FROM $table_customer where 
                        customer_delete_date = '0000-00-00 00:00:00'");

if($user->num_rows>0){
    $user=$user->fetch_assoc();
    $countuser=$user['num'];
}

$totalEarn=0;
$payment=$mysqli->query("SELECT sum(payment_amount) as num FROM $table_payment where 
                        payment_status IN ('Paid')");

if($payment->num_rows>0){
    $payment=$payment->fetch_assoc();
    $totalEarn=$payment['num'];
}

$totalClass=0;
$class=$mysqli->query("SELECT count(*) as num FROM $table_class where 
                        class_delete_date = '0000-00-00 00:00:00'");

if($class->num_rows>0){
    $class=$class->fetch_assoc();
    $totalClass=$class['num'];
}

?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Dashboard</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Members</li>
                </ol>
            </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?=$countpayment?></h3>
                        <p>Total Order</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                      
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>RM <?=$totalEarn?></h3>
                        <p>Total Sale</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                    <h3><?=$countuser?></h3>
                    <p>Total Users</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
 
                </div>
            </div>


            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3><?=$totalClass?></h3>
                        <p>Total Class</p>
                    </div>
                    <div class="icon">
                    <i class="fa fa-users" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
</div>
<?php

include "Requires/footer.php";
?>
