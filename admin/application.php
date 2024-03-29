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
    $title = 'Application Management';
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
                                    <table id="example" class="display" style="min-width: 1900px">
                                        <thead>
                                            <tr>
                                                <th width="80px" scope="col">Date</th>
                                                <th width="80px" scope="col">Action</th>
                                                <th width="200px" scope="col">Job title</th>
                                                <th width="70px" scope="col">Status</th>
                                                <th width="200px" scope="col">Name</th>
                                                <th width="300px" scope="col">Email</th>
                                                <th width="100px" scope="col">City</th>
                                                <th width="60px" scope="col">Gender</th>
                                                <th width="60px" scope="col">Resume</th>
                                                <th width="150px" scope="col">Meet Date</th>
                                                <th width="300px" scope="col">Meet Link</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $rows=$obj->showAllApplication("job_application");
                                            foreach($rows as $info){
                                                extract($info);
                                                if ($status == 'Accepted'){ $classBtn = 'success'; }
                                                else if($status == 'Rejected') { $classBtn = 'danger'; }
                                                else if($status == 'Interview') { $classBtn = 'warning'; }
                                                else { $classBtn = 'primary'; }
                                        ?>
                                            <tr>
                                                <td><?php $dt = new DateTime($created); echo $dt->format('d/m/Y'); ?></td>
                                                <td><div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-rounded btn-outline-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                                        <div class="dropdown-menu">
                                                            <?php if($status == 'Pending'){ ?><a class="dropdown-item" href="review.php?review_id=<?php echo $id;?>">Review</a><?php } ?>
                                                            <?php if($status == 'Rejected'){ ?><a class="dropdown-item" href="review.php?review_id=<?php echo $id;?>">Review Again</a><?php } ?>
                                                            <?php if($status == 'Interview'){ ?><a class="dropdown-item" href="review.php?review_id=<?php echo $id;?>">Review Again</a><?php } ?>
                                                            <a class="dropdown-item" onClick="return confirm('Do you want to delete?');" href="application.php?delete_id=<?php echo $id;?>">Delete</a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><?php echo $job_name; ?></td>
                                                <td><span class="badge badge-rounded badge-<?php echo $classBtn ?>"><?php echo $status; ?></span></td>
                                                <td><?php echo $first_name; ?> <?php echo $last_name; ?></td>
                                                <td><?php echo $email; ?></td>
                                                <td><?php echo $city_list; ?></td>
                                                <td><?php echo $gender; ?></td>
                                                <td><a target="_blank" href="../uploads/<?php echo $resume; ?>">View</a></td>
                                                <td><?php if($date_interview === NULL){echo '-';}else{$di = new DateTime($date_interview); echo $di->format('d/m/Y, h:i A');} ?></td>
                                                <td><a href="#"><?php if($meet_interview === NULL){echo '-';}else{echo $meet_interview;} ?></a></td>
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