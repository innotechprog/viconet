<?php
session_start();
//make session available on all subdomains

// Set session data
//$_SESSION['subdomain_data'] = 'Some data for the subdomain';


include "include/connect.php";
include "include/functions.php";	
include "include/jobs_class.php";
include "../include/job_appli_class.php";
$candidate = new Candidates($db);
$application = new Application($db);
$status = "";
$email ="";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
	<meta name="robots" content="index, follow">
    <link rel="shortcut icon" type="image/svg" href="img/favicon.svg">
    
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css?6841">
	<link rel="stylesheet" type="text/css" href="css/style2.css">
	<link rel="stylesheet" type="text/css" href="css/ionicons.min.css">
	<link href='https://fonts.googleapis.com/css?family=Quicksand:300,400,500,600,700,40&display=swap&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <title>message-success</title>
    
<!-- Analytics -->
 
<!-- Analytics END -->
    
</head>
<body style="  height: 100%;">
<?php
if(isset($_POST['user_email']))
{
	$email = $_POST['user_email'];
}
if(isset($_POST['job_id']))
{
	$jobId = $_POST['job_id'];
	$_SESSION['opportunity'] = "oppo";
	$_SESSION['job_id'] = $jobId;
	$_SESSION['opp_access'] = md5($pass);
	$_SESSION['oppo_c_email'] = $email;
}

