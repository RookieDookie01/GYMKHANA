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
      <a href="dashboard.php" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
          style="opacity: .8">
        <span class="brand-text font-weight-light">GYMKHANA</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="http://localhost/GYMKHANA/cms/Upload/doge.gif" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="dashboard.php" class="d-block">
              <?= $_SESSION['trainer_name'] ?>
            </a>
          </div>
        </div>

        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="dashboard.php" class="nav-link <?= ($Maintab == "dashboard" ? "active" : "") ?>">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>

            <li class="nav-item <?= ($Maintab == "profile" ? "menu-open" : "") ?>">
              <a href="#" class="nav-link <?= ($Maintab == "profile" ? "active" : "") ?>">
                <i class="nav-icon fa fa-user" aria-hidden="true"></i>
                <p>
                  MyTrainer
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>

              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="profile.php?page=viewProfile"
                    class="nav-link <?= ($Subtab == "viewProfile" ? "active" : "") ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Manage Profile</p>
                  </a>
                </li>
              </ul>

              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="profile.php?page=viewTimetable"
                    class="nav-link <?= ($Subtab == "viewTimetable" ? "active" : "") ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Manage Class</p>
                  </a>
                </li>
              </ul>

              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="profile.php?page=viewMembers"
                    class="nav-link <?= ($Subtab == "viewMembers" ? "active" : "") ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Manage Student</p>
                  </a>
                </li>
              </ul>

            </li>

            <li class="nav-item <?= ($Maintab == "option" ? "menu-open" : "") ?>">
              <a href="#" class="nav-link <?= ($Maintab == "option" ? "active" : "") ?>">
                <i class="fa fa-cog nav-icon" aria-hidden="true"></i>
                <p>
                  Options
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>

              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="option.php?page=updateTrainer"
                    class="nav-link <?= ($Subtab == "updateTrainer" ? "active" : "") ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Update Profile</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="option.php?page=updatePassword"
                    class="nav-link <?= ($Subtab == "updatePassword" ? "active" : "") ?>">
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