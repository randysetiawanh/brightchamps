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
    <title>Application List</title>
    
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/images/favicon.png">

    <link href="./assets/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="./assets/css/style.css" rel="stylesheet">
    
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
                        <div class="header-left">
                            <div class="search_bar dropdown">
                                <span class="search_icon d-md-none p-36 c-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-search"></i>
                                </span>
                                <div class="dropdown-menu p-0 m-0">
                                    <form class="form-inline">
                                        <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                                    </form>
                                </div>
                            </div>
                        </div>
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
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Application List</h4>
                            </div>
                            <div class="card-body">
                                <?php
                                    if(isset($_REQUEST['delete_id'])){
                                        if($obj->Delete($_REQUEST['delete_id'],"job_application")){
                                ?>
                                <div class="alert alert-success solid alert-dismissible fade show">
                                    <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                    </button>
                                    <strong>Successfully</strong> Deleted!
                                </div>
                                <?php
                                        }
                                        else{
                                ?>
                                <div class="alert alert-danger solid alert-dismissible fade show">
                                    <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                    </button>
                                    <strong>Cannot</strong> Deleted!
                                </div>
                                <?php
                                        }
                                    }
                                ?>
                                
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th scope="col">Date</th>
                                                <th scope="col">Action</th>
                                                <th scope="col">Job title</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">City</th>
                                                <th scope="col">Gender</th>
                                                <th scope="col">Resume</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $rows=$obj->showAll("job_application");
                                            foreach($rows as $info){
                                                extract($info);
                                                if ($status == 'Accepted'){ $classBtn = 'success'; }
                                                else if($status == 'Rejected') { $classBtn = 'danger'; }
                                                else { $classBtn = 'primary'; }
                                        ?>
                                            <tr>
                                                <td><?php $dt = new DateTime($created); echo $dt->format('d/m/Y'); ?></td>
                                                <td><div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-rounded btn-outline-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                                        <div class="dropdown-menu">
                                                            <?php if($status == 'Pending'){ ?><a class="dropdown-item" href="review.php?review_id=<?php echo $id;?>">Review</a><?php } ?>
                                                            <?php if($status == 'Rejected'){ ?><a class="dropdown-item" href="review.php?review_id=<?php echo $id;?>">Review Again</a><?php } ?>
                                                            <a class="dropdown-item" onClick="return confirm('Do you want to delete?');" href="application.php?delete_id=<?php echo $id;?>">Delete</a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><?php echo $job_title; ?></td>
                                                <td><span class="badge badge-rounded badge-<?php echo $classBtn ?>"><?php echo $status; ?></span></td>
                                                <td><?php echo $first_name; ?> <?php echo $last_name; ?></td>
                                                <td><?php echo $email; ?></td>
                                                <td><?php echo $city_list; ?></td>
                                                <td><?php echo $gender; ?></td>
                                                <td><a target="_blank" href="uploads/<?php echo $resume; ?>">View</a></td>
                                            </tr>
                                        <?php
                                            }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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
    
    <!-- Datatable -->
    <script src="./assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="./assets/js/plugins-init/datatables.init.js"></script>

</body>
</html>