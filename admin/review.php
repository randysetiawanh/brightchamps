<?php
include '../connect.php';
session_start();
if(!isset($_SESSION['valid'])) {
	header('Location: users/login.php');
}

if(isset($_REQUEST['review_id'])){
    extract($obj->editValueApplication($_REQUEST['review_id'],"job_application"));
    if($status == 'Accepted'){
        echo "<script>alert('Status Job is already accepted! Please select another application.');</script>";
        header('Refresh: 0.1; URL=application.php');
    }
}
$level_admins = $_SESSION['level_admin'];
?>
<?php
    $title = 'Review - '.$first_name.' '.$last_name.'';
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
                <!-- row -->
                <div class="row">
                    <div class="col-md-12">
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
                                        <div class="form-group col-md-12">
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
                                                <input type="text" class="form-control" name="job_title" value="<?php echo $job_name; ?>" readonly>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="mr-sm-3 info">Job Status</label>
                                                <select class="custom-select mr-sm-3" name="status" id="selected_status" required>
                                                    <option value="" selected="true" disabled="disabled"><?php echo $status; ?></option>
                                                    <?php if($status=='Rejected'){ ?><option value="Interview">Interview</option><option value="Accepted">Accepted</option><?php } ?>
                                                    <?php if($status=='Pending'){ ?><option value="Interview">Interview</option><option value="Accepted">Accepted</option><option value="Rejected">Rejected</option><?php } ?>
                                                    <?php if($status=='Interview'){ ?><option value="Accepted">Accepted</option><option value="Rejected">Rejected</option><?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>Application Date</label>
                                                <input type="text" class="form-control" name="created" value="<?php $dt = new DateTime($created); echo $dt->format('d/m/Y'); ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="form-row" id="interview-input" style="display: <?php if($status=='Interview'){echo 'block';}else{echo 'none';} ?>;">
                                            <div class="form-group col-md-3">
                                                <label>Meet Date</label>
                                                <input type="datetime-local" class="form-control" id="meet_date" name="meet_date" value="<?php echo $date_interview; ?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Meet Link <a href="https://meet.google.com/">(Get From This)</a></label>
                                                <input type="text" class="form-control" id="meet_link" name="meet_link" placeholder="https://meet.google.com/yro-wrfj-doe" value="<?php echo $meet_interview; ?>">
                                            </div>
                                        </div>
                                        <div class="form-row">
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
        
        <?php require_once('./snip-footer.php'); ?>
    </div>

    <?php require_once('./snip-scripts.php'); ?>
    <script>
        const el = document.getElementById("selected_status");
        const inputEl = document.getElementById("interview-input");
        el.addEventListener("change", function() {
        if (this.value != "Interview") {
            inputEl.style.display = "none";
            document.getElementById('meet_date').removeAttribute('required');
            document.getElementById('meet_link').removeAttribute('required');
        }
        else {
            inputEl.style.display = "block";
            document.getElementById('meet_date').setAttribute('required', '');
            document.getElementById('meet_link').setAttribute('required', '');
        }
        });

    </script>

</body>
</html>
