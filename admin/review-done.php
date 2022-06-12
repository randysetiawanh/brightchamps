<?php
include '../connect.php';
if(!isset($_REQUEST['submit'])){
    header('location:index.php');
    die();
}
$level_admin = $_SESSION['level_admin'];

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
$created        = $_POST['created'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Review Done</title>

    <link rel="icon" type="image/png" sizes="16x16" href="./assets/images/favicon.png">

    <link rel="stylesheet" href="./assets/css/style.css">
    
</head>

<body>
    <div id="preloader"><div class="spinner"><div class="spinner-a"></div><div class="spinner-b"></div></div></div>

    <div id="main-wrapper">
        <div class="nav-header">
            <a href="index.php" class="brand-logo">
                <span class="logo-abbr">Q</span>
                <span class="logo-compact">Admin</span>
                <span class="brand-title">Admin</span>
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="toggle-icon"><i class="icon-menu"></i></span>
                </div>
            </div>
        </div>
        <div class="header"> 
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                    </div>
                </nav>
            </div>
        </div>
        
        <div class="quixnav">           
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label">Navigation</li>
                    <li><a href="index.php"><i class="mdi mdi-home"></i><span class="nav-text">Home</span></a></li>
                    <li><a href="application.php"><i class="mdi mdi-table"></i><span class="nav-text">Application Management</span></a></li>
                    <?php if($level_admin == 1){ ?>
                    <li><a href="users.php"><i class="mdi mdi-account"></i><span class="nav-text">Users Management</span></a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>

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
                                    <?php echo $city_list; ?>, <?php echo $country_list; ?><br><br>
                                    <h4><b>Job Application</b></h4>
                                    Job Position : <?php echo $job_title; ?><br>
                                    Application Date : <?php echo $created; ?><br>
                                    Application Status : <?php echo $status; ?>
                                </p>
                                <p class="card-text"><br>To avoid unwanted errors, please re-confirm the changes.</p>
                                <a href="application.php" class="btn btn-dark btn-card">Go Application List</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="footer">
            <div class="copyright">
                <p>Copyright © Designed &amp; Developed by <a href="https://themeforest.net/user/quixlab" target="_blank">Quixlab</a> 2019</p>
            </div>
        </div>
    </div>
    
    <!-- Required vendors -->
    <script src="./assets/vendor/jquery/jquery.min.js"></script>
    <script src="./assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- Here is navigation script -->
    <script src="./assets/vendor/quixnav/quixnav.min.js"></script>
    <script src="./assets/js/quixnav-init.js"></script>
    <script src="./assets/js/custom.min.js"></script>
    <!-- Demo scripts -->
    <script src="./assets/js/styleSwitcher.js"></script>

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
	if($obj->Update($hidden_id,$status, "job_application")){
		$mail = new PHPMailer(true);

		try {
			$mail->isSMTP();
			$mail->Host       = 'smtp.gmail.com';
			$mail->SMTPAuth   = true;
			$mail->Username   = 'mini.mbul@gmail.com';
			$mail->Password   = 'dquqersuwqfygleg';
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
			$mail->Port       = 587;

			$mail->setFrom('mini.mbul@gmail.com', 'Test');
			$mail->addAddress(''.$email.'', ''.$name.'');
			// $mail->addBCC('bcc@example.com'); - Company Email
			
			$mail->isHTML(true);
            $email_template = '../assets/phpmailer/application-'.$status_lower.'.html';
			$message = file_get_contents($email_template);
			$message = str_replace('%name%', $name, $message);
			$message = str_replace('%job_name%', $job_title, $message);
			$message = str_replace('%status%', $status, $message);
			$message = str_replace('%application_date%', $created, $message);

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