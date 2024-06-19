<?php
include "Config/cms-config.php";
include "Config/session.php";
$Maintab = "dashboard";



include "Requires/header.php";
include "Requires/top.php";

if(isset($_GET['login'])){
    $user=$_SESSION['trainer_name'];
    $more_script.=<<<EOF
    toast.success("Welcome back $user","Login Successful");
    EOF;
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
        <div class="card">
	        <div class="card-header">
	          <h3 class="card-title"></h3>

	          <div class="card-tools">
	            
	          </div>
	        </div>
	        <div class="card-body">
	        	<h2 style="text-align:center;">Welcome to Gymkhana System</h2>
	            <p>If you need help getting started, check out to our user manual. If you need help, call us at <a href="tel:+60182675148">+6018 267 5148</a> or email us <a href="mailto:1211201053@student.mmu.edu.my">1211201053@student.mmu.edu.my</a> to get information on how to use your current screen and where to go for more assistance.</p>
	        </div>
	    </div>


        
    </section>
</div>
<?php

include "Requires/footer.php";
?>