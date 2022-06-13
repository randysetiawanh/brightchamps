<?php 
include '../connect.php';
session_start();
if(!isset($_SESSION['valid'])) {
	header('Location: users/login.php');
}
$level_admins = $_SESSION['level_admin'];
?>
<?php
    $title = 'Dashboard';
    $addon_style = '#';
?>

<!DOCTYPE html>
<html lang="en">

<?php require_once('./snip-head.php'); ?>

<body>
    <div id="preloader"><div class="spinner"><div class="spinner-a"></div><div class="spinner-b"></div></div></div>
    <div id="main-wrapper">
        
        <?php require_once('./snip-header.php'); ?>
        
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
                                <h5 class="card-title">Welcome! <b><?php echo $_SESSION['name']; ?></b></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <?php require_once('./snip-footer.php'); ?>
    </div>

    <?php require_once('./snip-scripts.php'); ?>

</body>
</html>