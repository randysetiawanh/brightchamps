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

if(isset($_REQUEST['submit'])){
	extract($_REQUEST);
	if($obj->userUpdate($hidden_id,$name,$username,$email,$password,$level_admin,"users")){
        echo '<script>alert("Users successfully updated.")</script>';
		header('Refresh: 0.1; URL=users.php');
	}
	else{
		echo "Cannot Updated!";	
	}
}

if(isset($_REQUEST['usersedit_id'])){
    extract($obj->editValue($_REQUEST['usersedit_id'],"users"));
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
                                <h5 class="card-title">Users Edit</b></h5>
                            </div>
                            <div class="card-body">
                                <?php
                                    if(isset($_REQUEST['submit'])){
                                        extract($_REQUEST);
                                        if($obj->userUpdate($name,$username,$email,$password,$level_admin)){
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
                                <div class="basic-form">
                                    <form action="usersedit.php" method="post" enctype="multipart/form-data">
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label>Full Name</label>
                                                <input type="text" class="form-control" name="name" value="<?php echo $name; ?>" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Username</label>
                                                <input type="text" class="form-control" name="username" value="<?php echo $username; ?>" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Email</label>
                                                <input type="email" class="form-control" name="email" value="<?php echo $email; ?>" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Password</label>
                                                <input type="password" class="form-control" name="password" value="" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="mr-sm-3 info">Level Users</label>
                                                <select class="custom-select mr-sm-3" name="level_admin" id="inlineFormCustomSelect" required>
                                                    <option value="" disabled="disabled">- Selected Level -</option>
                                                    <option value="0">Karyawan</option>
                                                    <option value="1" <?php if($level_admin=='1'){ echo 'selected="true"';} ?>>Admin</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <input type="hidden" name="hidden_id" value="<?php echo $id; ?>" />
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