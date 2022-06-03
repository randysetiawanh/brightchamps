<?php
include 'connect.php';
session_start();
if(!isset($_SESSION['valid'])) {
	header('Location: login.php');
}

if(isset($_REQUEST['submit'])){

	extract($_REQUEST);

	if($obj->userUpdate($hidden_id,$name,$email,$password,"users")){
		header('location:user.php');
	}
	else{
		echo "Cannot Updated!";	
	}


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
								<h2 class="text-uppercase"><a href="user.php">User</a></h2>
							</div>
						</div>
					</li>
				</ul>
			</div>
			<div class="step-inner-content clearfix position-relative">
				<?php


				if(isset($_REQUEST['edit_id'])){

					extract($obj->editValue($_REQUEST['edit_id'],"users"));

				}

				?>
				<script type="text/javascript">
					function valid()
					{
						if(document.chngpwd.password.value!= document.chngpwd.confpassword.value)
						{
							alert("New Password and Confirm Password Field do not match  !!");
							document.chngpwd.confpassword.focus();
							return false;
						}
						return true;
					}
				</script>
				<form name="chngpwd" action="useredit.php" method="post" onSubmit="return valid();">
					<table width="600" border="0" class="table table-striped table-hover" cellspacing="0" cellpadding="5">
						<tr>
							<th width="90" scope="row" style="text-align:right" >Username</th>
							<td width="347"><input type="text" class="form-control input-large" value="<?php echo $username; ?>" disabled /></td>
						</tr>
						<tr>
							<th width="90" scope="row" style="text-align:right" >Name</th>
							<td width="347"><input type="text" class="form-control input-large" value="<?php echo $name; ?>" name="name" /></td>
						</tr>
						
						<tr>
							<th scope="row" style="text-align:right">Email</th>
							<td><input type="text" class="form-control input-large" value="<?php echo $email; ?>" name="email"  /></td>
						</tr>
						
						<tr>
							<th scope="row" style="text-align:right" >New Password</th>
							<td><input type="password" id="newpassword" class="form-control" name="password" required/></td>
						</tr>

						<tr>
							<th scope="row" style="text-align:right" >Confirm Password</th>
							<td><input type="password" id="confirmpassword" class="form-control" name="confpassword" required/></td>
						</tr>

						<tr>
							<td colspan="2" style="text-align:center">
								<input type="hidden" name="hidden_id" value="<?php echo $id; ?>" />
								<input type="submit" name="submit" value="Update Data" class="btn btn-success " /></td>
							</tr>
						</table>
					</form>
				</div>
			</div>

		</div>

	</body>
	</html>