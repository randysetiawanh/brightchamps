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
?>
<?php
    $title = 'Users Management';
    $addon_style = './assets/vendor/datatables/css/jquery.dataTables.min.css';
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
        
        <?php require_once('./snip-footer.php'); ?>
    </div>

    <?php require_once('./snip-scripts.php'); ?>
    
    <!-- Datatable -->
    <script src="./assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="./assets/js/plugins-init/datatables.init.js"></script>

</body>
</html>