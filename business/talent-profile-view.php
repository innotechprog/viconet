<?php
session_start();
include "include/connect.php";
include "include/functions.php";
$corp = new Corporate($db);
$corp->setCompData(1);
$candidate = new Candidates($db);
$candidate->setCandidate($_GET['id']);
$corp->getSubscription();
?>
<!DOCTYPE html>
<html>
<?php
include "head.php";
?>
<body class="body-b">
<?php
include "userHeader.php";
?>
<div class="talent-blue-header">
	<div class="prof-container">
		<div class="back-btn">
			<a href="index" ><img src="img/go-back.svg" class="text-white"><label class="hrder-txt text-white" style="margin-left: 10px;"><strong>Back</strong></label></a>
		</div>
		<div class="row">
			<div class="col-lg-4">
				<div class="white-container">
					<div class="profile-info">
						
						<div class="personal-info">
							<img src="img/gallery-1.jpg" class="prof-pic">
							<label class="l-18">Hlongwane Innocent</label>
							<p class="p-14">Mangweni</p>
							<label class="l-14">Telephone</label>
							<p class="p-14-n">+27 76 253 8318</p>
							<label class="l-14">Mobile</label>
							<p class="p-14-n">+27 76 253 8318</p>
						</div>
						<hr>
						
						<div class="other-info">
							<label class="l-14">Current Position</label>
							<p class="p-14-n">Software Developer</p>
							<label class="l-14">Current Company</label>
							<p class="p-14-n">Jthoka & CO</p>
							<label class="l-14">Student</label>
							<p class="p-14-n">Undergraduate</p>
							<label class="l-14">University / Qualification(s)</label>
							<p class="p-14-n">National Diploma in IT (Software Development)</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-8">
				<div class="about-prof">
					<label class="l-18">About Hlongwane Innocent</label>
					
					<p class="p-14-n">Although the absence of money and inability to execute the idea are often mentioned as reasons for failure, the root cause is usually a lack of proper market research. It can sometimes be almost impossible to tell the difference between a good and a bad idea. Although everyone wants their ideas to be loved, only a fraction of those ideas are worth executing. To learn if an idea has a chance to succeed, it needs to be validated. Stress testing will save you hours of time and a bucket load of cash.</p>
				<div class="row" style="margin-top: 40px;">
					<div class="col-lg-6">
						<div class="person-frame" style="background: #DFB256">
							<div>
								<img src="img/pdf 2.svg">
							</div>
							<div class=""><label class="l-18 text-white" style="margin: 10px 10px">Dwonload Short CV</label></div>
							
						</div>
					</div>
					<div class="col-lg-6">
						<div class="person-frame" style="background: #DFB256">
							<div>
								<img src="img/pdf 2.svg">
							</div>
							<div class=""><label class="l-18 text-white" style="margin: 10px 10px">Dwonload Long CV</label></div>
							
						</div>
					</div>
				</div>
				</div>

			</div>
		</div>

	</div>
</div>

<!--Modal-->
<?php
include "footer.php";
?>
</body>
<!-- Javascripts -->
<script type="text/javascript" src="js/toggle.js"></script>
</html>