<?php
//include "login_cred.php";
?>
<!DOCTYPE html>
<html>
<?php
include "head.php";
?>
<body class="body-b">
<?php 
if(isset($_GET['del']))
{
	?>
<div class="my-container" >
	<div class="row">		
		<div class="my-form-frame col-lg-4" style="margin-top: -100px;margin: 0 auto;">
			<div class="mes-frame">
				<div class="success-tick">
					<img src="img/Tick 1.svg">
				</div>
				<label class="l-18">Your account has been deleted</label>
			</div>
		</div>
	</div>
</div>
<?php
}
else{
	?>
<div class="my-container" >
	<div class="row">		
		<div class="my-form-frame col-lg-4" style="margin-top: -100px;margin: 0 auto;">
			<div class="mes-frame">
				<div class="success-tick">
					<img src="img/Tick 1.svg">
				</div>
				<label class="l-18">Payment successful</label>
			</div>
		</div>
	</div>
</div>
<?php
}	
?>
</body>
<!-- Javascripts -->
<script type="text/javascript" src="js/toggle.js"></script>
<script type="text/javascript" src="js/login-validation.js"></script>
<script type="text/javascript">
    window.setTimeout(function() {
        window.location='index';
    }, 5000);
</script>

</html>