if($candidate->checkEmailExist($email)){
	$status = $candidate->checkEmailStatus($email);
	$candidate->setCandidate(md5($email));
	if($status == "Pending"){
		include "emails/pending-prof-email.php";
		$type = md5('cand');
		//unset($_POST['user_email']);
?>

<div class="bloc bg-bg d-bloc full-width-bloc bloc-fill-screen " id="container-f">
	<div class="container">
		<div class="row">
			<div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2 text-start col-lg-6 offset-lg-3"> 
				<div class="card-f">
					<div class="row">
						<div class="col align-self-center">
							<img src="img/lazyload-ph.png" data-src="img/logo.svg" class="img-fluid mx-auto d-block mb-lg-3 lazyload" alt="logo" width="179" height="66">
							<div class="row">
								<div class="col text-lg-center">
									<img src="img/lazyload-ph.png" data-src="img/animation_lkb7ocgd_small.gif" class="img-fluid mx-auto d-block img-succe-style lazyload" alt="animation_lkb7ocgd_small" width="92" height="92">
									<label class="l-24 bcolor">
										Welcome to the Vico.net&trade; group.
									</label>
									<p class="p-16">Thank you for your interest in Vico.net&trade; – your virtual collaboration network!</p>
									<label class="l-18 bcolor">We have received your submission, but noticed that your email is not yet verified.</label><br><br>
									<p class="p-16">Please <a href="https://talent.viconetgroup.com/resend_link?ty=<?php echo $type?>&em=<?php echo $enemail ?>" class="a-class">click here</a> to resend verification email in order to be eligible for this opportunity.</p>
									<p class="p-16">For any future enquiries, please contact<br> <a href="mailto:info@viconetgroup.com" class="a-class">info@viconetgroup.com</a></p>
									<p class="p-16">Regards</p>
									<br>
									<p class="p-14">The Vico.net&trade; Team<br><a href="mailto:info@viconetgroup.com" class="a-class">info@viconetgroup.com</a> | <a href="tel:+27 10 824 7568" class="a-class">+27 10 824 7568</a></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
	<?php 
	}
	else if($status == "process"){
		include "emails/process-prof-email.php";
		//unset($_POST['user_email']);
		?>
		<div class="bloc bg-bg d-bloc full-width-bloc bloc-fill-screen " id="container-f">
	<div class="container">
		<div class="row">
			<div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2 text-start col-lg-6 offset-lg-3">
				<div class="card-f">
					<div class="row">
						<div class="col align-self-center">
							<img src="img/lazyload-ph.png" data-src="img/logo.svg" class="img-fluid mx-auto d-block mb-lg-3 lazyload" alt="logo" width="179" height="66">
							<div class="row">
								<div class="col text-lg-center">
									<img src="img/lazyload-ph.png" data-src="img/animation_lkb7ocgd_small.gif" class="img-fluid mx-auto d-block img-succe-style lazyload" alt="animation_lkb7ocgd_small" width="92" height="92">
									<label class="l-24 bcolor">
										<?php echo 'Dear '.$candidate->getCandName().' '.$candidate->getCandSurname(); ?>
									</label>
									<br><br>
									<label class="l-18 bcolor">We have noticed that your Vico.net&trade; profile is incomplete.</label><br><br>
									<p class="p-16">Please <a href="https://talent.viconetgroup.com" class="a-class">click here</a> to complete your talent profile in order to be eligible for this opportunity.</p>
									<p class="p-16">For enquiries, please contact<br> <a href="mailto:info@viconetgroup.com" class="a-class">info@viconetgroup.com</a></p>
									<p class="p-16">Regards</p>
									<br>
									<p class="p-14">The Vico.net&trade; Team<br><a href="mailto:info@viconetgroup.com" class="a-class">info@viconetgroup.com</a> | <a href="tel:+27108247568" class="a-class">+27 10 824 7568</a></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
	<?php

	}
	else if($status = "verified"){
		$application->addJobApplication($email,$jobId);
		include "emails/verified-prof-email.php";
		unset($_SESSION['job_id']);
		unset($_SESSION['opp_access']);
		unset($_SESSION['opportunity']);
		unset($_SESSION['oppo_c_email']);
		//unset($_POST['user_email']);

		?>
		<div class="bloc bg-bg d-bloc full-width-bloc bloc-fill-screen " id="container-f">
	<div class="container">
		<div class="row">
			<div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2 text-start col-lg-6 offset-lg-3">
				<div class="card-f">
					<div class="row">
						<div class="col align-self-center">
							<img src="img/lazyload-ph.png" data-src="img/logo.svg" class="img-fluid mx-auto d-block mb-lg-3 lazyload" alt="logo" width="179" height="66">
							<div class="row">
								<div class="col text-lg-center">
									<img src="img/lazyload-ph.png" data-src="img/animation_lkb7ocgd_small.gif" class="img-fluid mx-auto d-block img-succe-style lazyload" alt="animation_lkb7ocgd_small" width="92" height="92">
									<label class="l-24 bcolor mb-3">
										<?php echo 'Dear '.$candidate->getCandName().' '.$candidate->getCandSurname(); ?>
									</label>

									<p class="p-16">Thank you! We have successfully received your Vico.net&trade; profile application.</p>
									
									<p class="p-18 bcolor">Please <a href="https://talent.viconetgroup.com" class="a-class">click here</a> to log in to your talent profile to verify the accuracy of your information.</p>
									<p class="p-16">For any future enquiries, please contact<br> <a href="mailto:info@viconetgroup.com" class="a-class">info@viconetgroup.com</a></p>
									<p class="p-16">Regards</p>
									<br>
									<p class="p-14">The Vico.net&trade; Team<br><a href="mailto:info@viconetgroup.com" class="a-class">info@viconetgroup.com</a> | <a href="tel:+27 10 824 7568" class="a-class">+27 10 824 7568</a></p>
								</div>
							</div>
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
else{
	include "emails/create-prof-email.php";
	//unset($_POST['user_email']);
?>
<div class="bloc bg-bg d-bloc full-width-bloc bloc-fill-screen " id="container-f">
	<div class="container">
		<div class="row">
			<div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2 text-start col-lg-6 offset-lg-3">
				<div class="card-f">
					<div class="row">
						<div class="col align-self-center">
							<img src="img/lazyload-ph.png" data-src="img/logo.svg" class="img-fluid mx-auto d-block mb-lg-3 lazyload" alt="logo" width="179" height="66">
							<div class="row">
								<div class="col text-lg-center">
									<img src="img/lazyload-ph.png" data-src="img/animation_lkb7ocgd_small.gif" class="img-fluid mx-auto d-block img-succe-style lazyload" alt="animation_lkb7ocgd_small" width="92" height="92">
									<label class="l-24 bcolor">
										Vico.net&trade; Job Opportunity.
									</label>
									<p class="p-16">Thank you for your interest in Vico.net&trade; – your virtual collaboration network!</p>
									<p class="p-16">Please <a href="https://talent.viconetgroup.com/create" class="a-class">click here</a> to complete your profile in order to be eligible for this opportunity.</p>
									<p class="p-16">For any future enquiries, please contact<br> <a href="mailto:info@viconetgroup.com" class="a-class">info@viconetgroup.com</a></p>
									<p class="p-16">Regards</p>
									<br>
									<p class="p-14">The Vico.net&trade; Team<br><a href="mailto:info@viconetgroup.com" class="a-class">info@viconetgroup.com</a> | <a href="tel:+27 10 824 7568" class="a-class">+27 10 824 7568</a></p>
								</div>
							</div>
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
</body>
<script src="./js/bootstrap.bundle.min.js?1184"></script>
<script src="./js/blocs.min.js?4897"></script>
<script src="./js/lazysizes.min.js" defer></script><!-- Additional JS END -->
<script src="../js/button_click.js"></script>
</html>