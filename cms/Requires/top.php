<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>
      
      <li class="nav-item">
      <a href="Requires/logout.php" class="btn btn-block btn-primary">Log Out</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard.php" class="brand-link text-center">
      <img src="upload/toothless.gif" alt="AdminLTE Logo" class="brand-image" style="float:none;opacity: .8;max-height:70px;">
      <span class="brand-text font-weight-light d-block">GYMKHANA</span>
    </a>

   <!-- Sidebar -->
   <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="upload/rock.gif" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="dashboard.php" class="d-block"><?=$_SESSION['user_name']?></a>
        </div>
      </div>

      

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="dashboard.php" class="nav-link <?=($Maintab=="dashboard"?"active":"")?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>


          <?php 
          if($permission || $_SESSION['user_id']=='1'){?>
          <li class="nav-item <?=($Maintab=="member"?"menu-open":"")?>">
            <a href="#" class="nav-link <?=($Maintab=="member"?"active":"")?>">
            <i class="nav-icon fa fa-user" aria-hidden="true"></i>
              <p>
                Member
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="member.php" class="nav-link  <?=($Subtab=="member_all"?"active":"")?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Member</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="member.php?page=activity" class="nav-link  <?=($Subtab=="member_activity"?"active":"")?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Member's Activity</p>
                </a>
              </li>
            </ul>
          </li>
          <?php }
          if($permission || $_SESSION['user_id']=='1'){?>
          <li class="nav-item <?=($Maintab=="trainer"?"menu-open":"")?>">
            <a href="#" class="nav-link <?=($Maintab=="trainer"?"active":"")?>">
              <i class="nav-icon fa fa-user" style="color:#17a2b8"></i>
              <p>
                Trainer
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
              <li class="nav-item">
                <a href="trainer.php" class="nav-link <?=($Subtab=="trainer_all"?"active":"")?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Trainer</p>
                </a>
              </li>
            </ul>
          </li>
          <?php }
          if($permission || $_SESSION['user_id']=='1'){?>
          <li class="nav-item <?=($Maintab=="admin"?"menu-open":"")?>">
            <a href="#" class="nav-link <?=($Maintab=="admin"?"active":"")?>">
              <i class="nav-icon fa fa-user" style="color:#dc3545"></i>
              <p>
                Admin
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
              <li class="nav-item">
                <a href="admin.php" class="nav-link <?=($Subtab=="admin_all"?"active":"")?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Admin</p>
                </a>
              </li>
            </ul>
          </li>
          <?php }
          if($permission || $_SESSION['user_id']=='1'){?>
          <li class="nav-item <?=($Maintab=="class"?"menu-open":"")?>">
            <a href="#" class="nav-link <?=($Maintab=="class"?"active":"")?>">
            <i class="fa fa-users nav-icon" aria-hidden="true"></i>
              <p>
               Class
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
              <li class="nav-item">
                <a href="class.php" class="nav-link <?=($Subtab=="class_all"?"active":"")?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Classes</p>
                </a>
              </li>
            </ul>
          </li>
          <?php }
          if($permission || $_SESSION['user_id']=='1'){?>
          <li class="nav-item <?=($Maintab=="activity"?"menu-open":"")?>">
            <a href="#" class="nav-link <?=($Maintab=="activity"?"active":"")?>">
            <i class="fa fa-book nav-icon" aria-hidden="true"></i>
              <p>
              Activity
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
              <li class="nav-item">
                <a href="activity.php" class="nav-link <?=($Subtab=="activity_all"?"active":"")?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Activities</p>
                </a>
              </li>
            </ul>
          </li>
          <?php }


            ////////////////////////////finance admin paginator/////////////////////////////////
          

          if(!$permission || $_SESSION['user_id']=='1'){?>
          <li class="nav-item <?=($Maintab=="plan"?"menu-open":"")?>">
            <a href="#" class="nav-link <?=($Maintab=="plan"?"active":"")?>">
            <i class="fa fa-tasks nav-icon" aria-hidden="true"></i>
              <p>
              Plan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
              <li class="nav-item">
                <a href="plan.php" class="nav-link <?=($Subtab=="plan_all"?"active":"")?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Plan</p>
                </a>
              </li>
            </ul>
          </li>
          <?php }
          if(!$permission || $_SESSION['user_id']=='1'){?>
            <li class="nav-item <?=($Maintab=="payment"?"menu-open":"")?>">
              <a href="#" class="nav-link <?=($Maintab=="payment"?"active":"")?>">
              <i class="fa fa-credit-card nav-icon" aria-hidden="true"></i>
                <p>
                Payment
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                
                <li class="nav-item">
                  <a href="payment.php" class="nav-link <?=($Subtab=="payment_all"?"active":"")?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>All Payment</p>
                  </a>
                </li>
              </ul>
            </li>
          <?php }
          if(!$permission || $_SESSION['user_id']=='1'){?>
            <li class="nav-item <?=($Maintab=="comment"?"menu-open":"")?>">
              <a href="#" class="nav-link <?=($Maintab=="comment"?"active":"")?>">
              <i class="fa fa-comment nav-icon" aria-hidden="true"></i>
                <p>
                Customer Comment
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                
                <li class="nav-item">
                  <a href="comment.php" class="nav-link <?=($Subtab=="comment_all"?"active":"")?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>All Comment</p>
                  </a>
                </li>
              </ul>
            </li>
          <?php }
          // commen thing?>
         
            <li class="nav-item <?=($Maintab=="option"?"menu-open":"")?>">
              <a href="#" class="nav-link <?=($Maintab=="option"?"active":"")?>">
              <i class="fa fa-cog nav-icon" aria-hidden="true"></i>
                <p>
                Options
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                
                <li class="nav-item">
                  <a href="option.php?page=changePassword" class="nav-link <?=($Subtab=="change_password"?"active":"")?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Update Password</p>
                  </a>
                </li>
              </ul>
            </li>

          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>