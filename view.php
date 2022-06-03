<?php
include 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Job V1</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/owl.carousel.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
	<link rel="stylesheet" href="assets/css/animate.min.css">
	<link rel="stylesheet" href="assets/css/fontawesome-all.css">
	<link rel="stylesheet" href="assets/css/style.css">

	<!-- dashboard -->
	<link rel="stylesheet" href="dashboard/assets/css/jquery.dataTables.min.css">

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
		.step-no.step-no, .apply-now.apply-now {
			margin-bottom: 30px;
			display: block;
			right: 0;
			background: #724dd8;
			float: left;
			padding: 7px 15px;
			color: #fff;
			cursor: pointer;
		}
	</style>
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
									<h2 class="text-uppercase">Applicant List</h2>
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
									<h2 class="text-uppercase"><a href="login.php">Admin</a></h2>
								</div>
							</div>
						</li>
					</ul>
				</div>
				<div class="table-responsive step-inner-content clearfix position-relative">
					
					<table id="applicant-table" class="table table-striped table-hover" cellspacing="0" cellpadding="5">
						<thead>
							<tr>
								<th scope="col">Id</th>
								<th style="display: flex; width: 130px;border-bottom: 1px solid #000000" scope="col">Job title</th>
								<th scope="col">Name</th>
								<th style="display: flex; width: 100px;border-bottom: 1px solid #000000" scope="col">Last name</th>
								<th scope="col">Email</th>
								<th scope="col">Phone</th>
								<th scope="col">Country</th>
								<th scope="col">City</th>
								<th scope="col">Gender</th>
								<th style="display: flex; width: 180px;border-bottom: 1px solid #000000" scope="col">Address</th>
								<th scope="col">Position</th>
								<th scope="col">Info</th>
								<th scope="col">Resume</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$rows=$obj->showAll("job_application");
							foreach($rows as $info){
								extract($info);
								?>
								<tr>
									<td><?php echo $id; ?></td>
									<td><?php echo $job_title; ?></td>
									<td><?php echo $first_name; ?></td>
									<td><?php echo $last_name; ?></td>
									<td><?php echo $email; ?></td>
									<td><?php echo $phone; ?></td>
									<td><?php echo $country_list; ?></td>
									<td><?php echo $city_list; ?></td>
									<td><?php echo $gender; ?></td>
									<td><?php echo $address; ?></td>
									<td><?php echo $position_list; ?></td>
									<td><?php echo $add_info; ?></td>
									<td><a target="_blank" href="uploads/<?php echo $resume; ?>">View</a></td>
								</tr>
								<?php
							}
							?>
						</tbody>
					</tr>
				</table>
				<div><a href="index.html" class="pull-right btn btn-primary apply-now">Apply New</a></div>
			</div>
		</div>
	</div>

	<script src="assets/js/jquery-3.3.1.min.js"></script>
	<script src="dashboard/assets/js/jquery.dataTables.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script>
		$(document).ready( function () {
			$('#applicant-table').DataTable();
		} );
	</script>

</body>

</html>
