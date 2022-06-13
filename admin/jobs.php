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
    $title = 'Jobs Management';
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
                                <h5 class="card-title">Jobs Management</b></h5>
                            </div>
                            <div class="card-body">
                                <?php
                                    if(isset($_REQUEST['submit'])){
                                        extract($_REQUEST);
                                        if($_REQUEST['submit'] == 'Add Category'){
                                            $obj->jobsCategoryAdd($category)
                                ?>
                                <div class="alert alert-success solid alert-dismissible fade show">
                                    <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                    </button>
                                    <strong>Successfully</strong> added <?php echo $category; ?> to database!
                                </div>
                                <?php
                                ?>
                                <?php
                                        }else if($obj->jobsListAdd($job_name,$job_category)){
                                ?>
                                <div class="alert alert-success solid alert-dismissible fade show">
                                    <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                    </button>
                                    <strong>Successfully</strong> added <?php echo $job_name; ?> to database!
                                </div>
                                <?php
                                        }else{
                                ?>
                                <div class="alert alert-danger solid alert-dismissible fade show">
                                    <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                    </button>
                                    <strong>Cannot</strong> added category! please check the input and try again.
                                </div>
                                <?php
                                        }
                                    }
                                ?>
                                <div id="accordion-nine" class="accordion accordion-active-header">
                                    <div class="accordion__item">
                                        <center><div class="accordion__header collapsed col-md-3" data-toggle="collapse" data-target="#active-header_collapseTwo" aria-expanded="true" aria-controls="active-header_collapseTwo">
                                            <span class="accordion__header--icon"></span>
                                            <span class="accordion__header--text">Add Job Category</span>
                                            <span class="accordion__header--indicator"></span>
                                        </div></center>
                                        <div id="active-header_collapseTwo" class="collapse accordion__body" data-parent="#accordion-nine">
                                            <div class="accordion__body--text">
                                                <div class="basic-form">
                                                    <form action="jobs.php" method="post" enctype="multipart/form-data">
                                                        <div class="form-row">
                                                            <div class="form-group col-md-1"></div>
                                                            <div class="form-group col-md-10">
                                                                <label>Category</label>
                                                                <input type="text" class="form-control" name="category" placeholder="Sales Admin" value="" required>
                                                            </div>
                                                            <div class="form-group col-md-1"></div>
                                                            <div class="form-group col-md-1"></div>
                                                            <div class="form-group col-md-10">
                                                                <input type="submit" name="submit" value="Add Category" class="btn btn-success btn-lg float-right">
                                                            </div>
                                                            <div class="form-group col-md-1"></div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion__item">
                                        <center><div class="accordion__header collapsed col-md-3" data-toggle="collapse" data-target="#active-header_collapseThree" aria-expanded="true" aria-controls="active-header_collapseThree">
                                            <span class="accordion__header--icon"></span>
                                            <span class="accordion__header--text">Add Job Position</span>
                                            <span class="accordion__header--indicator"></span>
                                        </div></center>
                                        <div id="active-header_collapseThree" class="collapse accordion__body" data-parent="#accordion-nine">
                                            <div class="accordion__body--text">
                                                <div class="basic-form">
                                                    <form action="jobs.php" method="post" enctype="multipart/form-data">
                                                        <div class="form-row">
                                                            <div class="form-group col-md-8">
                                                                <label>Job Position</label>
                                                                <input type="text" class="form-control" name="job_name" value="" required>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label class="mr-sm-3 info">Job Category</label>
                                                                <select class="custom-select mr-sm-3" name="job_category" id="inlineFormCustomSelect" required>
                                                                    <option value="" selected="true" disabled="disabled">- Selected Category -</option>
                                                                    <?php
                                                                        $rows=$obj->showAll("job_category");
                                                                        $no = 1;
                                                                        foreach($rows as $info){
                                                                            extract($info);
                                                                    ?>
                                                                    <option value="<?php echo $id; ?>"><?php echo $category_name; ?></option>
                                                                    <?php
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <input type="submit" name="submit" value="Add Jobs" class="btn btn-success btn-lg float-right">
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
                <div class="row" id="job-list">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Job List</h4>
                            </div>
                            <div class="card-body">
                                <?php
                                    if(isset($_REQUEST['delete_id'])){
                                        if($obj->Delete($_REQUEST['delete_id'],"job_list")){
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

                                <div id="accordion-two" class="accordion accordion-bordered">
                                    <div class="accordion__item">
                                        <div class="accordion__header" data-toggle="collapse" data-target="#bordered_collapseOne" aria-expanded="true" aria-controls="bordered_collapseOne">
                                            <span class="accordion__header--text">Job Position List</span>
                                            <span class="accordion__header--indicator"></span>
                                        </div>
                                        <div id="bordered_collapseOne" class="collapse accordion__body show" data-parent="#accordion-two">
                                            <div class="accordion__body--text">
                                                <div class="table-responsive">
                                                    <table id="example" class="display" style="min-width: 845px">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">No.</th>
                                                                <th scope="col">Job Position</th>
                                                                <th scope="col">Job Category</th>
                                                                <th scope="col">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                            $rows=$obj->showAllJob("job_list");
                                                            $no = 1;
                                                            foreach($rows as $info){
                                                                extract($info);
                                                        ?>
                                                            <tr>
                                                                <th><?php echo $no; $no++; ?></th>
                                                                <td><?php echo $job_name; ?></td>
                                                                <td><?php echo $category_name; ?></td>
                                                                <td><div class="btn-group" role="group">
                                                                    <button type="button" class="btn btn-rounded btn-outline-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                                                        <div class="dropdown-menu">
                                                                            <a class="dropdown-item" onClick="return confirm('Do you want to delete?');" href="jobs.php?delete_id=<?php echo $id;?>">Delete</a>
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
                                    <div class="accordion__item">
                                        <div class="accordion__header collapsed" data-toggle="collapse" data-target="#bordered_collapseTwo" aria-expanded="true" aria-controls="bordered_collapseTwo">
                                            <span class="accordion__header--text">Job Category</span>
                                            <span class="accordion__header--indicator"></span>
                                        </div>
                                        <div id="bordered_collapseTwo" class="collapse accordion__body" data-parent="#accordion-two">
                                            <div class="accordion__body--text">
                                                <div class="table-responsive">
                                                    <table class="table table-responsive-sm">
                                                        <thead>
                                                            <tr>
                                                                <th>No.</th>
                                                                <th>Job Category</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                            $rows=$obj->showAll("job_category");
                                                            $no = 1;
                                                            foreach($rows as $info){
                                                                extract($info);
                                                        ?>
                                                            <tr>
                                                                <th><?php echo $no; $no++; ?></th>
                                                                <td><?php echo $category_name; ?></td>
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