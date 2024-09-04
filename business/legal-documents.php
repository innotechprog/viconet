<?php
session_start();
include "include/connect.php";
include "include/functions.php";
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">

<title>Vico.net | Legal Documents</title>
<meta content="Our platform connects you with data science, digital, engineering, information systems, technology and analytical group of professionals critical to the future of work and business solutions." name="">
<meta name="data science, digital, engineering, information systems, technology">

<?php
include "head1.php";
?>
<body class="body-b">
?>
<?php
if(empty($_SESSION['id'])){
	include "header.php";
}
else{
	if($_GET['id']==md5('staff'))
	{
		include "userHeader.php";
	}
	else
	{
		include 'include/create-p-auth.php';
		include 'candidate-header.php';
	}
}

?>
<div class="talent-blue-header">
	<div class="prof-container">
		<div class="back-btn">
			<label class="hrder-txt text-white" style=""><strong>Legal Documents</strong></label>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="white-container" style="padding-bottom:30px!important">
					<div class="doc-row">
						<label>Acceptable User Policy</label><a href="legal documents/Viconet Acceptable Use Policy.pdf" target="_blank"><button class="bton leg-btn" style="background:gray;">READ MORE</button></a>
					</div>
					<hr>
					<div class="doc-row">
						<label>Privacy Policy</label><a href="legal documents/Viconet Privacy Notice.pdf" target="_blank"><button class="bton leg-btn" style="background:gray;">READ MORE</button></a>
					</div>

					<hr>
					<div class="doc-row">
						<label>Cookie Policy</label><a href="legal documents/Viconet _Cookie_Policy.pdf" target="_blank"><button class="bton leg-btn" style="background:gray;">READ MORE</button></a>
					</div>
					<hr>
					<div class="doc-row">
						<label>Website Terms</label><a href="legal documents/Viconet Website Terms.pdf" target="_blank"><button class="bton leg-btn" style="background:gray;">READ MORE</button></a>
					</div>
					<hr>
					<div class="doc-row">
						<label>PAIA Manual</label><a href="legal documents/VICONET PAIA MANUAL.pdf" target="_blank"><button class="bton leg-btn" style="background:gray;">READ MORE</button></a>
					</div>
					<hr>
					<div class="doc-row">
						<label>POPIA form 1</label><a href="legal documents/Viconet FORM 1.pdf" target="_blank"><button class="bton leg-btn" style="background:gray;">READ MORE</button></a>
					</div>
					<hr>
					<div class="doc-row">
						<label>POPIA form 2</label><a href="legal documents/Viconet FORM 2.pdf" target="_blank"><button class="bton leg-btn" style="background:gray;">READ MORE</button></a>
					</div>
					<hr>
					<div class="doc-row">
						<label>POPIA form 5</label><a href="legal documents/Viconet FORM 5.pdf" target="_blank"><button class="bton leg-btn" style="background:gray;">READ MORE</button></a>
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