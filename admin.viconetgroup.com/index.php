<?php
session_start();
include "login_cred.php";
?>
<!DOCTYPE html>
<html>
<?php
include "head.php";
$type = md5('staff');
?>
<body class="body-b">

<div class="prof-bg" style="margin-top: 0px">	
	<div class="my-container" style="margin-top: -100px">
		<div class="row">
		<div class="col-lg-8">
			<div class="page-desc">
				<div class="web-logo">
					<img src="img/logo 2.svg">
				</div>
				<div class="page-nam">
					<h1 class="text-white" style="text-transform: capitalize;">Staff Login</h1>
				</div>
			</div>
		</div>
		<div class="my-form-frame col-lg-4">
			<div class="form-header">
				<div class="d-flex flex-row justify-content-between">
					<span ><a href="https://viconetgroup.com"><img src="img/go-back.svg"><label class="hrder-txt" style="margin-left: 10px;"><strong>Back</strong></label></a></span>
					<span ></span>
				</div>
				<div class="form-titl">
					<h5 class="">LOGIN</h5>
				</div>
			</div>
			<form method="post">
				<div><?php echo $disp ?></div>
				<div class="row">
					<div class="col-lg-12 form-group">
						<label class="input-label" for="user_email">Email</label>
						<input type="text" name="user_email" class="cust-input" id="user_email" oninput="checkEmail()" placeholder="innocent@example.com">
						<div class="error-message"></div>
					</div>
					<div class="col-lg-12 form-group">
						<label class="input-label">Password</label>
						<input type="Password" name="user_password" class="cust-input"  placeholder="********">
					</div>
					
					<div class="col-lg-12 form-group">
						<button class="bton btn2" style="width: 100%" name="login_btn" id="login_btn">LOGIN</button>
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
<script type="text/javascript" src="js/login-validation.js"></script>
<script src="js/button_click.js"></script>
</html>