<?php
include 'connect.php';
session_start();
if(!isset($_SESSION['valid'])) {
	header('Location: login.php');
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Insert </title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/owl.carousel.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
	<link rel="stylesheet" href="assets/css/animate.min.css">
	<link rel="stylesheet" href="assets/css/fontawesome-all.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<script src="assets/js/jquery-3.3.1.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
<style type="text/css">
		table {
			zoom: 0.9;
		}
		thead {
			background: #724dd8;
			color: #fff;
			font-weight: bold;
		}
		.step-inner-content {
			padding: 40px 40px 28px;
		}
	</style>
</head>

<body>
	<div class="wrapper">
		<div class="wizard-content-1 clearfix">
			<div class="steps d-inline-block clearfix">
				<span class="bg-shape"></span>
				<ul class="tablist multisteps-form__progress">
					<li class="multisteps-form__progress-btn js-active current">
						<div class="step-btn-icon-text">
							<div class="step-btn-icon float-left position-relative">
								<img src="assets/img/bt1.png" alt="">
							</div>
							<div class="step-btn-text">
								<h2 class="text-uppercase">Edit Application</h2>
								<span class="text-capitalize"></span>
							</div>
						</div>
					</li>
					<li class="multisteps-form__progress-btn">
						<div class="step-btn-icon-text">
							<div class="step-btn-icon float-left position-relative">
								<img src="assets/img/bt2.png" alt="">
							</div>
							<div class="step-btn-text">
								<h2 class="text-uppercase">User</h2>
							</div>
						</div>
					</li>
				</ul>
			</div>
			<div class="step-inner-content clearfix position-relative">
				<?php
				if(isset($_REQUEST['edit_id'])){

					extract($obj->editValue($_REQUEST['edit_id'],"job_application"));

				}
				if(isset($_REQUEST['submit'])){

					extract($_REQUEST);
					$upload 		= $_FILES['file_upload']['name'];
					$upload_tmp		= $_FILES['file_upload']['tmp_name'];
					$upload_size	= $_FILES['file_upload']['size'];

					if($obj->Update($hidden_id,$job_title,$first_name,$last_name,$email,$phone,$country_list,$city_list,$gender,$address,$position_list,$add_info,$upload,$upload_tmp,$upload_size, "job_application")){
						header('location:result.php');
					}
					else{
						echo "Cannot Updated!";	
					}
				}
				?>

				<form action="edit.php" method="post" enctype="multipart/form-data">
					<table width="600" border="0" class="table table-striped table-hover" cellspacing="0" cellpadding="5">
						<tr>
							<th width="90" scope="row" style="text-align:right" >First Name</th>
							<td width="347"><input type="text" class="form-control input-large" value="<?php echo $first_name; ?>" name="first_name" /></td>
						</tr>
						<tr>
							<th width="90" scope="row" style="text-align:right" >Last Name</th>
							<td width="347"><input type="text" class="form-control input-large" value="<?php echo $last_name; ?>" name="last_name" /></td>
						</tr>
						<tr>
							<th scope="row" style="text-align:right">Email</th>
							<td><input type="text" class="form-control input-large" value="<?php echo $email; ?>" name="email" /></td>
						</tr>
						<tr>
							<th scope="row" style="text-align:right">Mobile</th>
							<td><input type="text" class="form-control input-large" value="<?php echo $phone; ?>" name="phone" /></td>
						</tr>
						<tr>
							<th scope="row" style="text-align:right" >Job Title</th>
							<td><input type="text"  class="form-control" name="job_title" value="<?php echo $job_title; ?>"/></td>
						</tr>

						<tr>
							<th scope="row" style="text-align:right" >Country</th>
							<td><input type="text"  class="form-control" name="country_list" value="<?php echo $country_list; ?>"/></td>
						</tr>

						<tr>
							<th scope="row" style="text-align:right" >Country</th>
							<td><input type="text"  class="form-control" name="city_list" value="<?php echo $city_list; ?>"/></td>
						</tr>

						<tr>
							<th scope="row" style="text-align:right" >Position</th>
							<td>
								<select name="position_list">
									<option>Choose Position</option>
									<option <?php echo $position_list == 'Intern' ? ' selected="selected"' : '';?>>Intern</option>
									<option <?php echo $position_list == 'Junior Developer' ? ' selected="selected"' : '';?>>Junior Developer</option>
									<option <?php echo $position_list == 'Senior Developer' ? ' selected="selected"' : '';?>>Senior Developer</option>
									<option <?php echo $position_list == 'UI/UX Designer' ? ' selected="selected"' : '';?>>UI/UX Designer</option>
									<option <?php echo $position_list == 'Designer' ? ' selected="selected"' : '';?>>Designer</option>
									<option <?php echo $position_list == 'HR' ? ' selected="selected"' : '';?>>HR</option>
									<option <?php echo $position_list == 'Others' ? ' selected="selected"' : '';?>>Others</option>
								</select>
						</tr>

						<tr>
							<th scope="row" style="text-align:right" >Additional Information</th>
							<td><input type="text"  class="form-control" name="add_info" value="<?php echo $add_info; ?>"/></td>
						</tr>

						<tr>
							<th scope="row" style="text-align:right" >Gender</th>
							<td><input type="text"  class="form-control" name="gender" value="<?php echo $gender; ?>"/></td>
						</tr>

						<tr>
							<th scope="row" style="text-align:right" >Address</th>
							<td><textarea rows="5"  class="form-control" name="address"><?php echo $address; ?></textarea></td>
						</tr>
						<tr>
							<th scope="row" style="text-align:right" >Upload Doc</th>
							<td><input type="file"  class="form-control" name="file_upload" value="" required/>
								<?php 
								$imgExt = strtolower(pathinfo($resume, PATHINFO_EXTENSION));

								$allowExt  = array('jpeg', 'jpg', 'png', 'gif');
								if(in_array($imgExt, $allowExt)){
									?>
									<p><img src="uploads/<?php echo $resume; ?>" alt=""></p>
								<?php } else { ?>
									<a href="uploads/<?php echo $resume; ?>">uploads/<?php echo $resume; ?></a>
								<?php } ?>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="text-align:center">
								<input type="hidden" name="hidden_id" value="<?php echo $id; ?>" />
								<input type="submit" name="submit" value="Update Data" class="btn btn-success " /></td>
							</tr>
						</table>
					</form>
								<a class="btn btn-success text-white" href="result.php">Home</a>

				</div>
			</div>

		</div>

	</body>
	</html>