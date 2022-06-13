<?php 
include '../connect.php';
session_start();

if(!isset($_SESSION['valid'])) {
	header('Location: users/login.php');
}

$level_admins = $_SESSION['level_admin'];
if($level_admins == 0){
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
<?php
    $title = 'Users Edit - '.$username.'';
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
                                                <label>New Password</label>
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
        
        <?php require_once('./snip-footer.php'); ?>
    </div>

    <?php require_once('./snip-scripts.php'); ?>
</body>
</html>