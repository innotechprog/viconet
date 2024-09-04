<?php
session_start();
include "include/connect.php";
include "include/functions.php";
include "include/jobs_class.php";
include "include/job_appli_class.php";
$candidate = new Candidates($db);
$application = new Application($db);
?>
<!DOCTYPE html>
<html>
<?php
include "head.php";
?>
<body class="body-b">
	<div class="prof-container">
		<div class="cont-center col-lg-6">			
		<div class="white-container">
			
				<div class="text-center">
					<div style="margin-top:30px;margin-bottom: 30px;">
						<img src="img/success.svg">
					</div>
					<label class="l-18" style="margin-bottom:40px">Thank you for completing your profile</label>
					<?php if(isset($_SESSION['opp_access'])){
						$email = $_SESSION['oppo_c_email'];
						$candidate->setCandidate(md5($email));
						$jobId =$_SESSION['job_id'];
						$application->addJobApplication($email,$jobId);
						include "opportunity/emails/verified-prof-email.php";
						unset($_SESSION['job_id']);
						unset($_SESSION['opp_access']);
						unset($_SESSION['opportunity']);
						unset($_SESSION['oppo_c_email']);
						unset($_POST['user_email']);
						?>
						<p class="p-16">We have successfully received your Vico.net&trade; opportunity application.</p>
						<?php
					 }
					  ?>
					
				</div>
				<div class="">					
					<div class="row">					
						<div class="col-lg-12 form-group">
							<button class="bton btn2" id="redi" style="width:100%">VIEW PROFILE</button>						
						</div>						
					</div>
				</div>
				
				
		
			</div>
		</div>
	</div>

</body>
<!-- Javascripts -->
<script type="text/javascript" src="js/toggle.js"></script>
<script type="text/javascript">
   $(document).ready(function(){
  $('#redi').click(function(){
window.location = "profile-view";

});
}); 
</script>

</html>