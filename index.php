<?php
include 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>BrightChamps</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/owl.carousel.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
	<link rel="stylesheet" href="assets/css/animate.min.css">
	<link rel="stylesheet" href="assets/css/fontawesome-all.css">
	<link rel="stylesheet" href="assets/css/style.css">

	<body>
		<div class="clearfix"></div>
		<div class="wrapper">
			<div class="wizard-content-1 pos-flex clearfix">
				<div class="steps d-inline-block clearfix">
					<span class="bg-shape"></span>
					<ul class="tablist multisteps-form__progress">
						<li class="multisteps-form__progress-btn js-active current">
							<div class="step-btn-icon-text">
								<span>1</span>
								<div class="step-btn-icon float-left position-relative">
									<img src="assets/img/bt1.png" alt="">
								</div>
								<div class="step-btn-text">
									<h2 class="text-uppercase">Job Board</h2>
									<span class="text-capitalize">Job Available</span>
								</div>
							</div>
						</li>
						<li class="multisteps-form__progress-btn">
							<div class="step-btn-icon-text">
								<span>2</span>
								<div class="step-btn-icon float-left position-relative">
									<img class="fix-image" src="assets/img/bt2.png" alt="">
								</div>
								<div class="step-btn-text">
									<h2 class="text-uppercase">Send Details</h2>
									<span class="text-capitalize">Candidate Informations</span>
								</div>
							</div>
						</li>
						<li class="multisteps-form__progress-btn">
							<div class="step-btn-icon-text">
								<span>3</span>
								<div class="step-btn-icon float-left position-relative">
									<img class="fix-image-2" src="assets/img/bt3.png" alt="">
								</div>
								<div class="step-btn-text">
									<h2 class="text-uppercase">ThankYou</h2>
									<span class="text-capitalize">Job Submitted</span>
								</div>
							</div>
						</li>
					</ul>
				</div>
				<div class="step-inner-content clearfix position-relative">
					<span class="bg-shape"></span>
					<form class="multisteps-form__form" action="submit.php" id="form" method="POST" enctype="multipart/form-data">
						<div class="form-area position-relative">
							<div class="multisteps-form__panel js-active" data-animation="scaleIn">
								<div class="wizard-forms position-relative">
									<span class="step-no position-absolute">Step 1</span>
									<div class="wizard-inner-box">
										<div class="inner-title text-center">
											<h2>What kind of Job You Need ?</h2>
											<p> </p>
										</div>
										<div id="need-job-slide-id" class="need-job-slide owl-carousel">
										<?php
										$rows=$obj->showAllJob("job_list");
										foreach($rows as $info){
											extract($info);
										?>
											<label class="need-job-icon-text text-center">
												<input type="radio" name="job_title" value="<?php echo $id; ?>" placeholder="" class="j-checkbox" required />
												<span class="need-job-text-inner">
													<span class="checkbox-circle-mark position-absolute"> </span>
													<span class="need-job-icon">
														<img src="assets/img/bt1.png" alt="">
													</span>
													<span class="need-job-text">
														<span class="text-uppercase need-job-title"><?php echo mb_strlen($job_name) > 20 ? mb_substr($job_name, 0, 20) . ".." : $job_name; ?></span>
														<span class="text-capitalize need-job-text"><?php echo $category_name; ?></span>
													</span>
												</span>
											</label>
										<?php
										}
										?>
										</div>
									</div>
									<div id="next-step1" class="actions">
										<ul>
											<li><span class="js-btn-next" title="NEXT">NEXT</span></li>
										</ul>
									</div>
								</div>
								<div class="bottom-vector position-absolute">
									<img src="assets/img/sd1.png" alt="">
								</div>
							</div>
							<!-- step 1 -->
							<div class="multisteps-form__panel" data-animation="scaleIn">
								<div class="wizard-forms form-step-2">
									<span class="step-no position-absolute">Step 2</span>
									<div class="wizard-inner-box">
										<div class="inner-title text-center">
											<h2>Please Input Information</h2>
											<p>Candidates are expected to input the correct information. </p>
										</div>
									</div>
									<div class="details-form-area">
										<div class="row">
											<div class="col-lg-6">
												<div class="form-input-inner position-relative has-float-label">
													<input type="text" name="first_name" placeholder="First Name" class="form-control required" required>
													<label>First  Name</label>
													<div class="icon-bg text-center">
														<i class="fas fa-user"></i>
													</div>
													
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-input-inner position-relative has-float-label">
													<input type="text" name="last_name" placeholder="Last Name" class="form-control required" required>
													<label>Last  Name</label>
													<div class="icon-bg text-center">
														<i class="fas fa-user"></i>
													</div>
													
												</div>
											</div>
											<div class="col-lg-8">
												<div class="form-input-inner position-relative has-float-label">
													<input type="email" name="email" placeholder="Email" class="form-control required" required>
													<label>Email</label>
													<div class="icon-bg text-center">
														<i class="fas fa-envelope"></i>
													</div>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="form-input-inner position-relative has-float-label">
													<input type="text" name="phone" placeholder="Phone" class="form-control required" required>
													<label>Phone</label>
													<div class="icon-bg text-center">
														<i class="fas fa-phone"></i>
													</div>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="form-input-inner position-relative has-float-label">
													<input type="text" name="address" placeholder="Address" class="form-control required" required>
													<label>Address</label>
													<div class="icon-bg text-center">
														<i class="fas fa-bullhorn"></i>
													</div>
												</div>
											</div>
											<div class="input-filed-innerbox">
												<div class="row">
													<div class="col-lg-8">
														<div class="row">
															<div class="col-lg-12">
																<div class="form-input-inner position-relative has-float-label">
																	<input type="text" name="city_list" placeholder="City" class="form-control required" required>
																	<label>City</label>
																	<div class="icon-bg text-center">
																		<i class="fas fa-handshake"></i>
																	</div>
																</div>
															</div>
															<div class="col-lg-6">
																<div class="form-input-inner select-option-area position-relative">
																	<select name="country_list">
																		<option>Indonesia</option>
																	</select>
																	<div class="icon-bg text-center">
																		<i class="fas fa-flag-checkered"></i>
																	</div>
																</div>
															</div>
															<div class="col-lg-6">
																<div class="form-input-inner position-relative date-of-birth">
																	<input data-date-format="yyyy-mm-dd" name="dob" placeholder="Birth Day" class="datepicker" required>
																	<div class="icon-bg text-center">
																		<i class="fas fa-bullhorn"></i>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-4">
														<div class="form-input-inner gender-select position-relative">
															<h3>Gender</h3>
															<label>
																<input type="radio" name="gender" value="Male" checked required>
																<span class="checkmark">Male</span>
															</label>
															<label>
																<input type="radio" name="gender" value="Female">
																<span class="checkmark">Female</span>
															</label>
															<div class="icon-bg text-center">
																<i class="fas fa-transgender"></i>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="form-input-inner add-textarea position-relative">
												<div class="col-lg-12">
													<textarea name="add_info" placeholder="Additional-info"></textarea>
													<div class="icon-bg text-center">
														<i class="fas fa-edit"></i>
													</div>
												</div>
											</div>
											<div class="wizard-document-upload">
												<div class="custom-file form-input-inner position-relative">
													<input type="file" class="custom-file-input" name="file_upload" id="customFile" required>
													<label class="custom-file-label" for="customFile">Add Your CV</label>
													<div class="file-size-text position-relative">Only : pdf / doc Size: lessthan 1 Mb</div>
													<div class="icon-bg text-center">
														<i class="fas fa-edit"></i>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="actions">
										<ul>
											<li><span class="js-btn-prev" title="BACK">Back</span></li>
											<li><button type="submit" class="js-btn-next" id="submit-step2" name="submit">Submit</button></li>
										</ul>
									</div>
									<div class="bottom-vector position-absolute">
										<img src="assets/img/sd1.png" alt="">
									</div>
								</div>
							</div>
							<!-- step 2 -->
						</div>
					</form>
				</div>
			</div>
		</div>

		<script src="assets/js/jquery-3.3.1.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/popper.min.js"></script>
		<script src="assets/js/owl.carousel.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
		<script src="assets/js/form-step.js"></script>
		<script src="assets/js/jquery.validate.min.js"></script>
		<script src="assets/js/main.js"></script>
		<script src="assets/js/switch.js"></script>
		<script>
			$("#need-job-slide-id label input").click(function (element) {
				var el = element.currentTarget.value;
				document.getElementById("").value = el;
			});

			$("#next-step1 ul li span").click(function (element) {
				if (!$("input[name='job_title']:checked").val()) {
					location.reload();
					alert('Please selected one job!');
				}
			});
			
			$("#customFile").change(function() {
				filename = this.files[0].name
			});
			$(".custom-file-input").on("change", function() {
				var fileName = $(this).val().split("\\").pop();
				$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
			});
			$('.datepicker').datepicker({
				clearBtn: true,
				format: "yyyy-mm-dd"
			});
		</script>
	</body>

	</html>
