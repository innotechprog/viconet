<?php
session_start();
//PHP Mailer Headers
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
//Variable declaring and assigning 
?>
<!DOCTYPE html>
<html>
<?php
include "head.php";
?>
<head>
    <meta charset="utf-8">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
	<meta name="robots" content="index, follow">
    <link rel="shortcut icon" type="image/png" href="favicon.png">
    
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css?6841">
	<link rel="stylesheet" type="text/css" href="css/style2.css">
	<link rel="stylesheet" type="text/css" href="css/ionicons.min.css">
	<link href='https://fonts.googleapis.com/css?family=Quicksand:300,400,500,600,700,40&display=swap&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <title>message-success</title>
   </head>
<body style="  height: 100%;">
	<!-- Preloader -->
<div id="page-loading-blocs-notifaction" class="page-preloader"></div>
<!-- Preloader END -->


<!-- Main container -->
<div class="page-container">
    
<?php
include "include/connect.php";
include "include/functions.php";
include "include/website_class.php";
$web = new Website($db); //Website class	
include "../business.viconetgroup.com/include/jobs_class.php";
include "include/job_appli_class.php";
if (isset($_SESSION['id'])) {
include "include/auth.php";
}
if(isset($_SESSION['jobid'])){
	unset($_SESSION['jobid']);
}
$application = new Application($db);
$jobs = new Jobs($db);
$corp = new Corporate($db);
$emails = new SendEmails($db);
$id =""; 
$date = date('Y-m-d');
 if(isset($_POST['apply'])) {
	$email = $_POST['email'];
	$jobId = $_POST['jobId'];
	$jobs->setJob(md5($jobId));
	$jobs->setCompany($jobs->jobCompId());
	$corp->getAddressBy($jobs->jobCompId()); 
	$corp->setUsersData($jobs->jobCompReg());
	$jobEmail = $jobs->getCompEmail();

	if (!isset($_SESSION['id'])) {
		$_SESSION['jobid'] = $id;
		?>
		<script type="text/javascript">window.location="https://talent.viconetgroup.com"</script>
		<?php
	}
	else if(isset($_SESSION['id'])){

		$application->addJobApplication($email,$jobId);
        //require 'PHPMailer/PHPMailerAutoload.php';
//Adding candidate information to database
//$email = $candidate->getCandEmail();
		$mail = new PHPMailer(true);
		include "job-appli-email.php";
		$mail2 = new PHPMailer(true);
		include "emails/appli-emailto-company.php";
		?>
<div class="bloc bg-bg d-bloc full-width-bloc bloc-fill-screen" id="container-f">
	<div class="container">
		<div class="row">
			<div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2 text-start col-lg-4 offset-lg-4">
				<div class="card-f">
					<div class="row">
						<div class="col align-self-center">
							<img src="img/lazyload-ph.png" data-src="img/logo.svg" class="img-fluid mx-auto d-block mb-lg-3 lazyload" alt="logo" width="179" height="66">
							<div class="row">
								<div class="col">
									<img  src="img/lazyload-ph.png" data-src="img/animation_lkb7ocgd_small.gif" class="img-fluid mx-auto  d-block img-succe-style lazyload" alt="animation_lkb7ocgd_small" width="92" height="92">
									<p class="p-style mb-md-4 text-lg-center mt-lg-0 mt-md-0 float-md-none text-md-center text-sm-center mt-sm-0 text-center mt-0">Thank You!<br>Your application was successfully submitted.<br><br>A confirmation email has been sent to your inbox.</p>
								</div> 
							</div><!--<a href="index" class="btn btn-d btn-lg mb-md-2 mb-sm-2 btn-12 float-lg-none mt-lg-0 w-100">Re</a>-->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
	<?php
	}	 
}
else if(isset($_POST['indirectApply'])){
	$_SESSION['jobid'] =  md5($_POST['jobId']);
	?>
	<script type="text/javascript">window.location="index"</script>
<?php
}
else if(isset($_POST['applyCompSite'])){
	$email = $_POST['email'];
	$jobId = $_POST['jobId'];
	$jobs->setJob(md5($jobId));
	$jobs->setCompany($jobs->jobCompId());
	$corp->getAddressBy($jobs->jobCompId()); 
	$corp->setUsersData($jobs->jobCompReg());
	?>
	<div class="bloc bg-bg d-bloc full-width-bloc bloc-fill-screen" id="container-f">
	<div class="container">
		<div class="row">
			<div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2 text-start col-lg-4 offset-lg-4">
				<div class="card-f">
					<div class="row">
						<div class="col align-self-center">							
							<img src="img/lazyload-ph.png" data-src="img/logo.svg" class="img-fluid mx-auto d-block mb-lg-3 lazyload" alt="logo" width="179" height="66">
							<div class="row">
								<div class="col">
									<p class="p-style mb-md-4 text-lg-center mt-lg-0 mt-md-0 float-md-none text-md-center text-sm-center mt-sm-0 text-center mt-0">You're leaving Vico.net<br>Please click the button below to be redirected to the company site</p>
								</div> 
							</div><a href="<?php echo $jobs->getAppLink() ?>" class="btn btn-d btn-lg mb-md-2 mb-sm-2 btn-12 float-lg-none mt-lg-0 w-100">Proceed</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
}
?>
<script src="./js/bootstrap.bundle.min.js?7548"></script>
<script src="./js/blocs.min.js?5719"></script>
<script src="./js/lazysizes.min.js" defer></script><!-- Additional JS END -->
</body>
</html>