<?php
include '../connect.php';
session_start();
if(!isset($_REQUEST['submit'])){
    header('location:index.php');
    die();
}
$level_admins = $_SESSION['level_admin'];

$job_title 		= $_POST['job_title'];
$status 		= $_POST['status'];
$status_lower   = strtolower($status);
$first_name 	= $_POST['first_name'];
$last_name 		= $_POST['last_name'];
$name			= $first_name.' '.$last_name;
$email 			= $_POST['email'];
$phone 			= $_POST['phone'];
$country_list 	= $_POST['country_list'];
$city_list 		= $_POST['city_list'];
$gender 		= $_POST['gender'];
$address 		= $_POST['address'];
$add_info 		= $_POST['add_info'];
$meet_date 		= $_POST['meet_date'];
$meet_dates     = new DateTime($meet_date);
$meet_link 		= $_POST['meet_link'];
$created        = $_POST['created'];
?>
<?php
    $title = 'Review Done - '.$first_name.' '.$last_name.'';
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
                <div class="row page-titles mx-0">
                    <div class="col-sm-12 p-md-0">
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-xl-12 col-xxl-12 col-lg-12 col-sm-12">
                        <div class="card text-white bg-success">
                            <div class="card-header">
                                <h5 class="card-title text-white"><b>Congrats!</b> Candidate with name <b><?php echo $name; ?></b> is successfully updated!</h5>
                            </div>
                            <div class="card-body mb-0">
                                <p class="card-text">Here are the details of the changes:</p>
                                <p class="card-text">
                                    <h4><b>Candidate Information</b></h4>
                                    <b>Contact Information :</b><br>
                                    Name : <?php echo $name; ?><br>
                                    Email : <?php echo $email; ?><br>
                                    Phone : <?php echo $phone; ?><br><br>
                                    <b>Address Information : </b><br>
                                    <?php echo $address; ?><br>
                                    <?php echo $city_list; ?>, <?php echo $country_list; ?><br>
                                    -------------------------------------------------------------------<br><br>
                                    <h4><b>Job Application</b></h4>
                                    Job Position : <?php echo $job_title; ?><br>
                                    Application Date : <?php echo $created; ?><br>
                                    Application Status : <?php echo $status; ?><br>
                                    -------------------------------------------------------------------
                                    <?php if($status=='Interview'){ ?>
                                    <br><br><h4><b>Interview Detail</b></h4>
                                    Interview Date : <?php echo $meet_dates->format('d-m-Y, h:i A'); ?><br>
                                    Interview Meet Link : <a href="<?php echo $meet_link; ?>"><?php echo $meet_link; ?></a>
                                    <?php } ?>
                                </p>
                                <p class="card-text"><br>To avoid unwanted errors, please re-confirm the changes.</p>
                                <a href="application.php" class="btn btn-dark btn-card">Go Application List</a>
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
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../assets/phpmailer/src/Exception.php';
require '../assets/phpmailer/src/PHPMailer.php';
require '../assets/phpmailer/src/SMTP.php';

if(isset($_REQUEST['submit'])){
	extract($_REQUEST);
	if($obj->Update($hidden_id,$status,$meet_date,$meet_link, "job_application")){
		$mail = new PHPMailer(true);

		try {
			$mail->isSMTP();
			$mail->Host       = 'smtp.gmail.com';
			$mail->SMTPAuth   = true;
			$mail->Username   = 'mini.mbul@gmail.com';
			$mail->Password   = 'dquqersuwqfygleg';
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
			$mail->Port       = 587;

			$mail->setFrom('mini.mbul@gmail.com', 'BrightChamps');
			$mail->addAddress(''.$email.'', ''.$name.'');
			// $mail->addBCC('bcc@example.com'); - Company Email
			
			$mail->isHTML(true);
            $email_template = '../assets/phpmailer/application-'.$status_lower.'.html';
			$message = file_get_contents($email_template);
			$message = str_replace('%name%', $name, $message);
			$message = str_replace('%job_name%', $job_title, $message);
			$message = str_replace('%status%', $status, $message);
			$message = str_replace('%application_date%', $created, $message);
			$message = str_replace('%meet_date%', $meet_dates->format('d-m-Y, h:i A'), $message);
			$message = str_replace('%meet_link%', $meet_link, $message);

			$mail->MsgHTML($message);
			$mail->Subject = ''.$name.' - Your Application in BrightChamps is '.$status.'.';
			$mail->send();
			echo 'Message has been sent';
		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}
	}
	
}
?>