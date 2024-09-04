<?php
session_start();
include "include/unset_sess.php";
include "login_cred.php";
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">

<title>Vico.net | Corporate Login</title>
<meta content="Our platform connects you with data science, digital, engineering, information systems, technology and analytical group of professionals critical to the future of work and business solutions." name="">
<meta name="data science, digital, engineering, information systems, technology">

<?php
include "head1.php";
?>	
</head>
<?php
$type = md5('corp');
?>
<body style="  height: 100%;">
<div class="left-container2">
	<div class="l-content">
		<div class="web-logo">
			<img src="img/logo 2.svg">
		</div>
		<h1 class="lblur-bg-h1">Candidate Database</h1>
		<div class="short-line"></div>
		<p class="p-14 text-white">Connecting you to a pool of specialised
and growing database of the best talent
the Vico.net community has to offer.</p>
		
	</div>
</div>
<div class="right-container">
	<div class="r-content">
	<div class="form-header">
				<div class="d-flex flex-row justify-content-between">
					<span ><a href="index"><img src="img/go-back.svg"><label class="hrder-txt" style="margin-left: 10px;"><strong>Back</strong></label></a></span>
					<span ><label class="hrder-txt">Don't have an account? <a href="sign-up" class="checkLink"> Sign Up</a></label></span>
				</div>
				<div class="form-titl">
					<h5 class="">LOGIN</h5>
				</div>
			</div>
			<div class="form-align">
			<form method="post">
				<div><?php echo $disp ?></div>
				<div class="row">
					<div class="col-lg-12 form-group">
						<label class="input-label" for="user_email">Email Address</label>
						<input type="email" name="user_email" class="cust-input" id="user_email" oninput="checkEmail()" placeholder="innocent@example.com">
						<div class="error-message"></div>
					</div>
					<div class="col-lg-12 form-group">
						<label class="input-label">Password</label>
						<input type="Password" name="user_password" class="cust-input"  placeholder="********">
					</div>
					
					<div class="col-lg-12 form-group">
						<button class="bton btn2" style="width: 100%" name="corp_login" id="login_btn">LOGIN</button>
					</div>
					<div class="col-lg-12 form-group">
						<center><label class="center"><a href="forgot-password?t=<?php echo $type ?>" class="checkLink">Forgot Password</a></label></center>
					</div>
										
				</div>
			</form>
			</div> 
	</div>	
</div>
</body>
<!-- Javascripts -->
<script type="text/javascript" src="js/toggle.js"></script>
<script type="text/javascript" src="js/corp-loginval.js"></script>
<script src="js/button_click.js"></script>
</html>