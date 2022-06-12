<?php 
include '../connect.php';
session_start();
if(!isset($_SESSION['valid'])) {
	header('Location: users/login.php');
}
$level_admin = $_SESSION['level_admin'];
if($level_admin == 0){
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Users Management</title>
    
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
                    <li><a href="application.php"><i class="mdi mdi-table"></i><span class="nav-text">Application Management</span></a></li>
                    <?php if($level_admin == 1){ ?>
                    <li><a href="users.php"><i class="mdi mdi-account"></i><span class="nav-text">Users Management</span></a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>

        <div class="content-body">
            <div class="container">
                <div class="row" id="add-users">
                    <div class="col-xl-12 col-xxl-12">
                        <div class="card">
                            <div class="card-header">                                
                                <h5 class="card-title">Users Management</b></h5>
                            </div>
                            <div class="card-body">
                                <?php
                                    if(isset($_REQUEST['submit'])){
                                        extract($_REQUEST);
                                        if($obj->userAdd($name,$username,$email,$password,$level_admin)){
                                ?>
                                <div class="alert alert-success solid alert-dismissible fade show">
                                    <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                    </button>
                                    <strong>Successfully</strong> added <?php echo $username; ?> to database!
                                </div>
                                <?php
                                        }
                                        else{
                                ?>
                                <div class="alert alert-danger solid alert-dismissible fade show">
                                    <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                    </button>
                                    <strong>Cannot</strong> added users! please check the input and try again.
                                </div>
                                <?php
                                        }
                                    }
                                ?>
                                <div id="accordion-nine" class="accordion accordion-active-header">
                                    <div class="accordion__item">
                                        <center><div class="accordion__header collapsed col-md-3" data-toggle="collapse" data-target="#active-header_collapseTwo" aria-expanded="true" aria-controls="active-header_collapseTwo">
                                            <span class="accordion__header--icon"></span>
                                            <span class="accordion__header--text">Add Users</span>
                                            <span class="accordion__header--indicator"></span>
                                        </div></center>
                                        <div id="active-header_collapseTwo" class="collapse accordion__body" data-parent="#accordion-nine">
                                            <div class="accordion__body--text">
                                                <div class="basic-form">
                                                    <form action="users.php" method="post" enctype="multipart/form-data">
                                                        <div class="form-row">
                                                            <div class="form-group col-md-12">
                                                                <label>Full Name</label>
                                                                <input type="text" class="form-control" name="name" value="" required>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label>Username</label>
                                                                <input type="text" class="form-control" name="username" value="" required>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label>Email</label>
                                                                <input type="email" class="form-control" name="email" value="" required>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label>Password</label>
                                                                <input type="password" class="form-control" name="password" value="" required>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="mr-sm-3 info">Level Users</label>
                                                                <select class="custom-select mr-sm-3" name="level_admin" id="inlineFormCustomSelect" required>
                                                                    <option value="" selected="true" disabled="disabled">- Selected Level -</option>
                                                                    <option value="0">Karyawan</option>
                                                                    <option value="1">Admin</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <input type="submit" name="submit" value="Add Users" class="btn btn-success btn-lg float-right">
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="users-list">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Users List</h4>
                            </div>
                            <div class="card-body">
                                <?php
                                    if(isset($_REQUEST['delete_id'])){
                                        if($obj->Delete($_REQUEST['delete_id'],"users")){
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
                                                <th scope="col">No.</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Username</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Level User</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $rows=$obj->showAll("users");
                                            $no = 1;
                                            foreach($rows as $info){
                                                extract($info);
                                        ?>
                                            <tr>
                                                <td><?php echo $no; $no++; ?></td>
                                                <td><?php echo $name; ?></td>
                                                <td><?php echo $username; ?></td>
                                                <td><?php echo $email; ?></td>
                                                <td><?php if($level_admin=='1'){echo 'Admin';}else{echo 'Karyawan';} ?></td>
                                                <td><div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-rounded btn-outline-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="usersedit.php?usersedit_id=<?php echo $id;?>">Edit</a>
                                                            <a class="dropdown-item" onClick="return confirm('Do you want to delete?');" href="users.php?delete_id=<?php echo $id;?>">Delete</a>
                                                        </div>
                                                    </div>
                                                </td>
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

    <script type="text/javascript">
        document.getElementById('users-add').classList.add("hidden");
    </script>
</body>
</html>