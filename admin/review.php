<?php
include '../connect.php';
session_start();
if(!isset($_SESSION['valid'])) {
	header('Location: users/login.php');
}

if(isset($_REQUEST['review_id'])){
    extract($obj->editValue($_REQUEST['review_id'],"job_application"));
    if($status == 'Accepted'){
        echo "<script>alert('Status Job is already accepted! Please select another application.');</script>";
        header('Refresh: 0.1; URL=application.php');
    }
}
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
                <!-- row -->
                <div class="row">
                    <div class="col-xl-12 col-xxl-6 col-lg-6 col-sm-6">
                        <div class="alert alert-danger solid alert-dismissible fade show">
                            <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                            </button>
                            <strong>Warning!</strong> Only change data for Job Status.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-xxl-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Candidate Information</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form action="review-done.php" method="post" enctype="multipart/form-data">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>First Name</label>
                                            <input type="text" class="form-control" name="first_name" value="<?php echo $first_name; ?>" readonly>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Last Name</label>
                                            <input type="text" class="form-control" name="last_name" value="<?php echo $last_name; ?>" readonly>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email" value="<?php echo $email; ?>" readonly>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Phone</label>
                                            <input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>" readonly>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Address</label>
                                            <input type="text" class="form-control" name="address" value="<?php echo $address; ?>" readonly>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>City</label>
                                            <input type="text" class="form-control" name="city_list" value="<?php echo $city_list; ?>" readonly>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Country</label>
                                            <input type="text" class="form-control" name="country_list" value="<?php echo $country_list; ?>" readonly>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Gender</label>
                                            <input type="text" class="form-control" name="gender" value="<?php echo $gender; ?>" readonly>
                                        </div>
                                        <div class="form-group col-md-9">
                                            <label>Additional Info</label>
                                            <input type="text" class="form-control" name="add_info" value="<?php if($add_info == NULL){ echo '-'; }else{ echo $add_info; } ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-2">
                                            <label>Resume</label><br>
                                            <a name="file_upload" href="../uploads/<?php echo $resume; ?>" class="btn btn-outline-info"> View </a><span> <?php echo $resume; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-xxl-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Job Information</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <label>Job Position</label>
                                                <input type="text" class="form-control" name="job_title" value="<?php echo $job_title; ?>" readonly>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="mr-sm-3 info">Job Status</label>
                                                <select class="custom-select mr-sm-3" name="status" id="inlineFormCustomSelect" required>
                                                    <option value="" selected="true" disabled="disabled"><?php echo $status; ?></option>
                                                    <?php if($status=='Rejected'){ ?><option value="Accepted">Accepted</option><?php } ?>
                                                    <?php if($status=='Pending'){ ?><option value="Accepted">Accepted</option><option value="Rejected">Rejected</option><?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>Application Date</label>
                                                <input type="text" class="form-control" name="created" value="<?php $dt = new DateTime($created); echo $dt->format('d/m/Y'); ?>" readonly>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <input type="hidden" name="hidden_id" value="<?php echo $id; ?>" />
                                                <input type="submit" name="submit" onClick="return confirm('Do you want to update data?');" value="Update Data" class="btn btn-success btn-lg float-right">
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

</body>
</html>
