<?php
include 'connect.php';
if(!isset($_REQUEST['submit'])){
    header('location:index.php');
    die();
}

$job_title 		= $_POST['job_title'];
$first_name 	= $_POST['first_name'];
$last_name 		= $_POST['last_name'];
$name			= $first_name.' '.$last_name;
$email 			= $_POST['email'];
$phone 			= $_POST['phone'];
$country_list 	= $_POST['country_list'];
$city_list 		= $_POST['city_list'];
$gender 		= $_POST['gender'];
$dob			= $_POST['dob'];
$address 		= $_POST['address'];
$add_info 		= $_POST['add_info'];
$upload 		= $_FILES['file_upload']['name'];
$upload_tmp		= $_FILES['file_upload']['tmp_name'];
$upload_size	= $_FILES['file_upload']['size'];
// etc
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
					<li class="multisteps-form__progress-btn">
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
					<li class="multisteps-form__progress-btn js-active current">
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
				<div class="form-area position-relative">
					<div class="multisteps-form__panel js-active" data-animation="scaleIn">
						<div class="wizard-forms form-step-3">
							<span class="step-no position-absolute">Step 3</span>
							<div class="wizard-inner-box">
								<div class="thank-content text-center">
									<div class="thank-img">
										<img src="assets/img/th1.png" alt="">
									</div>
									<div class="thank-text">
										<h2>Thankyou For submition!</h2>
										<p><span id="thankyou-name"><?php echo $first_name; ?> <?php echo $last_name; ?></span> We will Email you soon</p>
									</div>
									<div class="thank-btn text-uppercase">
										<a href="index.php">Back to home</a>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
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
</body>

</html>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'assets/phpmailer/src/Exception.php';
require 'assets/phpmailer/src/PHPMailer.php';
require 'assets/phpmailer/src/SMTP.php';

// Sending email
if(isset($_REQUEST['submit'])){
	
	//data insert
	extract($_REQUEST);

	if($obj->Insert($job_title,$first_name,$last_name,$email,$phone,$country_list,$city_list,$gender,$dob,$address,$add_info,$upload,$upload_tmp,$upload_size, "job_application")){
		//Create an instance; passing `true` enables exceptions
		$mail = new PHPMailer(true);

		try {
			//Server settings
			$mail->isSMTP();                                            //Send using SMTP
			$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
			$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
			$mail->Username   = 'mini.mbul@gmail.com';                     //SMTP username
			$mail->Password   = 'dquqersuwqfygleg';                               //SMTP password
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
			$mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

			//Recipients
			$mail->setFrom('mini.mbul@gmail.com', 'BrightChamps');
			$mail->addAddress(''.$email.'', ''.$name.'');     //Add a recipient
			// $mail->addBCC('bcc@example.com');
			
			//Content
			$mail->isHTML(true);
			$email_template = 'assets/phpmailer/application-confirmation.html';
			$message = file_get_contents($email_template);
			$message = str_replace('%name%', $name, $message);

			$mail->MsgHTML($message);
			$mail->Subject = ''.$name.' - Thanks For The Submission!';
			$mail->send();
			echo 'Message has been sent';
		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}
	}
	
}
?>