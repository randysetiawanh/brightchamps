<?php 
session_start();
if(!isset($_SESSION['valid'])) {
	header('Location: users/login.php');
}
include '../connect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Admin BrightChamps</title>

    <link rel="icon" type="image/png" sizes="16x16" href="./assets/images/favicon.png">

    <link rel="stylesheet" href="./assets/css/style.css">
    
</head>

<body>
    <div id="preloader"><div class="spinner"><div class="spinner-a"></div><div class="spinner-b"></div></div></div>

    <div id="main-wrapper">
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
                    </div>
                </nav>
            </div>
        </div>
        
        <div class="quixnav">           
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label">Navigation</li>
                    <li><a href="index.php"><i class="mdi mdi-home"></i><span class="nav-text">Home</span></a></li>
                    <li><a href="application.php"><i class="mdi mdi-table"></i><span class="nav-text">Application List</span></a></li>
                </ul>
            </div>
        </div>
        
        <div class="content-body">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card" id="user-activity">
                            <?php
                                $job_list=$obj->showAll("job_list");
                                $job_category=$obj->showAll("job_category");
                                $job_application=$obj->showAll("job_application");
                                $users=$obj->showAll("users");
                                $count_list = 0;
                                $count_category = 0;
                                $count_application = 0;
                                $count_users = 0;

                                foreach($job_list as $job_list){ $count_list = $count_list + 1; }
                                foreach($job_category as $job_category){ $count_category = $count_category + 1; }
                                foreach($job_application as $job_application){ $count_application = $count_application + 1; }
                                foreach($users as $users){ $count_users = $count_users + 1; }
                            ?>
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#user" role="tab" aria-controls="" aria-selected="true">
                                        <div class="icon-wrap info">
                                            <i class="mdi mdi-format-list-bulleted-type"></i>
                                        </div>                                        
                                        <h4><?php echo $count_list; ?></h4>
                                        <span class="type-name">Job List</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#session" role="tab" aria-controls="" aria-selected="false">
                                        <div class="icon-wrap success">
                                            <i class="mdi mdi-shape"></i>
                                        </div>
                                        <h4><?php echo $count_category; ?></h4>
                                        <span class="type-name">Job Category</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#bounce" role="tab" aria-controls="" aria-selected="false">
                                        <div class="icon-wrap danger">
                                            <i class="mdi mdi-application"></i>
                                        </div>
                                        <h4><?php echo $count_application; ?></h4>
                                        <span class="type-name">Application List</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#session-duration" role="tab" aria-controls="" aria-selected="false">
                                        <div class="icon-wrap primary">
                                            <i class="mdi mdi-account-group"></i>
                                        </div>
                                        <h4><?php echo $count_users; ?></h4>
                                        <span class="type-name">Users</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-xxl-6 col-lg-6 col-sm-6">
                        <div class="card">
                            <div class="card-header">                                
                                <h5 class="card-title">Welcome! <b><?php echo $_SESSION['name'];?></b></h5>
                            </div>
                            <!-- <div class="card-body">
                                <p class="card-text"></p>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="footer">
            <div class="copyright">
                <p>Copyright © Designed &amp; Developed by <a href="https://themeforest.net/user/quixlab" target="_blank">Quixlab</a> 2019</p>
            </div>
        </div>
    </div>
    
    <!-- Required vendors -->
    <script src="./assets/vendor/jquery/jquery.min.js"></script>
    <script src="./assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- Here is navigation script -->
    <script src="./assets/vendor/quixnav/quixnav.min.js"></script>
    <script src="./assets/js/quixnav-init.js"></script>
    <script src="./assets/js/custom.min.js"></script>
    <!-- Demo scripts -->
    <script src="./assets/js/styleSwitcher.js"></script>

</body>
</html>