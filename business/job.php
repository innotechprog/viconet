<?php
session_start();
include "include/connect.php";
include "include/functions.php";	
include "include/jobs_class.php";
$jobs = new Jobs($db);
$corp = new Corporate($db);
if(isset($_GET['id']))
{
	$id=$_GET['id'];
	$jobs->setJob($id);
	$jobs->setCompany($jobs->jobCompId());
	$corp->getAddressBy($jobs->jobCompId());
}
?>
<!DOCTYPE html>
<html>
<?php
include "head.php";
?>
<body class="body-b">
<?php
if (isset($_SESSION['id'])) {
	//include "header.php";
}
//include "header.php";
?>
<div class="talent-blue-header">
	<div class="prof-container">
		
		<div class="row">
		<div class="col-lg-8">
				<div class="corp-edit">	
				<div class="row">
						<div class="col-lg-12">
							<div class="d-flex">
								<div class="d-flex">
									<div class="complogo">
										<img src="img/Rectangle-84.jpg">
									</div>
									<div>
										<label class="l-18"><?php echo $jobs->getCompName() ?></label>
										<p class="p-14-n"><?php echo $jobs->getCompIndustry() ?></p>
										<?php
										$methods = $jobs->getWorkMethods();							
										$methods = explode(',',$methods);
										foreach($methods as $method){
											
											if($method == "remote"){
												?>
											<label class="wtype">Remote</label>
											<?php
											}
											elseif ($method == "part") {
												?>
											<label class="wtype">Part time</label>
											<?php
											}	
											elseif ($method == "full") {
												?>
											<label class="wtype">Full time</label>
											<?php
											}	
											elseif ($method == "hybrid") {
												?>
											<label class="wtype">Hybrid</label>
											<?php
											}									
										}
										?>
										<p><?php echo $jobs->getCompLocation() ?></p>
										<p><?php echo $corp->getCountry() ?></p>
									</div>			
								</div>
								<div class="">
									
								</div>
							</div>
							<hr>
						</div>
						<div class="col-lg-12">
							<div class="d-flex">
								<div class="rounddiv">
									<img src="img/about-icon.svg">				
								</div>
								<div class="d-block">
									<label class="l-18-n">Introduction</label>
									<p class="p-14-n"><?php echo $jobs->getJobIntro(); ?></p>
								</div>
							</div>
							<hr>
						</div>
						<div class="col-lg-12">
							<div class="d-flex">
								<div class="rounddiv">
									<img src="img/about-icon.svg">
								</div>
								<div class="d-block">
									<label class="l-18-n">Description</label>
									<p class="p-14-n"><?php echo $jobs->getJobDesc() ?></p>
								</div>
							</div>
							<hr>
						</div>
					<div class="col-lg-12">
						<div class="d-flex">
							<div class="rounddiv">
								<img src="img/edu-blue.svg">
							</div>
							<div class="d-block">
								<label class="l-18-n">Job Requirements</label>
								<?php 
								$query = $jobs->getRequirements($jobs->getJobId());
								for($x=0; $rows=$query->fetch();$x++){
								?>
								<div>
									
									<div class="d-flex">
										<div><div class="bullet mt-1"></div></div>
											<p class="p-14-n"><?php echo $rows['requirement']?></p>										
									</div>
								</div>								
								<?php
									}
								?>
							</div>	
						</div>
						<hr>
					</div>
					<div class="col-lg-12">
						<div class="d-flex">
								<div class="rounddiv">
									<img src="img/edu-blue.svg">
								</div>
							<div class="d-block">
								<label class="l-18-n">Job Responsibilities</label>
								<?php 
								$query = $jobs->getResponsibilities($jobs->getJobId());
								for($x=0; $rows=$query->fetch();$x++){
								?>
								<div>
									
									<div class="d-flex">
										<div><div class="bullet mt-1"></div></div>
											<p class="p-14-n"><?php echo $rows['responsibility']?></p>										
									</div>
								</div>								
								<?php
									}
								?>
							</div>	
						</div>
						<hr>
					</div>
					<div class="col-lg-12">
						<form method="post">
							<button name="apply" class="bton btn2 mr-0 d-block ml-auto">Apply</button>
						</form>
					</div>				
				</div>
	
			</div>
			
			</div>
		</div>

	</div>
</div>
<?php
if (isset($_POST['apply'])) {
	if (!isset($_SESSION['id'])) {
		$_SESSION['jobid'] = $id;
		?>
		<script type="text/javascript">window.location="https://talent.viconetgroup.com"</script>
		<?php
	}
	else{

	}
}
?>

<!--Modal-->
</body>
<!-- Javascripts -->
<script type="text/javascript">
	function getFileData(myFile){
   var file = myFile.files[0];  
   var filename = file.name;
   document.getElementById('filename').innerHTML = filename;
 }
</script>
<script type="text/javascript" src="js/toggle.js"></script>
<script type="text/javascript" src="js/button_click.js"></script>
<script type="text/javascript" src="js/delete.js"></script>
</html>