<div class="nav-header">
    <a href="index.php" class="brand-logo">
        <span class="logo-abbr">Q</span>
        <span class="logo-compact">Admin</span>
        <span class="brand-title">Admin</span>
    </a>
    <div class="nav-control">
        <div class="hamburger">
            <span class="toggle-icon"><i class="icon-menu"></i></span>
        </div>
    </div>
</div>

<div class="header"> 
    <div class="header-content">
        <nav class="navbar navbar-expand">
            <div class="collapse navbar-collapse justify-content-between">
                <div class="header-left">
                </div>
                <ul class="navbar-nav header-right">
                    <li class="nav-item dropdown notification_dropdown">
                    </li>
                    <li class="nav-item dropdown header-profile">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-account"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="./users/logout.php" class="dropdown-item">
                                <span>Logout</span>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>

<div class="quixnav">           
    <div class="quixnav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label">Navigation</li>
            <li><a href="index.php"><i class="mdi mdi-home"></i><span class="nav-text">Home</span></a></li>
            <li><a href="application.php"><i class="mdi mdi-table"></i><span class="nav-text">Application Management</span></a></li>
            <?php if($level_admins == 1){ ?>
            <li><a href="users.php"><i class="mdi mdi-account"></i><span class="nav-text">Users Management</span></a></li>
            <?php } ?>
            <li><a href="jobs.php"><i class="mdi mdi-account-convert"></i><span class="nav-text">Jobs Management</span></a></li>
        </ul>
    </div>
</div>